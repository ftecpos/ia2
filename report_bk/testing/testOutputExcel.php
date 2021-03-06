<?php

require ("../../conn/sqlconnect.php");

$export = mysql_query("select rec_date, stockIn_no, acc_id, accName, rec_qty, iprice, supplierName, retail_id, staff_id, podetail.po_no from staff, accessories, podetail, po, stockin, supplier, retailshop where stockin.acc_no = accessories.acc_no and stockin.retailShop_no = retailshop.retailShop_no and stockin.staff_no = staff.staff_no and stockin.poDetail_no = podetail.poDetail_no and podetail.po_no = po.po_no and po.supplier_no = supplier.supplier_no"); 
$fields = mysql_num_fields($export);
$col_title = '';
$data = '';

for ($i = 0; $i < $fields; $i++) {
        $col_title .= '<td>'.mysql_field_name($export, $i).'</td>';
}

$col_title = '<tr>'.$col_title.'</tr>';

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

header("Content-Type: application/vnd.ms-excel;");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");

$xls_header = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
</head>
<body>
<table border="1" align="center">';

$xls_footer = '</table>
</body>
</html>';

print $xls_header.$col_title.$data.$xls_footer;
exit;

?>