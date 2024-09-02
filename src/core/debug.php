<?php
class Debug{

     public $result;
     private $debug_enable;
     
     public function __construct() {
        $this->result = new stdClass();
        $this->debug_enable = Config::$debug_enable;
     }
 
 
      function fw__add_log($tag,...$messages){
          if(!$this->debug_enable)
              return;

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
 
      function fw__display_log(){
          if(!$this->debug_enable)
              return;

         print(fw__convert_to_json($this->result));
     }

 }