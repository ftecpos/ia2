
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/ReportViewCSS.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purchase Order View</title>

<script LANGUAGE="JavaScript">
function toPrint() {
print();
}
</SCRIPT></head>

<body onload="toPrint()">
<?php
	require ("../conn/sqlconnect.php");
?>
<?php
	//$si_no = 7;
	$si_no = $_GET["si_no"];
	$si_sql = mysql_query("");
	$po_no;
	$si_date ;
	$staff_no ;
	$sup_id ;
	$sup_name ;
	$addr ;
	$tel ;
?>
<?php
	$numHead = 'PO-';
	$numLength = strlen($PO_no);
	$tempZero = '';
	$zeroCount = 7;
	$addZero = $zeroCount-$numLength;
	while($addZero!=0){
		$tempZero.='0';
		$addZero--;
	}
	$finPO_No=$numHead.$tempZero.$PO_no;
?>
<div id="A4">
<div id="image"><img src="../img/TT1006.jpg" width="200" height="120" /></div>
<div id="title">
  <table width="400" border="1">
    <tr>
      <td height="58"><div align="center">Purchase Order<br />
      </div></td>
      <td><div align="center"><strong>採購訂單</strong></div></td>
    </tr>
  </table>
</div>

<div id="address">
<?php 
	echo '<table width="440">';
	echo '<tr><td width="170"><div align="right">供應商編號<br>SUPPLIER CODE:  </div></td><td width="20" /><td width="250"><div align="left">'.$sup_id.'</div></td></tr>';
	echo '<tr><td width="170"><div align="right">供應商名稱 SUPPLIER: </div></td><td width="20" /><td width="250"><div align="left">'.$sup_name.'</div></td></tr>';
	echo '<tr><td width="170"><div align="right">地址 ADDRESS: </div></td><td width="20" /><td width="250"><div align="left">'.$addr.'</div></td></tr>';
	echo '<tr><td width="170"><div align="right">電話 TEL: </div></td><td width="20" /><td width="250"><div align="left">'.$tel.'</div></td></tr>';
	echo '</table>';
?>
</div>

<div id="dateAndNoPO">
  <table width="300" border="0">
  	<tr>
  		<td align="left">訂單日期	DATE OF PO</td>
    </tr>
    <tr>
	  <td align="right"><?php echo $PO_date;?></td>
    </tr>
	<tr>
    	<td align="left">訂單編號	PO No.</td>
    </tr>
    <tr>
        <td align="right"><?php echo $finPO_No;?></td>
	</tr>
    <tr>
    	<td align="left">付款方式 Payment Term</td>
  	</tr>
    <tr>
        <td align="right">&nbsp;</td>
	</tr>
    <tr>
    	<td align="left">開單員工 Prepare by.</td>
    </tr>
    <tr>
        <td align="right"><?php echo $staff_no;?></td>
	</tr>
  </table>
</div>

