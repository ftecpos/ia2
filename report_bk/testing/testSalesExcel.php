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

$export_phone = mysql_query("SELECT phonetype_id, phone_name, sum(invoicedetail.qty) FROM invoicedetail, phone, phonetype, invoice where invoicedetail.product_no = phone.IMEI and phone.phoneType_no = phonetype.phoneType_no and invoicedetail.invoice_no = invoice.invoice_no group by invoicedetail.description");
 
$export_acc = mysql_query("SELECT acc_id, accName, acctype.typeName, sum(invoicedetail.qty) FROM invoicedetail, accessories, acctype, invoice where invoicedetail.goodsType = accessories.accType_no and accessories.accType_no = acctype.accType_no and invoicedetail.description = accessories.accName and invoicedetail.invoice_no = invoice.invoice_no group by invoicedetail.description");
$data = '';

$col_title = '<tr><th>產品編號</th><th>產品名稱</th><th>數量</th><th>分類</th></tr>';

while($row = mysql_fetch_row($export_acc)) {
        $line = '';
		//$temp = 0;
        foreach($row as $value) {
                if ((!isset($value)) OR ($value == "")) {
                        $value = "\t";
						//$temp++; 
                } else {
                        $value = str_replace('"', '', $value);
                        $value = '<td>' . $value . '</td>' . "\t";
						//$temp++;
                }
                		$line .= $value;
				
        }
        $data .= trim("<tr>".$line."</tr>");
		$temp = 0;
}

while($row = mysql_fetch_row($export_phone)) {
        $line = '';
		//$temp = 0;
        foreach($row as $value) {
                if ((!isset($value)) OR ($value == "")) {
                        $value = "\t";
						//$temp++; 
                } else {
                        $value = str_replace('"', '', $value);
                        $value = '<td>' . $value . '</td>' . "\t";
						//$temp++;
                }
                		$line .= $value;
				
        }
        $data .= trim("<tr>".$line."<td>手機</td></tr>");
		$temp = 0;
}

$data = str_replace("\t","",$data);
$xls_header = '<table border="1" align="center" cellspacing="1" cellpadding="10"><tr></tr><tr></tr>';
$xls_footer = '</table>';

$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=SalesAmount".$saveDate.".".$file_ending);


print $xls_header.$col_title.$data.$xls_footer;
exit;
?>
</body>
</html>
