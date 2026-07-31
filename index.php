<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIPENA - Sistem Informasi Pelanggaran Siswa</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }

    .hero-gradient {
      background: linear-gradient(rgba(13,58,124,.85), rgba(13,58,124,.85)), 
                  url('https://picsum.photos/1200/600') center/cover;
    }
  </style>
</head>
<body class="bg-gray-50 text-slate-800">

  <?php include "koneksi.php"; ?>

  <nav class="bg-[#0D3A7C] text-white sticky top-0 z-40 shadow-md px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <div class="bg-white p-1.5 rounded-full"><i class="fas fa-balance-scale text-[#0D3A7C] text-xl"></i></div>
      <div>
        <span class="text-2xl font-bold">SIPENA</span>
        <p class="text-[10px] uppercase opacity-80">Sistem Informasi Pelanggaran Siswa</p>
      </div>
    </div>
    <ul class="hidden md:flex gap-8 font-medium text-sm">
      <li><a class="border-b-2 border-white pb-1" href="#">Beranda</a></li>
      <li><a class="opacity-80 hover:opacity-100" href="#peringkat">Peringkat</a></li>
      <li><a class="opacity-80 hover:opacity-100" href="#data-pelanggaran">Data Pelanggaran</a></li>
      <li><a class="opacity-80 hover:opacity-100" href="#tata-tertib">Tata Tertib</a></li>
    </ul>
  </nav>

  <header class="hero-gradient text-white py-20 px-6">
    <div class="container mx-auto max-w-6xl">
      <h1 class="text-6xl font-bold mb-4">SIPENA</h1>
      <p class="text-xl font-medium mb-4">Sistem Informasi Pelanggaran Siswa</p>
      <p class="max-w-xl text-gray-200 mb-8">SIPENA adalah sistem yang digunakan untuk mencatat, memantau, dan menampilkan data pelanggaran siswa secara transparan dan akurat.</p>
      <a href="#peringkat" class="inline-flex bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-md items-center gap-2 font-semibold">
        <i class="fas fa-trophy"></i> Lihat Peringkat <i class="fas fa-chevron-right text-xs"></i>
      </a>
    </div>
  </header>

  <?php
    $q_total_siswa = mysqli_query($DB, "SELECT COUNT(*) as total FROM siswa");
    $total_siswa = mysqli_fetch_assoc($q_total_siswa)['total'] ?? 0;

    $q_total_trans = mysqli_query($DB, "SELECT COUNT(*) as total FROM transaksi");
    $total_transaksi = mysqli_fetch_assoc($q_total_trans)['total'] ?? 0;

    $q_total_poin = mysqli_query($DB, "SELECT SUM(poin) as total FROM transaksi");
    $total_poin = mysqli_fetch_assoc($q_total_poin)['total'] ?? 0;

    $q_bulan_ini = mysqli_query($DB, "SELECT COUNT(*) as total FROM transaksi WHERE MONTH(tangal) = MONTH(CURRENT_DATE()) AND YEAR(tangal) = YEAR(CURRENT_DATE())");
    $bulan_ini = mysqli_fetch_assoc($q_bulan_ini)['total'] ?? 0;
  ?>

  <div class="container mx-auto max-w-6xl px-6 -mt-12 grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-blue-100 p-4 rounded-lg text-blue-600"><i class="fas fa-users text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Total Siswa</p><h3 class="text-2xl font-bold"><?= number_format($total_siswa); ?></h3><p class="text-xs text-gray-400">Siswa Terdaftar</p></div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-orange-100 p-4 rounded-lg text-orange-600"><i class="fas fa-file-alt text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Total Pelanggaran</p><h3 class="text-2xl font-bold"><?= number_format($total_transaksi); ?></h3><p class="text-xs text-gray-400">Data Transaksi</p></div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-red-100 p-4 rounded-lg text-red-600"><i class="fas fa-star text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Total Poin</p><h3 class="text-2xl font-bold"><?= number_format($total_poin); ?></h3><p class="text-xs text-gray-400">Jumlah Poin</p></div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-green-100 p-4 rounded-lg text-green-600"><i class="fas fa-calendar-alt text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Bulan Ini</p><h3 class="text-2xl font-bold"><?= number_format($bulan_ini); ?></h3><p class="text-xs text-gray-400"><?= date('F Y'); ?></p></div>
    </div>
  </div>

  <main class="container mx-auto max-w-6xl px-6 py-12 space-y-16">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <section id="peringkat" class="lg:col-span-3">
        <h2 class="text-lg font-bold flex items-center gap-2 mb-6"><i class="fas fa-trophy text-orange-500"></i> PERINGKAT</h2>
        <div class="bg-white rounded-xl shadow-sm border p-4 space-y-4">
          <h3 class="text-xs font-bold text-blue-900 uppercase border-b pb-2">Top 5 Poin Tertinggi</h3>
          
          <?php
          $q_top = "SELECT s.nama_siswa, t.kelas, SUM(t.poin) as total_poin 
                    FROM transaksi t 
                    JOIN siswa s ON t.id_siswa = s.id_siswa 
                    GROUP BY t.id_siswa 
                    ORDER BY total_poin DESC LIMIT 5";
          $res_top = mysqli_query($DB, $q_top);
          $rank = 1;

          if($res_top && mysqli_num_rows($res_top) > 0){
            while($top = mysqli_fetch_array($res_top)){
          ?>
          <div class="flex justify-between items-center">
            <div class="flex gap-3">
              <span class="w-8 h-8 rounded-full <?= $rank == 1 ? 'bg-orange-100 text-orange-500' : 'bg-gray-100 text-gray-500'; ?> border flex items-center justify-center font-bold text-xs"><?= $rank++; ?></span>
              <div>
                <p class="text-sm font-bold"><?= htmlspecialchars($top['nama_siswa']); ?></p>
                <p class="text-[10px] text-gray-500"><?= htmlspecialchars($top['kelas']); ?></p>
              </div>
            </div>
            <div class="text-right">
              <p class="text-sm font-bold text-red-600"><?= $top['total_poin']; ?></p>
              <p class="text-[10px] text-gray-400">Poin</p>
            </div>
          </div>
          <?php 
            }
          } else {
            echo "<p class='text-xs text-gray-400 italic text-center'>Belum ada data</p>";
          }
          ?>

        </div>
      </section>

      <section id="data-pelanggaran" class="lg:col-span-9">
        <h2 class="text-lg font-bold mb-6">DATA PELANGGARAN</h2>
        <div class="bg-white rounded-xl shadow-sm border p-6">
          <div class="flex flex-wrap gap-4 mb-6">
            <button onclick="openModal('tambah')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium transition flex items-center gap-2">
              <i class="fas fa-plus"></i> Tambah Pelanggaran
            </button>
            <input id="searchInput" class="text-sm border rounded px-4 py-2 flex-grow max-w-xs" placeholder="Cari nama siswa..." type="text"/>
          </div>
          
          <div class="overflow-x-auto">
            <table id="violationTable" class="w-full text-left text-sm">
              <thead class="bg-gray-50 text-gray-600 text-[10px] uppercase">
                <tr>
                  <th class="p-3 border-b">No</th>
                  <th class="p-3 border-b">Nama Siswa</th>
                  <th class="p-3 border-b">Kelas</th>
                  <th class="p-3 border-b">Jenis Pelanggaran</th>
                  <th class="p-3 border-b">Poin</th>
                  <th class="p-3 border-b">Tanggal</th>
                  <th class="p-3 border-b">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y">

                <?php
                $no = 1;
                $query_transaksi = "SELECT t.*, s.nama_siswa, p.nama_pelanggaran 
                                    FROM transaksi t
                                    JOIN siswa s ON t.id_siswa = s.id_siswa
                                    JOIN pelanggaran p ON t.id_pelanggaran = p.id_pelanggaran
                                    WHERE DATE(t.tangal)=CURDATE()
                                    ORDER BY t.id_transaksi DESC";

                $data = mysqli_query($DB, $query_transaksi);

                if($data && mysqli_num_rows($data) > 0){
                  while($d = mysqli_fetch_array($data)){
                ?>

                <tr class="hover:bg-gray-50">
                  <td class="p-3"><?= $no++; ?></td>
                  <td class="p-3 font-semibold student-name"><?= htmlspecialchars($d['nama_siswa']); ?></td>
                  <td class="p-3"><?= htmlspecialchars($d['kelas']); ?></td>
                  <td class="p-3"><?= htmlspecialchars($d['nama_pelanggaran']); ?></td>
                  <td class="p-3"><span class="bg-red-50 text-red-600 px-2 py-0.5 rounded font-bold text-xs"><?= $d['poin']; ?></span></td>
                  <td class="p-3 text-gray-500 text-xs"><?= date('d M Y', strtotime($d['tangal'])); ?></td>
                  <td class="p-3 flex gap-1">
                    <button 
                      type="button"
                      onclick="openModal('edit', {
                        id_transaksi: '<?= $d['id_transaksi']; ?>',
                        nama_siswa: '<?= addslashes($d['nama_siswa']); ?>',
                        kelas: '<?= addslashes($d['kelas']); ?>',
                        id_pelanggaran: '<?= $d['id_pelanggaran']; ?>',
                        poin: '<?= $d['poin']; ?>',
                        keterangan: '<?= addslashes($d['keterangan']); ?>'
                        tanggal: '<?= $d['tangal']; ?>'
                      })" 
                      class="bg-orange-500 hover:bg-orange-600 text-white p-2 rounded transition">
                      <i class="fas fa-edit"></i>
                    </button>

                    <a href="hapus.php?id=<?= $d['id_transaksi']; ?>"
                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>

                <?php 
                  }
                } else {
                  echo "<tr><td colspan='7' class='text-center p-4 text-gray-400'>Belum ada data pelanggaran</td></tr>";
                } 
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </section>

      <section class="mt-10">
        <h2 class="text-2xl font-bold mb-5">Riwayat Pelanggaran</h2>
        <div class="bg-white rounded-xl shadow border overflow-x-auto">
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm">

            <thead class="bg-gray-100">
            <tr>
              <th class="p-3 text-left">No</th>
              <th class="p-3 text-left">Nama</th>
              <th class="p-3 text-left">Kelas</th>
              <th class="p-3 text-left">Pelanggaran</th>
              <th class="p-3 text-left">Poin</th>
              <th class="p-3 text-left">Tanggal</th>
              <th class="p-3 text-left">Keterangan</th>
            </tr>
            </thead>

            <tbody>
              <?php
              $no=1;

                $riwayat=mysqli_query($DB,"
                SELECT transaksi.*, siswa.nama_siswa, siswa.kelas, siswa.jurusan,pelanggaran.nama_pelanggaran FROM transaksi
                JOIN siswa ON transaksi.id_siswa=siswa.id_siswa
                JOIN pelanggaran ON transaksi.id_pelanggaran=pelanggaran.id_pelanggaran
                ORDER BY tangal DESC");
              ?>

            <?php while($d=mysqli_fetch_assoc($riwayat)){ ?>

            <tr class="border-b hover:bg-gray-50">
              <td class="p-3"><?= $no++; ?></td>
              <td class="p-3"><?= $d['nama_siswa']; ?></td>
              <td class="p-3"><?= $d['kelas']." ".$d['jurusan']; ?></td>
              <td class="p-3"><?= $d['nama_pelanggaran']; ?></td>
              <td class="p-3"><?= $d['poin']; ?></td>
              <td class="p-3"><?= date('d M Y',strtotime($d['tangal'])); ?></td>
              <td class="p-3"><?= $d['keterangan']; ?></td>
            </tr>

            <?php } ?>

            </tbody>

            </table>

          </div>
        </div>
      </section>
    </div>

    <section id="tata-tertib">
      <h2 class="text-lg font-bold flex items-center gap-2 mb-2"><i class="fas fa-gavel text-blue-900"></i> TATA TERTIB SEKOLAH</h2>
      <p class="text-xs font-bold text-gray-500 mb-6 uppercase">Daftar Pelanggaran dan Poin Master</p>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <?php
        $q_master = mysqli_query($DB, "SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
        while($m = mysqli_fetch_array($q_master)){
        ?>
        <div class="bg-white border rounded-lg p-4 shadow-sm">
          <div class="flex items-center gap-2 mb-2">
            <i class="fas fa-exclamation-triangle text-amber-500"></i>
            <span class="text-sm font-bold"><?= htmlspecialchars($m['nama_pelanggaran']); ?></span>
          </div>
          <p class="text-xs text-gray-500 mb-3">Poin Sanksi: <?= $m['poin']; ?></p>
          <span class="bg-red-50 text-red-600 text-[10px] font-bold px-2 py-1 rounded border"><?= $m['poin']; ?> Poin</span>
        </div>
        <?php } ?>
      </div>
    </section>

  </main>

  <footer class="bg-[#0A1D37] text-white py-12 mt-12">
    <div class="container mx-auto max-w-6xl px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
      <div>
        <div class="flex items-center gap-2 mb-4"><i class="fas fa-balance-scale text-2xl"></i><span class="text-2xl font-bold">SIPENA</span></div>
        <p class="text-gray-400">Sistem Informasi Pelanggaran Siswa</p>
        <p class="text-gray-500 text-xs mt-6">© 2024 SIPENA. All rights reserved.</p>
      </div>
      <div>
        <h4 class="font-bold mb-4 border-l-4 border-blue-500 pl-3 uppercase">Tentang</h4>
        <p class="text-gray-400">Dibuat untuk mendukung kedisiplinan siswa secara transparan dan terstruktur.</p>
      </div>
      <div>
        <h4 class="font-bold mb-4 border-l-4 border-blue-500 pl-3 uppercase">Kontak</h4>
        <p class="text-gray-400">SMAN 1 Contoh | (033) 1234-5678 | info@sman1contoh.sch.id</p>
      </div>
    </div>
  </footer>

  <div id="formModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
      <div class="bg-[#0D3A7C] text-white px-6 py-4 flex justify-between items-center">
        <h3 id="modalTitle" class="font-bold text-lg">Tambah Data Pelanggaran</h3>
        <button type="button" onclick="closeModal()" class="text-white hover:text-gray-300 text-xl font-bold">&times;</button>
      </div>

      <form id="violationForm" action="proses_tambah.php" method="POST" class="p-6 space-y-4">
        <input type="hidden" id="formIdTransaksi" name="id_transaksi">

        <div>
          <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Siswa</label>
          <input type="text" id="formNamaSiswa" name="nama_siswa" required placeholder="Masukkan nama lengkap siswa" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label>Kelas</label>
          <input id="formKelas"type="text"name="kelas_jurusan"placeholder="Contoh: XI RPL 3" required>
        </div>

        <div>
          <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Jenis Pelanggaran</label>
          <select id="formJenis" name="id_pelanggaran" required onchange="updatePoin()" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white">
            <option value="" data-poin="">-- Pilih Jenis Pelanggaran --</option>
            <?php
            $query_pelanggaran = mysqli_query($DB, "SELECT * FROM pelanggaran ORDER BY nama_pelanggaran ASC");
            while($row = mysqli_fetch_array($query_pelanggaran)){
            ?>
              <option value="<?= $row['id_pelanggaran']; ?>" data-poin="<?= $row['poin']; ?>">
                <?= htmlspecialchars($row['nama_pelanggaran']); ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Poin</label>
            <input type="number" id="formPoin" name="poin" required readonly class="w-full text-sm border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed focus:border-blue-500 focus:ring-blue-500" placeholder="Poin otomatis">
          </div>
          <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Tanggal</label>
            <input type="date" id="formTanggal" name="tanggal" required class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
        </div>
            <label>Keterangan</label>

              <textarea id="formKeterangan"name="keterangan"rows="3"class="w-full border rounded-lg p-2"></textarea>
        <div class="flex justify-end gap-2 pt-4 border-t">
          <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 transition">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('formModal');
    const modalTitle = document.getElementById('modalTitle');
    const violationForm = document.getElementById('violationForm');

    function updatePoin() {
      const selectJenis = document.getElementById('formJenis');
      const inputPoin = document.getElementById('formPoin');
      
      const selectedOption = selectJenis.options[selectJenis.selectedIndex];
      const poin = selectedOption.getAttribute('data-poin');
      
      inputPoin.value = poin ? poin : '';
    }

    function openModal(mode, data = null) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');

      if (mode === 'tambah') {
        modalTitle.innerText = 'Tambah Data Pelanggaran';
        violationForm.action = 'proses_tambah.php';
        violationForm.reset();
        document.getElementById('formIdTransaksi').value = '';
        document.getElementById('formPoin').value = '';
        document.getElementById('formTanggal').valueAsDate = new Date();
      } else if (mode === 'edit' && data) {
        modalTitle.innerText = 'Edit Data Pelanggaran';
        violationForm.action = 'proses_edit.php';
        
        document.getElementById('formIdTransaksi').value = data.id_transaksi || '';
        document.getElementById('formNamaSiswa').value = data.nama_siswa || '';
        document.getElementById('formKelas').value = data.kelas || '';
        document.getElementById('formJenis').value = data.id_pelanggaran || '';
        document.getElementById('formPoin').value = data.poin || '';
        document.getElementById('formKeterangan').value=data.keterangan||'';
        document.getElementById('formTanggal').value = data.tanggal || '';
      }
    }

    function closeModal() {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', () => {
      const searchInput = document.getElementById('searchInput');
      const violationTable = document.getElementById('violationTable');

      if (searchInput && violationTable) {
        searchInput.addEventListener('keyup', (e) => {
          const term = e.target.value.toLowerCase();
          violationTable.querySelectorAll('tbody tr').forEach((row) => {
            const name = row.querySelector('.student-name')?.textContent.toLowerCase() || '';
            row.style.display = name.includes(term) ? '' : 'none';
          });
        });
      }
    });
  </script>
</body>
</html>