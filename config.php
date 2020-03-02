<?php
session_start();
date_default_timezone_set("Asia/Bangkok");

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://localhost/adminlte/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'activity_sys');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WWW_PATH', ROOT . DS );

define('CSS', URL . 'public/css/');
define('JS', URL . 'public/js/');
define('IMAGES', URL . 'public/images/');
define('PLUGINS', URL . 'public/plugins/');

## SQLi Manager And DB ##
include( ROOT.DS."SQLiManager.php" );
$sql = new SQLiManager();

##check Login
if( empty($_SESSION["admin_id"]) ){
    header("location:".URL."login.php");
}