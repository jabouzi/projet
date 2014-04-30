<?php

class Application extends Controller
{
	private $user;
	private $userdao;
	private $admin;
	private $admindao;

	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->user = new useradmin();
		$this->userdao = new useradmindao();
	}

	public function index($message = null)
	{
		$users = $this->user->select_all();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		if ($users)
		{
			$data['users'] = $users
			view::load_view('default/contatcs/browse', $data);
		}
		else
		{
			view::load_view('default/index/welcome');
		}
		view::load_view('default/standard/footer');
	}
}
