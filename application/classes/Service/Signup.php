<?php defined('SYSPATH') or die('No direct script access.');

class Service_Signup {

	//TODO: get message from config file
	private $error_message = array(
								'duplicated_user' => 'This email is already registered with our site. Please choose another one.',
								'password_not_matched' => 'Please type the same password'
							);

	public function add_user($first_name, $last_name, $email, $password, $confirm_password)
	{
		$result = array();

		//check for duplicated email
		$user_result = DB::select('id')->from('user')
										->where('email', '=', $email)->execute();

		if($user_result->count() > 0)
		{
			$result['error'] = $this->get_error_message('duplicated_user');
			return $result; 
		}
		
        
       if($password !== $confirm_password)
        {
          	$result['error'] = $this->get_error_message('password_not_matched');
          	return $result;
        }

        $user_service = new Service_User();
        $result = $user_service->create($email, $password, $first_name, $last_name);
      
       return $result;
	}

	protected function get_error_message($key)
	{
		return $this->error_message[$key];
	}
}