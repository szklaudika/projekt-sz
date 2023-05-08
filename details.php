<?php

include('server/connection.php');
global $product;
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    global $conn;

    include("server/connection.php");
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
    $product = $stmt->get_result();

} else {
    header('location: explore.php');
}
?>



<?php
include_once 'header.php';
?>


<div class="item-details-page">
    <div class="container">
        <div class="row">

            <?php while($row = $product->fetch_assoc()){ ?>

            <section class="container single-product my-5 pt-5">
                <div class="row mt-5">
            <div class="col-lg-5 col-md-6 col-sm-12">

                    <img class="img-fluid w-100 pb-1" src="images/<?php echo $row['product_image']; ?>" id="mainImg" alt=""/>
                    <div class="small-img-group">
                        <div class="small-img-col">
                            <img class="small-img" src="images/<?php echo $row['product_image']; ?>" alt="put your lips on mine"/>
                        </div>
                        <div class="small-img-col">
                            <img class="small-img" src="images/<?php echo $row['product_image2']; ?>" alt=""/>
                        </div>
                        <div class="small-img-col">
                            <img class="small-img" src="images/<?php echo $row['product_image3']; ?>" alt=""/>
                        </div>
                        <div class="small-img-col">
                            <img class="small-img" src="images/<?php echo $row['product_image4']; ?>" alt=""/>
                        </div>

                    </div>
            </div>






            <div class="col-lg-5 align-self-center">
                <h4><?php echo $row['product_name']; ?></h4>
                <span class="author">

            <h6><a href="https://www.instagram.com/sz.klaudika/">@sz.klaudika</a></h6>
          </span>
                <p><?php echo $row['product_description']; ?></p>

                <div class="row">

                </div>
                <p> Price: <?php echo $row['product_price']; ?> </p>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                    <?php } ?>
                <label>
                    <input type="number" name="product_quantity" value="1"/>
                </label>
                    <div class="col-lg-12">
                        <button class="main-button" type="submit" name="add_to_cart">Add to cart</button>
                    </div>
                </form>

            </div>
                </div>
            </section>


        </div>
    </div>
</div>



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
<script>
    const mainImg = document.getElementById("mainImg");
    const smallImg = document.getElementsByClassName("small-img");

    for(let i=0; i<4; i++){
        smallImg[i].onclick = function(){
            mainImg.src = smallImg[i].src;
        }
    }



    <?php
    include_once 'footer.php';
    ?>
