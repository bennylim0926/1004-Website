<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        
        <a class="nav-link" href="index.php"><span class="material-icons">home</span></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#monitors">MONITOR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#keyboards">KEYBOARD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#mouse">MOUSE</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                         <a class="nav-link" href="register.php"><span class="material-icons">account_circle</span>REGISTER</a> 
                     </li>
                    <li class="nav-item">
                         <a class="nav-link" href="login.php"><span class="material-icons">login</span>LOGIN</a> 
                     </li>
        </ul>
    </div>
</nav>
        <header class="jumbotron text-center">
            <h1 class="display-4">Product Page</h1>
            <h5>Click on each product for more details!</h5>
        </header>
        <div class =" sidebar" style="width:10%">
            <?php 
                    include "categories.php";
            ?>  
        </div>
        
        <main class="product-container">
            <section id="Monitors">
                <h2 class="producttitle">Monitor</h2>
                <div class="row">
            <?php
                $config =  parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 1";
$result =  $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        ?>
                    
                    <article class="col-sm">
                        <figure>
                        <a href="productid.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/camera.jpg" alt="<?php echo $row['name']?>">              
                                    <span><?php echo $row['name']?></span></a>
                                </figure>
                    </article>
                    <?php 
    }
}?>

           
                    
            </section>
            <section id="Keyboard">
                <h2 class="producttitle">Keyboards</h2>
                <div class="row">
                   <?php
                $config =  parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql1 = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 2";
$result1 =  $conn->query($sql1);

if($result1->num_rows > 0)
{
    while($row = $result1->fetch_assoc())
    {
        ?>
                    
                    <article class="col-sm">
                    <div class="row">
                            <a href="productid.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/monitors/monitor1.jpeg" alt="<?php echo $row['name']?>">
                                <figure>
                                    <span><?php echo $row['name']?></span></a>
                                </figure>
                    </div>
                    </article>
                    <?php 
    }
}?>
            </section>
            <section id="Computer Mouse">
                <h2 class="producttitle">Computer Mouse</h2>
                <div class="row">
                    <?php
                $config =  parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql2 = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 3";
$result2 =  $conn->query($sql2);

if($result2->num_rows > 0)
{
    while($row = $result2->fetch_assoc())
    {
        ?>
                    
                    <article class="col-sm">
                    <div class="row">
                            <a href="productid.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/monitors/monitor1.jpeg" alt="<?php echo $row['name']?>">
                                <figure>
                                    <span><?php echo $row['name']?></span></a>
                                </figure>
                    </div>
                    </article>
                    <?php 
    }
}?>
            
            </section>
            <section id="Webcams">
                <h2 class="producttitle">Webcams</h2>
                <div class="row">
                    <?php
                $config =  parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql3 = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 4";
$result3 =  $conn->query($sql3);

if($result3->num_rows > 0)
{
    while($row = $result3->fetch_assoc())
    {
        ?>
                    
                    <article class="col-sm">
                    <div class="row">
                        <a href="productid.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/monitors/monitor1.jpeg" alt="<?php echo $row['name']?>">
                                <figure>
                                    <span><?php echo $row['name']?></span></a>
                                </figure>
                    </div>
                    </article>
                    <?php 
    }
}?>
        </section>
            
            <section id="Speakers">
                <h2 class="producttitle">Speakers</h2>
                <div class="row">
                    <?php
                $config =  parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql4 = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 5";
$result4 =  $conn->query($sql4);

if($result4->num_rows > 0)
{
    while($row = $result4->fetch_assoc())
    {
        ?>
                    
                    <article class="col-sm">
                    <div class="row">
                                <a href="productid.php?id=<?php echo $row['id']?>">
                                <img class="card-img-top" src="images/monitors/monitor1.jpeg" alt="<?php echo $row['name']?>">
                                <figure>
                                    <span><?php echo $row['name']?></span></a>
                                </figure>
                    </div>
                    </article>
                    <?php 
    }
}?>
               
            </section>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


