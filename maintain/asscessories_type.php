<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php');?>
<?php
	echo "<select name = 'atype' id = 'atype'>";
	mysql_select_db($database_conn, $conn);
	//$sql = "SELECT name FORM asscessoriestype";
	$sql = "SELECT Name FROM asscessoriestype";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	//echo "<option></option>";
	do{
	if($totalrow == 0) break;
	echo "<option> ".$row['Name']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
