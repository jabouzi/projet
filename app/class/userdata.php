<?php

class Userdata extends User {

	private $user_name;
	private $user_group;
	private $user_vhosts = array();

	function __construct()
	{
		parent::__construct();
	}

	public function set_user_name($user_name)
	{
		$this->user_name = $user_name;
	}

	public function set_user_password($user_password)
	{
		parent::set_password($user_password);
	}

	public function set_user_group($user_group = '')
	{
		$this->user_group = $user_group;
	}

	public function set_user_email($email)
	{
		parent::set_email($email);
	}

	public function set_user_first_name($first_name)
	{
		parent::set_first_name($first_name);
	}

	public function set_user_last_name($last_name)
	{
		parent::set_last_name($last_name);
	}

	public function set_user_vhosts($user_vhosts)
	{
		$this->user_vhosts = $user_vhosts;
	}

	public function get_user_name()
	{
		return $this->user_name;
	}

	public function get_user_password()
	{
		return parent::get_password();
	}

	public function get_user_vhosts()
	{
		return $this->user_vhosts;
	}

	public function get_user_group()
	{
		return $this->user_group;
	}

	public function get_user_email()
	{
		return parent::get_email();
	}

	public function get_user_first_name()
	{
		return parent::get_first_name();
	}

	public function get_user_last_name()
	{
		return parent::get_last_name();
	}
}
