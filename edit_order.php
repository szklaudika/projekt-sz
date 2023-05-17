<?php
global $conn;
include('admin_header.php');
include('server/connection.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
} elseif (isset($_POST['edit_order'])) {
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    if ($stmt->execute()) {
        header('location: orders.php?order_updated=Order has been updated successfully :)');
        exit();
    } else {
        header('location: orders.php?order_failed=Error occurred, try again :(');
        exit();
    }
} else {
    header('location: admin_panel.php');
    exit();
}
?>

<style>
    body {
        background-image: url('images/dark-bg.jpg');
    }
</style>

<body>
<div class="item-details-page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <div class="section-heading text-center">
                    <div class="line-dec"></div>
                    <h2>Edit <em>Order</em></h2>
                </div>

                <form class="edit-order-form" method="POST" action="edit_order.php">
                    <p style="color: red;"><?php if (isset($_GET['error'])) {echo $_GET['error'];} ?></p>

                    <div class="form-group mt-3">
                        <label>Order Id</label>
                        <p class="my-4"><?php echo $order['order_id']; ?></p>
                    </div>
                    <div class="form-group mt-3">
                        <label>Order Price</label>
                        <p class="my-4"><?php echo $order['order_cost']; ?></p>
                    </div>

                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>" />

                    <div class="form-group my-3">
                        <label for="order_status">Order Status</label>
                        <select class="form-select" required name="order_status" id="order_status">
                            <option value="not paid" <?php if ($order['order_status'] == 'not paid') { echo "selected"; } ?>>Not Paid</option>
                            <option value="paid" <?php if ($order['order_status'] == 'paid') { echo "selected"; } ?>>Paid</option>
                            <option value="shipped" <?php if ($order['order_status'] == 'shipped') { echo "selected"; } ?>>Shipped</option>
                            <option value="delivered" <?php if ($order['order_status'] == 'delivered') { echo "selected"; } ?>>Delivered</option>
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <label>Order Date</label>
                        <p class="my-4"><?php echo $order['order_date']; ?></p>
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="edit_order" value="Edit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
