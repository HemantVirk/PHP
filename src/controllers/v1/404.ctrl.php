<?php
$page_ctrl = New Response();
$page_ctrl->fw__add_data(STATUS, false);
$page_ctrl->fw__add_data(ERROR, '404 Not Found');
$page_ctrl->fw__set_status_code(400);
$page_ctrl->call_view();