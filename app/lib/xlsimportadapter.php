<?php

class Xlsimportadapter
{
	private $userimport;

	function __construct()
	{
		require_once APPPATH.'lib/php-excelexcel_reader2.php';
	}

	public function import($file)
	{
		$data= file_get_contents($file);
		$excel = new Spreadsheet_Excel_Reader($data);
		$rows = $excel->rowcount($sheet_index=0);
		$cols = $excel->colcount($sheet_index=0);
		for($row = 1; $row <= $rows; $row++)
		{
			for($col = 1; $col <= $cols; $col++)
			{
				var_dump($excel->val($row,$col));
			}
		}
		exit;
		$this->userimport = new userimport();
		$this->userimport->import($users);

	}
}
