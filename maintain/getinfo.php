<?php include("../check_login.php");?>
<?php require_once('../conn/sqlconnect.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type = "text/javascript">
function b(ss,s) {
var r;
var geno = ss;
var geid;
var gename;
var gema;
var gecolor;
var geop;
var gesp;
var gels;
var gest;
var mod_man_commiss;
var mod_staff_commiss;
 var row = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
  var cells = document.getElementById('showdata').getElementsByTagName('tbody')[0].getElementsByTagName('td');	
         	 r=s-1;
			geid =  row[r].cells[1].innerHTML;
			gename  = row[r].cells[3].innerHTML;
			gema  = row[r].cells[2].innerHTML;
			gecolor = row[r].cells[4].innerHTML;
			geop  = row[r].cells[5].innerHTML;
			gesp  = row[r].cells[6].innerHTML;
			gels = row[r].cells[7].innerHTML;
			gest = row[r].cells[8].innerHTML;
			mod_man_commiss = row[r].cells[8].innerHTML;
			mod_staff_commiss = row[r].cells[9].innerHTML;
			showWindow_mobile(geid,gename,gema,gecolor,geop,gesp,geno,gels,gest,mod_man_commiss,mod_staff_commiss);
}
</script>
</head>
<body>
<br>
<table width = 100%b border="1" id = "showdata">
<thead>
	<tr>
    	<td>行動</td>
		<td>編號</td>
		<td>牌子</td>
		<td>名稱</td>
		<td>顏色</td>
		<td>原價</td>
		<td>特價</td>
		<td>最近來貨價</td>
		<td>店長佣金</td>
		<td>店員佣金</td>
		<td>狀況</td>
    </thead>
    <tbody>
    	
<?php

	mysql_select_db($database_conn, $conn);
	if(!empty($_GET) && isset($_GET)){		
	$Le = 10;		
	$Ls = $_GET['ls'];
	$nowpage = $Ls;
	$Ls = ((int)($Ls) - 1) * 10;
	
	
		if($_GET['id1'] != '' && $_GET['id2'] != ''){
	     $sqlwhere = "AND phoneType.phonetype_id BETWEEN '".$_GET["id1"]."' AND '".$_GET["id2"]."'";}
		else if($_GET['id1'] != '' && $_GET['id2'] == ''){
			$sqlwhere = "AND phoneType.phonetype_id = '".$_GET["id1"]."'";}
		else{
			$sqlwhere = "";
		}
		if($_GET['q'] != ''){
			if($sqlwhere != ''){
			$sqlwhere2="AND phoneType.phone_name like '%".$_GET['q']."%'";}
			else{$sqlwhere2="AND phoneType.phone_name like '%".$_GET['q']."%'";}	
		}
		else{
			$sqlwhere2="";
		}
		if($_GET["ma"] != '' && $sqlwhere == '' && $sqlwhere2 ==''){
			$sqlwhere3 = "AND phoneType.manufacturer = '".$_GET['ma']."'";
		}else if($_GET["ma"] == ''){
			$sqlwhere3 = "";	
		}else{
			$sqlwhere3 = "AND phoneType.manufacturer = '".$_GET['ma']."'";	
		}
		 if($_GET['st'] != 'all'){	
		$sqlwhere4 = "AND phoneType.productState_no = ".$_GET['st']."";
		}else{
		$sqlwhere4 = "";
		}
		
		
	if($_GET['act'] == 'update'){
		$filename = "mobile_description/".$_GET["n"].".txt";
			if($_GET['desc'] == 'No Description'){
		$wc = false;
		do{
			if(file_exists("mobile_description")){
				
				if(file_exists($filename)){
					break;
				}else{
					$data = $_GET["desc"];
					$fp = fopen("$filename","w");
					//foreach($data as $key => $value){
					fwrite($fp,$data);
					fclose($fp);
					$wc = true;}
			}else{
					mkdir("mobile_description");
			}
		}while($wc = true);
	}else{
					//$filename = "mobile_description/".$_GET["n"].".txt";
					$data = $_GET["desc"];
					$fp = fopen("$filename","w");
					//foreach($data as $key => $value){
					fwrite($fp,$data);
					fclose($fp);
	}
		
		
		
		$update_SQL = "UPDATE phonetype SET
		 manufacturer = '".$_GET['upma']."',color ='".$_GET['c']."', phone_name = '".$_GET['n']."', phonetype_id = '".$_GET['id']."',oprice = ".$_GET['op'].", sprice = ".$_GET['sp'].", productState_no = ".$_GET['sta'].", commission_1 =".$_GET['mod_man_commiss'].", commission_2=".$_GET['mod_staff_commiss']." WHERE phoneType_no = ".$_GET['no'];
		
		@mysql_query($update_SQL, $conn) or die(mysql_error());
	$SQL = "SELECT * FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC LIMIT ".$Ls." , ".$Le."";	 
	$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";	
	
	//$rs = mysql_query($SQL, $conn) or die(mysql_error());
   	//$row = mysql_fetch_assoc($rs);
	//$totalrow = mysql_num_rows($rs);
	

	}else if($_GET['act'] == 'select'){
	$SQL = "SELECT * FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC LIMIT ".$Ls." , ".$Le."";	 
	$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";					
	}else if($_GET['act'] == 'insert'){
	//$mcolor;
	$wc = false;

	//$FileName = $_GET['in'];
	//$id = $_GET['mobileid'];
	 
	if($_GET['ic'] == ""){
	$color = "N/A";
	}else{$color = $_GET['ic'];}
	if ($_GET['iop']==''){
	$op = 0;
	}else{$op = $_GET['iop'];}

	if ($_GET['isp']==''){
	$sp = 0;
	}else{$sp = $_GET['isp'];}
/*	
if ($_POST['cost'] == ''){
	$cost = 0;
}else{$cost = $_POST['cost'];}

    $SQL = "SELECT phonetype_no FROM phoneType WHERE phonetype_no = '".$_GET['iid']."'";  
    $rsProd = mysql_query($SQL, $conn) or die(mysql_error());
    $row_rsProd = mysql_fetch_assoc($rsProd);
	if($row_rsProd == 0){
*/
//	$SQLs = "SELECT IFNULL(MAX(phonetype_no),0)+1 as phonetype_no FROM phonetype";  
//    $rs = mysql_query($SQLs, $conn) or die(mysql_error());
//    $row = mysql_fetch_assoc($rs);
//    $next = $row['phonetype_no'];
	
	$insert_SQL = "INSERT INTO phoneType(phonetype_id,manufacturer,color,phone_name,oprice,sprice,productstate_no,commission_1,commission_2)VALUES
	('".$_GET['iid']."','".$_GET['ima']."', '".$color."', '".$_GET['in']."',".$op.",".$sp.",".$_GET['st'].",".$_GET['man_commiss'].",".$_GET['staff_commiss'].")";
    @mysql_query($insert_SQL, $conn) or die(mysql_error());
	//$SQL = "SELECT * FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC LIMIT ".$Ls." , ".$Le."";	 
	//$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";	
	$SQL = "SELECT * FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC LIMIT ".$Ls." , ".$Le."";	 
	$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ".$sqlwhere." ".$sqlwhere2." ".$sqlwhere3." ".$sqlwhere4." ORDER BY phoneType.phoneType_no DESC";				
	
	//}	
 	do{
	if(file_exists("mobile_description")){
		$filename = "mobile_description/".$_GET["in"].".txt";
		if(file_exists($filename)){
			break;
		}else{
			$data = $_GET["idesc"];
			$fp = fopen("$filename","w");
			//foreach($data as $key => $value){
			fwrite($fp,$data);
			fclose($fp);
			$wc = true;}
	}else{
		mkdir("mobile_description");
	}
	}while($wc = true);
	/*
	}else if($_GET['act'] == 'exInsert'){
		echo "Inseting";
		
			require_once("PHPExcel.php");//inputExcel/
			require_once("PHPExcel/IOFactory.php");//inputExcel/
			if(substr($file,-4,-1) == "xls") {
				require_once("inputExcel/PHPExcel/Reader/Excel2007.php");
				$objReader = new PHPExcel_Reader_Excel2007(); 
			} else {
				require_once("inputExcel/PHPExcel/Reader/Excel5.php");
				$objReader = new PHPExcel_Reader_Excel5(); 
			}
			$objReader->setReadDataOnly(true); 
			$objPHPExcel = $objReader->load('Upload/'.$_GET["file"]);
			$currentSheet = $objPHPExcel->getSheet(0);
			$allLine = $currentSheet->getHighestRow();
			for($excel_line = 2;$excel_line<=$allLine;$excel_line++) {
			$SQLs = "SELECT IFNULL(MAX(phonetype_no),0)+1 as phonetype_no FROM phonetype";  
   			$rs = mysql_query($SQLs, $conn) or die(mysql_error());
    		$row = mysql_fetch_assoc($rs);
    		$next = $row['phonetype_no'];
			$ExDesc = $currentSheet->getCellByColumnAndRow(4,$excel_line)->getValue();
		
		
		
	if ($ExDesc = "" || $ExDesc = null ){
		$wc = false;
		do{
			if(file_exists("mobile_description")){
				$filename = "mobile_description/".$_GET["n"];
				if(file_exists($filename)){
					break;
				}else{
					$data = $_GET["desc"];
					$fp = fopen("$filename","w");
					//foreach($data as $key => $value){
					fwrite($fp,$data);
					fclose($fp);
					$wc = true;}
			}else{
					mkdir("mobile_description");
			}
		}while($wc = true);
		}		
		
	
				$sql = "insert into phoneType(phonetype_no,phonetype_id,manufacturer,phone_name,color,oprice,sprice,productstate_no) values
				(".$next.",
				'".$currentSheet->getCellByColumnAndRow(0,$excel_line)->getValue()."',
				'".$currentSheet->getCellByColumnAndRow(1,$excel_line)->getValue()."',
				'".$currentSheet->getCellByColumnAndRow(2,$excel_line)->getValue()."',
				'".$currentSheet->getCellByColumnAndRow(3,$excel_line)->getValue()."',
				".$currentSheet->getCellByColumnAndRow(5,$excel_line)->getValue().",
				".$currentSheet->getCellByColumnAndRow(6,$excel_line)->getValue().",
				".$currentSheet->getCellByColumnAndRow(7,$excel_line)->getValue().",
				)"; 
				mysql_query($sql) or die(mysql_error);
			}
			echo "finish";*/
	}
	}else{
    $SQL = "SELECT * FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no	ORDER BY phoneType_no DESC LIMIT 10"; 
	$CSQL = "SELECT phoneType.phoneType_no FROM phoneType,productState WHERE phoneType.productstate_no = productstate.productstate_no ORDER BY phoneType_no DESC";
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
	
	
	echo "<script>";
	echo "var tp = '".$pageno."';";
	echo "</script>";
	//}
	//$i = 1;	
	do{
	if($totalrow == 0){echo"資料不存在";break;}
?>
	<tr>
	<td width = "10%">
		<?php echo $row['phoneType_no']; 
		echo "<input type = 'button' id = 'edit' value = '修改'  onclick = 'b(".$row['phoneType_no'].",this.parentNode.parentNode.rowIndex)'/>";//;b(".$row['phoneType_no'].",this.parentNode.parentNode.rowIndex)
		
	$SS = "SELECT cost FROM poDetail WHERE podetail_no = (SELECT MAX(podetail_no) FROM podetail WHERE phonetype_no = ".$row['phoneType_no'].")";
    $rs1 = mysql_query($SS, $conn) or die(mysql_error());
   	$rows1 = mysql_fetch_assoc($rs1);
		?>
    </td>  
    <td width = "10%"><?php echo $row['phonetype_id']; ?></td>
    <td><?php echo $row['manufacturer']; ?></td>
	<td><?php echo $row['phone_name']; ?></td>
	<td><?php echo $row['color']; ?></td>
    <td><?php echo $row['oprice']; ?></td>
    <td><?php echo $row['sprice']; ?></td>
    <td><?php echo $rows1['cost']; ?></td>
    <td><?php echo $row['commission_1']; ?></td>
    <td><?php echo $row['commission_2']; ?></td>
    <td><?php echo $row['stateName']; ?></td>
	</tr>
<?php
	//$i++;
	}while($row = mysql_fetch_assoc($rs))
	
?>
	<tr>
			<td colspan="9">
			<p align="right">
			<input type = "button" value = "<" onclick = "fm()"/>
			<?php echo $nowpage; ?>
			<input type = "button" value = ">" onclick = "bk()"/>
			<input type = "text" size = "10" id = "topage" onkeypress="keypress(event)"/>
			共<label id = "totalpage"><?php echo $pageno; ?></label>頁</p>
			</td>
	</tr>


</tbody>
</table>
</body>
</html>
