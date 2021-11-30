<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
        include 'nav.inc.php';
        ?> 
        <main class="container">
            <h1>What we sell</h1>
            <p>We sell IT peripherals at an affordable rate with delivery
            </p>
        </main>
        <div class="header_section">
            <div class="banner_section layout-padding">
                <?php
                    include "carousel.php"
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="about_section">
                <div class="container">
                    <div class="about_img">
                        <img src="images/index_bg_iphone_12.png" alt="website about us image" style="max-width: 100%;">
                    </div>
                    <div class="about_text">
                        <strong>About Us
                        </strong>
                    </div>
                    <div class="about_middle">
                        <p class="about_info">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At quis risus sed vulputate odio ut enim.</p>
                    </div>
                    <div class="red_btn">
                        <button class="read_more">Read More</button>
                    </div>
                </div>
            </div>            
        </div>
        <div class="our_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="our_text">
                            <strong> Our Products</strong>
                        </h1>
                        <p class="about_info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis aliquam malesuada bibendum arcu.
                        </p>
                    </div>
                    <div class="our_section_2">
                        <div class="our_main">
                            <?php
                            include "our-carousel.php"
                            ?>
                        </div>
                        <button class="seemore_bt">See More</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            
        </div>

        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>

