<?php
//echo __DIR__.'/__prepend.php';
//ini_set('auto_prepend_file', __DIR__.'/__prepend.php');
require_once('prepend.php');

function get_controller_params($url_params)
{
    $core = array();
    if (!isset($url_params['u'])) return $core;
    $url_params = $url_params['u'];
    $params = explode('/',trim($url_params,'/'));
    //var_dump($params);
    if (isset($params[0])) $core['lang'] = $params[0];
    if (isset($params[1])) $core['controller'] = ucfirst(strtolower($params[1]));
    if (isset($params[2])) $core['method'] = $params[2];
    if (isset($params[3])) $core['args'] = array_slice($params, 3);
    else $core['args'] = array();
    //var_dump($core);
    return $core;
}

function controller_exists($controller)
{
    $controller = strtolower($controller);
    return (is_file($_SERVER['DOCUMENT_ROOT'] . "app/controller/{$controller}.php"));
}

function display_page_error()
{
    $message = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "core/template/error.html");
    $message = printf($message, 'Warning', '404 Page Not Found', 'The page you requested was not found.');    
    //echo $message;
}

