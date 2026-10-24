-- =========================================================
-- DATABASE: SPK PENERIMAAN ZAKAT - METODE AHP
-- Masjid Nurul Ikhsan Jakarta Barat
-- =========================================================

CREATE DATABASE IF NOT EXISTS zakat_ahp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE zakat_ahp;

-- =========================================================
-- TABEL USERS (Login & Register + Foto Pengguna)
-- =========================================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    no_hp VARCHAR(20) DEFAULT NULL,
    foto VARCHAR(255) DEFAULT 'default-avatar.png',
    role ENUM('admin','panitia') NOT NULL DEFAULT 'panitia',
    status ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================================================
-- TABEL KRITERIA (5 Kriteria AHP)
-- =========================================================
CREATE TABLE kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_kriteria VARCHAR(10) NOT NULL UNIQUE,
    nama_kriteria VARCHAR(100) NOT NULL,
    keterangan TEXT DEFAULT NULL,
    bobot_prioritas DECIMAL(10,5) NOT NULL DEFAULT 0,
    created_by INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_kriteria_user FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- =========================================================
-- TABEL SUB KRITERIA (Anak dari Kriteria)
-- =========================================================
CREATE TABLE sub_kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kriteria_id INT NOT NULL,
    nama_sub_kriteria VARCHAR(150) NOT NULL,
    nilai_bobot DECIMAL(10,5) NOT NULL COMMENT 'Skor 0.1 - 1.0, makin tinggi makin berhak menerima',
    keterangan TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_subkriteria_kriteria FOREIGN KEY (kriteria_id) REFERENCES kriteria(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =========================================================
-- TABEL PERBANDINGAN KRITERIA (Matriks Pairwise AHP)
-- =========================================================
CREATE TABLE perbandingan_kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kriteria_a_id INT NOT NULL,
    kriteria_b_id INT NOT NULL,
    nilai DECIMAL(10,5) NOT NULL COMMENT 'Skala Saaty 1/9 - 9, seberapa penting A dibanding B',
    dihitung_oleh INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_pk_kriteria_a FOREIGN KEY (kriteria_a_id) REFERENCES kriteria(id) ON DELETE CASCADE,
    CONSTRAINT fk_pk_kriteria_b FOREIGN KEY (kriteria_b_id) REFERENCES kriteria(id) ON DELETE CASCADE,
    CONSTRAINT fk_pk_user FOREIGN KEY (dihitung_oleh) REFERENCES users(id) ON DELETE SET NULL,
    UNIQUE KEY unik_pasangan (kriteria_a_id, kriteria_b_id)
) ENGINE=InnoDB;

-- =========================================================
-- TABEL RIWAYAT HITUNG AHP KRITERIA (log konsistensi)
-- =========================================================
CREATE TABLE riwayat_hitung_ahp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jumlah_kriteria INT NOT NULL,
    lambda_maks DECIMAL(10,5) NOT NULL,
    ci DECIMAL(10,5) NOT NULL,
    ri DECIMAL(10,5) NOT NULL,
    cr DECIMAL(10,5) NOT NULL,
    status_konsisten ENUM('Konsisten','Tidak Konsisten') NOT NULL,
    dihitung_oleh INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_riwayat_user FOREIGN KEY (dihitung_oleh) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- =========================================================
-- TABEL PEMOHON / CALON PENERIMA ZAKAT (Tanpa Foto)
-- =========================================================
CREATE TABLE pemohon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P') NOT NULL,
    tempat_lahir VARCHAR(50) DEFAULT NULL,
    tanggal_lahir DATE DEFAULT NULL,
    alamat TEXT NOT NULL,
    no_hp VARCHAR(20) DEFAULT NULL,
    status_pernikahan VARCHAR(30) DEFAULT NULL,
    input_oleh INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_pemohon_user FOREIGN KEY (input_oleh) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- =========================================================
-- TABEL PENILAIAN PEMOHON (Relasi Pemohon - Kriteria - SubKriteria)
-- =========================================================
CREATE TABLE penilaian_pemohon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pemohon_id INT NOT NULL,
    kriteria_id INT NOT NULL,
    sub_kriteria_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_penilaian_pemohon FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE,
    CONSTRAINT fk_penilaian_kriteria FOREIGN KEY (kriteria_id) REFERENCES kriteria(id) ON DELETE CASCADE,
    CONSTRAINT fk_penilaian_subkriteria FOREIGN KEY (sub_kriteria_id) REFERENCES sub_kriteria(id) ON DELETE CASCADE,
    UNIQUE KEY unik_penilaian (pemohon_id, kriteria_id)
) ENGINE=InnoDB;

