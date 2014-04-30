<?php

class Useradmin extends User {

	private $email;
	private $first_name;
	private $last_name;
	private $admin;
	private $status;

	function __construct()
	{

	}

	public function set_email($email)
	{
		parent::set_email($email);
	}

	public function set_first_name($first_name)
	{
		parent::set_first_name($first_name);
	}

	public function set_last_name($last_name)
	{
		parent::set_last_name($last_name);
	}

	public function set_password($password)
	{
		parent::set_password($password);
	}
	
	public function set_admin($admin = 0)
	{
		$this->admin = $admin;
	}
	
	public function set_status($status = 1)
	{
		$this->status = $status;
	}

	public function get_email()
	{
		return parent::get_email();
	}

	public function get_first_name()
	{
		return parent::get_first_name();
	}

	public function get_last_name()
	{
		return parent::get_last_name();
	}

	public function get_password()
	{
		return parent::get_password();
	}
	
	public function get_admin()
	{
		return $this->admin;
	}

	public function get_status()
	{
		return $this->status;
	}
}
