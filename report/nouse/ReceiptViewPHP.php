
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Receipt View</title>

<script LANGUAGE="JavaScript">
function toPrint() {
print();
}
</SCRIPT>
<script type="text/javascript" src="../js/main.js"></script>
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

echo "Shop No: ".$shopNo." ";
echo "Shop Address: ".$address." ";
echo "Tel: ".$tel." ";
echo "Date: ".$date." ";
echo "Reciept No: ".$receipt_No." ";
echo "Staff No:".$staff_No." ";
echo "Payment Method: ".$pay_Method." ";
echo "Total: ".$total." ";
echo "Cash-in: ".$cash_in." ";
echo "Change: ".$change." ";
echo "Total Pay: ".$total_pay." ";
//for (i=0; i<$item_list.length; i++){
//	echo "Item list: ".$item_list[i]." ";
//}
echo "Remark: ".$remark;
?>
</body>
</html>
