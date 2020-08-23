$("document").ready(function(){
	$(".upload-icon").click(function(){
		var input =  document.createElement("INPUT");
		input.type = "file";
		input.accept = "image/*";
		input.click();
		input.onchange = function(){
			var file = new FormData();
			file.append("data",this.files[0]);
			$.ajax({
				type : "POST",
				url : "php/upload.php",
				data : file,
				contentType : false,
				processData : false,
				cache : false,
				xhr : function(){
					var request = new XMLHttpRequest();
					request.upload.onprogress = function(e){
						var loaded = (e.loaded/1024/1024).toFixed(2);
						var total = (e.total/1024/1024).toFixed(2);
						var persentage = ((loaded*100)/total).toFixed(2);
						$(".progress-control").css({width: persentage+"%"});
						$(".progress-persentage").html(persentage+"%   "+loaded+" MB/"+total+" MB<br>");
					}
					return request;
				},
				beforeSend : function(){
					$(".upload-header").html("Please wait...");
					$(".upload-icon").css({
						opacity : "0.5",
						pointerEvents : "none",
					});
					$(".progress-details").removeClass("d-none");
					$(".upload-progress-con").removeClass("d-none");
				},
				success : function(response){
					if(response.trim() == "success !")
					{
						var massage = document.createElement("DIV");
						massage.className = "alert alert-light py-3 shadow-lg rounded-0";
						massage.innerHTML = "<b>"+response+"<b>";
						$(".upload-notice").html(massage);
						setTimeout(function(){
							$(".upload-header").html("UPLOAD FILES");
						$(".upload-icon").css({
						opacity : "1",
						pointerEvents : "inherit",
						});
						$(".progress-details").addClass("d-none");
						$(".upload-progress-con").addClass("d-none");
						$(".upload-notice").html("");
						},3000);
						

					}
					else
					{
						var massage = document.createElement("DIV");
						massage.className = "alert alert-primary py-3 shadow-lg rounded-0";
						massage.innerHTML = "<b>"+response+"<b>";
						$(".upload-notice").html(massage);
						setTimeout(function(){
							$(".upload-header").html("UPLOAD FILES");
						$(".upload-icon").css({
						opacity : "1",
						pointerEvents : "inherit",
						});
						$(".progress-details").addClass("d-none");
						$(".upload-progress-con").addClass("d-none");
						$(".upload-notice").html("");
						},3000);
					}
					
					$.ajax({
						type : "POST",
						url : "php/photo_count.php",
						cache : false,
						beforeSend : function(){
							$("#photo_count").html("updating...");
						},
						success : function(response){
							$("#photo_count").html(response);
						}
					});
					$.ajax({
						type : "POST",
						url : "php/memory.php",
						cache : false,
						beforeSend : function(){
							$("#memory-status").html("updating...");
							$("#free_space").html("updating...");
						},
						success : function(response){
							var json_response = JSON.parse(response);
							var memory_status = json_response[0];
							var free_space = json_response[1];
							var persentage = json_response[2];
							$("#memory-status").html(memory_status);
							$("#free_space").html("FREE SPACE: "+free_space);
							$(".memory-progress").css("width", persentage);
						}
					});
				} 
			});
		}
	});
});