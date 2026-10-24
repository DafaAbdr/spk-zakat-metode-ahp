<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$jenisValid = ['pemohon', 'matriks', 'ranking', 'penerima'];
$jenis = $_GET['jenis'] ?? 'pemohon';
if (!in_array($jenis, $jenisValid, true)) $jenis = 'pemohon';

$daftarJenis = [
    'pemohon'  => ['label' => 'Data Pemohon',        'ikon' => '📄'],
    'matriks'  => ['label' => 'Matriks & Bobot AHP', 'ikon' => '📊'],
    'ranking'  => ['label' => 'Hasil Ranking',        'ikon' => '📈'],
    'penerima' => ['label' => 'Penerima Zakat',       'ikon' => '✅'],
];

// Landscape khusus untuk laporan Data Pemohon karena kolomnya banyak
$ekstraHead = ($jenis === 'pemohon') ? '<style>@page{size:landscape;margin:14mm;}</style>' : '<style>@page{margin:18mm;}</style>';

$judulHalaman = 'Laporan — ' . $daftarJenis[$jenis]['label'];
$menuAktif = 'laporan';
require_once __DIR__ . '/../includes/header_laporan.php';

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY id ASC")->fetchAll();
?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-5 no-print">
  <div>
    <h2 class="text-lg font-bold text-masjid-800">Laporan &mdash; <?= bersihkan($daftarJenis[$jenis]['label']) ?></h2>
    <p class="text-sm text-slate-400">Pilih jenis laporan resmi yang ingin dilihat atau dicetak.</p>
  </div>
  <button onclick="window.print()" class="bg-gold-500 hover:bg-gold-600 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-soft">🖨️ Cetak Laporan</button>
</div>

<!-- Selector jenis laporan -->
<div class="flex flex-wrap gap-2 mb-6 no-print">
  <?php foreach ($daftarJenis as $key => $info): ?>
    <a href="?jenis=<?= $key ?>" class="px-4 py-2.5 rounded-xl text-sm font-semibold transition <?= $jenis === $key ? 'bg-masjid-600 text-white shadow-soft' : 'bg-white text-slate-600 border border-masjid-100 hover:bg-masjid-50' ?>">
      <?= $info['ikon'] ?> <?= $info['label'] ?>
    </a>
  <?php endforeach; ?>
</div>

<div class="bg-white shadow-soft border border-slate-200 p-8 md:p-12 print-area laporan-formal fade-in">

