<?php

require('prepend.php');

function get_controller_params($url_params)
{
	require(APPPATH.'/app/config/config.php');
    $core = array('lang' => $config['lang'], 'controller' => $config['default']);
    if (!isset($url_params['u'])) return $core;
    $url_params = $url_params['u'];
    $params = explode('/',trim($url_params,'/'));
    $core['args'] = array();
    //var_dump($params);
    if (isset($params[0])) $core['lang'] = $params[0];
    if (isset($params[1])) $core['controller'] = ucfirst(strtolower($params[1]));
    if (isset($params[2])) $core['method'] = $params[2];
    if (isset($params[3])) $core['args'] = array_slice($params, 3);
    //var_dump($core);
    return $core;
}

function controller_exists($controller)
{
    $controller = strtolower($controller);
    return (is_file(APPPATH . "app/controller/{$controller}.php"));
}

function display_page_error()
{
    $message = file_get_contents(APPPATH . "core/template/error.html");
    $message = printf($message, 'Warning', '404 Page Not Found', 'The page you requested was not found.');    
}

