<?php require ("../conn/db_include.php")?>
<?php
//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	
?>
<?php
global $db;
session_start();

function getStaffNo($staffid){
	global $db;
	$temp_staffid = $staffid;
	$sql="select staff_no from staff where staff_id='$temp_staffid'";
	$staff_no= $db->getOne($sql);
	
	return $staff_no;	
}
function getStaffId($staffno){
	global $db;
	$temp_staffno = $staffno;
	$sql="select staff_id from staff where staff_no='$temp_staffno'";
	$staff_id= $db->getOne($sql);
	
	return $staff_id;	
}
switch($_GET['action']){
	case 'get_trans_report':
		echo '<table  class="trans_report" style="width:100%;" >'.
            '<thead>'.
            	'<th style="width: 110px">開單日期</th>'.
            	'<th>單號</th>'.
            	'<th style="width: 145px">產品編號</th>'.
            	'<th style="width: 100px">產品名稱</th>'.
            	'<th style="width: 100px">數量</th>'.
            	'<th>出貨分店</th>'.
            	'<th>收貨分店</th>'.
				'<th>狀況</td>'.
				'<th>開單員工</td>'.
            '</thead>'.
            '<tbody>';
		$sql1="select transfer_no 
			  from transfer 
			  where transDate > '2011-12-21'";
			  
			  //and transDate > '2011-12-21'  這句要delete
			  
		$result = $db->query($sql1);
		if ($result) {
			while ($row1 = $db->fetch_array($result)) {
				$trans_no = $row1['transfer_no'];				
				$sql2="select transDate, td.transfer_no, acc_id, td.IMEI, accName,
					   sum(trans_qty) as trans_qty,rf.retail_id as rfs, rt.retail_id as rts,stateName,staff_id
					   FROM transfer tf
					   LEFT JOIN retailShop AS rf ON tf.fromRetail_no=rf.retailShop_no
					   LEFT JOIN retailShop AS rt ON tf.toRetail_no=rt.retailShop_no
					   LEFT JOIN transstate ON tf.transState_no=transstate.transState_no
					   LEFT JOIN staff
					   ON tf.staff_no=staff.staff_no
					   ,transdetail td
					   LEFT JOIN accessories ON td.acc_no=accessories.acc_no
					   LEFT JOIN  ( phone ph left join phonetype pt ON ph.phoneType_no=pt.phoneType_no) ON td.IMEI = ph.IMEI
					   WHERE tf.transfer_no=td.transfer_no
					   AND transDate > '2011-12-21'
					   and tf.transfer_no=$trans_no
					   GROUP BY td.acc_no, rf.retailShop_no
					   ORDER BY transfer_no";
					   
					   //and transDate > '2011-12-21'  這句要delete
				$result2 = $db->query($sql2);
				if ($result2) {
					$total_qty=0;
					while ($row2 = $db->fetch_array($result2)) {
						$DATE1=$row2['transDate'];
						$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
						$total_qty=$total_qty+$row2['trans_qty'];
						//$tempTransfer_no=count($transfer_no);
							echo '<tr><td>'.$DATE1_s1[0].'</td>'.
									 '<td>'.$row2['transfer_no'].'</td>'.
									 '<td>'.$row2['acc_id'].'</td>'.
									 '<td style="text-align:left">'.$row2['accName'].'</td>'.
									 '<td>'.$row2['trans_qty'].'</td>'.
									 '<td>'.$row2['rfs'].'</td>'.
									 '<td>'.$row2['rts'].'</td>'.
									 '<td>'.$row2['stateName'].'</td>'.
									 '<td>'.$row2['staff_id'].'</td>'.
								 '</tr>';
					}
					echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
					echo '<tr><td colspan="4" style="text-align:right">Total : </td>'.'<td>'.$total_qty.'</td>';
					echo '</tr>';
					
				}// end of if result2
			}//end of row1
			echo '</tbody></table>';
		}// end of if result1
		
	
			
	//	$temp = 'var trans_report =new Array("';
		
		
					 
	//			$temp .=$DATE1_s1[0].'","';
	//			$temp .=$row['transfer_no'].'","';
	//			$temp .=$row['acc_id'].'","';
	//			$temp .=$row['accName'].'","';
	//			$temp .=$row['trans_qty'].'","';
	//			$temp .=$row['rfs'].'","';
	//			$temp .=$row['rts'].'","';
	//			$temp .=$row['stateName'].'","';
	//			$temp .=$row['staff_id'].'","';
//$arr4[]=$row;

			
	//		echo json_encode($arr4); 
			
	//		$temp .='");';
			
			
	//		for($i=0; $i<$tempTransfer_no; $i++){
	//			echo $transfer_no[$i];
	//		}
					
		//"$have_rs\",\"$phonetype_id\",\"$manufacturer\",\"$phone_name\",
			//							  \"$color\",\"$stateName\",\"$oprice\",\"$sprice\",\"$phonetype_no\");";
		//echo $temp;		
		
		break;
	case 'checkImeiExist':
		$imei=$_GET['imei'];
		$sql="SELECT * FROM phone where imei ='$imei'";
		$num = $db->num_rows($db->query($sql));
		echo $num;
		
		break;
	case 'getPhoneDetail':
		$podNo=$_GET['podNo'];
		$sql="SELECT phonetype_no FROM podetail where poDetail_no=$podNo";
		$phonetype_no= $db->getOne($sql);
		
		$sql="select * from phonetype pt, productstate ps
			  where pt.phoneType_no=$phonetype_no
			  and pt.productState_no=ps.productState_no";
		$row = $db->getrow($sql);
		if($row){
			$phonetype_id=$row['phonetype_id'];
			$manufacturer=$row['manufacturer'];
			$phone_name=$row['phone_name'];
			$color=$row['color'];
			$stateName=$row['stateName'];
			$oprice=$row['oprice'];
			$sprice=$row['sprice'];
			
			$have_rs=1;
		}
		else $have_rs=2;
	
		echo "var phDetail =new Array(\"$have_rs\",\"$phonetype_id\",\"$manufacturer\",\"$phone_name\",
										  \"$color\",\"$stateName\",\"$oprice\",\"$sprice\",\"$phonetype_no\");";
										  
		break;
		
	case 'upPoState':
		$poNo=$_GET['poNo'];
		$upD_po_State_no=$_GET['upD_po_State_no'];
		$modify_by=null;
		if (isset($_GET['modify_by']))
			$modify_by=$_GET['modify_by'];
		$desc=null;
		if (isset($_GET['desc']))
			$desc=$_GET['desc'];
		$modify_date=date("Y-m-d H:i:s");
		
		
		$modify_by= getStaffNo($modify_by);
		if($modify_by){
			$sql2="START TRANSACTION;";
				$db->query($sql2);
			$sql2="SELECT poState_no FROM po WHERE po_no = $poNo FOR UPDATE;";
				$db->query($sql2);
			$sql2="UPDATE po SET poState_no=$upD_po_State_no, modify_by='$modify_by', po_desc='$desc', modify_date='$modify_date'  WHERE po_no=$poNo;";
				$db->query($sql2);
			$sql2="COMMIT;";
				$db->query($sql2);
			
			$have_user=1;
		} else
			$have_user=0;
		
		echo "var upPoState =new Array(\"$have_user\");";
		break;
	
	case 'recMobile':
		$imei=$_GET['imei'];
		$phoneType_no=$_GET['phoneType_no'];
		$shopno=$_GET['shopno'];
		$phoneState_no=$_GET['phoneState_no'];
		$poDetail_no=$_GET['poDetail_no'];
		$rec_date=date("Y-m-d H:i:s");
	
		$sql="INSERT INTO phone (`IMEI`, `phoneType_no`, `retailShop_no`, `phoneState_no`, `poDetail_no`, `rec_date`)
			  VALUES ('$imei', $phoneType_no, $shopno, $phoneState_no, $poDetail_no, '$rec_date')";
		$db->query($sql);
		break;
	case 'recGoods':
		$podNo=$_GET['podNo'];
		$rec_Qty=$_GET['rec_Qty'];
		$poDate=$_GET['poDate'];

		
		$staffid=$_GET['staffid'];
		$sql="select staff_no from staff where staff_id='$staffid'";
		$staffno= $db->getOne($sql);

		$shopno=$_GET['shopno'];
		$rec_date=date("Y-m-d H:i:s");
		$sql="select * from poDetail where poDetail_no = $podNo";
		
		$poNo=$_GET['poNo'];


		$row = $db->getrow($sql);
		$pod_qty=$row['qty'];
		$pod_acc_no=$row['acc_no'];
			
		$pod_iprice=$row['cost'];
		$ava_bal=$rec_Qty;
		
		if($pod_acc_no!=null){
			$sql="INSERT INTO stockin
				(`poDetail_no`, `staff_no`, `acc_no`, `retailShop_no`, `rec_qty`, `rec_date`, `po_date`, `iprice`, `ava_bal`) 
				VALUES ($podNo, $staffno, $pod_acc_no, $shopno, $rec_Qty, '$rec_date', '$poDate', '$pod_iprice', $ava_bal)";
			$db->query($sql);
		}		
		break;
	case 'getPOD':
		$poNo=$_GET['poNo'];
		$sql1="select p.po_no, p.createDate, staff_id, supplierName, stateName, p.poState_no, retail_id, modify_by, po_desc,modify_date
				from po p, staff st, supplier sp, poState ps, retailShop rs
				where p.staff_no = st.staff_no
				and p.supplier_no = sp.supplier_no
				and p.poState_no = ps.poState_no
				and p.retailShop_no = rs.retailShop_no
				and p.po_no='$poNo'";
		$row1=$db->getrow($sql1);
		$poNo=$row1['po_no'];
		$createDate=$row1['createDate'];
		$staff_id=$row1['staff_id'];
		$supplierName=$row1['supplierName'];
		$stateName=$row1['stateName'];
		$retail_id=$row1['retail_id'];
		$poState_no=$row1['poState_no'];
		$modify_by=$row1['modify_by'];
		
		$modify_by=getStaffId($modify_by);
		
		$po_desc=$row1['po_desc'];
		$modify_date=$row1['modify_date'];
		
		
	
		$numOfRow = $db->num_rows($db->query($sql1));
		
		$qtyMsg='<td>Qty</td>';
		
		$detail_of_po_inTable = '<table border=\"1\" width=\"100%\">'.
									'<tr>';
			if($poState_no!=3 || $poState_no==4){  //3=完結-- 貨全部收到
				$detail_of_po_inTable .='<td>poDetail_no</td>';
				$qtyMsg='<td>Qty (尚欠數量)</td>';
			}
		$detail_of_po_inTable .=	'<td>Product ID</td>'.
								 	'<td>Product Name</td>'.$qtyMsg.
									'<td>Cost</td><td>Total Cost</td>'.
									'</tr>';
		$sql2="select * from podetail where po_no='$poNo'";
		$result2=$db->query($sql2);
		$totalNonRecQty=0;
		$totalRecQty=0;
		if($result2){
			while ($row2 = $db->fetch_array($result2)) {
				$qty=$row2['qty'];  //pod中的qty
				
				$cost=$row2['cost'];
				$totalCost=($qty*$cost)+0.0;
				//$totalCostA=round($totalCost, 1);
				$totalCostA=number_format($totalCost, 1, '.', '');
				$detail_of_po_inTable .="<tr>";

				if($row2['phonetype_no']==null){
					$acc_or_phone = 0; //0 是acc
					$sql4="select sum(rec_qty) as recedQty from stockin where poDetail_no=".$row2['poDetail_no']; //找出stockin收了多少貨
					$recedQty= $db->getOne($sql4);
					if($recedQty=='')
						$recedQty=0;
					//echo $sql4;
				}else{
					$acc_or_phone = 1;//1是phone
					$sql4="select count(*)as recedQty from phone where poDetail_no=".$row2['poDetail_no']; //找出phone收了多少貨
					$recedQty= $db->getOne($sql4);
				}
				
				$nonRecQty=$qty-$recedQty;
				$qtyMsgCont="";
				
				if($poState_no!=3){ //3=完結-- 貨全部收到 4=完結-- 強制完結
					if(($qty-$recedQty)>0){
						
						if($poState_no!=4){
							$detail_of_po_inTable .="<td>";
							$detail_of_po_inTable .=$row2['poDetail_no'].
							'<input type=\"button\" value=\"收貸\" onclick=\"recGoods('.$row2['poDetail_no'].','.$nonRecQty.','.$acc_or_phone.','.$cost.','.$recedQty.')\" />';
							$detail_of_po_inTable .="</td>";
						}else {
							$detail_of_po_inTable .='<td style=\"width:210px; color:#FF637D;\">Receive Not Complete';
							$detail_of_po_inTable .="</td>";
						}
						
					}else if (($qty-$recedQty)==0){
						$detail_of_po_inTable .='<td style=\"width:210px; color:#59B74E;\">Receive Complete';
						$detail_of_po_inTable .="</td>";
					}
					$qtyMsgCont="($nonRecQty)";
				}
				if($row2['phonetype_no']==null)
					$sql3="select acc_id as pd_id, accName as pd_name from accessories where acc_no=".$row2['acc_no'];
				else
					$sql3="select phonetype_id as pd_id, phone_name as pd_name from phonetype where phoneType_no=".$row2['phonetype_no'];
				$row3 = $db->getrow($sql3);
				
				$detail_of_po_inTable .="<td>".$row3['pd_id']."</td><td>".$row3['pd_name']."</td>".
										'<td style=\"width:110px;\">'.$row2['qty'].$qtyMsgCont."</td><td>".$cost."</td><td>".$totalCostA."</tr>";
				$totalRecQty = $totalRecQty+$row2['qty'];
				$totalNonRecQty = $totalNonRecQty+$nonRecQty;
			}//end of while
			
			$detail_of_po_inTable .="</table>";
		
			echo "var tt =new Array(\"$numOfRow\",\"$poNo\",\"$createDate\",\"$staff_id\",\"$supplierName\",\"$stateName\",
								\"$retail_id \",\"$detail_of_po_inTable \",\"$poState_no\",\"$totalNonRecQty\",\"$totalRecQty\",
								\"$modify_by\",\"$po_desc\",\"$modify_date\");";
		}//end of if
		break;
		
	case 'getSiBottom':
		$sql="select p.po_no, p.createDate, staff_id, supplierName, stateName
				from po p, staff st, supplier sp, poState ps
				where p.staff_no = st.staff_no
				and p.supplier_no = sp.supplier_no
				and p.poState_no = ps.poState_no
				and p.poState_no in (2,1)";
		$pageNo = $_GET['pageNo'];
		$result = $db->selectLimit($sql, '14',$pageNo);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<div id="poTable"><table rules="all" border="1"  class="finMobile" style=" width:90%; align=right;" >'.
            '<thead>'.
				'<th style="width: auto;">PO No.</th>'.
            	'<th style="width: auto;">PO create Date</th>'.
            	'<th>Create By</th>'.
            	'<th style="width: auto;">Supplier</th>'.
            	'<th>PO State</th>'.
            '</thead>'.
            '<tbody>';
		if($result){
			while ( $row = $db->fetch_array($result)){
				echo '<tr><td><a href="#" style="color:#0019FF;" 
								onclick="findPOHead('.$row['po_no'].');">'.$row['po_no'].'</a></td>'.
					 '<td>'.$row['createDate'].'</td>'.
					 '<td>'.$row['staff_id'].'</td>'.
					 '<td>'.$row['supplierName'].'</td>'.
					 '<td>'.$row['stateName'].'</td>';
				echo '</tr>';
					 ;
			}// end of while
		}// end of result
		echo '</tbody></table></div>';
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";
			
		break;
}//end of switch