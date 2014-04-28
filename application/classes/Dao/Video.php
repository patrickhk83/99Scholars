<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Video {
	
	public function add_upload_video($user,$conference,$dataid)
	{
		$video = ORM::factory('Video');

		$video->created_by = $user;
		$video->conference_id = $conference;
		$video->youtube_id = $dataid;

		$video->save();
		return $video->pk();
	}
	
	public function add_delete($user_id, $conf_id, $videoid)
	{
		if(Service_Login::is_login() && Auth::instance()->get_user()->is_admin())
        {
			$query = DB::delete('conference_video')
						->where('youtube_id', '=', $videoid)
						->where('conference_id', '=', $conf_id);
						
        }
        else
        {
			$query = DB::delete('conference_video')
						->where('youtube_id', '=', $videoid)
						->where('conference_id', '=', $conf_id)
						->where('created_by', '=', $user_id);
        }


		$query->execute();
		
	}

	public function get_video_list($user_id, $conference_id)
	{
		$attendees = ORM::factory('Video')
						->where('conference_id', '=', $conference_id)
						->order_by('id', 'desc')
						->find_all();
		return $attendees;
	}

}