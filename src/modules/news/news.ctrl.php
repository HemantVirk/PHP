<?php

require_once(MODULES_ROOT . "news" . DS . "news.model.php");

class NewsCtrl extends ResponseTemplate
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new NewsModel();
    }

    #[\Override]
    public function setData()
    {
        $this->addData("news", "bsaudh");
    }

    public function fun_insert_news()
    {
        $this->model->fun_insert_news();
    }

    public function get_insert_news()
    {
        var_dump($this->model->get_insert_news());
    }
}
