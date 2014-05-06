<?php

class Jsonimportadapter
{
	private $userimport;
	
	function __construct($json)
	{
		var_dump($json);
		$users = json_decode($json);
		var_dump($users);
	}
}
