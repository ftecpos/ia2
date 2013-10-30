<?php
require ("../../conn/sqlconnect.php");

switch($_GET['action']){

		case "insert":
		$new_typeName = $_GET['type_Name'];
		$sql = "insert into stafftype(typeName) values('".$new_typeName."');";
		mysql_query($sql);
		break;
		
		case "update":
		$update_typeName = $_GET['type_Name'];
		$type_no = $_GET['type_no'];
		$sql = "update stafftype set typeName ='".$update_typeName."' where staffType_no =".$type_no.";";
		mysql_query($sql);
		break;
}
?>