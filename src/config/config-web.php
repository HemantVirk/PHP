<?php
require_once LIB_PATH.'phpdotenv/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(CONFIG_PATH, strtolower(RUN_MODE).".env");
$dotenv->load();
define('DEBUG_ENABLE', filter_var($_ENV['DEBUG_ENABLE'], FILTER_VALIDATE_BOOLEAN));
define('MAIN_READ_SERVER', $_ENV['MAIN_READ_SERVER']);
define('MAIN_READ_PORT', $_ENV['MAIN_READ_PORT']);
define('MAIN_READ_PSWD', $_ENV['MAIN_READ_PSWD']);
define('MAIN_READ_USER', $_ENV['MAIN_READ_USER']);
define('MAIN_READ_DB', $_ENV['MAIN_READ_DB']);

define('MAIN_WRITE_SERVER', $_ENV['MAIN_WRITE_SERVER']);
define('MAIN_WRITE_PORT', $_ENV['MAIN_WRITE_PORT']);
define('MAIN_WRITE_PSWD', $_ENV['MAIN_WRITE_PSWD']);
define('MAIN_WRITE_USER', $_ENV['MAIN_WRITE_USER']);
define('MAIN_WRITE_DB', $_ENV['MAIN_WRITE_DB']);
class Config extends helper_func {
    public static $debug_enable = DEBUG_ENABLE;
    public static $read_db_host = MAIN_READ_SERVER;
    public static $read_db_user = MAIN_READ_USER;
    public static $read_db_pwd = MAIN_READ_PSWD;
    public static $read_db_name = MAIN_READ_DB;
    public static $read_db_port = MAIN_READ_PORT;
    public static $write_db_host = MAIN_WRITE_SERVER;
    public static $write_db_user = MAIN_WRITE_USER;
    public static $write_db_pwd = MAIN_WRITE_PSWD;
    public static $write_db_name = MAIN_WRITE_DB;
    public static $write_db_port = MAIN_WRITE_PORT;

}
?>  