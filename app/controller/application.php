<?php

class Application extends Controller
{
	private $user;
	private $userdao;
	private $account;
	private $accountdao;

	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->user = new useradmin();
		$this->userdao = new useradmindao();
		$this->account = new userdata();
		$this->accountdao = new userdatadao();
	}

	public function index($message = null)
	{
		//menu decorator
		$users = $this->accountdao->select_all();
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
		$user = $this->accountdao->select_account($user_name);
		$data['user'] = $user;
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/contacts/edit', $data);
		view::load_view('default/standard/footer');
	}

	public function processadd()
	{

	}

	public function processedit()
	{
		$_SESSION['message']  = 'TEST MESSAGE';
		redirect('application/edit/hugo');
	}
}
