<?php
session_start();
include "koneksi.php";

if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}

if(isset($_POST['login'])){

    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = mysqli_query($DB,"SELECT * FROM user WHERE username='$u'");

    if($d = mysqli_fetch_assoc($q)){
        if(password_verify($p,$d['password'])){
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $d['nama'];
            header("Location: index.php");
            exit;
        }else{
            $error = "Password salah!";
        }
    }else{
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>LOGIN</h2>

<?= isset($error) ? "<p style='color:red'>$error</p>" : ""; ?>

<form method="POST">
    Username <br>
    <input type="text" name="username" required><br><br>

    Password <br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>