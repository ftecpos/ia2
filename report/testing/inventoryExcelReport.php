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
/*
$sql2 = "select * from accessories left join acctype on acctype.accType_no = accessories.accType_no
            where acc_id not in
('2CH0301BK',
'2CH0301GY',
'2CH0301BU',
'2CH0301PK',
'2CH0301PU',
'2CA04322196',
'2CA04322363',
'2CA04315167',
'2CA04315174',
'2CA04315181',
'2CA04322691',
'2CA04322684',
'2CA04316478',
'2CA04316485',
'2CA04316492',
'2CA04316386',
'2CA04316393',
'2CA04316560',
'2CA04322424',
'2CA04322417',
'2CA04324978',
'2CA04324961',
'2CA04324985',
'41828',
'2CA04317666',
'2CA04317659',
'2CA04317413',
'2CA04317420',
'FEFLIP4R',
'FEFLIP4M',
'FESCP2BL',
'FESA4G5R',
'FESA4G6R',
'FESC4GBL',
'FESC4GRE',
'FESC4GYE',
'FEGT4GSI',
'FESCP2YE',
'FEGT4GGWH',
'FESCP2RE',
'FEMO4MBL',
'FEMAP2BL',
'FEMO4MRE',
'FEMAP2RE',
'FEMO4MBR',
'FESLIPRE',
'FEFLIP4B',
'FESLIPBL',
'FEGTG2WH',
'FEGTG2SI',
'M/R/SB',
'U/V/YE',
'M/R/OR',
'U/R/OR',
'U/R/BK',
'2SC0201',
'2CA0501',
'30648',
'2CH0302BK',
'2CH0302PK',
'2CH0302PU',
'2CA1201',
'2CA1301',
'2CH1401',
'2CA1004',
'JBF/R',
'JBF/K',
'JBF/N',
'JBF/W',
'JBG06BLVHD/K',
'JBE/K',
'ISGAGS6102',
'CJD-SAM-S5830-紫色',
'CJD-SAM-S5830-白色',
'CJD-SAM-S5830-黑色',
'CJD-SAM-S5830-紅色',
'CJD-SAM-S5830-淺藍色',
'ISGCONEXL',
'ISGAGONEXL',
'MIP15-BK',
'ISGC9300',
'ISGAG9300',
'Colorpop-GS3/B',
'Colorpop-GS3/K',
'Colorpop-GS3/Y',
'Feeling-GS3/K',
'Feeling-GS3/R',
'Overlap-IP4/S/P',
'Overlap-IP4/4S/R',
'Overlap-IP4/4S/Y',
'Overlap-IP4/4S/B',
'ColorRacer-ip4/4S/P',
'ColorRacer-ip4/4S/Y',
'ColorRacer-ip4/4S/I',
'GlossyMellow-N7000/P',
'GlossyMellow-N7000/I',
'GlossyMellow-N7000/N',
'GlossyMellow-N7000/B',
'Marshmelo-GS3/I',
'Marshmelo-GS3/Y',
'Marshmelo-GS3/B',
'Marshmelo-GS3/P',
'ColorpopPastel-GS3/B',
'ColorpopPastel-GS3/P',
'CXX1003-Samsung/K',
'CXX1003-Samsung/W',
'LeatherPocket-N7000/P',
'LeatherPocket-N7000/I',
'LeatherPocket-N7000/Y',
'LeatherPocket-N7000/B',
'GLMHDI9300-SF',
'WIT-I4S-SGA01',
'WIT-I4S-SVW01',
'WIT-I4S-SSL01',
'WIT-I4S-SDG01',
'WIT-I4S-SCT01',
'WAS-SGN-PCP01',
'WEU-SGN-PVW01',
'LABC-431-RD',
'LABC-431-WH',
'LABC-431-BK',
'LABC-431-PK',
'LABC-431-BL',
'LABC-431-GR',
'LABC-431-OR',
'LABC-HI-03-S3',
'LABC-JE-03-S3',
'LABC-JE-05-S3',
'LABC-JE-06-S3',
'LABC-LE-03',
'LABC-BI-05',
'LABC-BI-03',
'LABC-MA-07',
'LABC-MA-05',
'LABC-YU-05',
'LABC-AS-02-NT',
'LABC-BE-03-NT',
'LABC-HK-01-NT',
'LABC-JH-01-NT',
'LABC-MB-05-NT',
'NS200-001',
'NS200H-001',
'NS400-001',
'NS400-002',
'OM955YL/BK',
'OM955BK/WH',
'OM955PK/WH',
'OM955GN/WH',
'I5PTR-PKG-BLU',
'I5PTR-PKG-PP',
'I5PTR-PKG-ORG',
'I5PTR-PKG-PNK',
'SIM45-PinkCheck',
'SIM45-Microdot',
'SIM45-Sweat',
'SIM45-HoundsTooth',
'SIM45-Denim',
'SIM45-Navy',
'SIM45-MultiStripe',
'IP5_BP_PP',
'IP5_BP_GRN',
'IP5_BP_BLU',
'IP5_Rainbow Case_W',
'IP5_Rainbow Case_K',
'IHP635BLK',
'IHP635WHT',
'IHP635RED',
'IHP635BLU',
'C3520K',
'C3520S',
'C3520I',
'320',
'SIM40-BK-PH5',
'Note2 CASE_DBLU',
'IP5_BP_BLK',
'N7100CR_FC_BLU',
'321',
'IEP336ORGN',
'IP5_MB_GY',
'IP5_MB_BL',
'IP-HS-005(PINK)',
'IP-HS-005(PURPLE)',
'IP-HS-005(BLACK)'


)";
*/
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
