<?php

require_once(MODULES_ROOT . "news" . DS . "news.model.php");

class NewsCtrl extends ResponseTemplate
{
    private NewsModel $_newsModel;

    public function __construct()
    {
        $this->initDB();

        $this->_newsModel = new NewsModel();

        parent::__construct();
    }

    #[\Override]
    public function setData()
    {
        $this->addData("news_list", $this->_newsModel->getNewsList());   
    }

    public function fun_insert_news()
    {
        $this->_newsModel->fun_insert_news();
    }

    public function get_insert_news()
    {
        var_dump($this->_newsModel->get_insert_news());
    }
}
