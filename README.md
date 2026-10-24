# Sistem Pendukung Keputusan Penerimaan Zakat — Metode AHP
### Masjid Nurul Ikhsan, Jakarta Barat

Aplikasi web PHP native (tanpa framework) untuk membantu panitia zakat menentukan
penerima zakat secara objektif menggunakan metode **Analytical Hierarchy Process (AHP)**.

---

## ✨ Fitur Utama

- 🔐 **Login & Register** pengguna, lengkap dengan **upload foto profil**
- 📋 **Master Kriteria** (5 kriteria): Penghasilan, Jumlah Tanggungan, Kondisi Rumah, Pekerjaan, Tingkat Kebutuhan
- 🧩 **Master Sub Kriteria** untuk tiap kriteria (kategori penilaian + bobot)
- ⚖️ **Perbandingan berpasangan kriteria** (matriks Saaty 1–9) — pilihan tersimpan otomatis tampil kembali sesuai isian terakhir
- 🧮 **Perhitungan otomatis bobot AHP** (eigen vector, λ maks, CI, RI, CR) + uji konsistensi — hasil tetap tersimpan & tampil setiap dibuka, tidak hilang/reset
- 🧑‍🤝‍🧑 **Data Zakat**: Data Pemohon (tanpa foto), Proses Perankingan (satu kali proses berbasis kuota — proses ulang otomatis menghapus hasil lama), dan Hasil Perankingan (tampil otomatis setelah diproses)
- 🖨️ **Laporan resmi terpadu** (1 menu, 4 jenis dokumen dipilih lewat tab): Data Pemohon (format landscape lengkap dengan nilai tiap kriteria), Matriks & Bobot AHP, Hasil Ranking, dan Surat Keputusan Penerima Zakat — dengan kop surat resmi, tabel formal, dan blok tanda tangan
- 🗄️ Database **relasional penuh** (foreign key di semua tabel terkait)
- 🎨 Desain modern bertema masjid (hijau emerald + emas), responsif mobile

---

## 🛠️ Kebutuhan Sistem

- PHP 8.0+ dengan ekstensi **PDO MySQL** (`pdo_mysql`)
- MySQL / MariaDB 5.7+
- Web server (Apache/Nginx) atau bisa langsung pakai PHP built-in server

---

## 🚀 Cara Instalasi

### 1. Import Database
Buat database baru lalu import file `database.sql` (sudah termasuk 5 kriteria,
20 sub kriteria, dan 1 akun admin default):

```bash
mysql -u root -p < database.sql
```

Atau melalui phpMyAdmin: buat database `zakat_ahp`, lalu import `database.sql`.

**(Opsional) Import Data Contoh 107 Pemohon**
Untuk langsung mencoba sistem dengan data yang realistis, import juga file
`data_pemohon_sample.sql` (setelah `database.sql`). File ini berisi **107 data
pemohon** lengkap dengan NIK, alamat di wilayah Jakarta Barat, dan penilaian
5 kriteria yang sudah terisi penuh untuk setiap pemohon — siap langsung
diproses ke menu **Proses Perankingan**.

```bash
mysql -u root -p zakat_ahp < data_pemohon_sample.sql
```

Atau melalui phpMyAdmin: pilih database `zakat_ahp`, lalu import `data_pemohon_sample.sql`.

### 2. Konfigurasi Koneksi Database
Edit file `config/database.php` sesuai kredensial MySQL Anda:

```php
$DB_HOST = 'localhost';
$DB_NAME = 'zakat_ahp';
$DB_USER = 'root';
$DB_PASS = '';
```

### 3. Set Izin Folder Upload
Pastikan folder berikut dapat ditulis oleh web server:

```bash
chmod -R 755 assets/uploads/profil
```

### 4. Jalankan Aplikasi

**Menggunakan PHP built-in server (untuk testing cepat):**
```bash
php -S localhost:8000
```
Lalu buka `http://localhost:8000/auth/login.php`

**Menggunakan XAMPP/Laragon/Apache:**
Salin seluruh folder ke `htdocs` (XAMPP) atau `www` (Laragon), lalu akses
melalui `http://localhost/spk-zakat-ahp/auth/login.php`

---

## 🔑 Akun Default

| Username | Password  | Role  |
|----------|-----------|-------|
| admin    | admin123  | admin |

Panitia baru dapat mendaftar sendiri melalui halaman **Register** (role otomatis: `panitia`).

---

## 🩹 Troubleshooting: Halaman "Not Found" (404) saat klik menu/logout

Jika setelah login Anda mengklik menu apa saja (misalnya tombol **Logout**) dan muncul
halaman **"Not Found"**, penyebabnya adalah folder project Anda tidak persis di root
`htdocs`, dan server belum bisa mendeteksi otomatis di folder mana project berada.