<?php if ($jenis === 'pemohon'):
    $daftarPemohon = $koneksi->query("SELECT * FROM pemohon ORDER BY nama ASC")->fetchAll();
    // Ambil semua penilaian sekaligus, dikelompokkan per pemohon -> kriteria_id -> nama_sub_kriteria
    $semuaPenilaian = $koneksi->query("SELECT pp.pemohon_id, pp.kriteria_id, sk.nama_sub_kriteria
        FROM penilaian_pemohon pp JOIN sub_kriteria sk ON sk.id = pp.sub_kriteria_id")->fetchAll();
    $penilaianMap = [];
    foreach ($semuaPenilaian as $pn) {
        $penilaianMap[$pn['pemohon_id']][$pn['kriteria_id']] = $pn['nama_sub_kriteria'];
    }
    $judulLaporan = 'LAPORAN DATA PEMOHON ZAKAT';
    $subJudul = 'Tahun ' . date('Y');
    require __DIR__ . '/../includes/laporan_kop.php';
    ?>
    <p class="text-sm mb-4 font-serif">
      Berikut adalah daftar seluruh calon penerima zakat beserta hasil penilaian kriteria yang
      terdaftar dalam Sistem Pendukung Keputusan Penerimaan Zakat Masjid Nurul Ikhsan per tanggal
      <?= formatTanggalIndo(date('Y-m-d')) ?>.
    </p>
    <table class="w-full text-[10px] tabel-formal tabel-padat" style="table-layout: fixed; word-wrap: break-word;">
      <colgroup>
        <col style="width:3%">
        <col style="width:9%">
        <col style="width:11%">
        <col style="width:3%">
        <col style="width:18%">
        <col style="width:8%">
        <?php
          $sisaPersen = 100 - (3+9+11+3+18+8);
          $jmlKriteriaKolom = max(count($daftarKriteria), 1);
          $lebarPerKriteria = round($sisaPersen / $jmlKriteriaKolom, 2);
        ?>
        <?php foreach ($daftarKriteria as $k): ?>
          <col style="width:<?= $lebarPerKriteria ?>%">
        <?php endforeach; ?>
      </colgroup>
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-left">NIK</th>
          <th class="text-left">Nama Lengkap</th>
          <th class="text-center">JK</th>
          <th class="text-left">Alamat</th>
          <th class="text-left">No. HP</th>
          <?php foreach ($daftarKriteria as $k): ?>
            <th class="text-left"><?= bersihkan($k['nama_kriteria']) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarPemohon)): ?>
          <tr><td colspan="<?= 6 + count($daftarKriteria) ?>" class="text-center py-6 text-slate-400">Belum ada data pemohon.</td></tr>
        <?php endif; ?>
        <?php $no = 1; foreach ($daftarPemohon as $p): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= bersihkan($p['nik']) ?></td>
            <td class="font-medium"><?= bersihkan($p['nama']) ?></td>
            <td class="text-center"><?= $p['jenis_kelamin'] === 'L' ? 'L' : 'P' ?></td>
            <td><?= bersihkan($p['alamat']) ?></td>
            <td><?= bersihkan($p['no_hp']) ?: '-' ?></td>
            <?php foreach ($daftarKriteria as $k): ?>
              <td><?= bersihkan($penilaianMap[$p['id']][$k['id']] ?? '-') ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <p class="text-sm mt-4 font-serif">Jumlah pemohon terdaftar: <b><?= count($daftarPemohon) ?> orang</b>.</p>

