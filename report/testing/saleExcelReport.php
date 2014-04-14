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
header("Content-Disposition: attachment; filename=SalesReportV01".$saveDate.".".$file_ending);

echo '<table border="0">'.
        '<tr><th style="width: 150px">開單日期</th>'.
            '<th style="width: 120px">單號</th>
             <th style="width: 120px">舊單號碼</th>'.
            '<th style="width: 100px">產品分類</th>'.
            '<th style="width: 175px">產品編號</th><th style="width: 450px">產品名稱</th>'.
            '<th style="width: 50px">數量</th><th style="width: 80px">成本</th><th style="width: 80px">金額</th>'.
            '<th style="width: 80px">折扣</th><th style="width: 80px">總金額</th><th style="width: 80px">毛利</th>'.
            '<th style="width: 90px">店員佣金</th><th style="width: 90px">店長佣金</th>'.
            '<th style="width: 100px">付款方法</th><th style="width: 100px">分店</th><th style="width: 100px">開單員工</th>
            <th>SSA</th>
            <th>SSA2</th>
            <th>Offer</th>
            <th>SSA2_2</th>
            <th>SSA2_2 Mobile</th>
            <th>SSA3</th>
            <th>SSA3 Mobile</th>
            <th>SSA4</th>
            <th>SSA4 Mobile</th>
            </tr>';

$sql2 = "select * from accessories left join acctype on acctype.accType_no = accessories.accType_no";

//$sql3 = "select *, sum(qty*price)-sum(qty*cost)-discount as profit, sum(qty) as tol_qty
$sql3 = "select *
		from invoicedetail 
		left join invoice on invoicedetail.invoice_no = invoice.invoice_no
		where invoice.invoiceState_no != 2
		
		";
		if(isset($_GET['from']) && isset($_GET['to'])){
    $startDay = $_GET['from'];
    $endDay = $_GET['to'];
    $sql3 .=" and createDate between '".$startDay." 00:00:00' and '".$endDay." 23:59:59'	";
}
	/*	
if(isset($_GET['from']) && isset($_GET['to'])){
	$startDay = $_GET['from'];
	$endDay = $_GET['to'];
if($startDay != '' && $endDay != '') {	
	$startDay_s1=explode('-',$startDay);
	$endDay_s1=explode('-',$endDay);
	$sql3 .=" and year(createDate) >= ".$startDay_s1[0]." and year(createDate) <= ".$endDay_s1[0]."	AND month(createDate) >= ".$startDay_s1[1]." AND month(createDate) >= ".$endDay_s1[1]." AND day(createDate) >= ".$startDay_s1[2]." AND day(createDate) <= ".$endDay_s1[2];
} else if($startDay != ''){
	$startDay_s1=explode('-',$startDay);
	$today = date("Y-m-d");
	$today_s1 = explode('-', $today);
	$sql3 .=" and year(createDate) >= ".$startDay_s1[0]." and year(createDate) <= ".$today_s1[0]."	AND month(createDate) >= ".$startDay_s1[1]." AND month(createDate) >= ".$today_s1[1]." AND day(createDate) >= ".$startDay_s1[2]." AND day(createDate) <= ".$today_s1[2];
} else {
	$today = date("Y-m-d");
	$today_s1 = explode('-', $today);
	$sql3 .=" and year(createDate) = ".$today_s1[0]." AND month(createDate) = ".$today_s1[1]." AND day(createDate) = ".$today_s1[2];
}}
*/
//$sql3 .=" group by invoicedetail.invoice_no, product_no";


