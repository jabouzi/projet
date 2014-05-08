<?php

class Xmlimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($file)
	{
		$racine = simplexml_load_file($file);
		$index = 0;
		foreach ($racine->user_info as $usr_info) 
		{
			if (count((array)$usr_info) == 7)
			{
				$users[$index] = (array)$usr_info;
				$users[$index]['user_vhost'] = explode(',', $users[$index]['user_vhost']);
				$index++;
			}
		}
		$this->userimport = new userimport();
		$users = $this->userimport->import($users);
		$_SESSION['message'] = $this->userimport->get_message();
		return $users;
	}
}
