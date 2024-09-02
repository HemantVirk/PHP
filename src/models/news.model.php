<?php
class NewsModel
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
        return DATABASE->executeQuery($sql, $params);
    }
    public function get_insert_news()
    {
        $sql = "SELECT * FROM aunt_rossy.news";
        $res = DATABASE->selectQuery($sql);
    }
}
