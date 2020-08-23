<?php
require("../php/database.php");
session_start();
$username = $_SESSION['username'];
if(empty($username))
{
	header("Location: ../index.php");
	exit;
}

$starter = '<ul class="list-group w-100 shadow-lg">
					<li class="list-group-item bg-success">
						<h3 class="text-white text-center">STARTER PLAN</h3>
					</li>
					<li class="list-group-item">1 GB STORAGE</li>
					<li class="list-group-item" style="color:#ddd;">24*7 TECHNICAL SUPPORT</li>
					<li class="list-group-item" style="color:#ddd;">INSTANT EMAIL SOLUTION</li>
					<li class="list-group-item" style="color:#ddd;">DATA SECURITY</li>
					<li class="list-group-item" style="color:#ddd;">SEO</li>
					<li class="list-group-item bg-light text-center buy-btn" style="cursor: pointer;" amount="99" storage="1024" plan="starter">
						<h4><i class="fa fa-inr"></i> 99.00/monthly</h4>
					</li>
				</ul>';
$exclusive = '<ul class="list-group w-100 shadow-lg">
					<li class="list-group-item bg-warning">
						<h3 class="text-white text-center">EXCLUSIVE PLAN</h3>
					</li>
					<li class="list-group-item">UNLIMITED STORAGE</li>
					<li class="list-group-item">24*7 TECHNICAL SUPPORT</li>
					<li class="list-group-item">INSTANT EMAIL SOLUTION</li>
					<li class="list-group-item" >DATA SECURITY</li>
					<li class="list-group-item" >SEO</li>
					<li class="list-group-item bg-light text-center buy-btn" style="cursor: pointer;" amount="500" storage="unlimited" plan="exclusive">
						<h4><i class="fa fa-inr"></i> 500.00/monthly</h4>
					</li>
				</ul>';
$get_plans = "SELECT plans FROM users WHERE username='$username'";
$response_plans = $db->query($get_plans);
$response_plans =$response_plans->fetch_assoc();
$plans = $response_plans['plans'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
	<link href="https://fonts.googleapis.com/css?family=Francois+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../style/animate.css">
	<link rel="stylesheet" type="text/css" href="../style/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src="js/profile.js"></script>
</head>
<body style="background:#FCD0CF;overflow-x: hidden;">
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		<a href="#" class="navbar-brand">
		<?php
		require("../php/database.php");
		$email = $_SESSION['username'];
		$get_name = "SELECT full_name FROM users WHERE username = '$email'";
		$response = $db->query($get_name);
		$name = $response->fetch_assoc();
		echo $name['full_name'];
		$_SESSION['buyer_name'] = $name['full_name'];
		

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
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-6 p-5">
				<?php 
				if($plans == "free" )
				{
					echo $starter;
				}
				else if($plans == "starter"){

					echo "<button class='btn btn-light shadow-lg p-5'><h1>You are currently using starter plan</h1></button>";
				}
				else
				
				?>
			</div>
			<div class="col-md-6 p-5">
				<?php 
				if($plans == "starter" || $plans == "free")
				{
					echo $exclusive;
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 p-5 text-center">
				<?php
				if($plans == "exclusive")
				{
					echo "<button class='btn btn-light shadow-lg p-5'><h1>You are using our most exclusive plan</h1></button>";
				}

				?>
			</div>
		</div>
	</div>
<script>
	$("document").ready(function(){
		$(".buy-btn").each(function(){
			$(this).click(function(){
				var amount = $(this).attr("amount");
				var plan = $(this).attr("plan");
				var storage = $(this).attr("storage");
				location.href = "php/payment.php?amount="+amount+"&plans="+plan+"&storage="+storage;
			});
		});
	});
</script>
</body>
</html>

<?php 
 //close database connection
	$db->close();
?>