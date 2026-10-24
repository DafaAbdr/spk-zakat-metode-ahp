<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
wajibLogin();

$daftarKriteria = $koneksi->query("SELECT * FROM kriteria ORDER BY id ASC")->fetchAll();
$n = count($daftarKriteria);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $n >= 2) {
    foreach ($_POST['nilai'] as $key => $nilaiRaw) {
        // key selalu berformat "idA_idB" (A = kriteria dengan id lebih kecil, B = lebih besar).
        // nilai yang dikirim BISA berupa pecahan (mis. 0.333) jika pengguna menandai "Kebalikan (B > A)".
        [$idA, $idB] = explode('_', $key);
        $nilai = (float)$nilaiRaw;
        if ($nilai <= 0) $nilai = 1;

        $cek = $koneksi->prepare("SELECT id FROM perbandingan_kriteria WHERE (kriteria_a_id=:a1 AND kriteria_b_id=:b1) OR (kriteria_a_id=:b2 AND kriteria_b_id=:a2)");
        $cek->execute(['a1' => $idA, 'b1' => $idB, 'b2' => $idA, 'a2' => $idB]);
        $existing = $cek->fetch();

        if ($existing) {
            $up = $koneksi->prepare("UPDATE perbandingan_kriteria SET nilai=:nilai, kriteria_a_id=:a, kriteria_b_id=:b, dihitung_oleh=:uid WHERE id=:id");
            $up->execute(['nilai' => $nilai, 'a' => $idA, 'b' => $idB, 'uid' => $_SESSION['user_id'], 'id' => $existing['id']]);
        } else {
            $in = $koneksi->prepare("INSERT INTO perbandingan_kriteria (kriteria_a_id, kriteria_b_id, nilai, dihitung_oleh) VALUES (:a,:b,:nilai,:uid)");
            $in->execute(['a' => $idA, 'b' => $idB, 'nilai' => $nilai, 'uid' => $_SESSION['user_id']]);
        }
    }
    setFlash('success', 'Data perbandingan kriteria berhasil disimpan. Silakan lanjut ke menu Hitung Bobot AHP.');
    header('Location: perbandingan_kriteria.php');
    exit;
}

// Ambil nilai perbandingan yang sudah tersimpan (kunci SELALU "idKecil_idBesar")
$tersimpan = [];
$rows = $koneksi->query("SELECT * FROM perbandingan_kriteria")->fetchAll();
foreach ($rows as $r) {
    $tersimpan[$r['kriteria_a_id'] . '_' . $r['kriteria_b_id']] = (float) $r['nilai'];
}

$skalaSaaty = [
    '1' => '1 - Sama penting',
    '2' => '2 - Antara sama & sedikit lebih penting',
    '3' => '3 - Sedikit lebih penting',
    '4' => '4 - Antara sedikit & jelas lebih penting',
    '5' => '5 - Jelas lebih penting',
    '6' => '6 - Antara jelas & sangat penting',
    '7' => '7 - Sangat penting',
    '8' => '8 - Antara sangat & mutlak penting',
    '9' => '9 - Mutlak lebih penting',
];

$judulHalaman = 'Perbandingan Kriteria';
$menuAktif = 'perbandingan';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="mb-5">
  <h2 class="text-lg font-bold text-masjid-800">Matriks Perbandingan Berpasangan Kriteria</h2>
  <p class="text-sm text-slate-400">Bandingkan tingkat kepentingan antar kriteria menggunakan skala Saaty (1-9) sesuai kebijakan panitia zakat.</p>
</div>

<?php if ($n < 2): ?>
  <div class="bg-white rounded-2xl p-6 shadow-soft border border-masjid-100 text-sm text-slate-400">
    Minimal dibutuhkan 2 kriteria untuk melakukan perbandingan. Silakan lengkapi data pada menu <a href="../kriteria/index.php" class="text-masjid-600 font-semibold hover:underline">Kriteria</a>.
  </div>
<?php else: ?>

