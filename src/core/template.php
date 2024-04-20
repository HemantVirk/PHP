<?php
class ResponseTemplate {

    public function __construct() {

        if(REQUEST->method == GET) {
            if(REQUEST->ishttpRequest) {
                $this->sendJSON();
                RESPONSE->sendJson();
            } else {
                $this->renderHTML();
            }
        } else if(REQUEST->method == POST) {
            $this->postReq();
        }
        
    }

    public function sendJSON() {
        RESPONSE->addData("msg","404");
    }

    public function renderHTML() {
        require_once(PAGE_NOT_FOUND_404);
    }  

    public function postReq(){
        RESPONSE->addData("msg","Not Allowed");
    }
}

?>