<?php
require("database.php");
$username = base64_decode($_POST['username']);
$password = md5(base64_decode($_POST['password']));

$check_username = "SELECT username FROM users WHERE username ='$username'";
$response = $db->query($check_username);
if($response->num_rows != 0)
{
	$check_password = "SELECT username,password FROM users WHERE username ='$username' AND password ='$password'";
	$response_password = $db->query($check_password);
	if($response_password->num_rows != 0)
	{
		$check_status = "SELECT status FROM users WHERE username = '$username' AND password = '$password' AND status = 'active'";
		$response_status = $db->query($check_status);
		if($response_status->num_rows != 0)
		{
			echo "login success";
			session_start();
			$_SESSION['username'] = $username;
		}
		else
		{
			$get_code = "SELECT activation_code FROM users WHERE username='$username' AND password='$password'";
			$response_code = $db->query($get_code);
			$data = $response_code->fech_assoc;
			$final_code = $data['activation_code'];
			$check_mail_code = mail($username, "picdrive activation code", "Than you for choseing our product your activation code is : ".$final_code);
			if($check_mail_code){
				echo "login panding";
			}
			
		}
	}
	else
	{
		echo "wrong password";
	}

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