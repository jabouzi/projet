<?php

function get_controller_params($url_params)
{
    $core = array();
    if (!isset($url_params['u'])) return $core;
    $url_params = mysql_escape_string($url_params['u']);
    $params = explode('/',$url_params);
    $core['lang'] = $params[0];
    $core['controller'] = ucfirst(strtolower($params[1]));
    $core['method'] = $params[2];
    $core['args'] = array_slice($params, 3);
    return $core;
}
