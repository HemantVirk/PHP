<?php

class Request
{

    public string $method;
    public string $path;
    public $ishttpRequest = false;
    public $request;
    public $query;
    public $body;
    public array $pathSegments;

    public function __construct()
    {

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $this->_getPath($_SERVER['REQUEST_URI']);
        $this->pathSegments = $this->_getPathSegmnets($this->path);

        if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            || (isset($_SERVER['CONTENT_TYPE']) && strtolower($_SERVER['CONTENT_TYPE']) == "application/json")
            ||  (isset($_GET['format']) && $_GET['format'] == 'json')
        ) {
            $this->ishttpRequest = true;
        } else if ((isset($this->pathSegments) && $this->pathSegments[0] == 'api')) {
        }

        $this->request = $_REQUEST;
        $this->query = $_GET;
        $this->body = $_POST;

        $this->_log();
    }

    public function validateParams(array $keys): bool
    {
        $status = true;

        for ($x = 0; $x < sizeof($keys); $x++) {
            if (!isset($this->body[$keys[$x]])) {
                $status = false;
                break;
            }
        }

        return $status;
    }

    private function _log()
    {
        DEBUG->addLog("Method", $this->method);
        DEBUG->addLog("Path", $this->path);
        DEBUG->addLog("Path Segemnts", $this->pathSegments);
        DEBUG->addLog("IshttpRequest", $this->ishttpRequest);
        DEBUG->addLog("Query", $this->query);
        DEBUG->addLog("Body", $this->body);
        DEBUG->addLog("Request", $this->request);
        DEBUG->addLog($_SERVER);
    }

    public function _getPath(string $requestUri): String
    {
        $request = explode("?", $requestUri);
        return rtrim($request[0], "/");
    }

    public function _getPathSegmnets(string $path): array
    {
        $pathSegments = explode("/", trim($path, "/"));
        return $pathSegments;
    }
}

define("REQUEST", new Request());
