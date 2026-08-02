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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            margin-bottom: 24px;
            color: #333;
            text-align: center;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .alert-error {
            background-color: #ffe6e6;
            color: #d93025;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>LOGIN</h2>

    <?php if (isset($error)): ?>
        <div class="alert-error"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
        </div>

        <button type="submit" name="login" class="btn-login">Login</button>
    </form>
</div>

</body>
</html>