//$sql3="select *from invoicedetail left join invoice on invoicedetail.invoice_no = invoice.invoice_no";
//$sql3="select *from invoicedetail left join invoice on invoicedetail.invoice_no = invoice.invoice_no where year(invoice.createDate)=".." and month(invoice.createDate)=".;
$result3 = mysql_query($sql3);
//$count3 = mysql_num_rows($result3);
//if($count3 == 0){

	while($row3 = mysql_fetch_assoc($result3)){
		//print_r($row3);
		echo '<br>';
		echo '<tr>';
		////////////////////////開單日期///////////////////////////
		$date = explode(' ',$row3['createDate']);
		echo '<td>'.$date[0].'</td>';
		/////////////////////////單號/////////////////////////////
		if($row3['invoiceType_no'] == '1'){
			$numHead = 'SA-';
		}
		if($row3['invoiceType_no'] == '2'){
			$numHead = 'SR-';
		}
		$numLength = strlen($row3['invoice_no']);
		$tempZero = '';
		$zeroCount = 7;
		$addZero = $zeroCount-$numLength;
		while($addZero!=0){
			$tempZero.='0';
			$addZero--;
		}
		$output1 = $numHead.$tempZero.$row3['invoice_no'];
		echo '<td>'.$output1.'</td>';
		/////////////////////////舊單號碼/////////////////////////
		if($row3['invoiceType_no'] == '2'){
			$numLength = strlen($row3['remark']);
			$tempZero = '';
			$zeroCount = 7;
			$addZero = $zeroCount-$numLength;
			while($addZero!=0){
				$tempZero.='0';
				$addZero--;
			}
			$output2 = 'SA-'.$tempZero.$row3['remark'];
			echo '<td>'.$output2.'</td>';
		}else{
			echo '<td>'.$row3['remark'].'</td>';
		}
		///////分類//產品編號//產品名稱//數量//成本//金額//折扣//總金額//毛利///////
		if($row3['goodsType'] == '1'){
			echo '<td>手機</td>';
			echo '<td>'.$row3['product_no'].'</td>';
			echo '<td>'.$row3['description'].'</td>';
			echo '<td>'.$row3['qty'].'</td>';
			echo '<td>'.number_format($row3['cost'],1,'.',',').'</td>';
			echo '<td>'.number_format($row3['price'],1,'.',',').'</td>';
			echo '<td>'.number_format($row3['discount'],1,'.',',').'</td>';
			
			if($row3['invoiceType_no'] == '2'){
					$discount = $row3['discount'];
				//$total1 = ($row3['qty']*$row3['price'])-(0-$row3['discount']);
				//$total1 = 0-(($row3['price']-$discount)*$row3['qty']);
				$total1 = 0-($row3['price']-$discount);
			}else{	
					$discount = $row3['discount'];
				//$total1 = ($row3['qty']*$row3['price'])-$row3['discount'];
				$total1 = ($row3['price']-$discount)*$row3['qty'];
			}
			echo '<td>'.number_format($total1, 2, '.', '').'</td>';
			$profit1 = $total1-($row3['cost']*$row3['qty']);
			echo '<td>'.number_format($profit1, 2, '.', ',').'</td>';
			////////////////////////////////佣金, 店長佣金//////////////////////////////
			$sql5 = "select * from phone left join phonetype on phonetype.phoneType_no = phone.phoneType_no where phone.IMEI = '".$row3['product_no']."'";
			$result5 = mysql_query($sql5);
			$row5 = mysql_fetch_assoc($result5);
			echo '<td>'.number_format($row5['commission_1'], 1, '.', '').'</td>';
			echo '<td>'.number_format($row5['commission_2'], 1, '.', '').'</td>';
		}
		else{
			$sql6 = "select * from accessories, acctype where acctype.accType_no = accessories.accType_no and accessories.acc_id = '".$row3['product_no']."'";
			$result6 = mysql_query($sql6);
			$row6 = mysql_fetch_assoc($result6);
			echo '<td>'.$row6['typeName'].'</td>';
			echo '<td>'.$row3['product_no'].'</td>';
			echo '<td>'.$row3['description'].'</td>';
			echo '<td>'.$row3['qty'].'</td>';
			echo '<td>'.$row3['cost'].'</td>';
			echo '<td>'.$row3['price'].'</td>';
			$discount;
			if($row3['invoiceType_no'] == '2'){
				$sql8 = "select sum(qty) as tol_qty from invoicedetail where invoice_no='".$row3['remark']."' and product_no='".$row3['product_no']."' group by invoice_no, product_no";
				$result8 = mysql_query($sql8);
				//$temp_total = mysql_result($result8,0,0);
				$discount = $row3['discount'];
				$temp_discount = 0-(($row3['price']-$discount)*$row3['qty']);
				
				//$temp_discount = ($row3['discount']/$temp_total)*$row3['qty'];
				//$discount = number_format($temp_discount,0);
				echo '<td>';
				//echo 0-$discount;
				echo $discount;
				echo '</td>';
			}else{
				$discount = $row3['discount'];
				echo '<td>'.$discount.'</td>';
			}
			//$total2 = ($row3['qty']*$row3['price'])-$discount;
			$total2 = ($row3['price']-$discount)*$row3['qty'];
			echo '<td>'.number_format($total2,1,'.',',').'</td>';
			$profit2 = $total2-($row3['qty']*$row3['cost']);
			echo '<td>'.number_format($profit2,1,'.',',').'</td>';
			////////////////////////////////佣金, 店長佣金//////////////////////////////
			echo '<td>'.number_format($row3['commission_2'], 1, '.', '').'</td>';
			echo '<td>'.number_format($row3['commission_1'], 1, '.', '').'</td>';
		}
		////////////////////////////////付款方法///////////////////////////////
		$sql7 = "select * from payment, payment_has_invoice as phi where payment.payment_no = phi.payment_no and phi.invoice_no = '".$row3['invoice_no']."'";
		$result7 = mysql_query($sql7);
		$row7 = mysql_fetch_assoc($result7);
		//$temp_arr=array();
		//$string='';
		 // while ($row7 = mysql_fetch_assoc($result7)) {
               //$arr[]=$row7['paymentName'];
			   //$temp = new stdClass;
			   //$temp->g = $row7;
			   	//echo '<td>'.print_r($temp).'</td>';
				//$string.=$row7['paymentName'].'='.$row7['money'];
          //  }
			
			//echo '<td>'.$string.'</td>';
		echo '<td>'.$row7['paymentName'].'</td>';
		//echo '<td>'.print_r($row7).'</td>';
		//////////////////////////////////分店////////////////////////////////
		$sql = "select retail_id from retailshop where retailShop_no ='".$row3['retailShop_no']."'";
		$result = mysql_query($sql);
		$shop_id = mysql_result($result,0,0);
		echo '<td>'.$shop_id.'</td>';
		////////////////////////////////開單員工///////////////////////////////
		echo '<td>'.$row3['createBy'].'</td>';
		echo '<td>'.$row3['ssa'].'</td>';
		echo '<td>'.$row3['ssa2'].'</td>';
		echo '<td>'.$row3['ssa_offer'].'</td>';
		echo '<td>'.$row3['ssa2_2'].'</td>';
		echo '<td>'.$row3['ssa2_2_mobile'].'</td>';
		echo '<td>'.$row3['ssa3'].'</td>';
		echo '<td>'.$row3['ssa3_mobile'].'</td>';
                echo '<td>'.$row3['ssa4'].'</td>';
		echo '<td>'.$row3['ssa4_mobile'].'</td>';
		echo '</tr>';
	}// end while

//}

//$sql4="select * FROM stockin si LEFT JOIN  ( accessories acc left join acctype acct ON acc.accType_no=acct.accType_no) ON si.acc_no = acc.acc_no where si.acc_no=".$temp_acc_no." and si.retailShop_no=".$temp_shopno ."group by si.acc_no,si.retailShop_no;";

//$sql8 = "SELECT *,(sum(rec_qty)-sum(ava_bal)-sum(trans_qty)) as total_qty FROM invoicedetail left join accessories on invoicedetail.product_no = accessories.acc_id left join acctype on accessories.accType_no = acctype.accType_no";

echo '</table>';
?>

</body>
</html>
