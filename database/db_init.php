<?php 
session_name('he201139_session');
session_start();

if($_SERVER["HTTP_HOST"]="193.190.65.94"){
	define("HOST", $GLOBALS['ini']['Database']['hostname_local']);
}else{
	define("HOST", $GLOBALS['ini']['Database']['hostname_external']);
}
define("HOST_LOCAL", $GLOBALS['ini']['Database']['hostname_local']);
define("HOST_EXTERNAL", $GLOBALS['ini']['Database']['hostname_external']);
define("DATABASE", $GLOBALS['ini']['Database']['db_name']);
define("USER", $GLOBALS['ini']['Database']['db_user']);
define("PASSWORD", $GLOBALS['ini']['Database']['db_password']);      
?>