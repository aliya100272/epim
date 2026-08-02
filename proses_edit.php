<?php
include "koneksi.php";

// 1. Ambil data dari form edit dengan sanitasi
$id_transaksi   = mysqli_real_escape_string($DB, $_POST['id_transaksi']);
$nama_siswa     = mysqli_real_escape_string($DB, $_POST['nama_siswa']);
$kelas          = mysqli_real_escape_string($DB, $_POST['kelas']);
$id_pelanggaran = mysqli_real_escape_string($DB, $_POST['id_pelanggaran']);
$keterangan     = mysqli_real_escape_string($DB, $_POST['keterangan']);
$tanggal        = mysqli_real_escape_string($DB, $_POST['tanggal']);

// 2. Ambil poin terbaru berdasarkan id_pelanggaran yang dipilih
$q_pelanggaran = mysqli_query($DB, "SELECT poin FROM pelanggaran WHERE id_pelanggaran = '$id_pelanggaran'");
$pelanggaran   = mysqli_fetch_assoc($q_pelanggaran);
$poin          = $pelanggaran['poin'] ?? 0;

// 3. Ambil id_siswa dari tabel transaksi
$q_transaksi = mysqli_query($DB, "SELECT id_siswa FROM transaksi WHERE id_transaksi = '$id_transaksi'");
$transaksi   = mysqli_fetch_assoc($q_transaksi);

if ($transaksi) {
    $id_siswa = $transaksi['id_siswa'];

    // 4. Update data siswa (hanya nama_siswa dan kelas, tanpa kolom jurusan)
    $update_siswa = "UPDATE siswa SET 
                        nama_siswa = '$nama_siswa',
                        kelas = '$kelas'
                     WHERE id_siswa = '$id_siswa'";
    mysqli_query($DB, $update_siswa);

    // 5. Update data transaksi pelanggaran
    $update_transaksi = "UPDATE transaksi SET 
                            id_pelanggaran = '$id_pelanggaran',
                            poin = '$poin',
                            tangal = '$tanggal',
                            keterangan = '$keterangan'
                         WHERE id_transaksi = '$id_transaksi'";
    mysqli_query($DB, $update_transaksi);
}

// 6. Redirect kembali ke halaman utama
header("Location: index.php");
exit();
?>