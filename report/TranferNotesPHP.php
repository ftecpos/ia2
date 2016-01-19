<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/ReportViewCSS.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transfer Notes</title>

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
	//$trans_No = 50;
	$trans_No = $_GET["trans_No"];
	$transInfo = mysql_query("select transDate, receiveDate, fromRetail_no, toRetail_no, staff_no, tranReson, stateName from transfer, transstate where transfer.transState_no = transstate.transState_no and transfer.transfer_no=".$trans_No);
	$fromRetail = mysql_result($transInfo,0,2);
	$toRetail = mysql_result($transInfo,0,3);
	$transDate = mysql_result($transInfo,0,0);
	$staff_No = mysql_result($transInfo,0,4);
	$transReason = mysql_result($transInfo,0,5);
	$transState = mysql_result($transInfo,0,6);
	$staff_sql = mysql_query("select staff_id from staff where staff_no ='".$staff_No."'");
	$staff_id = mysql_result($staff_sql,0);
	$from_sql = mysql_query("select retail_id from retailshop where retailShop_no='".$fromRetail."'");
	$fromID = mysql_result($from_sql,0);
	$to_sql = mysql_query("select retail_id, addr, phone from retailshop where retailShop_no='".$toRetail."'");
	$toID = mysql_result($to_sql,0,0);
	$toAddress = mysql_result($to_sql,0,1);
	$tel = mysql_result($to_sql,0,2);
?>
<?php
	$numHead = 'TR-';
	$numLength = strlen($trans_No);
	$tempZero = '';
	$zeroCount = 7;
	$addZero = $zeroCount-$numLength;
	while($addZero!=0){
		$tempZero.='0';
		$addZero--;
	}
	$finTransNo=$numHead.$tempZero.$trans_No;
?>
<div id="A4">
<div id="image"><img src="../img/TT1006.jpg" width="200" height="120" /></div>
<div id="title">
  <table width="400" border="1">
    <tr>
      <td height="58"><div align="center">Transfer Note<br />
      </div></td>
      <td><div align="center"><strong>轉貨單（<?php echo $transState;?>）</strong></div></td>
    </tr>
  </table>
</div>

<div id="address">
<?php 
	echo '<table width="350" border="0" cellspacing="0">';
	echo '<tr><td width="130"><div align="right">出貨分店 SHOP: </div></td><td width="10" /><td width="200"><div align="left">'.$fromID.'</div></td></tr>';
	echo '<tr><td width="130"><div align="right">收貨分店 SHOP: </div></td><td width="10" /><td width="200"><div align="left">'.$toID.'</div></td></tr>';
	echo '<tr><td width="130"><div align="right">地址 ADDRESS: </div></td><td width="10" /><td width="200"><div align="left">'.$toAddress.'</div></td></tr>';
	echo '<tr><td width="130"><div align="right">電話 TEL.: </div></td><td width="10" /><td width="200"><div align="left">'.$tel.'</div></td></tr>';
	echo '</table>';

?></div>

<div id="transDateAndNo">
  <table width="300" border="0">
  	<tr>
  		<td align="left">轉貨單日期	DATE OF TRANSFER NOTE</td>
    </tr>
    <tr>
	  <td align="right"><?php echo $transDate; ?></td>
    </tr>
	<tr>
    	<td align="left">轉貨單編號	Transfer Note No.</td>
    </tr>
    <tr>
        <td align="right"><?php echo $finTransNo; ?></td>
	</tr>
    <tr>
    	<td align="left">轉貨原因 Transfer Reason</td>
    </tr>
    <tr>
        <td align="right"><?php echo $transReason; ?></td>
	</tr>
    <tr>
    	<td align="left">開單員工 Prepare by</td>
    </tr>
    <tr>
        <td align="right"><?php echo $staff_id; ?></td>
	</tr>
  </table>
</div>

<div id="reportList">
<?php 
	$list_sql = mysql_query("select acc_no, IMEI, trans_qty from transdetail where transfer_no=".$trans_No);
	echo '<table width="1000" border="0">';
    echo '<tr>';
	echo '<td width="200">編號<br>CODE</td>';
    echo '<td width="600">產品資料<br>PRODUCT DESCRIPTION</td>';
    echo '<td width="200"><div align="center">數量<br>QTY</div></td>';
    echo '</tr>';
	echo '</table>';
	echo '<hr>';
	echo '<table width="1000" border="0">';
        $num_record = mysql_num_rows($list_sql);
        $total_qty = 0;
	for($i=0; $i<mysql_num_rows($list_sql); $i++){
	$acc_no = mysql_result($list_sql,$i,0);
	$phone_IMEI = mysql_result($list_sql,$i,1);
	if($phone_IMEI == NULL){
		$acc_sql = mysql_query("select acc_id, accName, barcode from accessories where acc_no='".$acc_no."'");
		echo "<tr>";
		echo '<td width="200" id="code"><div align="left">'.mysql_result($acc_sql,0,0).'</div></td>';
		echo '<td width="600" id="name"><div align="left">'.mysql_result($acc_sql,0,1).'</div></td>';
		echo '<td width="200" id="qty"><div align="center">'.mysql_result($list_sql,$i,2).'</div></td>';
		echo "</tr>";
	}else if($acc_no == NULL){
		$phone_sql = mysql_query("select phonetype_id, phone_name, description, IMEI from phone ph, phonetype pt where ph.phoneType_no = pt.phoneType_no and ph.IMEI='".$phone_IMEI."'");
		echo "<tr>";
		echo '<td width="200" id="code"><div align="left">'.mysql_result($phone_sql,0,0).'</div></td>';
		echo '<td width="600" id="name"><div align="left">'.mysql_result($phone_sql,0,1).'<br>'.mysql_result($phone_sql,0,2).'IMEI : '.$phone_IMEI.'</div><br></td>';
		echo '<td width="200" id="qty"><div align="center">'. mysql_result($list_sql,$i,2).'</div></td>';
		echo "</tr>";
                
                $total_qty += mysql_result($list_sql,$i,2);
	}else{
	echo "<tr>";
		echo '<td width="200" id="code"><div align="left">ERROR</div></td>';
		echo '<td width="600" id="name"><div align="left">ERROR</div></td>';
		echo '<td width="200" id="qty"><div align="center">ERROR</div></td>';
		echo "</tr>";
	}	
	}
	echo "</table>";
        
        if($acc_no == NULL){
            echo '總數 : '.$total_qty;
        }
?>
</div>
<!--
<div id="remark">
<table width="510" height="170" cellspacing="0">
<tr>
        	<td height="30" style="border:0.5px solid black;">備註 REMARK(S)</td>
      </tr>
        <tr>
        	<td height="140" style="border:1px solid black;">轉貨原因: <?php echo $transReason; ?></td>
        </tr>
    </table>
</div>
-->
<div id="signOrChop">
<table width="457" cellspacing="0" style="border:0.5px solid black;">
   	<tr><td width="450" height="100" style="border:0.5px solid black;">&nbsp;</td>
   	</tr>
    <tr><td style="border:0.5px solid black;"><div align="center">發件人簽署/蓋印 PREPARED BY</div></td></tr>
</table>
</div>
<div id="signOrChop2">
  <table width="457" cellspacing="0" style="border:1px solid black;">
   	<tr><td width="450" height="100" style="border:1px solid black;">&nbsp;</td>
   	</tr>
    <tr><td style="border:1px solid black;"><div align="center">收件人簽署/蓋印 RECEIVED BY</div></td></tr>
</table></div>
</div>
</body>
</html>