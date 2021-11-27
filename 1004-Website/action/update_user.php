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
$password = $_POST['password'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$id = $_POST['id'];

$pwd_hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE `accounts` SET  `uname`='$username' , `email`= '$email', `mobile_number`='$mobile',  `lname`='$lname', `fname`='$fname',`password`='$pwd_hashed' WHERE acc_id='$id' ";
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