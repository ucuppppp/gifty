<?php

$conn = mysqli_connect('localhost', 'root', '', 'giftshop') or die;

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
    // $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // return $row;
}

function singkat_angka($n, $presisi=1) {
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
 
	if ( $presisi > 0 ) {
		$pisah = '.' . str_repeat( '0', $presisi );
		$format_angka = str_replace( $pisah, '', $format_angka );
	}
	
	return $format_angka . $simbol;
}
 
function logout($data) {
    session_unset();
    session_destroy();
    header('Location: /login/');
}

function registration($data) {
    global $conn;
    $name = htmlspecialchars($data['name']);
    $username = strtolower(stripslashes($data['username']));
    $email = htmlspecialchars($data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");


    if(mysqli_fetch_assoc($result)) {
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

if(isset($_GET['logout'])) {
	$logout = $_GET['logout'];
	logout($logout);
  
  }

?>