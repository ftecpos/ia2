<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
	if(!empty($_GET) && isset($_GET)){
	$Le = 30;		
	$Ls = 0;
	mysql_select_db($database_conn, $conn);
	if($_GET['act']=='select'){
	$SQL="SELECT * FROM ".$_GET['tables']."";
	$rs = mysql_query($SQL, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	//$row3 = mysql_fetch_array($rs2);
	//$totalrow2 = mysql_num_rows($rs2);
	$SQL1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = '".$_GET['tables']."'";
	$rs1 = mysql_query($SQL1, $conn) or die(mysql_error());
   	$row1 = mysql_fetch_row($rs1);
	$totalrow1 = mysql_num_rows($rs1);
	
	$SQL2 = "SELECT count(*) FROM information_schema.columns WHERE table_name = '".$_GET['tables']."'";
	$rs2 = mysql_query($SQL2, $conn) or die(mysql_error());
   	$row2 = mysql_fetch_row($rs2);
	//$row3 = mysql_fetch_array($rs2);
	$totalrow2 = mysql_num_rows($rs2);
	
	$SQL3 = "SELECT * FROM ".$_GET['tables']." ORDER BY ".$row1[0]." DESC LIMIT ".$Ls." , ".$Le.""; 
	//$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";
	$rs3 = mysql_query($SQL3, $conn) or die(mysql_error());
   	$row3 = mysql_fetch_array($rs3);
	$totalrow3 = mysql_num_rows($rs3);
	}else{
	//@mysql_query($delete_SQL, $conn) or die(mysql_error());

	//$row3 = mysql_fetch_array($rs2);
	//$totalrow2 = mysql_num_rows($rs2);
	$SQL1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = '".$_GET['tables']."'";
	$rs1 = mysql_query($SQL1, $conn) or die(mysql_error());
   	$row1 = mysql_fetch_row($rs1);
	$totalrow1 = mysql_num_rows($rs1);
	
	$delete_SQL = "DELETE FROM ".$_GET['tables']." WHERE ".$row1[0]." = ".$_GET['id'];	
	//$delete_SQL = "DELETE FROM ".$_GET['tables']." WHERE ".$row1[0]." = ".$_GET['id'];	
	//echo $delete_SQL;	
	@mysql_query($delete_SQL, $conn) or die(mysql_error());
	$SQL2 = "SELECT count(*) FROM information_schema.columns WHERE table_name = '".$_GET['tables']."'";
	$rs2 = mysql_query($SQL2, $conn) or die(mysql_error());
   	$row2 = mysql_fetch_row($rs2);
	//$row3 = mysql_fetch_array($rs2);
	$totalrow2 = mysql_num_rows($rs2);
	$SQL3 = "SELECT * FROM ".$_GET['tables']." ORDER BY ".$row1[0]." DESC LIMIT ".$Ls." , ".$Le."";	 
	//$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";
	$rs3 = mysql_query($SQL3, $conn) or die(mysql_error());
   	$row3 = mysql_fetch_assoc($rs3);
	$totalrow3 = mysql_num_rows($rs3);
	
	$SQL="SELECT * FROM ".$_GET['tables']."";
	$rs = mysql_query($SQL, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	//$row3 = mysql_fetch_array($rs2);
	//$totalrow2 = mysql_num_rows($rs2);
	$SQL1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = '".$_GET['tables']."'";
	$rs1 = mysql_query($SQL1, $conn) or die(mysql_error());
   	$row1 = mysql_fetch_row($rs1);
	$totalrow1 = mysql_num_rows($rs1);
	
	$SQL2 = "SELECT count(*) FROM information_schema.columns WHERE table_name = '".$_GET['tables']."'";
	$rs2 = mysql_query($SQL2, $conn) or die(mysql_error());
   	$row2 = mysql_fetch_row($rs2);
	//$row3 = mysql_fetch_array($rs2);
	$totalrow2 = mysql_num_rows($rs2);
	
	$SQL3 = "SELECT * FROM ".$_GET['tables']." ORDER BY ".$row1[0]." DESC LIMIT ".$Ls." , ".$Le.""; 
	//$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";
	$rs3 = mysql_query($SQL3, $conn) or die(mysql_error());
   	$row3 = mysql_fetch_array($rs3);
	$totalrow3 = mysql_num_rows($rs3);
	}
	//$rs4 = mysql_query($CSQL,$conn) or die(mysql_error());
	//$row4 = mysql_fetch_assoc($rs4);
	//$totalrow4 = mysql_num_rows($rs4);

	//$rr = $row2[0];

}//end iseet
?>
</head>
<body>
	<table border="1">
<tr>
<?php
	do{
	echo "<td>".$row1[0]."</td>";	
	}while($row1 = mysql_fetch_row($rs1));
?>
</tr>

<!-------------------column-------------->
<?php
	//while($row3 = mysql_fetch_array($rs3)){
	do{
	echo "<tr>";
	for($r = 0; $r < $row2[0]; $r++){
	if($r==0){
	//echo "";
	echo "<td><input type = 'button' id = 'delete' value = '刪除' onclick = 'TableAction(".$row3[$r].")'/>".$row3[$r]."";
	echo "</td>";
	}//this.parentNode.parentNode.rowIndex
	else{ if($row3[$r] == ""){
			echo "<td>N/A</td>";
		}else{
			echo "<td>".$row3[$r]."</td>";
			}	
		}	
	}
	echo "</tr>";
?>
<?php
}while($row3 = mysql_fetch_array($rs3))
?>

	</table>
</body>
</html>
