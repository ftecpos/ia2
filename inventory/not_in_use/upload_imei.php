<?php
  require_once('../conn/sqlconnect.php');
  mysql_select_db($database_conn, $conn);
  
  if(!empty($_GET) && isset($_GET))
  {		//Insert IMEI to Datbase
		//connect to database
		$insImei_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
		if (!$insImei_conn){die('Could not connect : ' . mysql_error());}
    	mysql_select_db($database_conn, $insImei_conn);
		mysql_query("SET NAMES 'utf8'");		
		//Insert data
		//check IMEI
		$imeiArray = explode("/",$_GET['imei']);
		for($imeiCounter = 0; $imeiCounter<count($imeiArray)-1; $imeiCounter++){
			$sql = "Insert Into phone Values(null,'".$imeiArray[$imeiCounter]."',".$_GET['pno'].",".$_GET['rshop'].",2,".$_GET['podno'].",'".$_GET['date']."');";
			if(!mysql_query($sql,$insImei_conn)) {die('Error: '.mysql_error());}
		}
		mysql_close($insImei_conn);
}
?>
<html>
<head>
<title>Display Result</title>
</head>
<body>
</body>
</html>