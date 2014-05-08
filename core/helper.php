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
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
	   $ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = '0.0.0.0';
	return $ipaddress;
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

function islogged()
{
	return (isset($_SESSION['user']));
}

function isadmin()
{
	return $_SESSION['user']['admin'];
}

function display_message()
{
	echo (isset($_SESSION['message'])) ? '<span class="error">'.lang($_SESSION['message']).'</span>' : '';
	unset($_SESSION['message']);
}

function get_item($array, $key)
{
	return (isset($array[$key])) ? $array[$key] : false;
}

function print_post_text($key, $othertext = '')
{
	if (isset($_SESSION['request'][$key])) return $_SESSION['request'][$key];
	else if ($othertext != '') return $othertext;
	else return '';
}

function lang($key)
{
	global $lang;
	$text = get_item($lang, $key);
	return (!isempty($text)) ? $text : $key;
}
