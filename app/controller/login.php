<?php

class Login extends Controller
{
	private $user;
	private $userdao;
	private $encrypt;

	function __construct()
	{
		$this->user = new useradmin();
		$this->userdao = new useradmindao();
		$this->encrypt = new encryption();
	}

	public function index($message = null)
	{
		if (is_array($message)) $data = $message;
		else $data['message'] = $message;
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/login/form', $data);
		view::load_view('default/standard/footer');
	}

	public function process()
	{
		if (isempty($_POST['email'])) 
		{
			$_SESSION['message'] = 'login.email.empty';
			redirect('login');
		}
		else if (isempty($_POST['password']))
		{
			$_SESSION['message'] = 'login.password.empty';
			redirect('login');
		}
		else
		{
			$this->check_login($_POST['email'], $_POST['password']);
		}
	}

	public function logout()
	{
		unset($_SESSION['user_session']);
		redirect('login');
	}

	private function check_login($email, $password)
	{
		$this->user = $this->userdao->select_user($email);
		if (!$this->user) $this->index('login.failed');
		else if (!$this->user->get_status()) $this->index(array('message' => 'login.account.nonactive', 'email' => $email, 'password' => $password));
		else if ($this->encrypt->decrypt($this->user->get_password()) != $password) $this->index(array('message' => 'login.failed', 'email' => $email, 'password' => $password));
		else {
			unset($_SESSION['user']);
			$_SESSION['user']['first_name'] = $this->user->get_first_name();
			$_SESSION['user']['last_name'] = $this->user->get_last_name();
			$_SESSION['user']['email'] = $this->user->get_email();
			$_SESSION['user']['admin'] = $this->user->get_admin();
			redirect('application');
		}
	}
}
