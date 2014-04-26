<?php

class User {

	private $user_name;
	private $password;

	function __construct()
	{

	}
    
	public function set_user_name($user_name)
	{
		$this->user_name = $user_name;
	}

	public function set_password($password)
	{
		$this->password = $password;
	}
    
	public function get_user_name()
	{
		return $this->user_name;
	}

	public function get_password()
	{
		return $this->password;
	}

}
