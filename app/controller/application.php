<?php

class Application extends Controller
{
	private $user_model;

	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->user_model = new User_model();
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
			view::load_view('default/contacts/userslist', $data);
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
		unset($_SESSION['request']);
	}

	public function edit($user_name)
	{
		$user = $this->user_model->get_user($user_name);
		$data['user'] = $user;
		$_SESSION['edit']['user_name'] = $user->get_user_name();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/contacts/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function delete()
	{
		$this->user_model->delete_user($_POST['user_name']);
		$_SESSION['message'] = 'account.user_delete';
		redirect('/');
	}

	public function processadd()
	{
		if ($this->user_model->user_email_exists($_POST['user_email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'account.email.exists';
			redirect('application/add');
		}
		else if ($this->user_model->user_name_exists($_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'account.user_name.exists';
			redirect('application/add');
		}
		else
		{
			$this->user_model->add_user($_POST);
			$_SESSION['message'] = 'account.user_added';
			redirect('/');
		}
	}

	public function processedit()
	{
		if ($_SESSION['edit']['user_name'] != $_POST['user_name'])
		{
			redirect('application/edit/'.$_SESSION['edit']['user_name']);
		}
		else if ($this->user_model->user_email_exists($_POST['user_email'], $_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'account.email.exists';
			redirect('application/edit/'.$_POST['user_name']);
		}
		else
		{
			$this->user_model->update_user($_POST);
			$_SESSION['message'] = 'account.user_updated';
			redirect('application/edit/'.$_POST['user_name']);
		}
	}
}
