<?php
session_start();
global $product_id;
global $key;
if(isset($_POST['add_to_cart'])){
    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],"product_id"); //[] prints the ids [2,3,4,10,15]
        if(!in_array($_POST['product_id'], $products_array_ids) ){ //if product has been added to cart or not

            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );


            $_SESSION['cart'][$product_id] = $product_array;

            //product has been already added
        } else {
            echo '<script>alert("Product was already added to cart");</script>';
            //echo '<script>window.location="explore.php"</script>';


        }

    // if this is the first product
    }else{
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $product_array = array(
          'product_id' => $product_id,
          'product_name' => $product_name,
          'product_price' => $product_price,
          'product_image' => $product_image,
          'product_quantity' => $product_quantity
      );

      $_SESSION['cart'][$product_id] = $product_array;

    }
    calculateTotalCart();
    //calculate total




}else if(isset($_POST['remove_product'])){   //remove

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total
    calculateTotalCart();

    //check if cart is empty
    if(empty($_SESSION['cart'])){
        header('location: empty_cart.php');
        exit(); //use exit to prevent further code execution
    }

}else if(isset($_POST['edit_quantity'])){

    $product_id = $_POST['product_id']; //we get id and quantity from the form
    $product_quantity = $_POST['product_quantity'];
    $product_array = $_SESSION['cart'][$product_id]; //get the product array from the session
    $product_array['product_quantity'] = $product_quantity; //update product quantity
    $_SESSION['cart'][$product_id] = $product_array; //return array back its place
    calculateTotalCart();

}else{
    header('location: empty_cart.php');
    exit();
}

function calculateTotalCart(){

    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total = $total + ($price * $quantity);

    }
    $_SESSION['total'] = $total;

}


?>


<?php
include_once 'header.php';
?>


<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Shopping <em>cart</em></h2>
                </div>
            </div>

            <section class="h-100 h-custom">
                <div class="container h-100 py-5">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <?php foreach ($_SESSION['cart'] as $key => $value){ ?>

                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="images/<?php echo $value['product_image']; ?>" class="img-fluid rounded-3"
                                                     style="width: 120px;" alt="Book">
                                                <div class="flex-column ms-4">
                                                    <p class="mb-2"><?php echo $value['product_name']; ?></p>
                                                    <form method="POST" action="cart.php">
                                                        <label>
                                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                                        <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                                                        </label>
                                                    </form>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="align-middle">
                                            <p class="mb-0" style="font-weight: 500;">Quantity</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row">
                                                <label>
                                                <form method="POST" action="cart.php">
                                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                                                    <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
                                                </form>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <p class="mb-0" style="font-weight: 500;"><?php echo $value['product_quantity'] * $value['product_price'] ?> €</p>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                             <?php } ?>

                        </div>
                    </div>
                </div>

                    <div class="card-body p-4">

                        <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2"><?php echo $_SESSION['total']; ?> €</p>
                    </div>

                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-0">Shipping</p>
                        <p class="mb-0">15 €</p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                        <p class="mb-2">Total (tax included)</p>
                        <p class="mb-2"><?php echo $_SESSION['total'] + 15; ?> €</p>
                    </div>

                    <div class="col-lg-12">
                        <form method="POST" action="checkout.php">
                            <label>
                                <input type="submit" class="main-button" value="Checkout" name="checkout">
                            </label>
                        </form>
                    </div>
                </div>
                        </div>
            </section>

        </div>
        </div>
    </div>




<?php
include_once 'footer.php';
?>

