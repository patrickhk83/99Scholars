<?php defined('SYSPATH') or die('No direct script access.');

class Service_UserFollow {

	protected static $instance = array();

	public static function instance()
    {
        if ( !(self::$instance instanceof Service_UserFollow))
        {
            self::$instance = new Service_UserFollow;
        }
        return self::$instance;
    }

	public function follow($user, $follow_user)
	{
		$follow_people = ORM::factory('FollowPeople');

		$follow_people->user = $user;
		$follow_people->follow_user = $follow_user;
		$follow_people->created_by = $user;
		$follow_people->created_date = time();

		$follow_people->save();
	}

	public function unfollow($user, $follow_user)
	{
		$follow_people = ORM::factory('FollowPeople')
				->where('user', '=', $user)
				->and_where('follow_user', '=', $follow_user)
				->find();

		if($follow_people->loaded())
		{
			$follow_people->delete();
		}
	}
}