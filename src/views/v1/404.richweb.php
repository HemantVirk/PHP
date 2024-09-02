<?php
echo <<<END
<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
    <style>
        body {
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-size: 2em;
        }
        img {
            height: 400px;
        }
    </style>
</head>
<body>
    <img src='/assets/img/404.png' alt='404 Not Found'>
    <h1>404 Not Found</h1>
    <p>The requested URL was not found on this server.</p>
</body>
</html>

END;
