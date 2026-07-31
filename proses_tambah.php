<?php
include "koneksi.php";

$nama_siswa     = trim($_POST['nama_siswa'] ?? '');
$kelas          = trim($_POST['kelas'] ?? '');
$id_pelanggaran = $_POST['id_pelanggaran'] ?? '';
$poin           = $_POST['poin'] ?? 0;
$tanggal        = $_POST['tanggal'] ?? date('Y-m-d');

if(!empty($nama_siswa) && !empty($id_pelanggaran)){
    
    // Cek apakah siswa sudah ada di tabel 'siswa'
    $cek_siswa = mysqli_query($DB, "SELECT id_siswa FROM siswa WHERE nama_siswa = '$nama_siswa' LIMIT 1");

    if(mysqli_num_rows($cek_siswa) > 0){
        $row_siswa = mysqli_fetch_assoc($cek_siswa);
        $id_siswa  = $row_siswa['id_siswa'];
    } else {
        // Simpan siswa baru hanya dengan nama_siswa
        $insert_siswa = mysqli_query($DB, "INSERT INTO siswa (nama_siswa) VALUES ('$nama_siswa')");
        $id_siswa     = mysqli_insert_id($DB);
    }

    // Simpan ke tabel transaksi (menggunakan nama kolom 'tangal')
    $insert_transaksi = mysqli_query($DB, "INSERT INTO transaksi (id_siswa, kelas, id_pelanggaran, poin, tangal) 
                                           VALUES ('$id_siswa', '$kelas', '$id_pelanggaran', '$poin', '$tanggal')");

    if($insert_transaksi){
        echo "<script>alert('Data berhasil disimpan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!'); window.location='index.php';</script>";
    }

} else {
    header("Location: index.php");
}
?>