<?php elseif ($jenis === 'matriks'):
    $ids = array_column($daftarKriteria, 'id');
    $n = count($ids);
    $matriks = [];
    foreach ($ids as $i) foreach ($ids as $j) $matriks[$i][$j] = ($i === $j) ? 1.0 : null;
    $pb = $koneksi->query("SELECT * FROM perbandingan_kriteria")->fetchAll();
    foreach ($pb as $row) {
        $matriks[$row['kriteria_a_id']][$row['kriteria_b_id']] = (float)$row['nilai'];
        $matriks[$row['kriteria_b_id']][$row['kriteria_a_id']] = 1 / (float)$row['nilai'];
    }
    $matriksLengkap = true;
    foreach ($ids as $i) foreach ($ids as $j) if ($matriks[$i][$j] === null) $matriksLengkap = false;
    $riwayatTerakhir = $koneksi->query("SELECT * FROM riwayat_hitung_ahp ORDER BY id DESC LIMIT 1")->fetch();

    $judulLaporan = 'LAPORAN MATRIKS PERBANDINGAN KRITERIA';
    $subJudul = 'Metode Analytical Hierarchy Process (AHP) &mdash; Tahun ' . date('Y');
    require __DIR__ . '/../includes/laporan_kop.php';
    ?>
    <?php if (!$matriksLengkap): ?>
      <p class="text-center text-slate-400 py-8 font-serif">Data perbandingan kriteria belum lengkap.</p>
    <?php else: ?>
      <p class="text-sm mb-4 font-serif">
        Dokumen ini memuat hasil perhitungan bobot prioritas kriteria penerimaan zakat menggunakan
        metode <i>Analytical Hierarchy Process</i> (AHP), berdasarkan matriks perbandingan
        berpasangan yang telah ditetapkan oleh panitia.
      </p>
      <p class="font-bold text-sm mb-2 font-serif">I. Matriks Perbandingan Berpasangan</p>
      <div class="overflow-x-auto mb-6">
        <table class="w-full text-sm tabel-formal text-center">
          <thead>
            <tr>
              <th class="w-32"></th>
              <?php foreach ($daftarKriteria as $k): ?><th><?= bersihkan($k['kode_kriteria']) ?></th><?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($daftarKriteria as $ki): ?>
              <tr>
                <td class="font-semibold text-left bg-slate-50"><?= bersihkan($ki['kode_kriteria'].' - '.$ki['nama_kriteria']) ?></td>
                <?php foreach ($daftarKriteria as $kj): ?>
                  <td><?= formatBobot($matriks[$ki['id']][$kj['id']],3) ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <p class="font-bold text-sm mb-2 font-serif">II. Bobot Prioritas Kriteria</p>
      <table class="w-full text-sm tabel-formal mb-6">
        <thead>
          <tr>
            <th class="text-center w-16">Kode</th>
            <th class="text-left">Nama Kriteria</th>
            <th class="text-center">Bobot Prioritas</th>
            <th class="text-center">Persentase</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($daftarKriteria as $k): ?>
            <tr>
              <td class="text-center"><?= bersihkan($k['kode_kriteria']) ?></td>
              <td class="font-medium"><?= bersihkan($k['nama_kriteria']) ?></td>
              <td class="text-center"><?= formatBobot($k['bobot_prioritas'],5) ?></td>
              <td class="text-center font-semibold"><?= formatBobot($k['bobot_prioritas']*100,2) ?>%</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if ($riwayatTerakhir): ?>
      <p class="font-bold text-sm mb-2 font-serif">III. Uji Konsistensi</p>
      <table class="w-full text-sm tabel-formal mb-4">
        <tbody>
          <tr><td class="bg-slate-50 font-medium w-1/2">Lambda Maks (&lambda; maks)</td><td><?= formatBobot($riwayatTerakhir['lambda_maks'],4) ?></td></tr>
          <tr><td class="bg-slate-50 font-medium">Consistency Index (CI)</td><td><?= formatBobot($riwayatTerakhir['ci'],4) ?></td></tr>
          <tr><td class="bg-slate-50 font-medium">Random Index (RI)</td><td><?= formatBobot($riwayatTerakhir['ri'],2) ?></td></tr>
          <tr><td class="bg-slate-50 font-medium">Consistency Ratio (CR)</td><td><?= formatBobot($riwayatTerakhir['cr'],4) ?></td></tr>
          <tr><td class="bg-slate-50 font-medium">Kesimpulan</td>
            <td class="font-semibold"><?= $riwayatTerakhir['status_konsisten'] ?> <?= $riwayatTerakhir['status_konsisten']==='Konsisten' ? '(CR &le; 0,1)' : '(CR > 0,1)' ?></td></tr>
        </tbody>
      </table>
      <?php endif; ?>
    <?php endif; ?>

