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
		unset($_SESSION);
		redirect('login');
	}

	private function check_login($email, $password)
	{
		$this->user = $this->userdao->select_user($email);
		if (!$this->user)
		{
			$_SESSION['message'] = 'login.failed';
			redirect('login');
		}
		else if (!$this->user->get_status())
		{
			$_SESSION['message'] = 'login.account.nonactive';
			redirect('login');
		}
		else if ($this->encrypt->decrypt($this->user->get_password()) != $password)
		{
			$_SESSION['message'] = 'login.failed';
			redirect('login');
		}
		else 
		{
			$_SESSION['user']['first_name'] = $this->user->get_first_name();
			$_SESSION['user']['last_name'] = $this->user->get_last_name();
			$_SESSION['user']['email'] = $this->user->get_email();
			$_SESSION['user']['admin'] = $this->user->get_admin();
			redirect('application');
		}
	}
}
