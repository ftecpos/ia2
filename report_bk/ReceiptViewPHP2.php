
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/ReportViewCSS.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt View</title>

<script LANGUAGE="JavaScript">
function toPrint() {
print();
}
</SCRIPT>

</head>

<body>
<?php
	$shopNo = $_GET["shopNo"];
	$address = $_GET["address"];
	$tel = $_GET["tel"];
	$date = $_GET["date"];
	$receipt_No = $_GET["receipt_No"];
	$staff_No = $_GET["stNo"];
	$pay_Method = $_GET["payMethod"];
	$total = $_GET["total"];
	$cash_in = $_GET["cash_in"];
	$change = $_GET["change"];
	$total_pay = $_GET["total_pay"];
	$item_list = $_GET["item_list"];
	$remark = $_GET["remark"];
?>
<div id="A4">
<div id="image"><img src="../img/TT1006.jpg" width="200" height="120" /></div>
<div id="title">
  <table width="400" border="1">
    <tr>
      <td height="58"><div align="center">Customer Copy<br />
        客戶存單</div></td>
      <td><div align="center"><b>RECEIPT 銷售收據</b></div></td>
    </tr>
  </table>
</div>

<div id="address">
<?php
	echo '分店 SHOP: '.$shop_no.'<br>';
	echo '地址 ADDRESS: '.$address.'<br>';
	echo '電話 TEL.: '.$tel.'<br>';
?></div>

<div id="dateAndNo">
  <table width="300" border="0">
  	<tr>
  		<td align="left">購買日期	 DATE</td>
    </tr>
    <tr>
	  <td align="right">
      <?php echo @$date; ?>      </td>
    </tr>
	<tr>
    	<td align="left">收據編號	 RECEIPT No.</td>
    </tr>
    <tr>
        <td align="right">
        <?php echo @$receipt_No;	?>        </td>
	</tr>
    <tr>
    	<td align="left">職員編號 STAFF No.</td>
    </tr>
    <tr>
        <td align="right">
        <?php echo @$staff_No; ?>        </td>
	</tr>
  </table>
</div>

<div id="listHeader">
  <table width="1000" border="0">
    <tr>
		<td width="200">編號<br />
        CODE</td>
      <td width="400">產品資料<br />
      PRODUCT DESCRIPTION</td>
      <td width="68"><div align="center">數量<br />
      QTY</div></td>
      <td width="100"><div align="right">單價<br />
      UNIT PRICE</div></td>
      <td width="100"><div align="right">折扣 %<br />
      DISCOUNT</div></td>
      <td width="130"><div align="right">金額<br />
      AMOUNT HKD</div></td>
    </tr>
  </table>
</div>
<div id="itemList">
<?php 
	echo '<table width="1000" border="0">';
	for($i=0; $i<$item_list.length-1; $i+6){
		echo "<tr>";
		echo '<td width="200" id="code"><div align="left">'.$item_list[i].'</div></td>';
		echo '<td width="400" id="name"><div align="left">'.$itemlist[i+1].'</div></td>';
		echo '<td width="68" id="qty"><div align="center">'.$itemlist[i+2].'</div></td>';
		echo '<td width="100" id="unitPrice"><div align="right">'.$itemlist[i+3].'</div></td>';
		echo '<td width="100" id="discount"><div align="right">'.$itemlist[i+4].'</div></td>';
		echo '<td width="130" id="amount"><div align="right">'.$itemlist[i+5].'</div></td>';
		echo "</tr>";
	}
	echo "</table>";
	echo "<br />";
	echo '<table width="900" border="0">';
	echo '<tr><td width="700"><div align="right">合計金額:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">'.$total.'</div></td></tr>';
	//for($j=0;$j<4;j++){
	switch($pay_method){
		case"1":
			echo '<tr><td width="700"><div align="right">Cash-in:</div></td>';
				echo '<td width="100"><div align="left">$HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$cash_in.'</div></td></tr>';
			continus;
		case"2":
			echo '<tr><td width="700"><div align="right">EPS:</div></td>';
				echo '<td width="100"><div align="left">$HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$cash_in.'</div></td></tr>';
			continue;
		case"3":
			echo '<tr><td width="700"><div align="right">信用卡:</div></td>';
				echo '<td width="100"><div align="left">$HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$cash_in.'</div></td></tr>';
			continue;
		case"4":
			echo '<tr><td width="700"><div align="right">八逹通:</div></td>';
				echo '<td width="100"><div align="left">$HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$cash_in.'</div></td></tr>';
			continue;
	}
	echo '<tr><td width="700"><div align="right">Change:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">'.$change.'</div></td></tr>';
	echo '<tr><td width="700"><div align="right">Total:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">'.$total_pay.'</div></td></tr>';
	echo "</table>";
?>
</div>
<div id="remark">
<table width="510" height="170" border="0">
<tr>
        	<td height="30">備註 REMARK(S)</td>
      </tr>
        <tr>
        	<td height="140"><?php @$remark ?></td>
        </tr>
    </table>
</div>
<div id="signOrChop">
  <table width="457" border="1">
   	<tr><td width="450" height="100">&nbsp;</td>
   	</tr>
    <tr><td><div align="center">顧客簽署/蓋印 CUSTOMER SIGNATURE/CHOP</div></td></tr>
</table></div>
</div>
</body>
</html>
