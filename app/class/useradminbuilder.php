<?php

class Useradminbuilder
{
	protected $user = NULL;
	protected $user_data = array();

	public function __construct($user_data)
	{
		$this->user_data = $user_data;
	}

	public function build()
	{
		$this->user = new Useradmin();
		$this->user->set_id($this->user_data['id']);
		$this->user->set_email($this->user_data['email']);
		$this->user->set_first_name($this->user_data['first_name']);
		$this->user->set_last_name($this->user_data['last_name']);
		$this->user->set_password($this->user_data['password']);
		$this->user->set_admin($this->user_data['admin']);
		$this->user->set_status($this->user_data['status']);
	}

	public function getUser()
	{
		return $this->user;
	}
}
