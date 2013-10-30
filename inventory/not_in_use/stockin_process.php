<?php
  require_once('../conn/sqlconnect.php');
	//insert data to po & stockin
	$xv=999;
	$sql="null";
	if(!empty($_GET) && isset($_GET)){
 		$sub_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
		mysql_query("SET NAMES 'utf8'");
		if (!$sub_conn){die('Could not connect : '.mysql_error());}
		mysql_select_db($database_conn, $sub_conn);
		if($_GET['x']==0){
			$sql="update po set poState_no=".$_GET['e']." where po_no=".$_GET['b'].";";
		} else {
			$sql="insert into stockin values(".$_GET['a'].",".$_GET['b'].",".$_GET['c'].",".$_GET['d'].",".$_GET['rshopno'].",".$_GET['e'].",'".$_GET['f']."','".$_GET['g']."',".$_GET['h'].",".$_GET['e'].");";
		}
		if(!mysql_query($sql,$sub_conn)) {die('Error: '.mysql_error());}
		mysql_close($sub_conn);
	}
?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<input type="hidden" id="sql" value="<?php echo $sql;?>"/>
</body>
</html>