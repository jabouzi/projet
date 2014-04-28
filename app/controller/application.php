<?php

class Application extends Controller
{
	private $user;
	private $userdao;
	private $admin;
	private $admindao;

	function __construct()
	{
		//$this->user = new useradmin();
		//$this->userdao = new useradmindao();
	}

	public function index($message = null)
	{
		var_dump($_SESSION);
		view::load_view('default/standard/header');
		view::load_view('default/index/welcome');
		view::load_view('default/standard/footer');
	}
}
