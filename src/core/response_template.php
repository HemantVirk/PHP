<?php

use PSpell\Config;

class ResponseTemplate
{

    private $_result;
    protected $data;
    protected $_db;

    public function __construct()
    {
        $this->_initResponse();

        if (REQUEST->method == GET) {
            if (REQUEST->ishttpRequest) {
                $this->setData();
            } else {
                $this->renderHTML();
            }
        } else if (REQUEST->method == POST) {
            $this->postReq();
        }

        $this->_endResponse();
    }


    protected function setData()
    {
        $this->addData("msg", "404");
    }

    protected function renderHTML()
    {
        require_once(PAGE_NOT_FOUND_404);
    }

    protected function postReq()
    {
        $this->addData("msg", "Not Allowed");
    }


    protected function addData($key, $value)
    {
        $this->data->$key = $value;
    }

    protected function initDB()
    {
        $this->_db = new DataBase();
    }

    private function _initResponse()
    {
        $this->_result = new stdClass();
        $this->_result->{STATUS_CODE} = 200;
        $this->data = new stdClass();
    }

    private function _endResponse()
    {
        ob_flush();
        if (REQUEST->method == POST || REQUEST->ishttpRequest) {

            header('Content-Type: application/json');

            if (CONFIG->inDebug) {
                DEBUG->log();
            } else {
                $this->_result->{DATA} = $this->data;
                print_r(convertToJSON($this->_result));
            }
        }
        die();
    }
}
