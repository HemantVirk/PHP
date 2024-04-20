<?php

function convertToJSON($data){
    if(isset($data)){
        return (json_encode($data));
    } else {
        return json_decode("{'eer':'undefined variable'}");
    }
}

?>