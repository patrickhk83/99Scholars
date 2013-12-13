<?php defined('SYSPATH') or die('No direct script access.');

class Dao_File {

	public function add_upload_file($conf_id, $filename, $filesize, $file_type, $desc)
	{
		$user_id = Service_Login::get_user_in_session();
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		if($ext=='ppt' || $ext=='pptx')
		{
			$filetype=1;
		}
		elseif($ext=='xls' || $ext=='xlsx')
		{
			$filetype=2;
		}
		elseif($ext=='doc' || $ext=='docx')
		{
			$filetype=3;
		}
		elseif($ext=='pdf')
		{
			$filetype=4;
		}
		elseif($ext=='txt')
		{
			$filetype=5;
		}
		else
		{
			$filetype=6;
		}
		
		$result = $this->get_file_list($user_id, $conf_id);
		
		if($result){
			foreach ($result as $result1){
				if($result1->get('file_name') == $filename){
					$output['status'] = "file already exist";
					return $output;
					break;
				}
			}
		}
		
		$file = ORM::factory('File');
		
		$file->file_name = $filename;
		$file->event = $conf_id;
		$file->created_by = $user_id;
		$file->file_type = $filetype;
		$file->size = $filesize;
		$file->description = $desc;
		$file->created_date = date("Y-m-d");
		
		$file->save();
		
		return $file->pk();
	}
	
	public function get_file_list($user_id, $conference_id)
	{
		$Files = ORM::factory('File')
						->where('created_by', '=', $user_id)
						->where('event', '=', $conference_id)
						->find_all();

		return $Files;
	}
	
	public function get_all_file_list($conference_id)
	{
		$Files = ORM::factory('File')
						->where('event', '=', $conference_id)
						->find_all();

		return $Files;
	}
	
	public function delete_upload_file($user_id, $conf_id, $filename)
	{
		$query = DB::delete('event_file')
					->where('file_name', '=', $filename)
					->where('event', '=', $conf_id)
					->where('created_by', '=', $user_id);

		$query->execute();
	}
	
	public function update_file($user_id, $conf_id, $filename, $desc)
	{
		$query = DB::update('event_file')
					->set(array(
						'description' => $desc,
					))
					->where('file_name', '=', $filename)
					->where('event', '=', $conf_id)
					->where('created_by', '=', $user_id);

		$query->execute();
	}
}