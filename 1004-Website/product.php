<html>
    <main class="container">
        <?php
        $config =  parse_ini_file('/var/www/private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
   
        if ($conn->connect_error)   
    {
           $errorMsg = "Connection failed: " . $conn->connect_error;
    }
    
            $sql= "SELECT * FROM world_of_pets.productlist";
            $result = $conn->query($sql);

            if($result->num_rows >0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
            ?>
            <article class="col-sm">
                    <div class="row">
                                <img class="card-img-top" src="images/camera.jpg" alt="product">
                                <div class="dog">
                                    <a href="productid.php?id=<?php echo $row['id']?>">
                                        <span><?php echo $row['name']?></span></a>
                                    <p><?php echo $row['price']?></p>
                                </div>
                        </div>
            </article>
                <?php 
                
                }
            }
            $conn->close();
            ?>


             
     
