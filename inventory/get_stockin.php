<?php 
  require_once('../conn/sqlconnect.php');
?>
<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">

</head>
<body>
<table border="1"width = "100%">
	<tr>
	<td>
<form method="get">
手提電話
<table border="1" width = "100%" id = "showdata">
	<thead>
		<tr>
			<td>ID</td>
			<td>貨品編號</td>
			<td>貨品名稱</td>
			<td>顏色</td>
			<td>來貨價</td>
			<td>訂購數量</td>
			<td>貨物總價值</td>
			<td>收取數量</td>
			<td>完成</td>
		</tr>
	</thead>
	<tbody>
<?php

//session_start();<<---------------Get retail shop number
//$_SESSION['retail_no'];
	$totalAmount=0;
	if(!empty($_GET) && isset($_GET)){
		if ($_GET['act'] == 'select'){
		mysql_select_db($database_conn, $conn);
			/////////////////////////////////////////////////////////////////////////////////////////
		$SQL ="SELECT p.po_no,p.createDate,p.poState_no,p.staff_no,s.name,p.supplier_no,sp.supplier_id,sp.supplierName,sp.addr,sp.phone,sp.fax,sp.email
		      FROM po as p,supplier as sp,staff as s
			  WHERE p.staff_no = s.staff_no AND sp.supplier_no = p.supplier_no AND p.po_no = ".$_GET['q'];
		$rs = mysql_query($SQL, $conn) or die(mysql_error());
   		$row = mysql_fetch_assoc($rs);
		$totalrow = mysql_num_rows($rs);
		echo "<input type = 'hidden' id = 'staffname' value = '".$row['name']."'/>";
		echo "<input type = 'hidden' id = 'createDate' value = '".$row['createDate']."'/>";
		echo "<input type = 'hidden' id = 'supplier_id' value = '".$row['supplier_id']."'/>";
		echo "<input type = 'hidden' id = 'supplier_name' value = '".$row['supplierName']."'/>";
		echo "<input type = 'hidden' id = 'addr' value = '".$row['addr']."'/>";
		echo "<input type = 'hidden' id = 'phone' value = '".$row['phone']."'/>";
		echo "<input type = 'hidden' id = 'fax' value = '".$row['fax']."'/>";
		//echo "<input type = 'hidden' id = 'email' value = '".$row['email']."'/>";
		echo "<input type = 'hidden' id = 'staff_no' value = '".$row['phone']."'/>";
		echo "<input type = 'hidden' id = 'state' value = '".$row['poState_no']."'/>";
		
		
		$SQL1 = "SELECT p.createdate,p.staff_no,pd.poDetail_no, pd.qty,pt.phonetype_id,pt.phonetype_no,pt.phone_name,pt.color,pd.cost 
		        FROM po as p, poDetail as pd, phonetype as pt
		        WHERE p.po_no = pd.po_no AND pd.phonetype_no = pt.phonetype_no AND p.po_no = ".$_GET['q'];
		$rs1 = mysql_query($SQL1, $conn) or die(mysql_error());
   		$row1 = mysql_fetch_assoc($rs1);
		$totalrow1 = mysql_num_rows($rs1);
		
		$SQL1b = "SELECT count(*), poDetail_no from phone group by poDetail_no order by poDetail_no";
		$rs1b = mysql_query($SQL1b, $conn) or die(mysql_error());
   		$row1b = mysql_fetch_assoc($rs1b);
		$totalrow1b = mysql_num_rows($rs1b);
		$row1bArray = array();
		$a = 0;
		do{
			$row1bArray[2*$a]=$row1b['poDetail_no'];
			//echo $row1bArray[2*$a];
			$row1bArray[2*$a+1]=$row1b['count(*)'];
			//echo$row1bArray[2*$a+1];
			$a++;
		}while($row1b = mysql_fetch_assoc($rs1b));
	}
}
echo "<input type = 'hidden' id = 'totalrow1' value = '".$totalrow1."'/>";
$typeNo=0;
do{	
if($totalrow1 == 0){echo "不存在資料"; break;}
$exist = 0;
for($looper=0;$looper<(count($row1bArray)/2);$looper++){
	if($row1bArray[$looper*2]==$row1['poDetail_no']){
		$exist=$row1bArray[$looper*2+1];
	}
}
?>
	
		<tr>
			<td><?php echo $row1['phonetype_no'];?><input type = "button" id="iiiB<?php echo $typeNo;?>" value = "輸入IMEI" onclick = "b('<?php echo $row1['phonetype_no']."',".$typeNo;?>);po_select_lock()"/></td>
			<td><?php echo $row1['phonetype_id'];?></td>
			<td><?php echo $row1['phone_name']; ?></td>
			<td><?php echo $row1['color']; ?></td>
			<td>$ <?php echo $row1['cost']; ?></td>
			<td><input type = "text" size="5" value="<?php echo $row1['qty']; ?>" id="podQty<?php echo $typeNo;?>" style="border:none" readonly = "readonly"/></td>
			<td>$ <?php $totalAmount+=($row1['qty']*$row1['cost']); echo ($row1['qty']*$row1['cost']); ?></td>
			<td><input type = "text" size="5" value="<?php echo $exist;?>" id = "mobileqty<?php echo $typeNo;?>" style="border:none" readonly = "readonly"/></td>
			<td><input type = "checkbox" id="phoneCB<?php echo $typeNo;?>" name="phoneCB<?php echo $typeNo;?>" disabled="true"/>
			<input type="hidden" id="pod_no<?php echo $typeNo;?>" value="<?php echo $row1['poDetail_no'];?>"/> 
			<input type="hidden" id="tn<?php echo $typeNo;?>" value="<?php echo $row1['phonetype_id'];?>"/></td>
		</tr>
<?php
$typeNo++;
}while($row1 = mysql_fetch_assoc($rs1));
echo "<script type = 'text/javascript'>
 var cd = '".$row1['phonetype_no']."';
 </script>";
