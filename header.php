<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>
    Giftyy | <?= $page; ?>
  </title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            Giftyy
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse innerpage_navbar" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item ">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if($page == 'Shop') : ?> active <?php endif; ?>">
              <a class="nav-link" href="shop.php">
                Shop
              </a>
            </li>
            <li class="nav-item <?php if($page == 'Why') : ?> active <?php endif; ?>">
              <a class="nav-link" href="why.php">
                Why Us
              </a>
            </li>
            <li class="nav-item <?php if($page == 'Testimonial') : ?> active <?php endif; ?>">
              <a class="nav-link" href="testimonial.php">
                Testimonial
              </a>
            </li>
            <li class="nav-item <?php if($page == 'Contact') : ?> active <?php endif; ?>">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
          </ul>
          <div class="user_option">
            <?php if(isset($_SESSION['login'])) : ?>
            <a href="?logout=1">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                <?= $_SESSION['name']; ?>
              </span>
            </a>
            <?php else : ?>
            <a href="/login/">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Login
              </span>
            </a>
            <?php endif; ?>
            <a href="">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </a>
            <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <!-- end header section -->

  </div>