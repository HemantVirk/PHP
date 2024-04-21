<?php
class NewsModel
{
   
    public function getNewsList() : array {

        $newsList = array();

        $sql = "SELECT * FROM afwaah.news limit 10;";
        $queryResult = DATABASE->select($sql);

        if($queryResult->status) {
            $newsList = $queryResult->data;
        }

        return $newsList;
    }
}
