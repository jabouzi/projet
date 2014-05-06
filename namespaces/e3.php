<?php 
echo __dir__.'<br />';
set_include_path(__DIR__);
spl_autoload_extensions(".php"); // To make sure spl only includes php-files while autoloading.
spl_autoload_register();


//namespace space3;

//require_once 'e0.php';
//require_once 'e1.php';

//use space1;
space1\E1::show();
//\E1::show();

//namespace space4;

//require_once 'e1.php';

use space1 as s1;
s1\E1::show();