<div id="itemList">
<?php
	$ttc =0;
	$list_sql = mysql_query("");	
	echo '<table width="1000" border="0">';
    echo '<tr>';
	echo '<td width="110">編號<br>CODE</td>';
    echo '<td width="320">產品資料<br>PRODUCT DESCRIPTION</td>';
	echo '<td width="200">供應商<br />SUPPLIER</td>';
    echo '<td width="50"><div align="center">數量<br>QTY</div></td>';
    echo '<td width="100"><div align="right">單價<br>UNIT PRICE</div></td>';
    echo '<td width="100"><div align="right">折扣<br>DISCOUNT</div></td>';
    echo '<td width="120"><div align="right">金額<br>AMOUNT(HKD)</div></td>';
    echo '</tr>';
	echo '</table>';
	echo '<hr>';
	echo '<table width="1000" border="0">';
	for($i=0; $i<mysql_num_rows($list_sql);$i++){
		$phonetype_no = mysql_result($list_sql,$i,0);
		$acc_no = mysql_result($list_sql,$i,1);
		$qty = mysql_result($list_sql,$i,2);
		$cost = mysql_result($list_sql,$i,3);
		$poDetail_no = mysql_result($list_sql,$i,4);
		$discount = 0;
		$ttc += $qty*$cost;
		if($phonetype_no == NULL){
			$acc_sql = mysql_query("select acc_id, accName, manufacturer from accessories where acc_no ='".$acc_no."'");
			$acc_id = mysql_result($acc_sql,0,0);
			$accName = mysql_result($acc_sql,0,1);
			$manufacturer_a = mysql_result($acc_sql,0,2);
			echo '<tr>';
			echo '<td width="110">'.$acc_id.'</td>';
    		echo '<td width="320">'.$accName.'</td>';
			echo '<td width="200">'.$manufacturer_a.'</td>';
    		echo '<td width="50"><div align="center">'.$qty.'</div></td>';
    		echo '<td width="100"><div align="right">'.$cost.'</div></td>';
    		echo '<td width="100"><div align="right">'.$discount.'</div></td>';
    		echo '<td width="120"><div align="right">'.$qty*$cost.'</div></td>';
			echo '</tr>';
		}else if($acc_no == NULL){
			$phone_sql = mysql_query("select phonetype_id, phone_name, manufacturer from phonetype where phoneType_no ='".$phonetype_no."'");
			$phonetype_id = mysql_result($phone_sql,0,0);
			$phone_name = mysql_result($phone_sql,0,1);
			$manufacturer_p = mysql_result($phone_sql,0,2);
			echo '<tr>';
			echo '<td width="110">'.$phonetype_id.'</td>';
    		echo '<td width="320">'.$phone_name.'</td>';
			echo '<td width="200">'.$manufacturer_p.'</td>';
    		echo '<td width="50"><div align="center">'.$qty.'</div></td>';
    		echo '<td width="100"><div align="right">'.$cost.'</div></td>';
    		echo '<td width="100"><div align="right">'.$discount.'</div></td>';
    		echo '<td width="120"><div align="right">'.$qty*$cost.'</div></td>';
			echo '</tr>';
			$IMEI_sql = mysql_query("select IMEI from phone where poDetail_no ='".$poDetail_no."'");
			for($j=0; $j<mysql_num_rows($IMEI_sql);$j++){
				$IMEI = mysql_result($IMEI_sql,$j,0);
				echo '<tr>';
				echo '<td width="110"></td>';
    			echo '<td width="320">'.$IMEI.'</td>';
				echo '<td width="200">&nbsp;</td>';
    			echo '<td width="50"><div align="center">&nbsp;</div></td>';
	    		echo '<td width="100"><div align="right">&nbsp;</div></td>';
    			echo '<td width="100"><div align="right">&nbsp;</div></td>';
    			echo '<td width="120"><div align="right">&nbsp;</div></td>';
				echo '</tr>';
			}
		}
	}
	echo '</table><br><table>';
	echo '<tr>';
	echo '<td width = "660"><div align="right">採購總額 :<br>Total Amount</div></td>';
	echo '<td width = "100"><div align="right">HKD</div></td>';
	echo '<td width = "100"><div align="right">'.$ttc.'</div></td>';
	echo '<td width="120"><div align="right">&nbsp;</div></td>';
	echo '</tr>';
	echo '</table>';
?>

</div>
<div id="signOrChop2">
<table width="457" cellspacing="0" style="border:0.5px solid black;">
   	<tr><td width="450" height="100" style="border:0.5px solid black;">&nbsp;</td>
   	</tr>
    <tr><td style="border:0.5px solid black;"><div align="center">批準人簽署/蓋印 APPROVED BY</div></td></tr>
</table>
</div>
<div id="signOrChop">
  <table width="457" cellspacing="0" style="border:0.5px solid black;">
   	<tr><td width="450" height="100" style="border:0.5px solid black;">&nbsp;</td>
   	</tr>
    <tr><td style="border:0.5px solid black;"><div align="center">開單人簽署/蓋印 PREPARED BY</div></td></tr>
</table></div>
</div>
</body>
</html>
