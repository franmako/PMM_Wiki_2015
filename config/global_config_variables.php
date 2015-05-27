<?php 
//Ini parse
$GLOBALS['ini_path'] = 'config.ini.php';
$GLOBALS['ini'] = parse_ini_file($GLOBALS['ini_path'], true);

//Head ini variables
define("TITLE", $GLOBALS['ini']['Header']['title']);
define("TITLE_BANNER", $GLOBALS['ini']['Header']['banner_title']);
define("LOGO_PATH", $GLOBALS['ini']['Header']['logo']);
define("LOGO_MIN_WIDTH", $GLOBALS['ini']['Header']['logo_min_width']);
define("LOGO_WIDTH", $GLOBALS['ini']['Header']['logo_width']);
define("LOGO_MAX_WIDTH", $GLOBALS['ini']['Header']['logo_max_width']);
define("LOGO_MIN_HEIGHT", $GLOBALS['ini']['Header']['logo_min_height']);
define("LOGO_HEIGHT", $GLOBALS['ini']['Header']['logo_height']);
define("LOGO_MAX_HEIGHT", $GLOBALS['ini']['Header']['logo_max_height']);

//Contact ini variables
define("CONTACT_NOTIFY", $GLOBALS['ini']['Contact']['notify']);
define("CONTACT_CONFIRM", $GLOBALS['ini']['Contact']['confirm']);
define("CONTACT_REGISTER", $GLOBALS['ini']['Contact']['register']);
define("CONTACT_ADMIN", $GLOBALS['ini']['Contact']['admin']);

//Register ini variables
define("USERNAME_MIN_SIZE", $GLOBALS['ini']['Register']['username_min_size']);
define("PASSWORD_MIN_SIZE", $GLOBALS['ini']['Register']['password_min_size']);
define("PASSWORD_MAX_SIZE", $GLOBALS['ini']['Register']['password_max_size']);

//Avatar ini variables
define("AVATAR_PATH", $GLOBALS['ini']['Avatar']['path']);
define("AVATAR_MIN_HEIGHT", $GLOBALS['ini']['Avatar']['avatar_min_height']);
define("AVATAR_HEIGHT", $GLOBALS['ini']['Avatar']['avatar_height']);
define("AVATAR_MAX_HEIGHT", $GLOBALS['ini']['Avatar']['avatar_max_height']);
define("AVATAR_MIN_WIDTH", $GLOBALS['ini']['Avatar']['avatar_min_width']);
define("AVATAR_WIDTH", $GLOBALS['ini']['Avatar']['avatar_width']);
define("AVATAR_MAX_WIDTH", $GLOBALS['ini']['Avatar']['avatar_max_width']);

//Foot ini variables
define("AUTHOR_NAME", $GLOBALS['ini']['Footer']['author_name']);
define("COPYRIGHT", $GLOBALS['ini']['Footer']['copyright_date']);
?>