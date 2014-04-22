<?php
class autoload
{
    public static function config_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/config/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    public static function core_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "core/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    public static function lib_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/lib/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    public static function controller_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/controller/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    public static function model_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/model/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    public static function class_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/class/{$class}.php";
        if (is_readable($path)) require $path;
    }
    
    public static function dao_autoload($class)
    {
        $class = strtolower($class);
        $path = $_SERVER['DOCUMENT_ROOT'] . "app/dao/{$class}.php";
        if (is_readable($path)) require $path;
    }
}
spl_autoload_register('autoload::config_autoload');
spl_autoload_register('autoload::core_autoload');
spl_autoload_register('autoload::lib_autoload');
spl_autoload_register('autoload::controller_autoload');
spl_autoload_register('autoload::model_autoload');
spl_autoload_register('autoload::class_autoload');
spl_autoload_register('autoload::dao_autoload');
