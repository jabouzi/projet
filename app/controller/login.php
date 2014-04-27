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
		view::load_view('default/standard/header');
		view::load_view('default/login/form');
		view::load_view('default/standard/footer');
    }
    
    public function process()
    {
		$this->user = $this->userdao->select_user($_POST['email']);
		if ($this->encrypt->decrypt($this->user->get_password()) == $_POST['password']) $this->index('login.failed');
		else if (!$this->user->get_status()) $this->index('account.nonactive');
		else redirect();
	}
	
	public function logout()
	{
		unset($_SESSION['user_session']);
		redirect('login');
	}
}
