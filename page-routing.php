<?php
$request_uri = strtok($_SERVER['REQUEST_URI'], '?');
$sub_route_array = array_filter(explode('/', $request_uri));
$final_sub_route_array = [];
foreach ($sub_route_array as $key => $value) {
    $final_sub_route_array[] = $value;
}

$page = '';
$route = '';
$sub_route = '';
if (count($final_sub_route_array) > 1) {
    $route = $final_sub_route_array[0];
    $sub_route = $final_sub_route_array[1];
} elseif (count($final_sub_route_array) == 1) {
    $route = $final_sub_route_array[0];
}

if ($route == 'api') {
    if ($sub_route == 'main-news') {
        $page = 'main-news';
    }
}

if (!empty($page)) {
    $page = 'public/'.$route."/".$page.'.php';
    
    if (file_exists($page)) {
        include $page;
    } else {
        include '404.php';
    }
} else {
    include '404.php';
}


?>