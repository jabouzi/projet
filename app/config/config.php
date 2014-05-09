<?php

$config['default'] = 'application';
$config['lang'] = 'fr';
if (strstr($_SERVER['HTTP_HOST'], 'tgiprojects.com'))
{
	$config['database'] = 'staging_auth';
	$config['username'] = 'root';
	$config['password'] = 'xXd3eAXg7uV';
	$config['host'] = '10.1.6.204';
}
else
{
	$config['database'] = 'jabouzic_projet';
	$config['username'] = 'jabouzic_db';
	$config['password'] = '7024043';
	$config['host'] = 'localhost';
}
$config['driver'] = 'mysql';
$config['site_languages'] = array('fr', 'en');
$config['autoload_helpers'] = array('functions');
$config['autoload_languages'] = array('application');
