<?php 
include('../Connection/connection.php');
$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$lname = $_POST['lname'];
$id = $_POST['id'];

$sql = "UPDATE `accounts` SET  `uname`='$username' , `email`= '$email', `mobile_number`='$mobile',  `lname`='$lname' WHERE acc_id='$id' ";
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