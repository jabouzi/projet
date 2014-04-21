<?php

class Login extends Controller
{
	private $user_mdl;
	
    function __construct()
    {
        $this->user_mdl = new User_model;
    }
    
    public function index()
    {
		view::load_view('default/standard/header');
		view::load_view('default/login/form');
		view::load_view('default/standard/footer');
    }
    
    public function process()
    {
		//$result = $this->mdl_login->validate_user($username, $password);
		//if(!$result)
		//{
			//$this->show('login.failed');
		//}
		//else if(!ord($result->user_active))
		//{
			//$this->show('user.nonactive');
		//}
		//else
		//{
			//modules::run('user/save_session_data', $result);
			//modules::run('user/save_user_activity', $result);
			//$cookie = $this->getcookie();
			//if ($cookie)
			//{
				//$username = $cookie[0];
				//$old_hash = $cookie[1];
				//$this->deletecookie($username, $old_hash);
			//}
			//
			//$remember_me = $this->input->post('remember_me');
			//if ($remember_me)
			//{
				//$hash = generate_random_string(26);
				//$this->setcookie($username, $hash);
			//}
			//redirect('dashboard');
		//}
	}
	
	public function logout()
	{
		unset($_SESSION['user_session']);
		
	}
}