Sistem sudah dilengkapi deteksi otomatis, namun sebagai jaminan 100% berhasil, Anda bisa
mengisi **secara manual**:

1. Buka file `includes/functions.php`
2. Cari baris berikut di bagian atas file:
   ```php
   $GLOBALS['APP_BASE_URL_OVERRIDE'] = null;
   ```
3. Ganti `null` sesuai lokasi project Anda:
   - Jika project ada di `htdocs/spk-zakat-ahp/` → isi `'/spk-zakat-ahp/'`
   - Jika project ada di `htdocs/` langsung (root) → isi `'/'`
   - Jika project ada di `htdocs/masjid/zakat/` → isi `'/masjid/zakat/'`

   Contoh:
   ```php
   $GLOBALS['APP_BASE_URL_OVERRIDE'] = '/spk-zakat-ahp/';
   ```
4. Simpan file, lalu refresh browser (bisa perlu hapus cache/hard refresh `Ctrl+Shift+R`).

**Cara mengetahui nilai yang tepat:** lihat alamat URL saat Anda membuka halaman login,
misalnya `http://localhost/spk-zakat-ahp/auth/login.php` → nilainya adalah
`/spk-zakat-ahp/` (bagian antara host dan `auth/login.php`).

---

## 📖 Alur Penggunaan Sistem

1. **Login/Register** — masuk ke sistem
2. **Kriteria** — pastikan 5 kriteria sudah sesuai kebutuhan (sudah terisi default)
3. **Sub Kriteria** — sesuaikan kategori & bobot tiap kriteria bila perlu
4. **Perbandingan Kriteria** — isi tingkat kepentingan tiap pasangan kriteria (skala Saaty 1–9)
5. **Hitung Bobot AHP** — klik proses, sistem otomatis menghitung bobot prioritas & menguji konsistensi (CR harus ≤ 0,1). Hasil tersimpan permanen dan tetap tampil setiap menu ini dibuka.
6. **Data Pemohon** — input data calon penerima zakat beserta penilaian sub kriterianya
7. **Proses Perankingan** — cukup masukkan jumlah kuota penerima, lalu proses. Ini adalah proses satu kali; menjalankan ulang akan menghapus hasil sebelumnya dan menggantinya dengan hasil baru.
8. **Hasil Perankingan** — otomatis menampilkan hasil setelah diproses (menu Data Zakat)
9. **Laporan** — satu menu terpadu berisi 4 jenis dokumen resmi yang bisa dipilih dan dicetak: Data Pemohon, Matriks AHP, Hasil Ranking, dan Surat Keputusan Penerima Zakat

---

## 🗂️ Struktur Folder

```
spk-zakat-ahp/
├── auth/                 → login.php, register.php, logout.php
├── config/               → database.php (koneksi PDO)
├── includes/             → header.php, header_laporan.php (tanpa topbar), sidebar.php, footer.php,
│                            functions.php, laporan_kop.php & laporan_ttd.php (komponen surat resmi)
├── kriteria/              → CRUD kriteria
├── subkriteria/           → CRUD sub kriteria
├── pemohon/               → CRUD pemohon + penilaian sub kriteria
├── ahp/                   → perbandingan_kriteria.php, hitung_kriteria.php,
│                            hitung_akhir.php (proses ranking), hasil_perankingan.php
├── laporan/                → index.php (1 halaman, 4 jenis laporan via pilihan tab)
├── profil/                → edit profil & ganti password
├── assets/
│   ├── css/style.css
│   ├── img/default-avatar.svg
│   └── uploads/profil/    → foto pengguna hasil upload
├── database.sql
├── data_pemohon_sample.sql → (opsional) 107 data contoh pemohon siap pakai
└── index.php              → dashboard
```

---

## 📐 Metode Perhitungan AHP yang Digunakan

1. Matriks perbandingan berpasangan kriteria (n×n) dari input skala Saaty
2. Normalisasi kolom → rata-rata baris = **bobot prioritas (eigen vector approksimasi)**
3. **λ maks** = Σ(jumlah kolom × bobot)
4. **CI** (Consistency Index) = (λ maks − n) / (n − 1)
5. **CR** (Consistency Ratio) = CI / RI — matriks dianggap **konsisten** jika CR ≤ 0,1
6. Skor akhir tiap pemohon = Σ (bobot kriteria × nilai sub kriteria yang dipilih)
7. Pemohon diurutkan berdasarkan skor tertinggi → ranking → status Diterima/Ditolak

---

*Dibuat untuk Masjid Nurul Ikhsan, Jakarta Barat — Barakallahu fiikum.* 🕌
