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
header("Content-Disposition: attachment; filename=SockinReport".$saveDate.".".$file_ending);

//$sYear = $_GET[""];
//$sMonth = $_GET[""];
//$sql = mysql_query("select rec_date, stockIn_no, acc_id, accName, rec_qty, iprice, supplierName, retail_id, staff_id, podetail.po_no from staff, accessories, podetail, po, stockin, supplier, retailshop where stockin.acc_no = accessories.acc_no and stockin.retailShop_no = retailshop.retailShop_no and stockin.staff_no = staff.staff_no and stockin.poDetail_no = podetail.poDetail_no and podetail.po_no = po.po_no and po.supplier_no = supplier.supplier_no and stockin.rec_date like'".$sYear."-".$sMonth."'");

//$sql = mysql_query("select rec_date, stockIn_no, acc_id, accName, rec_qty, iprice, supplierName, retail_id, staff_id, podetail.po_no from staff, accessories, podetail, po, stockin, supplier, retailshop where stockin.acc_no = accessories.acc_no and stockin.retailShop_no = retailshop.retailShop_no and stockin.staff_no = staff.staff_no and stockin.poDetail_no = podetail.poDetail_no and podetail.po_no = po.po_no and po.supplier_no = supplier.supplier_no"); 

echo '<table border="0">';
echo '<tr><th style="width: 150px">入貨日期</th>
          <th style="width: 120px">單號</th>
          <th style="width: 120px">產品編號</th>
          <th style="width: 450px">產品名稱</th>
          <th style="width: 50px">數量</th>
          <th bg="yellow" style="width: 80px">入貨金額</th>
          <th style="width: 80px">總金額</th>
          <th style="width: 300px">供應商編號</th>
          <th style="width: 100px">倉庫位置</th>
          <th style="width: 100px">開單員工</th>
          <th style="width: 120px">PO No.</th></tr>';

$sql1 = "SELECT sinno_ref_no, staff_id FROM sinno_ref LEFT JOIN staff ON sinno_ref.createBy=staff.staff_no";
//$sql1 .= " where year(createDate)=2012 AND month(createDate) = 3";

$result1 = mysql_query($sql1);

if($result1){
	while($row1 = mysql_fetch_array($result1)){
		$sinno = $row1['sinno_ref_no'];
		
		$tempStockIn_length=strlen($sinno);
		$i=7;
		$zeroToBeAdd=$i-$tempStockIn_length;
		$tempZero='';
		while($zeroToBeAdd!=0){
			$tempZero .='0';
			$zeroToBeAdd--;
		}	
		$finalsinno = 'SI-'.$tempZero.$sinno;
						
		$sql2 = "select * FROM stockin LEFT JOIN accessories ON stockin.acc_no=accessories.acc_no LEFT JOIN retailShop ON stockin.retailShop_no=retailShop.retailShop_no LEFT JOIN staff ON stockin.staff_no=staff.staff_no LEFT JOIN (po LEFT JOIN podetail ON po.po_no=podetail.po_no	LEFT JOIN supplier ON po.supplier_no=supplier.supplier_no) ON stockin.poDetail_no=podetail.poDetail_no WHERE sinno_ref_no=".$sinno;
		
		$result2 = mysql_query($sql2);
		
		//$tol_qty = 0;
		//$tol_price = 0;
		
		if($result2){
			while($row2 = mysql_fetch_array($result2)){
				$totalcost = ($row2['rec_qty']*$row2['iprice']);
				
				$tempPoNo_length = strlen($row2['po_no']);
				$i = 7;
				$zeroToBeAdd = $i-$tempPoNo_length;
				$tempZero = '';
				while($zeroToBeAdd!=0){
					$tempZero .= '0';
					$zeroToBeAdd--;
				}
				$finalPoNo = 'PO-'.$tempZero.$row2['po_no'];
				$DATE1 = explode(' ',$row2['rec_date']);
				//$DATE1_s1=explode(' ',$DATE1);
				echo '<tr><td>'.$DATE1[0].'</td>';
				echo '<td>'.$finalsinno.'</td>';
                                echo '<td>'.$row2['acc_id'].'</td>';
				echo '<td>'.$row2['accName'].'</td>';
				echo '<td>'.$row2['rec_qty'].'</td>';
				echo '<td>$'.number_format($row2['iprice'],1,'.',',').'</td>';
				echo '<td>$'.number_format($totalcost,1,'.',',').'</td>';
				echo '<td>'.$row2['supplier_id'].'</td>';
				echo '<td>'.$row2['retail_id'].'</td>';
				echo '<td>'.$row1['staff_id'].'</td>';
				echo '<td>'.$finalPoNo.'</td>';
				echo '</tr>';
			}
		}
		
		$sql3 = "select *FROM phone LEFT JOIN phonetype ON phone.phoneType_no=phonetype.phoneType_no LEFT JOIN retailShop ON phone.retailShop_no=retailShop.retailShop_no LEFT JOIN (po LEFT JOIN podetail ON po.po_no=podetail.po_no LEFT JOIN supplier ON po.supplier_no=supplier.supplier_no) ON phone.poDetail_no=podetail.poDetail_no WHERE sinno_ref_no=".$sinno;
		
		$result3 = mysql_query($sql3);
		
		if($result3){
			while($row3 = mysql_fetch_array($result3)){
				
				$tempPoNo_length = strlen($row3['po_no']);
				$i = 7;
				$zeroToBeAdd = $i-$tempPoNo_length;
				$tempZero = '';
				while($zeroToBeAdd!=0){
					$tempZero .= '0';
					$zeroToBeAdd--;
				}
				$finalPoNo = 'PO-'.$tempZero.$row3['po_no'];
				$DATE2 = explode(' ',$row3['rec_date']);
				echo '<tr><td>'.$DATE2[0].'</td>';
				echo '<td>'.$finalsinno.'</td>';
				echo '<td>'.$row3['manufacturer'].' '.$row3['phone_name'].' ('.$row3['color'].') ('.$row3['IMEI'].')'.'</td>';
				echo '<td>'.'1'.'</td>';
				echo '<td>$'.number_format($row3['iprice'],1,'.',',').'</td>';
				echo '<td>$'.number_format($row3['iprice'],1,'.',',').'</td>';
				echo '<td>'.$row3['supplier_id'].'</td>';
				echo '<td>'.$row3['retail_id'].'</td>';
				echo '<td>'.$row1['staff_id'].'</td>';
				echo '<td>'.$finalPoNo.'</td>';
				echo '</tr>';
			}
		}
	}
}

echo '</table>';
?>
</body>
</html>
