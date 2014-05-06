<?php

class Jsonimportadapter
{
	private $userimport;
	private $users;

	function __construct($json)
	{
		$this->users = json_decode($json, true);
	}

	function import()
	{
		$this->userimport = new userimport($this->users);
		$this->userimport->import();
	}
}
