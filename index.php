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

  <nav class="bg-[#0D3A7C] text-white sticky top-0 z-50 shadow-md px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <div class="bg-white p-1.5 rounded-full"><i class="fas fa-balance-scale text-[#0D3A7C] text-xl"></i></div>
      <div>
        <span class="text-2xl font-bold">SIPENA</span>
        <p class="text-[10px] uppercase opacity-80">Sistem Informasi Pelanggaran Siswa</p>
      </div>
    </div>
    <ul class="hidden md:flex gap-8 font-medium text-sm">
      <li><a class="border-b-2 border-white pb-1" href="#">Beranda</a></li>
      <li><a class="opacity-80 hover:opacity-100" href="#">Peringkat</a></li>
      <li><a class="opacity-80 hover:opacity-100" href="#">Riwayat Pelanggaran</a></li>
      <li><a class="opacity-80 hover:opacity-100" href="#">Tata Tertib</a></li>
    </ul>
  </nav>

  <header class="hero-gradient text-white py-20 px-6">
    <div class="container mx-auto max-w-6xl">
      <h1 class="text-6xl font-bold mb-4">SIPENA</h1>
      <p class="text-xl font-medium mb-4">Sistem Informasi Pelanggaran Siswa</p>
      <p class="max-w-xl text-gray-200 mb-8">SIPENA adalah sistem yang digunakan untuk mencatat, memantau, dan menampilkan data pelanggaran siswa secara transparan dan akurat.</p>
      <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-md flex items-center gap-2 font-semibold">
        <i class="fas fa-plus-circle"></i> Lihat Peringkat <i class="fas fa-chevron-right text-xs"></i>
      </button>
    </div>
  </header>

  <div class="container mx-auto max-w-6xl px-6 -mt-12 grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-blue-100 p-4 rounded-lg text-blue-600"><i class="fas fa-users text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Total Siswa</p><h3 class="text-2xl font-bold">452</h3><p class="text-xs text-gray-400">Siswa Terdaftar</p></div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-orange-100 p-4 rounded-lg text-orange-600"><i class="fas fa-file-alt text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Total Pelanggaran</p><h3 class="text-2xl font-bold">1.285</h3><p class="text-xs text-gray-400">Data Pelanggaran</p></div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-red-100 p-4 rounded-lg text-red-600"><i class="fas fa-star text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Total Poin</p><h3 class="text-2xl font-bold">8.765</h3><p class="text-xs text-gray-400">Jumlah Poin</p></div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-4">
      <div class="bg-green-100 p-4 rounded-lg text-green-600"><i class="fas fa-calendar-alt text-2xl"></i></div>
      <div><p class="text-xs text-gray-500 uppercase font-bold">Bulan Ini</p><h3 class="text-2xl font-bold">215</h3><p class="text-xs text-gray-400">Juli 2024</p></div>
    </div>
  </div>

  <main class="container mx-auto max-w-6xl px-6 py-12 space-y-16">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <section class="lg:col-span-3">
        <h2 class="text-lg font-bold flex items-center gap-2 mb-6"><i class="fas fa-trophy text-orange-500"></i> 2. PERINGKAT</h2>
        <div class="bg-white rounded-xl shadow-sm border p-4 space-y-4">
          <h3 class="text-xs font-bold text-blue-900 uppercase border-b pb-2">Top 5 Poin Tertinggi</h3>
          
          <div class="flex justify-between items-center">
            <div class="flex gap-3"><span class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 border flex items-center justify-center font-bold">1</span><div><p class="text-sm font-bold">Andi Pratama</p><p class="text-[10px] text-gray-500">XI IPA 1</p></div></div>
            <div class="text-right"><p class="text-sm font-bold">145</p><p class="text-[10px] text-gray-400">Poin</p></div>
          </div>
          <div class="flex justify-between items-center">
            <div class="flex gap-3"><span class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 border flex items-center justify-center font-bold">2</span><div><p class="text-sm font-bold">Budi Santoso</p><p class="text-[10px] text-gray-500">XI IPA 2</p></div></div>
            <div class="text-right"><p class="text-sm font-bold">120</p><p class="text-[10px] text-gray-400">Poin</p></div>
          </div>
          <div class="flex justify-between items-center">
            <div class="flex gap-3"><span class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center font-bold">3</span><div><p class="text-sm font-bold">Citra Lestari</p><p class="text-[10px] text-gray-500">XII IPS 1</p></div></div>
            <div class="text-right"><p class="text-sm font-bold">100</p><p class="text-[10px] text-gray-400">Poin</p></div>
          </div>
          <div class="flex justify-between items-center">
            <div class="flex gap-3"><span class="w-8 h-8 rounded-full bg-gray-50 text-gray-400 border flex items-center justify-center font-bold">4</span><div><p class="text-sm font-bold">Deni Saputra</p><p class="text-[10px] text-gray-500">XI IPA 1</p></div></div>
            <div class="text-right"><p class="text-sm font-bold">95</p><p class="text-[10px] text-gray-400">Poin</p></div>
          </div>
          <div class="flex justify-between items-center">
            <div class="flex gap-3"><span class="w-8 h-8 rounded-full bg-gray-50 text-gray-400 border flex items-center justify-center font-bold">5</span><div><p class="text-sm font-bold">Eka Putri</p><p class="text-[10px] text-gray-500">X IPS 2</p></div></div>
            <div class="text-right"><p class="text-sm font-bold">80</p><p class="text-[10px] text-gray-400">Poin</p></div>
          </div>
        </div>
      </section>

      <section class="lg:col-span-9">
        <h2 class="text-lg font-bold mb-6">DATA PELANGGARAN</h2>
        <div class="bg-white rounded-xl shadow-sm border p-6">
          <div class="flex flex-wrap gap-4 mb-6">
            <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium"><i class="fas fa-plus"></i> Tambah</button>
            <input id="searchInput" class="text-sm border rounded px-4 py-2 flex-grow max-w-xs" placeholder="Cari nama siswa..." type="text"/>
            <select class="text-sm border rounded px-4 py-2 bg-gray-50"><option>Pilih kelas</option></select>
            <select class="text-sm border rounded px-4 py-2 bg-gray-50"><option>Pilih jenis</option></select>
          </div>
          <div class="overflow-x-auto">
            <table id="violationTable" class="w-full text-left text-sm">
              <thead class="bg-gray-50 text-gray-600 text-[10px] uppercase">
                <tr><th class="p-3 border-b">No</th><th class="p-3 border-b">Nama</th><th class="p-3 border-b">Kelas</th><th class="p-3 border-b">Jenis</th><th class="p-3 border-b">Poin</th><th class="p-3 border-b">Tanggal</th><th class="p-3 border-b">Aksi</th></tr>
              </thead>
              <tbody class="divide-y">
                <tr class="hover:bg-gray-50">
                  <td class="p-3">1</td><td class="p-3 font-medium student-name">Andi Pratama</td><td class="p-3">XI IPA 1</td><td class="p-3 text-red-500">Terlambat</td><td class="p-3">10</td><td class="p-3">29 Jul 2024</td>
                  <td class="p-3 flex gap-1"><button class="bg-blue-500 text-white p-1.5 rounded"><i class="fas fa-eye text-xs"></i></button><button class="bg-orange-400 text-white p-1.5 rounded"><i class="fas fa-edit text-xs"></i></button><button class="bg-red-500 text-white p-1.5 rounded"><i class="fas fa-trash text-xs"></i></button></td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="p-3">2</td><td class="p-3 font-medium student-name">Budi Santoso</td><td class="p-3">XI IPA 2</td><td class="p-3">Tidak atribut</td><td class="p-3">5</td><td class="p-3">29 Jul 2024</td>
                  <td class="p-3 flex gap-1"><button class="bg-blue-500 text-white p-1.5 rounded"><i class="fas fa-eye text-xs"></i></button><button class="bg-orange-400 text-white p-1.5 rounded"><i class="fas fa-edit text-xs"></i></button><button class="bg-red-500 text-white p-1.5 rounded"><i class="fas fa-trash text-xs"></i></button></td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="p-3">3</td><td class="p-3 font-medium student-name">Citra Lestari</td><td class="p-3">XII IPS 1</td><td class="p-3 text-red-500">Membolos</td><td class="p-3">20</td><td class="p-3">28 Jul 2024</td>
                  <td class="p-3 flex gap-1"><button class="bg-blue-500 text-white p-1.5 rounded"><i class="fas fa-eye text-xs"></i></button><button class="bg-orange-400 text-white p-1.5 rounded"><i class="fas fa-edit text-xs"></i></button><button class="bg-red-500 text-white p-1.5 rounded"><i class="fas fa-trash text-xs"></i></button></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="flex justify-center mt-6 gap-1">
            <button class="w-8 h-8 border rounded text-gray-400">«</button>
            <button class="w-8 h-8 bg-blue-600 text-white rounded">1</button>
            <button class="w-8 h-8 border rounded text-gray-600">2</button>
            <button class="w-8 h-8 border rounded text-gray-600">»</button>
          </div>
        </div>
      </section>
    </div>

    <section>
      <h2 class="text-lg font-bold flex items-center gap-2 mb-6"><i class="fas fa-history text-blue-600"></i> 3. RIWAYAT PELANGGARAN</h2>
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-9 bg-white rounded-xl shadow-sm border overflow-hidden">
          <div class="bg-gray-50 p-4 border-b"><h3 class="text-xs font-bold text-blue-900 uppercase">10 Data Pelanggaran Terbaru</h3></div>
          <table class="w-full text-left text-[13px] divide-y">
            <thead class="bg-gray-50 text-gray-500 font-semibold border-b">
              <tr><th class="p-3">No</th><th class="p-3">Nama</th><th class="p-3">Kelas</th><th class="p-3">Jenis</th><th class="p-3">Poin</th><th class="p-3">Tanggal</th><th class="p-3">Keterangan</th></tr>
            </thead>
            <tbody class="divide-y">
              <tr><td class="p-3">1</td><td class="p-3 font-medium">Andi Pratama</td><td class="p-3">XI IPA 1</td><td class="p-3">Terlambat</td><td class="p-3">10</td><td class="p-3">29 Jul 2024 07:30</td><td class="p-3">Datang pukul 07.30</td></tr>
              <tr><td class="p-3">2</td><td class="p-3 font-medium">Budi Santoso</td><td class="p-3">XI IPA 2</td><td class="p-3">Tidak atribut</td><td class="p-3">5</td><td class="p-3">29 Jul 2024 07:20</td><td class="p-3">Tidak memakai dasi</td></tr>
            </tbody>
          </table>
        </div>
        <div class="lg:col-span-3 bg-blue-50 border rounded-xl p-6 text-center flex flex-col items-center justify-center">
          <blockquote class="text-blue-900 italic font-medium text-sm mb-2">"Disiplin adalah jembatan antara tujuan dan pencapaian."</blockquote>
          <cite class="text-xs text-blue-500 font-bold">— John Rohn</cite>
        </div>
      </div>
    </section>

    <section>
      <h2 class="text-lg font-bold flex items-center gap-2 mb-2"><i class="fas fa-gavel text-blue-900"></i> 4. TATA TERTIB SEKOLAH</h2>
      <p class="text-xs font-bold text-gray-500 mb-6 uppercase">Daftar Pelanggaran dan Poin</p>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <div class="bg-white border rounded-lg p-4 shadow-sm"><div class="flex items-center gap-2 mb-2"><i class="fas fa-clock text-blue-500"></i><span class="text-sm font-bold">1. Terlambat</span></div><p class="text-xs text-gray-500 mb-3">Datang setelah bel masuk.</p><span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded border">10 Poin</span></div>
        <div class="bg-white border rounded-lg p-4 shadow-sm"><div class="flex items-center gap-2 mb-2"><i class="fas fa-user-tie text-green-500"></i><span class="text-sm font-bold">2. Tidak atribut</span></div><p class="text-xs text-gray-500 mb-3">Tidak memakai atribut lengkap.</p><span class="bg-green-50 text-green-600 text-[10px] font-bold px-2 py-1 rounded border">5 Poin</span></div>
        <div class="bg-white border rounded-lg p-4 shadow-sm"><div class="flex items-center gap-2 mb-2"><i class="fas fa-walking text-orange-500"></i><span class="text-sm font-bold">3. Membolos</span></div><p class="text-xs text-gray-500 mb-3">Tidak masuk kelas tanpa izin.</p><span class="bg-orange-50 text-orange-600 text-[10px] font-bold px-2 py-1 rounded border">20 Poin</span></div>
        <div class="bg-white border rounded-lg p-4 shadow-sm"><div class="flex items-center gap-2 mb-2"><i class="fas fa-smoking text-red-500"></i><span class="text-sm font-bold">4. Merokok</span></div><p class="text-xs text-gray-500 mb-3">Merokok di lingkungan sekolah.</p><span class="bg-red-50 text-red-600 text-[10px] font-bold px-2 py-1 rounded border">20 Poin</span></div>
        <div class="bg-white border rounded-lg p-4 shadow-sm"><div class="flex items-center gap-2 mb-2"><i class="fas fa-cut text-purple-500"></i><span class="text-sm font-bold">5. Rambut panjang</span></div><p class="text-xs text-gray-500 mb-3">Rambut tidak rapi/sesuai.</p><span class="bg-purple-50 text-purple-600 text-[10px] font-bold px-2 py-1 rounded border">10 Poin</span></div>
      </div>
      
      <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded text-xs text-blue-900"><span class="font-bold">Catatan:</span> Poin pelanggaran akan diakumulasikan untuk menentukan sanksi.</div>
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

  <script>
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