<?php

require_once(MODULES_ROOT . "news" . DS . "news.ctrl.php");

if (REQUEST->path == "/news") {
    new NewsCtrl();
}

new ResponseTemplate();
