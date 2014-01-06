<?php defined('SYSPATH') or die('No direct script access.');

class Service_File {

	public function upload_multiple_file($file, $file_dir, $conf_id, $desc) {

		$overwrite=0;
		$result = array();
			
		$allowed_file_type= array("pdf","ppt","pptx","xls","xlsx","doc","docx","txt","rtf");
		$max_file_size = 20971520;
		
		$toCreate = array(
			'file/'.$file_dir.'/attachment'
		);
		
		$permissions = 0755;
	      
		foreach ($toCreate as $dir) {
			if(is_dir($dir)==false){
				mkdir($dir, $permissions, TRUE);
			}
		}
		
		$file_dir = 'file/'.$file_dir.'/attachment';
		
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
					$fsize=$max_file_size/1048576;
					
					$result['status'] = 'File size must be less than '.$fsize.' MB';
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
				
			if(is_dir($file_dir)){
				
				if($overwrite < 1){
				    move_uploaded_file($file_tmp_name,"$file_dir/".$file_name);
				}
			}
			$user_service = new Dao_File();
			$result = $user_service->add_upload_file($conf_id, $file_name, $file_size,$file_type,$desc);
		}
	}
	
}