<?php
// Root Constant
define('DS', DIRECTORY_SEPARATOR);
define('BACK_DOT', '..');
define('SITE_ROOT', BACK_DOT . DS . "src" . DS);

define('APP_ROOT', SITE_ROOT . "app.php");

define('CONFIG_ROOT', SITE_ROOT . "config" . DS);
define('CORE_ROOT', SITE_ROOT . "core" . DS);
define('MODULES_ROOT', SITE_ROOT . "modules" . DS);
define('ROUTES_ROOT', SITE_ROOT . "routes" . DS);
define('SERVICES_ROOT', SITE_ROOT . "services" . DS);
define('UTILS_ROOT', SITE_ROOT . "utils" . DS);
define('STATIC_PAGE_ROOT', UTILS_ROOT . "static-page");

//Comman File Paths
define('CONFIG_PATH', CONFIG_ROOT . "config.php");


//Methods Allowed
define("GET", "GET");
define("POST", "POST");

//Request & Respose Standard Keys
define("STATUS_CODE", 'status_code');
define("DATA", 'data');
define("ERROR", 'error');
define("MSG", 'msg');
define("LOG", 'log');

//Static Folder Path
define("IMAGES_PATH", "assets" . DS . "img" . DS);

//Standard File Paths
define("PAGE_NOT_FOUND_404", STATIC_PAGE_ROOT . DS . 'page_not_found.php');
define("SERVER_DOWN", 'views/default/server_down.php');

//String Constants
define("APP_TITLE", "Afwaah");

//keys
define("IS_ADMIN", "is_admin");
