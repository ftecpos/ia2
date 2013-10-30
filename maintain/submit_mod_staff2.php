<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
</head>
<body>
<?php
  require_once('../conn/sqlconnect.php');
	if(!empty($_GET) && isset($_GET)){
 		$nt_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
		mysql_query("SET NAMES 'utf8'");
		if (!$nt_conn){die('Could not connect : ' . mysql_error());}
		mysql_select_db($database_conn, $nt_conn);
		
		if($_GET["x"]=="1"){
			//insert new type
			$ntsql="Insert Into stafftype Values(null,'".$_GET["a"]."',null)";
			if(!mysql_query($ntsql,$nt_conn)) {die('Error: '.mysql_error());}
			mysql_close($nt_conn);
		}
		
  		// modify or drop staff type of the staff
		if ($_GET["x"]=="2"){
			//update type
			$ntsql="UPDATE stafftype SET typeName = '".$_GET["b"]."' WHERE  staffType_no = ".$_GET["a"].";";
			if(!mysql_query($ntsql,$nt_conn)) {die('Error: '.mysql_error());}
			mysql_close($nt_conn);
		}
	}
	
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
    <form method="post">
	  輸入職位名稱 : 
	  <input type="text" name="new_type" id="new_type" onKeyUp="check_nt()"/>
	  <input type="button" name="add_type" id="add_type" value="新增" onClick="submit_new_type()" disabled/>
	</form>
	<form>
	  請選擇需要變更名稱的職位 : <br>
	  <select name="nType" id="nType"><span id="typeselect">
<?php
	$tString="";
  	for($p=0;$p<$looper_type;$p++){
		print("<option value=\"".$typeNumber[$p]."\">".$typeString[$p]."</option>
");
	}
	echo "</span></select><input type=\"hidden\" id=\"selectTotal\" value=\"".$looper_type."\"/>";
	for($p2=0;$p2<$looper_type;$p2++){
		print("<input type=\"hidden\" id=\"type".$typeNumber[$p2]."\" value=\"".$typeString[$p2]."\"/>");
	}
?>
       改為
	  <input type="text" name="mntype" id="mntype" />
	  <input type="button" name="ctype" id="ctype" value="修改" onClick="submit_mod_type()"/>
	</form>
</body>
</html>