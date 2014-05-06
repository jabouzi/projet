<?php

class Csvimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($json)
	{
		$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
		$users = json_decode($json, true);
		$this->userimport = new userimport();
		$this->userimport->import($users);
	}
}
