<?php 
session_start();
$page = 'Edit';
include '../function.php';

$id = $_GET['id'];

$query1 = query("SELECT * FROM product WHERE idProduct = '$id'");

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    query("UPDATE product SET productName='$name', idType='$type', price='$price', description='$description' WHERE idProduct = '$id'");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftyy | <?= $page; ?></title>
</head>
<body>
    <table>
        <?php foreach($query1 as $data1) { ?>
    <form action="" method="post">
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
        <td><label for="description"></label></td>
        <td><textarea name="description" id="description"><?= $data1['description']; ?></textarea></td>
    </tr>
    <tr>
        <td></td>
        <td><button type="submit" name="submit" id="submit">Edit!</button></td>
    </tr>    
    </form>
    <?php } ?>
    </table>
</body>
</html>