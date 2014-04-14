<?php require ("../conn/db_include.php")?>
<?php
//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	

set_time_limit(300);
?>
<?php
global $db;
session_start();

if(isset($_GET['action'])){
switch($_GET['action']){
	case 'upcom':
		$acc_id='JBF/K';
		$imei='356830033714676';
		$sql="select * from invoicedetail where product_no = '$acc_id'";
		$result = $db->query($sql);
		
		$row = $db->getrow("select commission_1,commission_2 from phonetype where phoneType_no = (select phoneType_no from phone where IMEI = '$imei')");
				$commission_1 = $row['commission_1'];
				$commission_2 = $row['commission_2'];
				echo $commission_1.','.$commission_2.'<br>';
				
		/*$row = $db->getrow("select commission_1,commission_2 from accessories where acc_id = '$acc_id'");
			$commission_1 = $row['commission_1'];
			$commission_2 = $row['commission_2'];
			echo $commission_1.','.$commission_2.'<br>';
		*/	
			if ($result) {
				while ($row = $db->fetch_array($result)) {
					echo $row['invoiceDetail_no'].'<br>';
					$invoiceDetail_no = $row['invoiceDetail_no'];
					$sql2="UPDATE invoicedetail SET commission_1=$commission_1, commission_2=$commission_2 WHERE invoiceDetail_no='$invoiceDetail_no'";
					$db->query($sql2);
				}
			}
		break;
	case 'get_payment_list':
		$sql="select * from payment";
		$result = $db->query($sql);
			if ($result) {
				echo '<select class="" id="payment_list">';
				while ($row = $db->fetch_array($result)) {
					echo '<option value="'.$row['payment_no'].'">'.$row['paymentName'].'</option>';
				}
				echo '</select>';
			}
		break;
	case 'get_shop_list':
            
            if(isset($_POST['no_name'])){
                    $hide_retail_no = $_SESSION['retail_no'];
                            $sql="SELECT retailShop_no,retail_id
                                  FROM retailshop
                                  WHERE retailShop_no!=$hide_retail_no
                                  ORDER BY sort";
                    $result = $db->query($sql);
                    if ($result) {
                            echo 'TO: <select  id="shop_list">';
                            echo '<option value="0"></option>';
                            while ($row = $db->fetch_array($result)) {
                                echo '<option value="'.$row['retailShop_no'].'">'.$row['retail_id'].'</option>';
                            }
                            echo '</select>';
                    }
		} else if(isset($_POST['all_shop'])){
                    $sql="SELECT retailShop_no,retail_id
                          FROM retailshop
                          WHERE retailShop_no!=9999
                          ORDER BY sort";
                    $result = $db->query($sql);
                    if ($result) {
                        echo 'TO: <select  id="shop_list">';
                        echo '<option value="0"></option>';
                        while ($row = $db->fetch_array($result)) {
                            echo '<option value="'.$row['retailShop_no'].'">'.$row['retail_id'].'</option>';
                        }
                        echo '</select>';
                    }
                } else {
			$sql="SELECT retailShop_no,retail_id 
                              FROM retailshop
                              ORDER BY sort";
			$result = $db->query($sql);
			if ($result) {
				echo 'From: <select class="" id="shop_list">';
				while ($row = $db->fetch_array($result)) {
					echo '<option value="'.$row['retailShop_no'].'">'.$row['retail_id'].'</option>';
				}
				echo '</select>';
			}
		}
		
		if(isset($_POST['list_type'])){
                    if($_POST['list_type']==2){
                        echo ' To: <select class="" id="shop_list_b">';
                        $sql="SELECT retailShop_no,retail_id 
                              FROM retailshop
                              ORDER BY sort";
                        $result = $db->query($sql);
                        if ($result) {
                            while ($row = $db->fetch_array($result)) {
                                echo '<option value="'.$row['retailShop_no'].'">'.$row['retail_id'].'</option>';
                            }
                                echo '</select>';
                        }
                    }
		}
		break;
	case 'get_accMobi_list':
            $sql="select * from acctype";
            $result = $db->query($sql);
            if ($result) {
                echo '<select class="" id="accMobi_list">';
                while ($row = $db->fetch_array($result)) {
                    echo '<option value="'.$row['accType_no'].'">'.$row['typeName'].'</option>';
                }
                echo '<option value="mobile">手機</option>';
                echo '</select>';
            }
        break;
	case 'get_supplier_list':
		$sql="select supplier_no,supplier_id,supplierName from supplier";
		$result = $db->query($sql);
			if ($result) {
				echo '<select class="" id="supplier_list" style="width:600px;">';
				while ($row = $db->fetch_array($result)) {
					echo '<option value="'.$row['supplier_no'].'">'.'ID:'.$row['supplier_id'].'     '.$row['supplierName'].'</option>';
				}
				echo '</select>';
			}
		break;
	case 'insert_dend':
		$dendArray = $_GET['dendArray'];
		$in_date= $_GET['date'];
		$shopno= $_GET['shopno'];
		$dend_staff= $_GET['dend_staff'];
		
		$DATE2=date("Y-m-d");
		$isOK = false;
		
		$DATE2_s1=explode('-',$DATE2);  //cut the date into array
		$DATE2_time=mktime(0,0,0,$DATE2_s1[1],$DATE2_s1[2],$DATE2_s1[0]); //換做秒
		
		$in_date_s1=explode('-',$in_date);  //cut the date into array
		$in_date_time=mktime(0,0,0,$in_date_s1[1],$in_date_s1[2],$in_date_s1[0]); //換做秒
		
		//echo $in_date_time.'.'.$DATE2_time;
		if($in_date_time==$DATE2_time){
			
			$isOK = true;
		}
		else{
			echo '1';
		}
		if($isOK){
			$rec_date=date("Y-m-d H:i:s");
			$sql="INSERT INTO dend (`createDate`, `retailShop_no`,createBy) VALUES ('$rec_date', $shopno,'$dend_staff')";
			$db->query($sql);
			$last_insert_id_2= $db->insert_id();
			
				$dendArray_s1=explode(',',$dendArray);
				$dendArray_s1_length = count($dendArray_s1);
				
				$startDay = $DATE2.' '.'00:00:00';
				$endDay = $DATE2.' '.'23:23:59';
		
				for($i=0;$i<$dendArray_s1_length;$i++){	
					$dendArray_s2=explode(':',$dendArray_s1[$i]);
					$dendArray_s3=explode('_',$dendArray_s2[0]);
					$search_pay_no = $dendArray_s3[2];
					//echo $dendArray_s2[1];
					
					$sql1="select invoice_no from invoice where createDate >= '$startDay' && createDate <= '$endDay'";
					$result = $db->query($sql1);
					$temp=null;
					if ($result) {
						while ($row1 = $db->fetch_array($result)) {
							$temp[] =$row1['invoice_no'];
						}
					} 
					$arrLen = count($temp);		
					$temp2='';
					for($z=0;$z<$arrLen;$z++){
						$temp2 .= $temp[$z];
						if($z!=($arrLen-1))
							$temp2.=',';
						//echo $temp2;
					}
					$sql2="SELECT sum(money)as total
						FROM payment_has_invoice 
						right OUTER join payment on payment.payment_no = payment_has_invoice.payment_no
						where invoice_no in ($temp2)
						AND payment_has_invoice.payment_no=$search_pay_no
						group by payment_has_invoice.payment_no";
					$total= $db->getOne($sql2);
					
					$sql3="INSERT INTO dend_detail (`dend_no`,`coll_price`, `end_price`,`payment_no`) VALUES ('$last_insert_id_2','$total', $dendArray_s2[1],$search_pay_no)";
					$db->query($sql3);
					//echo $sql3;
					
				}
				echo '0';
			}
		break;
	case 'get_dayend':
		$DATE2=date("Y-m-d");           //must set timezone on the top	
		
		$shopno=$_GET['shopno'];
		$sql="select * from dend where createDate like '$DATE2%' and retailShop_no=$shopno";
		$result = $db->num_rows($db->select($sql));
		if($result<=0){
		
		
			echo '<table border="0" class="dend_table" id="dend_table" style="width:100%" cellpadding="10" >'.
				'<thead>'.
					'<th>付款方法</th>'.
					'<th>金額</th>'.
					'<th>結數</td>';
			echo '</thead><tbody>';
			
					
			$DATE2_s1=explode('-',$DATE2);  //cut the date into array
			
			$sql1="select invoice_no from invoice where year(createDate) = $DATE2_s1[0] AND month(createDate) = $DATE2_s1[1] AND day(createDate) = $DATE2_s1[2]
					and retailShop_no=$shopno and invoiceState_no!=2"; //invoiceState_no!=2 單據無效
			
			$result = $db->query($sql1);
			$temp=null;
			if ($result) {
				while ($row1 = $db->fetch_array($result)) {
					$temp[] =$row1['invoice_no'];
				}
				
			} 
			$arrLen = count($temp);		
			$temp2='';
			for($z=0;$z<$arrLen;$z++){
				$temp2 .= $temp[$z];
				if($z!=($arrLen-1))
					$temp2.=',';
				//echo $temp2;
			}
			
			$sql2="SELECT * ,sum(money)as total
					FROM payment_has_invoice 
					right OUTER join payment on payment.payment_no = payment_has_invoice.payment_no
					where invoice_no in ($temp2)
					group by payment_has_invoice.payment_no";
			//echo $sql2;
			$result2 = $db->query($sql2);
			if ($result2) {
				while ($row2 = $db->fetch_array($result2)) {
					echo '<tr><td>'.$row2['paymentName'].'</td>';
					echo '<td><div class="ssdd">'.$row2['total'].'</div></td>';
					echo '<td>$<input class="asdd" id="dend_pay_'.$row2['payment_no'].'" type="text" style="border: 1px solid #000000; width:85px; height:25px;"
								onkeyup="return validateNumberB($(this),value)"/><div id="errorMsg"></div></td>';
					echo '</tr>';
				}
			}
			echo '</tbody></table>';
			echo "<input type=\"button\" value=\"結帳\" class=\"finIncel\"  onclick=\"dend_submit();\"/>";
			echo '<script>var asdf = $(\'#dend_table\').find("[class*=asdd]").get() ;';	
			echo '</script>';
		} else 
			echo '<p style="color:red;font-size:30px;">已結數</p>';
		break;

        case 'checkImeiExist':
            $shopno = null;
            $shop_sql = '';
            if(isset($_GET['shopno'])){
                $shopno = $_GET['shopno'];
                $shop_sql = "and retailshop_no = $shopno";
            }
            $imei   = $_GET['imei'];
                
            $sql="SELECT * FROM phone where imei ='$imei' $shop_sql and phoneState_no = 1";
            $num = $db->num_rows($db->query($sql));
            $phondata = array();
            $result = $db->query($sql);
            if ($result) {
                while ($row = $db->fetch_array($result)) {
                    $phondata[] = $row;
                }
            }
            //echo $num;
            echo count($phondata);
        break;
        
        case 'addtransmobile':
            $shopno = $_SESSION['retail_no'];
            $shop_sql = "and retailshop_no = $shopno";
            
            //print_r($_POST);
            $imeis=array();
            if(isset($_POST['imei'])){
                $imeis = $_POST['imei'];
            }
            if(isset($_POST['shopinfo'])){
                $temp_shopinfo = $_POST['shopinfo'];
                $from_shopinfo = new stdClass();
                $from_shopinfo->staffid = trim($temp_shopinfo['staff_id']);
                $from_shopinfo->staffno = trim($temp_shopinfo['staff_no']);
                $from_shopinfo->fromretail = $shopno;
                $from_shopinfo->toretail = trim($temp_shopinfo['toRetail']);
            }
            if(!$imeis){
                //echo error msg
                exit;
            }
            $failphonedata = array();
            $okphonedata = array();
            foreach ($imeis as $imei) {
                $sql="SELECT * FROM phone where imei ='$imei' $shop_sql and phoneState_no = 1";
                $result = $db->query($sql);
                $phonedata = array();
                
                if ($result) {
                    while ($row = $db->fetch_array($result)) {
                        
                        $phonedata_obj = new stdClass();
                        foreach($row as $key => $value){
                            $phonedata_obj->$key = $value;
                        }
                        $phonedata[] = $phonedata_obj;
                    }
                }
                if(count($phonedata) == 0){ // 1==OK 0==not ok
                    $failphonedata[] = $imei;
                } else {
                    $okphonedata[$imei] = $phonedata[0];
                }
            }
            if($failphonedata != null){
                //print error
                /*
                print_r("no add phone");
                print_r($failphonedata);
                print_r("end of no add phone");
                 * 
                 */
                //add 完唔可以再ADD
                $arr = array("isok"=>0);
                echo json_encode($arr);
                exit();
                
            } else {
                $result = doaddtransmobile($shopno, $okphonedata);
                //print_r($result);
                if($result){ //had update phone to transfer
                    if(add_mobiletotransfer($from_shopinfo, $okphonedata)){
                        $arr = array("isok"=>1);
                        echo json_encode($arr);
                        exit();
                    }
                }
            }
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
	case 'createRecNo':
	//$sql="INSERT INTO sinno_ref (`stockin_no`) VALUES ($stockin_no)";
		$pod_no=$_GET['pod_no'];
		$staffid=$_GET['staffid'];
		$staffno = getStaffNo($staffid);
		$sql="select sinno_ref_no from sinno_ref where pod_no = $pod_no";
		$numOfRow = $db->num_rows($db->select($sql));
		
		$create_date=date("Y-m-d H:i:s");
		
		if($numOfRow >0){
			echo $db->getOne($sql);
		}else{
			$sql="INSERT INTO sinno_ref (`stockin_no`,`pod_no`,`createDate`,`createBy`) VALUES (1,$pod_no,'$create_date','$staffno')";
			$db->query($sql);
			echo $db->insert_id();
		}
		break;
	case 'recMobile':
		$imei=$_GET['imei'];
		$phoneType_no=$_GET['phoneType_no'];
		$shopno=$_GET['shopno'];
		$phoneState_no=$_GET['phoneState_no'];
		$poDetail_no=$_GET['poDetail_no'];
		$rec_date=date("Y-m-d H:i:s");
		$sinno_ref_no=$_GET['sinno_ref_no'];
		$cost=$_GET['cost'];
		$is_acc=1; // 1 = is phone
	
		$sql="INSERT INTO phone (`IMEI`, `phoneType_no`, `retailShop_no`, `phoneState_no`, `poDetail_no`, `rec_date`,`sinno_ref_no`,`iprice`,`is_acc`)
			  VALUES ('$imei', $phoneType_no, $shopno, $phoneState_no, $poDetail_no, '$rec_date',$sinno_ref_no,'$cost',$is_acc)";
		$db->query($sql);
		break;
	case 'recGoods':
            $podNo        = $_GET['podNo'];
            $rec_Qty      = $_GET['rec_Qty'];
            $poDate       = $_GET['poDate'];
            $sinno_ref_no = $_GET['sinno_ref_no'];
            $isforshop    = $_GET['forshop'];
		
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
		
            $stockin_no=0;
            if($pod_acc_no!=null){
                $sql="INSERT INTO stockin
                        (`poDetail_no`, `staff_no`, `acc_no`, `retailShop_no`, `rec_qty`,
                         `rec_date`, `po_date`, `iprice`, `ava_bal`,`sinno_ref_no`,
                         `isforshop`) 
                      VALUES ($podNo, $staffno, $pod_acc_no, $shopno, $rec_Qty,
                            '$rec_date', '$poDate', '$pod_iprice', $ava_bal,$sinno_ref_no,
                            '$isforshop')";
                $db->query($sql);
            }
            print_r($sql);
            break;
	case 'getPOD':
            $detail_of_po_inTable='';
            $poNo=$_GET['poNo'];
            $sql1="select p.po_no, p.createDate, staff_id, supplierName, stateName, p.poState_no, retail_id,
                        modify_by, po_desc,modify_date, forshop
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
            $forshop=$row1['forshop'];

            if(check_is_office() and $poState_no==1){
                $detail_of_po_inTable .= '<input type=\"button\" value=\"刪除PO\" class=\"finIncel\"  onclick=\"deletepo('.$poNo.');\" />';
            }

            $numOfRow = $db->num_rows($db->query($sql1));

            $qtyMsg='<td>Qty</td>';

            $detail_of_po_inTable .= '<table border=\"1\" width=\"100%\">'.
									'<tr>';
			if($poState_no!=3 || $poState_no==4){  //3=完結-- 貨全部收到
				$detail_of_po_inTable .='<td>poDetail_no</td>';
				$qtyMsg='<td>Qty (尚欠數量)</td>';
			}
		$detail_of_po_inTable .= '<td>Product ID</td>'.
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
					$sql4="select sum(rec_qty) as recedQty from stockin where retailShop_no=1 and poDetail_no=".$row2['poDetail_no']; //找出stockin, office 收了多少貨
					
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
							'<input type=\"button\" value=\"收貸\" onclick=\"recGoods('.$row2['poDetail_no'].','.$nonRecQty.','.$acc_or_phone.','.$cost.','.$recedQty.','.$forshop.')\" />';
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
			
			$tempPoNo = $poNo;
			$poNo = getPoNo($tempPoNo);
			
                        //get retail_id
                        $forshop = get_retail_id($forshop);
			echo "var tt =new Array(\"$numOfRow\",\"$poNo\",\"$createDate\",\"$staff_id\",\"$supplierName\",
                                                \"$stateName\",\"$retail_id \",\"$detail_of_po_inTable \",\"$poState_no\",\"$totalNonRecQty\",
                                                \"$totalRecQty\",\"$modify_by\",\"$po_desc\",\"$modify_date\", \"$forshop\");";
		}//end of if
		break;
		
	case 'getSiBottom':
		$sql="select p.po_no, p.createDate, staff_id, supplierName, stateName
				from po p, staff st, supplier sp, poState ps
				where p.staff_no = st.staff_no
				and p.supplier_no = sp.supplier_no
				and p.poState_no = ps.poState_no
				and p.poState_no in (2,1)
				order by p.createDate desc";
		$pageNo = $_GET['pageNo'];
		//$result = $db->selectLimit($sql, '14',$pageNo);
		$result = $db->query($sql);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<div id="poTable"><table rules="all" border="1"  class="finMobile" style=" width:100%; align=right;" >'.
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
			$tempPoNo = $row['po_no'];
			$finalPoNo = getPoNo($tempPoNo);
				echo '<tr><td><a href="#" style="color:#0019FF;" 
								onclick="findPOHead(\''.$finalPoNo.'\');">'.$finalPoNo.'</a></td>'.
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
		case 'get_staff_list':
			$sql="select * from staff";
			$result = $db->query($sql);
			if ($result) {
				echo '<select class="" id="staff_list">';
				while ($row = $db->fetch_array($result)) {
					echo '<option value="'.$row['staff_no'].'">'.$row['staff_id'].'</option>';
				}
				echo '</select>';
			}
		break;
		case 'get_staff_list_name':
			$sql="select * from staff";
			$result = $db->query($sql);
			if ($result) {
				echo '<select class="" id="staff_list">';
				while ($row = $db->fetch_array($result)) {
					echo '<option value="'.$row['staff_id'].'">'.$row['staff_id'].'</option>';
				}
				echo '</select>';
			}
		break;
		case 'report_num':
			switch($_POST['report_num']){
				case '1': //貨物入倉報表
					get_stockin_report();
					break;
				case '2': //貨物轉倉報表
					get_trans_report();
					break;
				case '3': //銷售報表 - 總覧
					get_sales_report_all();
					break;
				case '4': //銷售報表 - 明細
					get_sales_report_detail();
					break;
				case '5': //收入報表
					get_in_money();
					break;
				case '6': //庫存報表
					get_stock_report();
					break;
				case '7': //庫存報表 - 總覧
					get_stock_report_overview();
					break;
				
			}
			break;
	}//end of switch
}//end of if isset

