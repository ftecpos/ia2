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
header("Content-Disposition: attachment; filename=StockinReportV01".$saveDate.".".$file_ending);

echo '<table border="0">';
echo '<tr><th style="width: 150px">入貨日期</th>'.
		'<th style="width: 120px">單號</th>'.
		'<th style="width: 450px">產品名稱</th>'.
		'<th style="width: 50px">數量</th>'.
		'<th style="width: 80px">入貨金額</th>'.
		'<th style="width: 80px">總金額</th>'.
		'<th style="width: 100px">供應商編號</th>'.
		'<th style="width: 100px">貨倉位置</th>'.
		'<th style="width: 100px">開單員工</th>'.
		'<th style="width: 120px">PO No.</th></tr>';
		
$sql1="select sinno_ref_no, staff_id from sinno_ref LEFT JOIN staff ON sinno_ref.createBy=staff.staff_no";

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
	$sq11 .=" where year(createDate) = ".$today_s1[0]." AND month(createDate) = ".$today_s1[1]." AND day(createDate) = ".$today_s1[2];
}}

$result1 = mysql_query($sql1);

while ($row1 = mysql_fetch_array($result1)) {
	$sinno_ref_no = $row1['sinno_ref_no'];
	
	$numLength = strlen($sinno_ref_no);
	$tempZero = '';
	$zeroCount = 7;
	$addZero = $zeroCount-$numLength;
	while($addZero!=0) {
		$tempZero.='0';
		$addZero--;
	}
	$final_sinno_ref_no = "SI-".$tempZero.$sinno_ref_no;
	
	$sql2 = "select * from stockin LEFT JOIN accessories ON stockin.acc_no=accessories.acc_no LEFT JOIN retailShop ON stockin.retailShop_no=retailShop.retailShop_no LEFT JOIN staff ON stockin.staff_no=staff.staff_no LEFT JOIN  ( po left join podetail ON po.po_no=podetail.po_no LEFT JOIN supplier ON po.supplier_no=supplier.supplier_no) ON stockin.poDetail_no = podetail.poDetail_no where sinno_ref_no=".$sinno_ref_no;
	
	/*if(isset($_POST['supplier'])){
		$supplier = $_POST['supplier'];
		$sql2 .=" and po.supplier_no in ($supplier)";
	}
	if(isset($_POST['accMobi_list'])){
		$accMobi_list = $_POST['accMobi_list'];
		if($accMobi_list =='mobile')
			$sql2 .=" and accessories.accType_no = 'dddd'";
		else
			$sql2 .=" and accessories.accType_no = $accMobi_list";
	}
	if(isset($_POST['product_id'])){
		$product_id = $_POST['product_id'];
		$sql2 .=" and accessories.acc_id = '$product_id'";
	}*/

	$result2 = mysql_query($sql2);
	$num_rows2 = mysql_num_rows($result2);
	$all_totaliprice=0;
		while ($row2 = mysql_fetch_array($result2)) {
			$rec_qty = $row2['rec_qty'];
			$iprice = $row2['iprice'];
			$totaliprice=($rec_qty*$iprice);
						
			$po_no = $row2['po_no'];
			$numLength = strlen($po_no);
			$tempZero = '';
			$zeroCount = 7;
			$addZero = $zeroCount-$numLength;
			while($addZero!=0){
				$tempZero.='0';
				$addZero--;
			}
			$finalPoNo = "PO-".$tempZero.$po_no;
						
			$_DATE2 = $row2['rec_date'];
			$DATE2 = explode(' ',$_DATE2);
					
			echo '<tr><td>'.$DATE2[0].'</td>';
			echo '<td>'.$final_sinno_ref_no.'</td>';
			echo '<td>'.$row2['accName'].'</td>';
			echo '<td>'.$row2['rec_qty'].'</td>';
			echo '<td>$'.number_format($iprice,1,'.',',').'</td>'.
					'<td>$'.number_format($totaliprice,1,'.',',').'</td>'.
					'<td>'.$row2['supplier_id'].'</td>';
			echo '<td>'.$row2['retail_id'].'</td>';
			echo '<td>'.$row2['staff_id'].'</td>';
			echo '<td>'.$finalPoNo.'</td></tr>';
					
		}
		
		
		
		$sql3 = "select *, count(*) as si_qty from phone LEFT JOIN phonetype ON phone.phoneType_no=phonetype.phoneType_no LEFT JOIN retailShop ON phone.retailShop_no=retailShop.retailShop_no LEFT JOIN  ( po left join podetail ON po.po_no=podetail.po_no LEFT JOIN supplier ON po.supplier_no=supplier.supplier_no) ON phone.poDetail_no = podetail.poDetail_no WHERE sinno_ref_no=".$sinno_ref_no;
		$sql3 .= " group by sinno_ref_no";
		
			/*if(isset($_POST['supplier'])) {
				$supplier = $_POST['supplier'];
				$sql3 .=" and po.supplier_no in ($supplier)";
			}
			if(isset($_POST['accMobi_list'])) {
				$accMobi_list = $_POST['accMobi_list'];
				if($accMobi_list!='mobile') {
					$sql3 .=" and ph.phoneType_no = 'ddd'";
				}
			}
			if(isset($_POST['product_id'])) {
				$product_id = $_POST['product_id'];
				$sql3 .=" and phonetype_id = '$product_id'";
			}*/
			
		$result3 = mysql_query($sql3);
		$all_totaliprice=0;
			
			while ($row3 = mysql_fetch_array($result3)) {
				$iprice = $row3['cost'];
				$totaliprice=($row3['si_qty']*$iprice);
				$tempPoNo = $row3['po_no'];
					
				$po_no = $row2['po_no'];
				$numLength = strlen($po_no);
				$tempZero = '';
				$zeroCount = 7;
				$addZero = $zeroCount-$numLength;
				while($addZero!=0){
					$tempZero.='0';
					$addZero--;
				}
				$finalPoNo = "PO-".$tempZero.$po_no;
						
				$_DATE3=$row3['rec_date'];
				$DATE3=explode(' ',$_DATE3);
				
				$sinno_ref_no = $row3['sinno_ref_no'];
				$numLength = strlen($sinno_ref_no);
				$tempZero = '';
				$zeroCount = 7;
				$addZero = $zeroCount-$numLength;
				while($addZero!=0){
					$tempZero.='0';
					$addZero--;
				}
				$final_sinno_ref_no = "SI-".$tempZero.$sinno_ref_no;
					
				echo '<tr><td>'.$DATE3[0].'</td>';
				echo '<td>'.$final_sinno_ref_no.'</td>';
				echo '<td >'.$row3['manufacturer'].' '.$row3['phone_name'].' ('.$row3['color'].')</td>';
				echo '<td>'.$row3['si_qty'].'</td>';
				echo '<td>$'.number_format($iprice,1,'.',',').'</td>'.
						'<td>$'.number_format($totaliprice,1,'.',',').'</td>'.
						'<td>'.$row3['supplier_id'].'</td>';
				echo '<td>'.$row3['retail_id'].'</td>';
				echo '<td>'.$row1['staff_id'].'</td>';
				echo '<td>'.$finalPoNo.'</td></tr>';
				
				$sql4 = "select imei from phone where sinno_ref_no =".$row3['sinno_ref_no'];
				$result4 = mysql_query($sql4);
				while ($row4 = mysql_fetch_array($result4)) {
					echo '<tr><td></td><td></td>';
					echo '<td>'.$row4['imei'].'</td></tr>';
				}
				
			}

				
}

echo '</table>';
?>
</body>
</html>
