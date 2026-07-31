<?php

include "koneksi.php";

$id=$_GET['id'];

mysqli_query($DB,"DELETE FROM pelanggaran
WHERE id_pelanggaran='$id'");

header("Location:index.php");