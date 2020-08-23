<?php
require("../../php/database.php");
session_start();
$username = $_SESSION['username'];
$get_id = "SELECT id FROM users WHERE username = '$username'";
$response = $db->query($get_id);
$data = $response->fetch_assoc();
$folder_name = "../gallery/user_".$data['id']."/";
$file = $_FILES['data'];
$user_path = $file['tmp_name'];
$extention = $file['type'];
$file_name = strtolower($file['name']);
$file_size = round($file['size']/1024/1024,2);

$check_storage = "SELECT plans,storage,used_storage FROM users WHERE username = '$username'";
$check_storage_response = $db->query($check_storage);
$storage = $check_storage_response->fetch_assoc();
$total = $storage['storage'];
$plans = $storage['plans'];
$used_storage = $storage['used_storage'];
$free_storage = $total-$used_storage;
$complete_path = $folder_name.$file_name;
$thumb_path = $folder_name."thumb_".$file_name;
if($plans == "starter" || $plans == "free")
{
	if ($file_size<$free_storage) 
	{
	if(file_exists($folder_name.$file_name))
	{
	
	 echo "file already exits please rename your file";
	}
	else
	{
		if(move_uploaded_file($user_path, $folder_name.$file_name))
		{
		$table_name ="user_".$data['id'];
	     $insert_data ="INSERT INTO $table_name(image_name,image_path,thumb_path,image_size) VALUES('$file_name','$complete_path','$thumb_path','$file_size')";
	     if($db->query($insert_data))
	     {
	     	$used_memory = $used_storage+$file_size;
	     	$update_used_storage = "UPDATE users SET used_storage = '$used_memory' WHERE username = '$username'";
	     	if($db->query($update_used_storage))
	     	{
	     		if($extention == "image/jpeg")
	     		{
		     		$image_pixel = imagecreatefromjpeg($folder_name.$file_name);
		     		$o_width = imagesx($image_pixel);
		     		$o_height = imagesy($image_pixel);
		     		$ratio = 100/$o_width;
		     		$height = $ratio*$o_height;
		     		$canvas = imagecreatetruecolor(100, $height);
		     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
		     		if(imagejpeg($canvas,$thumb_path))
		     		{
		     			echo "success !";
		     		}
		     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/png")
	     		{
		     		$image_pixel = imagecreatefrompng($folder_name.$file_name);
		     		$o_width = imagesx($image_pixel);
		     		$o_height = imagesy($image_pixel);
		     		$ratio = 100/$o_width;
		     		$height = $ratio*$o_height;
		     		$canvas = imagecreatetruecolor(100, $height);
		     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
		     		if(imagepng($canvas,$thumb_path))
		     		{
		     			echo "success !";
		     		}
		     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/gif")
	     		{
		     		$image_pixel = imagecreatefromgif($folder_name.$file_name);
		     		$o_width = imagesx($image_pixel);
		     		$o_height = imagesy($image_pixel);
		     		$ratio = 100/$o_width;
		     		$height = $ratio*$o_height;
		     		$canvas = imagecreatetruecolor(100, $height);
		     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
		     		if(imagegif($canvas,$thumb_path))
		     		{
		     			echo "success !";
		     		}
		     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/bmp")
	     		{
		     		$image_pixel = imagecreatefrombmp($folder_name.$file_name);
		     		$o_width = imagesx($image_pixel);
		     		$o_height = imagesy($image_pixel);
		     		$ratio = 100/$o_width;
		     		$height = $ratio*$o_height;
		     		$canvas = imagecreatetruecolor(100, $height);
		     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
		     		if(imagebmp($canvas,$thumb_path))
		     		{
		     			echo "success !";
		     		}
		     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/webp")
	     		{
		     		$image_pixel = imagecreatefromwebp($folder_name.$file_name);
		     		$o_width = imagesx($image_pixel);
		     		$o_height = imagesy($image_pixel);
		     		$ratio = 100/$o_width;
		     		$height = $ratio*$o_height;
		     		$canvas = imagecreatetruecolor(100, $height);
		     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
		     		if(imagewebp($canvas,$thumb_path))
		     		{
		     			echo "success !";
		     		}
		     		imagedestroy($image_pixel);
	     		}
	     		
	     	}
	     	else
	     	{
	     		echo "faild to update used storage";
	     	}
	     }
	     else
	     {
	     	echo "file name too large kindely short you file name";
	     }
	 	}
	 	else
	 	{
	 		echo "upload faild";
	 	}
	}
	}
	else
	{
	echo "File size too large kindely purchage some space";
	}
}
else
{
	if(file_exists($folder_name.$file_name))
	{
	
	 echo "file already exits please rename your file";
	}
	else
	{
		if(move_uploaded_file($user_path, $folder_name.$file_name))
		{
		$table_name ="user_".$data['id'];
	     $insert_data ="INSERT INTO $table_name(image_name,image_path,thumb_path,image_size) VALUES('$file_name','$complete_path','$thumb_path','$file_size')";
	     if($db->query($insert_data))
	     {
	     	$used_memory = $used_storage+$file_size;
	     	$update_used_storage = "UPDATE users SET used_storage = '$used_memory' WHERE username = '$username'";
	     	if($db->query($update_used_storage))
	     	{
	     		if($extention == "image/jpeg")
	     		{
	     		$image_pixel = imagecreatefromjpeg($folder_name.$file_name);
	     		$o_width = imagesx($image_pixel);
	     		$o_height = imagesy($image_pixel);
	     		$ratio = 100/$o_width;
	     		$height = $ratio*$o_height;
	     		$canvas = imagecreatetruecolor(100, $height);
	     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
	     		if(imagejpeg($canvas,$thumb_path))
	     		{
	     			echo "success !";
	     		}
	     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/png")
	     		{
	     		$image_pixel = imagecreatefrompng($folder_name.$file_name);
	     		$o_width = imagesx($image_pixel);
	     		$o_height = imagesy($image_pixel);
	     		$ratio = 100/$o_width;
	     		$height = $ratio*$o_height;
	     		$canvas = imagecreatetruecolor(100, $height);
	     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
	     		if(imagepng($canvas,$thumb_path))
	     		{
	     			echo "success !";
	     		}
	     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/gif")
	     		{
	     		$image_pixel = imagecreatefromgif($folder_name.$file_name);
	     		$o_width = imagesx($image_pixel);
	     		$o_height = imagesy($image_pixel);
	     		$ratio = 100/$o_width;
	     		$height = $ratio*$o_height;
	     		$canvas = imagecreatetruecolor(100, $height);
	     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
	     		if(imagegif($canvas,$thumb_path))
	     		{
	     			echo "success !";
	     		}
	     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/bmp")
	     		{
	     		$image_pixel = imagecreatefrombmp($folder_name.$file_name);
	     		$o_width = imagesx($image_pixel);
	     		$o_height = imagesy($image_pixel);
	     		$ratio = 100/$o_width;
	     		$height = $ratio*$o_height;
	     		$canvas = imagecreatetruecolor(100, $height);
	     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
	     		if(imagebmp($canvas,$thumb_path))
	     		{
	     			echo "success !";
	     		}
	     		imagedestroy($image_pixel);
	     		}
	     		if($extention == "image/webp")
	     		{
	     		$image_pixel = imagecreatefromwebp($folder_name.$file_name);
	     		$o_width = imagesx($image_pixel);
	     		$o_height = imagesy($image_pixel);
	     		$ratio = 100/$o_width;
	     		$height = $ratio*$o_height;
	     		$canvas = imagecreatetruecolor(100, $height);
	     		imagecopyresampled($canvas,$image_pixel,0,0,0,0,100,$height,$o_width,$o_height);
	     		if(imagewebp($canvas,$thumb_path))
	     		{
	     			echo "success !";
	     		}
	     		imagedestroy($image_pixel);
	     		}
	     	}
	     	else
	     	{
	     		echo "faild to update used storage";
	     	}
	     }
	     else
	     {
	     	echo "file name too large kindely short you file name";
	     }
	 	}
	 	else
	 	{
	 		echo "upload faild";
	 	}
	}
}

?>
<?php 
 //close database connection
	$db->close();
?>