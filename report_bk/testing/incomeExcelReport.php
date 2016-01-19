<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include ("../../conn/sqlconnect.php");

$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=IncomeReportV01".$saveDate.".".$file_ending);

echo '<table border="0">'.
			 	'<tr><th style="width: 150px">日期</th>'.
				'<th style="width: 120px">單號</th>'.
				'<th style="width: 80px">折扣</th><th style="width: 80px">總金額</th>'.
				'<th style="width: 100px">付款方法</th>'.'
				<th style="width: 100px">分店</th><th style="width: 100px">開單員工</th></tr>';
				
//$sql1 = "SELECT *, sum(discount) as tol_discount FROM invoice LEFT JOIN invoicedetail ON invoice.invoice_no=invoicedetail.invoice_no LEFT JOIN retailShop ON invoice.retailShop_no=retailShop.retailShop_no LEFT JOIN (payment_has_invoice LEFT JOIN payment ON payment.payment_no=payment_has_invoice.payment_no) ON invoice.invoice_no=payment_has_invoice.invoice_no WHERE createDate > '2012-01-01'";

$sql1 = "SELECT *, sum(discount) as tol_discount FROM invoice LEFT JOIN invoicedetail ON invoice.invoice_no=invoicedetail.invoice_no LEFT JOIN retailShop ON invoice.retailShop_no=retailShop.retailShop_no LEFT JOIN (payment_has_invoice LEFT JOIN payment ON payment.payment_no=payment_has_invoice.payment_no) ON invoice.invoice_no=payment_has_invoice.invoice_no";

if(isset($_GET['from']) && isset($_GET['to'])){
	$startDay = $_GET['from'];
	$endDay = $_GET['to'];
	if($startDay != '' && $endDay != '') {	
	$startDay_s1=explode('-',$startDay);
	$endDay_s1=explode('-',$endDay);
	$sql1 .=" where year(createDate) >= ".$startDay_s1[0]." and year(createDate) <= ".$endDay_s1[0]."	AND month(createDate) >= ".$startDay_s1[1]." AND month(createDate) >= ".$endDay_s1[1]." AND day(createDate) >= ".$startDay_s1[2]." AND day(createDate) <= ".$endDay_s1[2];
} else {
	$today = date("Y-m-d");
	$today_s1 = explode('-', $today);
	$sql1 .=" where year(createDate) = ".$today_s1[0]." AND month(createDate) = ".$today_s1[1]." AND day(createDate) = ".$today_s1[2];
}}

$sql1 .= " AND invoiceState_no != '2' GROUP BY invoice.invoice_no, payment_has_invoice.payment_no ORDER BY retail_id";

$result1 = mysql_query($sql1);
$total_income = 0;

while($row1 = mysql_fetch_array($result1)){
	echo '<tr>';
	$invoice_date = explode(' ', $row1['createDate']);
	echo '<td>'.$invoice_date[0].'</td>';
	if($row1['invoiceType_no'] == '1'){
			$numHead = 'SA-';
	}
	if($row1['invoiceType_no'] == '2'){
		$numHead = 'SR-';
	}
	$numLength = strlen($row1['invoice_no']);
	$tempZero = '';
	$zeroCount = 7;
	$addZero = $zeroCount-$numLength;
	while($addZero!=0){
		$tempZero.='0';
		$addZero--;
	}
	$output1 = $numHead.$tempZero.$row1['invoice_no'];
	echo '<td>'.$output1.'</td>';
	echo '<td>'.number_format($row1['tol_discount'],1,'.',',').'</td>';
	echo '<td>'.number_format($row1['money'],1,'.',',').'</td>';
	echo '<td>'.$row1['paymentName'].'</td>';
	echo '<td>'.$row1['retail_id'].'</td>';
	echo '<td>'.$row1['createBy'].'</td>';
	echo '</tr>';
	$total_income = $total_income + $row1['money'];
}

echo '<tr><td></td><td></td><td></td><td>總金額：</td>';
echo '<td>'.number_format($total_income,1,'.',',').'</td>';
echo '<td></td><td></td><td></td></tr>';

echo '</table>';				
?>
</body>
</html>
