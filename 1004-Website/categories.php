<?php
    
        $config =  parse_ini_file('/var/www/private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
   
        if ($conn->connect_error)   
    {
           $errorMsg = "Connection failed: " . $conn->connect_error;
    }
    
            $sql= "SELECT * FROM world_of_pets.categories";
            $result = $conn->query($sql);

            if($result->num_rows >0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
            ?>     
    
<a href="productlist.php?cid=<?php echo $row['id']?>"><li><?php 
echo $row['categoryname']?></li></a>
        
        <?php } 
        
        }
        else
{
    echo"0 results";
}
   
     $conn->close();

?>