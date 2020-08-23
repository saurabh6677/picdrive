$("document").ready(function(){
	$("#signup-form").on("submit",function(e){
		e.preventDefault();
		$.ajax({
			type : "POST",
			url : "php/sign_up.php",
			data : {
				fullname : btoa($("#fullname").val()),
				email : btoa($("#email").val()),
				password : btoa($("#password").val())
			},
			cache : false,
			beforeSend : function(){
				$(".submit-btn").html("Please wait");
				$(".submit-btn").attr("disabled","disabled");
			},
			success : function(response){
				if(response.trim() == "mail success")
				{
					$("#signup-form").fadeOut(500,function(){
						$(".activator").removeClass("d-none");
					});
				}
				else
				{
					var massage = document.createElement("DIV");
					massage.className = "alert alert-warning";
					massage.innerHTML = "<b>Somthing went wrong please try again later";
					$(".signup-notice").append(massage);
					$(".submit-btn").html("Register Now");
					$(".email-icon").addClass("d-none");
					$("#signup-form").trigger("reset");
					setTimeout(function(){
						$(".signup-notice").html("");
					},2000);
				}
			}
		});
	});
});