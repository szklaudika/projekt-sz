
<?php
session_start();
include_once ('admin_header.php');
?>


    <style>
        body {

            /* Alternatively, you can use a background image like this: */
            background-image: url('images/dark-bg.jpg');
            /* background-size: cover; */
            /* background-repeat: no-repeat; */
        }
    </style>


<body>



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
                    <?php if(isset($_SESSION['admin_logged_in'])) { ?>
                    <div class="col-md-2">
                        <a href="admin_logout.php?admin_logout=1" id="admin_logout" class="btn btn-outline-danger btn-block">Log out</a>
                    </div>
                    <?php } ?>
                </div>
            </div>



        </div>

    </div>


</div>



<br><br><br><br><br><br><br>
<!--Section: Contact v.2-->





<?php include_once 'footer.php'?>