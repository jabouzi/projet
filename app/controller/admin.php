<?php

class Admin extends Controller
{
	private $admin_model;

	function __construct()
	{
		if (!islogged()) redirect('login');
		if (!isadmin()) redirect('/');
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
	
	public function profile()
	{
		$user = $this->admin_model->get_user($_SESSION['user']['email']);
		$data['user'] = $user;
		$_SESSION['edit']['id'] = $user->get_id();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/profile', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function add()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/add');
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function edit($id)
	{
		$user = $this->admin_model->get_user($this->admin_model->get_email_by_id($id));
		$data['user'] = $user;
		$_SESSION['edit']['id'] = $user->get_id();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function delete()
	{
		if ($_SESSION['edit']['id'] != $_POST['id'])
		{
			$_SESSION['message'] = 'account.security.detected';
			redirect('admins/edit/'.$_SESSION['edit']['email']);
		}
		$this->admin_model->delete_user($_POST['email']);
		$_SESSION['message'] = 'admin.user_delete';
		redirect('admin');
	}

	public function processadd()
	{
		if ($this->admin_model->email_exists($_POST['email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'admin.email.exists';
			redirect('admin/add');
		}
		else
		{
			$this->admin_model->add_user($_POST);
			$_SESSION['message'] = 'admin.user_added';
			redirect('admin');
		}
	}

	public function processedit()
	{
		if ($_SESSION['edit']['id'] != $_POST['id'])
		{
			$_SESSION['message'] = 'account.security.detected';
			redirect('admins/edit/'.$_SESSION['edit']['id']);
		}
		else if ($this->admin_model->email_exists($_POST['email'], $_POST['id']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'admin.email.exists';
			redirect('admin/edit/'.$_POST['id']);
		}
		else
		{
			$this->admin_model->update_user($_POST);
			$_SESSION['message'] = 'admin.user_updated';
			redirect('admin/edit/'.$_POST['id']);
		}
	}
	
	public function processprofile()
	{
		var_dump($_POST);
		if ($_SESSION['edit']['id'] != $_POST['id'])
		{
			$_SESSION['message'] = 'account.security.detected';
			redirect('admin/profile');
		}
		else if ($this->admin_model->email_exists($_POST['email'], $_POST['id']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'admin.email.exists';
			redirect('admin/profile');
		}
		else
		{
			$_POST['admin'] = $_SESSION['user']['admin'];
			$_POST['status'] = $_SESSION['user']['status'];
			$this->admin_model->update_user($_POST);
			$_SESSION['message'] = 'admin.user_updated';
			redirect('admin/profile');
		}
	}
}
