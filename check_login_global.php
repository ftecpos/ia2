<?php
require ("conn/db_include.php");


if(!isset($_SESSION['staff_no'])){
    $url = $CFG->wwwroot."/ia2/no_login.html";
    echo 1;
    echo $url;
    die;
    header("Location:$url");
} else if(!isset($_SESSION['staff_id'])){
    $url = $CFG->wwwroot."/ia2/no_login.html";
    header("Location:$url");
} else if(!isset($_SESSION['retail_id'])){
    $url = $CFG->wwwroot."/ia2/no_login.html";
    header("Location:$url");
} else if(!isset($_SESSION['retail_no'])){
    $url = $CFG->wwwroot."/ia2/no_login.html";
    header("Location:$url");
}