-- =========================================================
-- TABEL HASIL AKHIR AHP (Ranking & Keputusan)
-- =========================================================
CREATE TABLE hasil_akhir (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pemohon_id INT NOT NULL,
    total_nilai DECIMAL(10,5) NOT NULL,
    ranking INT NOT NULL,
    status ENUM('Diterima','Ditolak','Menunggu') NOT NULL DEFAULT 'Menunggu',
    periode VARCHAR(20) NOT NULL COMMENT 'contoh: 2026-Ramadhan',
    dihitung_oleh INT DEFAULT NULL,
    tanggal_hitung TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_hasil_pemohon FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE,
    CONSTRAINT fk_hasil_user FOREIGN KEY (dihitung_oleh) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- =========================================================
-- DATA AWAL: 5 KRITERIA SESUAI PERMINTAAN
-- =========================================================
INSERT INTO kriteria (kode_kriteria, nama_kriteria, keterangan, bobot_prioritas) VALUES
('K1', 'Penghasilan', 'Tingkat penghasilan bulanan calon penerima zakat', 0),
('K2', 'Jumlah Tanggungan', 'Jumlah anggota keluarga yang menjadi tanggungan', 0),
('K3', 'Kondisi Rumah', 'Kondisi fisik tempat tinggal calon penerima', 0),
('K4', 'Pekerjaan', 'Status/jenis pekerjaan calon penerima', 0),
('K5', 'Tingkat Kebutuhan', 'Tingkat urgensi/kebutuhan calon penerima terhadap bantuan', 0);

-- =========================================================
-- DATA AWAL: SUB KRITERIA
-- =========================================================
-- Sub Kriteria untuk Penghasilan (K1)
INSERT INTO sub_kriteria (kriteria_id, nama_sub_kriteria, nilai_bobot, keterangan) VALUES
(1, '< Rp 500.000', 1.00, 'Sangat rendah'),
(1, 'Rp 500.000 - Rp 1.500.000', 0.75, 'Rendah'),
(1, 'Rp 1.500.001 - Rp 3.000.000', 0.50, 'Sedang'),
(1, '> Rp 3.000.000', 0.25, 'Tinggi');

-- Sub Kriteria untuk Jumlah Tanggungan (K2)
INSERT INTO sub_kriteria (kriteria_id, nama_sub_kriteria, nilai_bobot, keterangan) VALUES
(2, '> 5 orang', 1.00, 'Sangat banyak'),
(2, '4 - 5 orang', 0.75, 'Banyak'),
(2, '2 - 3 orang', 0.50, 'Sedang'),
(2, '0 - 1 orang', 0.25, 'Sedikit');

-- Sub Kriteria untuk Kondisi Rumah (K3)
INSERT INTO sub_kriteria (kriteria_id, nama_sub_kriteria, nilai_bobot, keterangan) VALUES
(3, 'Tidak Layak Huni', 1.00, 'Sangat memprihatinkan'),
(3, 'Semi Permanen', 0.70, 'Kurang layak'),
(3, 'Permanen Sederhana', 0.40, 'Cukup layak'),
(3, 'Permanen Baik', 0.20, 'Layak');

-- Sub Kriteria untuk Pekerjaan (K4)
INSERT INTO sub_kriteria (kriteria_id, nama_sub_kriteria, nilai_bobot, keterangan) VALUES
(4, 'Tidak Bekerja', 1.00, 'Tidak memiliki penghasilan tetap'),
(4, 'Buruh Serabutan', 0.75, 'Penghasilan tidak menentu'),
(4, 'Wiraswasta Kecil', 0.50, 'Penghasilan menengah'),
(4, 'Karyawan/PNS', 0.25, 'Penghasilan tetap');

-- Sub Kriteria untuk Tingkat Kebutuhan (K5)
INSERT INTO sub_kriteria (kriteria_id, nama_sub_kriteria, nilai_bobot, keterangan) VALUES
(5, 'Sangat Membutuhkan', 1.00, 'Prioritas utama'),
(5, 'Membutuhkan', 0.70, 'Prioritas tinggi'),
(5, 'Cukup Membutuhkan', 0.40, 'Prioritas sedang'),
(5, 'Kurang Membutuhkan', 0.20, 'Prioritas rendah');

-- =========================================================
-- DATA AWAL: USER ADMIN DEFAULT
-- Username : admin | Password : admin123
-- (Hash berikut sudah diverifikasi valid untuk password 'admin123')
-- =========================================================
INSERT INTO users (username, password, nama_lengkap, email, foto, role) VALUES
('admin', '$2y$10$rE3FccZTxGfrVcXmFMWDuuhhgElwUgfEWWW38QjjAIYEQQler3HYS', 'Administrator Masjid', 'admin@masjidnurulikhsan.id', 'default-avatar.png', 'admin');
-- Catatan: Anda juga bisa membuat akun baru melalui halaman Register pada aplikasi.
