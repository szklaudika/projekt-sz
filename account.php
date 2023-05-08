<?php

global $conn;
session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: user.php');
    exit;
}

if(isset($_GET['logout'])){
 if(isset($_SESSION['logged_in'])) {
     unset($_SESSION['logged_in']);
     unset($_SESSION['user_email']);
     unset($_SESSION['user_name']);
     header('location: user.php');
     exit;
 }
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirmPassword){
        header('location: account.php?error=passwords dont match');

    } else if(strlen($password)<6){
    header('location: account.php?error=password must be at least 6 charackters');

    } else {

        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param("ss", md5($password), $user_email);

        if($stmt->execute()){
            header('location: account.php?message=password has been updated successfully');

        }else{
            header('location: account.php?message=could not update password');
        }

    }

}

if(isset($_SESSION['logged_in'])){
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

    $user_id = $_SESSION['user_id'];

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();



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
                    <h2>Your <em>account</em> </h2>
                </div>
            </div>
            <p class="text-center" style="color: mediumpurple"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; } ?></p>
            <p class="text-center" style="color: mediumpurple"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; } ?></p>
            <section >
                <div class="container py-5">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>


                        <div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" style="color: black;">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; }?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" style="color: black;">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; }?></p>
                                        </div>
                                    </div>
                                    <hr>

                                </div>

                            </div>
                            <div class="text-center">
                                <a href="#orders" id="orders-btn" class="btn btn-outline-secondary" style="color: #7453fc">Your orders</a>
                            </div>
                            <br>
                            <div class="text-center">
                                <a href="account.php?logout=1" id="logout-btn"  class="btn btn-outline-danger">Log out</a>
                            </div>

                            </div>

                        </div>
                <hr>
                <br><br><br> <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Change <em>Your </em>Password </h2>
                    </div>
                </div>
                <div class="container my-5">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-6">
                            <form class="needs-validation" id="account-form" method="POST" action="account.php">
                                <p class="text-center" style="color: red"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                                <p class="text-center" style="color: mediumpurple"><?php if(isset($_GET['message'])){ echo $_GET['message']; } ?></p>
                <div class="text-center">
                    <label for="password" class="form-label" style="color: white;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                </div>
                                <br>
                <div class="text-center">
                    <label for="password" class="form-label" style="color: white;">Confirm Password</label>
                    <input type="password" class="form-control" id="password" name="confirmPassword" required>
                    <div class="invalid-feedback">
                        Please confirm your password.
                    </div>
                </div>
                                <br><br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="change_password">Change password</button>

                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php while($row = $orders->fetch_assoc()){ ?>
                <section id="orders">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                             <!---   <div class="col-sm-3">
                                   <div class="col-md-11"><img src="<?php echo $row['order_image']; ?>" class="media-object img-thumbnail"  alt=""/></div>
                                </div> --->
                                <div class="col-sm-9">
                                    <p style="color: black;"><strong>Order id:  </strong><?php echo $row['order_id']; ?></p>
                                    <p style="color: black;"><strong>Order cost:  </strong><?php echo $row['order_cost']; ?> €</p>
                                    <p style="color: black;"><strong>Order status:  </strong><?php echo $row['order_status']; ?></p>
                                    <p style="color: black;"><strong>Order Date:  </strong><?php echo $row['order_date']; ?></p>
                                    <p style="color: black;"><strong>Order Details:  </strong></p>
                                    <form method="POST" action="order_details.php">
                                        <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                                        <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                                        <input class="btn" name="order_details_btn" type="submit" value="details" style="color: black;"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <?php } ?>
                </div>
</div>
</div>
<?php
include_once 'footer.php';
?>

