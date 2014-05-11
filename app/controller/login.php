<?php

class Login extends Controller
{
	private $user;
	private $adminmodel;

	function __construct()
	{
		$this->user = new useradmin();
		$this->adminmodel = new adminmodel();
	}

	public function index()
	{
		$data['email'] = get_item($_POST, 'email');
		$data['password'] = get_item($_POST, 'password');
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/login/form', $data);
		view::load_view('default/standard/footer');
	}

	public function process()
	{
		if (isempty($_POST['email'])) 
		{
			$_SESSION['message'] = lang('login.email.empty');
			redirect('login');
		}
		else if (isempty($_POST['password']))
		{
			$_SESSION['message'] = lang('login.password.empty');
			redirect('login');
		}
		else
		{
			$this->check_login($_POST['email'], $_POST['password']);
		}
	}

	public function logout()
	{
		foreach($_SESSION as $key => $value) unset($_SESSION[$key]);
		redirect('login');
	}

	private function check_login($email, $password)
	{
		$this->user = $this->adminmodel->get_user($email);
		if (!$this->user)
		{
			$_SESSION['message'] = lang('login.failed');
			redirect('login');
		}
		else if (!$this->user->get_status())
		{
			$_SESSION['message'] = lang('login.account.nonactive');
			redirect('login');
		}
		else if ($this->user->get_password() != $password)
		{
			$_SESSION['message'] = lang('login.failed');
			redirect('login');
		}
		else 
		{
			$_SESSION['user']['first_name'] = $this->user->get_first_name();
			$_SESSION['user']['last_name'] = $this->user->get_last_name();
			$_SESSION['user']['email'] = $this->user->get_email();
			$_SESSION['user']['admin'] = $this->user->get_admin();
			$_SESSION['user']['status'] = $this->user->get_status();
			$_SESSION['user']['id'] = $this->user->get_id();
			redirect('application');
		}
	}
}
