<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

PAGE WITH ALL PRODUCTS(FINAL)

-->
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
    include 'nav.inc.php';
    ?>
        <header class="jumbotron text-center">
            <h1 class="display-4">Product Page</h1>
            <h5>Click on each product for more details!</h5>
        </header>       
        <main class="container">
            <section id="monitors">
                <h2 class="producttitle1">MONITORS</h2>
                <div class="row">
                    
                
                    <?php 
                    //require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql1 = "SELECT * FROM ITshop.products where categoryid=1";
$result1 =  $conn->query($sql1);


if($result1->num_rows > 0)
{
    while($row = $result1->fetch_assoc())
    {
        
        //echo $row['img'];
        ?>
        <article class="col-sm">
                        <figure>
                            <figcaption>
                            <a href="/1004-Website/cart/product_page.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/products/<?php echo $row['img']?>" alt="<?php echo $row['name']?>">              
                                    <span class="image-name"><?php echo $row['name']?></span></a>
                            </figcaption>
                                </figure>
            <br><br>
                    </article>
                    <?php 
    }
}?>
                </div>
                
                
            </section>
            <section id="keyboards">
                <h2 class="producttitle2">KEYBOARDS</h2>
                <div class="row">
                    
                    <?php 
                    //require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql2 = "SELECT * FROM ITshop.products where categoryid=2";
$result2 =  $conn->query($sql2);


if($result2->num_rows > 0)
{
    while($row = $result2->fetch_assoc())
    {
        ?>
        <article class="col-sm">
                        <figure>
                            <figcaption>
                            <a href="/1004-Website/cart/product_page.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/products/<?php echo $row['img']?>" alt="<?php echo $row['name']?>">              
                                    <span class="image-name"><?php echo $row['name']?></span></a>
                            </figcaption>
                                </figure>
            <br><br>
                    </article>
                    <?php 
    }
}?>
                </div>
                
                
            </section>
            <section id="computer-mouse">
                <h2 class="producttitle3">COMPUTER MICE</h2>
                <div class="row">
                    
                    <?php 
                    //require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql3 = "SELECT * FROM ITshop.products where categoryid=3";
$result3 =  $conn->query($sql3);


if($result3->num_rows > 0)
{
    while($row = $result3->fetch_assoc())
    {
        
        //echo $row['img'];
        ?>
        <article class="col-sm">
                        <figure>
                            <figcaption>
                            <a href="/1004-Website/cart/product_page.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/products/<?php echo $row['img']?>" alt="<?php echo $row['name']?>">              
                                    <span class="image-name"><?php echo $row['name']?></span></a>
                            </figcaption>
                                </figure>
            <br><br>
                    </article>
                    <?php 
    }
}?>
                </div>
            
            </section>
            <section id="webcams">
                <h2 class="producttitle4">WEBCAMS</h2>
                <div class="row">
                    
                    <?php 
                    //require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql4 = "SELECT * FROM ITshop.products where categoryid=4";
$result4 =  $conn->query($sql4);


if($result4->num_rows > 0)
{
    while($row = $result4->fetch_assoc())
    {
        
        //echo $row['img'];
        ?>
        <article class="col-sm">
                        <figure>
                            <figcaption>
                            <a href="/1004-Website/cart/product_page.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/products/<?php echo $row['img']?>" alt="<?php echo $row['name']?>">              
                                    <span class="image-name"><?php echo $row['name']?></span></a>
                            </figcaption>
                                </figure>
            <br><br>
                    </article>
                    <?php 
    }
}?>
                </div>
                
                
        </section>
            
            <section id="speakers">
                <h2 class="producttitle5">SPEAKERS</h2>
                <div class="row">
                    
                    <?php 
                    //require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql5 = "SELECT * FROM ITshop.products where categoryid=5";
$result5 =  $conn->query($sql5);


if($result5->num_rows > 0)
{
    while($row = $result5->fetch_assoc())
    {
        
        //echo $row['img'];
        ?>
        <article class="col-sm">
                        <figure>
                            <figcaption>
                            <a href="/1004-Website/cart/product_page.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/products/<?php echo $row['img']?>" alt="<?php echo $row['name']?>">              
                                    <span class="image-name"><?php echo $row['name']?></span></a>
                            </figcaption>
                                </figure>
            <br>
                    </article>
                    <?php 
    }
}?>
                </div>
                
                
            </section>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


