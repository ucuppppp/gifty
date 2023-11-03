<?php 
session_start();
$page = 'Product';
include '../function.php';

$id = $_GET['id'];

$query = "SELECT * FROM product
      INNER JOIN type ON product.idType = type.typeId
      WHERE product.idProduct = '$id'";

$result = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <title>Giftyy | <?= $page; ?></title>
</head>
<body>
  

<div class="container">

<?php foreach($result as $data) : ?>
  <div class="images">
    <img src="../images/<?= $data['image']?>" />
  </div>
  <div class="slideshow-buttons">
    <div class="one"></div>
    <div class="two"></div>
    <div class="three"></div>
    <div class="four"></div>
    
    
  </div>
  <p class="pick">choose size</p>
  
  <div class="sizes">
    <div class="size">5</div>
    <div class="size">6</div>
    <div class="size">7</div>
    <div class="size">8</div>
    <div class="size">9</div>
    <div class="size">10</div>
    <div class="size">11</div>
    <div class="size">12</div>
  </div>
  <div class="product">
    <p><?= $data['typeName']?></p>
    <h1><?= $data['productName'] ?></h1>
    <h2>Rp.<?= singkat_angka($data['price']);?></h2>
    <p class="desc"><?= $data['description'] ?></p>
    <?php endforeach; ?>
    <div class="buttons">
      <button class="add">Add to Cart</button>
      <button class="like"><span>♥</span></button>
    </div>
    <a href="../shop.php"><button style="margin-top: 80px; margin: left 20px;">Back</button></a>
  </div>
  
</div>

<footer>
  <p>made by <a href="https://codepen.io/juliepark"> julie</a> ♡
</footer>
<script>
     $(".size").on('click', function(){
    $(this).toggleClass('focus').siblings().removeClass('focus');
 })
</script>
    
</body>
</html>