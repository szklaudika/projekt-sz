<?php

session_start();

if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {
    //let user in

    //send user to shop page
}else{
    header('location: explore.php');
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
                    <h2><em>Checkout</em></h2>
                </div>
            </div>
            <div class="container my-5">
                <div class="row justify-content-center text-center">
                    <div class="col-md-6">
                        <form class="needs-validation" method="post" action="place_order.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="" required>
                                <div class="invalid-feedback">
                                 Please enter your name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="" required>
                                <div class="invalid-feedback">
                                Please enter your email.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">
                                    Please enter your phone number.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                                <div class="invalid-feedback">
                                    Please enter your city.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                                <div class="invalid-feedback">
                                    Please enter your address.
                                </div>
                            </div>
                            <div class="text-center">
                                <p>Total amount: € <?php echo $_SESSION['total']; ?> </p>
                                <button type="submit" class="btn btn-primary" name="place_order">Place order</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Bootstrap validation
    (function() {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>







<?php
include_once 'footer.php';
?>
