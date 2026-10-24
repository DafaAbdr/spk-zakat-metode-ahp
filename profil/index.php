<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$stmt = $koneksi->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'update_profil') {
        $nama = bersihkan($_POST['nama_lengkap']);
        $email = bersihkan($_POST['email']);
        $noHp = bersihkan($_POST['no_hp']);

        if ($nama === '' || $email === '') {
            setFlash('danger', 'Nama dan email wajib diisi.');
        } else {
            $namaFoto = uploadFotoProfil('foto', $user['foto']);
            $up = $koneksi->prepare("UPDATE users SET nama_lengkap=:nama, email=:email, no_hp=:hp, foto=:foto WHERE id=:id");
            $up->execute(['nama' => $nama, 'email' => $email, 'hp' => $noHp, 'foto' => $namaFoto, 'id' => $_SESSION['user_id']]);
            $_SESSION['nama_lengkap'] = $nama;
            $_SESSION['foto'] = $namaFoto;
            setFlash('success', 'Profil berhasil diperbarui.');
        }
        header('Location: index.php');
        exit;
    }

    if ($aksi === 'ubah_password') {
        $lama = $_POST['password_lama'] ?? '';
        $baru = $_POST['password_baru'] ?? '';
        $konfirmasi = $_POST['konfirmasi_password'] ?? '';

        if (!password_verify($lama, $user['password'])) {
            setFlash('danger', 'Kata sandi lama tidak sesuai.');
        } elseif (strlen($baru) < 6) {
            setFlash('danger', 'Kata sandi baru minimal 6 karakter.');
        } elseif ($baru !== $konfirmasi) {
            setFlash('danger', 'Konfirmasi kata sandi baru tidak cocok.');
        } else {
            $hash = password_hash($baru, PASSWORD_DEFAULT);
            $koneksi->prepare("UPDATE users SET password=:p WHERE id=:id")->execute(['p' => $hash, 'id' => $_SESSION['user_id']]);
            setFlash('success', 'Kata sandi berhasil diubah.');
        }
        header('Location: index.php');
        exit;
    }
}

$judulHalaman = 'Profil Saya';
$menuAktif = '';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="grid lg:grid-cols-3 gap-6">
  <!-- Kartu Foto -->
  <div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 text-center fade-in">
    <img src="../assets/uploads/profil/<?= bersihkan($user['foto']) ?>" onerror="this.src='../assets/img/default-avatar.svg'"
      class="w-28 h-28 rounded-full object-cover ring-4 ring-gold-200 mx-auto shadow-soft">
    <h3 class="font-bold text-masjid-800 mt-4"><?= bersihkan($user['nama_lengkap']) ?></h3>
    <p class="text-sm text-slate-400">@<?= bersihkan($user['username']) ?></p>
    <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-masjid-50 text-masjid-700 capitalize"><?= bersihkan($user['role']) ?></span>
    <p class="text-xs text-slate-400 mt-4">Bergabung sejak <?= formatTanggalIndo($user['created_at']) ?></p>
  </div>

  <!-- Form Update Profil & Password -->
  <div class="lg:col-span-2 space-y-6">
    <div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 fade-in">
      <h3 class="font-bold text-masjid-800 mb-4">Ubah Profil</h3>
      <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="aksi" value="update_profil">
        <div>
          <label class="text-sm font-medium text-slate-600">Foto Profil</label>
          <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp"
            class="mt-1 w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-masjid-50 file:text-masjid-700 file:font-medium hover:file:bg-masjid-100">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="text-sm font-medium text-slate-600">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?= bersihkan($user['nama_lengkap']) ?>" required
              class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
          </div>
          <div>
            <label class="text-sm font-medium text-slate-600">Email</label>
            <input type="email" name="email" value="<?= bersihkan($user['email']) ?>" required
              class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
          </div>
        </div>
        <div>
          <label class="text-sm font-medium text-slate-600">No. HP</label>
          <input type="text" name="no_hp" value="<?= bersihkan($user['no_hp']) ?>"
            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <button type="submit" class="bg-masjid-600 hover:bg-masjid-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-soft">Simpan Perubahan</button>
      </form>
    </div>

    <div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 fade-in">
      <h3 class="font-bold text-masjid-800 mb-4">Ubah Kata Sandi</h3>
      <form method="POST" class="space-y-4">
        <input type="hidden" name="aksi" value="ubah_password">
        <div>
          <label class="text-sm font-medium text-slate-600">Kata Sandi Lama</label>
          <input type="password" name="password_lama" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="text-sm font-medium text-slate-600">Kata Sandi Baru</label>
            <input type="password" name="password_baru" required minlength="6" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
          </div>
          <div>
            <label class="text-sm font-medium text-slate-600">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="konfirmasi_password" required minlength="6" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-masjid-400 outline-none">
          </div>
        </div>
        <button type="submit" class="bg-gold-500 hover:bg-gold-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-soft">Ubah Kata Sandi</button>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
