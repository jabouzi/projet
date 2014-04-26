<?php

class User {

	private $email;
	private $first_name;
	private $last_name;
	private $user_name;
	private $password;
	private $is_admin;

	function __construct()
	{

	}

	public function set_email($email)
	{
		$this->email = $email;
	}

	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
	}

	public function set_last_name($last_name)
	{
		$this->last_name = $last_name;
	}
    
	public function set_user_name($user_name)
	{
		$this->user_name = $user_name;
	}

	public function set_password($password)
	{
		$this->password = $password;
	}
	
	public function set_admin($admin = 0)
	{
		$this->is_admin = $admin;
	}

	public function get_email()
	{
		return $this->email;
	}

	public function get_first_name()
	{
		return $this->first_name;
	}

	public function get_last_name()
	{
		return $this->last_name;
	}
    
	public function get_user_name()
	{
		return $this->user_name;
	}

	public function get_password()
	{
		return $this->password;
	}
	
	public function get_admin()
	{
		return $this->is_admin;
	}
}
