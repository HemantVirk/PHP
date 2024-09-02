<?php
require_once(MODELS_PATH . "news.model.php");
class NewsCtrl extends Response
{
    protected $default_model;

    public function __construct()
    {
        $this->default_model = new NewsModel();
    }

    public function main(): void {
        $this->fw__add_data('hello', 'world');
        $this->call_view();
    }

}
$news_ctrl = new NewsCtrl();
$news_ctrl->main();

