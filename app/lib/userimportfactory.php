<?php

class Userimportfactory
{
	function __construct()
	{
		
	}
	
	public static function create($filetype)
	{
		$class = strtolower($filetype).'importadapter';
		return new $class;
	}
}
