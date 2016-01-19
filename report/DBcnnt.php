<?php
	Shost = "127.0.0.1";
	$usernmae = "root";
	$pswd = "";
	$db = "3shop";
	$connection = mysql_connect($host, $username, $pswd);
	if(!$connection){
		$msg = '無法建立連線.'.'<br />';
		$msg .= '錯誤號碼 : '.mysql_errno().'<br />';
		$msg .= '錯誤信息 : '.mysql_error().'<br />';		
		die($msg);
	}
	mysql_set_charset('utf8', $connection);
	$db_selected = mysql_select_db($db, $connection);
	if(!$db_selected){
		$msg = '無法使用'.$db.'資料庫.<br />';
		$msg .= '錯誤號碼 : '.mysql_errno().'<br />';
		$msg .= '錯誤信息 : '.mysql_error().'<br />';		
		die($msg);
	}
?>
