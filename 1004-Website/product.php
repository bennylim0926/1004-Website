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
<div class="container">
            <div class="col-md-4 md-2">
                    <div class="col-md-12">
                                <img class="card-img-top" src="images/camera.jpg" alt="product">
                                <div class="dog">
                                    <a href="productid.php?id=<?php echo $row['id']?>">
                                    <span><?php echo $row['name']?></span>
                                    <p><?php echo $row['price']?></p>
                                </div>
                                <hr class="hr2">
                                <div class="cart-btn">
                                    <i class="fa fa-plus-circle iconn" aria-hidden="true"></i>
                                    <input type ="submit" name="a" value="Add to cart">
                                </div>
                        </div>
            </div>
</div>

                <?php 
                
                }
            }
            $conn->close();
            ?>


             
     
