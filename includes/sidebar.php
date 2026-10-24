<?php
// $menuAktif dikirim dari tiap halaman (mis: 'dashboard','kriteria','subkriteria','perbandingan','hitung_kriteria','pemohon','hitung_akhir','hasil_perankingan','laporan')
$menuAktif = $menuAktif ?? '';
function menuAktif($kode, $kodeTarget) {
    return $kode === $kodeTarget ? 'bg-white/15 text-white shadow-inner border-l-4 border-gold-400' : 'text-masjid-100 hover:bg-white/10 hover:text-white';
}
?>
<aside id="sidebar" class="no-print fixed inset-y-0 left-0 z-40 w-72 bg-gradient-to-b from-masjid-800 via-masjid-700 to-masjid-800 text-white transform -translate-x-full md:translate-x-0 transition-all duration-200 flex flex-col">
<script>
  // Terapkan status collapse (jika pernah disimpan) SEBELUM elemen lain dirender, agar tidak berkedip.
  (function () {
    try {
      if (window.innerWidth >= 768 && localStorage.getItem('sidebarCollapsed') === '1') {
        document.currentScript.closest('aside').classList.add('collapsed');
      }
    } catch (e) {}
  })();
</script>
  <!-- Tombol collapse: dijadikan tombol bulat mengambang di tepi sidebar,
       BUKAN di dalam baris header, supaya tidak pernah terpotong saat sidebar diciutkan. -->
  <button id="btnCollapse" title="Sembunyikan / tampilkan menu" class="hidden md:flex absolute -right-3 top-8 z-50 w-6 h-6 items-center justify-center rounded-full bg-gold-500 hover:bg-gold-600 text-white shadow-md transition">
    <svg id="iconCollapse" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" /></svg>
  </button>

  <!-- LOGO / MASJID HEADER -->
  <div class="logo-row px-5 py-5 border-b border-white/10 flex items-center gap-2 shrink-0">
    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shrink-0 overflow-hidden ring-1 ring-gold-300/40">
      <img src="<?= basePath() ?>assets/img/logo-masjid.jpg" alt="Logo Masjid Nurul Ikhsan" class="w-full h-full object-cover">
    </div>
    <div class="leading-tight brand-text min-w-0">
      <p class="font-bold text-white text-sm truncate">Masjid Nurul Ikhsan</p>
      <p class="text-xs text-gold-300 truncate">Jakarta Barat</p>
    </div>
  </div>

  <nav class="flex-1 px-3 py-3 space-y-0.5 text-sm">
    <p class="section-label px-3 text-[10px] uppercase tracking-widest text-masjid-300 font-semibold mb-1">Menu Utama</p>
    <a href="<?= basePath() ?>index.php" title="Dashboard" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'dashboard') ?>">
      <span class="text-lg shrink-0">🏠</span> <span class="nav-label">Dashboard</span>
    </a>

    <p class="section-label px-3 pt-3 text-[10px] uppercase tracking-widest text-masjid-300 font-semibold mb-1">Master AHP</p>
    <a href="<?= basePath() ?>kriteria/index.php" title="Kriteria" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'kriteria') ?>">
      <span class="text-lg shrink-0">📋</span> <span class="nav-label">Kriteria</span>
    </a>
    <a href="<?= basePath() ?>subkriteria/index.php" title="Sub Kriteria" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'subkriteria') ?>">
      <span class="text-lg shrink-0">🧩</span> <span class="nav-label">Sub Kriteria</span>
    </a>
    <a href="<?= basePath() ?>ahp/perbandingan_kriteria.php" title="Perbandingan Kriteria" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'perbandingan') ?>">
      <span class="text-lg shrink-0">⚖️</span> <span class="nav-label">Perbandingan Kriteria</span>
    </a>
    <a href="<?= basePath() ?>ahp/hitung_kriteria.php" title="Hitung Bobot AHP" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'hitung_kriteria') ?>">
      <span class="text-lg shrink-0">🧮</span> <span class="nav-label">Hitung Bobot AHP</span>
    </a>

    <p class="section-label px-3 pt-3 text-[10px] uppercase tracking-widest text-masjid-300 font-semibold mb-1">Data Zakat</p>
    <a href="<?= basePath() ?>pemohon/index.php" title="Data Pemohon" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'pemohon') ?>">
      <span class="text-lg shrink-0">🧑‍🤝‍🧑</span> <span class="nav-label">Data Pemohon</span>
    </a>
    <a href="<?= basePath() ?>ahp/hitung_akhir.php" title="Proses Perankingan" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'hitung_akhir') ?>">
      <span class="text-lg shrink-0">🏆</span> <span class="nav-label">Proses Perankingan</span>
    </a>
    <a href="<?= basePath() ?>ahp/hasil_perankingan.php" title="Hasil Perankingan" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'hasil_perankingan') ?>">
      <span class="text-lg shrink-0">📈</span> <span class="nav-label">Hasil Perankingan</span>
    </a>

    <p class="section-label px-3 pt-3 text-[10px] uppercase tracking-widest text-masjid-300 font-semibold mb-1">Laporan</p>
    <a href="<?= basePath() ?>laporan/index.php" title="Laporan" class="flex items-center gap-3 px-3 py-2 rounded-xl transition <?= menuAktif($menuAktif, 'laporan') ?>">
      <span class="text-lg shrink-0">🖨️</span> <span class="nav-label">Laporan</span>
    </a>
  </nav>

  <div class="px-3 py-3 border-t border-white/10 shrink-0">
    <a href="<?= basePath() ?>auth/logout.php" title="Keluar" onclick="return confirm('Yakin ingin keluar dari sistem?');" class="flex items-center gap-3 px-3 py-2 rounded-xl text-red-200 hover:bg-red-500/20 hover:text-white transition">
      <span class="text-lg shrink-0">🚪</span> <span class="nav-label">Keluar</span>
    </a>
  </div>
</aside>
<div id="overlaySidebar" class="no-print fixed inset-0 bg-black/40 z-30 hidden md:hidden"></div>
