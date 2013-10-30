<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<?php 
/*
$DB_Server = “localhost”; 
$DB_Username = “put your user name here”; 
$DB_Password = “put your password here”; 
$DB_DBName = “put your database name here”; 
$DB_TBLName = “put your table name here”; 
*/
include ("../../conn/sqlconnect.php");

$savename = date("YmjHis"); // excel file name
//$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die(“Couldn’t connect.”); 
//mysql_query(“Set Names ‘utf-8′”);
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=".$savename.".".$file_ending); 
//header(“Pragma: no-cache”); 

//$now_date = date("Y-m-j H:i:s"); 
$title = "User Email"; 

//$sql = "SELECT entity_id, email from ".$DB_TBLName." WHERE entity_id >'0' AND entity_id<10001"; //export entity_id from 1 to 1000
//$ALT_Db = @mysql_select_db($DB_DBName, $Connect) or die(“Couldn’t select database”); 
//$result = @mysql_query($sql,$Connect) or die(mysql_error()); 
$sql = "select * from acctype";
$result = mysql_query($sql);

echo("<table><tr>$title</tr>"); 
$sep = "\t"; 
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t"; 
} 
print("\n"); 
$i = 0; 
while($row = mysql_fetch_row($result)) { 
	$schema_insert = "";
	for($j=0; $j<mysql_num_fields($result);$j++) { 
		if(!isset($row[$j])) 
			$schema_insert .= "NULL".$sep; 
		elseif ($row[$j] != "") 
			$schema_insert .= "$row[$j]".$sep;
		else 
			$schema_insert .= "".$sep; 
	} 
	$schema_insert = str_replace($sep."$", "", $schema_insert); 
	$schema_insert .= "\t"; 
	print(trim($schema_insert)); 
	print "\n"; 
	$i++; 
} 
return (true); 
echo "</table>"
?>
</body>
</html>
