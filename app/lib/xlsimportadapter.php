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
		$excel = new Spreadsheet_Excel_Reader($file);
		$rows = $excel->rowcount($sheet_index=0);
		$cols = $excel->colcount($sheet_index=0);
		for($row = 2; $row <= $rows; $row++)
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
