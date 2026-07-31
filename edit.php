<?php
include "koneksi.php";

$id=$_GET['id'];

$data=mysqli_fetch_array(mysqli_query($DB,
"SELECT * FROM pelanggaran WHERE id_pelanggaran='$id'"));
?>

<form action="update.php" method="POST">

<input type="hidden" name="id_pelanggaran"
value="<?= $data['id_pelanggaran']; ?>">

Nama Pelanggaran<br>
<input type="text"
name="nama_pelanggaran"
value="<?= $data['nama_pelanggaran']; ?>">

<br><br>

Poin<br>
<input type="number"
name="poin"
value="<?= $data['poin']; ?>">

<br><br>

<button type="submit">Update</button>

</form>