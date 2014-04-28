<?php defined('SYSPATH') or die('No direct script access.');

class Service_Message {

	public function get_conversation_id($user_id, $receiver_id)
	{
		/*$msgs = ORM::factory('Subscriber')
			->where_open()
			->where('user', '=', $user_id)
			->or_where('user', '=', $receiver_id)
			->where_close()
			->where_open()
			->where('conversation', '=', $user_id)
			->or_where('conversation', '=', $receiver_id)
			->where_close()
			->find_all();*/
		
		$msgs = ORM::factory('Subscriber')
			->join('pm_conversation')
			->on('subscriber.conversation','=','pm_conversation.id')
			->where('pm_conversation.owner_id', '=', $user_id)
			->find_all();
		
		if (count($msgs)>0) {	     
			return $msgs;
		}
	}
	
	public function get_all_conversation($user_id)
	{
		$msgs = ORM::factory('Subscriber')
			->where('user', '=', $user_id)
			->find_all();
			
		return $msgs;
	}
	
	public function get_all_messages($conversation_id, $userid)
	{
		$find_msgs = DB::select('pm_message.message','pm_message.sender','pm_message.created_date','pm_conversation_subscriber.user','pm_conversation_subscriber.read_status','pm_message.conversation')
			->from('pm_message')
			->join('pm_conversation_subscriber')
			->on('pm_message.conversation','=','pm_conversation_subscriber.conversation')
			->where('pm_message.conversation','=',DB::expr($conversation_id))
			->where('pm_conversation_subscriber.user','=',DB::expr($userid))
			->order_by('pm_message.created_date', 'desc')->limit(1);
		
		
		//$query = DB::select('message','sender','created_date')->from('pm_message')->where('conversation', '=', $conversation_id)->order_by('created_date', 'desc limit 1');
		
		return $find_msgs->execute();
	}
	
	public function get_user_messages($user_id, $conv_id)
	{
		$find_msgs = DB::select('pm_message.message','pm_message.sender','pm_message.created_date','pm_conversation_subscriber.user','pm_conversation_subscriber.read_status','pm_message.conversation')
			->from('pm_message')
			->join('pm_conversation_subscriber')
			->on('pm_message.conversation','=','pm_conversation_subscriber.conversation')
			->where('pm_message.conversation','=',DB::expr($conv_id))
			->where('pm_conversation_subscriber.user','<>',DB::expr($user_id))
			->order_by('pm_message.created_date', 'asc');
			
		return $find_msgs->execute();	
	}
	
	public function update_user_status($user_id, $conv_id)
	{
		$msgs = DB::update('pm_conversation_subscriber')
					->set(array(
						'read_status' => 1,
					))
			->where('user', '=', $user_id)
			->where('conversation', '=', $conv_id)
			->order_by('created_date', 'desc')->limit(1);
			
		
		$msgs->execute();
	}
	
	public function update_user_status_new($receiver_id, $conversationid)
	{
		$msgs = DB::update('pm_conversation_subscriber')
					->set(array(
						'read_status' => 0,
					))
			->where('user', '<>', $receiver_id)
			->where('conversation', '=', $conversationid)
			->order_by('created_date', 'desc')->limit(1);
			
		
		$msgs->execute();
	}
	
	public function get_user_final_id($userid, $convid)
	{
		$finalid = DB::select('user')
			->from('pm_conversation_subscriber')
			->where('user', '<>', $userid)
			->where('conversation', '=', $convid);
			
		return $finalid->execute();
	}

	public function find_user_conversation($user_id, $conversationid)
	{
		$msgs = DB::select('read_status')
			->from('pm_conversation_subscriber')
			->where('user', '<>', $user_id)
			->where('conversation', '=', $conversationid);
			
		return $msgs->execute();
	}
	
	public function find_friend_conversation($user_id, $conversationid)
	{
		$msgs = DB::select('read_status')
			->from('pm_conversation_subscriber')
			->where('user', '=', $user_id)
			->where('conversation', '=', $conversationid);
			
		return $msgs->execute();
	}
	
	public function find_last_user_msg($conv_ids)
	{
		$msgs = DB::select('sender')
			->from('pm_message')
			->where('conversation', '=', $conv_ids)
			->order_by('created_date', 'desc')->limit(1);
			
		return $msgs->execute();
	}
}
