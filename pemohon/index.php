<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY id ASC")->fetchAll();
$daftarSubByKriteria = [];
foreach ($daftarKriteria as $k) {
    $stmt = $koneksi->prepare("SELECT * FROM sub_kriteria WHERE kriteria_id=:id ORDER BY nilai_bobot DESC");
    $stmt->execute(['id' => $k['id']]);
    $daftarSubByKriteria[$k['id']] = $stmt->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'tambah' || $aksi === 'edit') {
        $nik = bersihkan($_POST['nik']);
        $nama = bersihkan($_POST['nama']);
        $jk = bersihkan($_POST['jenis_kelamin']);
        $tempatLahir = bersihkan($_POST['tempat_lahir']);
        $tglLahir = $_POST['tanggal_lahir'] ?: null;
        $alamat = bersihkan($_POST['alamat']);
        $noHp = bersihkan($_POST['no_hp']);
        $statusNikah = bersihkan($_POST['status_pernikahan']);
        $penilaian = $_POST['penilaian'] ?? [];

        if ($nik === '' || $nama === '' || $alamat === '' || count($penilaian) < count($daftarKriteria)) {
            setFlash('danger', 'Data wajib (NIK, Nama, Alamat) dan seluruh penilaian kriteria harus diisi lengkap.');
        } else {
            try {
                $koneksi->beginTransaction();
                if ($aksi === 'tambah') {
                    $stmt = $koneksi->prepare("INSERT INTO pemohon (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, no_hp, status_pernikahan, input_oleh)
                        VALUES (:nik,:nama,:jk,:tl,:tgl,:alamat,:hp,:status,:uid)");
                    $stmt->execute(['nik'=>$nik,'nama'=>$nama,'jk'=>$jk,'tl'=>$tempatLahir,'tgl'=>$tglLahir,'alamat'=>$alamat,'hp'=>$noHp,'status'=>$statusNikah,'uid'=>$_SESSION['user_id']]);
                    $pemohonId = $koneksi->lastInsertId();
                } else {
                    $pemohonId = (int)$_POST['id'];
                    $stmt = $koneksi->prepare("UPDATE pemohon SET nik=:nik, nama=:nama, jenis_kelamin=:jk, tempat_lahir=:tl, tanggal_lahir=:tgl, alamat=:alamat, no_hp=:hp, status_pernikahan=:status WHERE id=:id");
                    $stmt->execute(['nik'=>$nik,'nama'=>$nama,'jk'=>$jk,'tl'=>$tempatLahir,'tgl'=>$tglLahir,'alamat'=>$alamat,'hp'=>$noHp,'status'=>$statusNikah,'id'=>$pemohonId]);
                    $koneksi->prepare("DELETE FROM penilaian_pemohon WHERE pemohon_id=:id")->execute(['id' => $pemohonId]);
                }

                $insPenilaian = $koneksi->prepare("INSERT INTO penilaian_pemohon (pemohon_id, kriteria_id, sub_kriteria_id) VALUES (:pid,:kid,:sid)");
                foreach ($penilaian as $kriteriaId => $subId) {
                    $insPenilaian->execute(['pid' => $pemohonId, 'kid' => (int)$kriteriaId, 'sid' => (int)$subId]);
                }

                $koneksi->commit();
                setFlash('success', $aksi === 'tambah' ? 'Data pemohon baru berhasil ditambahkan.' : 'Data pemohon berhasil diperbarui.');
            } catch (PDOException $e) {
                $koneksi->rollBack();
                setFlash('danger', 'Gagal menyimpan data. NIK mungkin sudah terdaftar.');
            }
        }
    } elseif ($aksi === 'hapus') {
        $id = (int)$_POST['id'];
        $koneksi->prepare("DELETE FROM pemohon WHERE id=:id")->execute(['id' => $id]);
        setFlash('success', 'Data pemohon berhasil dihapus.');
    }
    header('Location: index.php');
    exit;
}

$cari = bersihkan($_GET['cari'] ?? '');
if ($cari !== '') {
    $stmt = $koneksi->prepare("SELECT * FROM pemohon WHERE nama LIKE :c1 OR nik LIKE :c2 ORDER BY created_at DESC");
    $stmt->execute(['c1' => "%$cari%", 'c2' => "%$cari%"]);
} else {
    $stmt = $koneksi->query("SELECT * FROM pemohon ORDER BY created_at DESC");
}
$daftarPemohon = $stmt->fetchAll();

