<?php

class Useradmin extends User {

	private $id;
	private $admin;
	private $status;

	function __construct()
	{

	}

	public function set_id($id)
	{
		$this->id = $id;
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

	public function get_id()
	{
		return $this->id;
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

	public function __toString()
	{
		$str = ' id : ' . $this->get_id();
		$str .= ' email : ' . $this->get_email();
		$str .= ' password : ' . $this->get_password();
		$str .= ' first_name : ' . $this->get_first_name();
		$str .= ' last_name : ' . $this->get_last_name();
		$str .= ' admin : ' . $this->get_admin();
		$str .= ' status : ' . $this->get_status();
		return $str;
	}

	public function __toArray()
	{
		return array(
			'id' => $this->get_id(),
			'email' => $this->get_email(),
			'password' => $this->get_password(),
			'first_name' => $this->get_first_name(),
			'last_name' => $this->get_last_name(),
			'admin' => $this->get_admin(),
			'status' => $this->get_status(),
		);
	}
}
