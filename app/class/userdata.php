<?php

class Userdata extends User {

	private $user_name;
	private $user_group;
	private $user_vhost = array();

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

	public function set_user_vhost($user_vhost)
	{
		$this->user_vhost = $user_vhost;
	}

	public function get_user_name()
	{
		return $this->user_name;
	}

	public function get_user_password()
	{
		return parent::get_password();
	}

	public function get_user_vhost()
	{
		return $this->user_vhost;
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

	public function __toString()
	{
		$str = ' user_name : ' . $this->get_user_name();
		$str .= ' user_email : ' . $this->get_user_email();
		$str .= ' user_password : ' . $this->get_user_password();
		$str .= ' user_first_name : ' . $this->get_user_first_name();
		$str .= ' user_last_name : ' . $this->get_user_last_name();
		$str .= ' user_group : ' . $this->get_user_group();
		$str .= ' user_vhost : ' . $this->get_user_vhost();
		return $str;
	}

	public function __toArray()
	{
		return array(
			'user_name' => $this->get_user_name(),
			'user_email' => $this->get_user_email(),
			'user_password' => $this->get_user_password(),
			'user_first_name' => $this->get_user_first_name(),
			'user_last_name' => $this->get_user_last_name(),
			'user_group' => $this->get_user_group(),
			'user_vhost' => $this->get_user_vhost(),
		);
	}
}
