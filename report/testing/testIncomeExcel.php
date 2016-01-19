<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include ("../../conn/sqlconnect.php");

//$sYear = $_GET[""];
//$sMonth = $_GET[""];

$export = mysql_query("select createDate, payment_has_invoice.invoice_no, total, paymentName, retail_id, staff_id from invoice, payment, payment_has_invoice, retailshop, staff where invoice.staff_no = staff.staff_no and invoice.retailShop_no = retailshop.retailShop_no and invoice.invoice_no = payment_has_invoice.invoice_no and payment_has_invoice.payment_no = payment.payment_no");
$data = '';

$col_title = '<tr><th>日期</th><th>單號</th><th>總金額</th><th>付款方式</th><th>分店</th><th>開單員工</th></tr>';

while($row = mysql_fetch_row($export)) {
        $line = '';
        foreach($row as $value) {
                if ((!isset($value)) OR ($value == "")) {
                        $value = "\t"; 
                } else {
                        $value = str_replace('"', '', $value);
                        $value = '<td>' . $value . '</td>' . "\t";
                }
                		$line .= $value;
				
        }
        $data .= trim("<tr>".$line."</tr>")."\n";
}

$data = str_replace("\t","",$data);
$xls_header = '<table border="1" align="center" cellspacing="1" cellpadding="10"><tr></tr><tr></tr>';
$xls_footer = '</table>';

$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=Income".$saveDate.".".$file_ending);


print $xls_header.$col_title.$data.$xls_footer;
exit;
?>
</body>
</html>