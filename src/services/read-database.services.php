<?php
require_once SERVICES_PATH . 'database.services.php';
class read_database extends helper_func implements database{
    private \PgSql\Connection|false $connection;

    public function __construct()
    {
        $host = Config::$read_db_host;
        $username = Config::$read_db_user;
        $password = Config::$read_db_pwd;
        $database = Config::$read_db_name;
        $port = Config::$read_db_port;

        $this->connection = @pg_connect("host=$host port=$port dbname=$database user=$username password=$password connect_timeout=5");
        if ($this->connection === false) {
                if(!ISCLI) {
                    header("Location: /conn-error.php?target=" . urlencode($_SERVER['REQUEST_URI']), true, 307);
                }
                self::fw__die();
        }
    }

    public function disconnect(): void{
        if(is_resource($this->connection) || $this->connection instanceof \PgSql\Connection) {
            try {@pg_close($this->connection);} catch (Error|Exception $e) {}
        }
    }


    /**
     * @param string $query
     * @param array $params
     * @return false|PgSql\Result
     */
    function fw__pg_query_params(string $query, $params): \PgSql\Result|false
    {
        if(is_bool($this->connection)) {
            trigger_error("Required DB Connections but boolean given.", E_USER_WARNING);
            return false;
        }

        if(empty($query)) {
            trigger_error("Query is empty", E_USER_WARNING);
            return false;
        }

        if(!is_array($params)) $params = [];

        try {
            $result =  @pg_query_params($this->connection, $query, $params);
            if(!$result) {
                trigger_error(pg_last_error($this->connection),E_USER_WARNING);
            }
            return $result;
        } catch (Error $e) {
            trigger_error($e->getMessage(),E_USER_WARNING);
            return false;
        }
    }


    /**
     * @param string $query
     * @return false|PgSql\Result
     */
    function fw__pg_query(string $query): \PgSql\Result|bool {
        if(is_bool($this->connection)) {
            trigger_error("Required DB Connections but boolean given.", E_USER_WARNING);
            return false;
        }

        if(empty($query)) {
            trigger_error("Query is empty", E_USER_WARNING);
            return false;
        }
        try {
            $result =  @pg_query($this->connection, $query);
            if(!$result) {
                trigger_error(pg_last_error($this->connection),E_USER_WARNING);
            }
            return $result;
        } catch (Error $e) {
            trigger_error($e->getMessage(),E_USER_WARNING);
            return false;
        }
    }
}
define('READ_CONN', new read_database());