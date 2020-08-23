<?php

session_start();
$username = $_SESSION['username'];
$table_name = $_SESSION['table_name'];
if(empty($username))
{
	header("Location: ../index.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gallery</title>
	<link href="https://fonts.googleapis.com/css?family=Francois+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../style/animate.css">
	<link rel="stylesheet" type="text/css" href="../style/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	
	<script src="js/edit_photo.js"></script>
	<style>
		body{
			background:#FCD0CF;

		}
		span:focus{
			outline: 2px dashed red !important;
			padding: 2px !important;
			box-shadow: 0px 0px 5px grey !important;
		 }
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		<a href="#" class="navbar-brand">
		<?php
		require("../php/database.php");
		$email = $_SESSION['username'];
		$get_name = "SELECT full_name FROM users WHERE username = '$email'";
		$response = $db->query($get_name);
		$name = $response->fetch_assoc();
		echo $name['full_name'];
		

		?>
		</a>
		<ul class="navbar-nav ml-auto">
			<li class="navbar-item">
				<a href="php/logout.php" class="nav-link">
					<i class="fa fa-sign-out" style="font-size: 18px"></i>Logout
				</a>
			</li>
		</ul>
	</nav>
	<br>
	<div class="container mt-5">
		<div class="row load-image">
	
		</div>
	</div>
	<div class="modal animate bounceIn my-5" id="view-modal">
		<div class="modal-dialog">
			<i class="fa fa-times-circle float-right text-white" data-dismiss="dialog"></i>
			<div class="modal-content">
				<div class="progress w-100" style="height:10px;border-bottom-left:0;border-bottom-left:0;">
					<div class="progress-bar image-loader">
						
					</div>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$(".pic").each(function(){
				$(this).click(function(){
					$(".image-loader").css({
						width : 0
					});
					$("#view-modal").modal();
					var img = document.createElement("IMG");
					var url = $(this).attr("data-location");
					$.ajax({
						type : "POST",
						url : url,
						xhr : function(){
							var request = new XMLHttpRequest();
							request.responseType = "blob";
							request.onprogress = function(e){
								var percentage = Math.floor((e.loaded*100)/e.total);
								$(".image-loader").css({
									width : percentage+"%"
								});
								$(".image-loader").html(percentage);
							}
							return request;
						},
						beforeSend : function(){
							$(".modal-body").html("Plaese wait...");
						},
						success : function(response){
							var image_url = URL.createObjectURL(response);
							img.src = image_url;
							img.style.width = "100%";
							$(".modal-body").html(img);
						}
					});
					
				});
			});
		});
		$(document).ready(function(){
			var start_point = 0;
			var end_point = 12;
			load_image(start_point,end_point);
			function load_image(start_point,end_point){
				$.ajax({
					type : "POST",
					url : "load_image.php",
					data : {
						start : start_point,
						end : end_point
					},
					cache : false,
					success : function(response){
						$(".load-image").append(response);
					}
				});
			}
		
		$(window).scroll(function(){
			var scroll_top = $(window).scrollTop();
			var browser_height = $(window).height();
			var max_height = scroll_top+browser_height;
			var webpage_height = $(document).height();
			console.log("max"+scroll_top+" = "+browser_height);
			if (max_height>=webpage_height-10)
			{
				start_point = start_point+end_point;
				load_image(start_point,end_point);
			}
		});
		});
	</script>	
</body>
</html>
<?php 
 //close database connection
	$db->close();
?>