?>			
</tbody>
</table>
<br>
配件
<table border="1" width = "100%">
	<thead>
		<tr>
			<td>ID</td>
			<td>貨品編號</td>
			<td>種類</td>			
			<td>貨品名稱</td>
			<td>顏色</td>
			<td>來貨價</td>
			<td>訂購數量(已收取數量)</td>
			<td>貨物總價值</td>
			<td>收取數量</td>
			<td>完成</td>
		</tr>
	</thead>
	<tbody>
<?php
	if(!empty($_GET) && isset($_GET)){
		if ($_GET['act'] == 'select'){
		mysql_select_db($database_conn, $conn);
		$SQL2 = "SELECT * FROM po as p, poDetail as pd, accessories as a , accType as at WHERE p.po_no = pd.po_no AND pd.acc_no = a.acc_no AND a.accType_no = at.accType_no AND p.po_no = ".$_GET['q'];
		$rs2 = mysql_query($SQL2, $conn) or die(mysql_error());
   		$row2 = mysql_fetch_assoc($rs2);
		$totalrow2 = mysql_num_rows($rs2);
		//p.staff_no,pd.poDetail_no, pd.qty,pt.phonetype_id,pt.phone_name,pt.color
		
		$SQL2b = "SELECT * from stockin order by poDetail_no";
		$rs2b = mysql_query($SQL2b, $conn) or die(mysql_error());
   		$row2b = mysql_fetch_assoc($rs2b);
		$totalrow2b = mysql_num_rows($rs2b);
		$ass_q_array = array();
		$ass_q_array_count=0;
		do{
			$ass_q_array[$ass_q_array_count++]=$row2b["poDetail_no"];
			$ass_q_array[$ass_q_array_count++]=$row2b["rec_qty"];
		}while($row2b = mysql_fetch_assoc($rs2b));
	}
}	
$assNum = 0;
echo "<input type = 'hidden' id = 'totalrow2' value = '".$totalrow2."'/>";
do{	
if($totalrow2 == 0){echo "不存在資料"; break;}
?>
	
		<tr>
			<td><?php echo $row2['acc_no']; ?><input type="hidden" id="assNumber<?php echo $assNum;?>" value="<?php echo $row2['acc_no']; ?>"/></td>			
			<td><?php echo $row2['acc_id']; ?></td>
			<td><?php echo $row2['typeName']; ?></td>
			<td><?php echo $row2['accName']; ?></td>
			<td><?php echo $row2['color']; ?></td>
			<td>$ <?php echo $row2['cost']; ?><input type="hidden" id="ass_cos<?php echo $assNum;?>" name="ass_cos<?php echo $assNum;?>" value="<?php echo $row2['cost']; ?>"></td>
			<td><?php
				echo $row2['qty'];
				$totalrecqty=0;
				$recqtyfull=false;
				for($R=0;$R<count($ass_q_array)/2;$R++){
					if($ass_q_array[$R*2]==$row2['poDetail_no']){
						$totalrecqty=$totalrecqty+$ass_q_array[($R*2)+1];
					}
				}
				echo "(".($row2['qty']-$totalrecqty).")";
				if($totalrecqty==$row2['qty']){
					$recqtyfull=true;
				}
				?>
			<input type="hidden" id="ass_qty<?php echo $assNum;?>" name="ass_qty<?php echo $assNum;?>" value="<?php echo($row2['qty']-$totalrecqty); ?>"></td>
			<td>$ <?php $totalAmount+=($row2['cost']*$row2['qty']); echo ($row2['cost']*$row2['qty']); ?></td>
			<td>
				<input type="hidden" value="<?php echo $row2['poDetail_no'];?>" name="ass_pod_no<?php echo $assNum;?>" id="ass_pod_no<?php echo $assNum;?>"/>
				<input type ="text" value = "0" id="ass<?php echo $assNum;?>" name="ass<?php echo $assNum;?>" onkeyup="ass_check_qty(<?php echo $assNum;?>)" <?php
				if($recqtyfull){echo"disabled=\"true\"";}
				?>/>
			</td>
			<td>
				<input type = "button" value="確定" id="ass_confirmer<?php echo $assNum;?>" name="ass_confirmer<?php echo $assNum;?>" onclick="submit_stockin(<?php echo $assNum;?>);cbchecker_auto()" <?php
				if($recqtyfull){echo"disabled=\"true\"";}
				?> />
			</td>
		</tr>
<?php
$assNum++;
}while($row2 = mysql_fetch_assoc($rs2));
?>
<input type="hidden" id="total1" name="total1" value="<?php echo $totalrow1?>"/>
<input type="hidden" id="total2" name="total2" value="<?php echo $totalrow2?>"/>
</tbody>
</table>
<p>總價值 : $ <?php echo $totalAmount; ?></p>
</form>
</tr>
</td>
</table>
<input type="hidden" value="<?php echo $totalrow1;?>" id="totalT" />
</body>
</html>