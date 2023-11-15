<?php
session_start();
include '../function.php';

$page = 'Cart';
$user = $_SESSION['userId'];

$query = query("SELECT * FROM cart
                INNER JOIN user ON cart.idUser = user.userId
                INNER JOIN product ON cart.idProduct = product.idProduct
                WHERE idUser = '$user'");



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giffty | <?= $page; ?></title>

</head>

<body>
    <div class="card">
        <div class="content">
            <table border="1" cellpadding="7">
                <tr>
                    <td>No</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Subtotal</td>
                </tr>
                <tr>
                    <?php
                    $total = [];
                    $i = 1;
                    foreach ($query as $item) : ?>
                        <?php
                        $price = intval($item['price']);
                        $subtotal = $item['price'] * $item['quantity'];
                        array_push($total, $subtotal);
                        ?>
                        <td><?= $i++ ?></td>
                        <td><?= $item['productName']; ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td><?= $price; ?></td>
                        <td><?= $subtotal; ?></td>
                </tr>
            <?php endforeach;
                    $totalAkhir = array_sum($total);
            ?>
            <tr>
                <td colspan="4" align="center">Total</td>
                <td><?= $totalAkhir; ?></td>
            </tr>
            </table>
        </div>
    </div>
</body>

</html>