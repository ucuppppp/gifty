<?php

require 'app/app.php';


$conn = mysqli_connect('localhost', 'root', '', 'giftshop') or die;

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
    // $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // return $row;
}

function singkat_angka($n, $presisi = 1)
{
    if ($n < 900) {
        $format_angka = number_format($n, $presisi);
        $simbol = '';
    } else if ($n < 900000) {
        $format_angka = number_format($n / 1000, $presisi);
        $simbol = 'k';
    } else if ($n < 900000000) {
        $format_angka = number_format($n / 1000000, $presisi);
        $simbol = 'M';
    } else if ($n < 900000000000) {
        $format_angka = number_format($n / 1000000000, $presisi);
        $simbol = 'B';
    } else {
        $format_angka = number_format($n / 1000000000000, $presisi);
        $simbol = 'T';
    }

    if ($presisi > 0) {
        $pisah = '.' . str_repeat('0', $presisi);
        $format_angka = str_replace($pisah, '', $format_angka);
    }

    return $format_angka . $simbol;
}

function logout($data)
{
    session_unset();
    session_destroy();
    header('Location:'. APP_PATH .'login/');
}

function registration($data)
{
    global $conn;
    $name = htmlspecialchars($data['name']);
    $username = strtolower(stripslashes($data['username']));
    $email = htmlspecialchars($data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");


    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah digunakan!')
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai!');
            document.location.href = 'index.php'
            </script>";
        return false;
    } else {

        $pw = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user
              VALUES (NULL, '$name', '$username', '$email', '$pw', DEFAULT)";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
};

if (isset($_GET['logout'])) {
    $logout = $_GET['logout'];
    logout($logout);
}

if (isset($_GET['deleteproduct'])) {
    $id = $_GET['deleteproduct'];
    $result = mysqli_query($conn, "DELETE FROM product WHERE idProduct = '$id'");
    if ($result) {
        echo "<script>
             alert('data berhasil di hapus')
             document.location.href = 'table.php'
             </script>";
    } else {
        echo "<script>
                 alert('data gagal di hapus')
                 document.location.href = 'table.php'
                 </script>";
    }
}

function edit($data) {
    global $conn;
    $id = htmlspecialchars($_GET['id']);
    if(isset($data['image'])){
        $image = htmlspecialchars($data['image']);
    } else {
        $image = NULL;
    }
    $name = htmlspecialchars($data['name']);
    $type = htmlspecialchars($data['type']);
    if(is_numeric($data['price']) == true) {
        $price = htmlspecialchars($data['price']);
    } else {
        echo "<script>
            alert('harga harus diisi dengan angka');
            document.location.href = 'edit.php'
            </script>";
    }
    $description = htmlspecialchars($data['description']);

    mysqli_query($conn,"UPDATE product SET
            image=$image,
            productName='$name',
            idType='$type',
            price='$price',
            description='$description'
            WHERE idProduct = '$id'");

    return mysqli_affected_rows($conn);
}

function add($data) {
    global $conn;
    
    $name = htmlspecialchars($data['name']);
    $type = htmlspecialchars($data['type']);
    $description = htmlspecialchars($data['description']);



    $image = upload();
    if( !$image ) {
        return false;
    }


    if(is_numeric($data['price']) == true) {
        $price = htmlspecialchars($data['price']);
    } else {
        echo "<script>
            alert('harga harus diisi dengan angka');
            document.location.href = 'add.php'
            </script>";
    }
   
    $description = htmlspecialchars($data['description']);

    $query = "INSERT INTO product
    VALUES ( NULL, '$name', '$type', '$description', '$price',  '$image')";


    mysqli_query ($conn, $query);

    return mysqli_affected_rows($conn);
} 


function upload() {
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // cek ekstensi gambar
    // array yang berisi ekstensi valid
    $validExtention = ['jpg','jpeg','png','heic'];
    // memisahkan ekstensi dan nama 
    $extentionSplit = explode('.', $name);
    // mengambil akhir dari nama ekstensi setelah titik lalu ubah menjadi huruf kecil
    // agar valid dengan array ekstensi
    $extentionImage = strtolower(end($extentionSplit));

    if( !in_array($extentionImage, $validExtention)) {
        echo "<script>
            alert('Yang anda upload bukan gambar');
            </script>";
        return false;
    }
    
    // generate nama gambar baru
    $newName = uniqid();
    $newName .= '.';
    $newName .= $extentionImage;


    move_uploaded_file($tmpName, 'C:/laragon/www/catalog/images/'.$newName);
    
    return $newName;

}

function uploadPp() {
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // cek ekstensi gambar
    // array yang berisi ekstensi valid
    $validExtention = ['jpg','jpeg','png','heic'];
    // memisahkan ekstensi dan nama 
    $extentionSplit = explode('.', $name);
    // mengambil akhir dari nama ekstensi setelah titik lalu ubah menjadi huruf kecil
    // agar valid dengan array ekstensi
    $extentionImage = strtolower(end($extentionSplit));

    if( !in_array($extentionImage, $validExtention)) {
        echo "<script>
            alert('Yang anda upload bukan gambar');
            </script>";
        return false;
    }
    
    // generate nama gambar baru
    $newName = uniqid();
    $newName .= '.';
    $newName .= $extentionImage;


    move_uploaded_file($tmpName, 'C:/laragon/www/catalog/admin/assets/img/profilePicture/'.$newName);
    
    return $newName;

}

function delete($data) {
    global $conn;
    $id = $_GET['deleteproduct'];
    $query = "DELETE FROM product WHERE idProduct = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
