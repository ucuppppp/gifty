<?php
session_start();
include '../function.php';
$page = 'Login';


if (isset($_POST['login'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE userName = '$username'";

    $result = mysqli_query($conn, $query);
    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION["login"] = true;
            $_SESSION['userId'] = $row['userId'];
            $_SESSION['profilePicture'] = $row['profilePicture'];
            $_SESSION['name'] = $row['nameUser'];
            $_SESSION['username'] = $row['userName'];
            $_SESSION['roleId'] = $row['roleId'];
            $_SESSION['bio'] = $row['bio'];
            if ($_SESSION['roleId'] == 1) {
                header('Location: ../admin/');
            } else {
                header('Location: ../index.php');
            }
        }
    }
    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftyy | <?= $page; ?></title>
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="glassmorphism-box login-box">
            <span><img src="../images/favicon.png" alt="" style="width: 60px;"></span>
            <h2>Login</h2>
            <?php if(isset($error)) {
             echo "<p style='color:red;' >username atau password salah</p>";
             } ?>
            <form method="post" action="">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit" name="login" id="login">Login</button>
                <small>Dont have a account?<a href="register/"> Register</a></small>
            </form>
        </div>
    </div>
</body>

</html>