<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';
$file = file_get_contents("user_info.xls");
$data = new Spreadsheet_Excel_Reader($file);
$rows = $data->rowcount($sheet_index=0);
$cols = $data->colcount($sheet_index=0);
for($row = 1; $row <= $rows; $row++)
{
	for($col = 1; $col <= $cols; $col++)
	{
		echo $data->val($row,$col) .' | ';
	}
	
	echo "\n";
}
//echo $data->dump_csv();

