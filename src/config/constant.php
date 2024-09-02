<?php
require_once('../src/core/init-functions.php'); //overwrite the php functions
// Root Constant
define('DS', DIRECTORY_SEPARATOR);
define('BACK_DOT', '..');
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . BACK_DOT . DS); // TODO: update this value
define('ISCLI', PHP_SAPI === 'cli');
define('RUN_MODE', ISCLI ? 'development' : core_func::fw__mb_strtoupper(apache_getenv("run_mode")));

// base folder path
define('SRC_PATH', BASE_PATH . "src" . DS);
define('PUBLIC_PATH', BASE_PATH . "public" . DS);
define('LOGS_PATH', BASE_PATH . "logs" . DS);
define('STATIC_FILES_PATH', BASE_PATH . "static-files" . DS);
define('TEMP_FILES_PATH', BASE_PATH . "temp-files" . DS);
define('LIB_PATH', BASE_PATH . "lib" . DS);
define('CLI_PATH', BASE_PATH . "cli" . DS);

// src sub-folders path
define('CONFIG_PATH', SRC_PATH . "config" . DS);
define('CTRL_PATH', SRC_PATH . "controllers" . DS);
define('CORE_PATH', SRC_PATH . "core" . DS);
define('MODELS_PATH', SRC_PATH . "models" . DS);
define('ROUTES_PATH', SRC_PATH . "routes" . DS);
define('SERVICES_PATH', SRC_PATH . "services" . DS);
define('UTILS_PATH', SRC_PATH . "utils" . DS);
define('VIEWS_PATH', SRC_PATH . "views" . DS);


//request methods Allowed
define("GET", "GET");
define("POST", "POST");

//Request & Response Standard Keys
define("STATUS_CODE", 'status_code');
define("STATUS", 'status');
define("DATA", 'data');
define("ERROR", 'error');
define("MSG", 'msg');
define("LOG", 'log');

//keys
define("IS_ADMIN", "is_admin");