<?php elseif ($jenis === 'ranking'):
    $hasil = $koneksi->query("SELECT h.*, p.nama, p.nik, p.alamat FROM hasil_akhir h
        JOIN pemohon p ON p.id = h.pemohon_id ORDER BY h.ranking ASC")->fetchAll();
    $judulLaporan = 'LAPORAN HASIL PERHITUNGAN DAN RANKING AHP';
    $subJudul = 'Tahun ' . date('Y');
    require __DIR__ . '/../includes/laporan_kop.php';
    ?>
    <p class="text-sm mb-4 font-serif">
      Berikut adalah hasil akhir perhitungan skor <i>Analytical Hierarchy Process</i> (AHP) dan
      peringkat (ranking) seluruh pemohon zakat, diurutkan dari skor tertinggi ke terendah.
    </p>
    <table class="w-full text-sm tabel-formal">
      <thead>
        <tr>
          <th class="text-center w-14">Rank</th>
          <th class="text-left">NIK</th>
          <th class="text-left">Nama</th>
          <th class="text-left">Alamat</th>
          <th class="text-center">Skor Akhir</th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($hasil)): ?>
          <tr><td colspan="6" class="text-center py-6 text-slate-400">Belum ada hasil perhitungan.</td></tr>
        <?php endif; ?>
        <?php foreach ($hasil as $h): ?>
          <tr>
            <td class="text-center font-bold">#<?= $h['ranking'] ?></td>
            <td><?= bersihkan($h['nik']) ?></td>
            <td class="font-medium"><?= bersihkan($h['nama']) ?></td>
            <td><?= bersihkan($h['alamat']) ?></td>
            <td class="text-center"><?= formatBobot($h['total_nilai'],4) ?></td>
            <td class="text-center font-semibold"><?= $h['status'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php if (!empty($hasil)): ?>
    <table class="mt-4 text-sm font-serif">
      <tr><td class="pr-4 py-0.5">Jumlah pemohon dinilai</td><td class="pr-2">:</td><td class="font-semibold"><?= count($hasil) ?> orang</td></tr>
      <tr><td class="pr-4 py-0.5">Dinyatakan diterima</td><td class="pr-2">:</td><td class="font-semibold"><?= count(array_filter($hasil, fn($h)=>$h['status']==='Diterima')) ?> orang</td></tr>
      <tr><td class="pr-4 py-0.5">Dinyatakan ditolak</td><td class="pr-2">:</td><td class="font-semibold"><?= count(array_filter($hasil, fn($h)=>$h['status']==='Ditolak')) ?> orang</td></tr>
    </table>
    <?php endif; ?>

<?php elseif ($jenis === 'penerima'):
    $penerima = $koneksi->query("SELECT h.*, p.nama, p.nik, p.alamat, p.no_hp FROM hasil_akhir h
        JOIN pemohon p ON p.id = h.pemohon_id WHERE h.status='Diterima' ORDER BY h.ranking ASC")->fetchAll();
    $judulLaporan = 'SURAT KEPUTUSAN PENETAPAN PENERIMA ZAKAT';
    $subJudul = 'Tahun ' . date('Y');
    require __DIR__ . '/../includes/laporan_kop.php';
    ?>
    <p class="text-sm mb-1 font-serif">
      Berdasarkan hasil perhitungan Sistem Pendukung Keputusan menggunakan metode
      <i>Analytical Hierarchy Process</i> (AHP), dengan ini Panitia Pengelola Zakat Masjid
      Nurul Ikhsan menetapkan nama-nama berikut sebagai <b>penerima zakat resmi</b>:
    </p>
    <table class="w-full text-sm tabel-formal mt-4">
      <thead>
        <tr>
          <th class="text-center w-10">No</th>
          <th class="text-left">NIK</th>
          <th class="text-left">Nama Penerima</th>
          <th class="text-left">Alamat</th>
          <th class="text-left">No. HP</th>
          <th class="text-center">Skor Akhir</th>
          <th class="text-center">Tanda Tangan</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($penerima)): ?>
          <tr><td colspan="7" class="text-center py-6 text-slate-400">Belum ada penerima resmi.</td></tr>
        <?php endif; ?>
        <?php $no=1; foreach ($penerima as $h): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= bersihkan($h['nik']) ?></td>
            <td class="font-medium"><?= bersihkan($h['nama']) ?></td>
            <td><?= bersihkan($h['alamat']) ?></td>
            <td><?= bersihkan($h['no_hp']) ?: '-' ?></td>
            <td class="text-center"><?= formatBobot($h['total_nilai'],4) ?></td>
            <td class="h-10"></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php if (!empty($penerima)): ?>
      <p class="text-sm mt-4 font-serif">
        Total penerima zakat resmi yang ditetapkan berjumlah
        <b><?= count($penerima) ?> (<?= ucwords(terbilang(count($penerima))) ?>) orang</b>.
        Surat keputusan ini berlaku sejak tanggal ditetapkan dan menjadi dasar penyaluran
        dana zakat kepada pihak-pihak yang bersangkutan.
      </p>
    <?php endif; ?>
<?php endif; ?>

<?php
  $labelKiri = 'Ketua DKM Masjid Nurul Ikhsan';
  $labelKanan = 'Ketua Panitia Zakat';
  require __DIR__ . '/../includes/laporan_ttd.php';
?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
