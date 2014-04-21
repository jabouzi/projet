<?php
var_dump(time(), mktime());exit;
include_once ("db.session.handler.class.php");
$sess = new DatabaseSessionHandler();
session_set_save_handler(array(&$sess, '_open'),
                         array(&$sess, '_close'),
                         array(&$sess, '_read'),
                         array(&$sess, '_write'),
                         array(&$sess, '_destroy'),
                         array(&$sess, '_clean'));
session_start();
?>
