<?php

class Jsonimportadapter
{
	private $userimport;
	private $users;

	function __construct($json)
	{
		$this->users = json_decode($json, true);
	}

	public function import()
	{
		$this->userimport = new userimport();
		$this->userimport->import($this->users);
	}
}
