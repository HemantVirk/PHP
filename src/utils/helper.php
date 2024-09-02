<?php
require_once CONFIG_PATH . 'config-web.php';
require_once(SERVICES_PATH."read-database.services.php");
class helper_func extends core_func {

    public static function fw__convert_to_json($data):string {
        if(isset($data)){
            return (self::fw__json_encode($data));
        } else {
            return self::fw__json_decode("{'err':'undefined variable'}");
        }
    }

    public static function fw__get_path_from_url($url):string {
        if(!is_string($url)) $url = (string)$url;

        $path_segment = parse_url($url, PHP_URL_PATH);
        if(self::fw__mb_substr($path_segment, -1) != '/') {
            $path_segment .= '/';
        }

        return $path_segment;
    }

    public static function fw__get_path_segments_from_url($url):array {
        if(!is_string($url)) $url = (string)$url;

        $url_path = self::fw__clean_slash_from_url($url);
        if(empty($url_path)) {
            return [];
        }
        return self::fw__explode($url_path, '/');
    }

    public static function fw__clean_slash_from_url(string $url): string{
        return self::fw__trim($url, '/');
    }

    public static function fw__terminate_resources():void {
        if (defined('WRITE_CONN')) {
            WRITE_CONN->disconnect();
        }

        if (defined('READ_CONN')) {
            READ_CONN->disconnect();
        }

        if (defined('DB_CONN')) {
            DB_CONN->disconnect();
        }
    }

    public static function fw__die():void {
        self::fw__terminate_resources();
        die();
    }
}
