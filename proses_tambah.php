<?php
include "koneksi.php";

// 1. Ambil data dari form modal dengan sanitasi
$nama_siswa     = mysqli_real_escape_string($DB, $_POST['nama_siswa']);
$kelas          = mysqli_real_escape_string($DB, $_POST['kelas']);
$id_pelanggaran = mysqli_real_escape_string($DB, $_POST['id_pelanggaran']);
$poin           = mysqli_real_escape_string($DB, $_POST['poin']);
$tanggal        = mysqli_real_escape_string($DB, $_POST['tanggal']);
$keterangan     = mysqli_real_escape_string($DB, $_POST['keterangan']);

// 2. Cek apakah siswa sudah ada di database berdasarkan Nama dan Kelas
$cek_siswa = mysqli_query($DB, "SELECT id_siswa FROM siswa WHERE nama_siswa = '$nama_siswa' AND kelas = '$kelas'");

if (mysqli_num_rows($cek_siswa) > 0) {
    // Jika siswa sudah ada, ambil id_siswa-nya
    $siswa = mysqli_fetch_assoc($cek_siswa);
    $id_siswa = $siswa['id_siswa'];
} else {
    // Jika siswa belum ada, tambahkan ke tabel siswa (hanya nama_siswa dan kelas)
    $q_insert_siswa = "INSERT INTO siswa (nama_siswa, kelas) VALUES ('$nama_siswa', '$kelas')";
    if (mysqli_query($DB, $q_insert_siswa)) {
        $id_siswa = mysqli_insert_id($DB);
    } else {
        die("Gagal menambahkan data siswa: " . mysqli_error($DB));
    }
}

// 3. Simpan data transaksi pelanggaran
$q_transaksi = "INSERT INTO transaksi (id_siswa, id_pelanggaran, poin, tangal, keterangan) 
                VALUES ('$id_siswa', '$id_pelanggaran', '$poin', '$tanggal', '$keterangan')";

if (mysqli_query($DB, $q_transaksi)) {
    // Redirect kembali ke halaman utama jika berhasil
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menyimpan data pelanggaran: " . mysqli_error($DB);
}
?>