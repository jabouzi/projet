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

function get_site_lang()
{
	require(APPPATH.'/app/config/config.php');
	if (!isset($_GET['u'])) return $config['lang'];
	$params = explode('/',trim($_GET['u'],'/'));
	if (is_valid_site_lang()) return $params[0];
	return $config['lang'];
}

function is_valid_site_lang()
{
	require(APPPATH.'/app/config/config.php');
	$params = explode('/',trim($_GET['u'],'/'));
	if (isset($params[0]) and in_array($params[0], $config['site_languages'])) return true;
	return false;
}

function redirect($uri = '', $method = 'location', $http_response_code = 302)
{
	if ( ! preg_match('#^https?://#i', $uri))
	{
		header("Location: /".get_site_lang()."/".trim($uri,'/'), TRUE, 302);
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

function is_logged()
{
	return (isset($_SESSION['user']));
}
