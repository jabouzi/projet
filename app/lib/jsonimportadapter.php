<?php

class Jsonimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($file)
	{
		$json = file_get_contents($file);
		$users = json_decode($json, true);
		$this->userimport = new userimport();
		$errors = $this->userimport->import($users);
		$_SESSION['message'] = $this->userimport->get_message();
		if (!$errors) return $users;
		return false;
	}
}