function get_sales_report_detail(){
	global $db;
	$DATE2=date("Y-m-d");
	$DATE2_s1=explode('-',$DATE2);  //cut the date into array
	
	echo '<table border="0" class="sales_report" style="width:100%" >'.
			'<thead>'.
			 	'<th style="width: 90px">開單日期</th>'.
				'<th>單號</th>'.
				'<th>舊單號碼</th>'.
				'<th>產品編號</th>'.
				'<th>產品名稱</th>'.
				'<th style="width: 70px">數量</th>';
		if(check_is_office())
			echo'<th style="width: 70px">成本</th>';
		echo	'<th style="width: 70px">金額</th>'.
				'<th style="width: 70px">折扣</th>'.
				'<th style="width: 70px">總金額</th>';
		if(check_is_office())
			echo'<th style="width: 70px">毛利</th>';
		echo	'<th style="width: 70px">店員佣金</th>';
		if(check_is_office())
			echo'<th style="width: 70px">店長佣金</th>';
		echo	'<th style="width: 70px">分店</th>'.
				'<th>開單員工</td>';
		echo '</thead><tbody>';
		$sql1="select *
			  from invoice 
			  left join retailShop on invoice.retailShop_no=retailShop.retailShop_no
			  where createDate > '2011-12-21'
			  ";
		if(isset($_POST['datepicker_from']) && isset($_POST['datepicker_to'])){
			$startDay = $_POST['datepicker_from'];
			$endDay = $_POST['datepicker_to'];
			$startDay_s1=explode('-',$startDay);  //cut the date into array
			$endDay_s1=explode('-',$endDay);  //cut the date into array
			$sql1 .=" and year(createDate) >= $startDay_s1[0]
			and year(createDate) <= $endDay_s1[0]
			AND month(createDate) >= $startDay_s1[1]
			AND month(createDate) >= $endDay_s1[1]
			AND day(createDate) >= $startDay_s1[2] 
			AND day(createDate) <= $endDay_s1[2]";
		} else if(isset($_POST['shop_list']) || isset($_POST['accMobi_list']) || isset($_POST['product_id']) || isset($_POST['staff_list']) || isset($_POST['inv_type'])){
			$sql1.="";
		} else {
			$sql1 .=" and year(createDate) = $DATE2_s1[0] AND month(createDate) = $DATE2_s1[1] AND day(createDate) = $DATE2_s1[2]";
		}
		if(isset($_POST['inv_type'])){
			$inv_type=$_POST['inv_type'];
			if($inv_type==1 || $inv_type==2 || $inv_type==3)
				$sql1 .=" and invoiceType_no =$inv_type";
			else if($inv_type==4) //Void單
				$sql1 .=" and invoiceState_no =2";
		}
		if(isset($_POST['staff_list'])){
			$staff_list=$_POST['staff_list'];
			$sql1 .=" and createBy in ($staff_list)";
		}
		if(check_is_office() || $_SESSION['retail_no']==10001){
			if(isset($_POST['shop_list'])){
				$shop_list = $_POST['shop_list'];
				$sql1 .=" and invoice.retailShop_no in ($shop_list)";
			}
		} else {
			$sql1 .=" and invoice.retailShop_no in (".get_retail_no().")";
		}
		
		$sql1.=" order by invoice.invoice_no";
		
		$result = $db->query($sql1);
		$total_selling_price=0;
		$total_amount=0;
		if ($result) {
			while ($row1 = $db->fetch_array($result)) {
				$invoice_no = $row1['invoice_no'];
				if($row1['invoiceType_no']==1) //發票 Invoice
					$finalinvoice_no = getInvoiceNo($invoice_no);
				else if($row1['invoiceType_no']==2) //退貨單 Return
					$finalinvoice_no = getReturnNo($invoice_no);
				else if($row1['invoiceType_no']==3) //換貨單 Exchange
					$finalinvoice_no = getExchangeNo($invoice_no);
				
				$DATE1=$row1['createDate'];
				$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
				$total_qty=0;$final_tol_price=0;
				
				$sql2="select *, invoicedetail.description as phDesc,invoicedetail.commission_1 as cm1, invoicedetail.commission_2 as cm2
					   from invoicedetail 
					   left join( accessories acc left join acctype acct ON acc.accType_no=acct.accType_no) ON acc.acc_no = invoicedetail.product_no
					   left join(phone left join phonetype on phone.phoneType_no = phoneType.phoneType_no) on phone.IMEI = invoicedetail.product_no
					   ";

				if(isset($_POST['accMobi_list'])){
					$accMobi_list = $_POST['accMobi_list'];
					if($accMobi_list =='mobile'){
						$sql2 .=" where invoice_no=$invoice_no";
						$sql2 .=" and goodsType =1";
					}else{
						$sql2 .=" where invoice_no=$invoice_no";
						$sql2 .=" and goodsType=0";
						$sql2 .=" and acc.accType_no=$accMobi_list";
					}
				}
				if(isset($_POST['product_id'])){
					$product_id = $_POST['product_id'];
					$sql2 .=" where invoicedetail.product_no = '$product_id' or phoneType.phonetype_id = '$product_id'";
					$sql2 .=" having invoice_no=$invoice_no";
				}
				if(!isset($_POST['product_id'])){
					if(!isset($_POST['accMobi_list'])){
						$sql2 .=" where invoice_no=$invoice_no";
					}
				}
				if(isset($_POST['inv_type'])){
					$inv_type=$_POST['inv_type'];
						if($inv_type==5)
							$sql2 .=" and discount>0.0";
				}
				//echo $sql2;
				$result2 = $db->query($sql2);
				$num_rows = $db->num_rows($db->select($sql2));
				if ($result2 && $num_rows>0) {
					while ($row2 = $db->fetch_array($result2)) {
						
						$total_qty=$total_qty+$row2['qty'];						
						$temp_tol_price = ($row2['price']-$row2['discount'])*$row2['qty'];
						
						$final_tol_price= $final_tol_price + $temp_tol_price;
						
						$amount = $temp_tol_price-($row2['cost']*$row2['qty']);
						if($row1['invoiceState_no']!=2){
							$total_selling_price = $total_selling_price+$temp_tol_price;
							$total_amount=$total_amount+$amount;
						}
						
						echo '<tr>'.
								'<td>'.$DATE1_s1[0].'</td>';
						
						switch($row1['invoiceState_no']){
							case '1': 
								echo '<td style="padding:0 5px 0 5px">'.$finalinvoice_no.'</td>';
								echo'<td style="padding:0 5px 0 5px"></td>';
								break;
							case '2': //單據無效
								echo '<td style="padding:0 5px 0 5px;color:red;">'.$finalinvoice_no.'</td>';
								echo'<td style="padding:0 5px 0 5px;color:red;">單據無效</td>';
								break;
							case '3': //銷售報表 - 總覧
								echo '<td style="padding:0 5px 0 5px">'.$finalinvoice_no.'</td>';
								echo'<td style="padding:0 5px 0 5px;color:#7FA3FF;">'.getInvoiceNo($row1['remark']).'</td>';
								break;
							case '4': //銷售報表 - 明細
								echo '<td style="padding:0 5px 0 5px">'.$finalinvoice_no.'</td>';
								echo'<td style="padding:0 5px 0 5px;color:#64AF4B;">(有退貨)</td>';
								break;
							default:
								echo '<td style="padding:0 5px 0 5px">'.$finalinvoice_no.'</td>';
								break;
						}
						
						
						echo	'<td style="padding:0 5px 0 5px">'.$row2['product_no'].'</td>'.
								'<td style="text-align:left;padding:0 5px 0 5px;">'.$row2['phDesc'].'</td>'.
								'<td style="padding:0 5px 0 5px;">'.$row2['qty'].'</td>';
						if(check_is_office())
							echo'<td style="padding:0 5px 0 5px;">$'.number_format($row2['cost'],1,'.',',').'</td>';
						echo	'<td style="padding:0 5px 0 5px;">$'.number_format($row2['price'],1,'.',',').'</td>'.
								'<td style="padding:0 5px 0 5px;">$'.number_format($row2['discount'],1,'.',',').'</td>'.
								'<td style="padding:0 5px 0 5px;">$'.number_format($temp_tol_price,1,'.',',').'</td>';
						if(check_is_office())
							echo'<td style="padding:0 5px 0 5px;">$'.number_format($amount,1,'.',',').'</td>';
						echo	'<td style="padding:0 5px 0 5px;">$'.number_format($row2['cm1'],1,'.',',').'</td>';
						if(check_is_office())
							echo'<td style="padding:0 5px 0 5px;">$'.number_format($row2['cm2'],1,'.',',').'</td>';
						echo	'<td style="padding:0 5px 0 5px;">'.$row1['retail_id'].'</td>'.
								'<td style="padding:0 5px 0 5px;">'.$row1['createBy'].'</td>';
						echo '</tr>';
						
						/*
						if($row1['invoiceState_no']==4){
							$invoicedetail_no=$row2['invoiceDetail_no'];
							$pastIDV= $row2['pastIDV'];
							$finalreturn_no = getReturnNo($pastIDV);
							
							if($pastIDV!=''){
								$sql5="select * from invoicedetail
										left join( accessories acc left join acctype acct ON acc.accType_no=acct.accType_no) ON acc.acc_no = invoicedetail.product_no
										left join(phone left join phonetype on phone.phoneType_no = phoneType.phoneType_no) on phone.IMEI = invoicedetail.product_no
										left join(invoice inv left join retailShop on inv.retailShop_no=retailShop.retailShop_no) on invoicedetail.invoice_no = inv.invoice_no
										where invoicedetail.pastIDV = $invoicedetail_no";
										
								$result5 = $db->query($sql5);
								$num_rows = $db->num_rows($db->select($sql5));
								while ($row5 = $db->fetch_array($result5)) {
								$invoice_no= $row5['invoice_no'];
								$finalreturn_no = getReturnNo($invoice_no);
									if ($result5 && $num_rows>0) {
										$DATE2=$row5['createDate'];
										$DATE2_s1=explode(' ',$DATE2); //cut out the date (without time) into array
										$temp_total=$row5['qty']*$row5['price']; //總金額
										$amount = $temp_total-($row5['cost']*$row5['qty']);
										echo '<tr>'.
											'<td>'.$DATE2_s1[0].'</td>'.
											'<td style="padding:0 5px 0 5px">'.$finalreturn_no.'</td>'.
											'<td style="padding:0 5px 0 5px">'.$row5['product_no'].'</td>'.
											'<td style="text-align:left;padding:0 5px 0 5px;">'.$row2['phDesc'].'(退貨)</td>'.
											'<td style="padding:0 5px 0 5px;">'.$row5['qty'].'</td>';
									if(check_is_office())
										echo'<td style="padding:0 5px 0 5px;">$'.number_format($row5['cost'],1,'.',',').'</td>';
										echo'<td style="padding:0 5px 0 5px;">$'.number_format($row5['price'],1,'.',',').'</td>'.
											'<td style="padding:0 5px 0 5px;">$'.number_format($temp_total,1,'.',',').'</td>';
									if(check_is_office())
										echo'<td style="padding:0 5px 0 5px;">$'.number_format($amount,1,'.',',').'</td>';
										echo'<td style="padding:0 5px 0 5px;">'.$row5['retail_id'].'</td>'.
											'<td style="padding:0 5px 0 5px;">'.$row5['createBy'].'</td>';
										echo '</tr>';
									
									$final_tol_price = $final_tol_price - $temp_total;
									$total_amount = $total_amount - $amount;
									$total_selling_price = $total_selling_price - $row5['price'];
									}
								}
							}
							//echo $pastIDV.'  ';
						}*/
						
					}
					echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
					
					if(check_is_office())
						echo '<tr><td colspan="5" style="text-align:right">Total : </td>'.'<td>'.$total_qty.
							'</td><td></td><td></td><td></td><td>$'.number_format($final_tol_price,1,'.',',').'</td></tr>';
					else
						echo '<tr><td colspan="5" style="text-align:right">Total : </td>'.'<td>'.$total_qty.
							'</td><td></td><td></td><td>$'.number_format($final_tol_price,1,'.',',').'</td></tr>';
					echo '<tr style="height:20px"></tr>';
					
				}
			}
		}
		echo '<tr style="height:20px"></tr><tr><td colspan="4" style="text-align:right">總金額 : </td>'.'<td>
						$'.number_format($total_selling_price,1,'.',',').'</td></tr>';
		if(check_is_office())
			echo '<tr><td colspan="4" style="text-align:right">總毛利 : </td>'.'<td>
						$'.number_format($total_amount,1,'.',',').'</td></tr>';
}
function get_stock_report_overview(){
	global $db;
	echo '<table border="0" class="stock_report" style="width:100%" >'.
			 '<thead>'.
		 	//'<th style="width: 110px">產品編號</th>'.
			'<th>產品名稱</th>'.
			'<th style="width: 70px">分類</th>';
	echo '<th style="width: 70px">總庫存數量</th>';
	$sql="select retailShop_no,retail_id from retailshop";
		if(isset($_POST['shop_list'])){
			$shop_list = $_POST['shop_list'];
			if(check_is_office()){
				$sql .=" where retailShop_no in ($shop_list)";					
			} else {
				$sql .=" where retailShop_no != 1";
				$sql .=" and retailShop_no in ($shop_list) ";
			}
		} else{
			if(check_is_office()){
			} else
				$sql .=" where retailShop_no != 1";
		}

	$sql .="  order by retail_id";
	$result = $db->query($sql);
	while ($row = $db->fetch_array($result)) {
		echo '<th style="padding:0 5px 0 5px; border:1;">'.$row['retail_id'].'</th>';
	}
	echo '</thead><tbody>';
	$sql2="select * from accessories
			left join acctype
			on acctype.accType_no = accessories.accType_no";
		if(isset($_POST['accMobi_list'])){
			$accMobi_list = $_POST['accMobi_list'];
			if($accMobi_list =='mobile')
				$sql2 .=" where accessories.accType_no is null";
			else
				$sql2 .=" where accessories.accType_no = $accMobi_list";
		}
		if(isset($_POST['product_id'])){
			$product_id = $_POST['product_id'];
			$sql2 .=" where accessories.acc_id = '$product_id'";
		}
	$result2 = $db->query($sql2);
	while ($row2 = $db->fetch_array($result2)) {
		$temp_acc_no=$row2['acc_no'];
		echo '<tr>';
		//echo '<td>'.$row2['acc_id'].'</td>';
		echo '<td style="text-align:left;padding:0 10px 0 10px;">'.$row2['accName'].'</td><td>'.$row2['typeName'].'</td>';
		$sql="select retailShop_no,retail_id from retailshop";
		if(isset($_POST['shop_list'])){
			$shop_list = $_POST['shop_list'];
			if(check_is_office()){
				$sql .=" where retailShop_no in ($shop_list)";					
			} else {
				$sql .=" where retailShop_no != 1";
				$sql .=" and retailShop_no in ($shop_list) ";
			}
		} else{
			if(check_is_office()){
			} else
				$sql .=" where retailShop_no != 1";
		}
		$sql .="  order by retail_id";
		$result = $db->query($sql);
		$temp_qty=0;
		$qtyArray=array();
		while ($row = $db->fetch_array($result)) {
			$temp_shopno=$row['retailShop_no'];
			$sql3="select sum(ava_bal) as total_qty
		   		FROM stockin si
				where si.retailShop_no=$temp_shopno
				and si.acc_no=$temp_acc_no
				group by si.acc_no,si.retailShop_no;";
				$result3 = $db->query($sql3);
			$result12 = $db->num_rows($db->select($sql3));
			
			
				
			//找出目的日子之間的invoiceDetail的SQL
			if(isset($_POST['datepicker_from'])){
				$startDay = $_POST['datepicker_from'];
				$startDay_s1=explode('-',$startDay);  //cut the date into array
				$today=date("Y-m-d");
				$today_s1=explode('-',$today);  //cut the date into array
				
				$sql4="select product_no, sum(qty) as total_qty_2
					   from invoice
					   left join invoicedetail on invoice.invoice_no = invoicedetail.invoice_no
					   where invoiceType_no in (1,2)
					   and invoiceState_no!=2
					   and goodsType=0
					   and invoice.retailShop_no = $temp_shopno
					   and product_no = (select acc_id from accessories where acc_no = $temp_acc_no)
					   and year(createDate) >= $startDay_s1[0] and year(createDate) <= $today_s1[0]
					   and month(createDate) >= $startDay_s1[1] and month(createDate) <= $today_s1[1]
					   and day(createDate) >=  $startDay_s1[2] and day(createDate) <= $today_s1[2];";
				//$result4 = $db->query($sql4);
				//echo $sql4;
				$temmp4 = $db->getrow($sql4);
				//if($temmp4['product_no']!=null)
				//	echo $temmp4['product_no'].' '.$temmp4['total_qty_2'].'<br>';
				
				if($result12==null && $temmp4==null)
					$qtyArray[] = '<td>0</td>';
				else
					while ($row3 = $db->fetch_array($result3)) {
							$qtyArray[]= '<td>'.($row3['total_qty']+$temmp4['total_qty_2']).'</td>';
							$temp_qty = $temp_qty+($row3['total_qty']+$temmp4['total_qty_2']);
					}
					
			} else {
				if($result12==null)
					$qtyArray[] = '<td>0</td>';
				else
					while ($row3 = $db->fetch_array($result3)) {
							$qtyArray[]= '<td>'.$row3['total_qty'].'</td>';
							$temp_qty = $temp_qty+$row3['total_qty'];
					}
			}
		}
		echo '<td>'.$temp_qty.'</td>';
		$qtyArray_length=count($qtyArray);
		for($i=0; $i<$qtyArray_length; $i++){
			echo $qtyArray[$i];
		}
		echo '</tr>';
		echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
	}
	
	
	$sql2="select * from phonetype";
	if(isset($_POST['accMobi_list'])){
		$accMobi_list = $_POST['accMobi_list'];
		if($accMobi_list!='mobile')
			$sql2 .=" where phonetype.phoneType_no ='ddd'";
	}
	if(isset($_POST['product_id'])){
		$product_id = $_POST['product_id'];
		$sql2 .=" where phonetype_id = '$product_id'";
	}
	$result2 = $db->query($sql2);
	
	while ($row2 = $db->fetch_array($result2)) {
		$temp_phoneType_no=$row2['phoneType_no'];
		echo '<tr>';
	//	echo '<td>'.$row2['phonetype_id'].'</td>';
		echo '<td style="text-align:left;padding:0 10px 0 10px;">'.$row2['manufacturer'].' '.$row2['phone_name'].' ('.$row2['color'].')</td><td>手機</td>';
		$sql="select retailShop_no,retail_id from retailshop";
		if(isset($_POST['shop_list'])){
			$shop_list = $_POST['shop_list'];
			if(check_is_office()){
				$sql .=" where retailShop_no in ($shop_list)";					
			} else {
				$sql .=" where retailShop_no != 1";
				$sql .=" and retailShop_no in ($shop_list) ";
			}
		} else{
			if(check_is_office()){
			} else
				$sql .=" where retailShop_no != 1";
		}
		$sql .="  order by retail_id";
		$result = $db->query($sql);
		$temp_qty=0;
		$qtyArray=array();
		while ($row = $db->fetch_array($result)) {
			$temp_shopno=$row['retailShop_no'];
				$sql3="select count(*) as total_qty
		   		FROM phone ph
				where ph.retailShop_no=$temp_shopno
				and ph.phoneType_no=$temp_phoneType_no
				and ph.phoneState_no=1
				group by ph.retailShop_no, ph.phoneType_no;";
			$result3 = $db->query($sql3);
			$result12 = $db->num_rows($db->select($sql3));
			
			if($result12==null)
				$qtyArray[]= '<td>0</td>';
			else
			while ($row3 = $db->fetch_array($result3)) {
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
		echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
	}
	echo '</tbody></table>';
}
function get_stock_report(){
	global $db;
	echo '<table border="0" class="stock_report" style="width:100%;" >'.
            '<thead>'.
         //	 '<th style="width: 110px">產品編號</th>'.
           	 '<th>產品名稱</th>'.
           	 '<th style="width: 70px">分類</th>'.
           	 '<th style="width: 70px">庫存數量</th>';
	if(check_is_office())
        echo '<th style="width: 100px">成本</th>'.
			 '<th style="width: 100px">總成本</th>'.
           	 '<th style="width: 70px">盤點數量</th>';
       echo	 '<th style="width: 70px">分店</th>';
       echo	'</thead><tbody>';
	$total_price=0;
	$sql1="select transfer_no 
		  from transfer 
		  where transDate > '2011-12-21'";
		
	$sql2="select acc.acc_id,acc.accName,typeName,sum(ava_bal) as total_qty,
		   iprice, (sum(ava_bal)*iprice) as total_price,retail_id
		   FROM stockin si
		   LEFT JOIN  ( accessories acc left join acctype acct ON acc.accType_no=acct.accType_no) ON si.acc_no = acc.acc_no
		   LEFT JOIN retailShop ON si.retailShop_no=retailShop.retailShop_no";
			if(isset($_POST['shop_list'])){
				$shop_list = $_POST['shop_list'];
				if(check_is_office()){
					$sql2 .=" where si.retailShop_no in ($shop_list)";					
				} else {
					$sql2 .=" where si.retailShop_no != 1";
					$sql2 .=" and si.retailShop_no in ($shop_list) ";
				}
			} else{
				if(check_is_office()){
				} else
					$sql2 .=" where si.retailShop_no != 1";
			}
			
			if(isset($_POST['accMobi_list'])){
				$accMobi_list = $_POST['accMobi_list'];
				if($accMobi_list =='mobile')
					$sql2 .=" where si.accType_no is null";
				else
					$sql2 .=" where acc.accType_no = $accMobi_list";
			}
			if(isset($_POST['product_id'])){
				$product_id = $_POST['product_id'];
				$sql2 .=" where acc.acc_id = '$product_id'";
			}
		   $sql2 .=" group by si.acc_no,si.retailShop_no, iprice";
		   $sql2 .=" order by si.retailShop_no";
		   
	$result2 = $db->query($sql2);
		if ($result2) {
			while ($row2 = $db->fetch_array($result2)) {
				$total_price=$total_price+$row2['total_price'];
				echo '<tr>';
				//echo '<td>'.$row2['acc_id'].'</td>';
				echo	 '<td style="text-align:left">'.$row2['accName'].'</td>';
				echo	 '<td>'.$row2['typeName'].'</td>';		 
				echo	 '<td>'.$row2['total_qty'].'</td>';
				if(check_is_office())
					echo '<td>$'.$row2['iprice'].'</td>'.
						 '<td>$'.$row2['total_price'].'</td>';
				echo	 '<td>'.$row2['retail_id'].'</td>'.
					 '</tr>';
			} //end of row2 while
			echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
		}//end of result2 if
	$sql3="select phonetype_id, manufacturer, phone_name, color,count(*) as total_qty,
		   retail_id, phone.retailShop_no,cost,(count(*)*cost) as total_price,
              imei
		   from phone
		   left join retailShop
		   on phone.retailShop_no = retailShop.retailShop_no
		   left join phonetype
		   on phone.phoneType_no = phonetype.phoneType_no
		   left join podetail pd
		   on phone.poDetail_no = pd.poDetail_no
		   where phoneState_no =1";
		   	if(isset($_POST['shop_list'])){
				$shop_list = $_POST['shop_list'];
				if(check_is_office()){
					$sql3 .=" and phone.retailShop_no in ($shop_list)";					
				} else {
					$sql3 .=" and phone.retailShop_no != 1";
					$sql3 .=" and phone.retailShop_no in ($shop_list) ";
				}
			} else{
				if(check_is_office()){
				} else
					$sql3 .=" and phone.retailShop_no != 1";
			}
			if(isset($_POST['accMobi_list'])){
				$accMobi_list = $_POST['accMobi_list'];
				if($accMobi_list!='mobile')
					$sql3 .=" and phonetype.phoneType_no ='ddd'";
			}
			if(isset($_POST['product_id'])){
				$product_id = $_POST['product_id'];
				$sql3 .=" and phonetype_id = '$product_id'";
			}
		   $sql3.=" group by phone.retailShop_no,phone.poDetail_no,imei";
	$result3 = $db->query($sql3);
		if ($result3) {
			while ($row3 = $db->fetch_array($result3)) {
				$total_price=$total_price+$row3['total_price'];
				$cost = $row3['cost'];
				$cost = number_format($cost,1,'.',',');
				$total_price_row = $row3['total_price'];
				$total_price_row = number_format($total_price_row,1,'.',',');
				echo '<tr>';
				//echo	 '<td>'.$row3['phonetype_id'].'</td>;'
				echo	 '<td style="text-align:left">'.$row3['manufacturer'].' '.$row3['phone_name'].' ('.$row3['color'].') ('.$row3['imei'].')</td>';
				echo	 '<td>手機</td>';		 
				echo	 '<td>'.$row3['total_qty'].'</td>';
				if(check_is_office())
					echo '<td>$'.$cost.'</td>'.
						 '<td>$'.$total_price_row.'</td>';
				//echo	 '<td></td>';
				if($row3['retail_id']!=null)		 
					echo	'<td>'.$row3['retail_id'].'</td>';
				else
					echo	'<td>Transfering</td>';
				echo '</tr>';
			} //end of row3 while
			echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
		}//end of result3 if
	
	$total_price = number_format($total_price,1,'.',',');
	if(check_is_office())
		echo '<tr><td colspan="4" style="text-align:right">Total : </td>'.'<td>$'.$total_price.'</td>';
	echo '</tr><tr style="height:20px"></tr>';
		
	echo '</tbody></table>';
}
function get_in_money(){
	global $db;
	$DATE2=date("Y-m-d");
	$DATE2_s1=explode('-',$DATE2);  //cut the date into array
	
	echo '<table border="0" class="sales_report" style="width:100%" >'.
			'<thead>'.
			 	'<th>日期</th>'.
				'<th>單號</th>'.
				'<th>數量</th>'.
				'<th>折扣</th>'.
				'<th>總金額</th>'.
				'<th>付款方式</th>'.
				'<th>分店</th>'.
				'<th>開單員工</td>'.
				'</thead><tbody>';
				
	$sql1="select *, sum(discount) as sumdis
		  from invoice
		  LEFT JOIN invoicedetail ON invoice.invoice_no=invoicedetail.invoice_no
		  LEFT JOIN retailShop ON invoice.retailShop_no=retailShop.retailShop_no
		  LEFT JOIN ( payment_has_invoice left join payment ON payment.payment_no=payment_has_invoice.payment_no)
				ON invoice.invoice_no=payment_has_invoice.invoice_no      
		  where createDate > '2011-12-21'
		  ";
	if(isset($_POST['datepicker_from']) && isset($_POST['datepicker_to'])){
		$startDay = $_POST['datepicker_from'];
		$endDay = $_POST['datepicker_to'];
		$startDay_s1=explode('-',$startDay);  //cut the date into array
		$endDay_s1=explode('-',$endDay);  //cut the date into array
		
		$sql1 .=" and year(createDate) >= $startDay_s1[0]
		and year(createDate) <= $endDay_s1[0]
		AND month(createDate) >= $startDay_s1[1]
		AND month(createDate) >= $endDay_s1[1]
		AND day(createDate) >= $startDay_s1[2] 
		AND day(createDate) <= $endDay_s1[2]";
		
		
	} else if(isset($_POST['shop_list']) || isset($_POST['payment_list']) || isset($_POST['product_id']) || isset($_POST['inv_type'])){
		$sql1.="";
	} else {
		$sql1 .=" and year(createDate) = $DATE2_s1[0] AND month(createDate) = $DATE2_s1[1] AND day(createDate) = $DATE2_s1[2]";
	}
	if(isset($_POST['inv_type'])){
		$inv_type=$_POST['inv_type'];
		if($inv_type==1 || $inv_type==2 || $inv_type==3)
			$sql1 .=" and invoiceType_no =$inv_type";
		else if($inv_type==4) //Void單
			$sql1 .=" and invoiceState_no =2";
		else if($inv_type==5)
			$sql1 .=" and discount>0.0";
	}
	if(check_is_office()){
		if(isset($_POST['shop_list'])){
			$shop_list = $_POST['shop_list'];
			$sql1 .=" and invoice.retailShop_no in ($shop_list)";
		}
	} else {
		$sql1 .=" and invoice.retailShop_no in (".get_retail_no().")";
	}
	if(isset($_POST['payment_list'])){
		$payment_list = $_POST['payment_list'];
		$sql1 .=" and payment.payment_no in ($payment_list)";					
	}
	$sql1.=" and invoiceState_no not in (2)"; //!=單據無效
	$sql1.=" group by invoice.invoice_no,payment_has_invoice.payment_no";
	$sql1.=" order by retail_id";
	
	//echo $sql1.'<br/>';
	$result = $db->query($sql1);
	
	if ($result) {
		$temmp = $db->getrow($sql1);
		$temmp = $temmp['retail_id'];
		
		$total_selling_price = 0;

			while ($row1 = $db->fetch_array($result)) {				
				if($temmp==$row1['retail_id']){
				}else{
					echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
					echo '<tr><td colspan="4" style="text-align:right">總金額 : </td>'.'<td>
						$'.number_format($total_selling_price,1,'.',',').'</td></tr><tr style="height:20px"></tr>';
					$temmp = $row1['retail_id'];
					$total_selling_price = 0;
					//echo $temmp;
				}
				$invoice_no = $row1['invoice_no'];
				if($row1['invoiceType_no']==1) //發票 Invoice
					$finalinvoice_no = getInvoiceNo($invoice_no);
				else if($row1['invoiceType_no']==2) //退貨單 Return
					$finalinvoice_no = getReturnNo($invoice_no);
				else if($row1['invoiceType_no']==3) //換貨單 Exchange
					$finalinvoice_no = getExchangeNo($invoice_no);
				$DATE1=$row1['createDate'];
				$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
				
				echo '<tr><td>'.$DATE1_s1[0].'</td>';
				echo 	 '<td>'.$finalinvoice_no.'</td>';
				echo 	 '<td>1</td>';
				echo 	 '<td>$'.number_format($row1['sumdis'],1,'.',',').'</td>';
				echo 	 '<td>$'.number_format($row1['money'],1,'.',',').'</td>';
				echo 	 '<td>'.$row1['paymentName'].'</td>';
				echo 	 '<td>'.$row1['retail_id'].'</td>';
				echo 	 '<td>'.$row1['createBy'].'</td>';
				
				echo '</tr>';
				$total_selling_price = $total_selling_price+ $row1['money'];
				
			}
			echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
			echo '<tr><td colspan="4" style="text-align:right">總金額 : </td>'.'<td>
				$'.number_format($total_selling_price,1,'.',',').'</td></tr><tr style="height:20px"></tr>';
	}
}
function get_sales_report_all(){
	global $db;
	$DATE2=date("Y-m-d");
	$DATE2_s1=explode('-',$DATE2);  //cut the date into array
	echo '<table border="0" class="sales_report" id="sales_report_all" style="width:100%" >'.
			 '<thead>'.
			 	//'<th style="width: 110px">產品編號</th>'.
				'<th>產品名稱</th>'.
				'<th style="width: 70px">分類</th>';
		echo 	'<th style="width: 70px">總數量</th>';

	$sql="select retailShop_no,retail_id from retailshop";
	if(check_is_office()){
		if(isset($_POST['shop_list'])){
			$shop_list = $_POST['shop_list'];
			$sql .=" where retailShop_no in ($shop_list)";					
		}
	} else {
		$sql .=" where retailShop_no in (".get_retail_no().")";
	}
	$sql .="  order by retail_id";
	$result = $db->query($sql);
	while ($row = $db->fetch_array($result)) {
		echo '<th style="padding:0 5px 0 5px; border:1;">'.$row['retail_id'].'</th>';
	}
	echo '</thead><tbody>';
			$sql2="select * from accessories
			left join acctype
			on acctype.accType_no = accessories.accType_no";
		if(isset($_POST['accMobi_list'])){
			$accMobi_list = $_POST['accMobi_list'];
			if($accMobi_list =='mobile')
				$sql2 .=" where accessories.accType_no is null";
			else
				$sql2 .=" where accessories.accType_no = $accMobi_list";
		}
		if(isset($_POST['product_id'])){
			$product_id = $_POST['product_id'];
			$sql2 .=" where accessories.acc_id = '$product_id'";
		}
		
	$result2 = $db->query($sql2);

	while ($row2 = $db->fetch_array($result2)) {
		$temp_acc_id=$row2['acc_id'];
		$temp_acc_barcode=$row2['barcode'];
		//echo $temp_acc_id.'<br>';
		//echo $temp_acc_barcode.'<br>';
		echo '<tr>';
		//echo '<td>'.$row2['acc_id'].'</td>';
		echo '<td style="text-align:left; padding:0 10px 0 10px;">'.$row2['accName'].'</td><td>'.$row2['typeName'].'</td>';
			$sql="select retailShop_no,retail_id from retailshop";
			if(check_is_office()){
				if(isset($_POST['shop_list'])){
					$shop_list = $_POST['shop_list'];
					$sql .=" where retailShop_no in ($shop_list)";					
				}
			} else {
				$sql .=" where retailShop_no in (".get_retail_no().")";
			}
			$sql .="  order by retail_id";
		$result = $db->query($sql);
		$temp_qty=0;
		$qtyArray=array();
		while ($row = $db->fetch_array($result)) {
			$temp_shopno=$row['retailShop_no'];

			$sql3="select *, sum(qty) as total_qty
			  from invoice 
			  left join invoicedetail on invoice.invoice_no = invoicedetail.invoice_no
			  where invoiceType_no in (1,2)
			  and invoiceState_no !=2
			  and goodsType = 0
			  and invoice.retailShop_no=$temp_shopno
			  and product_no in ('$temp_acc_id','$temp_acc_barcode')
			  ";
			if(isset($_POST['datepicker_from']) && isset($_POST['datepicker_to'])){
				$startDay = $_POST['datepicker_from'];
				$endDay = $_POST['datepicker_to'];
				$startDay_s1=explode('-',$startDay);  //cut the date into array
				$endDay_s1=explode('-',$endDay);  //cut the date into array
				$sql3 .=" and year(createDate) >= $startDay_s1[0]
						and year(createDate) <= $endDay_s1[0]
						AND month(createDate) >= $startDay_s1[1]
						AND month(createDate) >= $endDay_s1[1]
						AND day(createDate) >= $startDay_s1[2] 
						AND day(createDate) <= $endDay_s1[2]";
			} else if(isset($_POST['shop_list']) || isset($_POST['accMobi_list']) || isset($_POST['product_id']) || isset($_POST['staff_list']) || isset($_POST['inv_type'])){
				$sql3.="";
			} else {
				$sql3 .=" and year(createDate) = $DATE2_s1[0] AND month(createDate) = $DATE2_s1[1] AND day(createDate) = $DATE2_s1[2]";
			}
//			echo $sql3.'<br>';
			$result3 = $db->query($sql3);
			while ($row3 = $db->fetch_array($result3)) {
				if($row3['total_qty']==null)
					$qtyArray[]= '<td>0</td>';
				else
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
		echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
	}
	//end of accessories
	
	$sql2="select * from phonetype";
	if(isset($_POST['accMobi_list'])){
		$accMobi_list = $_POST['accMobi_list'];
		if($accMobi_list!='mobile')
			$sql2 .=" where phonetype.phoneType_no ='ddd'";
	}
	if(isset($_POST['product_id'])){
		$product_id = $_POST['product_id'];
		$sql2 .=" where phonetype_id = '$product_id'";
	}
	$result2 = $db->query($sql2);
	while ($row2 = $db->fetch_array($result2)) {
		$temp_phoneType_no=$row2['phoneType_no'];
		echo '<tr>';
		//echo '<td>'.$row2['phonetype_id'].'</td>';
		echo '<td style="text-align:left; padding:0 10px 0 10px;">'.$row2['manufacturer'].' '.$row2['phone_name'].' ('.$row2['color'].')</td><td>手機</td>';
			$sql="select retailShop_no,retail_id from retailshop";
			if(check_is_office()){
				if(isset($_POST['shop_list'])){
					$shop_list = $_POST['shop_list'];
					$sql .=" where retailShop_no in ($shop_list)";					
				}
			} else {
				$sql .=" where retailShop_no in (".get_retail_no().")";
			}
			$sql .="  order by retail_id";
		$result = $db->query($sql);
		$temp_qty=0;
		$qtyArray=array();
		while ($row = $db->fetch_array($result)) {				
			$temp_shopno=$row['retailShop_no'];
			$sql3="select count(*) as total_qty
		   		FROM phone ph
				where ph.retailShop_no=$temp_shopno
				and ph.phoneType_no=$temp_phoneType_no
				and ph.phoneState_no=2
				group by ph.retailShop_no, ph.phoneType_no;";

			$result3 = $db->query($sql3);
			$result12 = $db->num_rows($db->select($sql3));
				
			if($result12==null)
				$qtyArray[]= '<td>0</td>';
			else
				while ($row3 = $db->fetch_array($result3)) {
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
		echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
	}
	echo '</table>';
}
function get_trans_report(){
	global $db;
	echo '<table  class="trans_report" style="width:100%;" >'.
            '<thead>'.
            	'<th style="width: 90px">開單日期</th>'.
            	'<th>單號</th>'.
            //	'<th style="width: 145px">產品編號</th>'.
            	'<th >產品名稱</th>'.
            	'<th style="width: 70px">數量</th>'.
            	'<th style="width: 70px">出貨分店</th>'.
            	'<th style="width: 70px">收貨分店</th>'.
				'<th>狀況</td>'.
				'<th>開單員工</td>'.
            '</thead>'.
            '<tbody>';
			
		$DATE2=date("Y-m-d");
		$DATE2_s1=explode('-',$DATE2);  //cut the date into array
		
		$sql1="select transfer_no from transfer";
		if(isset($_POST['datepicker_from']) && isset($_POST['datepicker_to'])){
			$startDay = $_POST['datepicker_from'];
			$endDay = $_POST['datepicker_to'];
			$startDay_s1=explode('-',$startDay);  //cut the date into array
			$endDay_s1=explode('-',$endDay);  //cut the date into array
			$sql1 .=" where year(transDate) >= $startDay_s1[0]
						and year(transDate) <= $endDay_s1[0]
						AND month(transDate) >= $startDay_s1[1]
						AND month(transDate) >= $endDay_s1[1]
						AND day(transDate) >= $startDay_s1[2] 
						AND day(transDate) <= $endDay_s1[2]";
		} else if(isset($_POST['shop_list']) || isset($_POST['accMobi_list']) || isset($_POST['product_id']) || isset($_POST['staff_list'])){
			$sql1.="";
		} else {
			$sql1 .=" where year(transDate) = $DATE2_s1[0] AND month(transDate) = $DATE2_s1[1] AND day(transDate) = $DATE2_s1[2]";
		}
		if(isset($_POST['staff_list'])){
			$staff_list=$_POST['staff_list'];
			$sql1 .=" where staff_no in ($staff_list)";
		}
		if(check_is_office()){
			if(isset($_POST['shop_list']) && isset($_POST['shop_list_b'])){
				$shop_list = $_POST['shop_list'];
				$shop_list_b = $_POST['shop_list_b'];
				$sql1 .=" where fromRetail_no in ($shop_list)";
				$sql1 .=" and toRetail_no in ($shop_list_b)";
			}
		} else {
			$sql1 .=" and toRetail_no in (".get_retail_no().")";
			$sql1 .=" or fromRetail_no in (".get_retail_no().")";
		}
		$result = $db->query($sql1);
		if ($result) {
			while ($row1 = $db->fetch_array($result)) {
				$trans_no = $row1['transfer_no'];
				$sql2="select transDate, td.transfer_no, acc_id, td.IMEI, accName,pt.manufacturer as man,phone_name,pt.color,
					   phonetype_id,sum(trans_qty) as trans_qty,rf.retail_id as rfs, rt.retail_id as rts,stateName,staff_id
					   FROM transfer tf
					   LEFT JOIN retailShop AS rf ON tf.fromRetail_no=rf.retailShop_no
					   LEFT JOIN retailShop AS rt ON tf.toRetail_no=rt.retailShop_no
					   LEFT JOIN transstate ON tf.transState_no=transstate.transState_no
					   LEFT JOIN staff
					   ON tf.staff_no=staff.staff_no
					   ,transdetail td
					   LEFT JOIN accessories ON td.acc_no=accessories.acc_no
					   LEFT JOIN  ( phone ph left join phonetype pt ON ph.phoneType_no=pt.phoneType_no) ON td.IMEI = ph.IMEI
					   WHERE tf.transfer_no=td.transfer_no";
					   
					   $sql2.=" and tf.transfer_no=$trans_no";
					   
				 //and transDate > '2011-12-21'  這句要delete
				
				if(isset($_POST['accMobi_list'])){
					$accMobi_list = $_POST['accMobi_list'];
					if($accMobi_list =='mobile')
						$sql2 .=" and td.acc_no is null";
					else
						$sql2 .=" and accessories.accType_no = $accMobi_list";
				}
				if(isset($_POST['product_id'])){
					$product_id = $_POST['product_id'];
					$sql2 .=" and accessories.acc_id = '$product_id' or phonetype_id = '$product_id'";
				}
				
				$sql2.=" GROUP BY td.acc_no, rf.retailShop_no
						ORDER BY tf.transfer_no";
				//echo $sql2;
				
				$result2 = $db->query($sql2);
				$num_rows = $db->num_rows($db->select($sql2));
				$_null=null;
				if ($result2 && $num_rows>0) {
				
					$total_qty=0;
					while ($row2 = $db->fetch_array($result2)) {
						if ($row2['transfer_no']!=null) {
							$_null=$row2['transfer_no'];
							$DATE1=$row2['transDate'];
							$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
							$total_qty=$total_qty+$row2['trans_qty'];
							//$tempTransfer_no=count($transfer_no);
							$tempTransfer_no=$row2['transfer_no'];
							
							$finalTransNo = getTransNo($tempTransfer_no);
								echo '<tr><td>'.$DATE1_s1[0].'</td>'.
										 '<td>'.$finalTransNo.'</td>';
						/*		if($row2['accName']!=null)
									echo	 '<td>'.$row2['acc_id'].'</td>';
								else
									echo	 '<td>'.$row2['phonetype_id'].'</td>';
						*/				 
							if($row2['accName']!=null)
								echo	 '<td style="text-align:left">'.$row2['accName'].'</td>';
							else
								echo	 '<td style="text-align:left">'.$row2['man'].' '.$row2['phone_name'].' ('.$row2['color'].')</td>';
							echo	 '<td>'.$row2['trans_qty'].'</td>'.
									 '<td>'.$row2['rfs'].'</td>'.
									 '<td>'.$row2['rts'].'</td>'.
									 '<td>'.$row2['stateName'].'</td>'.
									 '<td>'.$row2['staff_id'].'</td>'.
								 '</tr>';
							if($row2['accName']==null){
								$sql3="select imei from transdetail
										where transfer_no=$tempTransfer_no";
								$result3 = $db->query($sql3);
								if ($result3) {
									while ($row3 = $db->fetch_array($result3)) {
										echo '<tr><td colspan="2"></td><td style="text-align:left">'.$row3['imei'].'</td>';
									}
								}
							}	
						}
					}
					if($_null!=null){
						echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
						echo '<tr><td colspan="3" style="text-align:right">Total : </td>'.'<td>'.$total_qty.'</td></tr>';
						echo '<tr style="height:20px"></tr>';
					}
				}// end of if result2
			}//end of row1
			echo '</tbody></table>';
		}// end of if result1

//$arr4[]=$row;
			
	//		echo json_encode($arr4); 			
			
	//		for($i=0; $i<$tempTransfer_no; $i++){
	//			echo $transfer_no[$i];
	//		}
	
}
function get_stockin_report(){
	global $db;
	echo '<table border="0" class="sales_report" style="width:100%" >'.
			'<thead>'.
			 	'<th style="width: 90px">入貨日期</th>'.
				'<th>單號</th>'.
	//	echo	'<th style="width: 145px">產品編號</th>'.
				'<th>產品名稱</th>'.
				'<th style="width: 70px">數量</th>';
		if(check_is_office())
			echo'<th style="width: 70px">入貨金額</th>'.
				'<th style="width: 70px">總金額</th>'.
				'<th style="width: 70px">供應商編號</th>';
		echo	'<th style="width: 70px">貨倉位置</th>'.
				'<th>開單員工</td>';
		if(check_is_office())
			echo'<th>PO No.</td>';
		echo '</thead><tbody>';
		
		$DATE2=date("Y-m-d");
		$DATE2_s1=explode('-',$DATE2);  //cut the date into array
		
		$sql1="select sinno_ref_no, staff_id
			  from sinno_ref 
			  LEFT JOIN staff ON sinno_ref.createBy=staff.staff_no";
		if(isset($_POST['datepicker_from']) && isset($_POST['datepicker_to'])){
			$startDay = $_POST['datepicker_from'];
			$endDay = $_POST['datepicker_to'];
			$startDay_s1=explode('-',$startDay);  //cut the date into array
			$endDay_s1=explode('-',$endDay);  //cut the date into array
			$sql1 .=" where year(createDate) >= $startDay_s1[0]
						and year(createDate) <= $endDay_s1[0]
						AND month(createDate) >= $startDay_s1[1]
						AND month(createDate) >= $endDay_s1[1]
						AND day(createDate) >= $startDay_s1[2] 
						AND day(createDate) <= $endDay_s1[2]";
		} else if(isset($_POST['supplier']) || isset($_POST['accMobi_list']) || isset($_POST['product_id']) || isset($_POST['staff_list'])){
			$sql1 .="";
		} else {
			$sql1 .="  where  year(createDate) = $DATE2_s1[0] AND month(createDate) = $DATE2_s1[1] AND day(createDate) = $DATE2_s1[2]";
		}
		if(isset($_POST['staff_list'])){
			$staff_list=$_POST['staff_list'];
			$sql1 .=" where staff_no in ($staff_list)";
		}
		$result = $db->query($sql1);
		if ($result) {
			while ($row1 = $db->fetch_array($result)) {
				$sinno_ref_no = $row1['sinno_ref_no'];
				$finalsinno_ref_no = getStockIn($sinno_ref_no);
						
				$sql2="select * 
						from stockin st
						LEFT JOIN accessories ON st.acc_no=accessories.acc_no
						LEFT JOIN retailShop AS rt ON st.retailShop_no=rt.retailShop_no
						LEFT JOIN staff ON st.staff_no=staff.staff_no
						LEFT JOIN  ( po left join podetail as pod ON po.po_no=pod.po_no
										left join supplier as sp ON po.supplier_no=sp.supplier_no)
										ON st.poDetail_no = pod.poDetail_no
						where sinno_ref_no=$sinno_ref_no";
				if(check_is_office()){
				} else
					$sql2 .=" and st.retailShop_no in (".get_retail_no().")";
				if(isset($_POST['supplier'])){
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
				}
				//echo $sql2;
				$result2 = $db->query($sql2);
				$num_rows = $db->num_rows($db->select($sql2));
				$total_qty=0;
				$all_totaliprice=0;
				if ($result2 && $num_rows>0) {
					while ($row2 = $db->fetch_array($result2)) {
						$rec_qty = $row2['rec_qty'];
						$iprice = $row2['iprice'];
						$totaliprice=($rec_qty*$iprice);
						$all_totaliprice=$all_totaliprice+$iprice;
						
						$tempPoNo = $row2['po_no'];
						$finalPoNo = getPoNo($tempPoNo);
						
						$DATE1=$row2['rec_date'];
						$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
						$total_qty=$total_qty+$row2['rec_qty'];
					
						echo '<tr><td>'.$DATE1_s1[0].'</td>';
						echo 	 '<td>'.$finalsinno_ref_no.'</td>';
					//	echo 	 '<td>'.$row2['acc_id'].'</td>';
						echo 	 '<td style="padding:0 8px 0 8px; text-align:left;">'.$row2['accName'].'</td>';
						echo 	 '<td>'.$row2['rec_qty'].'</td>';
						if(check_is_office())
							echo '<td>$'.number_format($iprice,1,'.',',').'</td>'.
								 '<td>$'.number_format($totaliprice,1,'.',',').'</td>'.
								 '<td>'.$row2['supplier_id'].'</td>';
						echo 	 '<td>'.$row2['retail_id'].'</td>';
						echo 	 '<td>'.$row2['staff_id'].'</td>';
						if(check_is_office())
							echo '<td>'.$finalPoNo.'</td>';
						echo	'</tr>';
					}
					echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
					echo '<tr><td colspan="3" style="text-align:right">Total : </td>'.'<td>'.$total_qty.'</td>';
					echo '<td></td>';
					if(check_is_office())
						echo '<td>$'.number_format($all_totaliprice,1,'.',',').'</td>';
					echo '</tr><tr style="height:20px"></tr>';
				}
				
				$sql2="select *
						from phone ph
						LEFT JOIN phonetype AS pt ON ph.phoneType_no=pt.phoneType_no
						LEFT JOIN retailShop AS rt ON ph.retailShop_no=rt.retailShop_no
						
						LEFT JOIN  ( po left join podetail as pod ON po.po_no=pod.po_no
										left join supplier as sp ON po.supplier_no=sp.supplier_no)
										ON ph.poDetail_no = pod.poDetail_no
						where sinno_ref_no=$sinno_ref_no";
				if(check_is_office()){
				} else
					$sql2 .=" and ph.retailShop_no in (".get_retail_no().")";
				if(isset($_POST['supplier'])){
					$supplier = $_POST['supplier'];
					$sql2 .=" and po.supplier_no in ($supplier)";
				}
				if(isset($_POST['accMobi_list'])){
					$accMobi_list = $_POST['accMobi_list'];
					if($accMobi_list!='mobile')
						$sql2 .=" and ph.phoneType_no = 'ddd'";
				}
				if(isset($_POST['product_id'])){
					$product_id = $_POST['product_id'];
					$sql2 .=" and phonetype_id = '$product_id'";
				}
				$result2 = $db->query($sql2);
				//$qty=$row2['total_qty'];
				$num_rows = $db->num_rows($db->select($sql2));
				$all_totaliprice=0;
				if ($result2 && $num_rows>0) {
					while ($row2 = $db->fetch_array($result2)) {
						//$rec_qty = $row2['total_qty'];
						$iprice = $row2['cost'];
						$totaliprice=(1*$iprice);
						$all_totaliprice = $all_totaliprice+$iprice;
						$tempPoNo = $row2['po_no'];
						$finalPoNo = getPoNo($tempPoNo);
						
						$DATE1=$row2['rec_date'];
						$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
						//$total_qty=$total_qty+$row2['rec_qty'];
						
						$sinno_ref_no = $row1['sinno_ref_no'];
						$finalsinno_ref_no = getStockIn($sinno_ref_no);
					
						echo '<tr><td>'.$DATE1_s1[0].'</td>';
						echo 	 '<td>'.$finalsinno_ref_no.'</td>';
					//	echo 	 '<td>'.$row2['phonetype_id'].'</td>';
						echo 	 '<td style="padding:0 8px 0 8px;text-align:left;">'.$row2['manufacturer'].' '.$row2['phone_name'].' ('.$row2['color'].') ('.$row2['IMEI'].')</td>';
						echo 	 '<td>1</td>';
						if(check_is_office())
							echo '<td>$'.number_format($iprice,1,'.',',').'</td>'.
								 '<td>$'.number_format($totaliprice,1,'.',',').'</td>'.
								 '<td>'.$row2['supplier_id'].'</td>';
						if($row2['retail_id']=='Transferring')
							echo '<td><div style="background:#B50122;color:#fff;">Transferring</div></td>';
						else
							echo '<td>'.$row2['retail_id'].'</td>';
						echo 	 '<td>'.$row1['staff_id'].'</td>';
						if(check_is_office())
							echo '<td>'.$finalPoNo.'</td>';
						echo	'</tr>';
					}
					echo '<tr style="border-bottom:#0000FF 1px solid;"></tr>';
					echo '<tr><td colspan="3" style="text-align:right">Total : </td>'.'<td>'.$num_rows.'</td>';
					echo '<td></td>';
					if(check_is_office())
						echo '<td>$'.number_format($all_totaliprice,1,'.',',').'</td>';
					echo '</tr><tr style="height:20px"></tr>';
				}
			}
		}
		echo '</tbody></table>';
}





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

function check_is_office(){
	$isOK=false;
	$_SESSION['retail_no']==1 ? $isOK=true : $isOK=false;
	return $isOK;
}
function get_retail_no(){
	return $_SESSION['retail_no'];
}
function get_retail_id($shopno){
	global $db;
	$temp_shopno = $shopno;
	$sql="select retail_id from retailshop where retailshop_no = '$temp_shopno'";
	$retail_id= $db->getOne($sql);
	
	return $retail_id;	
}
function getPoNo($po_no){
	$tempPoNo=$po_no;
	$tempPoNo_length=strlen($tempPoNo);
	$i=7;
	$zeroNeedToAdd=$i-$tempPoNo_length;
	$tempZero='';
	while($zeroNeedToAdd!=0){
		$tempZero .='0';
		$zeroNeedToAdd--;
	}
	return $finalPoNo='PO-'.$tempZero.$tempPoNo;
}
function getTransNo($trans_no){
	$tempTransNo=$trans_no;
	$tempTransNo_length=strlen($tempTransNo);
	$i=7;
	$zeroNeedToAdd=$i-$tempTransNo_length;
	$tempZero='';
	while($zeroNeedToAdd!=0){
		$tempZero .='0';
		$zeroNeedToAdd--;
	}
	return $finalTransNo = 'TR-'.$tempZero.$tempTransNo;
}
function getStockIn($stockin_no){
	$tempStockIn=$stockin_no;
	$tempStockIn_length=strlen($tempStockIn);
	$i=7;
	$zeroNeedToAdd=$i-$tempStockIn_length;
	$tempZero='';
	while($zeroNeedToAdd!=0){
		$tempZero .='0';
		$zeroNeedToAdd--;
	}
	return $finalStockInNo = 'SI-'.$tempZero.$tempStockIn;
}
function getInvoiceNo($invoice_no){
	$tempInvoiceNo=$invoice_no;
	$tempInvoiceNo_length=strlen($tempInvoiceNo);
	$i=7;
	$zeroNeedToAdd=$i-$tempInvoiceNo_length;
	$tempZero='';
	while($zeroNeedToAdd!=0){
		$tempZero .='0';
		$zeroNeedToAdd--;
	}
	return $finalStockInNo = 'SA-'.$tempZero.$tempInvoiceNo;
}
function getReturnNo($return_no){
	$tempInvoiceNo=$return_no;
	$tempInvoiceNo_length=strlen($tempInvoiceNo);
	$i=7;
	$zeroNeedToAdd=$i-$tempInvoiceNo_length;
	$tempZero='';
	while($zeroNeedToAdd!=0){
		$tempZero .='0';
		$zeroNeedToAdd--;
	}
	return $finalStockInNo = 'SR-'.$tempZero.$tempInvoiceNo;
}
function getExchangeNo($exchange_no){
	$tempExchangeNo=$exchange_no;
	$tempExchangeNo_length=strlen($tempExchangeNo);
	$i=7;
	$zeroNeedToAdd=$i-$tempExchangeNo_length;
	$tempZero='';
	while($zeroNeedToAdd!=0){
		$tempZero .='0';
		$zeroNeedToAdd--; 
	}
	return $finalExchangeNo = 'SR-'.$tempZero.$tempExchangeNo;
}
function doaddtransmobile($shopno, $okphonedata){
    global $db;
    $result = array();
    if($okphonedata == null){
        return false;
    }
    foreach ($okphonedata as $okphone){
        $sql="UPDATE phone SET retailShop_no='9999' WHERE IMEI = '$okphone->IMEI';";
        $result[] = $db->query($sql);
    }
    unset($okphonedata);
    return $result;
    
}


function add_mobiletotransfer($from_shopinfo, $okphonedata){
    global $db;
    $DATE2 = date("Y-m-d");
    
    $create_date = date("Y-m-d H:i:s");
    $fromRetail_no = $from_shopinfo->fromretail;
    $toRetail_no = $from_shopinfo->toretail;
    $staff_no = $from_shopinfo->staffno;
    $sql = "INSERT INTO transfer (`transDate`, `fromRetail_no`, `toRetail_no`, `staff_no`, `transState_no`, `tranReson`) 
            VALUES ('$create_date', '$fromRetail_no', '$toRetail_no', $staff_no, 1, '普通轉貨')";
    $db->query($sql);
    $last_insert_id = $db->insert_id();
    foreach($okphonedata as $key => $phonedata) {
        $imei = $phonedata->IMEI;
        $poDetail_no = $phonedata->poDetail_no;
        $po_date = getMobilePoDate($poDetail_no);
        
        $v_sql[] = "(1,'$imei','$last_insert_id','$po_date')"; 
    } 
                    
    $sql = "INSERT INTO transdetail (`trans_qty`, `IMEI`, `transfer_no`,`po_date`) 
            VALUES".implode(',',$v_sql); 
    $db->query($sql);
    /*
    print_r('<br>');
    print_r($last_insert_id);
    print_r('<br>');
     * 
     */
    return $last_insert_id;
}

function get_mobiledetail($imei) {
    global $db;
    $sql = "SELECT * FROM phone where IMEI = '$imei' ";
    $row = $db->getrow($sql);
    return $row;
}
function getMobilePoDate($podetail_no) {
    global $db;
    $sql = "SELECT createDate FROM podetail
				left join po on podetail.po_no = po.po_no where podetail_no = '$podetail_no' ";
    $po_date = $db->getOne($sql);
    return $po_date;
}