<?php
include "koneksi.php";

function e($v){return htmlspecialchars($v ?? '');}
function pag($cur,$tot,$p,$h){
    if($tot <2)return;
    $o = isset($_GET[$p== 'd_page'?'p_page':'d_page']) ? '&'.($p== 'd_page'?'p_page':'d_page').'='.(int)$_GET[$p== 'd_page'?'p_page':'d_page'] : '';
    echo "<div class='mt-4 flex justify-end gap-1 text-xs'>";
    for($i=1;$i<=$tot;$i++) {
        $c = $i==$cur ? 'bg-blue-900 text-white':'bg-white text-gray-900';
        echo "<a href='?{$p}=$i$o#$h' class='px-3 py-1.5 border rounded font-semibold $c'>$i</a>";
    }
    echo "</div>";
}

$stat = mysqli_fetch_assoc(mysqli_query($DB,"
  SELECT
    (SELECT COUNT(*) FROM siswa) total_siswa,
    COUNT(*) total_transaksi,
    IFNULL(SUM(poin),0) total_poin, 
    SUM(tangal >= DATE_FORMAT(NOW(), '%Y-%m-01')) bulan_ini
  FROM transaksi
"));
?>

<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CAPSIS</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
            body{font-family:Inter, sans-serif}
            .hero{background:linear-gradient(rgba(13,58,124,.85), rgba(13,58,124,.85)), url('img/3smkn6.jpeg') center/cover}
        </style>
    </head>

<body class="bg-gray-50 text-slate-800">
<nav class="bg-[#0D3A7C] text-white sticky top-0 z-40">
  <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between">
    <div class="flex items-center gap-3">
      <img src="img/logocapsis.jpeg" class="w-12 h-12 bg-white p-2 rounded-full" alt="CAPSIS">
      <div>
        <b class="text-2xl">CAPSIS</b>
        <p class="text-[10px]">CATATAN PELANGGARAN SISWA</p>
      </div>
    </div>
    <div class="hidden md:flex items-center gap-6 text-sm">
      <a href="#">Beranda</a>
      <a href="#data-pelanggaran">Data Pelanggaran</a>
      <a href="#riwayat">Riwayat</a>
      <a href="#tata-tertib">Tata Tertib</a>
      <a href="logout.php" onclick="return confirm('Yakin ingin keluar?')" class="px-4 py-2 border rounded">Logout</a>
    </div>
  </div>
</nav>

<header class="hero text-white px-6 py-16">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-5xl font-bold">CAPSIS</h1>
    <p class="text-xl">Catatan Pelanggaran Siswa</p>
    <p class="text-gray-200 max-w-xl mb-6">
      Sistem terpusat untuk mencatat, memantau, dan menampilkan data pelanggaran siswa.
    </p>
    <a href="#peringkat" class="px-5 py-2.5 bg-blue-600 rounded">
      <i class="fas fa-trophy"></i> Lihat Peringkat
    </a>
  </div>
</header>

<div class="max-w-6xl mx-auto px-6 -mt-8 grid md:grid-cols-4 gap-4">
<?php
$cards = [
  ['Total Siswa',$stat['total_siswa'],'Siswa Terdaftar','blue','fa-users'],
  ['Total Pelanggaran',$stat['total_transaksi'],'Data Transaksi','orange','fa-file-alt'],
  ['Total Poin',$stat['total_poin'],'Jumlah Poin','red','fa-star'],
  ['Bulan Ini',$stat['bulan_ini'],date('F Y'),'green','fa-calendar-alt']
];
foreach($cards as $c):
?>
  <div class="bg-white p-5 rounded-lg shadow flex items-center gap-4">
    <div class="bg-<?= $c[3] ?>-100 text-<?= $c[3] ?>-600 p-3 rounded-lg">
      <i class="fas <?= $c[4] ?>"></i>
    </div>
    <div>
      <p class="text-xs text-gray-500"><?= $c[0] ?></p>
      <h3 class="text-xl font-bold"><?= number_format($c[1]) ?></h3>
      <p class="text-xs text-gray-400"><?= $c[2] ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<main class="max-w-6xl mx-auto px-6 py-10 space-y-12">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    <section id="peringkat" class="lg:col-span-4">
  <h2 class="font-bold mb-4"><i class="fas fa-trophy text-orange-500"></i> PERINGKAT</h2>
  <div class="bg-white rounded-xl border p-4">
    <h3 class="text-xs font-bold text-blue-900 mb-3">Top 5 Poin Tertinggi</h3>

    <?php
    $q=mysqli_query($DB,"SELECT s.nama_siswa,s.kelas,SUM(t.poin) total_poin 
    FROM transaksi t 
    JOIN siswa s ON t.id_siswa=s.id_siswa 
    GROUP BY t.id_siswa 
    ORDER BY total_poin DESC LIMIT 5");
    
    $r=1;
    if($q&&mysqli_num_rows($q)):while($x=mysqli_fetch_assoc($q)):
    ?>
      <div class="flex justify-between items-center mb-3 text-xs">
        <div class="flex items-center gap-2">
          <span class="w-7 h-7 rounded-full border flex items-center justify-center font-bold <?= $r==1?'bg-orange-100 text-orange-500':'bg-gray-100 text-gray-500' ?>"><?= $r++ ?></span>
          <div><b><?=e($x['nama_siswa'])?></b><p class="text-[10px] text-gray-400"><?=e($x['kelas'])?></p></div>
        </div>
        <b class="text-red-600"><?=$x['total_poin']?></b>
      </div>
    <?php endwhile;else: ?>
      <p class="text-xs text-gray-400 text-center">Belum ada data</p>
    <?php endif; ?>
  </div>
</section>

    <section id="data-pelanggaran" class="lg:col-span-8">
  <h2 class="font-bold mb-4">DATA PELANGGARAN HARI INI</h2>

  <div class="bg-white p-5 rounded-xl shadow border">
    <div class="flex gap-3 mb-4">
      <button onclick="openModal('tambah')" class="bg-blue-600 text-white px-3 py-1.5 rounded text-xs">
        <i class="fas fa-plus"></i> Tambah
      </button>
      <input id="searchInput" class="text-xs border rounded px-3 py-1.5 flex-grow max-w-xs" placeholder="Cari nama siswa...">
    </div>

    <div class="overflow-x-auto">
      <table id="violationTable" class="w-full text-left text-xs">
        <thead class="bg-gray-50 text-gray-600 uppercase">
          <tr>
            <th class="p-2 border-b">No</th>
            <th class="p-2 border-b">Nama Siswa</th>
            <th class="p-2 border-b">Kelas</th>
            <th class="p-2 border-b">Jenis Pelanggaran</th>
            <th class="p-2 border-b">Poin</th>
            <th class="p-2 border-b">Tanggal</th>
            <th class="p-2 border-b text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
<?php
$limit = 5;
$page = max(1, (int)($_GET['d_page'] ?? 1));
$start = ($page - 1) * $limit;

$total = mysqli_fetch_assoc(mysqli_query($DB,
  "SELECT COUNT(*) total FROM transaksi WHERE DATE(tangal)=CURDATE()"
))['total'] ?? 0;

$pages = ceil($total / $limit);

$q = mysqli_query($DB,
  "SELECT t.*,s.nama_siswa,s.kelas,p.nama_pelanggaran
   FROM transaksi t
   JOIN siswa s ON t.id_siswa=s.id_siswa
   JOIN pelanggaran p ON t.id_pelanggaran=p.id_pelanggaran
   WHERE DATE(t.tangal)=CURDATE()
   ORDER BY t.id_transaksi DESC
   LIMIT $start,$limit"
);

$no = $start + 1;

if ($q && mysqli_num_rows($q)):
  while ($d = mysqli_fetch_assoc($q)):
?>
              <tr class="hover:bg-gray-50">
                <td class="p-2.5"><?= $no++ ?></td>
                <td class="p-2.5 font-semibold student-name"><?= e($d['nama_siswa']) ?></td>
                <td class="p-2.5"><?= e($d['kelas']) ?></td>
                <td class="p-2.5"><?= e($d['nama_pelanggaran']) ?></td>
                <td class="p-2.5"><span class="bg-red-50 text-red-600 px-2 py-0.5 rounded font-bold text-[10px]"><?= $d['poin'] ?></span></td>
                <td class="p-2.5 text-gray-500"><?= date('d M Y', strtotime($d['tangal'])) ?></td>
                <td class="p-2.5 flex justify-center gap-1">
                  <button onclick='openModal("edit", <?= json_encode($d) ?>)' class="bg-orange-500 hover:bg-orange-600 text-white p-1.5 rounded text-[10px]"><i class="fas fa-edit"></i></button>
                  <a href="hapus.php?id=<?= $d['id_transaksi'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded text-[10px]"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
<?php endwhile; else: ?>
              <tr><td colspan="7" class="text-center p-4 text-gray-400">Belum ada data hari ini</td></tr>
<?php endif; ?>
            </tbody>
          </table>
        </div>
        <?php pag($page,$pages,'d_page','data-pelanggaran'); ?>
      </div>
    </section>
  </div>

  <section id="riwayat">
    <h2 class="text-base font-bold mb-3 flex items-center gap-2"><i class="fas fa-history text-blue-900"></i> RIWAYAT PELANGGARAN LENGKAP</h2>
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden p-5">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs divide-y divide-gray-200">
          <thead class="bg-gray-100 text-gray-700 uppercase font-semibold">
            <tr>
              <th class="p-2.5 border-b">No</th><th class="p-2.5 border-b">Nama Siswa</th><th class="p-2.5 border-b">Kelas</th><th class="p-2.5 border-b">Jenis Pelanggaran</th><th class="p-2.5 border-b">Poin</th><th class="p-2.5 border-b">Tanggal</th><th class="p-2.5 border-b">Keterangan</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
<?php
$page=max(1,(int)($_GET['p_page']??1)); $start=($page-1)*5;
$total=mysqli_fetch_assoc(mysqli_query($DB,"SELECT COUNT(*) total FROM transaksi"))['total'] ?? 0;
$pages=ceil($total/5);
$q=mysqli_query($DB,"SELECT t.*,s.nama_siswa,s.kelas,p.nama_pelanggaran FROM transaksi t JOIN siswa s ON t.id_siswa=s.id_siswa JOIN pelanggaran p ON t.id_pelanggaran=p.id_pelanggaran ORDER BY t.tangal DESC, t.id_transaksi DESC LIMIT $start,5");
$no=$start+1;
if($q && mysqli_num_rows($q)):
  while($r=mysqli_fetch_assoc($q)):
?>
            <tr class="hover:bg-gray-50">
              <td class="p-2.5 text-gray-500"><?= $no++ ?></td>
              <td class="p-2.5 font-semibold text-gray-800"><?= e($r['nama_siswa']) ?></td>
              <td class="p-2.5 text-gray-600"><?= e($r['kelas']) ?></td>
              <td class="p-2.5 text-gray-600"><?= e($r['nama_pelanggaran']) ?></td>
              <td class="p-2.5"><span class="bg-red-100 text-red-600 font-bold text-[10px] px-2 py-0.5 rounded"><?= $r['poin'] ?> Poin</span></td>
              <td class="p-2.5 text-gray-500"><?= date('d M Y', strtotime($r['tangal'])) ?></td>
              <td class="p-2.5 text-gray-500 italic"><?= !empty($r['keterangan']) ? e($r['keterangan']) : '-' ?></td>
            </tr>
<?php endwhile; else: ?>
            <tr><td colspan="7" class="text-center p-4 text-gray-400">Belum ada riwayat data</td></tr>
<?php endif; ?>
          </tbody>
        </table>
      </div>
      <?php pag($page,$pages,'p_page','riwayat'); ?>
    </div>
  </section>

  <section id="tata-tertib">
    <h2 class="text-base font-bold flex items-center gap-2 mb-1"><i class="fas fa-gavel text-blue-900"></i> TATA TERTIB SEKOLAH</h2>
    <p class="text-[10px] font-bold text-gray-500 mb-3 uppercase">Daftar Pelanggaran dan Poin Master</p>
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden p-5">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs divide-y divide-gray-200">
          <thead class="bg-gray-100 text-gray-700 uppercase font-semibold">
            <tr><th class="p-2.5 border-b w-12">No</th><th class="p-2.5 border-b">Nama Pelanggaran</th><th class="p-2.5 border-b text-right w-24">Poin</th></tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
<?php
$q=mysqli_query($DB,"SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
$no=1;
if($q && mysqli_num_rows($q)):
  while($m=mysqli_fetch_assoc($q)):
?>
            <tr class="hover:bg-gray-50">
              <td class="p-2.5 font-medium text-gray-500"><?= $no++ ?>.</td>
              <td class="p-2.5 font-medium text-gray-800"><?= e($m['nama_pelanggaran']) ?></td>
              <td class="p-2.5 text-right"><span class="bg-red-50 text-red-600 text-[10px] font-bold px-2 py-0.5 rounded border border-red-100"><?= $m['poin'] ?> Poin</span></td>
            </tr>
<?php endwhile; else: ?>
            <tr><td colspan="3" class="p-4 text-center text-gray-400">Belum ada data tata tertib.</td></tr>
<?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<footer class="bg-[#0A1D37] text-white py-6 mt-12">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-6 text-xs">
    <div>
      <div class="flex items-center gap-2 mb-2">
        <img src="img/logocapsis.jpeg" class="w-7 h-7 bg-white p-1 rounded-full" alt="Logo">
        <b class="text-lg">CAPSIS</b>
      </div>
      <p class="text-gray-400">© <?= date('Y'); ?> CAPSIS. All Rights Reserved.</p>
    </div>
    <div>
      <b>Tentang</b>
      <p class="text-gray-400">Sistem manajemen tata tertib untuk memantau data pelanggaran siswa secara terstruktur.</p>
    </div>
    <div>
      <b>Kontak</b>
      <p class="text-gray-400"><i class="fas fa-school"></i> SMKN 6 Jember</p>
      <p class="text-gray-400"><i class="fas fa-phone"></i> (0336) 441347</p>
    </div>
  </div>
</footer>

<div id="formModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-md">

    <div class="bg-[#0D3A7C] text-white px-5 py-3 flex justify-between">
      <b id="modalTitle">Tambah Data Pelanggaran</b>
      <button type="button" onclick="closeModal()">&times;</button>
    </div>

    <form id="violationForm" action="proses_tambah.php" method="POST" class="p-5 space-y-3 text-xs">

      <input type="hidden" id="formIdTransaksi" name="id_transaksi">

      <div>
        <label>Nama Siswa</label>
        <input type="text" id="formNamaSiswa" name="nama_siswa" required class="w-full border rounded">
      </div>

      <div>
        <label>Kelas</label>
        <input type="text" id="formKelas" name="kelas" required class="w-full border rounded">
      </div>

      <div>
        <label>Jenis Pelanggaran</label>
        <select id="formJenis" name="id_pelanggaran" required onchange="updatePoin()" class="w-full border rounded">
          <option value="">-- Pilih Jenis Pelanggaran --</option>
          <?php
          $q=mysqli_query($DB,"SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
          while($row=mysqli_fetch_assoc($q))
            echo "<option value='{$row['id_pelanggaran']}' data-poin='{$row['poin']}'>".e($row['nama_pelanggaran'])."</option>";
          ?>
        </select>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label>Poin</label>
          <input type="number" id="formPoin" name="poin" readonly required class="w-full border rounded bg-gray-100">
        </div>
        <div>
          <label>Tanggal</label>
          <input type="date" id="formTanggal" name="tanggal" required class="w-full border rounded">
        </div>
      </div>

      <div>
        <label>Keterangan</label>
        <textarea id="formKeterangan" name="keterangan" rows="2" class="w-full border rounded" placeholder="Opsional..."></textarea>
      </div>

      <div class="flex justify-end gap-2 pt-3 border-t">
        <button type="button" onclick="closeModal()" class="px-3 py-1.5 border rounded">Batal</button>
        <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white rounded">Simpan</button>
      </div>

    </form>
  </div>
</div>

<script>
function updatePoin(){ formPoin.value = formJenis.selectedOptions[0]?.dataset.poin || '' }
function openModal(mode='tambah', d=null){
  formModal.classList.remove('hidden'); formModal.classList.add('flex');
  violationForm.action = mode==='edit' ? 'proses_edit.php' : 'proses_tambah.php';
  violationForm.reset();
  if(mode==='edit' && d){
    formIdTransaksi.value=d.id_transaksi||'';
    formNamaSiswa.value=d.nama_siswa||'';
    formKelas.value=d.kelas||'';
    formJenis.value=d.id_pelanggaran||'';
    formPoin.value=d.poin||'';
    formKeterangan.value=d.keterangan||'';
    formTanggal.value=d.tangal||'';
  } else formTanggal.valueAsDate = new Date();
}
function closeModal(){ formModal.classList.add('hidden'); formModal.classList.remove('flex') }

searchInput?.addEventListener('input', e=>{ 
  let t=e.target.value.toLowerCase();
  document.querySelectorAll('#violationTable tbody tr').forEach(r=>{
    r.style.display=((r.querySelector('.student-name')?.textContent||'').toLowerCase().includes(t)) ? '' : 'none';
  });
});
</script>
</body>
</html>