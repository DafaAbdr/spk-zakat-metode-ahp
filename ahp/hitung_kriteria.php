<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY id ASC")->fetchAll();
$n = count($daftarKriteria);
$ids = array_column($daftarKriteria, 'id');

// Bangun matriks n x n, default 1 di diagonal
$matriks = [];
foreach ($ids as $i) {
    foreach ($ids as $j) {
        $matriks[$i][$j] = ($i === $j) ? 1.0 : null;
    }
}
$pb = $koneksi->query("SELECT * FROM perbandingan_kriteria")->fetchAll();
foreach ($pb as $row) {
    $matriks[$row['kriteria_a_id']][$row['kriteria_b_id']] = (float)$row['nilai'];
    $matriks[$row['kriteria_b_id']][$row['kriteria_a_id']] = 1 / (float)$row['nilai'];
}

$matriksLengkap = true;
foreach ($ids as $i) foreach ($ids as $j) if ($matriks[$i][$j] === null) $matriksLengkap = false;

$hasilHitung = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $matriksLengkap && $n >= 2) {
    // 1. Jumlah tiap kolom
    $jumlahKolom = [];
    foreach ($ids as $j) {
        $jumlahKolom[$j] = 0;
        foreach ($ids as $i) $jumlahKolom[$j] += $matriks[$i][$j];
    }
    // 2. Normalisasi matriks & rata-rata baris (bobot prioritas / eigen vector approx)
    $bobot = [];
    foreach ($ids as $i) {
        $totalBaris = 0;
        foreach ($ids as $j) $totalBaris += $matriks[$i][$j] / $jumlahKolom[$j];
        $bobot[$i] = $totalBaris / $n;
    }
    // 3. Hitung lambda maks
    $lambdaMaks = 0;
    foreach ($ids as $j) $lambdaMaks += $jumlahKolom[$j] * $bobot[$j];
    // 4. CI & CR
    $ci = ($lambdaMaks - $n) / ($n - 1);
    $ri = getRandomIndex($n);
    $cr = $ri > 0 ? $ci / $ri : 0;
    $konsisten = $cr <= 0.1;

    // Simpan bobot ke tabel kriteria
    foreach ($ids as $i) {
        $koneksi->prepare("UPDATE kriteria SET bobot_prioritas=:b WHERE id=:id")->execute(['b' => $bobot[$i], 'id' => $i]);
    }
    // Simpan riwayat: hapus riwayat lama terlebih dahulu agar hanya menyimpan hasil
    // perhitungan TERBARU (proses lama dihapus, digantikan proses baru yang dihitung)
    $koneksi->exec("DELETE FROM riwayat_hitung_ahp");
    $koneksi->prepare("INSERT INTO riwayat_hitung_ahp (jumlah_kriteria, lambda_maks, ci, ri, cr, status_konsisten, dihitung_oleh)
        VALUES (:n,:lm,:ci,:ri,:cr,:status,:uid)")->execute([
        'n' => $n, 'lm' => $lambdaMaks, 'ci' => $ci, 'ri' => $ri, 'cr' => $cr,
        'status' => $konsisten ? 'Konsisten' : 'Tidak Konsisten', 'uid' => $_SESSION['user_id']
    ]);

    $hasilHitung = compact('jumlahKolom', 'bobot', 'lambdaMaks', 'ci', 'ri', 'cr', 'konsisten');
    setFlash($konsisten ? 'success' : 'warning', $konsisten
        ? 'Perhitungan bobot AHP berhasil dan matriks konsisten (CR ≤ 0,1).'
        : 'Perhitungan selesai namun matriks TIDAK konsisten (CR > 0,1). Sebaiknya tinjau ulang nilai perbandingan.');
}

$riwayatTerakhir = $koneksi->query("SELECT * FROM riwayat_hitung_ahp ORDER BY id DESC LIMIT 1")->fetch();

$judulHalaman = 'Hitung Bobot AHP';
$menuAktif = 'hitung_kriteria';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="mb-5">
  <h2 class="text-lg font-bold text-masjid-800">Perhitungan Bobot Prioritas Kriteria</h2>
  <p class="text-sm text-slate-400">Sistem menghitung eigen vector, lambda maks, dan rasio konsistensi (CR) secara otomatis.</p>
</div>

<?php if (!$matriksLengkap): ?>
  <div class="bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 text-sm text-slate-500">
    ⚠️ Data perbandingan kriteria belum lengkap. Silakan lengkapi terlebih dahulu pada menu
    <a href="perbandingan_kriteria.php" class="text-masjid-600 font-semibold hover:underline">Perbandingan Kriteria</a>.
  </div>
<?php else: ?>

