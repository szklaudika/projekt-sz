<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

global $conn;
include('server\connection.php');
include('server\get_featured_products.php');
if(isset($_POST['insert_product'])){
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_status='true';

    $product_image = $_FILES['product_image']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    $product_image4 = $_FILES['product_image4']['name'];

    $temp_image = $_FILES['product_image']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];
    $temp_image4 = $_FILES['product_image4']['tmp_name'];

    if($product_name=='' or $product_description=='' or $product_price=='' or $product_image=='' or $product_image2=='' or $product_image3=='' or $product_image4=='') {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image,"images/$product_image");
        move_uploaded_file($temp_image2,"images/$product_image2");
        move_uploaded_file($temp_image3,"images/$product_image3");
        move_uploaded_file($temp_image4,"images/$product_image4");

        $insert_products="insert into `products` (product_name, product_description, product_price, product_image, product_image2, product_image3, product_image4, date, status)
                          values ('$product_name','$product_description','$product_price','$product_image','$product_image2','$product_image3','$product_image4,',NOW(),'$product_status')";
        $result_query=mysqli_query($conn, $insert_products);
        if($result_query){
            echo "<script>alert('Successfully inserted the products')</script>";
        }
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
<?php
include_once 'header.php';
?>

<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Insert <em>product</em></h2>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center" action="" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <form class="d-flex flex-column align-items-center">
                            <div class="form-group">
                                <label for="product_name">Product Title</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" style="width: 460px;">
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" rows="3" style="width: 460px;"></textarea>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="product_image">Product Image 1</label>
                                <input type="file" class="form-control-file" id="product_image" name="product_image" style="width: 460px;">
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="product_image2">Product Image 2</label>
                                <input type="file" class="form-control-file" id="product_image2" name="product_image2" style="width: 460px;">
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="product_image3">Product Image 3</label>
                                <input type="file" class="form-control-file" id="product_image3" name="product_image3" style="width: 460px;">
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="product_image4">Product Image 4</label>
                                <input type="file" class="form-control-file" id="product_image4" name="product_image4 " style="width: 460px;">
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="product_price">Price</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" style="width: 460px;">
                            </div>
                            <br><br>
                            <div class="form-group text-center">
                                <button type="submit" name="insert_product" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>

    </div>


</div>



<br><br><br><br><br><br><br>
<!--Section: Contact v.2-->





<?php
include_once 'footer.php';
?>
