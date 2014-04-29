<?php

class Application extends Controller
{
	private $user;
	private $userdao;
	private $admin;
	private $admindao;

	function __construct()
	{
		var_dump($_SESSION);
		//$this->user = new useradmin();
		//$this->userdao = new useradmindao();
	}

	public function index($message = null)
	{
		if (!is_logged()) redirect(login);
		view::load_view('default/standard/header');
		view::load_view('default/index/welcome');
		view::load_view('default/standard/footer');
	}
}
