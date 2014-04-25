<?php

set_error_handler("errorHandler");
register_shutdown_function("shutdownHandler");

function errorHandler($error_level, $error_message, $error_file, $error_line, $error_context)
{
    $error = array("lvl" => $error_level, "msg" => $error_message,  "file" => $error_file, "ln" =>  $error_line);
    switch ($error_level) {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_PARSE:
            __log($error, "FATAL ERROR");
            break;
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            __log($error, "Error");
            break;
        case E_WARNING:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_USER_WARNING:
            __log($error, "WARNING");
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            __log($error, "NOTICE");
            break;
        case E_STRICT:
            __log($error, "DEBUG");
            break;
        default:
            __log($error, "WARNING");
    }
}

function shutdownHandler() //will be called when php script ends.
{
    $lasterror = error_get_last();
    switch ($lasterror['type'])
    {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_PARSE:
            $error = array("lvl" => $lasterror['type'], "msg" => $lasterror['message'], "file:" => $lasterror['file'], "ln" => $lasterror['line']);
            __log($error, "FATAL ERROR");
    }
}

function __log($error, $errlvl)
{
    if (strstr($_SERVER["SCRIPT_NAME"], 'index.php') || strstr($_SERVER["SCRIPT_NAME"], 'code.php'))
    {
        $message = file_get_contents(APPPATH . "core/template/error.html");
        $message = printf($message, $errlvl, $error['msg'], $error['file']. ' : '.$error['ln']);    
    }    
}
