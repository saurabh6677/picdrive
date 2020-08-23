<?php
session_start();
$username = $_SESSION['username'];
require("../../php/database.php");
$plans = $_GET['plans'];
$storage = $_GET['storage'];
$purchase_date = date('Y-m-d');

//get storage
if($plans == "starter" || $plans == "free")
{
$get_storage = "SELECT storage FROM users WHERE username='$username'";
$response = $db->query($get_storage);
$data = $response->fetch_assoc();
$data = $data['storage'];
$total_storage;
if(empty($_SESSION['renew']))
{
$total_storage = $data+$storage;
}
else
{
	$total_storage = 0+$storage;
}
$cal_date = new DateTime($purchase_date);
$cal_date->add(new DateInterval('P30D'));
$expiry_date = $cal_date->format('Y-m-d');

$update_table = "UPDATE users SET storage='$total_storage',purchase_date='$purchase_date',expiry_date='$expiry_date',plans='$plans' WHERE username='$username'";
if($db->query($update_table))
{
	header("Location: ../profile.php");
}
else
{
	echo "storage update faild";
}
}
else
{
	$cal_date = new DateTime($purchase_date);
	$cal_date->add(new DateInterval('P30D'));
	$expiry_date = $cal_date->format('Y-m-d');

	$update_table = "UPDATE users SET storage='0',purchase_date='$purchase_date',expiry_date='$expiry_date',plans='$plans' WHERE username='$username'";
	if($db->query($update_table))
	{
	header("Location: ../profile.php");
	}
	else
	{
		echo "storage update faild";
	}
}

?>
<?php 
 //close database connection
	$db->close();
?>