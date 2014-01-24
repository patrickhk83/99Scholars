<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Schedule {
	
	public function create_session($conf_id, $user_id, $date, $text)
	{
		$get_array = explode('/', $date);
		$day = $get_array[0];
		$month = $get_array[1];
		$year = $get_array[2];
		$time_Stamp = mktime(0,0,0,$day,$month,$year);
		/*end*/
		
		$finaldate = date("Y-m-d", strtotime("$year-$month-$day"));
		/*code to change to timestamp for future use*/
		
		$session = ORM::factory('Session');
		
		$session->event = $conf_id;
		$session->date = $finaldate;
		$session->title = $text;
		$session->created_by = $user_id;
		
		$session->save();

		$session_id = $session->pk();
		
	}
	
	public function create_room($user_id, $session_id, $roomname)
	{
		$room = ORM::factory('Room');
		
		$room->room_name = $roomname;
		$room->conference_session = $session_id;
		$room->created_by = $user_id;
		
		$room->save();

		$room_id = $room->pk();
	}
	
	public function create_time($user_id, $session_id, $start_time, $end_time)
	{
		$session_data = new Service_Schedule();
		$session_result = $session_data->get_session_list($session_id);
		
		$session_date = strtotime($session_result->get('date'));
		$session_value1 = date('Y-m-d',$session_date)." ".$start_time;
		$session_value2 = date('Y-m-d',$session_date)." ".$end_time;
		
		$start_unix_timestamp = strtotime($session_value1);
		$end_unix_timestamp = strtotime($session_value2);
		
		$time = ORM::factory('Time');
		
		$time->conference_session = $session_id;
		$time->start_time = $start_unix_timestamp;
		$time->end_time = $end_unix_timestamp;
		$time->created_by = $user_id;
		
		$time->save();

		$time_id = $time->pk();
		
		
		//echo $start_unix_timestamp."=".$start_time."<br />";
		//echo date('Y-m-d h:i A',$start_unix_timestamp);
	}
	
	public function create_presentation($user_id, $session_id, $time_table, $end_time_table, $presentation_room, $presentation_slot, $presentation_name)
	{
		$presentation = ORM::factory('ConfPresentation');
		$presentation->title = $presentation_name;
		$presentation->save();

		$presentation_id = $presentation->pk();
		
		$time_slot = ORM::factory('Timeslot');
		
		$time_slot->time_table = $time_table;
		$time_slot->conference_room = $presentation_room;
		$time_slot->presentation = $presentation_id;
		$time_slot->created_by = $user_id;
		
		if($presentation_slot == 3){
			
			$slot_span = 1;
			
			$time_slot->slot_span = $slot_span;
			$time_slot->end_time_table = $end_time_table;
			$time_slot->slot_type = $presentation_slot;
		}
		else {
			$time_slot->slot_type = $presentation_slot;	
		}
		
		$time_slot->save();

		$time_slot_id = $time_slot->pk();
	}
}