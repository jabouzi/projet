<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
$slash = '';
if (substr($_SERVER['DOCUMENT_ROOT'], -1) != '/') $slash = '/';
define('APPPATH', $_SERVER['DOCUMENT_ROOT'].$slash);

require(APPPATH.'core/core.php');
require(APPPATH.'core/autoload.php');
require(APPPATH.'core/helper.php');
require(APPPATH.'app/config/config.php');

foreach($config['autoload_helpers'] as $file)
{
	require(APPPATH."app/helper/{$file}.php");
}

foreach($config['autoload_languages'] as $file)
{
	require(APPPATH."app/languages/".get_site_lang()."/{$file}.php");
}

$session = new Session();
session_set_save_handler(array(&$session, '_open'),
                         array(&$session, '_close'),
                         array(&$session, '_read'),
                         array(&$session, '_write'),
                         array(&$session, '_destroy'),
                         array(&$session, '_clean'));
session_start();
$params = get_controller_params($_GET);

if (isset($_GET['u']) and isset($params['lang']))
{
	if (!is_valid_site_lang()) redirect('/');
}

if (isset($params['controller']))
{
	if (controller_exists($params['controller']))
	{
		$obj = new $params['controller']();
		if (isset($params['method']))
		{
			if (is_callable(array($obj, $params['method'])))
			{
				echo call_user_func_array(array($obj, $params['method']), $params['args']);
			}
			else
			{
				display_page_error();
			}
		}
		else
		{
			if (is_callable(array($obj, 'index')))
			{
				echo call_user_func_array(array($obj, 'index'), array());
			}
			else
			{
				display_page_error();
			}
		}
	}
	else
	{
		display_page_error();
	}
}
