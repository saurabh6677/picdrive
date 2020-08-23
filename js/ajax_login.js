$("document").ready(function(){
	$("#login-form").on("submit", function(e){
		e.preventDefault();
		var username = btoa($("#login-email").val());
		var password = btoa($("#login-password").val());
		$.ajax({
			type : "POST",
			url : "php/login.php",
			data : {
				username : username,
				password : password
			},
			cache : false,
			beforeSend : function(){
				$(".login-submit-btn").attr("disabled","disabled");
				$(".login-submit-btn").html("Please wait...");
			},
			success : function(response){
				if(response.trim() == "login success")
				{
					window.location = "profile/profile.php";
				}
				else if(response.trim() == "login panding") 
				{
					$("#login-form").fadeOut(500,function(){
						$(".login-activator").removeClass("d-none");
						$(".login-activate-btn").click(function(){
							$.ajax({
								type : "POST",
								url : "php/activator.php",
								data : {
									code : btoa($("#login-code").val()),
									username: btoa($("#login-email").val())
								},
								cache : false,
								beforeSend : function(){
									$(".login-activate-btn").html("please wait");
									$(".login-activate-btn").attr("disabled","disabled");
								},
								success : function(response){
									if(response.trim() == "verified")
									{
										window.location = "profile/profile.php";
									}
									else
									{
										var notice = document.createElement("DIV");
										notice.className = "alert alert-warning";
										notice.innerHTML = "wrong activation code";
										$(".login-notice").append(notice);
										$("#login-code").val("");
										$(".login-activate-btn").html("Activate");
										$(".login-activate-btn").removeAttr("disabled");
										setTimeout(function(){
											$(".login-notice").html("");
										},5000);
									}
								}
							});
						});

					});
					
				}
				else if (response.trim() == "wrong password")
				{
					var massage = document.createElement("DIV");
					massage.className = "alert alert-warning";
					massage.innerHTML = "<b>worng password</b>";
					$(".login-notice").append(massage);
					$("#login-form").trigger("reset");
					$(".login-submit-btn").html("Login");
					$(".login-submit-btn").removeAttr("disabled");
					setTimeout(function(){
						$(".login-notice").html("");
					},5000);

				}
				else
				{
					massage = document.createElement("DIV");
					massage.className = "alert alert-warning";
					massage.innerHTML = "<b>user not found please signup</b>";
					$(".login-notice").append(massage);
					$("#login-form").trigger("reset");
					$(".login-submit-btn").html("Login");
					$(".login-submit-btn").removeAttr("disabled");
					setTimeout(function(){
						$(".login-notice").html("");
					},5000);
				}
			}
		});

	});
});