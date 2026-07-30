<?php
$DB = mysqli_connect("localhost","root","","sipena");

if(!$DB){
    die("koneksi gagal : " . mysqli_connect_error());
}
?>