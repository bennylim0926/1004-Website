<?php 

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

$output= array();
$sql = "SELECT * FROM accounts";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE uname like '%".$search_value."%'";
	$sql .= " OR email like '%".$search_value."%'";
	$sql .= " OR lname like '%".$search_value."%'";
	$sql .= " OR fname like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY admin desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($conn,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['acc_id'];
	$sub_array[] = $row['uname'];
	$sub_array[] = $row['email'];
        $sub_array[] = $row['fname'];
	$sub_array[] = $row['lname'];
        $sub_array[] = $row['mobile_number'];
        $sub_array[] = $row['admin'];
        
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['acc_id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['acc_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
