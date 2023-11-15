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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Giffty | Cart</title>
        
</head>

<body>
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Cart</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted"><? ?> items</div>
                    </div>
                </div>
                <?php
                $total = [];
                $totalQuantity = [];
                $i = 1;
                foreach ($query as $item) : ?>
                    <?php
                    $i++;
                    $price = intval($item['price']);
                    array_push($totalQuantity, $item['quantity']);
                    $subtotal = $item['price'] * $item['quantity'];
                    array_push($total, $subtotal);
                    ?>
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid" src="../images/<?= $item['image']; ?>"></div>
                            <div class="col">
                                <?php $data = query("SELECT typeName FROM type WHERE typeId = $item[idType]");
                                foreach ($data as $type) { ?>
                                    <div class="row text-muted"><?= $type['typeName']; ?></div>
                                <?php } ?>
                                <div class="row"><?= $item['productName']; ?></div>
                            </div>
                            <div class="col">Rp.<?= singkat_angka($item['price']); ?></div>
                            <div class="col">
                                <a href="#">-</a><a href="#" class="border"><?= $item['quantity']; ?></a><a href="#">+</a>
                            </div>
                            <div class="subtotal" style="margin-right: 15px;"><?= 'Rp. '.number_format($subtotal, 2, ",","."); ?></div>
                            <div><span class="close">&#10005;</span></div>
                        </div>
                    </div>
                <?php endforeach;
                $totalAkhir = array_sum($total);
                $quantityAkhir = array_sum($totalQuantity)
                ?>
                <div class="back-to-shop">
                    <a href="../shop.php">
                    <button style="
            padding: 7px;
            background-color: #f9ece6;
            border: solid 1px;
            border-radius: 20px;
            cursor:pointer;">
                        &leftarrow;<span class="text-muted">Back to shop</span>
                    </button>
                    </a>
                </div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS <?= $quantityAkhir; ?></div>
                    <div class="col text-right"></div>
                </div>
                <!-- <form>
                    <p>SHIPPING</p>
                    <select>
                        <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                    </select>
                    <p>GIVE CODE</p>
                    <input id="code" placeholder="Enter your code">
                </form> -->
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right"><?= 'Rp. '.number_format($totalAkhir, 2, ",","."); ?></div>
                </div>
                <button class="btn">CHECKOUT</button>
            </div>
        </div>

    </div>
</body>

</html>