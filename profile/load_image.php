<?php
	session_start();
	require("../php/database.php");
	$start = $_POST['start'];
	$end = $_POST['end'];
	$username = $_SESSION['username'];
	$table_name = $_SESSION['table_name'];
	$get_image_path = "SELECT * FROM $table_name ORDER BY id ASC LIMIT $start,$end";
	$response = $db->query($get_image_path);
	
	while($data = $response->fetch_assoc())
	{	
		$image_name = pathinfo($data['image_name']);
		$image_name = $image_name['filename'];
		$path = str_replace("../", "", $data['image_path']);
		$thumb_path = str_replace("../", "", $data['thumb_path']);
		echo "<div class='col-md-3 px-5 pb-5'>
			<div class='card shadow-lg'>
			<div class='card-body d-flex justify-content-center align-items-center'>
			<img src='".$thumb_path."' width='100' height='150' data-location='".$path."' class='rounded-circle pic'>
			</div>
			<div class='card-footer d-flex justify-content-around align-items-center'>
			<span>".$image_name."</span>
			<i class='fa fa-save save-icon d-none' data-location='".$path."'></i>
			<i class='fa fa-spinner fa-spin d-none loader' data-location='".$path."'></i>
			<i class='fa fa-edit edit-icon' data-location='".$path."'></i>
			<i class='fa fa-download download-icon' data-location='".$path."' file-name='".$image_name."'></i>
			<i class='fa fa-trash delete-icon' data-location='".$path."'></i>
			</div>
			</div>
		</div>";
	}

	?>