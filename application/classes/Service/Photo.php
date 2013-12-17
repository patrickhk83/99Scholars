<?php defined('SYSPATH') or die('No direct script access.');

class Service_Photo {

	public function upload_multiple_photo($file, $file_dir, $conf_id, $desc) {

		$overwrite=0;
		$result = array();
			
		$allowed_file_type= array("jpg","jpeg","png","gif");
		
		$sizes = array(140 => 140);
		
		$max_file_size = 1024*1000;;
		
		$toCreate = array(
			'gallery/'.$conf_id.'/photos',
			'gallery/'.$conf_id.'/thumb'
		);
		
		$permissions = 0755;
	      
		foreach ($toCreate as $dir) {
			if(is_dir($dir)==false){
				mkdir($dir, $permissions, TRUE);
			}
		}
		
		$file_dir = 'gallery/'.$conf_id.'/photos';
		$file_dir1 = 'gallery/'.$conf_id.'/thumb';
		
		foreach($file['name'] as $fkey=> $fname){
		
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			
			if (!in_array($ext, $allowed_file_type)) {
			
				$result['status'] = "unsupported file format";
				return $result;
				       break;
			}
		}
		
		foreach($file['tmp_name'] as $key => $tmp_name ){
			$file_name = $file['name'][$key];
			$file_size = $file['size'][$key];
			$file_tmp_name = $file['tmp_name'][$key];
			$file_type = $file['type'][$key];
			
			if($file_size >0) {
				if($file_size > $max_file_size){
					$fsize=$max_file_size/1024;
					
					$result['status'] = 'File size must be less than '.$fsize.' KB';
					return $result;
						break;
				}
			}
			
			if(is_dir($file_dir)==false){
				$status =  mkdir("$file_dir", 777);
		       
				if($status < 1){
					$result['status'] = "unable to create  diractory $file_dir ";
					return $result;
				}
			}
			
			if(is_dir($file_dir1)==false){
						
				$status =  mkdir("$file_dir1", 777);
		       
				if($status < 1){
					$result['status'] = "unable to create  diractory $file_dir1";
					echo "this is the value";
					return $result;
				}
			}
				
			if(is_dir($file_dir)){
				
				if($overwrite < 1){
				    copy($file_tmp_name,"$file_dir/".$file_name);
				}
			}
			
			list($w, $h) = getimagesize($file['tmp_name'][$key]);
			
			$width = 140;
			$height = 140;
			$ratio = max($width/$w, $height/$h);
			$h = ceil($height / $ratio);
			$x = ($w - $width / $ratio) / 2;
			$w = ceil($width / $ratio);
			$path1= 'gallery/'.$conf_id.'/thumb/'.$file_name;
			$imgString = file_get_contents($file_tmp_name);
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($width, $height);
			imagecopyresampled($tmp, $image,
			0, 0,
			$x, 0,
			$width, $height,
			$w, $h);
			switch ($file_type) {
				case 'image/jpeg':
					imagejpeg($tmp, $path1, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path1, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path1);
					break;
				default:
					exit;
					break;
			}
			
			$user_service = new Dao_Photo();
			$result = $user_service->add_upload_photo($conf_id, $file_name, $file_size,$file_type,$desc);
		}
	}
	
}