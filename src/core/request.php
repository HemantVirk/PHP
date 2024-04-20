<?php

class Request{

    public string $method;
    public string $path;
    public $ishttpRequest = false;
    public $request;
    public $query;
    public $body;
    public array $pathSegments;

    public function __construct(){

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $this->getPath($_SERVER['REQUEST_URI']);
        $this->path = rtrim($this->path,"/");

        $this->pathSegments = $this->getPathSegmnets($_SERVER['REQUEST_URI']) ;
        if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            || (isset($_SERVER['CONTENT_TYPE']) && strtolower($_SERVER['CONTENT_TYPE']) == "application/json" )
            ||  ( isset($_GET['format']) && $_GET['format'] == 'json')
            || (isset($this->pathSegments) && $this->pathSegments[0] == 'api')
        ) {
            $this->ishttpRequest = true;
        }

        $this->request = $_REQUEST;
        $this->query = $_GET;
        $this->body = $_POST;
    }

    public function validateParams(array $keys) :bool  {
        $status = true;

        for ($x = 0; $x < sizeof($keys); $x++) {
            if(!isset($this->body[$keys[$x]])) {
                $status = false;
                break;
            }
        }

        return $status;
    }

    public function log(){
        DEBUG->addLog("Method",$this->method);
        DEBUG->addLog("Path",$this->path);
        DEBUG->addLog("Path Segemnts",$this->pathSegments);
        DEBUG->addLog("IshttpRequest",$this->ishttpRequest);
        DEBUG->addLog("Query",$this->query);
        DEBUG->addLog("Body",$this->body);
        DEBUG->addLog("Request",$this->request);
        DEBUG->addLog($_SERVER);
    }

    public function getPath(string $requestUri) : String{
        $request = explode("?",$requestUri);
        return $request[0];
    }

    public function getPathSegmnets(string $requestUri) : array{
        $path = $this->getPath($requestUri);
        $path = trim($path,"/");
        $pathSegments = explode("/",$path);
        return $pathSegments;
    }

}

define("REQUEST",new Request());

?>