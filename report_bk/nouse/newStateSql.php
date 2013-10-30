<?php
require ("../../conn/sqlconnect.php");

// insert an invoice state record.
if(isset($_GET['invState'])){
	$sql_query = "insert into invoicestate(invoiceStateName) value ('".$_GET['invState']."')";
	mysql_query($sql_query);
}

// insert a PO state record.
if(isset($_GET['poState'])){
	$sql_query = "insert into postate(stateName) value ('".$_GET['poState']."')";
	mysql_query($sql_query);
}

// insert a product state record.
if(isset($_GET['prodState'])){
	$sql_query = "insert into productstate(stateName) value ('".$_GET['prodState']."')";
	mysql_query($sql_query);
}

// insert a phone state record.
if(isset($_GET['phoneState'])){
	$sql_query = "insert into phonestate(phoneStateName) value ('".$_GET['phoneState']."')";
	mysql_query($sql_query);
}

// insert a transfer state record.
if(isset($_GET['transState'])){
	$sql_query = "insert into transstate(stateName) value ('".$_GET['transState']."')";
	mysql_query($sql_query);
}
?>
