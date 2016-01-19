<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
include ("../../conn/sqlconnect.php");

$saveDate = date("YmjHis");
$file_type = "vnd.ms-excel"; 
$file_ending = "xls";
header("Content-Type: application/$file_type;charset=utf-8");
header("Content-Disposition: attachment; filename=SalesAmountDetail".$saveDate.".".$file_ending);

echo '<table border="0" class="sales_report" style="width:100%" >'.
			 '<thead>'.
			 	'<th style="width: 110px">產品編號</th>'.
				'<th>產品名稱</th>'.
				'<th style="width: 70px">分類</th>'.
				'<th style="width: 70px">總數量</th>';		
		echo '</thead><tbody>';
$sql2="select * from accessories
				left join acctype
				on acctype.accType_no = accessories.accType_no";
		$result2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_array($result2)) {
			$temp_acc_no=$row2['acc_no'];
			echo '<tr><td>'.$row2['acc_id'].'</td>';
			echo '<td style="text-align:left">'.$row2['accName'].'</td><td>'.$row2['typeName'].'</td>';

			$sql="select retailShop_no,retail_id from retailshop order by retail_id";
			$result = mysql_query($sql);
			$temp_qty=0;
			while ($row = mysql_fetch_array($result)) {
				$temp_shopno=$row['retailShop_no'];
				$sql3="select *,(sum(rec_qty)-sum(ava_bal)-sum(trans_qty)) as total_qty
			   		FROM stockin si
			   		LEFT JOIN  ( accessories acc left join acctype acct ON acc.accType_no=acct.accType_no) ON si.acc_no = acc.acc_no
			   		where si.acc_no=$temp_acc_no
         			and si.retailShop_no=$temp_shopno
			   		group by si.acc_no,si.retailShop_no;";
				$result3 = mysql_query($sql3);
				$result12 = mysql_num_rows(mysql_query($sql3));
				
				if($result12==null)
					$temp_qty = $temp_qty+0;
				else
					while ($row3 = mysql_fetch_array($result3)) {
							$temp_qty = $temp_qty+$row3['total_qty'];
					}
			}
			echo '<td>'.$temp_qty.'</td>';
			echo '</tr>';	
		}
		
		$sql2="select * from phonetype";
		$result2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_array($result2)) {
			$temp_phoneType_no=$row2['phoneType_no'];
			echo '<tr><td>'.$row2['phonetype_id'].'</td>';
			echo '<td style="text-align:left">'.$row2['manufacturer'].' '.$row2['phone_name'].' ('.$row2['color'].')</td><td>手機</td>';
			
			$sql="select retailShop_no,retail_id from retailshop order by retail_id";
			$result = mysql_query($sql);
			$temp_qty=0;
			while ($row = mysql_fetch_array($result)) {
				$temp_shopno=$row['retailShop_no'];

				$sql3="select count(*) as total_qty FROM phone ph where ph.retailShop_no=$temp_shopno and ph.phoneType_no=$temp_phoneType_no and ph.phoneState_no=2 group by ph.retailShop_no, ph.phoneType_no;";
				$result3 = mysql_query($sql3);
				$result12 = mysql_num_rows(mysql_query($sql3));
				
				if($result12==null)
					$temp_qty = $temp_qty+0;
				else
					while ($row3 = mysql_fetch_array($result3)) {
							$temp_qty = $temp_qty+$row3['total_qty'];
					}
			}
			echo '<td>'.$temp_qty.'</td>';
			echo '</tr>';
		}


?>
</body>
</html>
