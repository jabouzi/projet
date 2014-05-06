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
		if (($handle = fopen($csv, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$data['user_vhost'] = explde(',', $data['user_vhost']);
				$users[] = $data;
			}
			fclose($handle);
		}
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
