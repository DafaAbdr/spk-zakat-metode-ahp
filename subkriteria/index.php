<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'tambah' || $aksi === 'edit') {
        $kriteriaId = (int)$_POST['kriteria_id'];
        $nama = bersihkan($_POST['nama_sub_kriteria']);
        $nilai = (float)$_POST['nilai_bobot'];
        $ket  = bersihkan($_POST['keterangan']);

        if ($kriteriaId <= 0 || $nama === '' || $nilai < 0 || $nilai > 1) {
            setFlash('danger', 'Semua kolom wajib diisi dengan benar. Nilai bobot harus antara 0.0 - 1.0.');
        } else {
            if ($aksi === 'tambah') {
                $stmt = $koneksi->prepare("INSERT INTO sub_kriteria (kriteria_id, nama_sub_kriteria, nilai_bobot, keterangan) VALUES (:kid,:nama,:nilai,:ket)");
                $stmt->execute(['kid' => $kriteriaId, 'nama' => $nama, 'nilai' => $nilai, 'ket' => $ket]);
                setFlash('success', 'Sub kriteria baru berhasil ditambahkan.');
            } else {
                $id = (int)$_POST['id'];
                $stmt = $koneksi->prepare("UPDATE sub_kriteria SET kriteria_id=:kid, nama_sub_kriteria=:nama, nilai_bobot=:nilai, keterangan=:ket WHERE id=:id");
                $stmt->execute(['kid' => $kriteriaId, 'nama' => $nama, 'nilai' => $nilai, 'ket' => $ket, 'id' => $id]);
                setFlash('success', 'Sub kriteria berhasil diperbarui.');
            }
        }
    } elseif ($aksi === 'hapus') {
        $id = (int)$_POST['id'];
        try {
            $koneksi->prepare("DELETE FROM sub_kriteria WHERE id=:id")->execute(['id' => $id]);
            setFlash('success', 'Sub kriteria berhasil dihapus.');
        } catch (PDOException $e) {
            setFlash('danger', 'Gagal menghapus, sub kriteria masih digunakan pada data penilaian pemohon.');
        }
    }
    header('Location: index.php');
    exit;
}

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY kode_kriteria")->fetchAll();
$daftarSub = $koneksi->query("SELECT sk.*, k.nama_kriteria, k.kode_kriteria FROM sub_kriteria sk
    JOIN kriteria k ON k.id = sk.kriteria_id ORDER BY k.kode_kriteria, sk.nilai_bobot DESC")->fetchAll();

$judulHalaman = 'Sub Kriteria';
$menuAktif = 'subkriteria';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="flex items-center justify-between mb-5">
  <div>
    <h2 class="text-lg font-bold text-masjid-800">Data Sub Kriteria</h2>
    <p class="text-sm text-slate-400">Rincian kategori penilaian pada setiap kriteria.</p>
  </div>
  <button onclick="bukaModalTambah()" class="bg-masjid-600 hover:bg-masjid-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-soft flex items-center gap-2">
    <span>+</span> Tambah Sub Kriteria
  </button>
</div>

<?php
$grouped = [];
foreach ($daftarSub as $s) { $grouped[$s['kode_kriteria'] . ' — ' . $s['nama_kriteria']][] = $s; }
?>

<?php if (empty($daftarKriteria)): ?>
  <div class="bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 text-sm text-slate-400">
    Silakan tambahkan data <a href="../kriteria/index.php" class="text-masjid-600 font-semibold hover:underline">Kriteria</a> terlebih dahulu.
  </div>
<?php endif; ?>

<div class="grid md:grid-cols-2 gap-5">
<?php foreach ($grouped as $namaKriteria => $items): ?>
  <div class="bg-white rounded-2xl shadow-soft border border-masjid-100 overflow-hidden fade-in">
    <div class="bg-masjid-50 px-5 py-3 border-b border-masjid-100">
      <h3 class="font-bold text-masjid-800 text-sm"><?= bersihkan($namaKriteria) ?></h3>
    </div>
    <table class="w-full text-sm">
      <tbody>
        <?php foreach ($items as $s): ?>
          <tr class="border-b border-masjid-50 hover:bg-masjid-50/40">
            <td class="py-3 px-5">
              <p class="font-medium text-slate-700"><?= bersihkan($s['nama_sub_kriteria']) ?></p>
              <p class="text-xs text-slate-400"><?= bersihkan($s['keterangan']) ?></p>
            </td>
            <td class="py-3 px-3 text-right w-24">
              <span class="px-2.5 py-1 rounded-lg bg-gold-50 text-gold-700 font-semibold text-xs"><?= formatBobot($s['nilai_bobot'],2) ?></span>
            </td>
            <td class="py-3 px-3 w-20">
              <div class="flex items-center justify-center gap-1.5">
                <button title="Ubah" onclick='bukaModalEdit(<?= json_encode($s, JSON_HEX_APOS|JSON_HEX_QUOT) ?>)' class="p-1.5 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 text-xs">✏️</button>
                <form method="POST" onsubmit="return confirm('Hapus sub kriteria ini?');">
                  <input type="hidden" name="aksi" value="hapus">
                  <input type="hidden" name="id" value="<?= $s['id'] ?>">
                  <button title="Hapus" class="p-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs">🗑️</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endforeach; ?>
</div>

<!-- MODAL -->
<div id="modalSub" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center px-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 fade-in">
    <h3 id="judulModal" class="font-bold text-lg text-masjid-800 mb-4">Tambah Sub Kriteria</h3>
    <form method="POST" class="space-y-4">
      <input type="hidden" name="aksi" id="inputAksi" value="tambah">
      <input type="hidden" name="id" id="inputId">
      <div>
        <label class="text-sm font-medium text-slate-600">Kriteria Induk</label>
        <select name="kriteria_id" id="inputKriteria" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
          <option value="">-- Pilih Kriteria --</option>
          <?php foreach ($daftarKriteria as $k): ?>
            <option value="<?= $k['id'] ?>"><?= bersihkan($k['kode_kriteria'] . ' - ' . $k['nama_kriteria']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="text-sm font-medium text-slate-600">Nama Sub Kriteria</label>
        <input type="text" name="nama_sub_kriteria" id="inputNama" required
          class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none" placeholder="Contoh: < Rp 500.000">
      </div>
      <div>
        <label class="text-sm font-medium text-slate-600">Nilai Bobot (0.0 - 1.0)</label>
        <input type="number" step="0.01" min="0" max="1" name="nilai_bobot" id="inputNilai" required
          class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none" placeholder="Contoh: 1.00">
        <p class="text-xs text-slate-400 mt-1">Semakin tinggi nilai, semakin berhak menerima zakat.</p>
      </div>
      <div>
        <label class="text-sm font-medium text-slate-600">Keterangan</label>
        <input type="text" name="keterangan" id="inputKeterangan"
          class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
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
  document.getElementById('judulModal').innerText = 'Tambah Sub Kriteria';
  document.getElementById('inputAksi').value = 'tambah';
  document.getElementById('inputId').value = '';
  document.getElementById('inputKriteria').value = '';
  document.getElementById('inputNama').value = '';
  document.getElementById('inputNilai').value = '';
  document.getElementById('inputKeterangan').value = '';
  document.getElementById('modalSub').classList.remove('hidden');
  document.getElementById('modalSub').classList.add('flex');
}
function bukaModalEdit(data) {
  document.getElementById('judulModal').innerText = 'Ubah Sub Kriteria';
  document.getElementById('inputAksi').value = 'edit';
  document.getElementById('inputId').value = data.id;
  document.getElementById('inputKriteria').value = data.kriteria_id;
  document.getElementById('inputNama').value = data.nama_sub_kriteria;
  document.getElementById('inputNilai').value = data.nilai_bobot;
  document.getElementById('inputKeterangan').value = data.keterangan ?? '';
  document.getElementById('modalSub').classList.remove('hidden');
  document.getElementById('modalSub').classList.add('flex');
}
function tutupModal() {
  document.getElementById('modalSub').classList.add('hidden');
  document.getElementById('modalSub').classList.remove('flex');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
