<?php
session_start();
include '../../function.php';
$page = 'Register';

if(isset($_POST['register'])) {
    if(registration($_POST)) {
        echo "<script>
            alert('berhasil membuat akun! Silahkan login')
            document.location.href = '../../login/'
            </script>";
    } else {
        echo "<script>
            alert('gagal membuat akun!');
            document.location.href = '../register/index.php'
            </script>";
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles.css">
    <title>Giftyy | <?= $page; ?></title>
</head>
<body>
    <div class="container">
        <div class="glassmorphism-box register-box">
        <span><img src="../../images/favicon.png" alt=""
        style="width: 60px;"></span>
            <h2>Register</h2>
            <form action="" method="post">
                <input type="text" name="name" id="name" placeholder="Name" required>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="password2" id="password2" placeholder="Confirm Password" required>
                <button type="submit" name="register" id="register">Register</button>
                <small>Have a account?<a href="../"> Login</a></small>
            </form>
        </div>
    </div>
</body>
</html>
