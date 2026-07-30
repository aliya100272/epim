<?php
session_start();
include "koneksi.php";
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($DB, "SELECT * FROM users WHERE username='$username'");
    if ($data = mysqli_fetch_assoc($query)) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $data['nama'];
            header("Location: dashboard.php");
            exit;
        }
        $error = "Password salah";
    } else {
        $error = "Username tidak ditemukan";
    }
}
?>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>LOGIN</h2>

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    Username<br>
    <input type="text" name="username" required><br><br>

    Password<br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>
</body>
</html>