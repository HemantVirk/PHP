<?php
interface database {

    public function __construct();

    /**
     * @return void
     */
    public function disconnect(): void;


    /**
     * @param string $query
     * @param array $params
     * @return false|PgSql\Result
     */
    function fw__pg_query_params(string $query, $params): false|PgSql\Result;


    /**
     * @param string $query
     * @return false|PgSql\Result
     */
    function fw__pg_query(string $query): \PgSql\Result|bool;
}