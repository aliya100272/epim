<?php
include "koneksi.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $hapus = mysqli_query($DB,"DELETE FROM transaksi WHERE id_transaksi='$id'");

    if($hapus){
        echo "<script>
            alert('Data berhasil dihapus!');
            window.location='index.php';
        </script>";
    }else{
        echo "<script>
            alert('Data gagal dihapus!');
            window.location='index.php';
        </script>";
    }

}else{
    header("Location:index.php");
}
?>