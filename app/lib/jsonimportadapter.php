<?php

class Jsonimportadatpter
{
	private $userimport;
	
	function __construct($json)
	{
		$users = json_decode($json);
		var_dump($users);
	}
}
