<?php

function ucname($string) {
	$string =ucwords(strtolower($string));

	foreach (array('-', '\'') as $delimiter) {
	  if (strpos($string, $delimiter)!==false) {
		$string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
	  }
	}
	return $string;
}

function user_agent()
{
	$user_agent = ( ! isset($_SERVER['HTTP_USER_AGENT'])) ? FALSE : $_SERVER['HTTP_USER_AGENT'];
	return $user_agent;
}

function ip_address()
{
	return $_SERVER['REMOTE_ADDR'];
}
