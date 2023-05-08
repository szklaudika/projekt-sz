<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = "klaudika.sz362@gmail.com";
    $headers = "From: " . $email;
    $body = "Name: " . $name . "\n" . "Email: " . $email . "\n" . "Subject: " . $subject . "\n" . "Message: " . $message;

    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Your message has been sent. Thank you!</p>";
    } else {
        echo "<p>There was an error sending your message. Please try again later.</p>";
    }
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
                    <h2><em>Contact</em> Me</h2>
                </div>
            </div>
            <!--Section: Contact v.2-->
            <section class="mb-4">
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact me directly. I will come back to you within
                    a matter of hours to help you.</p>

                <div class="row justify-content-center text-center">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <form id="contact-form" name="contact-form" action="mail.php" method="POST" class="needs-validation" novalidate>

                            <!--Grid row-->
                            <div class="row mb-3">
                                <!--Grid column-->
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Your name</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter your name.
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row mb-3">
                                <!--Grid column-->
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Your email</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter a subject for your message.
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row mb-3">
                                <!--Grid column-->
                                <div class="col-md-12">
                                    <label for="message" class="form-label">Your message</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                                    <div class="invalid-feedback">
                                        Please enter your message.
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <br><br><br>
                            <div class="text-center text-md-left">
                                <button type="submit" name="submit" class="btn btn-primary">Send Mail</button>
                            </div>
                            <div class="status"></div>
                        </form>
                    </div>
                    <!--Grid column-->

                </div>
            </section>
            <!--Section: Contact v.2-->
        </div>
    </div>
</div>

<?php
include_once 'footer.php';
?>
