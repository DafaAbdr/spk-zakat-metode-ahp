<?php
require_once __DIR__ . '/config/database.php';
$judulHalaman = 'Dashboard';
$menuAktif = 'dashboard';
require_once __DIR__ . '/includes/header.php';

$totalPemohon    = $koneksi->query("SELECT COUNT(*) c FROM pemohon")->fetch()['c'];
$totalKriteria   = $koneksi->query("SELECT COUNT(*) c FROM kriteria")->fetch()['c'];
$totalSubKriteria = $koneksi->query("SELECT COUNT(*) c FROM sub_kriteria")->fetch()['c'];
$totalDiterima   = $koneksi->query("SELECT COUNT(*) c FROM hasil_akhir WHERE status='Diterima'")->fetch()['c'];

$bobotSudahDihitung = $koneksi->query("SELECT COUNT(*) c FROM kriteria WHERE bobot_prioritas > 0")->fetch()['c'];

$top5 = $koneksi->query("SELECT h.*, p.nama, p.nik FROM hasil_akhir h
    JOIN pemohon p ON p.id = h.pemohon_id
    ORDER BY h.ranking ASC LIMIT 5")->fetchAll();

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY kode_kriteria")->fetchAll();
?>

<!-- Kartu Sambutan -->
<div class="rounded-3xl bg-gradient-to-r from-masjid-700 to-masjid-800 text-white p-6 md:p-8 mb-6 relative overflow-hidden fade-in">
  <div class="absolute right-4 top-1/2 -translate-y-1/2 text-7xl opacity-20 hidden md:block">🕌</div>
  <p class="text-gold-300 font-semibold text-sm mb-1">Assalamu'alaikum, <?= bersihkan($_SESSION['nama_lengkap']) ?> 👋</p>
  <h2 class="text-xl md:text-2xl font-bold max-w-xl leading-snug">Selamat datang di Sistem Pendukung Keputusan Penerimaan Zakat Masjid Nurul Ikhsan</h2>
  <p class="text-masjid-100 text-sm mt-2 max-w-2xl">Kelola kriteria, data pemohon, dan proses perhitungan AHP untuk menentukan penerima zakat secara adil dan tepat sasaran.</p>
</div>

<!-- Statistik -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100 fade-in">
    <div class="w-11 h-11 rounded-xl bg-masjid-50 flex items-center justify-center text-xl mb-3">🧑‍🤝‍🧑</div>
    <p class="text-2xl font-bold text-masjid-800"><?= $totalPemohon ?></p>
    <p class="text-xs text-slate-400">Total Data Pemohon</p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100 fade-in">
    <div class="w-11 h-11 rounded-xl bg-gold-50 flex items-center justify-center text-xl mb-3">📋</div>
    <p class="text-2xl font-bold text-masjid-800"><?= $totalKriteria ?></p>
    <p class="text-xs text-slate-400">Total Kriteria AHP</p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100 fade-in">
    <div class="w-11 h-11 rounded-xl bg-sky-50 flex items-center justify-center text-xl mb-3">🧩</div>
    <p class="text-2xl font-bold text-masjid-800"><?= $totalSubKriteria ?></p>
    <p class="text-xs text-slate-400">Total Sub Kriteria AHP</p>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-soft border border-masjid-100 fade-in">
    <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-xl mb-3">✅</div>
    <p class="text-2xl font-bold text-masjid-800"><?= $totalDiterima ?></p>
    <p class="text-xs text-slate-400">Total Penerima Zakat</p>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
  <!-- Progress & Kriteria -->
  <div class="lg:col-span-1 bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 fade-in">
    <h3 class="font-bold text-masjid-800 mb-4">Bobot Prioritas Kriteria</h3>
    <?php if ($bobotSudahDihitung == 0): ?>
      <p class="text-sm text-slate-400">Bobot AHP belum dihitung. Silakan isi perbandingan kriteria terlebih dahulu.</p>
      <a href="ahp/perbandingan_kriteria.php" class="inline-block mt-3 text-sm font-semibold text-masjid-600 hover:underline">Isi Perbandingan Kriteria &rarr;</a>
    <?php else: ?>
      <div class="space-y-3">
        <?php foreach ($daftarKriteria as $k): ?>
          <div>
            <div class="flex justify-between text-sm mb-1">
              <span class="font-medium text-slate-600"><?= bersihkan($k['nama_kriteria']) ?></span>
              <span class="text-masjid-700 font-semibold"><?= formatBobot($k['bobot_prioritas']*100,2) ?>%</span>
            </div>
            <div class="w-full bg-masjid-50 rounded-full h-2.5">
              <div class="bg-gradient-to-r from-masjid-500 to-gold-500 h-2.5 rounded-full" style="width: <?= min(100, $k['bobot_prioritas']*100) ?>%"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Ranking Terbaru -->
  <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 fade-in">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-masjid-800">Hasil Perankingan Terbaru</h3>
      <a href="ahp/hasil_perankingan.php" class="text-sm font-semibold text-masjid-600 hover:underline">Lihat Semua &rarr;</a>
    </div>
    <?php if (empty($top5)): ?>
      <p class="text-sm text-slate-400">Belum ada hasil perhitungan. Silakan lakukan proses perankingan pada menu <b>Proses Perankingan</b>.</p>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead>
            <tr class="text-left text-slate-400 border-b border-masjid-100">
              <th class="py-2 pr-3">Rank</th>
              <th class="py-2 pr-3">Nama Pemohon</th>
              <th class="py-2 pr-3">NIK</th>
              <th class="py-2 pr-3">Skor</th>
              <th class="py-2 pr-3">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($top5 as $r): ?>
              <tr class="border-b border-masjid-50 hover:bg-masjid-50/50">
                <td class="py-2.5 pr-3 font-bold text-gold-600">#<?= $r['ranking'] ?></td>
                <td class="py-2.5 pr-3 font-medium text-slate-700"><?= bersihkan($r['nama']) ?></td>
                <td class="py-2.5 pr-3 text-slate-500"><?= bersihkan($r['nik']) ?></td>
                <td class="py-2.5 pr-3 text-slate-600"><?= formatBobot($r['total_nilai']) ?></td>
                <td class="py-2.5 pr-3"><?= badgeStatus($r['status']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
