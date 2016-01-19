<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<?php
include ("../../conn/sqlconnect.php");

$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=StockInBackup".$saveDate.".".$file_ending);


//$trans_no = $get['trans_no']

echo '<table border="0">';
	
$sql = "select * from stockin where rec_qty = 0";

echo '<tr>';

$result = mysql_query($sql);

while ($field_name = mysql_fetch_field($result)) {
	echo '<th>'.$field_name->name.'</th>';
}

echo '</tr>';


$num_rows = mysql_num_rows($result);

while ($row = mysql_fetch_array($result)) {
	echo '<tr>';
	echo '<td>'.$row['stockIn_no'].'</td>'.'<td>'.$row['poDetail_no'].'</td>'.'<td>'.$row['staff_no'].'</td>'.'<td>'.$row['acc_no'].'</td>'.'<td>'.$row['retailShop_no'].'</td>'.'<td>'.$row['rec_qty'].'</td>'.'<td>'.$row['rec_date'].'</td>'.'<td>'.$row['po_date'].'</td>'.'<td>'.$row['iprice'].'</td>'.'<td>'.$row['ava_bal'].'</td>'.'<td>'.$row['trans_qty'].'</td>'.'<td>'.$row['sinno_ref_no'].'</td>'.'<td>'.$row['transDetail_no'].'</td>';
	echo '</tr>';
}

echo '</table>';

?>
</body>
</html>