// Ambil semua penilaian sekaligus untuk keperluan edit (JS)
$semuaPenilaian = $koneksi->query("SELECT * FROM penilaian_pemohon")->fetchAll();
$penilaianByPemohon = [];
foreach ($semuaPenilaian as $p) {
    $penilaianByPemohon[$p['pemohon_id']][$p['kriteria_id']] = $p['sub_kriteria_id'];
}

$judulHalaman = 'Data Pemohon';
$menuAktif = 'pemohon';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-5">
  <div>
    <h2 class="text-lg font-bold text-masjid-800">Data Pemohon Zakat</h2>
    <p class="text-sm text-slate-400">Kelola data calon penerima beserta penilaian sub kriterianya.</p>
  </div>
  <div class="flex gap-2">
    <form method="GET" class="flex">
      <input type="text" name="cari" value="<?= $cari ?>" placeholder="Cari nama / NIK..." class="rounded-l-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-masjid-400 outline-none w-48">
      <button class="bg-masjid-50 border border-l-0 border-slate-200 px-4 rounded-r-xl text-masjid-700">🔍</button>
    </form>
    <button onclick="bukaModalTambah()" class="bg-masjid-600 hover:bg-masjid-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-soft whitespace-nowrap">+ Tambah Pemohon</button>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-soft border border-masjid-100 overflow-hidden fade-in">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="tabel-modern">
        <tr class="text-left text-white">
          <th class="py-3 px-4">NIK</th>
          <th class="py-3 px-4">Nama</th>
          <th class="py-3 px-4">Jenis Kelamin</th>
          <th class="py-3 px-4">Alamat</th>
          <th class="py-3 px-4">No. HP</th>
          <th class="py-3 px-4">Status Penilaian</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarPemohon)): ?>
          <tr><td colspan="7" class="text-center py-8 text-slate-400">Belum ada data pemohon.</td></tr>
        <?php endif; ?>
        <?php foreach ($daftarPemohon as $p): ?>
          <?php $sudahLengkap = isset($penilaianByPemohon[$p['id']]) && count($penilaianByPemohon[$p['id']]) >= count($daftarKriteria); ?>
          <tr class="border-b border-masjid-50 hover:bg-masjid-50/40">
            <td class="py-3 px-4 text-slate-600"><?= bersihkan($p['nik']) ?></td>
            <td class="py-3 px-4 font-medium text-slate-700"><?= bersihkan($p['nama']) ?></td>
            <td class="py-3 px-4 text-slate-500"><?= $p['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
            <td class="py-3 px-4 text-slate-500 max-w-xs truncate"><?= bersihkan($p['alamat']) ?></td>
            <td class="py-3 px-4 text-slate-500"><?= bersihkan($p['no_hp']) ?: '-' ?></td>
            <td class="py-3 px-4">
              <?= $sudahLengkap ? '<span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Lengkap</span>' : '<span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Belum Lengkap</span>' ?>
            </td>
            <td class="py-3 px-4">
              <div class="flex items-center justify-center gap-2">
                <button title="Ubah" onclick='bukaModalEdit(<?= json_encode($p, JSON_HEX_APOS|JSON_HEX_QUOT) ?>, <?= json_encode($penilaianByPemohon[$p['id']] ?? new stdClass(), JSON_HEX_APOS|JSON_HEX_QUOT) ?>)' class="p-2 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100">✏️</button>
                <form method="POST" onsubmit="return confirm('Hapus data pemohon \'<?= bersihkan($p['nama']) ?>\'?');">
                  <input type="hidden" name="aksi" value="hapus">
                  <input type="hidden" name="id" value="<?= $p['id'] ?>">
                  <button title="Hapus" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">🗑️</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL -->
<div id="modalPemohon" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center px-4 py-8 overflow-y-auto">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-6 fade-in my-auto">
    <h3 id="judulModal" class="font-bold text-lg text-masjid-800 mb-4">Tambah Data Pemohon</h3>
    <form method="POST" class="space-y-5">
      <input type="hidden" name="aksi" id="inputAksi" value="tambah">
      <input type="hidden" name="id" id="inputId">

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium text-slate-600">NIK</label>
          <input type="text" name="nik" id="inputNik" required maxlength="20" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Nama Lengkap</label>
          <input type="text" name="nama" id="inputNama" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
      </div>

      <div class="grid sm:grid-cols-3 gap-4">
        <div>
          <label class="text-sm font-medium text-slate-600">Jenis Kelamin</label>
          <select name="jenis_kelamin" id="inputJk" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" id="inputTempatLahir" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" id="inputTglLahir" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
      </div>

      <div>
        <label class="text-sm font-medium text-slate-600">Alamat</label>
        <textarea name="alamat" id="inputAlamat" required rows="2" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none"></textarea>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium text-slate-600">No. HP</label>
          <input type="text" name="no_hp" id="inputNoHp" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Status Pernikahan</label>
          <input type="text" name="status_pernikahan" id="inputStatusNikah" placeholder="Menikah / Belum Menikah / Janda / Duda" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
      </div>

      <div class="border-t border-masjid-100 pt-4">
        <h4 class="font-bold text-masjid-800 mb-3">Penilaian Sub Kriteria</h4>
        <div class="grid sm:grid-cols-2 gap-4">
          <?php foreach ($daftarKriteria as $k): ?>
            <div>
              <label class="text-sm font-medium text-slate-600"><?= bersihkan($k['nama_kriteria']) ?></label>
              <select name="penilaian[<?= $k['id'] ?>]" id="penilaian_<?= $k['id'] ?>" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
                <option value="">-- Pilih --</option>
                <?php foreach ($daftarSubByKriteria[$k['id']] as $s): ?>
                  <option value="<?= $s['id'] ?>"><?= bersihkan($s['nama_sub_kriteria']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="button" onclick="tutupModal()" class="flex-1 border border-slate-200 text-slate-600 font-semibold py-2.5 rounded-xl hover:bg-slate-50">Batal</button>
        <button type="submit" class="flex-1 bg-masjid-600 hover:bg-masjid-700 text-white font-semibold py-2.5 rounded-xl">Simpan Data</button>
      </div>
    </form>
  </div>
</div>

<script>
const daftarKriteriaIds = <?= json_encode(array_column($daftarKriteria, 'id')) ?>;

function resetForm() {
  document.getElementById('inputNik').value = '';
  document.getElementById('inputNama').value = '';
  document.getElementById('inputJk').value = 'L';
  document.getElementById('inputTempatLahir').value = '';
  document.getElementById('inputTglLahir').value = '';
  document.getElementById('inputAlamat').value = '';
  document.getElementById('inputNoHp').value = '';
  document.getElementById('inputStatusNikah').value = '';
  daftarKriteriaIds.forEach(id => document.getElementById('penilaian_' + id).value = '');
}

function bukaModalTambah() {
  document.getElementById('judulModal').innerText = 'Tambah Data Pemohon';
  document.getElementById('inputAksi').value = 'tambah';
  document.getElementById('inputId').value = '';
  resetForm();
  document.getElementById('modalPemohon').classList.remove('hidden');
  document.getElementById('modalPemohon').classList.add('flex');
}

function bukaModalEdit(data, penilaian) {
  document.getElementById('judulModal').innerText = 'Ubah Data Pemohon';
  document.getElementById('inputAksi').value = 'edit';
  document.getElementById('inputId').value = data.id;
  document.getElementById('inputNik').value = data.nik;
  document.getElementById('inputNama').value = data.nama;
  document.getElementById('inputJk').value = data.jenis_kelamin;
  document.getElementById('inputTempatLahir').value = data.tempat_lahir ?? '';
  document.getElementById('inputTglLahir').value = data.tanggal_lahir ?? '';
  document.getElementById('inputAlamat').value = data.alamat;
  document.getElementById('inputNoHp').value = data.no_hp ?? '';
  document.getElementById('inputStatusNikah').value = data.status_pernikahan ?? '';
  daftarKriteriaIds.forEach(id => {
    const sel = document.getElementById('penilaian_' + id);
    sel.value = (penilaian && penilaian[id]) ? penilaian[id] : '';
  });
  document.getElementById('modalPemohon').classList.remove('hidden');
  document.getElementById('modalPemohon').classList.add('flex');
}

function tutupModal() {
  document.getElementById('modalPemohon').classList.add('hidden');
  document.getElementById('modalPemohon').classList.remove('flex');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
