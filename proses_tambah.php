<?php
include "koneksi.php";

$nama = $_POST['nama_siswa'];
$kelas_jurusan = strtoupper($_POST['kelas_jurusan']);
$id_pelanggaran = $_POST['id_pelanggaran'];
$keterangan = $_POST['keterangan'];
$tanggal = $_POST['tanggal'];

$data = explode(" ", $kelas_jurusan);
$kelas = $data[0]." ".$data[2];
$jurusan = $data[1];

// Ambil poin otomatis
$p = mysqli_fetch_assoc(mysqli_query($DB,
"SELECT poin FROM pelanggaran WHERE id_pelanggaran='$id_pelanggaran'"));
$poin = $p['poin'];

// Cek siswa
$cek = mysqli_query($DB,"SELECT * FROM siswa WHERE nama_siswa='$nama'");

if(mysqli_num_rows($cek)>0){
    $siswa = mysqli_fetch_assoc($cek);
    $id_siswa = $siswa['id_siswa'];

    mysqli_query($DB,"
    UPDATE siswa SET
    kelas='$kelas',
    jurusan='$jurusan'
    WHERE id_siswa='$id_siswa'
    ");

}else{

    mysqli_query($DB,"
    INSERT INTO siswa(nama_siswa,kelas,jurusan)
    VALUES('$nama','$kelas','$jurusan')
    ");

    $id_siswa = mysqli_insert_id($DB);
}

// Simpan transaksi
mysqli_query($DB,"
INSERT INTO transaksi(id_siswa,kelas,id_pelanggaran,poin,tangal,keterangan)
VALUES('$id_siswa','$kelas_jurusan','$id_pelanggaran','$poin','$tanggal','$keterangan')
");

header("Location:index.php");
?>