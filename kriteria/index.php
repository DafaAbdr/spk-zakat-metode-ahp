<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

// ================== PROSES CRUD ==================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'tambah' || $aksi === 'edit') {
        $kode = bersihkan($_POST['kode_kriteria']);
        $nama = bersihkan($_POST['nama_kriteria']);
        $ket  = bersihkan($_POST['keterangan']);

        if ($kode === '' || $nama === '') {
            setFlash('danger', 'Kode dan nama kriteria wajib diisi.');
        } else {
            try {
                if ($aksi === 'tambah') {
                    $stmt = $koneksi->prepare("INSERT INTO kriteria (kode_kriteria, nama_kriteria, keterangan, created_by) VALUES (:kode,:nama,:ket,:uid)");
                    $stmt->execute(['kode' => $kode, 'nama' => $nama, 'ket' => $ket, 'uid' => $_SESSION['user_id']]);
                    setFlash('success', 'Kriteria baru berhasil ditambahkan.');
                } else {
                    $id = (int)$_POST['id'];
                    $stmt = $koneksi->prepare("UPDATE kriteria SET kode_kriteria=:kode, nama_kriteria=:nama, keterangan=:ket WHERE id=:id");
                    $stmt->execute(['kode' => $kode, 'nama' => $nama, 'ket' => $ket, 'id' => $id]);
                    setFlash('success', 'Kriteria berhasil diperbarui.');
                }
            } catch (PDOException $e) {
                setFlash('danger', 'Kode kriteria sudah digunakan. Gunakan kode lain.');
            }
        }
    } elseif ($aksi === 'hapus') {
        $id = (int)$_POST['id'];
        try {
            $koneksi->prepare("DELETE FROM kriteria WHERE id=:id")->execute(['id' => $id]);
            setFlash('success', 'Kriteria beserta sub kriteria terkait berhasil dihapus.');
        } catch (PDOException $e) {
            setFlash('danger', 'Gagal menghapus, kriteria mungkin masih digunakan pada data penilaian.');
        }
    }
    header('Location: index.php');
    exit;
}

$daftar = $koneksi->query("SELECT k.*, (SELECT COUNT(*) FROM sub_kriteria sk WHERE sk.kriteria_id=k.id) jumlah_sub
    FROM kriteria k ORDER BY k.kode_kriteria ASC")->fetchAll();

$judulHalaman = 'Kriteria';
$menuAktif = 'kriteria';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="flex items-center justify-between mb-5">
  <div>
    <h2 class="text-lg font-bold text-masjid-800">Data Kriteria AHP</h2>
    <p class="text-sm text-slate-400">Kelola 5 kriteria penilaian penerimaan zakat.</p>
  </div>
  <button onclick="bukaModalTambah()" class="bg-masjid-600 hover:bg-masjid-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-soft flex items-center gap-2">
    <span>+</span> Tambah Kriteria
  </button>
</div>

<div class="bg-white rounded-2xl shadow-soft border border-masjid-100 overflow-hidden fade-in">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="tabel-modern">
        <tr class="text-left text-white">
          <th class="py-3 px-4">Kode</th>
          <th class="py-3 px-4">Nama Kriteria</th>
          <th class="py-3 px-4">Keterangan</th>
          <th class="py-3 px-4">Jml Sub Kriteria</th>
          <th class="py-3 px-4">Bobot Prioritas</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftar)): ?>
          <tr><td colspan="6" class="text-center py-8 text-slate-400">Belum ada data kriteria.</td></tr>
        <?php endif; ?>
        <?php foreach ($daftar as $k): ?>
          <tr class="border-b border-masjid-50 hover:bg-masjid-50/40">
            <td class="py-3 px-4 font-semibold text-masjid-700"><?= bersihkan($k['kode_kriteria']) ?></td>
            <td class="py-3 px-4 font-medium text-slate-700"><?= bersihkan($k['nama_kriteria']) ?></td>
            <td class="py-3 px-4 text-slate-500"><?= bersihkan($k['keterangan']) ?></td>
            <td class="py-3 px-4 text-slate-500"><?= $k['jumlah_sub'] ?> sub kriteria</td>
            <td class="py-3 px-4 text-slate-600"><?= $k['bobot_prioritas'] > 0 ? formatBobot($k['bobot_prioritas']*100,2) . '%' : '<span class="text-slate-300">Belum dihitung</span>' ?></td>
            <td class="py-3 px-4">
              <div class="flex items-center justify-center gap-2">
                <button title="Ubah" onclick='bukaModalEdit(<?= json_encode($k, JSON_HEX_APOS|JSON_HEX_QUOT) ?>)' class="p-2 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100">✏️</button>
                <form method="POST" onsubmit="return confirm('Hapus kriteria \'<?= bersihkan($k['nama_kriteria']) ?>\'? Sub kriteria terkait juga akan terhapus.');">
                  <input type="hidden" name="aksi" value="hapus">
                  <input type="hidden" name="id" value="<?= $k['id'] ?>">
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
<div id="modalKriteria" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center px-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 fade-in">
    <h3 id="judulModal" class="font-bold text-lg text-masjid-800 mb-4">Tambah Kriteria</h3>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="aksi" id="inputAksi" value="tambah">
      <input type="hidden" name="id" id="inputId">
      <div>
        <label class="text-sm font-medium text-slate-600">Kode Kriteria</label>
        <input type="text" name="kode_kriteria" id="inputKode" required maxlength="10"
          class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none" placeholder="Contoh: K1">
      </div>
      <div>
        <label class="text-sm font-medium text-slate-600">Nama Kriteria</label>
        <input type="text" name="nama_kriteria" id="inputNama" required
          class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none" placeholder="Contoh: Penghasilan">
      </div>
      <div>
        <label class="text-sm font-medium text-slate-600">Keterangan</label>
        <textarea name="keterangan" id="inputKeterangan" rows="3"
          class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none"></textarea>
      </div>
      <div class="flex gap-3 pt-2">
        <button type="button" onclick="tutupModal()" class="flex-1 border border-slate-200 text-slate-600 font-semibold py-2.5 rounded-xl hover:bg-slate-50">Batal</button>
        <button type="submit" class="flex-1 bg-masjid-600 hover:bg-masjid-700 text-white font-semibold py-2.5 rounded-xl">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function bukaModalTambah() {
  document.getElementById('judulModal').innerText = 'Tambah Kriteria';
  document.getElementById('inputAksi').value = 'tambah';
  document.getElementById('inputId').value = '';
  document.getElementById('inputKode').value = '';
  document.getElementById('inputNama').value = '';
  document.getElementById('inputKeterangan').value = '';
  document.getElementById('modalKriteria').classList.remove('hidden');
  document.getElementById('modalKriteria').classList.add('flex');
}
function bukaModalEdit(data) {
  document.getElementById('judulModal').innerText = 'Ubah Kriteria';
  document.getElementById('inputAksi').value = 'edit';
  document.getElementById('inputId').value = data.id;
  document.getElementById('inputKode').value = data.kode_kriteria;
  document.getElementById('inputNama').value = data.nama_kriteria;
  document.getElementById('inputKeterangan').value = data.keterangan ?? '';
  document.getElementById('modalKriteria').classList.remove('hidden');
  document.getElementById('modalKriteria').classList.add('flex');
}
function tutupModal() {
  document.getElementById('modalKriteria').classList.add('hidden');
  document.getElementById('modalKriteria').classList.remove('flex');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
