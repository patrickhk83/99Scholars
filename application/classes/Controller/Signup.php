<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Signup extends Controller {
    
    public function action_authenticate()
    {
        $kopauth = Kopauth::instance();
        $strategy = $this->request->param('strategy');
        
        // If missing strategy param or their already authenticated just return to start screen
        if (empty($strategy) OR $kopauth->is_authenticated($strategy))
        {
            $this->redirect(URL::site(Route::get('home')->uri()));
        }
        
        // Run opauth
        $kopauth->run();
        
        // If it's a callback handle the response as required.
        if ($kopauth->is_callback())
        {
            $response = $kopauth->get_response();
            
            if (array_key_exists('error', $response))
            {
                // There is an error, set error flash message and direct back to the beginning
                Session::instance()->set('kopauth_error', $response['error']);
            }
            
            // Redirect to start to see authed session or error flash message
            $this->redirect(URL::site(Route::get('home')->uri()));
        }
    }
    
    /**
     * Render view to display all configured providers.
     */
    public function action_providers()
    {
        if (Kohana::$environment === Kohana::PRODUCTION)
        {
            // Do not allow this view in production
            throw HTTP_Exception::factory(404,
                'The requested URL :uri was not found on this server.',
                array(':uri' => $this->request->uri())
            );
        }
        
        $this->response->body(View::factory('providers')->render());
    }
    
    /**
     * Render view to display users session data for an authenticated provider.
     */
    public function action_sessiondata()
    {
        if (Kohana::$environment === Kohana::PRODUCTION)
        {
            // Do not allow this view in production
            throw HTTP_Exception::factory(404,
                'The requested URL :uri was not found on this server.',
                array(':uri' => $this->request->uri())
            );
        }
        
        $strategy = $this->request->param('strategy');
        
        if ( ! Kopauth::instance()->is_authenticated($strategy))
        {
            // Not authenticated for passed provide, redirect to auth
            $auth_route = URL::site(Route::get('signup')->uri(array(
                'action'   => 'authenticate',
                'strategy' => $strategy
            )));
            $this->redirect($auth_route);
        }
        
        // Get the session data
        $data = Kopauth::instance()->get_authenticated($strategy);
        
        // Render with data
        $this->response->body(View::factory('sessiondata')
            ->set('data', $data)
            ->render());
    }
    
    /**
     * Destroy session data for a provider
     */
    public function action_logout()
    {
        Kopauth::instance()->clear_authenticated($this->request->param('strategy'));
        $this->redirect(URL::site(Route::get('home')->uri()));
    }
	public function action_index()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
            $result = $this->add_user($this->request->post());

			if(isset($result['error']))
            {
                $view = View::factory('signup');
                $view->error = $result['error'];
                $this->response->body($view);
            }
            else
            {
                $this->redirect('/profile', 302);
            }
		}
		else
		{
			$view = View::factory('signup');
			$this->response->body($view);
		}
		
	}

	public function action_after_submit()
	{
		if(HTTP_Request::POST == $this->request->method())
		{
			$result = $this->add_user($this->request->post());

            if(isset($result['error']))
            {
                $view = View::factory('signup');
                $view->after_submit = TRUE;
                $view->error = $result['error'];
                $this->response->body($view);
            }
            else
            {
                $session = Session::instance();
                $tmp_conf = $session->get('tmp_conf');

                //add conference
                $conf_service = new Service_Conference();
                $conf_id = $conf_service->create($tmp_conf);

                $session->delete('tmp_conf');

                //redirect to conference page
                $this->redirect('conference/view/'.$conf_id, 302);
            }
		}
        else
        {
            $view = View::factory('signup');

            $view->after_submit = TRUE;
            $this->response->body($view);
        }
	}

    protected function add_user($post_data)
    {
        $signup_service = new Service_Signup();
        $result = $signup_service->add_user($this->request->post('first_name'),
                                            $this->request->post('last_name'),
                                            $this->request->post('email'),
                                            $this->request->post('password'),
                                            $this->request->post('confirm_password'));

        return $result;
    }
}