<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>
<body>
<?php
require ("../conn/sqlconnect.php");

$sql = "select retailShop_no,retail_id from retailshop order by retail_id";
$sql2 = "select * from accessories left join acctype on acctype.accType_no = accessories.accType_no";


$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=SalesQuantityDetail".$saveDate.".".$file_ending);

echo '<table border="1">';
echo '<tr><th width="110px">產品編號</th>'.'<th width="200px">產品名稱</th>'.'<th width="70px">分類</th>'.'<th width="70px">總數量</th>';

	$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			echo '<th width="70px">'.$row['retail_id'].'</th>';
		}
			echo '</tr>';
			
	
	$result2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_array($result2)) {
			$temp_acc_no=$row2['acc_no'];
			echo '<tr>';
			echo '<td>'.$row2['acc_id'].'</td>';
			echo '<td>'.$row2['accName'].'</td><td>'.$row2['typeName'].'</td>';

			//$sql="select retailShop_no,retail_id from retailshop order by retail_id";
			//$result = mysql_query($sql);
			
			
			$temp_qty=0;
			$qtyArray=array();
			while ($row = mysql_fetch_array($result)) {
				$temp_shopno=$row['retailShop_no'];
				
				$sql3="select *,(sum(rec_qty)-sum(ava_bal)-sum(trans_qty)) as total_qty FROM stockin si LEFT JOIN  ( accessories acc left join acctype acct ON acc.accType_no=acct.accType_no) ON si.acc_no = acc.acc_no where si.acc_no=".$temp_acc_no." and si.retailShop_no=".$temp_shopno ." group by si.acc_no,si.retailShop_no;";
				
				$result3 = mysql_query($sql3);
				$result3_1 = mysql_num_rows($result3);
				
				if($result3_1==null)
					$qtyArray[]= '<td>0</td>';
				else
					while ($row3 = mysql_fetch_array($result3)) {
							$qtyArray[]= '<td>'.$row3['total_qty'].'</td>';
							$temp_qty = $temp_qty+$row3['total_qty'];
					}
			}
			echo '<td>'.$temp_qty.'</td>';
			$qtyArray_length=count($qtyArray);
			for($i=0; $i<$qtyArray_length; $i++){
				echo $qtyArray[$i];
			}
			echo '</tr>';
			echo '<tr></tr>';
		}
		
		$sql4="select * from phonetype";
		$result4 = mysql_query($sql4);
		while ($row4 = mysql_fetch_array($result4)) {
			$temp_phoneType_no=$row4['phoneType_no'];
			echo '<tr>';
			echo '<td>'.$row4['phonetype_id'].'</td>';
			echo '<td>'.$row4['manufacturer'].' '.$row4['phone_name'].' ('.$row4['color'].')</td><td>手機</td>';

			//$sql="select retailShop_no,retail_id from retailshop order by retail_id";
			$result = mysql_query($sql);
			$temp_qty=0;
			$qtyArray=array();
			while ($row = mysql_fetch_array($result)) {				
				$temp_shopno=$row['retailShop_no'];
				$sql5="select count(*) as total_qty
			   		FROM phone ph
					where ph.retailShop_no=$temp_shopno
					and ph.phoneType_no=$temp_phoneType_no
					and ph.phoneState_no=2
					group by ph.retailShop_no, ph.phoneType_no;";

				$result5 = mysql_query($sql5);
				$result5_1 = mysql_num_rows($result5);
				
				if($result5_1==null)
					$qtyArray[]= '<td>0</td>';
				else
					while ($row5 = mysql_fetch_array($result5)) {
							$qtyArray[]= '<td>'.$row5['total_qty'].'</td>';
							$temp_qty = $temp_qty+$row5['total_qty'];
					}
			}
			echo '<td>'.$temp_qty.'</td>';
			$qtyArray_length=count($qtyArray);
			for($i=0; $i<$qtyArray_length; $i++){
				echo $qtyArray[$i];
			}
			echo '</tr>';
			echo '<tr></tr>';
		}
		echo '</table>';
?>
</body>
</html>
