<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_GET) && !empty($_GET)){
echo "<select name = 'etype' id = 'etype'>";

   mysql_select_db($database_conn, $conn);
  $sql = "SELECT accType_no,typeName FROM acctype";
   $rs = mysql_query($sql, $conn) or die(mysql_error()); 
  $row = mysql_fetch_assoc($rs); 
 $totalrow = mysql_num_rows($rs); 
  
 do{ if($totalrow == 0) break; 
 if($_GET['q'] == $row['typeName']){
echo "<option value = ".$row['accType_no']." selected>".$row['typeName']."</option>";
 }else{
 echo "<option value = ".$row['accType_no'].">".$row['typeName']."</option>";
}
 }while($row = mysql_fetch_assoc($rs)); 
echo "</select>";
}
?>
</body>
</html>
