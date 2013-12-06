<?php

class Controller
{
    function __construct()
    {
        require_once('view.php');
        require_once('model.php');
    }
    
    function load_view($view_path, $view_args = array())
    {
        view::load_view($view_path, $view_args);
    }
}
