<?php
class Config
{
    public $inDebug = false;
    public $dbHost = "localhost";
    public $dbUserName = 'root';
    public $dbPassword = 'pbr doors';
    public $dbName = '';

    
}

define("CONFIG", new Config());
