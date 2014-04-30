<?php

class User {

	private $first_name;
	private $last_name;
	private $email;
	private $password;

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
    
	public function set_password($password)
	{
		$this->password = $password;
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

	public function get_password()
	{
		return $this->password;
	}
}
