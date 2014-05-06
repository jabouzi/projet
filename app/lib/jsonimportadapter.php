<?php

class Jsonimportadapter
{
	private $userimport;
	
	function __construct($json)
	{
		$test = array(array('user_name' => 'skander'), array('user_name' => 'jabouzi'));
		var_dump(json_encode($test));
		var_dump($json);
		$users = json_decode($json);
		var_dump($users);
	}
}
