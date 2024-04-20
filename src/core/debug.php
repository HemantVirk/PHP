<?php
class Debug{

     public $result;
     
     public function __construct() {
        $this->result = new stdClass(); 
     }
 
 
      function addLog($tag,...$messages){
         if(isset($messages) && sizeof($messages)>0){
             if(sizeof($messages) ==1) {
                $this->result->$tag = $messages[0];
             } else {
                $this->result->$tag = $messages;
             }
         } else {
            $this->result->{LOG}=$tag;
         }
             
     }
 
      function log(){
         print(convertToJSON($this->result));
     }
 }

 define("DEBUG", new Debug())
 
?>