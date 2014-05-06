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
		$usersdata = str_getcsv($csv, "\n");
		foreach($usersdata as $userdata)
		{
			if (!isempty($userdata))
			{
				if ($index)
				{
					$data = str_getcsv($userdata, ";");
					$users[$index]['user_vhost'] = explode(',', $data[6]);
					foreach($params as $key => $value)
					{
						$users[$index][$value] = $data[$key];
					}
				}
				$index++;
			}
		}
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
