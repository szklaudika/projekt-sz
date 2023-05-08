<?php

session_start();



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
                    <h2><em>Payment</em></h2>
                </div>
            </div>
            <div class="container my-5">
                <div class="row justify-content-center text-center">
                    <div class="col-md-6">
                        <form class="needs-validation" method="post" action="place_order.php">

                            <div class="text-center">
                                <p><?php echo $_GET['order_status'];?></p>
                                <p>Total amount: € <?php echo $_SESSION['total']; ?> </p>
                                <button type="submit" class="btn btn-primary" name="place_order">Pay now</button>

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
