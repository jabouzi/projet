<?php

class Xmlimportadapter
{
	private $userimport;

	function __construct()
	{

	}

	public function import($file)
	{
		$racine = simplexml_load_file($file);
        var_dump((array)$racine);
		$i = 0;
		//foreach ($racine->Niveau1 as $key => $niveau) 
		//{
			//$data = get_object_vars($niveau);
		//}

	}
}
