<?php
require_once __DIR__ . '/functions.php';
wajibLogin();
$judulHalaman = $judulHalaman ?? 'Dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masjid Nurul Ikhsan</title>
<link rel="icon" type="image/jpeg" href="<?= basePath() ?>assets/img/logo-masjid.jpg">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Amiri:wght@700&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { sans: ['Poppins','sans-serif'], arab: ['Amiri','serif'], serif: ['"Times New Roman"','Times','Georgia','serif'] },
        colors: {
          masjid: { 50:'#f0fbf6',100:'#d7f3e6',200:'#aee6cd',300:'#78d1ac',400:'#43b587',500:'#219a6c',600:'#0d6b4f',700:'#0a5540',700:'#0a5540',800:'#094433',900:'#08392b'},
          gold: {50:'#fdf9ec',100:'#faf0c8',200:'#f4de8d',300:'#eec550',400:'#e6ab2b',500:'#c9a227',600:'#a87e1c',700:'#865f1a',800:'#6f4c1c',900:'#5f401d'}
        },
        boxShadow: { soft: '0 8px 30px -8px rgba(13,107,79,0.25)' }
      }
    }
  }
</script>
<link rel="stylesheet" href="<?= basePath() ?>assets/css/style.css?v=<?= @filemtime(__DIR__ . '/../assets/css/style.css') ?: time() ?>">
<?= $ekstraHead ?? '' ?>
</head>
<body class="bg-gradient-to-br from-masjid-50 via-white to-gold-50 min-h-screen font-sans text-slate-700">
<div class="flex min-h-screen">
<?php require_once __DIR__ . '/sidebar.php'; ?>

<div id="mainWrapper" class="flex-1 flex flex-col min-w-0">
  <!-- TOPBAR -->
  <header class="no-print sticky top-0 z-30 bg-white/80 backdrop-blur border-b border-masjid-100 shadow-sm">
    <div class="flex items-center justify-between px-4 md:px-8 py-3">
      <div class="flex items-center gap-3">
        <button id="btnSidebar" class="md:hidden p-2 rounded-lg hover:bg-masjid-50 text-masjid-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
        <div>
          <h1 class="text-lg md:text-xl font-bold text-masjid-800"><?= bersihkan($judulHalaman) ?></h1>
          <p class="text-xs text-slate-400">Sistem Pendukung Keputusan Penerimaan Zakat &mdash; Metode AHP</p>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <div class="hidden sm:flex flex-col text-right">
          <span class="text-sm font-semibold text-slate-700"><?= bersihkan($_SESSION['nama_lengkap']) ?></span>
          <span class="text-xs text-gold-600 font-medium capitalize"><?= bersihkan($_SESSION['role']) ?></span>
        </div>
        <a href="<?= basePath() ?>profil/index.php" class="block">
          <img src="<?= basePath() ?>assets/uploads/profil/<?= bersihkan($_SESSION['foto']) ?>" onerror="this.src='<?= basePath() ?>assets/img/default-avatar.svg'" class="w-10 h-10 rounded-full object-cover ring-2 ring-gold-300 shadow-soft" alt="Foto Profil">
        </a>
      </div>
    </div>
  </header>

  <main class="flex-1 px-4 md:px-8 py-6">
    <?php tampilkanFlash(); ?>