<!-- Tabel Matriks -->
<div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 mb-6 fade-in overflow-x-auto">
  <h3 class="font-bold text-masjid-800 mb-4">Matriks Perbandingan Berpasangan</h3>
  <table class="w-full text-sm text-center border-collapse">
    <thead>
      <tr>
        <th class="p-2 bg-masjid-50 border border-masjid-100"></th>
        <?php foreach ($daftarKriteria as $k): ?>
          <th class="p-2 bg-masjid-50 border border-masjid-100 text-masjid-700"><?= bersihkan($k['kode_kriteria']) ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($daftarKriteria as $ki): ?>
        <tr>
          <td class="p-2 bg-masjid-50 border border-masjid-100 font-semibold text-masjid-700 text-left"><?= bersihkan($ki['kode_kriteria'] . ' - ' . $ki['nama_kriteria']) ?></td>
          <?php foreach ($daftarKriteria as $kj): ?>
            <td class="p-2 border border-masjid-100 text-slate-600"><?= formatBobot($matriks[$ki['id']][$kj['id']], 3) ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <form method="POST" class="mt-5" onsubmit="return confirm('Menghitung ulang akan MENGGANTI hasil perhitungan sebelumnya dengan yang baru. Lanjutkan?');">
    <button type="submit" class="bg-gradient-to-r from-masjid-600 to-masjid-700 hover:from-masjid-700 hover:to-masjid-800 text-white font-semibold px-6 py-3 rounded-xl shadow-soft">
      🧮 Proses Hitung Bobot &amp; Uji Konsistensi
    </button>
    <p class="text-xs text-slate-400 mt-2">Menekan tombol ini akan menghitung ulang berdasarkan data perbandingan terbaru dan menggantikan hasil perhitungan sebelumnya.</p>
  </form>
</div>

<?php
$tampil = $hasilHitung;
if (!$tampil && $riwayatTerakhir) {
    // tampilkan bobot tersimpan terakhir meski tidak submit form saat ini
    $bobotSekarang = [];
    foreach ($daftarKriteria as $k) $bobotSekarang[$k['id']] = $k['bobot_prioritas'];
    if (array_sum($bobotSekarang) > 0) {
        $tampil = ['bobot' => $bobotSekarang, 'lambdaMaks' => $riwayatTerakhir['lambda_maks'], 'ci' => $riwayatTerakhir['ci'], 'ri' => $riwayatTerakhir['ri'], 'cr' => $riwayatTerakhir['cr'], 'konsisten' => $riwayatTerakhir['status_konsisten'] === 'Konsisten'];
    }
}
?>

<?php if ($tampil): ?>
<div class="grid lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2 bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 fade-in">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-masjid-800">Bobot Prioritas Hasil Perhitungan</h3>
      <?php if ($hasilHitung): ?>
        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Baru saja dihitung</span>
      <?php else: ?>
        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">Hasil tersimpan sebelumnya</span>
      <?php endif; ?>
    </div>
    <div class="space-y-3">
      <?php foreach ($daftarKriteria as $k): ?>
        <div>
          <div class="flex justify-between text-sm mb-1">
            <span class="font-medium text-slate-600"><?= bersihkan($k['nama_kriteria']) ?></span>
            <span class="text-masjid-700 font-bold"><?= formatBobot($tampil['bobot'][$k['id']]*100, 2) ?>%</span>
          </div>
          <div class="w-full bg-masjid-50 rounded-full h-3">
            <div class="bg-gradient-to-r from-masjid-500 to-gold-500 h-3 rounded-full" style="width:<?= min(100,$tampil['bobot'][$k['id']]*100) ?>%"></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 fade-in">
    <h3 class="font-bold text-masjid-800 mb-4">Uji Konsistensi</h3>
    <div class="space-y-3 text-sm">
      <div class="flex justify-between border-b border-masjid-50 pb-2"><span class="text-slate-500">λ maks</span><span class="font-semibold"><?= formatBobot($tampil['lambdaMaks'],4) ?></span></div>
      <div class="flex justify-between border-b border-masjid-50 pb-2"><span class="text-slate-500">Consistency Index (CI)</span><span class="font-semibold"><?= formatBobot($tampil['ci'],4) ?></span></div>
      <div class="flex justify-between border-b border-masjid-50 pb-2"><span class="text-slate-500">Random Index (RI)</span><span class="font-semibold"><?= formatBobot($tampil['ri'],2) ?></span></div>
      <div class="flex justify-between border-b border-masjid-50 pb-2"><span class="text-slate-500">Consistency Ratio (CR)</span><span class="font-semibold"><?= formatBobot($tampil['cr'],4) ?></span></div>
      <div class="pt-2">
        <?php if ($tampil['konsisten']): ?>
          <span class="block text-center bg-emerald-50 text-emerald-700 font-semibold py-2 rounded-xl text-sm">✅ Konsisten (CR ≤ 0,1)</span>
        <?php else: ?>
          <span class="block text-center bg-red-50 text-red-700 font-semibold py-2 rounded-xl text-sm">⚠️ Tidak Konsisten (CR > 0,1)</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
