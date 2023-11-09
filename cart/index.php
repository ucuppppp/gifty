<?php 
session_start();

$page = 'Cart';


$data = $_SESSION['cart'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giffty | <?= $page; ?></title>
</head>
<body>
    <table border="1" cellpadding="7">
        <tr>
            <td>No</td>
            <td>Product</td>
            <td>Quantity</td>
            <td>Price</td>
        </tr>
        <tr>
        <?php $i = 1; foreach($_SESSION['cart'] as $item) : ?>
            <?php 
                $price = intval($item['price']);
                $subtotal = $item['price'] * $item['quantity']?>
            <td><?= $i++ ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['quantity']; ?></td>
            <td><?= $price; ?></td>
            <td><?= $subtotal; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>