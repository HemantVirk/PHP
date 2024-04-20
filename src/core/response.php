<?php

class Response{
    public $result;

    public function __construct(){
        $this->result = new stdClass();
        $this->result->{STATUS_CODE} = 200;
        $this->result->{DATA} = new stdClass();
    }


    public function addData($key,$value){
        $this->result->{DATA}->$key = $value;
    }

    public function sendJSON(){
        print_r(convertToJSON($this->result));
        die();
    }
}

define("RESPONSE", new Response());

?>