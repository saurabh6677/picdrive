<?php
require("../../php/database.php");
session_start();
$username = $_SESSION['username'];
$get_storage = "SELECT plans,storage,used_storage,id FROM users WHERE username = '$username'";
$response = $db->query($get_storage);
$data = $response->fetch_assoc();
$plans = $data['plans'];
$total = $data['storage'];
$id = $data['id'];
$used = $data['used_storage'];
$memory_status = $used."MB/".$total."MB";
$persentage = ($used*100)/10;
$free_space = $total-$used;
if($plans == "starter" || $plans == "free")
{
$response_array = [$memory_status, $free_space."MB", $persentage];
echo json_encode($response_array);
$color = "";
if($persentage>80)
{
$color = "bg-danger";
}
else
{
	$color = "bg-primary";
}
}
else
{
	$response_array = ["USED : ".$used."MB/UNLIMITED", "UNLIMITED", 0];
    echo json_encode($response_array);	
}
?>
<?php 
 //close database connection
	$db->close();
?>