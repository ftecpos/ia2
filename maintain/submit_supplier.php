<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
</head>
<body>
<?php
  require_once('../conn/sqlconnect.php');
  $select_supplier = "SELECT * FROM supplier where hide = '0' order by supplier_no";
  $checkd="";
 if(isset($_GET['type'])){
  if($_GET['type']=="delete"){
	  $sql_query="DELETE FROM supplier WHERE `supplier_no` = '".$_GET['getid']."'";
	  mysql_query($sql_query);
	echo "hihi";
		
	  }
  }
  
  
 	if(!empty($_GET) && isset($_GET)){
 		if($_GET["x"]==1){
			if($_GET["b"]=="hide"){
	    		$select_supplier = "SELECT * FROM supplier where hide = '1' order by supplier_no";
				$checkd="checked";
			} else {
	  			if($_GET["a"]!=""){
	    			$select_supplier = "SELECT * FROM supplier where hide = '0' and ".$_GET["b"]." like '%".$_GET["a"]."%' order by supplier_no";
	  			}
			}
		}
 
 		if($_GET["x"]==2){
    		$upd_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
			mysql_query("SET NAMES 'utf8'");
			if (!$upd_conn){die('Could not connect : ' . mysql_error());}
    		mysql_select_db($database_conn, $upd_conn);

			//update data
			if($_GET["i"]=="true"){
				$sqlh = ", hide = \"1\" ";
			} else {
				$sqlh = ", hide = \"0\" ";
			}
			
			if($_GET["h"]==""){
	  			$sql="update supplier set supplier_id=\"".$_GET["b"]."\", supplierName=\"".$_GET["c"]."\",addr=\"".$_GET["d"]."\",phone=\"".$_GET["e"]."\",fax=\"".$_GET["f"]."\",email=\"".$_GET["g"]."\",remark=\"".$_GET["h"]."\"".$sqlh."  where supplier_no=".$_GET["a"];
			}else {
	  			$sql="update supplier set supplier_id=\"".$_GET["b"]."\", supplierName=\"".$_GET["c"]."\",addr=\"".$_GET["d"]."\",phone=\"".$_GET["e"]."\",fax=\"".$_GET["f"]."\",email=\"".$_GET["g"]."\",remark=\"".$_GET["h"]."\"".$sqlh."  where supplier_no=".$_GET["a"];
			}
			echo "<!--".$sql."-->";
						if(!mysql_query($sql,$upd_conn)) {die('Error: '.mysql_error());}
			mysql_close($upd_conn);
			

  		}
  	}
	//open table supplier
	$supplier = mysql_query($select_supplier, $conn) or die(mysql_error());
	$supplier_data = mysql_fetch_assoc($supplier);
	$totalRows_supplier = mysql_num_rows($supplier);
	
  	//total row of result display with text box
	echo "<p>--資料共有".$totalRows_supplier."項--";
?>
<table height="10" width="1000px" border="1">
  <tr>
    <td>修改/刪除</td><td>No.</td><td>ID</td><td>名稱</td><td>地址</td><td>電話</td><td>傳真</td><td>電郵</td><td>數期</td>
  </tr>
<?php
  do {
  //print("<!--".$row."-->");
  print("
  <tr>
    <form method=\"post\">
      <td align=\"center\"><input type=\"button\" value=\"修改\" onclick=\"getSuppInfo(".$supplier_data['supplier_no'].")\"/><input type=\"button\" value=\"刪除\" onclick=\"delrecord(".$supplier_data['supplier_no'].")\"/></td>
      <td>".$supplier_data['supplier_no']."<input type=\"hidden\" id=\"supno".$supplier_data['supplier_no']."\" value=\"".$supplier_data['supplier_no']."\"></td>
	  <td>".$supplier_data['supplier_id']."<input type=\"hidden\" id=\"supid".$supplier_data['supplier_no']."\" value=\"".$supplier_data['supplier_id']."\"></td>
	  <td>".$supplier_data['supplierName']."<input type=\"hidden\" id=\"supna".$supplier_data['supplier_no']."\" value=\"".$supplier_data['supplierName']."\"></td>
	  <td>".$supplier_data['addr']."<input type=\"hidden\" id=\"supad".$supplier_data['supplier_no']."\" value=\"".$supplier_data['addr']."\"></td>
      <td>".$supplier_data['phone']."<input type=\"hidden\" id=\"supte".$supplier_data['supplier_no']."\" value=\"".$supplier_data['phone']."\"></td>
	  <td>".$supplier_data['fax']."<input type=\"hidden\" id=\"supfa".$supplier_data['supplier_no']."\" value=\"".$supplier_data['fax']."\"></td>
	  <td>".$supplier_data['email']."<input type=\"hidden\" id=\"supem".$supplier_data['supplier_no']."\" value=\"".$supplier_data['email']."\"></td>
	  <td>".$supplier_data['remark']."<input type=\"hidden\" id=\"suprm".$supplier_data['supplier_no']."\" value=\"".$supplier_data['remark']."\"></td>
	  <input type=\"hidden\" id=\"suphi".$supplier_data['supplier_no']."\" value=\"".$checkd."\">
    </form>
  </tr>");
  }while($supplier_data = mysql_fetch_assoc($supplier));
?>
  </table>
  </body>
  </html>