<?php require_once('Connections/conn.php');?>
<?php
	echo "<select name = 'etype' id = 'etype'>";
	/*
   require_once('Connections/conn.php');
   mysql_select_db($database_conn, $conn);
  $sql = "SELECT asscessoriestype_no,name FROM asscessoriestype";
   $rs = mysql_query($sql, $conn) or die(mysql_error()); 
  $row = mysql_fetch_assoc($rs); 
 $totalrow = mysql_num_rows($rs); 
  
 do{ if($totalrow == 0) break; 
 if($_GET['q'] == $row['name']){
echo "<option value = ".$row['asscessoriestype_no']." selected>".$row['name']."</option>";
 }else{
 echo "<option value = ".$row['asscessoriestype_no'].">".$row['name']."</option>";
}
 }while($row = mysql_fetch_assoc($rs)); 
	 * 
	 */
	echo "<option>fuck</option>";
echo "</select>"; 
?>
