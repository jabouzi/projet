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
		echo 'process';
	}
	
	public function logout()
	{
		unset($_SESSION['user_session']);
		
	}
}
