<!DOCTYPE html>
<html lang="en">
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <!--navigation-->
        <?php
        include 'nav.inc.php';
        ?> 
        <!--slideshow-->
        <header role="banner">
            <div class="header_section">
                <div class="banner_section layout-padding">
                    <?php
                    include "carousel.php"
                    ?>
                </div>
            </div>   
        </header>
        <main role="main">
            <!--Welcome-->
            <div class="container-fluid padding">
                <div class="row welcome text-center">
                    <div class="col-12">
                        <h1 class="display-4">Shop at ease with us</h1>
                    </div>
                    <div class="col-12">
                        <p class="lead">We serve our products with utmost care to ensure that they arrive to you at your doorstep in a pristine condition</p>
                        <a href="/1004-Website/catalogue.php" class="btn btn-primary">Check out our products</a>
                    </div>
                </div>
            </div>
            <!--Meet the team-->
            <div class="container-fluid padding">
                <div class="row team text-center">
                    <div class="col-12">
                        <h1 class="display-4">Meet the team</h1>
                    </div>
                </div>
                </div>
                <div class="team-bg"></div>
            <div class="container-fluid padding">
                <div class="row team text-center">
                    <div class="col-12">
                        <a href="/1004-Website/about-us.php" class="btn btn-primary team-btn">Learn More</a>
                    </div>
                </div>
            </div>

            <hr>
            <!--Testimonials-->
            <div class="container-fluid padding">
                <div class="row text-center padding">
                    <div class="col-12">
                        <h1 class="display-4">Some reviews from our previous customers</h1>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <img class="avatar4" src="images/testimonial1.jpeg" alt="member 1"/>
                        <p class="customer-detail">Product arrived on time and in good condition</p>
                        <h2 class="customer-name">Customer 1</h2>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <img class="avatar4" src="images/testimonial2.jpeg" alt="member 1"/>
                        <p class="customer-detail">Product arrived on time and in good condition</p>
                        <h2 class="customer-name">Customer 2</h2>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <img class="avatar4" src="images/testimonial3.jpeg" alt="member 1"/>
                        <p class="customer-detail">Product arrived on time and in good condition</p>
                        <h2 class="customer-name">Customer 3</h2>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <!--Connect-->
            <div class="container-fluid padding">
                <div class="row text-center padding">
                    <div class="col-12">
                        <h2>Connect With Us</h2>
                    </div>
                    <div class="col-12 social padding">
                        <a href="https://www.facebook.com/SingaporeTech/" target="_blank" aria-label="icon to open new tab facebook site"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        <a href="https://www.youtube.com/c/SingaporetechEduSg/featured" target="_blank" aria-label="Icon to open new tab to youtube site"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/singaporetech/" target="_blank" aria-label="Icon to open new tab to instagram site"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/singaporetech" target="_blank" aria-label="Icon to open new tab to twitter site"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div> 
        </main>
        <!--footer-->
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>
