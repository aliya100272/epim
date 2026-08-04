<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAPSIS - Catatan Pelanggaran Siswa</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; }
    .hero-gradient { background: linear-gradient(rgba(13,58,124,.85), rgba(13,58,124,.85)), url('img/3smkn6.jpeg') center/cover; }
  </style>
</head>
<body class="bg-gray-50 text-slate-800">

<?php 
include "koneksi.php";
$stat = mysqli_fetch_assoc(mysqli_query($DB, "
  SELECT 
    (SELECT COUNT(*) FROM siswa) as total_siswa,
    COUNT(*) as total_transaksi,
    IFNULL(SUM(poin), 0) as total_poin,
    SUM(tangal >= DATE_FORMAT(NOW(), '%Y-%m-01')) as bulan_ini
  FROM transaksi
"));
function renderPagination($currentPage, $totalPages, $paramName, $hash) {
  if ($totalPages <= 1) return;

  $otherKey = ($paramName === 'd_page') ? 'p_page' : 'd_page';
  $otherParam = isset($_GET[$otherKey]) ? "&{$otherKey}=" . (int)$_GET[$otherKey] : '';

  $link = fn($p, $text, $active = false) => $p 
    ? "<a href='?{$paramName}={$p}{$otherParam}#{$hash}' class='px-3 py-1.5 border rounded font-semibold " . ($active ? 'bg-blue-900 text-white border-blue-900' : 'bg-white hover:bg-gray-100 text-gray-700') . "'>{$text}</a>"
    : "<span class='px-3 py-1.5 border bg-gray-100 text-gray-400 rounded cursor-not-allowed'>{$text}</span>";

  echo '<div class="mt-4 pt-4 border-t flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-gray-600"><div class="flex items-center gap-1 ml-auto">';
  echo $link($currentPage > 1 ? $currentPage - 1 : false, "<i class='fas fa-chevron-left text-[10px]'></i> Prev");
  for ($i = 1; $i <= $totalPages; $i++) {
    echo $link($i, $i, $i == $currentPage);
  }
  echo $link($currentPage < $totalPages ? $currentPage + 1 : false, "Next <i class='fas fa-chevron-right text-[10px]'></i>");
  echo '</div></div>';
}
?>

  <nav class="bg-[#0D3A7C] text-white sticky top-0 z-40 shadow-md">
    <div class="px-6 py-4 flex justify-between items-center max-w-6xl mx-auto">
      <div class="flex items-center gap-3">
        <div class="bg-white p-1.5 rounded-full shadow"><img src="img/logocapsis.jpeg" alt="CAPSIS" class="w-9 h-9 object-contain"></div>
        <div><span class="text-2xl font-bold">CAPSIS</span><p class="text-[10px] uppercase opacity-80">Catatan Pelanggaran Siswa</p></div>
      </div>
      <div class="hidden md:flex items-center gap-6 font-medium text-sm ml-auto">
        <a class="hover:underline" href="#">Beranda</a>
        <a class="hover:underline" href="#data-pelanggaran">Data Pelanggaran</a>
        <a class="hover:underline" href="#riwayat">Riwayat</a>
        <a class="hover:underline" href="#tata-tertib">Tata Tertib</a>
        <a class="border border-white/40 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-md flex items-center gap-2" href="logout.php" onclick="return confirm('Yakin ingin keluar?')"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
      <button onclick="toggleMobileMenu()" class="md:hidden text-2xl ml-auto"><i class="fas fa-bars"></i></button>
    </div>
    <div id="mobileMenu" class="hidden md:hidden bg-[#0a2e63] px-6 py-4 space-y-2 font-medium text-sm border-t border-blue-900">
      <a class="block py-1 opacity-80" href="#">Beranda</a>
      <a class="block py-1 opacity-80" href="#data-pelanggaran">Data Pelanggaran</a>
      <a class="block py-1 opacity-80" href="#riwayat">Riwayat</a>
      <a class="block py-1 opacity-80" href="#tata-tertib">Tata Tertib</a>
      <a class="block text-center border border-white/30 bg-white/10 py-2 rounded-md mt-2" href="logout.php" onclick="return confirm('Yakin ingin keluar?')"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </nav>

  <header class="hero-gradient text-white py-16 px-6">
    <div class="container mx-auto max-w-6xl">
      <h1 class="text-5xl font-bold mb-3">CAPSIS</h1>
      <p class="text-xl font-medium mb-3">Catatan Pelanggaran Siswa</p>
      <p class="max-w-xl text-gray-200 mb-6">Sistem terpusat mencatat, memantau, dan menampilkan data pelanggaran siswa secara transparan.</p>
      <a href="#peringkat" class="inline-flex bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-md items-center gap-2 font-semibold text-sm"><i class="fas fa-trophy"></i> Lihat Peringkat</a>
    </div>
  </header>

  <div class="container mx-auto max-w-6xl px-6 -mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
    <?php 
      $cards = [
        ['Total Siswa', $stat['total_siswa'], 'Siswa Terdaftar', 'blue', 'fa-users'],
        ['Total Pelanggaran', $stat['total_transaksi'], 'Data Transaksi', 'orange', 'fa-file-alt'],
        ['Total Poin', $stat['total_poin'], 'Jumlah Poin', 'red', 'fa-star'],
        ['Bulan Ini', $stat['bulan_ini'], date('F Y'), 'green', 'fa-calendar-alt']
      ];
      foreach($cards as $c): 
    ?>
    <div class="bg-white rounded-lg shadow-md p-5 flex items-center gap-4">
      <div class="bg-<?= $c[3] ?>-100 p-3.5 rounded-lg text-<?= $c[3] ?>-600"><i class="fas <?= $c[4] ?> text-xl"></i></div>
      <div>
        <p class="text-[10px] text-gray-500 uppercase font-bold"><?= $c[0] ?></p>
        <h3 class="text-xl font-bold"><?= number_format($c[1]); ?></h3>
        <p class="text-[10px] text-gray-400"><?= $c[2] ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <main class="container mx-auto max-w-6xl px-6 py-10 space-y-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <section id="peringkat" class="lg:col-span-4">
        <h2 class="text-base font-bold flex items-center gap-2 mb-4"><i class="fas fa-trophy text-orange-500"></i> PERINGKAT</h2>
        <div class="bg-white rounded-xl shadow-sm border p-4 space-y-3">
          <h3 class="text-xs font-bold text-blue-900 uppercase border-b pb-2">Top 5 Poin Tertinggi</h3>
          <?php
          $res_top = mysqli_query($DB, "SELECT s.nama_siswa, s.kelas, SUM(t.poin) as total_poin FROM transaksi t JOIN siswa s ON t.id_siswa = s.id_siswa GROUP BY t.id_siswa ORDER BY total_poin DESC LIMIT 5");
          $rank = 1;
          if($res_top && mysqli_num_rows($res_top) > 0){
            while($top = mysqli_fetch_array($res_top)){
          ?>
          <div class="flex justify-between items-center text-xs">
            <div class="flex gap-2.5 items-center">
              <span class="w-7 h-7 rounded-full <?= $rank == 1 ? 'bg-orange-100 text-orange-500' : 'bg-gray-100 text-gray-500'; ?> border flex items-center justify-center font-bold text-xs"><?= $rank++; ?></span>
              <div>
                <p class="font-bold text-gray-800"><?= htmlspecialchars($top['nama_siswa']); ?></p>
                <p class="text-[10px] text-gray-400"><?= htmlspecialchars($top['kelas']); ?></p>
              </div>
            </div>
            <div class="text-right">
              <p class="font-bold text-red-600"><?= $top['total_poin']; ?></p>
              <p class="text-[9px] text-gray-400">Poin</p>
            </div>
          </div>
          <?php } } else { echo "<p class='text-xs text-gray-400 italic text-center py-2'>Belum ada data</p>"; } ?>
        </div>
      </section>

      <section id="data-pelanggaran" class="lg:col-span-8">
        <h2 class="text-base font-bold mb-4">DATA PELANGGARAN HARI INI</h2>
        <div class="bg-white rounded-xl shadow-sm border p-5">
          <div class="flex flex-wrap gap-3 mb-4">
            <button onclick="openModal('tambah')" class="bg-blue-600 hover:bg-blue-700 text-white px-3.5 py-1.5 rounded text-xs font-medium flex items-center gap-1.5"><i class="fas fa-plus"></i> Tambah</button>
            <input id="searchInput" class="text-xs border rounded px-3 py-1.5 flex-grow max-w-xs" placeholder="Cari nama siswa..." type="text"/>
          </div>
          
          <div class="overflow-x-auto">
            <table id="violationTable" class="w-full text-left text-xs">
              <thead class="bg-gray-50 text-gray-600 uppercase font-semibold">
                <tr>
                  <th class="p-2.5 border-b">No</th>
                  <th class="p-2.5 border-b">Nama Siswa</th>
                  <th class="p-2.5 border-b">Kelas</th>
                  <th class="p-2.5 border-b">Jenis Pelanggaran</th>
                  <th class="p-2.5 border-b">Poin</th>
                  <th class="p-2.5 border-b">Tanggal</th>
                  <th class="p-2.5 border-b text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <?php
                $limit_today = 5;
                $page_today = max(1, (int)($_GET['d_page'] ?? 1));
                $start_today = ($page_today - 1) * $limit_today;

                $total_today = mysqli_fetch_assoc(mysqli_query($DB, "SELECT COUNT(*) as total FROM transaksi WHERE DATE(tangal) = CURDATE()"))['total'] ?? 0;
                $pages_today = ceil($total_today / $limit_today);

                $data = mysqli_query($DB, "SELECT t.*, s.nama_siswa, s.kelas, p.nama_pelanggaran FROM transaksi t JOIN siswa s ON t.id_siswa = s.id_siswa JOIN pelanggaran p ON t.id_pelanggaran = p.id_pelanggaran WHERE DATE(t.tangal)=CURDATE() ORDER BY t.id_transaksi DESC LIMIT $start_today, $limit_today");
                $no = $start_today + 1;

                if($data && mysqli_num_rows($data) > 0){
                  while($d = mysqli_fetch_array($data)){
                ?>
                <tr class="hover:bg-gray-50">
                  <td class="p-2.5"><?= $no++; ?></td>
                  <td class="p-2.5 font-semibold student-name"><?= htmlspecialchars($d['nama_siswa']); ?></td>
                  <td class="p-2.5"><?= htmlspecialchars($d['kelas']); ?></td>
                  <td class="p-2.5"><?= htmlspecialchars($d['nama_pelanggaran']); ?></td>
                  <td class="p-2.5"><span class="bg-red-50 text-red-600 px-2 py-0.5 rounded font-bold text-[10px]"><?= $d['poin']; ?></span></td>
                  <td class="p-2.5 text-gray-500"><?= date('d M Y', strtotime($d['tangal'])); ?></td>
                  <td class="p-2.5 flex justify-center gap-1">
                    <button type="button" onclick="openModal('edit', { id_transaksi: '<?= $d['id_transaksi']; ?>', nama_siswa: '<?= addslashes($d['nama_siswa']); ?>', kelas: '<?= addslashes($d['kelas']); ?>', id_pelanggaran: '<?= $d['id_pelanggaran']; ?>', poin: '<?= $d['poin']; ?>', keterangan: '<?= addslashes($d['keterangan']); ?>', tanggal: '<?= $d['tangal']; ?>' })" class="bg-orange-500 hover:bg-orange-600 text-white p-1.5 rounded text-[10px]"><i class="fas fa-edit"></i></button>
                    <a href="hapus.php?id=<?= $d['id_transaksi']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded text-[10px]"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <?php } } else { echo "<tr><td colspan='7' class='text-center p-4 text-gray-400'>Belum ada data hari ini</td></tr>"; } ?>
              </tbody>
            </table>
          </div>
          <?php renderPagination($page_today, $pages_today, 'd_page', 'data-pelanggaran'); ?>
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
                <th class="p-2.5 border-b">No</th>
                <th class="p-2.5 border-b">Nama Siswa</th>
                <th class="p-2.5 border-b">Kelas</th>
                <th class="p-2.5 border-b">Jenis Pelanggaran</th>
                <th class="p-2.5 border-b">Poin</th>
                <th class="p-2.5 border-b">Tanggal</th>
                <th class="p-2.5 border-b">Keterangan</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <?php
                $limit = 5;
                $page = max(1, (int)($_GET['p_page'] ?? 1));
                $start = ($page - 1) * $limit;

                $total_records = mysqli_fetch_assoc(mysqli_query($DB, "SELECT COUNT(*) as total FROM transaksi"))['total'] ?? 0;
                $total_pages = ceil($total_records / $limit);

                $riwayat = mysqli_query($DB, "SELECT t.*, s.nama_siswa, s.kelas, p.nama_pelanggaran FROM transaksi t JOIN siswa s ON t.id_siswa = s.id_siswa JOIN pelanggaran p ON t.id_pelanggaran = p.id_pelanggaran ORDER BY t.tangal DESC, t.id_transaksi DESC LIMIT $start, $limit");
                $no_riwayat = $start + 1;

                if($riwayat && mysqli_num_rows($riwayat) > 0){
                  while($r = mysqli_fetch_assoc($riwayat)){ 
              ?>
                <tr class="hover:bg-gray-50">
                  <td class="p-2.5 text-gray-500"><?= $no_riwayat++; ?></td>
                  <td class="p-2.5 font-semibold text-gray-800"><?= htmlspecialchars($r['nama_siswa']); ?></td>
                  <td class="p-2.5 text-gray-600"><?= htmlspecialchars($r['kelas']); ?></td>
                  <td class="p-2.5 text-gray-600"><?= htmlspecialchars($r['nama_pelanggaran']); ?></td>
                  <td class="p-2.5"><span class="bg-red-100 text-red-600 font-bold text-[10px] px-2 py-0.5 rounded"><?= $r['poin']; ?> Poin</span></td>
                  <td class="p-2.5 text-gray-500"><?= date('d M Y', strtotime($r['tangal'])); ?></td>
                  <td class="p-2.5 text-gray-500 italic"><?= !empty($r['keterangan']) ? htmlspecialchars($r['keterangan']) : '-'; ?></td>
                </tr>
              <?php } } else { echo "<tr><td colspan='7' class='text-center p-4 text-gray-400'>Belum ada riwayat data</td></tr>"; } ?>
            </tbody>
          </table>
        </div>
        <?php renderPagination($page, $total_pages, 'p_page', 'riwayat'); ?>
      </div>
    </section>

    <section id="tata-tertib">
      <h2 class="text-base font-bold flex items-center gap-2 mb-1"><i class="fas fa-gavel text-blue-900"></i> TATA TERTIB SEKOLAH</h2>
      <p class="text-[10px] font-bold text-gray-500 mb-3 uppercase">Daftar Pelanggaran dan Poin Master</p>
      
      <div class="bg-white rounded-xl shadow-sm border overflow-hidden p-5">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700 uppercase font-semibold">
              <tr>
                <th class="p-2.5 border-b w-12">No</th>
                <th class="p-2.5 border-b">Nama Pelanggaran</th>
                <th class="p-2.5 border-b text-right w-24">Poin</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <?php
              $q_master = mysqli_query($DB, "SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
              $no_tt = 1;
              if($q_master && mysqli_num_rows($q_master) > 0) {
                while($m = mysqli_fetch_array($q_master)){
              ?>
              <tr class="hover:bg-gray-50">
                <td class="p-2.5 font-medium text-gray-500"><?= $no_tt++; ?>.</td>
                <td class="p-2.5 font-medium text-gray-800"><?= htmlspecialchars($m['nama_pelanggaran']); ?></td>
                <td class="p-2.5 text-right">
                  <span class="bg-red-50 text-red-600 text-[10px] font-bold px-2 py-0.5 rounded border border-red-100"><?= $m['poin']; ?> Poin</span>
                </td>
              </tr>
              <?php } } else { echo "<tr><td colspan='3' class='p-4 text-center text-gray-400'>Belum ada data tata tertib.</td></tr>"; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

  </main>

  <footer class="bg-[#0A1D37] text-white py-6 mt-12 border-t border-blue-900/50">
    <div class="container mx-auto max-w-6xl px-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-xs">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <div class="bg-white rounded-full p-1"><img src="img/logocapsis.jpeg" alt="Logo" class="w-6 h-6 object-contain"></div>
          <h3 class="text-lg font-bold">CAPSIS</h3>
        </div>
        <p class="text-gray-400 text-[10px]">© <?= date('Y'); ?> CAPSIS. All Rights Reserved.</p>
      </div>
      <div>
        <h4 class="font-semibold mb-1 border-l-2 border-blue-500 pl-2">Tentang</h4>
        <p class="text-gray-400 leading-relaxed">Sistem manajemen tata tertib untuk memantau data pelanggaran siswa secara terstruktur.</p>
      </div>
      <div>
        <h4 class="font-semibold mb-1 border-l-2 border-blue-500 pl-2">Kontak</h4>
        <p class="text-gray-400"><i class="fas fa-school mr-1 text-blue-400"></i> SMKN 6 Jember</p>
        <p class="text-gray-400"><i class="fas fa-phone mr-1 text-blue-400"></i> (0336) 441347</p>
      </div>
    </div>
  </footer>

  <div id="formModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
      <div class="bg-[#0D3A7C] text-white px-5 py-3 flex justify-between items-center">
        <h3 id="modalTitle" class="font-bold text-sm">Tambah Data Pelanggaran</h3>
        <button type="button" onclick="closeModal()" class="text-xl font-bold">&times;</button>
      </div>
      <form id="violationForm" action="proses_tambah.php" method="POST" class="p-5 space-y-3 text-xs">
        <input type="hidden" id="formIdTransaksi" name="id_transaksi">
        <div>
          <label class="block font-bold text-gray-700 uppercase mb-1">Nama Siswa</label>
          <input type="text" id="formNamaSiswa" name="nama_siswa" required placeholder="Nama lengkap siswa" class="w-full text-xs border-gray-300 rounded shadow-sm">
        </div>
        <div>
          <label class="block font-bold text-gray-700 uppercase mb-1">Kelas</label>
          <input type="text" id="formKelas" name="kelas" placeholder="Contoh: XI RPL 3" required class="w-full text-xs border-gray-300 rounded shadow-sm">
        </div>
        <div>
          <label class="block font-bold text-gray-700 uppercase mb-1">Jenis Pelanggaran</label>
          <select id="formJenis" name="id_pelanggaran" required onchange="updatePoin()" class="w-full text-xs border-gray-300 rounded shadow-sm bg-white">
            <option value="" data-poin="">-- Pilih Jenis Pelanggaran --</option>
            <?php
            $query_p = mysqli_query($DB, "SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
            while($row = mysqli_fetch_array($query_p)){
              echo "<option value='{$row['id_pelanggaran']}' data-poin='{$row['poin']}'>".htmlspecialchars($row['nama_pelanggaran'])."</option>";
            } 
            ?>
          </select>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block font-bold text-gray-700 uppercase mb-1">Poin</label>
            <input type="number" id="formPoin" name="poin" required readonly class="w-full text-xs border-gray-300 rounded shadow-sm bg-gray-100 cursor-not-allowed" placeholder="Otomatis">
          </div>
          <div>
            <label class="block font-bold text-gray-700 uppercase mb-1">Tanggal</label>
            <input type="date" id="formTanggal" name="tanggal" required class="w-full text-xs border-gray-300 rounded shadow-sm">
          </div>
        </div>
        <div>
          <label class="block font-bold text-gray-700 uppercase mb-1">Keterangan</label>
          <textarea id="formKeterangan" name="keterangan" rows="2" class="w-full text-xs border-gray-300 rounded shadow-sm" placeholder="Opsional..."></textarea>
        </div>
        <div class="flex justify-end gap-2 pt-3 border-t">
          <button type="button" onclick="closeModal()" class="px-3 py-1.5 border rounded text-gray-600 hover:bg-gray-100">Batal</button>
          <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function toggleMobileMenu() { document.getElementById('mobileMenu').classList.toggle('hidden'); }
    
    const modal = document.getElementById('formModal'),
          modalTitle = document.getElementById('modalTitle'),
          violationForm = document.getElementById('violationForm');

    function updatePoin() {
      const select = document.getElementById('formJenis');
      document.getElementById('formPoin').value = select.options[select.selectedIndex]?.getAttribute('data-poin') || '';
    }

    function openModal(mode, data = null) {
      modal.classList.remove('hidden'); modal.classList.add('flex');
      if (mode === 'tambah') {
        modalTitle.innerText = 'Tambah Data Pelanggaran';
        violationForm.action = 'proses_tambah.php';
        violationForm.reset();
        document.getElementById('formTanggal').valueAsDate = new Date();
      } else if (mode === 'edit' && data) {
        modalTitle.innerText = 'Edit Data Pelanggaran';
        violationForm.action = 'proses_edit.php';
        document.getElementById('formIdTransaksi').value = data.id_transaksi || '';
        document.getElementById('formNamaSiswa').value = data.nama_siswa || '';
        document.getElementById('formKelas').value = data.kelas || '';
        document.getElementById('formJenis').value = data.id_pelanggaran || '';
        document.getElementById('formPoin').value = data.poin || '';
        document.getElementById('formKeterangan').value = data.keterangan || '';
        document.getElementById('formTanggal').value = data.tanggal || '';
      }
    }

    function closeModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }

    document.addEventListener('DOMContentLoaded', () => {
      const search = document.getElementById('searchInput'),
            table = document.getElementById('violationTable');
      if (search && table) {
        search.addEventListener('keyup', (e) => {
          const term = e.target.value.toLowerCase();
          table.querySelectorAll('tbody tr').forEach((row) => {
            const name = row.querySelector('.student-name')?.textContent.toLowerCase() || '';
            row.style.display = name.includes(term) ? '' : 'none';
          });
        });
      }
    });
  </script>
</body>
</html>