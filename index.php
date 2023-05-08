<?php
include_once 'header.php';
?>
<?php
    if (isset($_SESSION["email"])) {
        echo "<p>Hello :)</p>";
    }
    ?>

<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="header-text">
                    <h2>Drawings by Klaudia</h2>
                    <p> I am a 20-year-old artist from Slovakia. On my social networks I post artworks of women who love women, spiritual art, skeletons and also ladies suffering from various mystical afflictions or sometimes a little bit sexual artworks. I mostly draw with colored pencils, but I love to paint with oil too.
                        I started to draw more seriously at the age of 13. My grandpa was always a huge inspiration for me.</p>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="explore.php">Shop</a>
                        </div>
                        <div class="main-button">
                            <a href="https://www.tiktok.com/@sz.klaudika?is_from_webapp=1&sender_device=pc" target="_blank">Watch my videos</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="owl-banner owl-carousel">
                    <div class="item">
                        <img src="images/banner-01.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="images/banner-02.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->
<div class="categories-collections">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="collections">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="owl-collection owl-carousel">
                                <div class="item">
                                    <img src="images/collection-01.jpg" alt="">
                                    <div class="down-content">

                                        <div class="main-button">
                                            <a href="explore.php">Buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="images/collection-02.jpg" alt="">
                                    <div class="down-content">

                                        <div class="main-button">
                                            <a href="explore.php">Buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="images/collection-03.jpg" alt="">
                                    <div class="down-content">

                                        <div class="main-button">
                                            <a href="explore.php">Buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="images/collection-04.jpg" alt="">
                                    <div class="down-content">

                                        <div class="main-button">
                                            <a href="explore.php">Buy now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<body class="bg-dark">

<div class="featured-explore">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-features owl-carousel">
                    <div class="item">
                        <div class="thumb">
                            <img src="images/featured-01.jpg" alt="" style="border-radius: 20px;">
                            <div class="hover-effect">
                                <div class="content">
                                    <h4>I don't wanna feel how my heart is rippin'</h4>
                                    <span class="author">

                        <h6>Drawings by Klaudia<br><a href="https://www.instagram.com/sz.klaudika/">@sz.klaudika</a></h6>
                      </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumb">
                            <img src="images/featured-02.jpg" alt="" style="border-radius: 20px;">
                            <div class="hover-effect">
                                <div class="content">
                                    <h4>Don't you see I'm suffering?</h4>
                                    <span class="author">
                        <h6>Drawings by Klaudia<br><a href="https://www.instagram.com/sz.klaudika/">@sz.klaudika</a></h6>
                      </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumb">
                            <img src="images/featured-03.jpg" alt="" style="border-radius: 20px;">
                            <div class="hover-effect">
                                <div class="content">
                                    <h4>Why you sending shots at my heart?</h4>
                                    <span class="author">
                        <h6>Drawings by Klaudia<br><a href="https://www.instagram.com/sz.klaudika/">@sz.klaudika</a></h6>
                      </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="thumb">
                            <img src="images/featured-04.jpg" alt="" style="border-radius: 20px;">
                            <div class="hover-effect">
                                <div class="content">
                                    <h4>I just need an escape, I pray I find my way before I suffocate</h4>
                                    <span class="author">
                        <h6>Drawings by Klaudia<br><a href="https://www.instagram.com/sz.klaudika/">@sz.klaudika</a></h6>
                      </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
include_once 'footer.php';
?>