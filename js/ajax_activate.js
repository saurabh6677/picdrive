$("document").ready(function(){
	$(".activate-btn").click(function(){
		$.ajax({
			type : "POST",
			url : "php/activator.php",
			data : {
				code : btoa($("#code").val()),
				username : btoa($("#email").val())
			},
			cache : false,
			beforeSend : function(){
				$(".activate-btn").html("Please wait...");
				$(".activate-btn").attr("disabled","disabled");
			},
			success : function(response){
				if(response.trim() == "verified")
				{
					window.location.assign("profile/profile.php");
				}
				else
				{
					var notice = document.createElement("DIV");
										notice.className = "alert alert-warning";
										notice.innerHTML = "wrong activation code";
										$(".signup-notice").append(notice);
										$("#code").val("");
										$(".activate-btn").html("Activate");
										$(".activate-btn").removeAttr("disabled");
										setTimeout(function(){
											$(".signup-notice").html("");
										},5000);
				}
			}
		});
	});
});