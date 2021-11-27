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
                <a class="nav-link" href="product_page.php">BACK TO CATALOG</a>
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
        
        <div class ="main-category">
                <div class="col-md-5 col-sm-6 my-3 my-md-0">
                    
                    <div class ="items">
                        <?php
                                  
                                
        $config =  parse_ini_file('/var/www/private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
   
        if ($conn->connect_error)   
    {
           $errorMsg = "Connection failed: " . $conn->connect_error;
    }
            $productid = $_GET['id'];
            $sql= "SELECT * FROM world_of_pets.productlist WHERE id = $productid";  
            $result = $conn->query($sql);

            if($result->num_rows >0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                
                        ?>
                    </div>
                </div>
        <main class="container">
            <section id="monitors">
                <br>
                <div class="row">
                    <article class="col-sm-5">
                        <figure>                            
                            <img class="img-thumbnail" src="images/monitors/monitor1.jpeg" alt="Monitor"
                                 title="View larger image..." />                                                                          
                            <figcaption><?php echo $row['name']?></figcaption>
                        </figure>
                    </article>
                    <article class="col-sm-2">
                    </article>
                    <article class="col-sm-5">
                        <br><br><br><br><br>
                        <p><?php echo $row['productdesc']?></p>
                        <h3><?php echo $row['price']?></h3>
                        <form action="/action_page.php">
                        <label for="quantity">Quantity:</label>
  <select name="quantity" id="quantity">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
                        <br><br>
                        <input type="submit" value="Add To Cart">
                        </form>
                    </article>
                </div>
                
               <?php }
            }?> 
        </main>
            
            
            
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


