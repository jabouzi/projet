<?php

class Xlsimportadapter
{
	private $userimport;

	function __construct()
	{
		require_once APPPATH.'app/lib/php-excel/excel_reader2.php';
	}

	public function import($file)
	{
		$users = array();
		$params = array(1 => 'user_name', 'user_password', 'user_first_name', 'user_last_name', 'user_email');
		$excel = new Spreadsheet_Excel_Reader($file);
		$rows = $excel->rowcount($sheet_index=0);
		$cols = $excel->colcount($sheet_index=0);
		var_dump($count($cols));
		for($row = 2; $row <= $rows; $row++)
		{
			if (count($cols) == 7)
			{
				for($col = 1; $col <= $cols; $col++)
				{
					$users[$row]['user_vhost'] = explode(',', $excel->val($row,7));
					$users[$row]['user_group'] = '';
					$users[$row][$params[$col]] = $excel->val($row,$col);
				}
			}
		}
		var_dump($users);
		exit;
		$this->userimport = new userimport();
		$this->userimport->import($users);

	}
}
