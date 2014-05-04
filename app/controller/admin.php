<?php

class Admin extends Controller
{
	private $user_model;

	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->admin_model = new Admin_model();
	}

	public function index($message = null)
	{
		//menu decorator
		$users = new useriterator($this->admin_model->get_users());
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		if ($users)
		{
			$data['users'] = $users;
			view::load_view('default/admins/adminslist', $data);
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
		view::load_view('default/admins/add');
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function edit($email)
	{
		$user = $this->admin_model->get_user($admin);
		$data['user'] = $user;
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function delete()
	{
		$this->admin_model->delete_user($_POST['email']);
		$_SESSION['message'] = 'admin.user_delete';
		redirect('/');
	}

	public function processadd()
	{
		if ($this->admin_model->email_exists($_POST['email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'admin.email.exists';
			redirect('application/add');
		}
		else
		{
			$this->admin_model->add_user($_POST);
			$_SESSION['message'] = 'admin.user_added';
			redirect('/');
		}
	}

	public function processedit()
	{
		if ($_POST['email'] == $_POST['old_email'])
		{
			$this->admin_model->update_user($_POST);
			$_SESSION['message'] = 'admin.user_updated';
			redirect('application/edit/'.$_POST['email']);
		}
		else if ($this->admin_model->email_exists($_POST['email'])
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'admin.email.exists';
			redirect('application/edit/'.$_POST['email']);
		}
		else
		{
			$this->admin_model->update_user($_POST);
			$_SESSION['message'] = 'admin.user_updated';
			redirect('application/edit/'.$_POST['email']);
		}
	}
}
