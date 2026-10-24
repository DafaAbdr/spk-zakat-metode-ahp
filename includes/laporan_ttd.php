<?php
/**
 * Blok tanda tangan resmi (formal) untuk laporan.
 * HANYA tampil saat dicetak (class "print-only") — tidak ditampilkan di layar website.
 * Diberi pengaman "hindari terpotong halaman" agar seluruh blok tanda tangan selalu
 * berada dalam satu halaman cetak yang sama, tidak terbelah ke halaman berikutnya.
 *
 * Variabel opsional yang bisa disiapkan sebelum include:
 *   $labelKiri   (string) - jabatan penandatangan kiri, default "Ketua DKM Masjid Nurul Ikhsan"
 *   $labelKanan  (string) - jabatan penandatangan kanan, default "Ketua Panitia Zakat"
 */
$labelKiri  = $labelKiri  ?? 'Ketua DKM Masjid Nurul Ikhsan';
$labelKanan = $labelKanan ?? 'Ketua Panitia Zakat';
?>
<div class="print-only" style="display:none; page-break-inside: avoid; break-inside: avoid;">
  <div class="grid grid-cols-2 gap-10 mt-14 text-sm font-serif">
    <div class="text-center">
      <p>Mengetahui,</p>
      <p><?= bersihkan($labelKiri) ?></p>
      <div class="h-24"></div>
      <p class="font-semibold underline">( ..................................... )</p>
    </div>
    <div class="text-center">
      <p>Jakarta, <?= formatTanggalIndoLengkap(date('Y-m-d')) ?></p>
      <p><?= bersihkan($labelKanan) ?></p>
      <div class="h-24"></div>
      <p class="font-semibold underline">( ..................................... )</p>
    </div>
  </div>
</div>
