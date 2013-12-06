<?php

function get_controller_params($url_params)
{
    $core = array();
    if (!isset($url_params['u'])) return $core;
    $url_params = mysql_escape_string($url_params['u']);
    $params = explode('/',trim($url_params,'/'));
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
    return (is_file($_SERVER['DOCUMENT_ROOT'] . "app/controller/{$controller}.php"));
}

function display_page_error()
{
    require $_SERVER['DOCUMENT_ROOT'] . "core/error.php";
}

