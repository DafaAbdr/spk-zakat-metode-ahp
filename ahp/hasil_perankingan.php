<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$hasil = $koneksi->query("SELECT h.*, p.nama, p.nik, p.jenis_kelamin, p.alamat, p.no_hp FROM hasil_akhir h
    JOIN pemohon p ON p.id = h.pemohon_id
    ORDER BY h.ranking ASC")->fetchAll();

$waktuProses = $hasil[0]['tanggal_hitung'] ?? null;
$totalDiterima = count(array_filter($hasil, fn($h) => $h['status'] === 'Diterima'));
$totalDitolak = count(array_filter($hasil, fn($h) => $h['status'] === 'Ditolak'));

$judulHalaman = 'Hasil Perankingan';
$menuAktif = 'hasil_perankingan';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-5">
  <div>
    <h2 class="text-lg font-bold text-masjid-800">Hasil Perankingan Penerima Zakat</h2>
    <p class="text-sm text-slate-400">
      <?php if ($waktuProses): ?>
        Terakhir diproses: <?= formatTanggalIndo($waktuProses) ?>, pukul <?= date('H:i', strtotime($waktuProses)) ?> WIB
      <?php else: ?>
        Belum ada proses perankingan yang dijalankan.
      <?php endif; ?>
    </p>
  </div>
  <a href="hitung_akhir.php" class="bg-masjid-600 hover:bg-masjid-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-soft whitespace-nowrap">🏆 Proses Ulang Perankingan</a>
</div>

<?php if (empty($hasil)): ?>
  <div class="bg-white rounded-2xl p-8 shadow-soft border border-masjid-100 text-center fade-in">
    <p class="text-4xl mb-3">📊</p>
    <p class="text-slate-500 mb-1">Belum ada hasil perankingan.</p>
    <p class="text-sm text-slate-400">Silakan jalankan proses di menu <a href="hitung_akhir.php" class="text-masjid-600 font-semibold hover:underline">Proses Perankingan</a> terlebih dahulu.</p>
  </div>
<?php else: ?>

<div class="grid grid-cols-3 gap-4 mb-6">
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100">
    <p class="text-xs text-slate-400">Total Dinilai</p>
    <p class="text-xl font-bold text-masjid-800"><?= count($hasil) ?> orang</p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-emerald-100">
    <p class="text-xs text-slate-400">Diterima</p>
    <p class="text-xl font-bold text-emerald-600"><?= $totalDiterima ?> orang</p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-red-100">
    <p class="text-xs text-slate-400">Ditolak</p>
    <p class="text-xl font-bold text-red-500"><?= $totalDitolak ?> orang</p>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-soft border border-masjid-100 overflow-hidden fade-in">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="tabel-modern">
        <tr class="text-left text-white">
          <th class="py-3 px-4">Rank</th>
          <th class="py-3 px-4">NIK</th>
          <th class="py-3 px-4">Nama</th>
          <th class="py-3 px-4">Alamat</th>
          <th class="py-3 px-4">Skor Akhir</th>
          <th class="py-3 px-4 text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($hasil as $h): ?>
          <tr class="border-b border-masjid-50 hover:bg-masjid-50/40 <?= $h['status']==='Diterima' ? 'bg-emerald-50/30' : '' ?>">
            <td class="py-3 px-4 font-bold text-gold-600">#<?= $h['ranking'] ?></td>
            <td class="py-3 px-4 text-slate-600"><?= bersihkan($h['nik']) ?></td>
            <td class="py-3 px-4 font-medium text-slate-700"><?= bersihkan($h['nama']) ?></td>
            <td class="py-3 px-4 text-slate-500"><?= bersihkan($h['alamat']) ?></td>
            <td class="py-3 px-4 text-slate-600"><?= formatBobot($h['total_nilai']) ?></td>
            <td class="py-3 px-4 text-center"><?= badgeStatus($h['status']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
