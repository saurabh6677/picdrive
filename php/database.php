<?php
error_reporting(0);
$db = new mysqli("localhost","root","","picdrive");

if($db->connect_error == 1)
{
	die("database connection fail");
}

?>