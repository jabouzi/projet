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
		$row = 1;
		while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {
			$data['user_vhost'] = explde(',', $data['user_vhost']);
			$users[] = $data;
		}
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
