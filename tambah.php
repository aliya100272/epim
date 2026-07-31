<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggaran</title>
</head>
<body>

<h2>Tambah Jenis Pelanggaran</h2>

<form action="simpan.php" method="POST">

Nama Pelanggaran<br>
<input type="text" name="nama_pelanggaran" required><br><br>

Poin<br>
<input type="number" name="poin" required><br><br>

<button type="submit">Simpan</button>

</form>

</body>
</html>
