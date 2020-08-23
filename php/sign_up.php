<?php
require("database.php");

$fullname = base64_decode($_POST['fullname']);
$username = base64_decode($_POST['email']);
$password = md5(base64_decode($_POST['password']));

$pattern = "1234567890";
$length = strlen($pattern)-1;

$i;
$code = [];
for($i=0;$i<6;$i++)
{
	$indexing_num = rand(0,$length);
	$code[] = $pattern[$indexing_num];
}
$activation_code =  implode($code);

$insert = "INSERT INTO users(full_name,username,password,activation_code) VALUES('$fullname','$username','$password','$activation_code')";
if($db->query($insert))
{
	$check_mail = mail($username,"Picdrive Activation Code","Thank You For Choseing Picdrive Your Activation Code Is : ".$activation_code);
	if($check_mail)
	{
		echo "mail success";
	}
	else
	{
		echo "mail faild";
	}
}
else
{
	echo "signup faild";
}

?>
<?php 
 //close database connection
	$db->close();
?>