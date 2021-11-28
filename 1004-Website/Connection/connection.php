<?php
        global $errorMsg, $success;
             $config = parse_ini_file('../../private/db-config.ini');
             $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
             
             if ($conn->connect_error) 
             {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
                $conn->close();
             }
             if(mysqli_connect_errno())
            {
            echo 'Database Connection Error';
            }
?>

