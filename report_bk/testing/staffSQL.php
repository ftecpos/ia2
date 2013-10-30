<?php 
session_start;
require ("../../conn/sqlconnect.php");

switch($_GET['action']){
	case "insert":
		$id = $_GET['id'];
		$name = $_GET['name'];
		$pswd = $_GET['pswd'];
		$staffType = $_GET['staffType'];		
		$sql = "insert into staff(staff_id,pwd,name,staffType_no) values('".$id."','".$pswd."','".$name."','".$staffType."');";
		mysql_query($sql);
		break;
				
	case "update":
		$edit_staff_no = $_GET['esno'];
		$edit_staff_id = $_GET['esid'];
		$edit_staffName = $_GET['esname'];
		$edit_staff_pswd = $_GET['espwsd'];
		$edit_staff_type = $_GET['estypeno'];
		//$sql = "update staff set staff_id ='".$edit_staff_id."', name ='".$edit_staffName."', pwd = '".$edit_staff_pswd."', staffType_no =".$edit_staff_type." where staff.staff_no = ".$edit_staff_no;
		$sql = "update staff set staff_id ='".$edit_staff_id."', name ='".$edit_staffName."', pwd = '".$edit_staff_pswd."',  staffType_no =".$edit_staff_type." where staff.staff_no = ".$edit_staff_no;
		mysql_query($sql);
		break;		
		
}
	
?>
