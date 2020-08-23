<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PIcdrive</title>
	<link href="https://fonts.googleapis.com/css?family=Francois+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/animate.css">
	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src="js/ajax_random_password.js"></script>
	<script src="js/index.js"></script>
	<script src="js/ajax_check_user.js"></script>
	<script src="js/ajax_sign_up.js"></script>
	<script src="js/ajax_activate.js"></script>
	<script src="js/ajax_login.js"></script>

</head>
<body style="background:#FCD0CF" class="animated fadeIn slower">
	<div class="container-fluid border-primary">
		<div class="row">
			<div class="col-md-4 px-5 py-4">
				<img src="images/main_pic.jpg" class="shadow-lg" style="width:100%;height: 100%" />
			</div>
			<div class="col-md-4 px-5 py-4">
				<h3 class="ml-2 mb-3">SIGN UP</h3>
				<form autocomplete="off" id="signup-form">
					<input type="text" name="fullname" id="fullname" placeholder="Enter Full Your Name" required="required">
					<div class="email-box">
					<input type="text" name="email" id="email" placeholder="Enter Your Email" required="required">
					<i class="fa fa-spinner fa-spin email-icon d-none" style="font-size:18px"></i>
					</div>
					<div class="password-box">
					<input type="password" name="password" id="password" placeholder="Password" required="required">
					<i class="fa fa-eye show-icon" style="font-size:18px"></i>
					</div>
					<button type="button" class="btn float-left py-2">CLICK IMPROVE SECURITY</button>
					<button type="button" class="btn float-right generate-btn">GENERATE</button>
					<button type="submit" class="btn submit-btn m-3" disabled="disabled">Register Now</button>
					
				</form>
				<div class="signup-notice">
					</div>
					<div class="px-2 d-none activator">
						<span>Please check your email to get activation code</span>
						<input type="text" name="code" id="code" class="my-3" placeholder="Activation code">
						<button class="btn btn-dark activate-btn">Activate Now</button>
					</div>
			</div>
		  <div class="col-md-4 py-4 px-5">
			<h3 class="ml-2 mb-3">Login</h3>
			<div>
				<form autocomplete="off" id="login-form">
					<div class="email-box">
					<input type="text" name="email" id="login-email" placeholder="Username" required="required">
					</div>
					<div class="password-box">
					<input type="password" name="password" id="login-password" placeholder="Password" required="required">
					<i class="fa fa-eye show-icon" style="font-size:18px"></i>
				    </div>
					<button type="submit" class="btn btn-dark float-right login-submit-btn m-3">Login</button>
				</form>
			</div>
				<div class="px-2 login-activator d-none">
						<span>Please check your email to get activation code</span>
						<input type="text" name="code" id="login-code" class="my-3" placeholder="Activation code">
						<button class="btn btn-dark login-activate-btn">Activate Now</button>
				</div>
				<br><br><br><br>
				<div class="login-notice"></div>
		</div>
    </div>
</div>
</body>
</html>