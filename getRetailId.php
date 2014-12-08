<?php
require_once('conn/sqlconnect.php');
require_once('conn/db_include.php');

	$retail_id =$_GET['shopid'];
	$retail_no = $_GET['shopno'];

	$_SESSION['retail_id']=$retail_id;
	$_SESSION['retail_no']=$retail_no;
//print_object($_SESSION);
    $shopobj = new stdClass();
    $shopobj->retailid = $retail_id;
    $shopobj->retailno = $retail_no;
    $_SESSION['SHOP'] = $shopobj;

