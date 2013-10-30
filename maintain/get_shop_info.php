<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
	function b(ss,s) {
var r = 0;
var geno = ss;
var geid;
var geaddr;
var gephone;
var gefax;
var geemail;
var gelocation;
    //if (!document.getElementsByTagName || !document.createTextNode) return;
   var row = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    var cells = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('td');
    
    //cells[0].onclick = function(){alert(cellsIndex);}
    
   // for (i = 0; i < row.length; i++) {
      //  row[i].onclick = function() { 
     
			r = s;
			geid =  row[r].cells[1].innerHTML;
			geaddr  = row[r].cells[3].innerHTML;
			gephone  = row[r].cells[4].innerHTML;
			gefax = row[r].cells[5].innerHTML;
			geemail  = row[r].cells[6].innerHTML;
			gelocation  = row[r].cells[2].innerHTML;
			showWindow_shop(geid,geaddr,gephone,gefax,gelocation,geemail,geno);
     //   }
    //}
}
	
</script>
</head>
<table width = "100%" border="1" id = "showdata">
	<tr>
    	<td>行動</td>
		<td>編碼</td>
		<td>地區</td>
		<td>地址</td>
		<td>電話</td>
		<td>傳真</td>
		<td>電郵</td>
	</tr>
<?php				
	mysql_select_db($database_conn, $conn);
	
	if(!empty($_GET) && isset($_GET)){		
	$Le = 10;		
	$Ls = $_GET['ls'];
	$nowpage = $Ls;
	$Ls = ($Ls - 1) * 10;

	if($_GET['act'] == 'update'){
			$SQL_update = "UPDATE retailShop SET addr = '".$_GET['a']."' , phone =".$_GET['p'].", fax = ".$_GET['f'].", email = '".$_GET['e']."',retail_id = '".$_GET['id']."',location = '".$_GET['l']."' WHERE retailShop_no = ".$_GET['no'];
			@mysql_query($SQL_update,$conn) or die (mysql_error());
			$SQL = "SELECT * FROM retailshop LIMIT 0,10"; 
			$CSQL = "SELECT * FROM retailshop";
			
	}else if ($_GET['act'] == 'insert'){
	mysql_select_db($database_conn, $conn);
	$SQL = "SELECT IFNULL(MAX(retailShop_no),0)+1 as retailShop_no FROM retailshop";  
    $rs = mysql_query($SQL, $conn) or die(mysql_error());
    $row = mysql_fetch_assoc($rs);
    $next = $row['retailShop_no'];
	
    $SQL_insert = "INSERT INTO retailshop (retailShop_no,retail_id,addr,phone,fax,email,location)VALUES
    (".$next.",'".$_GET['shopid']."','".$_GET['shopaddr']."',".$_GET['shoptele'].",".$_GET['shopfax'].",'".$_GET['email']."','" .$_GET['location']."')";
	
	@mysql_query($SQL_insert, $conn) or die(mysql_error());
	$SQL = "SELECT * FROM retailshop LIMIT 0,10"; 
	$CSQL = "SELECT * FROM retailshop";
	}else if($_GET['act'] == 'select'){
	$SQL = "SELECT * FROM retailshop LIMIT ".$Ls.",".$Le.""; 
	$CSQL = "SELECT * FROM retailshop";	
	}
	}else{
	$SQL = "SELECT * FROM retailshop LIMIT 0,10"; 
	$CSQL = "SELECT * FROM retailshop";
	$nowpage = 1;
	}
	
	$rs = mysql_query($SQL, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	
	$rs2 = mysql_query($CSQL,$conn) or die(mysql_error());
	$row2 = mysql_fetch_assoc($rs2);
	$totalrow2 = mysql_num_rows($rs2);
	
	$totalpage = (int)($totalrow2/10);
	$totalpage2 = $totalrow2 % 10;
	if ($totalpage2 >0 && $totalpage <10){
	$totalpage2 = 1;
	}
	$pageno = $totalpage + $totalpage2;
	//$nowpage = 1;
	
	echo "<script>";
	echo "var tp = '".$pageno."';";
	echo "</script>";
	do{
	if($totalrow == 0){echo"資料不存在";break;}
?>
	<tr>
	<td><?php echo $row['retailShop_no']; echo "<input type = 'button' value = '修改' onclick = 'b(".$row['retailShop_no'].",this.parentNode.parentNode.rowIndex)'/>"; ?></td>
    	<td><?php echo $row['retail_id']; ?></td>
    	<td><?php echo $row['location']; ?></td>
    	<td><?php echo $row['addr']; ?></td>
	<td><?php echo $row['phone']; ?></td>
	<td><?php echo $row['fax']; ?></td>
    	<td><?php echo $row['email']; ?></td>
	</tr>
<?php
	}while($row = mysql_fetch_assoc($rs))
?>
	<tr>
			<td colspan="8">
			<p align="right">
			<input type = "button" value = "<" onclick = "fm3()"/>
			<label id = "page"><?php echo $nowpage; ?></label>
			<input type = "button" value = ">" onclick = "bk3()"/>
			<input type = "text" size = "10" id = "topage" onkeypress="keypress(event)"/>
			共有<label id = "totalpage"><?php echo $pageno; ?></label>頁</p>
			</td>
	</tr>
</table>
<body>
</body>
</html>