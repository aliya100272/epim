<?php
include "koneksi.php";

function e($v) {return htmlspecialchars($v ?? '');}
function pag($cur,$tot,$p,$h) {
    if($tot < 2) return;
    $o = isset($_GET[$p== 'd_page'?'p_page':'d_page'])? '&'.($p== 'd_page'?'p_page':'d_page').'='.(int)$_GET[$p== 'd_page'?'p_page':'d_page'] : '';
    echo "<div class='mt-4 flex justify-end gap-1 text-xs'>";
    for($i=1;$i<=$tot;$i++) {
        $c = $i== $cur ? 'bg-blue-900 text-white' : 'bg-white text-gray-900';
        echo "<a href='?{$p}=$i$o#$h' class='py-3 px-1.5 border rounded font-semibold $c'>$i</a>";
    }
    echo "</div>";
}

$stat = mysqli_fetch_assoc(mysqli_query($DB, "
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
        <nav class="bg-[#0D3A7C] sticky top-0 z-40 text-white">
            <div class="max-w-6xl mx-auto flex px-6 py-4 justify-between">
                <div class="flex gap-3 items-center">
                    <img src="img/logocapsis.jpeg" class="rounded-full bg-white w-12 h-12 p-2" alt="CAPSIS">
                    <div>
                        <b class="text-2xl">CAPSIS</b>
                        <p class="text-[10px]">CATATAN PELANGGARAN SISWA</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center text-sm gap-6">
                    <a href="#">Beranda</a>
                    <a href="#data-pelanggaran">Data Pelanggran</a>
                    <a href="#riwayat">Riwayat</a>
                    <a href="#tata-tertib">Tata Tertib</a>
                    <a href="logout.php" onclick="return confirm('Yakin keluar?')" class="px-4 py-2 border rounded">Logout</a>
                </div>
            </div>
        </nav>

        <header class="hero text-white px-6 py-16">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-5xl font-bold">CAPSIS</h1>
                <p class="text-xl">Sistem Pencatatan Pelanggaran siswa</p>
                <p class="max-w-xl mb-6 text-gray-200">
                    rgrgegrjg gggggggggggggggg ggggggggg gggggggggggg jrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrr rrrrrrrr restore_error_handler
                </p>
                <a href="#peringkat" class="bg-blue-600 px-5 py-2.5 border rounded">
                    <i class="fas fa-trophy"></i> Lihat Peringkat
                </a>
            </div>
        </header>

        <div class="max-w-6xl mx-auto gap-4 grid md:grid-cols-4 px-6 -mt-8">
            <?php
            $cards = [
                ['Siswa Terdaftar',$stat['total_siswa'],'jumlah Siswa','blue','fa-users'],
                ['Total Pelanggaran',$stat['total_transaksi'],'Total Transaksi','orange','fa-file-alt'],
                ['Total Poin',$stat['total_poin'],'Poin','red','fa-star'],
                ['Bulan Ini',$stat['bulan_ini'],date('F Y'),'green','fa-calendar-alt']
            ];
            foreach($cards as $c):
            ?>
            <div class="bg-white p-5 rounded-lg shadow flex items-center gap-4">
                <div class="bg-<?= $c[3]?>-100 text-<?= $c[3]?>-600 rounded-lg p-3">
                    <i class="fas <?= $c[4]?>"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500"><?= $c[0]?></p>
                    <h3 class="text-xl font-bold"><?= number_format($c[1])?></h3>
                    <p class="text-xs text-gray-500"><?= $c[2]?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <main class="max-w-6xl mx-auto px-6 my-10 space-y-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <section id="peringkat" class="lg:col-span-4">
                <h2 class="font-bold mb-5"><i class="fas fa-trophy text-orange-500"></i> PERINGKAT</h2>
                <div class="bg-white border rounded-xl shadow p-5">
                    <h3 class="text-blue-800 text-sm font-bold mb-5">Top 5 poin terbanyak</h3>

                    <?php 
                    $q=mysqli_query($DB, "SELECT s.nama_siswa, s.kelas, SUM(t.poin) total_poin
                    from transaksi t
                    join siswa s on t.id_siswa=s.id_siswa
                    group by t.id_siswa
                    order by total_poin desc limit 5");

                    $r=1;
                    if(mysqli_)