<?php

class phplog
{
	private static $instance;
	private $logText;
	private $db;

	function __construct()
	{
		$this->logText = array();
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

	public function add($text)
	{
		$this->logText[] = $text;
	}

	public function getLog()
	{
		return $this->logText;
	}

	function save()
	{
		$args = array(':user' => print_r($_SESSION['user'], true), ':data' => print_r($this->getLog(), true));
		$query = "INSERT INTO log (id, user, data) VALUES('', :user, :data)";
		$insert = $this->db->query($query, $args);
		$this->clean();
	}

	public function clean()
	{
		$this->logText = array();
	}
}
