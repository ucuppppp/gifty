
<?php 
session_start();
$page = 'Edit';
include '../function.php';

if ($_SESSION['roleId'] != 1 || !isset($_SESSION['login'])) {
    header('Location: ../');
}

$id = $_GET['id'];

$query1 = query("SELECT * FROM product WHERE idProduct = '$id'");



if(isset($_POST['submit'])) {
    if(edit($_POST) > 0) {
        echo "<script>
            alert('data berhasil diedit!');
            document.location.href = '../';
            </script>";
    } else {
        echo "<script>
            alert('data gagal diedit!');
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftyy | <?= $page; ?></title>
    <style>
        body {
            background-color: #f89cab;
            text-align: center;
        }
        .container {
            height: 500px;
            padding: 20px;
            display: flex;
            justify-content: center;
            text-align: start;

        }

        h1 {
            margin: 10px;
            padding: 10px;
            display: block;
        }

        table {
            display: inline;
        }
    </style>
</head>
<body>

    <h1>Edit </h1>
    <div class="container">
        <table>
            <?php foreach($query1 as $data1) { ?>
        <form action="" method="post">
            <tr>
                <td></td>
                <td><img src="<?= APP_PATH."images/".$data1['image']?>" alt="" width="200"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="file" name="image" id="image"></td>
            </tr>
        <tr>
            <td><label for="name">Nama : </label></td>
            <td><input name="name" id="name" type="text" value="<?= $data1['productName']; ?>"></td>
        </tr>
        <tr>
            <td><label for="type">Type : </label></td>
            <td>
                <select name="type" id="type">
                    <?php $query2 = query("SELECT * FROM type");
                          foreach($query2 as $data2) :?>
                    <option <?php if($data1['idType'] == $data2['typeId']) : ?> selected <?php endif; ?> value="<?= $data2['typeId']; ?>">
                            <?= $data2['typeName']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>    
        <tr>
            <td><label for="price">Price : </label></td>
            <td><input name="price" id="price" type="text" value="<?= $data1['price']; ?>"></td>
        </tr>    
        <tr>
            <td><label for="description">Description : </label></td>
            <td><textarea name="description" id="description"><?= $data1['description']; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submit" id="submit">Edit!</button></td>
        </tr>    
        </form>
        <?php } ?>
        </table>
    </div>
</body>
</html>