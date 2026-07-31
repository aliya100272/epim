<?php
include "koneksi.php";

$nama = $_POST['nama_pelanggaran'];
$poin = $_POST['poin'];

mysqli_query($DB,"INSERT INTO pelanggaran
(nama_pelanggaran,poin)
VALUES
('$nama','$poin')");

header("Location:index.php");