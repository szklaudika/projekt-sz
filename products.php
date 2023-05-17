<?php
global $conn;
include ('admin_header.php')
?>

<?php
if(!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit();
}
?>

<?php

if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
}else{
    $page_no = 1;
}

$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
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

$stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

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
                    <h2><em>Products</em> </h2>
                    <?php if(isset($_GET['edit_success_message'])){ ?>
                    <p style="color: mediumpurple"><?php echo $_GET['edit_success_message']; ?></p>
                    <?php } ?>
                    <?php if(isset($_GET['edit_failure_message'])){ ?>
                        <p style="color: red"><?php echo $_GET['edit_failure_message']; ?></p>
                    <?php } ?>


                    <?php if(isset($_GET['deleted_failure'])){ ?>
                        <p style="color: red"><?php echo $_GET['deleted_failure']; ?></p>
                    <?php } ?>
                    <?php if(isset($_GET['deleted_successfully'])){ ?>
                        <p style="color: mediumpurple"><?php echo $_GET['deleted_successfully']; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-stripped table-sm">
                    <thread>
                        <tr>
                            <th scope="col" style="color: white;">Product Id</th>
                            <th scope="col" style="color: white;">Product Image</th>
                            <th scope="col" style="color: white;">Product Name</th>
                            <th scope="col" style="color: white;">Product Price</th>
                            <th scope="col" style="color: white;">Product Offer</th>
                            <th scope="col" style="color: white;">Product Category</th>
                            <th scope="col" style="color: white;">Edit</th>
                            <th scope="col" style="color: white;">Delete</th>
                        </tr>
                    </thread>
                    <tbody>
                    <?php foreach ($products as $product) {?>
                        <tr>
                            <td style="color: white;"><?php echo $product['product_id']; ?></td>
                            <td><img src="<?php echo "images/".$product['product_image']; ?>" style="width:70px; height:70px" alt=""/></td>
                            <td style="color: white;"><?php echo $product['product_name']; ?></td>
                            <td style="color: white;"><?php echo $product['product_price']."€"; ?></td>
                            <td style="color: white;"><?php echo $product['product_special_offer']."%"; ?></td>
                            <td style="color: white;"></td>
                            <td style="color: white;"><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>
                            <td style="color: white;"><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
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
