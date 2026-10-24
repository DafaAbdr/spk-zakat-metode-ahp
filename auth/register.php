<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

if (isLogin()) {
    header('Location: ../index.php');
    exit;
}

$error = '';
$old = ['username' => '', 'nama_lengkap' => '', 'email' => '', 'no_hp' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['username']     = bersihkan($_POST['username'] ?? '');
    $old['nama_lengkap'] = bersihkan($_POST['nama_lengkap'] ?? '');
    $old['email']        = bersihkan($_POST['email'] ?? '');
    $old['no_hp']        = bersihkan($_POST['no_hp'] ?? '');
    $password         = $_POST['password'] ?? '';
    $konfirmasi       = $_POST['konfirmasi_password'] ?? '';

    if ($old['username'] === '' || $old['nama_lengkap'] === '' || $old['email'] === '' || $password === '') {
        $error = 'Semua kolom bertanda * wajib diisi.';
    } elseif (strlen($password) < 6) {
        $error = 'Kata sandi minimal 6 karakter.';
    } elseif ($password !== $konfirmasi) {
        $error = 'Konfirmasi kata sandi tidak cocok.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } else {
        $cek = $koneksi->prepare("SELECT id FROM users WHERE username = :u OR email = :e LIMIT 1");
        $cek->execute(['u' => $old['username'], 'e' => $old['email']]);
        if ($cek->fetch()) {
            $error = 'Username atau email sudah terdaftar. Silakan gunakan yang lain.';
        } else {
            $namaFoto = uploadFotoProfil('foto');
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $koneksi->prepare("INSERT INTO users (username, password, nama_lengkap, email, no_hp, foto, role)
                VALUES (:username, :password, :nama, :email, :hp, :foto, 'panitia')");
            $stmt->execute([
                'username' => $old['username'],
                'password' => $hash,
                'nama'     => $old['nama_lengkap'],
                'email'    => $old['email'],
                'hp'       => $old['no_hp'],
                'foto'     => $namaFoto,
            ]);
            setFlash('success', 'Pendaftaran berhasil! Silakan masuk menggunakan akun baru Anda.');
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masjid Nurul Ikhsan</title>
<link rel="icon" type="image/jpeg" href="../assets/img/logo-masjid.jpg">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script>
  tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins','sans-serif'] },
    colors: { masjid: {50:'#f0fbf6',100:'#d7f3e6',400:'#43b587',600:'#0d6b4f',700:'#0a5540',800:'#094433',900:'#08392b'},
    gold: {300:'#eec550',400:'#e6ab2b',500:'#c9a227',600:'#a87e1c'} } } } }
</script>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="font-sans min-h-screen bg-masjid-900 relative overflow-hidden flex items-center justify-center px-4 py-10">

  <div class="absolute inset-0 opacity-20" style="background-image:radial-gradient(circle at 20% 20%, #43b587 0, transparent 35%), radial-gradient(circle at 85% 80%, #c9a227 0, transparent 35%);"></div>
  <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-masjid-600/30 blur-3xl"></div>
  <div class="absolute -bottom-24 -right-16 w-80 h-80 rounded-full bg-gold-500/20 blur-3xl"></div>

  <div class="relative z-10 w-full max-w-xl bg-white/95 backdrop-blur rounded-3xl shadow-2xl p-8 md:p-10 fade-in">
    <div class="text-center mb-6">
      <div class="text-3xl">🕌</div>
      <h1 class="text-2xl font-bold text-masjid-800 mt-1">Daftar Akun Panitia</h1>
      <p class="text-sm text-slate-400">Masjid Nurul Ikhsan — Jakarta Barat</p>
    </div>

    <?php if ($error): ?>
      <div class="bg-red-50 border border-red-300 text-red-700 text-sm rounded-xl px-4 py-3 mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">

      <div class="flex items-center gap-4">
        <img id="previewFoto" src="../assets/img/default-avatar.svg" class="w-16 h-16 rounded-full object-cover ring-2 ring-gold-300" alt="Preview">
        <div class="flex-1">
          <label class="text-sm font-medium text-slate-600">Foto Profil</label>
          <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp" onchange="previewGambar(this)"
            class="mt-1 w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-masjid-50 file:text-masjid-700 file:font-medium hover:file:bg-masjid-100">
          <p class="text-xs text-slate-400 mt-1">Opsional. JPG/PNG/WEBP, maks 2MB.</p>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium text-slate-600">Nama Lengkap *</label>
          <input type="text" name="nama_lengkap" required value="<?= $old['nama_lengkap'] ?>"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Username *</label>
          <input type="text" name="username" required value="<?= $old['username'] ?>"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium text-slate-600">Email *</label>
          <input type="email" name="email" required value="<?= $old['email'] ?>"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">No. HP</label>
          <input type="text" name="no_hp" value="<?= $old['no_hp'] ?>"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium text-slate-600">Kata Sandi *</label>
          <input type="password" name="password" required minlength="6"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Konfirmasi Kata Sandi *</label>
          <input type="password" name="konfirmasi_password" required minlength="6"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
      </div>

      <button type="submit"
        class="w-full bg-gradient-to-r from-masjid-600 to-masjid-700 hover:from-masjid-700 hover:to-masjid-800 text-white font-semibold py-2.5 rounded-xl shadow-soft transition">
        Daftar Sekarang
      </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
      Sudah punya akun? <a href="login.php" class="text-masjid-600 font-semibold hover:underline">Masuk di sini</a>
    </p>
  </div>

  <script>
    function previewGambar(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('previewFoto').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
