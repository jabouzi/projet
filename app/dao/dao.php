<?php

class Dao {
	
	private $db;
	
	function __construct()
	{
		$this->db = Database::getInstance();
	}
	
	//public function select
}
