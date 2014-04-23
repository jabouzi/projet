<?php

class View
{
    static function load_view($view_path, $view_args = array())
    {
        if (!empty($view_args))
        {
            foreach($view_args as $var => $args)
            {
                ${$var} = $args;
            }
        }

        ob_start();
        include_once(APPPATH.'app/view/'.$view_path.'.php');
        $content = ob_get_clean();
        echo $content;
    }
}
