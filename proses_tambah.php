<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Ambil data dari form modal dengan sanitasi
    $nama_siswa     = mysqli_real_escape_string($DB, trim($_POST['nama_siswa'] ?? ''));
    $kelas          = mysqli_real_escape_string($DB, trim($_POST['kelas'] ?? ''));
    $id_pelanggaran = (int)($_POST['id_pelanggaran'] ?? 0);
    $poin           = (int)($_POST['poin'] ?? 0);
    $tanggal        = mysqli_real_escape_string($DB, $_POST['tanggal'] ?? '');
    $keterangan     = mysqli_real_escape_string($DB, trim($_POST['keterangan'] ?? ''));

    // 2. Cek apakah siswa sudah ada di tabel siswa
    $cek_siswa = mysqli_query($DB, "SELECT id_siswa FROM siswa WHERE nama_siswa = '$nama_siswa' LIMIT 1");

    if ($cek_siswa && mysqli_num_rows($cek_siswa) > 0) {
        $siswa = mysqli_fetch_assoc($cek_siswa);
        $id_siswa = $siswa['id_siswa'];
        
        // Update kelas siswa di tabel siswa agar tetap up-to-date
        mysqli_query($DB, "UPDATE siswa SET kelas = '$kelas' WHERE id_siswa = '$id_siswa'");
    } else {
        // Jika siswa belum ada, tambahkan ke tabel siswa
        $q_insert_siswa = "INSERT INTO siswa (nama_siswa, kelas) VALUES ('$nama_siswa', '$kelas')";
        if (mysqli_query($DB, $q_insert_siswa)) {
            $id_siswa = mysqli_insert_id($DB);
        } else {
            die("Gagal menambahkan data siswa: " . mysqli_error($DB));
        }
    }

    // 3. Simpan data ke tabel transaksi (Termasuk kolom 'kelas')
    $q_transaksi = "INSERT INTO transaksi (id_siswa, id_pelanggaran, kelas, poin, tangal, keterangan) 
                    VALUES ('$id_siswa', '$id_pelanggaran', '$kelas', '$poin', '$tanggal', '$keterangan')";

    if (mysqli_query($DB, $q_transaksi)) {
        header("Location: index.php#data-pelanggaran");
        exit();
    } else {
        echo "Gagal menyimpan data pelanggaran: " . mysqli_error($DB);
    }

} else {
    header("Location: index.php");
    exit();
}
?>