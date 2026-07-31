<?php
include "koneksi.php";

mysqli_query($DB,"UPDATE pelanggaran SET

nama_pelanggaran='$_POST[nama_pelanggaran]',
poin='$_POST[poin]'

WHERE id_pelanggaran='$_POST[id_pelanggaran]'");

header("Location:index.php");