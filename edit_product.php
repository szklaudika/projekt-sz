<?php global $conn;
include ('admin_header.php') ?>

<?php

include ('server/connection.php');

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param('i',$product_id);
    $stmt->execute();
    $products = $stmt->get_result();

}else if(isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?,
                    product_special_offer=? WHERE product_id=?");
    $stmt->bind_param('ssssi',$title, $description, $price, $offer, $product_id);
    if($stmt->execute()) {
        header('location: products.php?edit_success_message=Product has been updated successfully :)');
    } else {
        header('location: products.php?edit_failure_message=Error occured, try again :(');
    }

}else{
    header('location:products.php');
    exit();
}

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

<div class="item-details-page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <div class="section-heading text-center">
                    <div class="line-dec"></div>
                    <h2>Edit <em>Product</em></h2>
                </div>
                <form class="edit-form" method="POST" action="edit_product.php">
                    <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                    <?php foreach (p$products as $product){ ?>
                        <label>
                            <input name="product_id" value="<?php echo $product['product_id']; ?>" />
                        </label>

                        <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                            <label for="product-name"></label><input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']?>" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <label for="product-desc"></label><input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']?>" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <label for="product-price"></label><input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']?>" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="offer" class="form-label">Special Offer/Sale</label>
                        <label for="product-offer"></label><input type="number" class="form-control" value="<?php echo $product['product_special_offer']?>" id="product-offer" name="confirmPassword" required>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <button type="submit" name="edit_btn" class="btn btn-primary">Edit</button>
                    </div>
                    <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php') ?>
