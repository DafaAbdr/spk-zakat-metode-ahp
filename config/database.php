<?php
/**
 * Koneksi Database - SPK Penerimaan Zakat Metode AHP
 * Masjid Nurul Ikhsan Jakarta Barat
 */

$DB_HOST = 'localhost';
$DB_NAME = 'zakat_ahp';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $koneksi = new PDO(
        "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('<div style="font-family:sans-serif;padding:30px;color:#b91c1c;background:#fef2f2;border:1px solid #fca5a5;border-radius:8px;margin:30px;">
        <h2>Koneksi Database Gagal</h2>
        <p>Pastikan MySQL sudah aktif dan database <b>zakat_ahp</b> sudah diimport dari file <code>database.sql</code>.</p>
        <p style="font-size:13px;color:#7f1d1d;">Detail: ' . htmlspecialchars($e->getMessage()) . '</p>
        </div>');
}
