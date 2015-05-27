<?php
define("USER_ADMIN", 0);
define("USER_MODERATOR", 1);
define("USER_NORMAL", 2);
define("USER_ACTIVATION", 3);
define("USER_UNSUB", 4);
define("USER_BANNED", 5);
define('USER_ANONYME', 3);

require_once("wiki/wiky.inc.php");

include 'database/database_functions.php';
include 'user/user_functions.php';
include 'admin/admin_functions.php';
include 'content/content_functions.php';
include 'wiki/wiki_functions.php';
?>