<?php

require("database.php");

$username = base64_decode($_POST['username']);
$code   = base64_decode($_POST['code']);

$check = "SELECT activation_code FROM users WHERE username='$username' AND activation_code='$code'";
$response = $db->query($check);
if($response->num_rows != 0)
{
	$update_status = "UPDATE users SET status = 'active' WHERE username = '$username' AND activation_code = '$code'";
	if($db->query($update_status))
	{
		$get_id = "SELECT id FROM users WHERE username = '$username'";
		$get_id_response = $db->query($get_id);
		$id_data = $get_id_response->fetch_assoc();
		$table_name = "user_".$id_data['id'];
		$create_table ="CREATE TABLE $table_name(id INT(11) NOT NULL AUTO_INCREMENT, image_name VARCHAR(50),image_path VARCHAR(50),thumb_path VARCHAR(60),image_size FLOAT(11),image_date DATETIME DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY(id))";
	    if($db->query($create_table))
	    {
	    	mkdir("../profile/gallery/".$table_name);
	    	echo "verified";
	    	session_start();
	    	$_SESSION['username'] = $username;
	    }

	}
	else
	{
		echo "activation faild please try again later";
	}
}
else
{
	echo "wrong activation code";
}


?>
<?php 
 //close database connection
	$db->close();
?>