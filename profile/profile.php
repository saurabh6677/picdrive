<?php

session_start();
$username = $_SESSION['username'];
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
	<div class="upload-notice fixed-top"></div>
	<div class="container-fluide">
		<div class="row">
			<div class="col-md-3 p-5 border">
				<div class="d-flex mb-4 flex-column justify-content-center align-items-center w-100 bg-white rounded-lg shadow-lg" style="height: 250px">
					<i class="fa fa-folder-open upload-icon" style="font-size: 100px"></i>
					<h4 class="upload-header">UPLOAD FILES</h4>
					<span id="free_space">
						<?php
						$get_storage = "SELECT plans,storage,used_storage,id FROM users WHERE username = '$username'";
						$response = $db->query($get_storage);
						$data = $response->fetch_assoc();
						$total = $data['storage'];
						$plans = $data['plans'];
						$id = $data['id'];
						$used = $data['used_storage'];
						if($plans == "starter" || $plans == "free")
						{
						$free_space = round($total-$used,2);
						echo "FREE SPACE: ".$free_space."MB";
					    }
					    else
					    {
					    	echo "FREE SPACE: UNLIMITED";
					    }
						?>
					</span>
					<div class="progress upload-progress-con d-none w-50 my-2" style="height: 5px">
						<div class="progress-bar progress-control progress-bar-animated progress-bar-striped">
						</div>
					</div>
					<div class="progress-details d-none">
						<span class="progress-persentage"></span>
						<i class="fa fa-pause-circle"></i>
						<i class="fa fa-times-circle"></i>
					</div>
				</div>
				<div class="d-flex mb-3 flex-column justify-content-center align-items-center w-100 bg-white rounded-lg shadow-lg" style="height: 250px">
					<i class="fa fa-database" style="font-size: 80px"></i>
					<h4 class="mt-1">MEMORY STATUS</h4>
					<span id="memory-status">
						<?php
						$get_storage = "SELECT plans,storage,used_storage,id FROM users WHERE username = '$username'";
						$response = $db->query($get_storage);
						$data = $response->fetch_assoc();
						$total = $data['storage'];
						$id = $data['id'];
						$used = $data['used_storage'];
						$plans = $data['plans'];
						if($plans == "starter" || $plans == "free")
						{
							$display ="d-block";
						echo $used."MB/".$total."MB";
						$persentage = ($used*100)/10;
						$color = "";
						if($persentage>80)
						{
							$color = "bg-danger";
						}
						else
						{
							$color = "bg-primary";
						}
				     	}
				     	else
				     	{
				     		echo "USED:".$used."MB/UNLIMITED";
				     		$display = "d-none";
				     	}
						?>
					</span>
					<div class="progress w-50 my-2 <?php echo $display;?>" style="height: 5px">
						<div class="progress-bar memory-progress <?php echo $color; ?>" style="width:<?php echo $persentage."%";?>">
							<?php echo $persentage;?>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-md-6 p-5 border"></div>
			<div class="col-md-3 p-5 border">
				<div class="d-flex mb-4 flex-column justify-content-center align-items-center w-100 bg-white rounded-lg shadow-lg" style="height: 250px">
					<a href="gallery.php" class="photo-link"><i class="fa fa-picture-o text-primary" style="font-size: 100px"></i></a>
					<h4>GALLERY</h4>
					<span id="photo_count"><?php
					$table_name = "user_".$id;
					$_SESSION['table_name'] = $table_name;
					$count_query = "SELECT COUNT(id) AS total FROM $table_name";
					$response = $db->query($count_query);
					$count = $response->fetch_assoc();
					$total= $count['total']." PHOTOS";
					echo $total;
					$_SESSION['id'] = $id;
					?></span>
				</div>
				<div class="d-flex mb-4 flex-column justify-content-center align-items-center w-100 bg-white rounded-lg shadow-lg" style="height: 250px">
					<a href="shop.php" class="cart-link"><i class="fa fa-shopping-cart" style="font-size: 100px"></i></a>
					<h4>MEMORY SHOPPING</h4>
					<span>STARTS FROM  <b>₹</b> 99.00/mo</span>
				</div>
			</div>
			
			</div>
		</div>
	</div>
	<?php

$get_expiry_date = "SELECT full_name,plans,expiry_date FROM users WHERE username='$username'";
$response_expiry_date = $db->query($get_expiry_date);
$data = $response_expiry_date->fetch_assoc();
$expiry_date = $data['expiry_date'];
$plans = $data['plans'];
$name = $data['full_name'];
$current_date = date('Y-m-d');
$cal_date = new DateTime($expiry_date);
$cal_date->sub(new DateInterval('P5D'));
$five_days_before =  $cal_date->format('Y-m-d');
if($plans != "free")
{
	if($current_date == $five_days_before )
	{
		echo "<div class='alert alert-warning rounded-0 shadow-lg fixed-top py-3'><b><i class='fa fa-times-circle close' data-dismiss='alert'></i>You have only 5 days left to renew your plans</b></div>";
	}
	else if ($current_date >$five_days_before) {
		$menul_expiry_date = date_create($expiry_date);
		$menul_current_date = date_create($current_date);
		$date_diff = date_diff($menul_current_date,$menul_expiry_date);
		$left_days = $date_diff->format('%a');
		echo "<div class='alert alert-warning rounded-0 shadow-lg fixed-top py-3'><b><i class='fa fa-times-circle close' data-dismiss='alert'></i>You have only ".$left_days." days left to renew your plans</b></div>";
		if ($current_date>=$expiry_date) {

			$amount;
			$storage;
			if ($plans == "starter")
			{
				$amount = 99;
				$storage = 1024;
			}
			else
			{
				$amount = 500;
				$storage = 'unlimited';
			}
			$link = "php/payment.php?amount=".$amount."&plans=".$plans."&storage=".$storage;
			$_SESSION['renew'] = "yes";
			$_SESSION['buyer_name'] = $name;

			echo "<div class='alert d-flex alert-warning rounded-0 shadow-lg fixed-top'>
			<h4 class='flex-fill'>Plan expired choose an action</h4>
			<a href='".$link."' class='btn btn-primary mx-3'>Renew old product</a>
			<a href='shop.php' class='btn btn-danger mr-3'>Purchase new plan</a>
			<a href='php/logout.php' class='btn btn-light shadow-sm'>Logout plan</a>
			</div>";
			echo "<style>.upload-icon,.photo-link,.cart-link{pointer-events:none}</style>";
		}
	}
}

?>
</body>
</html>
<?php 
 //close database connection
	$db->close();
?>