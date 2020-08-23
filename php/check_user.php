<?php

require("database.php");

$username = base64_decode($_POST['email']);
$check = "SELECT username FROM users WHERE username = '$username'";
$response = $db ->query($check);
if($response ->num_rows == 1)
{
	echo "user found";
}
else
{
	echo "user not found";
}

?>
<?php 
 //close database connection
	$db->close();
?>