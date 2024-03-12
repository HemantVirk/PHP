<?php
require_once($model_path."main_news_model.php");
class main_news
{
    protected $model;
    public function __construct(){
        $this->model = new main_news_model();
    }
}

?>