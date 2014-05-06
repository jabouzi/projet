<?php

class Jsonimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($json)
	{
		$users = json_decode($json, true);
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
