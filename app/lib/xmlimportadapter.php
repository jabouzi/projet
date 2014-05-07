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
		foreach ($racine->user_info as $key => $usr_info) 
		{
			$users[] = (array)$usr_info;
		}
		$this->userimport = new userimport();
		$this->userimport->import($users);

	}
}
