<?php
if( !defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}


// REQUIRE COMPOSER FOLDERS
require_once implode(DS, [dirname(__FILE__), '..', 'vendor', 'autoload.php']);

// Require base test
require_once implode(DS, [dirname(__FILE__), 'plugin-validate', 'BaseTest.php']);