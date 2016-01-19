
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../css/ReportViewCSS.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transfer Note Report</title>

<script LANGUAGE="JavaScript">
function toPrint() {
print();
}
</SCRIPT></head>

<body onload="toPrint()">
<?php
	$fromR = $_GET[""];
	$toR = $_GET[""];
	$address = $_GET[""];
	$tel = $_GET[""];
	$tranDate = $_GET[""];
	$tranNo = $_GET[""];
	$staff_No = $_GET[""];
	$itemArray = $_GET[""};
?>
<div id="A4">
<div id="image"><img src="../img/TT1006.jpg" width="200" height="120" /></div>
<div id="title">
  <table width="400" border="1">
    <tr>
      <td height="58"><div align="center">Transfer Note<br />
      </div></td>
      <td><div align="center"><strong>轉貨單</strong></div></td>
    </tr>
  </table>
</div>

<div id="address">
<?php 
echo '出貨分店 From: '.$toR.'<br />';
echo '收貨分店 To: '.$toR.'<br />';
echo '地址 Address: '.$addr.'<br />';
echo '電話 Tel: '.$tel.'<br />';
?>
</div>

<div id="dateAndNo">
  <table width="300" border="0">
  	<tr>
  		<td align="left">轉貨單日期	DATE OF TRANSFER NOTE</td>
    </tr>
    <tr>
	  <td align="right"><?php echo $tranDate; ?></td>
    </tr>
	<tr>
    	<td align="left">轉貨單編號	Transfer Note No.</td>
    </tr>
    <tr>
        <td align="right"><?php echo $tranNo; ?></td>
	</tr>
    <tr>
    	<td align="left">開單員工 Prepare by</td>
    </tr>
    <tr>
        <td align="right"><?php echo $staffNo; ?></td>
	</tr>
  </table>
</div>

<div id="listHeader">
  <table width="1000" border="0">
    <tr>
      <td width="200">編號<br />CODE</td>
      <td width="650">產品名稱<br />
      PRODUCT DESCRIPTION</td>
      <td width="100"><div align="center">數量<br />QTY</div></td>
    </tr>
  </table>
</div>
<div id="itemList">
<table width="1000" border="0">
    <tr>
      <td width="200" id="code"><div align="left">&nbsp;</div></td>
      <td width="650" id="name"><div align="left">&nbsp;</div></td>
      <td width="100" id="qty"><div align="center">&nbsp;</div></td>
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
    <tr><td><div align="center">收件人簽署/蓋印 RECEIVED BY</div></td></tr>
</table></div>
</div>
</body>
</html>