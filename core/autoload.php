<?php
class autoload
{
    public static function config_autoload($class)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/config/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    //~ public static function controller_autoload($class)
    //~ {
        //~ $path = $_SERVER['DOCUMENT_ROOT'] . "app/controller/{$class}.php";
        //~ if (is_readable($path)) require $path;
    //~ }
    //~ 
    //~ public static function module_autoload($class)
    //~ {
        //~ $path = $_SERVER['DOCUMENT_ROOT'] . "app/module/{$class}.php";
        //~ if (is_readable($path)) require $path;
    //~ }
    //~ 
    //~ public static function view_autoload($class)
    //~ {
        //~ $path = $_SERVER['DOCUMENT_ROOT'] . "app/view/{$class}.php";
        //~ if (is_readable($path)) require $path;
    //~ }
}
spl_autoload_register('autoload::config_autoload');
spl_autoload_register('autoload::controller_autoload');
spl_autoload_register('autoload::module_autoload');
spl_autoload_register('autoload::view_autoload');

?>
