
<?php
    session_start();
?>

<?php
//    include "head.inc.php";
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class ="carousel-item active">
            <img class ="fill" src = "images/blank_monitor.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="fill" src="images/benq_monitor.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="fill" src="images/eizo_img.jpg" alt="Third slide">
        </div>
        
        
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>