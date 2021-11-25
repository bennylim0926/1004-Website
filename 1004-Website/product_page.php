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
        <main class="container">
            <section id="monitors">
                <h2 class="producttitle">Monitor</h2>
                <div class="row">
                    <?php 
                    require_once('component.php');
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
        component($name, $id);
    }
}
    ?>
            </section>
            <section id="Keyboards">
                <h2 class="producttitle">Keyboards</h2>
                <div class="row">
                    <?php 
                    require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 2";
$result =  $conn->query($sql);


if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        component($name, $id);
    }
}
    ?>
            </section>
            <section id="computer-mouse">
                <h2 class="producttitle">Computer Mouse</h2>
                <div class="row">
                    <?php 
                    require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 3";
$result =  $conn->query($sql);


if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        component($name, $id);
    }
}
    ?>
            
            </section>
            <section id="webcams">
                <h2 class="producttitle">Webcams</h2>
                <div class="row">
                    <?php 
                    require_once('component.php');
                    $config =  parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
   if ($conn->connect_error)
{
$errorMsg = "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT * FROM world_of_pets.productlist WHERE categoryid = 4";
$result =  $conn->query($sql);


if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        component($name, $id);
    }
}
    ?>
        </section>
            
            <section id="speakers">
                <h2 class="producttitle">Speakers</h2>
                <div class="row">
                    <?php 
                    require_once('component.php');
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
        component($name, $id);
    }
}
    ?>
            </section>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


