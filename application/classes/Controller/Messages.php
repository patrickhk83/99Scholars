<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Messages extends Controller {
	
	public $template = 'messages';
		
	const INDEX_PAGE = 'messages/index';
	
	public function action_index() {

		$view = View::factory('messages');
		
		$user_id = Service_Login::get_user_in_session();
		if($user_id){
		
		$userdata = new Service_User();
		$result = $userdata->get_all_users($user_id);
		
		$j = 1;
		foreach ($result as $result1)
		{
			$username[$j]['firstname'] = $result1->get('firstname');
			$username[$j]['lastname'] = $result1->get('lastname');
			$username[$j]['id'] = $result1->get('id');
			$j++;
		}
		
		if(!empty($username)){
			$view->userlist = $username;
		}
		
		$getconversation = new Service_Message();
		$getallconversation = $getconversation->get_all_conversation($user_id);
		
		if(!empty($getallconversation)){
			foreach($getallconversation as $con_result)
			{
				$conversation_id[] = $con_result->get('conversation');
			}
		}
		
		if(!empty($conversation_id))
		{ 
		$i = 0;
	
			foreach($conversation_id as $conv_ids)
			{
				$message = new Service_Message();
				$messagedata = $message->get_all_messages($conv_ids, $user_id);
				
				if(!empty($messagedata))
				{
					//echo $conv_ids."<br />";
					//print_r($messagedata);
					foreach($messagedata as $item)
					{  
						$message_data[$i]['message']= $item['message'];
						//$message_data[$i]['senderid']= $item['sender'];
						$message_data[$i]['created_date']= $item['created_date'];
						//$message_data[$i]['receiverid']= $item['user'];

						$lastmsg = new Service_Message();
						$lastmsgstatus = $lastmsg->find_last_user_msg($conv_ids);
						
						foreach($lastmsgstatus as $sender)
						{
							if($sender['sender'] != $user_id)
							{
								$status = new Service_Message();
								$finalstatus = $status->find_friend_conversation($user_id, $conv_ids);
								
								foreach($finalstatus as $final)
								{
									$message_data[$i]['status']= $final['read_status'];
								}
								$message_data[$i]['user'] = '';
							}
							else{
								$status = new Service_Message();
								$finalstatus = $status->find_user_conversation($user_id, $conv_ids);
								
								foreach($finalstatus as $final)
								{
									$message_data[$i]['status'] = $final['read_status'];
								}
								$newstatus = new Service_Message();
								$finalstatusnew = $newstatus->find_user_conversation($user_id, $conv_ids);
								foreach($finalstatusnew as $finalval)
								{
									if($finalval['read_status'] == 0)
									{
										$message_data[$i]['user'] = 'Yes';
									}else {
										$message_data[$i]['user'] = '';
									}
								}
							}
						}
						$message_data[$i]['conversationid']= $item['conversation'];
						
						$getuser = new Service_User();
						$getname = $getuser->get_by_id($item['sender']);
						
						$message_data[$i]['sendername']= $getname['first_name'].' '.$getname['last_name'];
						
						if($user_id == $item['user'])
						{
							$userinfo = new Service_Message();
							$getuserinfo = $userinfo->get_user_final_id($item['user'], $item['conversation']);
							foreach($getuserinfo as $value1)
							{
								$newid = $value1['user'];
							}
							
						}else {
							$newid = $item['user'];
						}
						
						$getuser2 = new Service_User();
						$getname2 = $getuser2->get_by_id($newid);
						
						$message_data[$i]['receivername']= $getname2['first_name'].' '.$getname2['last_name'];
						$message_data[$i]['receiver_background']= $getname2['background'];
						$message_data[$i]['receiverid']= $item['user'];
						
						$i++;
					}
			
				}
				else
				{
				     $message_data="";
				}
			}
			
			if(!empty($message_data)){
				$view->message_data = $message_data;
			}
			
			//echo "<pre>";
			//print_r($view->message_data);
			//die;
		}
		}
		else
		{
		 $this->redirect('');
		}
		$this->response->body($view);
	}
	
	public function action_insert()
	{
		$receiver_id = $_REQUEST['receiver_id'];
		$message = $_REQUEST['message'];
		$user_id = Service_Login::get_user_in_session();
		
		$checkuser = new Service_Message();
		$checkresult = $checkuser->get_conversation_id($user_id, $receiver_id);
		
		$conversation_id = '';
		if(!empty($checkresult))
		{
			foreach($checkresult as $value)
			{
				$newuser[] = $value->get('user');
				if($value->get('user') == $receiver_id){
					$conversation_id = $value->get('conversation');
				}
			}
		}
		
		if(!empty($newuser))
		{
			if(!in_array($receiver_id, $newuser, true))
			{
				//echo "inside1";
				//echo $user_id."=".$receiver_id."=".$message;
				$receiver_info = new Dao_Message();
				$result = $receiver_info->create_message($user_id, $receiver_id, $message);
			}else
			{
				//echo "inside2";
				$msg_insert = new Dao_Message();
				$resultnew = $msg_insert->new_message($conversation_id, $user_id, $message);
			}
			
		}else {
			$receiver_info = new Dao_Message();
			$result = $receiver_info->create_message($user_id, $receiver_id, $message);
		}
	}
	
	public function action_edit()
	{
		$conv_id = $this->request->param('id');
		
		$view = View::factory('messages-detail');
		$user_id = Service_Login::get_user_in_session();
		
		$update_data = new Service_Message();
		$update_status = $update_data->update_user_status($user_id, $conv_id);
		
		$getdata = new Service_Message();
		$result = $getdata->get_user_messages($user_id, $conv_id);
		
		if(!empty($result)){
			$i = 1;
			foreach($result as $value)
			{
				$msgs[$i]['message'] = $value['message'];
				$msgs[$i]['created_date']= $value['created_date'];

				$msgs[$i]['conversationid']= $value['conversation'];
				
				$getuser = new Service_User();
				$getname = $getuser->get_by_id($value['sender']);
				
				$msgs[$i]['sendername']= $getname['first_name'].' '.$getname['last_name'];
				
				$getuser2 = new Service_User();
				$getname2 = $getuser2->get_by_id($value['user']);
				
				$msgs[$i]['receivername']= $getname2['first_name'].' '.$getname2['last_name'];
				$msgs[$i]['receiver_background']= $getname2['background'];
				
				$i++;
			}
		}
		
		if(!empty($msgs)){
			$view->user_msgs = $msgs;
		}
		
		$this->response->body($view);
		return $view;
	}
	
	public function action_addinsert()
	{
		$receiver_id = $_REQUEST['receiver_id'];
		$message = $_REQUEST['message'];
		$conversationid = $_REQUEST['conversationid'];
		$user_id = Service_Login::get_user_in_session();
		
		
		//echo $receiver_id."=".$message."=".$conversationid;
		//die;
		
		$update_data = new Service_Message();
		$update_status = $update_data->update_user_status_new($user_id, $conversationid);
		
		$create_new = new Dao_Message();
		$create_new_msg = $create_new->new_message($conversationid, $user_id, $message);
	}

	public function action_conversation()
	{
		$conv_id = $this->request->param('id');
		
		$view = View::factory('messages-detail');
		$user_id = Service_Login::get_user_in_session();
		
		$update_data = new Service_Message();
		$update_status = $update_data->update_user_status($user_id, $conv_id);
		
		$getdata = new Service_Message();
		$result = $getdata->get_user_messages($user_id, $conv_id);
		
		if(!empty($result)){
			$i = 1;
			foreach($result as $value)
			{
				$msgs[$i]['message'] = $value['message'];
				$msgs[$i]['created_date']= $value['created_date'];

				$msgs[$i]['conversationid']= $value['conversation'];
				
				$getuser = new Service_User();
				$getname = $getuser->get_by_id($value['sender']);
				
				$msgs[$i]['sendername']= $getname['first_name'].' '.$getname['last_name'];
				
				$getuser2 = new Service_User();
				$getname2 = $getuser2->get_by_id($value['user']);
				
				$msgs[$i]['receivername']= $getname2['first_name'].' '.$getname2['last_name'];
				$msgs[$i]['receiver_background']= $getname2['background'];
				$msgs[$i]['receiver_id']= $value['user'];
				
				$i++;
			}
		}
		
		if(!empty($msgs)){
			$view->user_msgs = $msgs;
		}
		
		$view->id = $conv_id;
		
		$this->response->body($view);
		return $view;
	}
}
