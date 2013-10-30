<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script language="javascript" type="text/javascript">
function b(ss,s) {
var r = 0;
var geno = ss;
var geid;
var gtype;
var gename;
var gema;
var gecolor;
var geop;
var gesp;
var barc;
var gels;
var gest;
var mod_man_commiss;
var mod_staff_commiss;

  //  if (!document.getElementsByTagName || !document.createTextNode) return;
   var row = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    var cells = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('td');
 //   for (i = 0; i < row.length; i++) {
 //       row[i].onclick = function() { 
			r = s;		
			geid =  row[r].cells[1].innerHTML;
			gtype = row[r].cells[2].innerHTML;
			gename  = row[r].cells[4].innerHTML;
			gema  = row[r].cells[3].innerHTML;
			gecolor = row[r].cells[5].innerHTML;
			geop  = row[r].cells[6].innerHTML;
			gesp  = row[r].cells[7].innerHTML;
			gels = row[r].cells[8].innerHTML;
			barc = row[r].cells[9].innerHTML;
			gest = row[r].cells[10].innerHTML;
			mod_man_commiss = row[r].cells[11].innerHTML;
			mod_staff_commiss = row[r].cells[12].innerHTML;
			showWindow_ass(gtype,geid,gename,gema,gecolor,geop,gesp,geno,barc,gels,gest,mod_man_commiss,mod_staff_commiss);
 //       }
 //   }
}
</script>
<body>
<table width = 100%b border="1" id = "showdata">
	<tr>
    	<td>行動</td>
		<td>編碼</td>
		<td>種類</td>
		<td>牌子</td>
		<td>名稱</td>
		<td>顏色</td>
		<td>原價</td>
		<td>特價</td>
		<td>最近來貨價</td>
		<td>條碼</td>
		<td>狀況</td>
		<td>店長佣金</td>
		<td>店員佣金</td>
	</tr>
<?php

