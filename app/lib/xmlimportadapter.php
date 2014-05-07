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
			$users[$index] = (array)$usr_info;
			$users[$index]['user_vhost'] = explode(',', $users[$index]['user_vhost']);
			$index++;
		}
		var_dump($users);exit;
		$this->userimport = new userimport();
		$this->userimport->import($users);

	}
}
