<?php

class Application extends Controller
{
	private $usermodel;

	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->usermodel = new usermodel();
	}

	public function index($message = null)
	{
		//menu decorator
		$users = new useriterator($this->usermodel->get_users());
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		if ($users)
		{
			$data['users'] = $users;
			view::load_view('default/accounts/userslist', $data);
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
		view::load_view('default/accounts/add');
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function edit($user_name)
	{
		$user = $this->usermodel->get_user($user_name);
		$data['user'] = $user;
		$_SESSION['edit']['user_name'] = $user->get_user_name();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/accounts/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function delete()
	{
		if ($_SESSION['edit']['user_name'] != $_POST['user_name'])
		{
			$_SESSION['message'] = 'account.security.detected';
			redirect('application/edit/'.$_SESSION['edit']['user_name']);
		}
		$this->usermodel->delete_user($_POST['user_name']);
		$_SESSION['message'] = 'account.user_delete';
		redirect('/');
	}

	public function processadd()
	{
		if ($this->usermodel->user_email_exists($_POST['user_email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'account.email.exists';
			redirect('application/add');
		}
		else if ($this->usermodel->user_name_exists($_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'account.user_name.exists';
			redirect('application/add');
		}
		else
		{
			$this->usermodel->add_user($_POST);
			$_SESSION['message'] = 'account.user_added';
			redirect('/');
		}
	}

	public function processedit()
	{
		if ($_SESSION['edit']['user_name'] != $_POST['user_name'])
		{
			$_SESSION['message'] = 'account.security.detected';
			redirect('application/edit/'.$_SESSION['edit']['user_name']);
		}
		else if ($this->usermodel->user_email_exists($_POST['user_email'], $_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = 'account.email.exists';
			redirect('application/edit/'.$_POST['user_name']);
		}
		else
		{
			$this->usermodel->update_user($_POST);
			$_SESSION['message'] = 'account.user_updated';
			redirect('application/edit/'.$_POST['user_name']);
		}
	}

	public function import()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/accounts/import');
		view::load_view('default/standard/footer');
	}

	public function processimport()
	{
		$path = $_FILES['accountsfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		if ($_FILES["accountsfile"]["error"] != UPLOAD_ERR_OK)
		{
			$_SESSION['message'] = 'account.error.fileupload';
			redirect('application/import');
		}
		else if (!in_array($ext, array('csv', 'xml', 'json', 'xls', 'xlsx')))
		{
			$_SESSION['message'] = 'account.wrong.filetype';
			redirect('application/import');
		}
		else
		{
			var_dump($_POST, $_FILES);
			$tmp_name = $_FILES["accountsfile"]["tmp_name"];
			$name = $_FILES["accountsfile"]["name"];
			move_uploaded_file($tmp_name, "/tmp/$name");
		}
	}
}
