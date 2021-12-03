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
            
    $stmt = $conn->prepare("SELECT * FROM accounts WHERE acc_id=?");
    $stmt->bind_param("s", $_POST['id']);
    if (!$stmt->execute())
{
    echo "<h2>Execute failed: (' . $stmt->errno . ') ' . $stmt->error</h2>";
    echo "<h2>Please try again</h2>";
    exit();
}
$result = $stmt->get_result();
$user_details = $result->fetch_assoc();
$pwd_hashed = $user_details["password"];

$username = $_POST['username'];

$email = $_POST['email'];
$mobile = $_POST['mobile'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$id = $_POST['id'];

if (isset($_POST["password"]) && strlen($_POST["password"])>5)
{
    $password = $_POST['password'];
    $pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
}
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