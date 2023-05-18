<?php
global $conn;
include_once 'admin_header.php';
?>
<?php

include ('server/connection.php');

if (isset($_POST['create_product'])){

    $product_name = $_POST['name'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_special_offer = $_POST['offer'];
    $product_category = $_POST['category'];

    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];
    //$file_name = $_FILES['image1']['name'];

    $image_name1 = $product_name."1.jpg";
    $image_name2 = $product_name."2.jpg";
    $image_name3 = $product_name."3.jpg";
    $image_name4 = $product_name."4.jpg";

    move_uploaded_file($image1,"images/".$image_name1);
    move_uploaded_file($image2,"images/".$image_name2);
    move_uploaded_file($image3,"images/".$image_name3);
    move_uploaded_file($image4,"images/".$image_name4);

    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_special_offer,
                      product_image, product_image2, product_image3, product_image4) VALUES (?,?,?,?,?,?,?,?) ");
    $stmt->bind_param('ssssssss', $product_name, $product_description,
        $product_price, $product_special_offer, $image_name1, $image_name2, $image_name3, $image_name4);

    if($stmt->execute()){
        header('location: products.php?product_created=Product has been updated successfully :)');

    }else{
        header('location: products.php?product_failed=Error occured, try again :(');
    }
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

<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Insert <em>product</em></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center" action="" method="POST" enctype="multipart/form-data">
                <p style="color: red"><?php if (isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="col-md-6">
                    <form class="d-flex flex-column align-items-center" id="create-form" enctype="multipart/form-data" method="POST" action="insert_product.php">
                        <div class="form-group">
                            <label for="product-name">Product Title</label>
                            <br>
                            <input type="text" class="form-control" id="product-name" name="name" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="product-desc">Product Description</label>
                            <br>
                            <textarea class="form-control" id="product-desc" name="description" rows="3" style="width: 460px;"></textarea>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="product-price">Price</label>
                            <br>
                            <input type="text" class="form-control" id="product-price" name="price" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="product-offer">Special Offer/Sale</label>
                            <br>
                            <input type="number" class="form-control" id="product-offer" name="offer" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <br>
                            <label>
                                <select class="form-select" required name="category">
                                    <option value="originals">Originals</option>
                                    <option value="prints">Prints</option>
                                    <option value="commissions">Commissions</option>
                                </select>
                            </label>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="image1">Product Image 1</label>
                            <br>
                            <input type="file" class="form-control-file" id="image1" name="image1" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="image2">Product Image 2</label>
                            <br>
                            <input type="file" class="form-control-file" id="image2" name="image2" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="image3">Product Image 3</label>
                            <br>
                            <input type="file" class="form-control-file" id="image3" name="image3" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="image4">Product Image 4</label>
                            <br>
                            <input type="file" class="form-control-file" id="image4" name="image4" style="width: 460px;">
                        </div>
                        <br><br>
                        <div class="form-group text-center">
                            <button type="submit" name="create_product" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>
