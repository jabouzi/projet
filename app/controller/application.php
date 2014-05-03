<?php

class Application extends Controller
{
	//private $user;
	//private $userdao;
	private $user_model;


	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->user_model = new User_model();
		//$this->userdao = new useradmindao();
	}

	public function index($message = null)
	{
		//menu decorator
		$users = new useriterator($this->user_model->get_users());
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		if ($users)
		{
			$data['users'] = $users;
			view::load_view('default/contacts/browse', $data);
		}
		else
		{
			view::load_view('default/index/welcome');
		}
		view::load_view('default/standard/footer');
	}

	public function add()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/contacts/add');
		view::load_view('default/standard/footer');
	}

	public function edit($user_name)
	{
		//username no change
		$user = $this->user_model->get_users($user_name);
		$data['user'] = $user;
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/contacts/edit', $data);
		view::load_view('default/standard/footer');
	}
	
	public function delete()
	{
		var_dump($_POST);
	}

	public function processadd()
	{
		var_dump($_POST);
		var_dump($this->user_model->user_email_exists($_POST['email']));
		var_dump($this->user_model->user_name_exists($_POST['user_name']));
	}

	public function processedit()
	{
		var_dump($_POST);
		var_dump($this->user_model->user_email_exists($_POST['email']));
		var_dump($this->user_model->user_name_exists($_POST['user_name']));
		//$_SESSION['message']  = 'TEST MESSAGE';
		//redirect('application/edit/hugo');
	}
}
