<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
</head>
<body>
<?php
  require_once('../conn/sqlconnect.php');
	$select_staff = "SELECT * FROM staff, stafftype where staff.staffType_no = stafftype.staffType_no order by staff_no";
	$staff_for_row = mysql_query($select_staff, $conn) or die(mysql_error());
	$totalRows_staff_for_row = mysql_num_rows($staff_for_row);
	
	// add new staff type of the staff
 	if(!empty($_GET) && isset($_GET)){
 		$nt_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
		mysql_query("SET NAMES 'utf8'");
		if (!$nt_conn){die('Could not connect : ' . mysql_error());}
		mysql_select_db($database_conn, $nt_conn);
		
		// update staff data into database
		if ($_GET["x"]=="3"){
			//update data sql code
			if($_GET["d"]==""){
				$sql="update staff set staff_id=\"".$_GET["b"]."\", name=\"".$_GET["c"]."\", staffType_no=".$_GET["e"]." where staff_no=".$_GET["a"];
			}	else	{
				$sql="update staff set staff_id=\"".$_GET["b"]."\", name=\"".$_GET["c"]."\", pwd=\"".$_GET["d"]."\", staffType_no=".$_GET["e"]." where staff_no=".$_GET["a"];
			}
			echo "<!--".$sql."-->";
			if(!mysql_query($sql,$nt_conn)) {die('Error: '.mysql_error());}
			mysql_close($nt_conn);
		}
		
		// select target staff data for display on page ( change sql code )
		if ($_GET["x"]=="4"){
			if($_GET["a"]!=""){
				$select_staff = "SELECT * FROM staff, stafftype where staff.staffType_no = stafftype.staffType_no and ".$_GET["b"]." like '%".$_GET["a"]."%' order by staff_no";
			}
		}
	}

	//open table staff join stafftype
	//echo $select_staff;
	$staff = mysql_query($select_staff, $conn) or die(mysql_error());
	$staff_data = mysql_fetch_assoc($staff);
	$totalRows_staff = mysql_num_rows($staff);
	
	//Open table "stafftype"
	$select_stafftype = "SELECT * FROM stafftype";
	$stafftype = mysql_query($select_stafftype, $conn) or die(mysql_error());
	$stafftype_data = mysql_fetch_assoc($stafftype);
	$totalRows_stafftype = mysql_num_rows($stafftype);

	$typeNumber = array();
	$typeString = array();
	$looper_type = 0;
	do{
		$typeNumber[$looper_type]=$stafftype_data['staffType_no'];
		$typeString[$looper_type]=$stafftype_data['typeName'];
		$looper_type++;
	}while($stafftype_data = mysql_fetch_assoc($stafftype));
?>
請輸入關鍵字:<form method="post">
<span id="keybox"><input type="text" name="key" id="key"/></span>
<select name="keytype" id="keytype">
<option value="staff_no" selected>No.</option>
<option value="staff_id">ID</option>
<option value="name">名稱</option>
<option value="typeName">職位</option>
</select>
<input type="button" name="searcher" onClick="search_staff()" value="搜尋">
</form>
<!-- total row of result display with text box -->
<?php print("--資料共有".$totalRows_staff."項--"); ?>
<table height="10" border="1">
  <tr>
    <td></td><td>No.</td><td>ID</td><td>名稱</td><td>職位</td><td width="45px"></td>
  </tr>
<?php
do{
	$currentType="";
	print("<tr>
		<form method=\"post\">
		<td align=\"center\"><input type=\"button\" value=\"修改\" onclick=\"getStaInfo(".$staff_data['staff_no'].")\"></td>
		<td>".$staff_data['staff_no']."</td>
		<td>".$staff_data['staff_id']."<input type=\"hidden\" id=\"staid".$staff_data['staff_no']."\" value=\"".$staff_data['staff_id']."\"></td>
		<td>".$staff_data['name']."<input type=\"hidden\" id=\"stana".$staff_data['staff_no']."\" value=\"".$staff_data['name']."\"></td>"
		);
	for($q=0;$q<$looper_type;$q++){
		if($staff_data['staffType_no']==$typeNumber[$q]){
			$currentType=$typeString[$q];
		}
	}
	print("<td>".$currentType."<input type=\"hidden\" id=\"statn".$staff_data['staff_no']."\" value=\"".$staff_data['staffType_no']."\"></td></form>");
	print("<td><span id=\"msgSucc".$staff_data['staff_no']."\"><font color=\"blue\">無修改</font></span></td></tr>");
}while($staff_data = mysql_fetch_assoc($staff));
?>
</table>
</body>
</html>