<?php
/**
 * Kop surat resmi untuk laporan (dokumen formal).
 * HANYA tampil saat dicetak (class "print-only") — di layar website tidak ditampilkan,
 * sesuai permintaan agar tampilan web murni berisi judul laporan & data saja.
 *
 * Variabel yang harus disiapkan oleh halaman pemanggil sebelum include:
 *   $judulLaporan   (string) - judul laporan, contoh: "LAPORAN DATA PEMOHON ZAKAT"
 *   $subJudul       (string, opsional) - info tambahan di bawah judul, contoh periode
 */
?>
<div class="print-only" style="display:none;">
  <div class="border-b-4 border-double border-black pb-4 mb-6 font-serif">
    <table class="w-full">
      <tr>
        <td class="w-20 align-top">
          <div class="w-16 h-16 rounded-full border-2 border-masjid-800 mx-auto overflow-hidden bg-white">
            <img src="<?= basePath() ?>assets/img/logo-masjid.jpg" alt="Logo Masjid Nurul Ikhsan" style="width:100%;height:100%;object-fit:cover;">
          </div>
        </td>
        <td class="text-center align-top">
          <p class="text-xl font-bold tracking-wide uppercase">Masjid Nurul Ikhsan</p>
          <p class="text-sm">Jelambar Selatan 17, RT.1/RW.9, Jelambar Baru, Kec. Grogol Petamburan,</p>
          <p class="text-sm">Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11460, Indonesia</p>
          <p class="text-xs text-slate-600">Telepon: 0813 1298 0123 &bull; Surel: masjidnurulikhsan@gmail.com</p>
        </td>
        <td class="w-20"></td>
      </tr>
    </table>
  </div>

  <div class="text-center mb-6 font-serif">
    <h1 class="text-base font-bold underline uppercase tracking-wide"><?= bersihkan($judulLaporan ?? '') ?></h1>
    <?php if (!empty($subJudul)): ?>
      <p class="text-sm mt-1"><?= $subJudul ?></p>
    <?php endif; ?>
  </div>
</div>
