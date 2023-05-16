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
                                    <p>Total payment: € <?php echo $_POST['order_total_price']; ?></p>
                                    <!--<button type="submit" class="btn btn-primary">Pay now</button>--!>
                                    <div id="paypal-button-container"></div>



                                    <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>

                                        <?php $amount = strval($_SESSION['total']); ?>
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
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/create/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you

                    // This example reads a v2/checkout/orders capture response, propagated from the server
                    // You could use a different API or structure for your 'orderData'
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                    }

                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');


                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
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