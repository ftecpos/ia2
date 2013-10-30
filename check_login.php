<?php
		session_start();
	if(!isset($_SESSION['staff_no'])){
		header('location:../no_login.html');
	} else if(!isset($_SESSION['staff_id'])){
		header('location:../no_login.html');
	} else if(!isset($_SESSION['retail_id'])){
		header('location:../no_login.html');
	} else if(!isset($_SESSION['retail_no'])){
		header('location:../no_login.html');
	}
?>