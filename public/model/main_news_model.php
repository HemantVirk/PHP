<?php
require_once($model_path ."data_model.php");
class main_news_model extends data_model
{
    public function fun_insert_news()
    {
        $sql = "INSERT INTO aunt_rossy.news(news_id, heading, full_content, source) VALUES (?, ?, ?, ?)";
        $params = [
            "1",
            "Example heading 1",
            "Example full content",
            'TOI'
        ];
        return data_model::executeQuery($sql, $params);

    }
}
?>