<?php
session_start();
session_unset();
session_destroy();
header("Location: admin_login.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Drawings by Klaudia</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/templatemo-liberty-market.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">

    <!--

    TemplateMo 577 Liberty Market

    https://templatemo.com/tm-577-liberty-market

    -->
    <style>
        body {

            /* Alternatively, you can use a background image like this: */
            background-image: url('images/dark-bg.jpg');
            /* background-size: cover; */
            /* background-repeat: no-repeat; */
        }
    </style>
</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <img src="images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="explore.php">Shop</a></li>
                        <li><a href="create.php">Contact</a></li>
                        <li><a href="cart.php" class="nav-item">
                                <i class="fas fa-shopping-cart"> </i></a></li>
                        <li><a href="user.php" class="nav-item">
                                <i class="fas fa-user"> </i></a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<br><br><br>

<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Admin <em>panel</em></h2>
                </div>
            </div>
            <br><br><br>
            <hr>
            <br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <a href="insert_product.php" class="btn btn-outline-primary btn-block">Insert Products</a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-outline-primary btn-block">View Products</a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" type="button" class="btn btn-outline-primary btn-block">All Orders</a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-outline-primary btn-block">All Payments</a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-outline-primary btn-block">List Users</a>
                    </div>
                    <div class="col-md-2">
                        <a href="logout.php" class="btn btn-outline-danger btn-block">Log out</a>
                    </div>
                </div>
            </div>



        </div>

    </div>


</div>



<br><br><br><br><br><br><br>
<!--Section: Contact v.2-->





<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © 2023 <a href="#">Drawings by Klaudia</a> All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="js/isotope.min.js"></script>
<script src="js/owl-carousel.js"></script>

<script src="js/tabs.js"></script>
<script src="js/popup.js"></script>
<script src="js/custom.js"></script>
</body>
</html>