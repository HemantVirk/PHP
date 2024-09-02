<?php

error_reporting(0);
@ini_set('display_errors', 0);
http_response_code(503);

//rotuer details
$page = '/conn-error';
$title_stub = "Connection Error";
$target_url = isset($_GET['target']) ? $_GET['target'] : "/";
$view_data['ref'] = $target_url;
$refresh_url = $target_url;
$ga_tracking_url = '/conn-error'.$target_url;;

$view_data['status'] = false;
$view_data['errors'] = 'Server Down';
$viewtype = null;
if((isset($_GET['format']) && $_GET['format'] == 'json')) {
    $viewtype = 'json';
}

if($viewtype == 'json') {
    echo json_encode($view_data);
} else { ?>
    <section class="fund-page-section vr-error-page mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2 text-center">
                    <div class="mt-5 mb-5">
                        <div class="text-center sitelogo mb-5">
                            <a href="/">
                            </a>
                        </div>
                        <h3 class="error-text mt-5">under scheduled maintainence</h3>
                        <h5 class="h5--sub-heading mt-4"><a href="<?php echo $view_data['ref']; ?>"><?php echo 'please check if it is up'?></a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} ?>