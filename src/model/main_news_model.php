<?php
require_once($model_path ."data_model.php");
class main_news_model extends data_model
{
    public function fun_insert_news()
    {
        $sql = "INSERT INTO aunt_rossy.news(news_id, heading, full_content, source) VALUES (?, ?, ?, ?)";
        $params = [
            "2",
            "Example heading 2",
            "Example full content",
            'TOI'
        ];
        return data_model::executeQuery($sql, $params);

    }
    public function get_insert_news() {
        $sql = "SELECT * FROM aunt_rossy.news";
        $res = data_model::selectQuery($sql);
    }
}
?>