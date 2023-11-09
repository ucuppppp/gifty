<?php 
session_start();

require '../function.php';

$name = $_GET['name'];

if(isset($_POST['submit'])) {
    $image = $_FILES['image'];
    
    $image = uploadPp($image);

    mysqli_query($conn, "UPDATE user SET profilePicture = '$image' WHERE userName = '$name'");
    
    echo "<script>
        alert('profile telah di update!')
        </script>";
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Profile Picture</title>
</head>
<body>
    <div class="" style="display: flex; justify-content:center;">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="submit" name="submit" id="submit">
        </form>
    </div>
</body>
</html>