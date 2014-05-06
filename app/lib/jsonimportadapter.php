<?php

class Jsonimportadapter
{
	private $userimport;
	
	function __construct($json)
	{
		$users = json_decode($json, true);
		var_dump($users);
	}
}
