<?php

class Phplog
{
	private static $instance;
	private $db;

	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public static function getInstance()
	{
		if(empty(self::$instance)){
			try{
				self::$instance = new phpLog();
			} catch (Exception $e) {
				echo 'Log creation failed : ' . $e->getMessage();
			}
		}
		return self::$instance;
	}

	function save($logAction, $logText)
	{
		$args = array(':user' => print_r($_SESSION['user'], true), ':action' => $logAction, ':data' => print_r($logText, true));
		$query = "INSERT INTO log (id, user, action, data) VALUES('', :user, :action, :data)";
		$insert = $this->db->query($query, $args);
	}
}
