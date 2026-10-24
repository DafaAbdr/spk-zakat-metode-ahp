<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

if (isLogin()) {
    header('Location: ../index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = bersihkan($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan kata sandi wajib diisi.';
    } else {
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] === 'nonaktif') {
                $error = 'Akun Anda dinonaktifkan. Hubungi administrator masjid.';
            } else {
                $_SESSION['user_id']      = $user['id'];
                $_SESSION['username']     = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['role']         = $user['role'];
                $_SESSION['foto']         = $user['foto'];
                setFlash('success', 'Selamat datang kembali, ' . htmlspecialchars($user['nama_lengkap']) . '!');
                header('Location: ../index.php');
                exit;
            }
        } else {
            $error = 'Username atau kata sandi salah.';
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
    colors: { masjid: {50:'#f0fbf6',100:'#d7f3e6',600:'#0d6b4f',700:'#0a5540',800:'#094433',900:'#08392b'},
    gold: {300:'#eec550',400:'#e6ab2b',500:'#c9a227',600:'#a87e1c'} } } } }
</script>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="font-sans min-h-screen bg-masjid-900 relative overflow-hidden flex items-center justify-center px-4">

  <!-- Dekorasi Kubah & Pola -->
  <div class="absolute inset-0 opacity-20" style="background-image:radial-gradient(circle at 20% 20%, #43b587 0, transparent 35%), radial-gradient(circle at 85% 80%, #c9a227 0, transparent 35%);"></div>
  <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-masjid-600/30 blur-3xl"></div>
  <div class="absolute -bottom-24 -right-16 w-80 h-80 rounded-full bg-gold-500/20 blur-3xl"></div>

  <div class="relative z-10 w-full max-w-4xl grid md:grid-cols-2 bg-white/95 backdrop-blur rounded-3xl shadow-2xl overflow-hidden">

    <!-- Panel Kiri Info Masjid -->
    <div class="hidden md:flex flex-col justify-between bg-gradient-to-br from-masjid-700 to-masjid-900 text-white p-10 pola-masjid relative">
      <div>
        <div class="text-4xl mb-3">🕌</div>
        <h2 class="text-2xl font-bold leading-snug">Masjid Nurul Ikhsan</h2>
        <p class="text-gold-300 text-sm font-medium">Jakarta Barat</p>
      </div>
      <div>
        <h3 class="text-xl font-bold mb-2">Sistem Pendukung Keputusan</h3>
        <p class="text-sm text-masjid-100 leading-relaxed">Penerimaan Zakat berbasis metode <span class="text-gold-300 font-semibold">Analytical Hierarchy Process (AHP)</span> — membantu panitia menentukan penerima zakat secara objektif, transparan, dan tepat sasaran.</p>
      </div>
      <p class="text-xs text-masjid-300">&copy; <?= date('Y') ?> Panitia Zakat &mdash; Barakallahu fiikum</p>
    </div>

    <!-- Panel Form Login -->
    <div class="p-8 md:p-10 fade-in">
      <div class="md:hidden text-center mb-6">
        <div class="text-3xl">🕌</div>
        <h2 class="font-bold text-masjid-800">Masjid Nurul Ikhsan</h2>
      </div>
      <h1 class="text-2xl font-bold text-masjid-800 mb-1">Masuk ke Sistem</h1>
      <p class="text-sm text-slate-400 mb-6">Silakan masuk menggunakan akun panitia zakat Anda.</p>

      <?php if ($error): ?>
        <div class="bg-red-50 border border-red-300 text-red-700 text-sm rounded-xl px-4 py-3 mb-4"><?= $error ?></div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="text-sm font-medium text-slate-600">Username</label>
          <input type="text" name="username" required autofocus
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 focus:border-masjid-500 outline-none transition"
            placeholder="Masukkan username">
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">Kata Sandi</label>
          <input type="password" name="password" required
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 focus:border-masjid-500 outline-none transition"
            placeholder="Masukkan kata sandi">
        </div>
        <button type="submit"
          class="w-full bg-gradient-to-r from-masjid-600 to-masjid-700 hover:from-masjid-700 hover:to-masjid-800 text-white font-semibold py-2.5 rounded-xl shadow-soft transition">
          Masuk
        </button>
      </form>

      <p class="text-center text-sm text-slate-500 mt-6">
        Belum punya akun? <a href="register.php" class="text-masjid-600 font-semibold hover:underline">Daftar di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
