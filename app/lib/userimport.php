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
		$params = array('user_name', 'user_password', 'user_first_name', 'user_last_name', 'user_email' 'user_vhosts');
		$errors_count = 0;
		foreach ($params as $param)
		{
			$errors_count += $this->checkitem($userdata, $param);
		}

		if ($this->usermodel->user_name_exists($userdata['user_name']))
		{
			$errors_count++;
			$_SESSION['message'] = 'user #'.$key.' account.username.exists<br />';
		}
		if ($this->usermodel->user_email_exists($userdata['user_email']))
		{
			$errors_count++;
			$_SESSION['message'] = 'user #'.$key.' account.email.exists<br />';
		}

		if (!$errors_count)
		{
			 'user #'.$key.' added<br />';
			$this->usermodel->add_user($userdata);
		}
	}

	private function checkitem($userdata, $param)
	{
		if (item($userdata, $param) && !isempty($userdata[$param]))	return 0;
		$_SESSION['message'] = 'user #'.$key.' account.'.$param.'.empty<br />';
		return 1;
	}
}
