<?php

function optional_param($parname, $default) {
    if (!isset($default)) {
        $default = null;
    }

    if (isset($_POST[$parname])) {       // POST has precedence
        $param = $_POST[$parname];
    } else if (isset($_GET[$parname])) {
        $param = $_GET[$parname];
    } else {
        return $default;
    }
    return $param;
}

function print_error($msg) {
    $output = new stdClass();
    $output->error = $msg;
    echo tojson($output);
    die();
}

function print_json($msgarray) {
    foreach ($msgarray as $key => $msg){
        $output = new stdClass();
        $output->$key = $msg;
        echo tojson($output);
    }
}

function tojson($objmsg){
    return json_encode($objmsg);
}