<?php

class QueryResult{
    public bool $status;
    public array $data;
    public int $rowsEffected;
    public string $message;
    public $errorStack;

    public function __construct($message = '') {
        $this->status= false;
        $this->data = array();
        $this->rowsEffected =0;
        $this->message = $message;
    }
}


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

    private function executeQuery($query, $params = []) : QueryResult
    {
        $result = new QueryResult();
        $statement = $this->connection->prepare($query);
        try {
            if(isset($this->connection)) {
                $statement->execute($params);
                $result->status = true;
                $result->rowsEffected = $statement->rowCount();
                $result->data = $statement->fetchAll(PDO::FETCH_CLASS);
            } else {
                $result->message = "DB Not Connected";
            }
     

        } catch (PDOException $e) {

            $errorInfo = $statement->errorInfo();
            DEBUG->addLog('Query Execution Error', [$query =>  $e->getMessage()]);
            $result->message = 'Query Execution Failed';

            $result->errorStack = ['errorCode' => $errorInfo[1], 
                                   'errorType' => DB_ERROR_CODES[$errorInfo[1]],
                                   'errorMessage' => $errorInfo[2]];
        }

        return $result;
    }

    public function select($query, $params = []) : QueryResult
    {
        return $this->executeQuery($query, $params);
    }


    public function insert($table, $columns = [], $values = []) :  QueryResult
    {
        if(count($columns) == count($values) && count($columns) > 0) {
            $columnString = implode(',', $columns);
            $valueString = rtrim(str_repeat('?,', count($values)), ',');
        }
        else {
            return new QueryResult('Columns and Values are specified Incorrectly');
        }

        $query = "INSERT INTO $table($columnString) values ($valueString);";
        return $this->executeQuery($query, $values);        
    }

    public function update($table, $columns = [], $values = [], $whereCondition = '') :  QueryResult
    {
        if(count($columns) == count($values) && count($columns) > 0) {
            $columnString = implode(',', $columns);
            $valueString = rtrim(str_repeat('?,', count($values)), ',');
        }
        else {
            return new QueryResult('Columns and Values are specified Incorrectly');
        }

        $query = "INSERT INTO $table($columnString) values ($valueString);";
        return $this->executeQuery($query, $values);        
    }

    public function beginTransaction() : QueryResult
    {
        return $this->executeQuery('BEGIN TRANSACTION');
    }

    public function endTransaction() : QueryResult
    {
        return $this->executeQuery('END TRANSACTION');
    }

    public function rollback() : QueryResult
    {
        return $this->executeQuery('ROLLBACK');
    }

    public function commit() : QueryResult
    {
        return $this->executeQuery('COMMIT');
    }
}

