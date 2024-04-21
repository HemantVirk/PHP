<?php

class DataBase
{
    protected $connection;

    public function __construct()
    {
        $host = CONFIG->dbHost;
        $username = CONFIG->dbUserName;
        $password = CONFIG->dbPassword;
        $database = CONFIG->dbName;

        try {
            $dsn = "mysql:host={$host};dbname={$database}";
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            DEBUG->addLog('DB Connection Error', $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function executeQuery($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
        } catch (PDOException $e) {
            DEBUG->addLog('Query Execution Error', [$query =>  $e->getMessage()]);
        }
    }

    public function selectQuery($query, $params = [])
    {
        try {
            echo $query;
            print_r($params);
            $statement = $this->connection->prepare($query, $params);
            $res = $statement->fetchAll();
            print_r($res);
            die;
        } catch (PDOException $e) {
            DEBUG->addLog('Query Execution Error', [$query =>  $e->getMessage()]);
        }
    }
}
