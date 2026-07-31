<?php
include "koneksi.php";

$id_transaksi   = $_POST['id_transaksi'] ?? '';
$nama_siswa     = trim($_POST['nama_siswa'] ?? '');
$kelas          = trim($_POST['kelas'] ?? '');
$id_pelanggaran = $_POST['id_pelanggaran'] ?? '';
$poin           = $_POST['poin'] ?? 0;
$tanggal        = $_POST['tanggal'] ?? date('Y-m-d');

if(!empty($id_transaksi) && !empty($nama_siswa)){

    // 1. Ambil id_siswa dari transaksi yang sedang di-edit
    $q_trans = mysqli_query($DB, "SELECT id_siswa FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    
    if(mysqli_num_rows($q_trans) > 0){
        $trans = mysqli_fetch_assoc($q_trans);
        $id_siswa = $trans['id_siswa'];

        // 2. Update nama siswa di tabel 'siswa'
        mysqli_query($DB, "UPDATE siswa SET nama_siswa = '$nama_siswa' WHERE id_siswa = '$id_siswa'");

        // 3. Update data pelanggaran di tabel 'transaksi' (menggunakan nama kolom 'tangal')
        $update_transaksi = mysqli_query($DB, "UPDATE transaksi SET 
                                                kelas = '$kelas', 
                                                id_pelanggaran = '$id_pelanggaran', 
                                                poin = '$poin', 
                                                tangal = '$tanggal' 
                                                WHERE id_transaksi = '$id_transaksi'");

        if($update_transaksi){
            echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui transaksi!'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Data transaksi tidak ditemukan!'); window.location='index.php';</script>";
    }

} else {
    header("Location: index.php");
}
?>