if(!empty($_GET) && isset($_GET)){
	
	$Le = 10;
	$Ls = $_GET['ls'];
	$nowpage = $Ls;
	$Ls = ((int)($Ls) - 1) * 10;

		if($_GET['id1'] != '' && $_GET['id2'] != ''){
	     $sqlwhere = " AND accessories.acc_id BETWEEN ".$_GET["id1"]." AND ".$_GET["id2"]."";}
		else if($_GET['id1'] != '' && $_GET['id2'] == ''){
			$sqlwhere = " AND accessories.acc_id = ".$_GET["id1"]."";}
		else{
			$sqlwhere = "";
		}
		if($_GET['q'] != ''){
			if($sqlwhere != ''){
			$sqlwhere2=" AND accessories.accName like '%".$_GET['q']."%'";}
			else{$sqlwhere2=" AND accessories.accName like '%".$_GET['q']."%'";}	
		}
		else{
			$sqlwhere2="";
		}
		if($_GET['st']=='all' AND $_GET['stype'] == 'all'){
			$sqlwhere3 = "";
		}else if($_GET['st'] != 'all' AND $_GET['stype'] == 'all'){
			$sqlwhere3 = " AND productstate.productstate_no = ".$_GET['st'];
		}else if($_GET['st'] == 'all' AND $_GET['stype'] != 'all'){
			$sqlwhere3 = " AND acctype.accType_no = ".$_GET['stype'];
		}else{
			$sqlwhere3 = " AND productstate.productstate_no = ".$_GET['st']." AND acctype.accType_no = ".$_GET['stype'];
		}
if($_GET['act']=='select'){
	//if($_GET['st']=='all'){
   // $SQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere."".$sqlwhere2." ORDER BY acc_no DESC LIMIT ".$Ls." , ".$Le."";
	//$CSQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere."".$sqlwhere2." ORDER BY acc_no DESC";
	//}else{
	$SQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere3."".$sqlwhere."".$sqlwhere2." ORDER BY accessories.acc_no DESC LIMIT ".$Ls." , ".$Le."";
	$CSQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere3."".$sqlwhere."".$sqlwhere2." ORDER BY accessories.acc_no DESC";		
//	}
	
	}else if($_GET['act'] == 'update'){
		$update_SQL = "UPDATE accessories SET
		 manufacturer = '".$_GET['ma']."',color ='".$_GET['c']."', accName = '".$_GET['n']."', acc_id = '".$_GET['id']."',
		 oprice = ".$_GET['op'].", sprice = ".$_GET['sp'].", barcode = '".$_GET['bar']."', productState_no = ".$_GET['sta'].",
		 accType_no = ".$_GET['type'].", commission_1 =".$_GET['mod_man_commiss'].",commission_2=".$_GET['mod_staff_commiss']." WHERE acc_no = ".$_GET['no'];
		//echo $update_SQL;
		@mysql_query($update_SQL, $conn) or die(mysql_error());
	$SQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere3."".$sqlwhere."".$sqlwhere2." ORDER BY accessories.acc_no DESC LIMIT ".$Ls." , ".$Le."";
	$CSQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere3."".$sqlwhere."".$sqlwhere2." ORDER BY accessories.acc_no DESC";	
	}else if($_GET['act'] == 'insert'){
		
	if ($_GET['ic'] == ''){
		$color  = 'N/A';}
	else
	{$color = $_GET['ic'];}
	
	if ($_GET['ibar'] == ''){
		$bar = '';}
	else{$bar = $_GET['ibar'];}
	if ($_GET['iop'] == ''){
	$op = 0;	
	}else{
	$op = $_GET['iop'];}
	if ($_GET['isp'] == ''){
	$sp = 0;	
	}else{
	$sp = $_GET['isp'];}

	mysql_select_db($database_conn, $conn);
	
	/*$SQL = "SELECT IFNULL(MAX(acc_no),0)+1 as acc_no FROM accessories";  
    $rs = mysql_query($SQL, $conn) or die(mysql_error());
    $row = mysql_fetch_assoc($rs);
    $next = $row['acc_no'];*/
	
	$insert_SQL = "INSERT INTO accessories(acc_id,accName,accType_no,barcode,color,manufacturer,oprice,sprice,productState_no,commission_1,commission_2)
	VALUES('".$_GET['iid']."','".$_GET['in']."','".$_GET['itype']."','".$bar."','".$color."','".$_GET['ima']."',".$op.",".$sp.",".$_GET['ist'].",".$_GET['man_commiss'].",".$_GET['staff_commiss'].")";
		
	@mysql_query($insert_SQL, $conn) or die(mysql_error());
	}
	$SQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere3."".$sqlwhere."".$sqlwhere2." ORDER BY accessories.acc_no DESC LIMIT ".$Ls." , ".$Le."";
	$CSQL = "SELECT * FROM accessories ,acctype,productstate WHERE accessories.accType_no = acctype.accType_no AND accessories.productstate_no = productstate.productstate_no ".$sqlwhere3."".$sqlwhere."".$sqlwhere2." ORDER BY accessories.acc_no DESC";		
	
			
	}else{
    $SQL = "SELECT * FROM accessories as a ,acctype as at,productstate as ps WHERE a.accType_no = at.accType_no AND a.productstate_no = ps.productstate_no ORDER BY a.acc_no DESC LIMIT 10"; 
	$CSQL = "SELECT * FROM accessories as a ,acctype as at, productstate as ps WHERE a.accType_no = at.accType_no AND a.productstate_no = ps.productstate_no ORDER BY a.acc_no DESC";
	$nowpage = 1;
	}
	//echo "1 : ".$sqlwhere;
	//echo "   2 : ".$sqlwhere2;
	//echo "   3 : ".$sqlwhere3;
	//echo $SQL;
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
	<td width = "10%"><?php echo $row['acc_no']; echo "<input type = 'button' id = 'edit' value = '修改' onclick = 'b(".$row['acc_no'].",this.parentNode.parentNode.rowIndex)'/>";
	$SS = "SELECT cost FROM poDetail WHERE podetail_no = (SELECT MAX(podetail_no) FROM podetail WHERE acc_no = ".$row['acc_no'].")";
	$rsss = mysql_query($SS, $conn) or die(mysql_error());
   	$rowss = mysql_fetch_assoc($rsss);
		?></td>
    <td width = "10%"><?php echo $row['acc_id']; ?></td>
    <td><?php echo $row['typeName']; ?></td>
    <td><?php echo $row['manufacturer']; ?></td>
	<td><?php echo $row['accName']; ?></td>
	<td><?php echo $row['color']; ?></td>
	<td><?php echo $row['oprice']; ?></td>
	<td><?php echo $row['sprice']; ?></td>
	<td><?php echo $rowss['cost']; ?></td>
    <td><?php echo $row['barcode']; ?></td>
    <td><?php echo $row['stateName'];?></td>
	<td><?php echo $row['commission_1']; ?></td>
    <td><?php echo $row['commission_2']; ?></td>
	</tr>
<?php
	}while($row = mysql_fetch_assoc($rs));

?>
	<tr>
	<td colspan="11">
			<p align="right">
			<input type = "button" value = "<" onclick = "fm2()"/>
			<label id = "page"><?php echo $nowpage; ?></label>
			<input type = "button" value = ">" onclick = "bk2()"/>
			<input type = "text" size = "10" id = "topage" onkeypress="keypress(event)"/>
			共有<label id = "totalpage"><?php echo $pageno; ?></label>頁</p>
	</td>
	</tr>	
</table>
</body>
</html>
