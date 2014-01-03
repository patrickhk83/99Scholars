<?php defined('SYSPATH') or die('No direct script access.');

class Dao_Message {
	
	public function create_message($user_id, $receiver_id, $message)
	{
		/*Insert data into pm_conversation*/
		$conversation = ORM::factory('Conversation');
		
		$conversation->owner = $user_id;
		$conversation->created_date = time();
		
		$conversation->save();

		$conversation_id = $conversation->pk();
		
		/*Insert data into ist pm_conversation_subscription*/
		$conversation_subscriber1 = ORM::factory('Subscriber');
		
		$conversation_subscriber1->conversation = $conversation_id;
		$conversation_subscriber1->user  =$user_id ;
		$conversation_subscriber1->read_status = 1;
		$conversation_subscriber1->created_by = $user_id;
		$conversation_subscriber1->created_date = time();
		$conversation_subscriber1->save();
		
		$conversation_subscriber1_id = $conversation_subscriber1->pk();
		
		/*Insert data into 2nd pm_conversation_subscription*/
		$conversation_subscriber2 = ORM::factory('Subscriber');
		
		$conversation_subscriber2->conversation = $conversation_id;
		$conversation_subscriber2->user  =$receiver_id ;
		$conversation_subscriber2->read_status = 0;
		$conversation_subscriber2->created_by = $user_id;
		$conversation_subscriber2->created_date = time();
		$conversation_subscriber2->save();
		
		$conversation_subscriber2_id = $conversation_subscriber2->pk();
		

		/*insert into pm_message*/
		$Message = ORM::factory('Message');
		
		$Message->conversation = $conversation_id;
		$Message->message = $message;
		$Message->sender = $user_id;
		$Message->created_by = $user_id;
		$Message->created_date = time();
		
		$Message->save();

		$Message_id = $Message->pk();
		
	}
	
	public function update_message1($conversation_id, $receiver_id)
	{
		$query = DB::update('pm_conversation_subscriber')
					->set(array(
						'read_status' => 0,
					))
					->where('conversation', '=', $conversation_id)
					->where('user', '=', $receiver_id);

		$query->execute();
	}
	
	public function new_message($conversation_id, $user_id, $message)
	{
		$Message = ORM::factory('Message');
		
		$Message->conversation = $conversation_id;
		$Message->message = $message;
		$Message->sender = $user_id;
		$Message->created_by = $user_id;
		$Message->created_date = time();
		
		$Message->save();

		$Message_id = $Message->pk();
	}
	
	public function insert_new_user($conversation_id, $user_id, $receiver_id)
	{
		$conversation_subscriber = ORM::factory('Subscriber');
		
		$conversation_subscriber->conversation = $conversation_id;
		$conversation_subscriber->user  = $receiver_id;
		$conversation_subscriber->read_status = 0;
		$conversation_subscriber->created_by = $user_id;
		$conversation_subscriber->created_date = time();
		$conversation_subscriber->save();
		
		$conversation_subscriber_id = $conversation_subscriber->pk();
	}
}