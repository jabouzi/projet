<?php

class View
{
    $view_path = '';
    $view_args = array();
    
    function __construct()
    {
        
    }
    
    static function load_view($view_path, $view_args)
    {
        $this->view_path = $view_path;
        $this->view_args = $view_args;
        ob_start();
        include_once($_SERVER['DOCUMENT_ROOT'].'app/view/'.$view_path);
        $content = ob_get_clean();
        return $content;
    }
}
