<?php

require_once('core/autoload.php');
require_once('app/helper/functions.php');
//require 'includes/exceptions.php';

session_start();

$params = get_controller_params($_GET);
if (count($params))
{
    $obj = new $params['controller']();
    if (is_callable(array($obj, $params['method'])))
    {
        echo call_user_func_array(array($obj, $params['method']), $params['args']);
    }
    else
    {
        echo 'Error';
    }
}
else
{
    echo 'Load default controller';
}
//~ lib::setitem('controller', new controller($_GET['u']));
//~ 
//~ $view = new view();
//~ lib::getitem('controller')->render();
//~ $content = $view->finish();
//~ 
//~ echo view::show('shell', array('body'=>$content));
