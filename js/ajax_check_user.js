$("document").ready(function(){
	$("#email").on("change", function(){
		if($(this).val() != "")
		{
		$.ajax({
			type : "POST",
			url : "php/check_user.php",
			data : {
				email : btoa($(this).val())
			},
			cache : false,
			beforeSend : function(){
				$(".email-icon").removeClass("fa fa-spinner fa-spin text-success");
			},
			success : function(response){
				if(response.trim() == "user found")
				{
					$(".email-icon").removeClass("fa fa-check text-primary");
					$(".email-icon").removeClass("fa fa-spinner fa-spin d-none");
					$(".email-icon").addClass("fa fa-close text-danger");
					$(".submit-btn").attr("disabled","disabled");
				}
				else
				{
					$(".email-icon").removeClass("fa fa-close text-danger");
					$(".email-icon").removeClass("fa fa-spinner fa-spin d-none");
					$(".email-icon").addClass("fa fa-check text-primary");
					$(".submit-btn").removeAttr("disabled");
				}
			}
		});
	    }
	    else
	    {
	    $(".email-icon").addClass("d-none");
	    $(".submit-btn").attr("disabled","disabled");	
	    }
	});

});