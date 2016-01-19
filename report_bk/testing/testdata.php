<?php

require ("../../conn/sqlconnect.php");

$export = mysql_query("select rec_date, stockIn_no, acc_id, accName, rec_qty, iprice, supplierName, retail_id, staff_id, podetail.po_no from staff, accessories, podetail, po, stockin, supplier, retailshop where stockin.acc_no = accessories.acc_no and stockin.retailShop_no = retailshop.retailShop_no and stockin.staff_no = staff.staff_no and stockin.poDetail_no = podetail.poDetail_no and podetail.po_no = po.po_no and po.supplier_no = supplier.supplier_no"); 
$fields = mysql_num_rows($export);
$rows = mysql_num_fields($export);
$col_title = '';
$data = '';

echo $fields.$rows;

for ($i = 0; $i < $rows; $i++) {
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

$data = str_replace("\r","",$data);

print $col_title.$data;


?>
