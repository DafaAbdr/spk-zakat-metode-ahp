<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY id ASC")->fetchAll();
$totalBobot = array_sum(array_column($daftarKriteria, 'bobot_prioritas'));
$jumlahKriteria = count($daftarKriteria);

$jumlahPemohon = $koneksi->query("SELECT COUNT(*) c FROM pemohon")->fetch()['c'];
$jumlahPemohonLengkap = $koneksi->query("SELECT COUNT(DISTINCT pemohon_id) c FROM penilaian_pemohon
    GROUP BY pemohon_id HAVING COUNT(DISTINCT kriteria_id) = (SELECT COUNT(*) FROM kriteria)")->rowCount();

$sudahAdaHasil = (int) $koneksi->query("SELECT COUNT(*) c FROM hasil_akhir")->fetch()['c'] > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlahKuota = (int)($_POST['jumlah_kuota'] ?? 0);

    if ($totalBobot <= 0) {
        setFlash('danger', 'Bobot kriteria belum dihitung. Silakan hitung bobot AHP terlebih dahulu.');
        header('Location: hitung_akhir.php');
        exit;
    } elseif ($jumlahKuota < 1) {
        setFlash('danger', 'Jumlah kuota penerima wajib diisi minimal 1.');
        header('Location: hitung_akhir.php');
        exit;
    }

    // Ambil semua pemohon beserta penilaiannya
    $dataPemohon = $koneksi->query("SELECT p.id, p.nama FROM pemohon p")->fetchAll();
    $skorList = [];

    foreach ($dataPemohon as $p) {
        $stmt = $koneksi->prepare("SELECT pp.kriteria_id, sk.nilai_bobot, k.bobot_prioritas
            FROM penilaian_pemohon pp
            JOIN sub_kriteria sk ON sk.id = pp.sub_kriteria_id
            JOIN kriteria k ON k.id = pp.kriteria_id
            WHERE pp.pemohon_id = :pid");
        $stmt->execute(['pid' => $p['id']]);
        $rows = $stmt->fetchAll();

        if (count($rows) < $jumlahKriteria) continue; // penilaian belum lengkap, lewati

        $totalNilai = 0;
        foreach ($rows as $r) {
            $totalNilai += (float)$r['nilai_bobot'] * (float)$r['bobot_prioritas'];
        }
        $skorList[] = ['pemohon_id' => $p['id'], 'nama' => $p['nama'], 'skor' => $totalNilai];
    }

    // Urutkan skor tertinggi ke terendah -> ranking
    usort($skorList, fn($a, $b) => $b['skor'] <=> $a['skor']);

    $koneksi->beginTransaction();
    // Proses ini hanya untuk SATU periode aktif: hapus SELURUH hasil sebelumnya
    // sebelum menyimpan hasil perhitungan yang baru.
    $koneksi->exec("DELETE FROM hasil_akhir");

    $rank = 1;
    foreach ($skorList as $s) {
        $status = $rank <= $jumlahKuota ? 'Diterima' : 'Ditolak';
        $koneksi->prepare("INSERT INTO hasil_akhir (pemohon_id, total_nilai, ranking, status, periode, dihitung_oleh)
            VALUES (:pid,:nilai,:rank,:status,:periode,:uid)")->execute([
            'pid' => $s['pemohon_id'], 'nilai' => $s['skor'], 'rank' => $rank,
            'status' => $status, 'periode' => date('Y-m-d H:i:s'), 'uid' => $_SESSION['user_id']
        ]);
        $rank++;
    }
    $koneksi->commit();

    setFlash('success', 'Proses perankingan selesai. ' . count($skorList) . ' pemohon berhasil dinilai, ' . min($jumlahKuota, count($skorList)) . ' orang dinyatakan diterima.');
    header('Location: hasil_perankingan.php');
    exit;
}

$judulHalaman = 'Proses Perankingan';
$menuAktif = 'hitung_akhir';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="mb-5">
  <h2 class="text-lg font-bold text-masjid-800">Proses Perankingan Penerima Zakat</h2>
  <p class="text-sm text-slate-400">Hitung skor akhir tiap pemohon berdasarkan bobot kriteria AHP dan tentukan penerima sesuai kuota.</p>
</div>

<div class="grid md:grid-cols-3 gap-4 mb-6">
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100">
    <p class="text-xs text-slate-400">Total Bobot Kriteria</p>
    <p class="text-xl font-bold text-masjid-800"><?= $totalBobot > 0 ? formatBobot($totalBobot*100,2).'%' : 'Belum dihitung' ?></p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100">
    <p class="text-xs text-slate-400">Total Pemohon Terdaftar</p>
    <p class="text-xl font-bold text-masjid-800"><?= $jumlahPemohon ?> orang</p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100">
    <p class="text-xs text-slate-400">Pemohon Penilaian Lengkap</p>
    <p class="text-xl font-bold text-masjid-800"><?= $jumlahPemohonLengkap ?> orang</p>
  </div>
</div>

<?php if ($totalBobot <= 0): ?>
  <div class="bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 text-sm text-slate-500">
    ⚠️ Bobot kriteria belum dihitung. Silakan proses terlebih dahulu di menu <a href="hitung_kriteria.php" class="text-masjid-600 font-semibold hover:underline">Hitung Bobot AHP</a>.
  </div>
<?php elseif ($jumlahPemohonLengkap == 0): ?>
  <div class="bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 text-sm text-slate-500">
    ⚠️ Belum ada pemohon dengan penilaian lengkap. Silakan lengkapi data di menu <a href="../pemohon/index.php" class="text-masjid-600 font-semibold hover:underline">Data Pemohon</a>.
  </div>
<?php else: ?>

<div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 fade-in max-w-xl">
  <?php if ($sudahAdaHasil): ?>
    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-800 mb-5">
      ⚠️ Sudah ada hasil perankingan sebelumnya. Menjalankan proses ini akan <b>menghapus hasil lama</b> dan menggantinya dengan hasil perhitungan baru.
    </div>
  <?php endif; ?>

  <form method="POST" class="space-y-5" onsubmit="return confirm('<?= $sudahAdaHasil ? 'Hasil perankingan sebelumnya akan DIHAPUS dan digantikan hasil baru. ' : '' ?>Lanjutkan proses perankingan sekarang?');">
    <div>
      <label class="text-sm font-medium text-slate-600">Jumlah Kuota Penerima</label>
      <input type="number" name="jumlah_kuota" min="1" required value="10" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
      <p class="text-xs text-slate-400 mt-1">Sejumlah pemohon dengan skor AHP tertinggi akan dinyatakan <b>Diterima</b>, sisanya <b>Ditolak</b>.</p>
    </div>

    <button type="submit"
      class="w-full bg-gradient-to-r from-masjid-600 to-masjid-700 hover:from-masjid-700 hover:to-masjid-800 text-white font-semibold py-3 rounded-xl shadow-soft">
      🏆 Proses Perankingan Sekarang
    </button>
  </form>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
