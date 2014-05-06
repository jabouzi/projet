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
		$index = 0;
		$alldata = str_getcsv($csv, "\n");
		foreach($alldata as &$data)
		{
			if ($index)
			{
				$data = str_getcsv($data, ";");
				$users['user_vhost'] = explode(',', $data[5]);
				foreach($params as $key => $value)
				{
					$users[$index][$value] = $data[$key];
				}
			}
			$index++;
		}
		var_dump($users);
		exit;
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
