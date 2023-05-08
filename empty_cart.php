<?php
include_once 'header.php';
?>


<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Your <em>cart</em> is empty</h2>
                </div>
            </div>

            <section class="h-100 h-custom">
                <div class="container h-100 py-5">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <?php
                        session_start();

                        if(isset($_SESSION['cart'])) {
                            ?>
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                        foreach ($_SESSION['cart'] as $key => $value){
                                            ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="images/<?php echo $value['product_image']; ?>" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
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
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        </div>
                    </div>
                </div>

                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-4 col-xl-3">
                            <div class="d-flex justify-content-between" style="font-weight: 500;">
                                <p class="mb-2">Subtotal</p>
                                <p class="mb-2">0 €</p>
                            </div>

                            <div class="d-flex justify-content-between" style="font-weight: 500;">
                                <p class="mb-0">Shipping</p>
                                <p class="mb-0">0 €</p>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                <p class="mb-2">Total (tax included)</p>
                                <p class="mb-2">0 €</p>
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
