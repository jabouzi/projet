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
		while (($data = str_getcsv($csv, ";")) !== FALSE) {
			$data['user_vhost'] = explode(',', $data['user_vhost']);
			$users[] = $data;
		}
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
