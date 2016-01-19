
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
	$PO_no = $_GET[""];
	$PO_date = $_GET[""];
	$staff_no = $_GET[""];
	$sup_id = $_GET[""];
	$sup_name = $_GET[""];
	$addr = $_GET[""];
	$tel = $_GET[""];
	$PO_detail = $_GET[""];
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
	echo "供應商編號 SUPPLIER CODE: ".$sup_id."<br />";
	echo "供應商名稱 SUPPLIER: ".$sup_name."<br />";
	echo "地址 ADDRESS: ".$addr."<br />";
	echo "電話 TEL: ".$tel."<br />";
?>
</div>

<div id="dateAndNoPO">
  <table width="300" border="0">
  	<tr>
  		<td align="left">訂單日期	DATE OF PO</td>
    </tr>
    <tr>
	  <td align="right"><?php echo $PO_date; ?></td>
    </tr>
	<tr>
    	<td align="left">訂單編號	PO No.</td>
    </tr>
    <tr>
        <td align="right"><?php echo $PO_no; ?></td>
	</tr>
    <tr>
    	<td align="left">付款方式 Payment Term</td>
  	</tr>
    <tr>
        <td align="right"><?php echo $PO_detail; ?></td>
	</tr>
    <tr>
    	<td align="left">開單員工 Prepare by.</td>
    </tr>
    <tr>
        <td align="right"><?php echo $staff_no; ?></td>
	</tr>
  </table>
</div>

<div id="listHeader">
  <table width="1000" border="0">
    <tr>
      <td width="110">編號<br />CODE</td>
      <td width="300">產品名稱<br />PRODUCT NAME</td>
      <td width="200">供應商<br />SUPPLIER</td>
      <td width="50"><div align="center">數量<br />QTY</div></td>
      <td width="100"><div align="center">單價<br />UNIT PRICE</div></td>
      <td width="100"><div align="center">折扣%<br />DISCOUNT</div></td>
      <td width="120"><div align="center">金額<br />AMOUNT HKD</div></td>
    </tr>
  </table>
</div>
<div id="itemList">
<table width="1000" border="0">
    <tr>
      <td width="110" id="code"><div align="left">&nbsp;</div></td>
      <td width="300" id="name"><div align="left">&nbsp;</div></td>
      <td width="200" id="supplier"><div align="left">&nbsp;</div></td>
      <td width="50" id="qty"><div align="center">&nbsp;</div></td>
      <td width="100" id="unitPrice"><div align="center">&nbsp;</div></td>
      <td width="100" id="discount"><div align="center">&nbsp;</div></td>
      <td width="120" id="amount"><div align="center">&nbsp;</div></td>
    </tr>
</table>
</div>
<div id="remark">
<table width="510" height="170" border="0">
<tr>
        	<td height="30">備註 REMARK(S)</td>
      </tr>
        <tr>
        	<td height="140">&nbsp;</td>
        </tr>
    </table>
</div>
<div id="signOrChop">
  <table width="457" border="1">
   	<tr><td width="450" height="100">&nbsp;</td>
   	</tr>
    <tr><td><div align="center">店鋪經理簽署/蓋印 SHOP MANAGER SIGNATURE/CHOP</div></td></tr>
</table></div>
</div>
</body>
</html>
