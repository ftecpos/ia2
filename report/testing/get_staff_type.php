
<?php
require_once('../../conn/sqlconnect.php');

if(isset($_GET) && !empty($_GET)){
	$stn = $_GET['stn'];
	echo "<select name = 'edit_stype' id = 'edit_stype'>";
   //mysql_select_db($database_conn, $conn);
  $sql = "SELECT staffType_no, typeName FROM stafftype";
   $rs = mysql_query($sql); 
  $row = mysql_fetch_assoc($rs); 
 $totalrow = mysql_num_rows($rs); 
  
 do{ if($totalrow == 0) break; 
 if($_GET['stn'] == $row['staffType_no']){
echo "<option value = ".$row['staffType_no']." selected>".$row['typeName']."</option>";
 }else{
 echo "<option value = ".$row['staffType_no'].">".$row['typeName']."</option>";
}
 }while($row = mysql_fetch_assoc($rs)); 
echo "</select>";

}
?>

