<?php

session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
} else if (isset($_SESSION['total']) && $_SESSION['total'] !=0 ){
    $order_total_price = $_SESSION['total'];
} else {
    header('location: account.php');
    exit;
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
                        <h2><em>Payment</em></h2>
                    </div>
                </div>
                <div class="container my-5">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-6">
                            <form class="needs-validation" method="post" action="place_order.php">

                                <div class="text-center">

                                    <?php if(isset($_POST['order_status']) && $_POST['order_status'] =="not paid" ) { ?>
                                        <?php $amount = strval($_POST['order_total_price']); ?>
                                        <?php $order_id = $_POST['order_id']; ?>
                                        <p>Total payment: € <?php echo $_POST['order_total_price']; ?></p>
                                        <!--<button type="submit" class="btn btn-primary">Pay now</button>--!>
                                        <div id="paypal-button-container"></div>



                                    <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>

                                        <?php $amount = strval($_SESSION['total']); ?>
                                        <?php $order_id = $_SESSION['order_id']; ?>
                                        <p>Total amount: € <?php echo $_SESSION['total']; ?> </p>
                                        <!--<button type="submit" class="btn btn-primary">Pay now</button>--!>
                                        <div id="paypal-button-container"></div>


                                    <?php } else { ?>
                                        <p>You don't have an order</p>
                                    <?php } ?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=AXmEy7GF02yZG5veZFoNnxFhX4R-CJW1AnvJVoyeAoAnnFG4SWNmdUO4iuc7atKVO5vFjG8_fNTZPwSL&currency=EUR"></script>

    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $amount; ?>'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payment.captures[0];
                    alert('Transaction ' + transaction.status + ': ' + transaction.id +
                        '\n\nSee console for all available details');
                    window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id; ?>;
                });
            }
        }).render('#paypal-button-container');
    </script>

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