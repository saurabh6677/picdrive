<?php
require("../../php/database.php");
session_start();
$username = $_SESSION['username'];
$table_name = $_SESSION['table_name'];
$image_path = $_POST['path'];
$path = "../".$image_path;
if(unlink($path))
{
	$get_used_storage = "SELECT used_storage FROM users WHERE username = '$username'";
	$response = $db->query($get_used_storage);
	$used_storage = $response->fetch_assoc();
	$used_storage = $used_storage['used_storage'];
	$get_delete_size = "SELECT image_size FROM $table_name WHERE image_path='$path'";
	$response_size = $db->query($get_delete_size);
	$delete_size = $response_size->fetch_assoc();
	$delete_size = $delete_size['image_size'];
	$storage = $used_storage-$delete_size;
	$update_storage = "UPDATE users SET used_storage='$storage' WHERE username='$username'";
	if($db->query($update_storage))
	{
		$delete_row = "DELETE FROM $table_name WHERE image_path='$path'";
		if($db->query($delete_row))
		{
		echo "success";
		}
		else
		{
		echo "faild to delete from database";
		}
	}
	else
	{
		echo "used sttorage update faild";
	}

	
}
else
{
	echo "delete faild";
}

?>
<?php 
 //close database connection
	$db->close();
?>