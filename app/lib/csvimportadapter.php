<?php

class Csvimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($file)
	{
		$row = 1;
		$users = array();
		$params = array('user_name', 'user_password', 'user_first_name', 'user_last_name', 'user_email');
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				if ($row)
				{
					if (count($data) == 7)
					{
						$users[$row]['user_vhost'] = explode(',', $data[6]);
						$users[$row]['user_group'] = '';
						foreach($params as $key => $value)
						{
							$users[$row][$value] = $data[$key];
						}
					}
					$row++;
				}
			}
			fclose($handle);
			$this->userimport = new userimport();
			$this->userimport->import($users);
		}
	}
}
