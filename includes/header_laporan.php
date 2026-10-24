<?php
/**
 * Varian header khusus untuk halaman Laporan: TANPA topbar (judul halaman, subjudul,
 * dan profil pengguna di kanan atas) — karena laporan sudah punya kop surat sendiri.
 * Sidebar navigasi tetap ditampilkan agar pengguna bisa berpindah menu.
 */
require_once __DIR__ . '/functions.php';
wajibLogin();
$judulHalaman = $judulHalaman ?? 'Laporan';
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
          masjid: { 50:'#f0fbf6',100:'#d7f3e6',200:'#aee6cd',300:'#78d1ac',400:'#43b587',500:'#219a6c',600:'#0d6b4f',700:'#0a5540',800:'#094433',900:'#08392b'},
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
  <main class="flex-1 px-4 md:px-8 py-6">
    <?php tampilkanFlash(); ?>
