<?php

class Response extends helper_func {
    protected array $json_data=[];
    protected string $html_file;
    protected int $status_code = 200;
    public function __construct() {}
    public function call_view():void {
        self::fw__terminate_resources();
        http_response_code($this->status_code);
        if(REQUEST->method == GET) {
            if(REQUEST->is_http_request) {
                $this->fw__send_json();
            } else {
                // TODO: add the additional data that is required to render the html
                $this->fw__render_html();
            }
        } else if(REQUEST->method == POST) {
            $this->fw__send_json();
        }
    }
    public function fw__add_data($key, $value): void{
        $this->json_data[$key] = $value;
    }
    private function fw__send_json():void {
        self::fw__decho($this->json_data);
    }

    private function fw__render_html():void {
        require_once(VIEWS_PATH .REQUEST->page .'.richweb.php');
    }

    public function fw__set_status_code($status_code): void {
        $this->status_code = $status_code;
    }
}
?>