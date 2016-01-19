<?php require_once('Connections/conn.php');?>
<?php
	echo "<select id = 'showAllTable'>";
	mysql_select_db($database_conn, $conn);
	//$sql = "SELECT name FORM asscessoriestype";
	$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '3shop'";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	//echo "<option></option>";
	do{
	if($totalrow == 0) break;
	echo "<option> ".$row['TABLE_NAME']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
