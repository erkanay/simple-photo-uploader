<?php
/** 
 * +------------------------------------------------------------------------+ 
 * | common.class.php                                                       | 
 * +------------------------------------------------------------------------+ 
 * | @author : Erkan AY				                            | 
 * |------------------------------------------------------------------------+  						                                                 
 * | Email         info@erkanay.com                                         | 
 * | Web           http://erkanay.com                                       |            
 * +------------------------------------------------------------------------+
 *
 */ 
class Uploader{
	public function photoUpload(){
		$path = 'uploads/';
		$file_ext   = array('jpg','png','gif','bmp');
		$post_ext   = end(explode('.',$_FILES['photo']['name']));
		$photo_name = $_FILES['photo']['name'];
		$photo_type = $_FILES['photo']['type'];
		$photo_size = $_FILES['photo']['size'];
		$photo_tmp  = $_FILES['photo']['tmp_name'];
		$photo_error= $_FILES['photo']['error'];
		//control of extensions and size
		if((($photo_type == 'image/jpeg') || ($photo_type == 'image/gif')   ||
		   ($photo_type == 'image/png') || ($photo_type == 'image/pjpeg')) &&
		   ($photo_size < 2000000) && in_array($post_ext,$file_ext)){
			if($photo_error > 0 ){
				echo 'Error '.$photo_error;
				exit;
			}else{
				echo $photo_name.' Uploaded !';
			}
			if(file_exists($path.$photo_name)){
				echo 'There is '.$photo_name;
			}else{
				//new photo name and encryption
				$new_name = explode('.',$photo_name);
				$photo_name = 'erkan_'.md5($new_name[0]).'.'.$new_name[1];
				if(move_uploaded_file($photo_tmp,$path.$photo_name)){
					echo "<img src=$path.$photo_name />";
				}
			}
		}
		else{
			echo 'The uploaded file has invalid rules';
		}
	}
}	
$upload = new Uploader();
?>
