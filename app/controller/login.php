<?php

class Login extends Controller
{
    function __construct()
    {
        $this->user = new User();
    }
    
    public function index()
    {
		view::load_view('header');
		view::load_view('default/login/form');
		view::load_view('footer');
    }
    
    public function process()
    {
		
	}
	
	public function logout()
	{
		
	}
}
