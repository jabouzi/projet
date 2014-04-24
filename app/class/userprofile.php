<?php

class Userprofile extends User {
	
	private user_password;
	private user_group;
	
	function __construct()
	{
		parent::__construct();
	}

	public function set_user_password($user_password)
	{
		$this->user_password = $user_password;
	}

	public function get_user_password()
	{
		return $this->user_password;
	}
	
	public function set_user_group($user_group = '')
	{
		$this->user_group = $user_group;
	}

	public function get_user_group()
	{
		return $this->user_group;
	}
}
