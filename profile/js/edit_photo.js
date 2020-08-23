
//rename Photo

$(document).ready(function(){
	$(".edit-icon").each(function(){
		$(this).click(function(){
			var edit_icon = $(this);
			var image_path  = $(this).attr("data-location");
			var footer = this.parentElement;
			var span = footer.getElementsByTagName("SPAN")[0];
			var old_name = span.innerHTML;
			span.contentEditable = "true";
			var loader = footer.getElementsByClassName("loader")[0];
			span.focus();
			var old_name = span.innerHTML;
			$(this).addClass("d-none");
			var save_icon = footer.getElementsByClassName("save-icon")[0];
			$(save_icon).removeClass("d-none");
			$(save_icon).click(function(){
				var photo_name = span.innerHTML;
				$.ajax({
					type : "POST",
					url : "php/rename.php",
					data : {
						image_name : photo_name,
						image_path : image_path
					},
					cache : false,
					beforeSend : function(){
						$(loader).removeClass('d-none');
						$(save_icon).addClass("d-none");
					},
					success : function(response){
						if(response.trim() == "file already exists try with other name")
						{
							alert(response);
							$(loader).addClass('d-none');
							$(save_icon).removeClass("d-none");
							$(edit_icon).addClass("d-none");
							span.focus();
						}
						else if (response.trim() == "success") 
						{
							span.innerHTML = photo_name;
							$(loader).addClass('d-none');
							$(save_icon).addClass("d-none");
							$(edit_icon).removeClass("d-none");
							var previous_download_link = footer.getElementsByClassName("download-icon")[0].getAttribute("data-location");
							var current_download_link = previous_download_link.replace(old_name,photo_name);
							footer.getElementsByClassName("download-icon")[0].setAttribute("data-location", current_download_link);
							footer.getElementsByClassName("download-icon")[0].setAttribute("file-name", photo_name);
							footer.getElementsByClassName("delete-icon")[0].setAttribute("data-location", current_download_link);
							footer.getElementsByClassName("edit-icon")[0].setAttribute("data-location", current_download_link);
							footer.getElementsByClassName("edit-icon")[0].setAttribute("file-name", photo_name);
							footer.getElementsByClassName("edit-icon")[0].setAttribute("data-location", current_download_link);

						}
					}
				});
			});
		});
	});
});

// Download Photo

$(document).ready(function(){
	$(".download-icon").each(function(){
		$(this).click(function(){
   			var download_link = $(this).attr("data-location");
   			var file_name = $(this).attr("file-name");
			var a = document.createElement("A");
			a.href = download_link;
			a.download = file_name;
			a.click();
		});
	});
});


//Delete Photo
$(document).ready(function(){
	$(".delete-icon").each(function(){
		$(this).click(function(){
			var image_path = $(this).attr("data-location");
			var delete_icon = this;
			$.ajax({
				type : "POST",
				url : "php/delete.php",
				data : {
					path : image_path
				},
				cache : false,
				beforeSend : function(){
					$(this).removeClass("fa fa-trash");
					$(this).addClass("fa fa-spinner fa-spin");
				},
				success : function(response){
					if(response.trim() == "success")
					{
						delete_icon.parentElement.parentElement.style.display = "none";
					}
					else{
						alert(response);
					}
					
				}
			});
		});
	});
});