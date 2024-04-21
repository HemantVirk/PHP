<?php

function convertToJSON($data)
{
    if (isset($data)) {
        return (json_encode($data, JSON_PRETTY_PRINT));
    } else {
        return json_encode("{'eer':'undefined variable'}");
    }
}
