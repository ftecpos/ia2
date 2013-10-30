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
header("Content-Disposition: attachment; filename=TransferReport".$saveDate.".".$file_ending);


//$trans_no = $get['trans_no']

echo '<table border="0">';
echo '<tr><th style="width: 100px">開單日期</th>
		<th style="width: 120px">單號</th>
		<th style="width: 450px">產品名稱</th>
		<th style="width: 80px">數量</th>
		<th style="width: 100px">出貨分店</th>
		<th style="width: 100px">收貨分店</th>
		<th style="width: 200px">狀況</th>
		<th style="width: 150px">開單員工</th></tr>';

	
$sql = "select transfer_no from transfer";

if(isset($_GET['from']) && isset($_GET['to'])){
	$startDay = $_GET['from'];
	$endDay = $_GET['to'];
if($startDay != '' && $endDay != '') {	
	$startDay_s1=explode('-',$startDay);
	$endDay_s1=explode('-',$endDay);
	$sql .=" where year(transDate) >= ".$startDay_s1[0]." and year(transDate) <= ".$endDay_s1[0]."	AND month(transDate) >= ".$startDay_s1[1]." AND month(transDate) >= ".$endDay_s1[1]." AND day(transDate) >= ".$startDay_s1[2]." AND day(transDate) <= ".$endDay_s1[2];
} else if($startDay != ''){
	$startDay_s1=explode('-',$startDay);
	$today = date("Y-m-d");
	$today_s1 = explode('-', $today);
	$sql .=" where year(transDate) >= ".$startDay_s1[0]." and year(transDate) <= ".$today_s1[0]."	AND month(transDate) >= ".$startDay_s1[1]." AND month(transDate) >= ".$today_s1[1]." AND day(transDate) >= ".$startDay_s1[2]." AND day(transDate) <= ".$today_s1[2];
} else {
	$today = date("Y-m-d");
	$today_s1 = explode('-', $today);
	$sql .=" where year(transDate) = ".$today_s1[0]." AND month(transDate) = ".$today_s1[1]." AND day(transDate) = ".$today_s1[2];
}}

$result = mysql_query($sql);

while ($row1 = mysql_fetch_array($result)) {
	$trans_no = $row1['transfer_no'];
	$sql2 = "select transDate, transdetail.transfer_no, acc_id, transdetail.IMEI, accName, phonetype.manufacturer, phone_name, phonetype.color, phonetype_id, sum(trans_qty) as trans_qty, fr.retail_id as frid, tr.retail_id as trid, stateName, staff_id FROM transfer LEFT JOIN retailShop AS fr ON transfer.fromRetail_no = fr.retailShop_no LEFT JOIN retailShop AS tr ON transfer.toRetail_no = tr.retailShop_no LEFT JOIN transstate ON transfer.transState_no = transstate.transState_no LEFT JOIN staff ON transfer.staff_no=staff.staff_no, transdetail LEFT JOIN accessories ON transdetail.acc_no = accessories.acc_no LEFT JOIN  ( phone left join phonetype ON phone.phoneType_no = phonetype.phoneType_no) ON transdetail.IMEI = phone.IMEI WHERE transfer.transfer_no = transdetail.transfer_no and transfer.transfer_no=".$trans_no;
	$sql2 .= " GROUP BY transdetail.acc_no, fr.retailShop_no ORDER BY transfer.transfer_no";
				
	$result2 = mysql_query($sql2);
	$num_rows = mysql_num_rows($result2);
	$_temp = null;
	if ($result2 && $num_rows>0) {
		$total_qty=0;
		while ($row2 = mysql_fetch_array($result2)) {
			if ($row2['transfer_no'] != null) {
				$_temp = $row2['transfer_no'];
				$date1 = $row2['transDate'];
				$date1_s1 = explode(' ',$date1);
				$total_qty = $total_qty + $row2['trans_qty'];
				
				$tempTransfer_no = $row2['transfer_no'];
				
				$numLength = strlen($tempTransfer_no);
				$tempZero = '';
				$zeroCount = 7;
				$addZero = $zeroCount-$numLength;
				while($addZero!=0){
					$tempZero.='0';
					$addZero--;
				}
							
				$finalTransNo = "TR-".$tempZero.$tempTransfer_no;
				echo '<tr><td>'.$date1_s1[0].'</td>'.
						'<td>'.$finalTransNo.'</td>';
				if($row2['accName']!=null) {
					echo '<td>'.$row2['accName'].'</td>';
				}else {
					echo '<td>'.$row2['manufacturer'].' '.$row2['phone_name'].' ('.$row2['color'].')</td>';
				}
				echo '<td>'.$row2['trans_qty'].'</td>'.
					 '<td>'.$row2['frid'].'</td>'.
					 '<td>'.$row2['trid'].'</td>'.
					 '<td>'.$row2['stateName'].'</td>'.
					 '<td>'.$row2['staff_id'].'</td>'.
					 '</tr>';
				if($row2['accName']==null) {
					$sql3="select imei from transdetail where transfer_no=".$tempTransfer_no;
					$result3 = mysql_query($sql3);
					if ($result3) {
						while ($row3 = mysql_fetch_array($result3)) {
							echo '<tr><td colspan="2"></td><td>'.$row3['imei'].'</td></tr>';
						}
					}
				}	
			}
		}
	}
}

echo '</table>';

?>
</body>
</html>
