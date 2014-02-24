<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Photo {

	public function add_upload_photo($conf_id, $filename, $filesize, $file_type, $desc)
	{
		$user_id = Service_Login::get_user_in_session();
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		$result = $this->get_photo_list($user_id, $conf_id);
		
		if($result){
			foreach ($result as $result1){
				if($result1->get('photo_name') == $filename){
					$output['status'] = "file already exist";
					return $output;
					break;
				}
			}
		}
		
		$photo = ORM::factory('Photo');
		
		$photo->event = $conf_id;
		$photo->photo_name = $filename;
		$photo->caption= $desc;
		$photo->size = $filesize;
		$photo->created_by = $user_id;
		$photo->created_date = date("Y-m-d");
		$photo->updated_by = $user_id;
		$photo->updated_date = date("Y-m-d");
		$photo->save();
		
		return $photo->pk();
	}
	
	public function get_photo_list($user_id, $conference_id)
	{
		$Photos = ORM::factory('Photo')
						->where('created_by', '=', $user_id)
						->where('event', '=', $conference_id)
						->find_all();

		return $Photos;
	}
	
	public function get_all_photo_list($conference_id)
	{
		$Photos = ORM::factory('Photo')
						->where('event', '=', $conference_id)
						->find_all();

		return $Photos;
	}
	
	public function delete_upload_photo($user_id, $conf_id, $photoname)
	{
		if(Service_Login::is_login() && Auth::instance()->get_user()->is_admin())
        {
			$query = DB::delete('event_photo')
						->where('photo_name', '=', $photoname)
						->where('event', '=', $conf_id);
						

        }
        else
        {
			$query = DB::delete('event_photo')
						->where('photo_name', '=', $photoname)
						->where('event', '=', $conf_id)
						->where('created_by', '=', $user_id);
		}				
		$query->execute();
	}
	
	public function update_photo($user_id, $conf_id, $photoname, $desc)
	{
		if(Service_Login::is_login() && Auth::instance()->get_user()->is_admin())
        {
			$query = DB::update('event_photo')
						->set(array(
							'caption' => $desc,
						))
						->where('photo_name', '=', $photoname)
						->where('event', '=', $conf_id);


		}
		else
		{
			$query = DB::update('event_photo')
						->set(array(
							'caption' => $desc,
						))
						->where('photo_name', '=', $photoname)
						->where('event', '=', $conf_id)
						->where('created_by', '=', $user_id);
		}
		$query->execute();
	}
}