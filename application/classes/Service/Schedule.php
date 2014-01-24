<?php defined('SYSPATH') or die('No direct script access.');

class Service_Schedule {

	public function get_session_list($session_id)
	{
		$Session = ORM::factory('Session')
						->where('id', '=', $session_id)
						->find();
		return $Session;
	}
	
	public function get_session_data($conference_id)
	{
		$Session = ORM::factory('Session')
						->where('event', '=', $conference_id)
						->find_all();
		return $Session;
	}
	
	public function get_room_list($conference_id)
	{
		$rooms = ORM::factory('Room')
			->join('conference_session', 'LEFT')
			->on('room.conference_session', '=', 'conference_session.id')
			->where('conference_session.event', '=', DB::expr($conference_id))
			->find_all();
			     
		return $rooms;
	}
	
	public function get_room_session_list($session_id)
	{
		$rooms = ORM::factory('Room')
			->where('conference_session', '=', $session_id)
			->find_all();
			     
		return $rooms;
	}
	
	public function get_time_session_list($session_id)
	{
		$time = ORM::factory('Time')
			->where('conference_session', '=', $session_id)
			->find_all();
			     
		return $time;
	}
	
	public function get_time_list($conference_id)
	{
		$rooms = ORM::factory('Time')
			->join('conference_session', 'LEFT')
			->on('time.conference_session', '=', 'conference_session.id')
			->where('conference_session.event', '=', DB::expr($conference_id))
			->find_all();
			     
		return $rooms;
	}
	
	public function get_presentation_list($conference_id)
	{
		$presentations = ORM::factory('Timeslot')
			->join('conference_time_table', 'LEFT')
			->on('timeslot.time_table', '=', 'conference_time_table.id')
			->join('conference_session', 'LEFT')
			->on('conference_time_table.conference_session', '=', 'conference_session.id')
			->where('conference_session.event', '=', DB::expr($conference_id))
			->find_all();
			     
		return $presentations;
	}
	
	public function get_time($id)
	{
		$time = ORM::factory('Time')
			->where('id', '=', $id)
			->find();
			     
		return $time;
	}
	
	public function get_room($id)
	{
		$room = ORM::factory('Room')
			->where('id', '=', $id)
			->find();
			     
		return $room;
	}
	
	public function get_presentation($id)
	{
		$room = ORM::factory('ConfPresentation')
			->where('id', '=', $id)
			->find();
			     
		return $room;
	}
	
	public function get_all_session_list($conf_id)
	{
		$query = DB::select('date')->from('conference_session')->where('event', '=', $conf_id)->distinct('date');
		
		return $query->execute();
	}
	
	public function get_all_ids_session($conf_id, $date)
	{
		$query = DB::select('id','date')->from('conference_session')->where('event', '=', $conf_id)->where('date', '=', $date);
		
		return $query->execute();
	}
	
	public function get_all_room_list($session_id)
	{
		$query = DB::select('id','room_name')->from('conference_room')->where('conference_session', '=', $session_id);
		
		return $query->execute();
	}
	
	public function get_all_time_list($session_id)
	{
		$query = DB::select('id','start_time','end_time')->from('conference_time_table')->where('conference_session', '=', $session_id)->order_by('start_time', 'asc')->order_by('end_time', 'desc')->group_by('start_time');
		
		return $query->execute();
	}
	
	public function get_presentation_title_room($roomid)
	{
		$presentations = ORM::factory('ConfPresentation')
			->join('conference_time_slot', 'LEFT')
			->on('presentation.id', '=', 'conference_time_slot.presentation')
			->where('conference_time_slot.presentation', '=', DB::expr($roomid))
			->find_all();
			
		return $presentations;
	}
}