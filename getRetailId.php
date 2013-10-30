<?php
	require_once('conn/sqlconnect.php');
		session_start();
	if(!isset($_SESSION['staff_no'])){
		header('location:no_login.html');
	} else if(!isset($_SESSION['staff_id'])){
		header('location:no_login.html');
	} else if(!isset($_SESSION['retail_id'])){
		header('location:no_login.html');
	} else if(!isset($_SESSION['retail_no'])){
		header('location:no_login.html');
	}
?>

<?php include ("conn/db_include.php");
	   session_start();
?>

<?php
	
	$retail_id =$_GET['shopid'];
	$retail_no = $_GET['shopno'];
	$_SESSION['retail_id']=$retail_id;
	$_SESSION['retail_no']=$retail_no;



?>