<div class="bg-white rounded-2xl shadow-soft border border-masjid-100 p-6 fade-in">
  <div class="bg-gold-50 border border-gold-200 rounded-xl px-4 py-3 text-sm text-gold-800 mb-6">
    💡 Pilih seberapa penting <b>Kriteria A</b> dibandingkan <b>Kriteria B</b>. Jika B lebih penting dari A, centang <b>Kebalikan</b>. Pilihan yang sudah tersimpan sebelumnya akan otomatis tampil sesuai isian terakhir Anda.
  </div>

  <form method="POST" class="space-y-4">
    <?php
    for ($i = 0; $i < $n; $i++):
      for ($j = $i + 1; $j < $n; $j++):
        $a = $daftarKriteria[$i]; $b = $daftarKriteria[$j];
        $key = $a['id'] . '_' . $b['id'];
        $nilaiTersimpan = $tersimpan[$key] ?? null;

        // Tentukan status checkbox & nilai dropdown yang harus ditampilkan berdasar data tersimpan:
        // - nilai >= 1  => A lebih penting (atau sama penting), checkbox TIDAK dicentang, dropdown = nilai itu sendiri
        // - nilai < 1   => B lebih penting, checkbox DICENTANG, dropdown = pembalikan nilai (1/nilai) dibulatkan
        if ($nilaiTersimpan === null) {
            $isBalik = false;
            $nilaiDropdown = 1;
        } elseif ($nilaiTersimpan < 1) {
            $isBalik = true;
            $nilaiDropdown = (string) round(1 / $nilaiTersimpan);
        } else {
            $isBalik = false;
            $nilaiDropdown = (string) round($nilaiTersimpan);
        }
    ?>
    <div class="border border-masjid-100 rounded-xl p-4 grid md:grid-cols-12 items-center gap-3">
      <div class="md:col-span-3">
        <span class="text-xs text-slate-400">Kriteria A</span>
        <p class="font-semibold text-masjid-800 text-sm"><?= bersihkan($a['nama_kriteria']) ?></p>
      </div>
      <div class="md:col-span-4">
        <select name="nilai[<?= $key ?>]" id="select_<?= $key ?>" data-checked="<?= $isBalik ? '1' : '0' ?>" class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm focus:ring-2 focus:ring-masjid-400 outline-none">
          <?php foreach ($skalaSaaty as $val => $label): ?>
            <option value="<?= $val ?>" <?= ((string)$val === $nilaiDropdown) ? 'selected' : '' ?>><?= $label ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="md:col-span-2 text-center">
        <label class="inline-flex items-center gap-1.5 text-xs text-slate-500 cursor-pointer">
          <input type="checkbox" class="rounded" onchange="toggleKebalikan('<?= $key ?>', this)" <?= $isBalik ? 'checked' : '' ?>>
          Kebalikan (B &gt; A)
        </label>
      </div>
      <div class="md:col-span-3">
        <span class="text-xs text-slate-400">Kriteria B</span>
        <p class="font-semibold text-masjid-800 text-sm"><?= bersihkan($b['nama_kriteria']) ?></p>
      </div>
    </div>
    <?php endfor; endfor; ?>

    <button type="submit" class="w-full md:w-auto bg-masjid-600 hover:bg-masjid-700 text-white font-semibold px-6 py-3 rounded-xl shadow-soft">
      💾 Simpan Perbandingan
    </button>
  </form>
</div>

<script>
function toggleKebalikan(key, checkbox) {
  const select = document.getElementById('select_' + key);
  select.setAttribute('data-checked', checkbox.checked ? '1' : '0');
}
document.querySelector('form').addEventListener('submit', function(e){
  document.querySelectorAll('select[data-checked="1"]').forEach(sel => {
    const nilaiAsli = parseFloat(sel.value);
    // Kirim nilai kebalikan (1/nilai) di bawah nama field yang SAMA, lalu nonaktifkan select asli
    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = sel.name;
    hidden.value = (1/nilaiAsli).toFixed(5);
    sel.disabled = true;
    sel.after(hidden);
  });
});
</script>

<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
