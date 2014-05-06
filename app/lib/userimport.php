<?php

class Userimport
{
	private $usemodel;

	function __construct()
	{
		$this->usermodel = new usermodel();
	}

	public function import($usersdata)
	{
		$_SESSION['message'] = '';
		foreach($usersdata as $key => $userdata)
		{
			$this->insert($userdata, $key);
		}

		redirect('application');
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
			$_SESSION['message'] .= 'user #'.($key+1).' account.user_vhosts.empty<br />';
		}
		if ($this->usermodel->user_name_exists($userdata['user_name']))
		{
			$errors_count++;
			$_SESSION['message'] .= 'user #'.($key+1).' account.username.exists<br />';
		}
		if ($this->usermodel->user_email_exists($userdata['user_email']))
		{
			$errors_count++;
			$_SESSION['message'] .= 'user #'.($key+1).' account.email.exists<br />';
		}

		//var_dump($errors_count);
		if (!$errors_count)
		{
			'user #'.($key+1).' added<br />';
			$this->usermodel->add_user($userdata);
		}
	}

	private function checkitem($userdata, $param, $key)
	{
		//var_dump($param);
		//var_dump($param, item($userdata, $param));
		//var_dump(isempty($userdata[$param]));
		if (item($userdata, $param) && !isempty($userdata[$param]))	return 0;
		$_SESSION['message'] .= 'user #'.($key+1).' account.'.$param.'.empty<br />';
		return 1;
	}
}
