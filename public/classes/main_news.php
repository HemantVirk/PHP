<?php
require_once($model_path."main_news_model.php");
class main_news
{
    protected $model;
    public function __construct(){
        $this->model = new main_news_model();
    }
    public function fun_insert_news() {
        $this->model->fun_insert_news();
    }
    public function get_insert_news() {
        var_dump($this->model->get_insert_news());
    }
}

?>