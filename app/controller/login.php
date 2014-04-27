<?php

class Login extends Controller
{
	private $user;
	private $userdao;
	private $encrypt;
	
    function __construct()
    {
        //$this->user_mdl = new User_model;
        $this->user = new userprofile();
        $this->userdao = new userprofiledao();
        $this->encrypt = new encryption();
    }
    
    public function index($message = null)
    {
		$data['message'] = $message;
		view::load_view('default/standard/header');
		view::load_view('default/login/form', $data);
		view::load_view('default/standard/footer');
    }
    
    public function process()
    {
		if (isempty($_POST['email'])) $this->index('login.email.empty');
		else if (isempty($_POST['password'])) $this->index('login.password.empty');
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
		if ($this->encrypt->decrypt($this->user->get_password()) == $password) $this->index('login.failed');
		else if (!$this->user->get_status()) $this->index('account.nonactive');
		else redirect();
	}
}
