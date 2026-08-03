<?php
session_start();
include "koneksi.php";

if(isset($_SESSION['login'])){
    header("Location:index.php");
    exit;
}

if(isset($_POST['login'])){
    $u=$_POST['username'];
    $p=$_POST['password'];

    $q=mysqli_query($DB,"SELECT * FROM user WHERE username='$u'");
    if($d=mysqli_fetch_assoc($q)){
        if(password_verify($p,$d['password'])){
            $_SESSION['login']=true;
            $_SESSION['nama']=$d['nama'];
            header("Location:index.php");
            exit;
        }
        $error="Password salah!";
    }else{
        $error="Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login APSIS</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Segoe UI,sans-serif}
body{display:flex;justify-content:center;align-items:center;height:100vh;background:#f4f7f6}
.card{width:380px;background:#fff;padding:30px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.1)}
.logo{text-align:center;margin-bottom:15px}
.logo img{width:200px}
h2{text-align:center;color:#0D3A7C;margin-bottom:20px}
label{display:block;margin:10px 0 5px;font-weight:600;color:#555}
input{width:100%;padding:11px;border:1px solid #ccc;border-radius:6px}
input:focus{outline:none;border-color:#0D3A7C}
button{width:100%;margin-top:18px;padding:12px;border:0;background:#0D3A7C;color:#fff;border-radius:6px;cursor:pointer;font-weight:bold}
button:hover{background:#0a2d60}
.error{background:#ffe6e6;color:#d93025;padding:10px;border-radius:6px;text-align:center;margin-bottom:15px}
</style>
</head>

<body>

<div class="card">

    <div class="logo">
        <img src="img/capsis.jpeg" alt="APSIS">
    </div>

    <h2>LOGIN</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button name="login">LOGIN</button>
    </form>

</div>

</body>
</html>