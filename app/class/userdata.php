<?php

class Userdata extends User {
	
	private user_group;
	private user_vhosts = array();
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function set_user_name($user_name)
	{
		parent::set_user_name($user_name);
	}
	
	public function get_user_name()
	{
		return parent::get_user_name();
	}
	
	public function set_user_password($user_password)
	{
		parent::set_password($user_password);
	}

	public function get_user_password()
	{
		return parent::get_password();
	}
	
	public function set_user_group($user_group = '')
	{
		$this->user_group = $user_group;
	}

	public function get_user_group()
	{
		return $this->user_group;
	}
	
	public function set_user_vhosts($user_vhosts)
	{
		$this->user_vhosts = $user_vhosts;
	}

	public function get_user_vhosts()
	{
		return $this->user_vhosts;
	}
}
