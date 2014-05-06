<?php

class Jsonimportadapter
{
	private $userimport;
	private $users;

	function __construct($json)
	{
		//$test = array(
			//array('user_name' => 'skander', 'user_vhosts' => array(1,2,3)),
			//array('user_name' => 'skander', 'user_vhosts' => array(1,2,3))		
		//);
		//var_dump(json_encode($test));
		$this->users = json_decode($json, true);
		var_dump($this->users);
	}

	public function import()
	{
		$this->userimport = new userimport();
		$this->userimport->import($this->users);
	}
}
