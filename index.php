<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
require_once('core/core.php');
require_once('core/autoload.php');

//require 'includes/exceptions.php';

session_start();
var_dump($_GET);
$params = get_controller_params($_GET);
var_dump($params);
if (count($params))
{
    if (isset($params['controller']))
    {
        $obj = new $params['controller']();
        if (is_callable(array($obj, $params['method'])))
        {
            echo call_user_func_array(array($obj, $params['method']), $params['args']);
        }
        else
        {
            echo 'Errorz';
        }
    }
    else
    {
        $obj = new defaults();
        if (is_callable(array($obj, 'index')))
        {
            echo call_user_func_array(array($obj, 'index'), array());
        }
    }
}
else
{
    $obj = new defaults();
    if (is_callable(array($obj, 'index')))
    {
        echo call_user_func_array(array($obj, 'index'), array());
    }
}
