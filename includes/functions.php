<?php
/**
 * Kumpulan fungsi bantuan (helper) global
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Bersihkan input dari user */
function bersihkan($data) {
    return htmlspecialchars(trim($data ?? ''), ENT_QUOTES, 'UTF-8');
}

/** Cek apakah user sudah login */
function isLogin() {
    return isset($_SESSION['user_id']);
}

/** Wajibkan login, redirect ke login jika belum */
function wajibLogin() {
    if (!isLogin()) {
        header('Location: ' . basePath() . 'auth/login.php');
        exit;
    }
}

/** Wajibkan role admin */
function wajibAdmin() {
    wajibLogin();
    if ($_SESSION['role'] !== 'admin') {
        setFlash('danger', 'Anda tidak memiliki akses ke halaman tersebut.');
        header('Location: ' . basePath() . 'index.php');
        exit;
    }
}

// =====================================================================
// OVERRIDE MANUAL BASE PATH (opsional)
// Jika setelah upload ke server ternyata link/tombol masih "Not Found",
// isi baris di bawah ini secara manual sesuai folder project Anda, lalu
// simpan. Ini akan melewati deteksi otomatis dan dijamin akurat.
//
// Contoh jika project ada di: htdocs/spk-zakat-ahp/  -> isi '/spk-zakat-ahp/'
// Contoh jika project langsung di: htdocs/ (root)    -> isi '/'
// Biarkan null jika ingin memakai deteksi otomatis.
// =====================================================================
$GLOBALS['APP_BASE_URL_OVERRIDE'] = null;

/** Hitung path relatif (URL) ke root project, otomatis menyesuaikan meskipun project
 *  ditaruh di subfolder (misal htdocs/spk-zakat-ahp/) maupun langsung di root web server.
 *  Menggunakan SCRIPT_FILENAME vs SCRIPT_NAME (bukan DOCUMENT_ROOT) agar tetap akurat
 *  di XAMPP/Windows yang sering bermasalah dengan perbedaan huruf besar/kecil pada path. */
function basePath() {
    static $base = null;
    if ($base !== null) return $base;

    if (!empty($GLOBALS['APP_BASE_URL_OVERRIDE'])) {
        $base = $GLOBALS['APP_BASE_URL_OVERRIDE'];
        if (substr($base, -1) !== '/') $base .= '/';
        return $base;
    }

    $base = '/'; // fallback aman

    if (!empty($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_NAME'])) {
        $projectRoot = realpath(__DIR__ . '/..');
        // Tidak pakai realpath() di sini karena beberapa konfigurasi server (mis. simlink,
        // open_basedir) bisa membuatnya gagal walau file sebenarnya valid.
        $scriptFile  = $_SERVER['SCRIPT_FILENAME'];

        if ($projectRoot && $scriptFile) {
            $projectRoot = rtrim(str_replace('\\', '/', $projectRoot), '/');
            $scriptFile  = str_replace('\\', '/', $scriptFile);

            // Bandingkan tanpa memandang huruf besar/kecil (penting untuk Windows/XAMPP)
            if (stripos($scriptFile, $projectRoot) === 0) {
                // path file yang sedang dieksekusi, relatif terhadap root project. Contoh: "auth/logout.php"
                $relatif = ltrim(substr($scriptFile, strlen($projectRoot)), '/');
                $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);

                if ($relatif !== '' && strlen($scriptName) >= strlen($relatif)
                    && strtolower(substr($scriptName, -strlen($relatif))) === strtolower($relatif)) {
                    $base = substr($scriptName, 0, strlen($scriptName) - strlen($relatif));
                    if ($base === '') $base = '/';
                    if (substr($base, -1) !== '/') $base .= '/';
                }
            }
        }
    }

    return $base;
}

