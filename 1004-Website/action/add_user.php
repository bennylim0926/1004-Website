<?php 
global $errorMsg, $success;
             $config = parse_ini_file('../../../private/db-config.ini');
             $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
             
             if ($conn->connect_error) 
             {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
             }
             if(mysqli_connect_errno())
            {
            echo 'Database Connection Error';
            }
            
$username = $_POST['username'];
$email = $_POST['email'];
$fname = $_POST['fname'];
$mobile = $_POST['mobile'];
//$admin = 1;
$password = $_POST['password'];
$lname = $_POST['lname'];

$pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
//$sql = "INSERT INTO `accounts` (`uname`,`email`,`password`,`lname`,`fname`,`mobile_number`,`admin`) values ('$username', '$email', '$pwd_hashed', '$lname','$fname','$mobile','$admin' )";
$sql = "INSERT INTO `accounts` (`uname`,`email`,`password`,`lname`,`fname`,`mobile_number`) values ('$username', '$email', '$pwd_hashed', '$lname','$fname','$mobile')";

$query= mysqli_query($conn,$sql);
$lastId = mysqli_insert_id($conn);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );
  
    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );
 
    echo json_encode($data);
} 

?>