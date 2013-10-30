<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php');?>
<?php
mysql_select_db($database_conn, $conn);
if(!empty($_GET) && isset($_GET)){
	$SQL = "SELECT phonetype_id FROM phonetype WHERE phonetype_id = '".$_GET['id']."'";
	$rs = mysql_query($SQL, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	
	if($totalrow == 0){
		echo "";
	}
	else{
		echo "產品編號己存在";
	}
}
?>