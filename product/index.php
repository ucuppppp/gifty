<?php 
session_start();
$page = 'Product';
include '../function.php';


$id = $_GET['id'];

$query = "SELECT * FROM product
      INNER JOIN type ON product.idType = type.typeId
      WHERE product.idProduct = '$id'";

$result = mysqli_query($conn, $query);
$user = $_SESSION['userId'];

if(isset($_GET['idCart']) && !empty($_GET['idCart'])) {
  $idProduct = $_GET['idCart'];
  
  // Periksa apakah produk sudah ada di keranjang belanja
  $sql_check = "SELECT * FROM cart WHERE idUser = $user AND idProduct = $idProduct";
  $result_check = $conn->query($sql_check);
  
  if ($result_check->num_rows > 0) {
      // Jika produk sudah ada di keranjang, tingkatkan jumlah
      $row = $result_check->fetch_assoc();
      $new_quantity = $row['quantity'] + 1;
      $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE idUser = $user AND idProduct = $idProduct";
      if ($conn->query($update_sql) === true) {
          echo "<script>alert('Jumlah produk diperbarui di keranjang.')
                </script>";
      } else {
          echo "Error: " . $update_sql . "<br>" . $conn->error;
      }
  } else {
      // Jika produk belum ada di keranjang, tambahkan ke keranjang
      
      $insert_sql = "INSERT INTO cart (idProduct, idUser, quantity) VALUES ($idProduct, $user, 1)";
      if ($conn->query($insert_sql) === true) {
          echo "<script>alert('Produk ditambahkan ke keranjang.')
          </script>";
      } else {
          echo "Error: " . $insert_sql . "<br>" . $conn->error;
      }
  }
}

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
      <form action="../product/?id=<?= $data['idProduct'] ?>&idCart=<?= $data['idProduct'] ?>" method="post" style="display: inline;" name="addCart" id="addCart">
        <button class="add" type="submit"  name="addCart" id="addCart" >Add to Cart</button>
      </form>
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