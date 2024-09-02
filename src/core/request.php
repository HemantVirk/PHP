<?php

class Request extends helper_func {

    public string $method;
    public string $path;
    public bool $is_http_request = false;
    public array $request;
    public array $query;
    public array $body;
    public array $pathSegments;
    public string $page;
    private int $version;
    private string $route_file;
    private array $routes;
    private string $default_controller = '404';

    public function __construct(){

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = self::fw__get_path_from_url($_SERVER['REQUEST_URI']);
        $this->pathSegments = self::fw__get_path_segments_from_url($_SERVER['REQUEST_URI']) ;
        if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && self::fw__mb_strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            || (isset($_SERVER['CONTENT_TYPE']) && self::fw__mb_strtolower($_SERVER['CONTENT_TYPE']) == "application/json" )
            ||  ( isset($_GET['format']) && $_GET['format'] == 'json')
            || (!empty($this->pathSegments) && $this->pathSegments[0] == 'api')
        ) {
            $this->is_http_request = true;
        }

        $this->request = $_REQUEST;
        $this->query = $_GET;
        $this->body = $_POST;
        $this->fw__set_routing();
    }

    public function fw__validate_params(array $keys) :bool  {
        $status = true;

        for ($x = 0; $x < self::fw__count($keys); $x++) {
            if(!isset($this->body[$keys[$x]])) {
                $status = false;
                break;
            }
        }

        return $status;
    }

    public function log(): void{
        if(!defined('DEBUG'))
            return;
        DEBUG->addLog("Method",$this->method);
        DEBUG->addLog("Path",$this->path);
        DEBUG->addLog("Path Segements",$this->pathSegments);
        DEBUG->addLog("IshttpRequest",$this->is_http_request);
        DEBUG->addLog("Query",$this->query);
        DEBUG->addLog("Body",$this->body);
        DEBUG->addLog("Request",$this->request);
        DEBUG->addLog($_SERVER);
    }

    private function fw__set_routing(): void {
        $this->fw__set_routing_file();
        if (file_exists(ROUTES_PATH.$this->route_file))
        {
            include(ROUTES_PATH.$this->route_file);
        }

        // Validate & get reserved routes
        if (isset($route) && is_array($route))
        {
            isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
            unset($route['default_controller']);
            $this->routes = $route;
        }
        $this->fw__parse_routes();
    }

    private function fw__parse_routes(): void {
        $uri = $this->path;
        $this->page = 'v' . $this->version . DS . $this->default_controller;
        foreach ($this->routes as $key => $val)
        {
            // Convert wildcards to RegEx
            $key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

            // Does the RegEx match?
            if (preg_match('#^'.$key.'$#', self::fw__clean_slash_from_url($uri)))
            {
                // Are we using the default routing method for back-references?
                if (self::fw__strpos($val, '$') !== FALSE && self::fw__strpos($key, '(') !== FALSE) {
                    $val = preg_replace('#^'.$key.'$#', $val, $uri);
                }

                $this->page = 'v' . $this->version . DS . $val;
                return;
            }
        }
    }

    private function fw__set_version(): void {
        $default_version = 1;
        $this->version = $default_version;
    }

    private function fw__set_routing_file(): void {
        $this->fw__set_version();
        $default_routing_file = 'router.php';

        $routing_file = $default_routing_file;
        $this->route_file = 'v' . $this->version . DS . $routing_file;
    }

}

define('REQUEST', new Request());
