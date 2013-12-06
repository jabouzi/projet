<?php

function get_controller_params($url_params)
{
    $core = array();
    if (!isset($url_params['u'])) return $core;
    $url_params = mysql_escape_string($url_params['u']);
    $params = explode('/',trim($url_params,'/'));
    var_dump($params);
    if (isset($params[0])) $core['lang'] = $params[0];
    else if (isset($params[1])) $core['controller'] = ucfirst(strtolower($params[1]));
    else if (isset($params[2])) $core['method'] = $params[2];
    else if (isset($params[3])) $core['args'] = array_slice($params, 3);
    return $core;
}
