<?php
global $USER, $SHOP;
session_start();
$USER = &$_SESSION['USER'];
$SHOP = &$_SESSION['SHOP'];

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

function print_object($object){
    echo '<pre>';
    print_r($object);
    echo '</pre>';
}

function require_login(){
    global $USER;
    if(isset($USER) and $USER){
        return true;
    }
    return false;
}

function require_office(){
    global $SHOP;
    if(!check_shop_data()){
        return false;
    }
    if($SHOP->retailno == 1){
        return true;
    } else {
        return false;
    }
}

function check_shop_data(){
    global $SHOP;
    if(isset($SHOP) and $SHOP){
        return true;
    }
    return false;
}