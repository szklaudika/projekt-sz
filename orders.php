<?php
global $conn;
include ('admin_header.php')
?>

<?php

if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
$page_no = $_GET['page_no'];
}else{
$page_no = 1;
}

$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$total_records_per_page = 10;

$offset = ($page_no-1) * $total_records_per_page;

$prevous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_pages = ceil($total_records/$total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$orders = $stmt2->get_result();

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
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Order <em>details</em> </h2>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-stripped table-sm">
                    <thread>
                        <tr>
                            <th scope="col" style="color: white;">Order Id</th>
                            <th scope="col" style="color: white;">Order Status</th>
                            <th scope="col" style="color: white;">User Id</th>
                            <th scope="col" style="color: white;">Order Date</th>
                            <th scope="col" style="color: white;">User Phone</th>
                            <th scope="col" style="color: white;">User Address</th>
                            <th scope="col" style="color: white;">Edit</th>
                            <th scope="col" style="color: white;">Delete</th>
                        </tr>
                    </thread>
                    <tbody>
                    <?php foreach ($orders as $order) {?>
                    <tr>
                        <td style="color: white;"><?php echo $order['order_id']; ?></td>
                        <td style="color: white;"><?php echo $order['order_status']; ?></td>
                        <td style="color: white;"><?php echo $order['user_id']; ?></td>
                        <td style="color: white;"><?php echo $order['order_date']; ?></td>
                        <td style="color: white;"><?php echo $order['user_phone']; ?></td>
                        <td style="color: white;"><?php echo $order['user_address']; ?></td>
                        <td style="color: white;"><a class="btn btn-primary">Edit</a></td>
                        <td style="color: white;"><a class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>



<nav aria-label="Page navigation example" class="mx-auto">
    <ul class="pagination mt-5 mx-auto">
        <li class="page-item <?php if($page_no <= 1) { echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page_no <= 1) { echo '#'; } else { echo "?page_no=".($page_no-1); } ?>">Previous</a>
        </li>

        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

        <?php if($page_no >= 3) { ?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
        <?php } ?>

        <li class="page-item <?php if($page_no >= $total_no_of_pages) { echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page_no >= $total_no_of_pages) { echo '#'; } else { echo "?page_no=".($page_no+1); } ?>">Next</a>
        </li>
    </ul>
</nav>
        </div>
    </div>
</div>



<?php
include ('footer.php');
?>