/** Set pesan flash (notifikasi sekali tampil) */
function setFlash($tipe, $pesan) {
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

/** Tampilkan & hapus pesan flash */
function tampilkanFlash() {
    if (!empty($_SESSION['flash'])) {
        $tipe = $_SESSION['flash']['tipe'];
        $pesan = $_SESSION['flash']['pesan'];
        $warna = [
            'success' => 'bg-emerald-50 text-emerald-800 border-emerald-300',
            'danger'  => 'bg-red-50 text-red-800 border-red-300',
            'warning' => 'bg-amber-50 text-amber-800 border-amber-300',
            'info'    => 'bg-sky-50 text-sky-800 border-sky-300',
        ];
        $kelas = $warna[$tipe] ?? $warna['info'];
        echo '<div class="border rounded-xl px-4 py-3 mb-4 text-sm font-medium ' . $kelas . '" role="alert">' . $pesan . '</div>';
        unset($_SESSION['flash']);
    }
}

/** Format angka ke Rupiah bila diperlukan */
function formatTanggalIndo($tanggal) {
    if (!$tanggal) return '-';
    $bulan = ['', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $ts = strtotime($tanggal);
    return date('d', $ts) . ' ' . $bulan[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

/** Format tanggal Indonesia + nama hari, khusus untuk tanda tangan dokumen resmi.
 *  Contoh hasil: "Minggu, 16 Agustus 2026" */
function formatTanggalIndoLengkap($tanggal) {
    if (!$tanggal) return '-';
    $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    $bulan = ['', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $ts = strtotime($tanggal);
    return $hari[(int)date('w', $ts)] . ', ' . date('d', $ts) . ' ' . $bulan[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

/** Format angka desimal untuk tampilan bobot AHP */
function formatBobot($angka, $desimal = 4) {
    return number_format((float)$angka, $desimal, ',', '.');
}

/** Upload foto profil pengguna, mengembalikan nama file baru atau null jika gagal/tidak ada file */
function uploadFotoProfil($fileInput, $fotoLama = null) {
    if (empty($_FILES[$fileInput]['name'])) {
        return $fotoLama ?: 'default-avatar.png';
    }
    $file = $_FILES[$fileInput];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return $fotoLama ?: 'default-avatar.png';
    }
    $ekstensiDiizinkan = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ekstensi, $ekstensiDiizinkan)) {
        setFlash('danger', 'Format foto harus JPG, JPEG, PNG, atau WEBP.');
        return $fotoLama ?: 'default-avatar.png';
    }
    if ($file['size'] > 2 * 1024 * 1024) {
        setFlash('danger', 'Ukuran foto maksimal 2MB.');
        return $fotoLama ?: 'default-avatar.png';
    }
    $namaBaru = 'user_' . uniqid() . '.' . $ekstensi;
    $tujuan = __DIR__ . '/../assets/uploads/profil/' . $namaBaru;
    if (move_uploaded_file($file['tmp_name'], $tujuan)) {
        if ($fotoLama && $fotoLama !== 'default-avatar.png') {
            $lamaPath = __DIR__ . '/../assets/uploads/profil/' . $fotoLama;
            if (file_exists($lamaPath)) @unlink($lamaPath);
        }
        return $namaBaru;
    }
    return $fotoLama ?: 'default-avatar.png';
}

/** Ambil label badge status hasil akhir */
function badgeStatus($status) {
    $peta = [
        'Diterima' => '<span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Diterima</span>',
        'Ditolak'  => '<span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Ditolak</span>',
        'Menunggu' => '<span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Menunggu</span>',
    ];
    return $peta[$status] ?? $status;
}

/** Nilai Random Index (RI) Saaty untuk uji konsistensi AHP, indeks = jumlah kriteria (n) */
function getRandomIndex($n) {
    $ri = [1 => 0, 2 => 0, 3 => 0.58, 4 => 0.90, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49];
    return $ri[$n] ?? 1.49;
}

/** Ubah angka menjadi kata bilangan Bahasa Indonesia (untuk keperluan surat resmi) */
function terbilang($angka) {
    $angka = (int) abs($angka);
    $satuan = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan',
        'sepuluh', 'sebelas'];

    if ($angka < 12) {
        return $satuan[$angka];
    } elseif ($angka < 20) {
        return terbilang($angka - 10) . ' belas';
    } elseif ($angka < 100) {
        return terbilang(intdiv($angka, 10)) . ' puluh' . ($angka % 10 !== 0 ? ' ' . terbilang($angka % 10) : '');
    } elseif ($angka < 200) {
        return 'seratus' . ($angka - 100 !== 0 ? ' ' . terbilang($angka - 100) : '');
    } elseif ($angka < 1000) {
        return terbilang(intdiv($angka, 100)) . ' ratus' . ($angka % 100 !== 0 ? ' ' . terbilang($angka % 100) : '');
    } elseif ($angka < 2000) {
        return 'seribu' . ($angka - 1000 !== 0 ? ' ' . terbilang($angka - 1000) : '');
    } elseif ($angka < 1000000) {
        return terbilang(intdiv($angka, 1000)) . ' ribu' . ($angka % 1000 !== 0 ? ' ' . terbilang($angka % 1000) : '');
    }
    return (string) $angka;
}
