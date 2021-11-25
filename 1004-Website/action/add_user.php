<?php 
include('../Connection/connection.php');
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['$password'];
$lname = $_POST['lname'];

$pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `accounts` (`uname`,`email`,`password`,`lname`) values ('$username', '$email', '$pwd_hashed', '$lname' )";
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