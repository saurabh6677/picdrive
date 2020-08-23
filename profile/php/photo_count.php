<?php
require("../../php/database.php");
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];
$table_name = "user_".$id;
$_SESSION['table_name'] = $table_name;
$count_query = "SELECT COUNT(id) AS total FROM $table_name";
$response = $db->query($count_query);
$count = $response->fetch_assoc();
$total= $count['total']." PHOTOS";
echo $total;
?>
<?php 
 //close database connection
	$db->close();
?>