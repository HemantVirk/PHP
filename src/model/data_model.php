<?php

class data_model
{
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    protected $connection;

    public function __construct($host = "localhost", $username = 'root', $password = 'password', $database = 'AUNT_ROSSY')
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    protected function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to MySQL database<br>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    public function disconnect()
    {
        $this->connection = null;
        echo "Disconnected from MySQL database<br>";
    }

    public function executeQuery($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            echo "Query executed successfully<br>";
        } catch (PDOException $e) {
            echo "Error executing query: " . $e->getMessage();
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
            echo "Error executing query: " . $e->getMessage();
        }
    }
}

?>