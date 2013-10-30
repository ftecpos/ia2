
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/ReportViewCSS.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt Review</title>

<script LANGUAGE="JavaScript">
function toPrint() {
print();
}
</SCRIPT>

</head>

<body onload="toPrint()">
<?php
	require ("../conn/sqlconnect.php");
?>
<?php
	//$receipt_No = 64;
	$receipt_No = $_GET["receipt_No"];
	$info = mysql_query("select retail_id, addr, phone, createDate, staff_id, total, remark, void_return_desc from retailshop rs, invoice inv, staff sf where rs.retailShop_no = inv.retailShop_no and inv.staff_no = sf.staff_no and inv.invoice_no=".$receipt_No);
	$shop_no = mysql_result($info,0,0);
	$address = mysql_result($info,0,1);
	$tel = mysql_result($info,0,2);
	$date = mysql_result($info,0,3);
	$staff_No = mysql_result($info,0,4);
	$remark = mysql_result($info,0,6);
	$reason = mysql_result($info,0,7);
	$total = mysql_result($info,0,5);
?>
<?php
	$typeSql = mysql_query("select invoiceType_no from invoice where invoice_no='".$receipt_No."'");
	$tempType = mysql_result($typeSql,0,0);
	if($tempType == '1'){
		$numHead = 'SA-';
	}
	if($tempType == '2'){
		$numHead = 'SR-';
	}
	$numLength = strlen($receipt_No);
	$tempZero = '';
	$zeroCount = 7;
	$addZero = $zeroCount-$numLength;
	while($addZero!=0){
		$tempZero.='0';
		$addZero--;
	}
	$finReceiptNo=$numHead.$tempZero.$receipt_No;
?>
<?php 
	if($remark != 'N/A'){
		$ref_length = strlen($remark);
		$ref_tempZero = '';
		$ref_zeroCount = 7;
		$ref_addZero = $ref_zeroCount-$ref_length;
		while($ref_addZero!=0){
			$ref_tempZero.='0';
			$ref_addZero--;
		}
		$ref_remark = '原單編號: SA-'.$ref_tempZero.$remark;
	}else{
	$ref_remark = '';
	}
	if($reason != 'N/A' && $tempType == '2'){
		$reason_desc = '退貨原因: '.$reason;
	}else{
		$reason_desc = '';
	}
?>
<div id="A4">
<div id="image"><img src="../img/TT1006.jpg" width="200" height="120" /></div>
<div id="title">
  	<?php
   		include ("/check_type.php"); 
	?>
</div>

<div id="address">
<?php 
	echo '<table width="350" border="0" cellspacing="0">';
	echo '<tr><td width="130"><div align="right">分店 SHOP: </div></td><td width="10" /><td width="200"><div align="left">'.$shop_no.'</div></td></tr>';
	echo '<tr><td width="130"><div align="right">地址 ADDRESS: </div></td><td width="10" /><td width="200"><div align="left">'.$address.'</div></td></tr>';
	echo '<tr><td width="130"><div align="right">電話 TEL.: </div></td><td width="10" /><td width="200"><div align="left">'.$tel.'</div></td></tr>';
	echo '</table>';

?></div>

<div id="dateAndNo">
  <table width="300" border="0">
  	<tr>
  		<td align="left">購買日期	 DATE</td>
    </tr>
    <tr>
	  <td align="right">
      <?php echo @$date; ?>
      </td>
    </tr>
	<tr>
    	<td align="left">收據編號	 RECEIPT No.</td>
    </tr>
    <tr>
        <td align="right">
        <?php echo $finReceiptNo; ?>
        </td>
	</tr>
    <tr>
    	<td align="left">職員編號 STAFF No.</td>
    </tr>
    <tr>
        <td align="right">
        <?php echo @$staff_No; ?>
        </td>
	</tr>
  </table>
</div>

<div id="reportList">
<?php 
	switch($type_no){
		case "11":
		case "12":
		case "14":
			include ("/ReceiptList.php");
			break;
		case "23":
			include ("/ReturnList.php");
			break;
		case "3":
			include ("/Exchange.php");
			break;
	}
?>
</div>
<div id="remark">
<table width="500" height="166" border="0" cellspacing="0">
<tr>
        	<td height="27" style="border:1px solid black;">備註 REMARK(S)</td>
      </tr>
        <tr>
        	<td height="100" style="border:1px solid black;"><?php echo $ref_remark;?><br /><?php echo $reason_desc; ?></td>
        </tr>
    </table>
</div>
<div id="signOrChop">
  <table width="457" border="0" cellspacing="0" style="border:1px solid black;">
   	<tr><td width="450" height="100" style="border:1px solid black;">&nbsp;</td>
   	</tr>
    <tr><td style="border:1px solid black;"><div align="center">顧客簽署/蓋印 CUSTOMER SIGNATURE/CHOP</div></td></tr>
</table></div>
</div>
</body>
</html>