<?php

class Application extends Controller
{
	private $usermodel;
	private $mailerdecorator;
	const EDIT = 1;
	const ADD = 0;

	function __construct()
	{
		if (!islogged()) redirect('login');
		$this->usermodel = new usermodel();
		$this->mailerdecorator = new mailerdecorator();
	}

	public function index($message = null)
	{
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
		$_SESSION['user_edit'] = $user->__toArray();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/accounts/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function delete()
	{
		if ($_SESSION['user_edit']['user_name'] != $_POST['user_name'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('application/edit/'.$_SESSION['user_edit']['user_name']);
		}
		$this->usermodel->delete_user($_POST['user_name']);
		$_SESSION['message'] = lang('account.user.delete');
		redirect('/');
	}

	public function processadd()
	{
		if ($this->usermodel->user_email_exists($_POST['user_email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('application/add');
		}
		else if ($this->usermodel->user_name_exists($_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.user.name.exists');
			redirect('application/add');
		}
		else
		{
			$this->usermodel->add_user($_POST);
			$this->sendemail($_POST, self::ADD);
			$_SESSION['message'] = lang('account.user.added');
			redirect('/');
		}
	}

	public function processedit()
	{
		if ($_SESSION['user_edit']['user_name'] != $_POST['user_name'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('application/edit/'.$_SESSION['user_edit']['user_name']);
		}
		else if ($this->usermodel->user_email_exists($_POST['user_email'], $_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('application/edit/'.$_POST['user_name']);
		}
		else
		{
			if (count(compare_user_data($_POST, $_SESSION['user_edit'])))
			{
				$this->usermodel->update_user($_POST);
				$user = $this->usermodel->get_user($_POST['user_name'])->__toArray();
				$this->sendemail($user, self::EDIT);
				$_SESSION['message'] = lang('account.user.updated');
			}
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
			$_SESSION['message'] = lang('account.error.fileupload');
			redirect('application/import');
		}
		else if (!in_array($ext, array('csv', 'xml', 'json', 'xls', 'xlsx')))
		{
			$_SESSION['message'] = lang('account.wrong.filetype');
			redirect('application/import');
		}
		else
		{
			$tmp_name = $_FILES["accountsfile"]["tmp_name"];
			$name = $_FILES["accountsfile"]["name"];
			move_uploaded_file($tmp_name, "/tmp/$name");
			$import = Userimportfactory::create($ext);
			$users = $import->import("/tmp/$name");
			if (count($users))
			{
				foreach($users as $user)
				{
					$this->sendemail($user, self::ADD);
				}
			}
			redirect('application');
		}
	}

	private function sendemail($user, $edit = 0)
	{
		$text = array(APPPATH.'public/docs/useremail.txt', APPPATH.'public/docs/useremail2.txt');
		$this->mailerdecorator->decorateuser($user, file_get_contents($text[$edit]));
		$this->mailerdecorator->sendusermail($user);
	}
}
