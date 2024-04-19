<?php
// Root Constant
define('DS',DIRECTORY_SEPARATOR);
define('BACK_DOT','..');
define('SITE_ROOT',BACK_DOT.DS."src".DS);
define('CONFIG_ROOT',SITE_ROOT."config".DS);
define('CONTROLLER_ROOT',SITE_ROOT."controller".DS);
define('MODEL_ROOT',SITE_ROOT."model".DS);
define('ROUTER_ROOT',SITE_ROOT."router".DS);
define('SERVICES_ROOT',SITE_ROOT."services".DS);
define('UTILS_ROOT',SITE_ROOT."utils".DS);

    
//Methods Allowed
define("GET","GET");
define("POST","POST");

//Request & Respose Standard Keys
define("STATUS_CODE",'status_code');
define("DATA",'data');
define("ERROR",'error');
define("MSG",'msg');
define("LOG",'log');

//Standard File Paths
define("PAGE_NOT_FOUND_404",'views/default/page_not_found.php');
define("SERVER_DOWN",'views/default/server_down.php');

//String Constants
define("APP_TITLE","Afwaah");

//keys
define("IS_ADMIN","is_admin");

?>