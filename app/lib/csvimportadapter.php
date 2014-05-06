<?php

class Csvimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($csv)
	{
		$users = array();
		$params = array('user_name', 'user_password', 'user_first_name', 'user_last_name', 'user_email');
		$row = 0;
		while (($data = str_getcsv($csv, ";")) !== FALSE) {
			//$users['user_vhost'] = explode(',', $data[5]);
			//foreach($params as $key => $value)
			//{
				//$users[$row][$value] = $data[$key];
			//}
			var_dump($data);
			$row++;
		}
		exit;
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
