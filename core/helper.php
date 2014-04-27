<?php

function ucname($string) {
	$string =ucwords(strtolower($string));

	foreach (array('-', '\'') as $delimiter) {
	  if (strpos($string, $delimiter)!==false) {
		$string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
	 , 302);
	}
	else
	{
		header("Location: ".$uri, TRUE, 302);
	}

	exit;
}

function item($array, $key)
{
	return (isset($array[$key])) ? $array[$key] : false;
}

function isempty($string)
{
	$string = trim($string);
	return (empty($string)) ? true : false;
}
