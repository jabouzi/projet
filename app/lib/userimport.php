<?php

class Userimport
{
	private $usemodel;
	private $message;

	function __construct()
	{
		$this->usermodel = new usermodel();
	}

	public function import($usersdata)
	{
		$this->set_message('');
		foreach($usersdata as $key => $userdata)
		{
			$this->insert($userdata, $key);
		}
	}

	public function insert($userdata, $key)
	{
		$params = array('user_name', 'user_password', 'user_first_name', 'user_last_name', 'user_email');
		$errors_count = 0;
		foreach ($params as $param)
		{
			$errors_count += $this->checkitem($userdata, $param, $key);
		}

		if (!item($userdata, 'user_vhost') || !is_array($userdata['user_vhost']))
		{
			$errors_count++;
			$this->set_message('user :'.$userdata['user_name'].' account.user_vhosts.empty<br />');
		}
		if ($this->usermodel->user_name_exists($userdata['user_name']))
		{
			$errors_count++;
			$this->set_message('user :'.$userdata['user_name'].' account.username.exists<br />');
		}
		if ($this->usermodel->user_email_exists($userdata['user_email']))
		{
			$errors_count++;
			$this->set_message('user :'.$userdata['user_email'].' account.email.exists<br />');
		}

		if (!$errors_count)
		{
			$this->set_message('user :'.$userdata['user_name'].' added<br />');
			$this->usermodel->add_user($userdata);
		}
	}
	
	public function set_message($message)
	{
		$this->message .= $message;
	}
	
	public function get_message()
	{
		return $this->message;
	}

	private function checkitem($userdata, $param, $key)
	{
		if (item($userdata, $param) && !isempty($userdata[$param]))	return 0;
		$this->set_message('user with '.$param.' account.'.$param.'.empty<br />');
		return 1;
	}
}
