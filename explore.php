<?php
include_once 'header.php';
?>

<body style="background: url(images/dark-bg.jpg);">
<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2><em>Shop</em></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="discover-items">
    <div class="container">
        <div class="row">

            <?php include('server\get_featured_products.php'); ?>
            <?php global $featured_products;
            while($row = $featured_products->fetch_assoc()){ ?>


            <div class="col-lg-3">
                <div class="item">
                    <div class="row">
                        <div class="col-lg-12">
                <span class="author">
                </span>
                            <img src="images/<?php echo $row['product_image']; ?>"  alt="Put your lips on mine"/>
                        </div>
                        <div class="col-lg-12">
                            <div class="line-dec"></div>
                            <div class="row">
                                    <h4 class="p-name"> <?php echo $row['product_name']; ?> </h4>
                                    <h4 class="p-price"> <?php echo $row['product_price']; ?> €</h4>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="main-button">
                                <a href="<?php echo "details.php?product_id=". $row['product_id']; ?>"> Buy now</a>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

            <?php } ?>

        </div>
    </div>
</div>
</body>


<br><br><br>

<?php
include_once 'footer.php';
?>
