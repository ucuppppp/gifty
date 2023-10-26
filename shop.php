
<?php
include 'function.php';

$query = mysqli_query($conn, "SELECT * FROM product");
$page = 'Shop';
include 'header.php';


?>

  <!-- end hero area -->

  <!-- shop section -->


  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
      <?php foreach($query as $data) : ?>
        <div class="col-sm-6 col-md-4 col-lg-3">        
          <div class="box">
            <a href="">
              <div class="img-box">
                <img src="images/<?= $data['image']; ?>" alt="">
              </div>
              <div class="detail-box">             
                <h6>
                  <?= $data['productName']; ?>
                </h6>
                <h6>
                  Price
                  <span>
                    Rp.<?= singkat_angka($data['price']);?>
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  </section>

  <!-- end shop section -->

  <!-- info and footer section -->

  <?php include 'footer.php'; ?>

  <!-- end info and footer section -->


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>

</body>

</html>