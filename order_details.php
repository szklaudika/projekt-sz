<?php

include ('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

} else {
    header('location: account.php');
    exit;
}

?>



<?php
include_once 'header.php';
?>
<br><br><br><br>
<body style="background: url(images/dark-bg.jpg);">
<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Order <em>Details</em> </h2>
                </div>
            </div>

            <?php while($row = $order_details->fetch_assoc()){ ?>

<section id="orders">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                  <div class="col-sm-3">
                      <div class="col-md-8"><img src="images/<?php echo $row['product_image']; ?>" class="media-object img-thumbnail"  alt=""/></div>
                  </div>
                <div class="col-sm-9">
                    <p style="color: black;"><strong>Product name:  </strong><?php echo $row['product_name']; ?></p>
                    <p style="color: black;"><strong>Product price:  </strong><?php echo $row['product_price']; ?> €</p>
                    <p style="color: black;"><strong>Quantity:  </strong><?php echo $row['product_quantity']; ?></p>

                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>
            <?php if($order_status == "not paid"){ ?>

                <form style="float: right;">
                    <input type="submit" class="btn btn-outline-primary" value="Pay now">
                </form>

            <?php } ?>
        </div>
    </div>
</div>


</body>

<?php
include_once 'footer.php';
?>


