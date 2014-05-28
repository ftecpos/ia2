<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include ("../../conn/sqlconnect.php");
set_time_limit(900);

$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=InventoryOverviewReport".$saveDate.".".$file_ending);

echo '<table border="0">';
echo '<tr><th style="width: 120px">產品編號</th>';
echo '<th style="width: 450px">產品名稱</th>';
echo '<th style="width: 100px">分類</th>';
echo '<th style="width: 120px">總庫存數量</th>';
//////////////////////////// List of retail id //////////////////////////////
$sql1 = "select * from retailshop order by retail_id";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_assoc($result1)){
	echo '<th style="width: 110px">'.$row1['retail_id'].'</th>';
}				
echo '</tr>';
//////////////////////////////////// List Accessories Inventory ////////////////////////////////////////
$sql2 = "select * from accessories left join acctype on acctype.accType_no = accessories.accType_no
             WHERE noshow <> 1
            ";
$result2 = mysql_query($sql2);
while($row2 = mysql_fetch_assoc($result2)){
	echo '<tr>';
	echo '<td>'.$row2['acc_id'].'</td><td>'.$row2['accName'].'</td><td>'.$row2['typeName'].'</td>';
	$temp_acc_no = $row2['acc_no'];
	$total_qty = 0;
	$qtyPerShop = array();
	$temp_row = '';
	$sql1 = "select * from retailshop order by retail_id";
	$result1 = mysql_query($sql1);
	while($row1 = mysql_fetch_assoc($result1)){
		$temp_shop_no=$row1['retailShop_no'];
		$sql3="select sum(ava_bal) as tol_qty from stockin left join (accessories left join acctype ON accessories.accType_no=acctype.accType_no) ON stockin.acc_no = accessories.acc_no where stockin.retailShop_no='".$temp_shop_no."' and stockin.acc_no='".$temp_acc_no."' group by stockin.acc_no,stockin.retailShop_no";
		$result3 = mysql_query($sql3);
		$count3 = mysql_num_rows(mysql_query($sql3));
		if($count3 == null){
			$qtyPerShop[] = '<td>0</td>';
			//$temp_row .= '<td>0</td>';
		}else{
			while($row3 = mysql_fetch_assoc($result3)){
				$qtyPerShop[] = '<td>'.$row3['tol_qty'].'</td>';
				//$temp_row .= '<td>'.$row3['tol_qty'].'</td>';
				$total_qty = $total_qty+$row3['tol_qty'];
			}
		}
	}
	echo '<td>'.$total_qty.'</td>';
	$qty_length = count($qtyPerShop);
	for($i=0; $i<$qty_length; $i++){
		echo $qtyPerShop[$i];
	}
	//echo $temp_row;
	echo '</tr>';
}
//////////////////////////////// List Phones Inventory ///////////////////////////////////////////////
$sql4 = "select * from phonetype";
$result4 = mysql_query($sql4);
while($row4 = mysql_fetch_assoc($result4)){
	echo '<tr>';
	echo '<td>'.$row4['phonetype_id'].'</td><td>'.$row4['manufacturer'].' '.$row4['phone_name'].' ('.$row4['color'].')</td><td>手機</td>';
	$temp_phoneType_no = $row4['phoneType_no'];
	$total_qty = 0;
	$qtyPerShop = array();
	$sql1 = "select * from retailshop order by retail_id";
	$result1 = mysql_query($sql1);
	while($row1 = mysql_fetch_assoc($result1)){
		$temp_shop_no = $row1['retailShop_no'];
		$sql5="select count(*) as tol_qty from phone where phone.retailShop_no='".$temp_shop_no."' and phone.phoneType_no='".$temp_phoneType_no."' and phone.phoneState_no=1 group by phone.retailShop_no, phone.phoneType_no";
		$result5 = mysql_query($sql5);
		$count5 = mysql_num_rows(mysql_query($sql5));
		if($count5 == null){
			$qtyPerShop[] = '<td>0</td>';
		}else{
			while($row5 = mysql_fetch_assoc($result5)){
				$qtyPerShop[] = '<td>'.$row5['tol_qty'].'</td>';
				$total_qty = $total_qty+$row5['tol_qty'];
			}
		}
	}
	echo '<td>'.$total_qty.'</td>';
	$qty_length = count($qtyPerShop);
	for($i=0; $i<$qty_length; $i++){
		echo $qtyPerShop[$i];
	}
	echo '</tr>';
}

echo '</table>';
?>

</body>
</html>
