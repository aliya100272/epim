<?php
include "koneksi.php";

$id_transaksi   = $_POST['id_transaksi'];
$nama_siswa     = $_POST['nama_siswa'];
$kelas_jurusan  = strtoupper($_POST['kelas_jurusan']);
$id_pelanggaran = $_POST['id_pelanggaran'];
$keterangan     = $_POST['keterangan'];
$tanggal        = $_POST['tanggal'];

// Pisahkan kelas dan jurusan
$data = explode(" ", $kelas_jurusan);
$kelas = $data[0]." ".$data[2];
$jurusan = $data[1];

// Ambil poin otomatis
$pelanggaran = mysqli_fetch_assoc(mysqli_query($DB,
"SELECT poin FROM pelanggaran
WHERE id_pelanggaran='$id_pelanggaran'"));

$poin = $pelanggaran['poin'];

// Ambil id_siswa
$transaksi = mysqli_fetch_assoc(mysqli_query($DB,
"SELECT id_siswa
FROM transaksi
WHERE id_transaksi='$id_transaksi'"));

$id_siswa = $transaksi['id_siswa'];

// Update data siswa
mysqli_query($DB,"
UPDATE siswa SET
nama_siswa='$nama_siswa',
kelas='$kelas',
jurusan='$jurusan'
WHERE id_siswa='$id_siswa'
");

// Update transaksi
mysqli_query($DB,"
UPDATE transaksi SET
kelas='$kelas_jurusan',
id_pelanggaran='$id_pelanggaran',
poin='$poin',
tangal='$tanggal',
keterangan='$keterangan'
WHERE id_transaksi='$id_transaksi'
");

header("Location:index.php");
exit;
?>