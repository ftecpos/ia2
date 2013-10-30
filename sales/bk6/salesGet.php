<?php require ("../conn/db_include.php")?>
<?php include("../check_login.php");?>
<?php
//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	
?>
<?php
global $db;

$test=array();
$test[0]="1111";
$num=0;
switch($_GET['action']){
		
	
	case 'reset':
		$sql="ALTER TABLE invoice AUTO_INCREMENT = 1";
		$db->query($sql);
		
		$sql="ALTER TABLE invoicedetail AUTO_INCREMENT = 1";
		$db->query($sql);
		echo "success reset";
		break;
	case 'insert_id':
		echo $db->insert_id();

		break;
		
	case 'query':
		echo $db->query("select LAST_INSERT_ID()");
		break;
		
	case 'insert':
		 $db->query("INSERT INTO postate (`stateName`) VALUES ('2')");
		echo $db->insert_id();
		break;
		
	case 'reverseStockIn':
		$stockInNo=$_GET['stockInNo'];
		$qty = $_GET['qty'];
		$db->query("START TRANSACTION;");
		$db->query("SELECT ava_bal FROM stockin WHERE stockIn_no = '$stockInNo' FOR UPDATE;");
		$db->query("UPDATE stockin SET `ava_bal`=`ava_bal`+$qty WHERE `stockIn_no`='$stockInNo';");
		$db->query("COMMIT;");
		break;	
		
	case 'getMobileList':
	/*	$sql = "SELECT *, count(ph.phoneType_no) as qty
				from phonetype pt, productstate pd, phone ph, retailShop rs
				where pt.phoneType_no = ph.phoneType_no
				and pt.productState_no = pd.productState_no
				and ph.retailShop_no = rs.retailShop_no";
	*/
		/*
		$sql = "SELECT *, (COUNT(*)-out_qty) as qty 
				FROM phone ph, (SELECT phoneType_no, COUNT(*) as out_qty
								FROM phone pa 
								WHERE phoneState_no=2
								AND pa.phoneType_no 
								GROUP BY pa.retailShop_no,pa.phoneType_no,pa.phoneState_no) a, 
					 retailShop rs, productstate pd, phonetype pt 
				WHERE a.phoneType_no = ph.phoneType_no 
				AND pt.phoneType_no = ph.phoneType_no 
				AND pt.productState_no = pd.productState_no
				AND ph.retailShop_no = rs.retailShop_no ";
				*/
		$sql = "SELECT *, (COUNT(*)) as qty 
				FROM phone ph, 
				retailShop rs, productstate pd, phonetype pt 
				WHERE ph.phoneState_no=1
				AND pt.phoneType_no = ph.phoneType_no
				AND pt.productState_no = pd.productState_no
				AND ph.retailShop_no = rs.retailShop_no";
		
		if (isset($_GET['shopno'])){
			$shopno = $_GET['shopno'];
			$sql .=" and ph.retailShop_no=$shopno";
		}
		$pageNo = $_GET['pageNo'];
				
		if(isset($_GET['countTotal'])){
			/*$sql = "SELECT *, (COUNT(*)) as qty 
				FROM phone ph, (SELECT phoneType_no, COUNT(*) as out_qty
								FROM phone pa 
								WHERE phoneState_no=2
								AND pa.phoneType_no 
								GROUP BY pa.retailShop_no,pa.phoneType_no,pa.phoneState_no) a, 
					 retailShop rs, productstate pd, phonetype pt 
				WHERE a.phoneType_no = ph.phoneType_no 
				AND pt.phoneType_no = ph.phoneType_no 
				AND pt.productState_no = pd.productState_no
				AND ph.retailShop_no = rs.retailShop_no ";
				*/
			$sql = "SELECT *, (COUNT(*)) as qty 
				FROM phone ph, 
				retailShop rs, productstate pd, phonetype pt 
				WHERE ph.phoneState_no=1
				AND pt.phoneType_no = ph.phoneType_no
				AND pt.productState_no = pd.productState_no
				AND ph.retailShop_no = rs.retailShop_no";
		}
		if (isset($_GET['shortByA'])&& isset($_GET['shortByB'])){
			$shortByA = $_GET['shortByA'];
			$shortByB = $_GET['shortByB'];
			$sql .=" AND $shortByA = '$shortByB'";
			$sql .= " group by rs.retailShop_no,ph.phoneType_no ORDER BY rs.retailShop_no";
		} else
		if (isset($_GET['orderBy'])&& isset($_GET['ascDesc'])){
			$orderBy = $_GET['orderBy'];
			$ascDesc = $_GET['ascDesc'];
			$sql .= " group by retail_id,ph.phoneType_no";
			$sql .=" ORDER BY $orderBy $ascDesc, rs.retailShop_no asc";			
		} else
		if (isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
			$sql .=" AND pt.phone_name like '%$keyword%'";
			$sql .= " group by rs.retailShop_no,ph.phoneType_no ORDER BY rs.retailShop_no";					
		} else
		$sql .= " group by rs.retailShop_no,ph.phoneType_no ORDER BY rs.retailShop_no";
//echo $sql;
		$result = $db->selectLimit($sql, '14',$pageNo);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<table rules="all" border="1" class="finMobile" style="width:100%;" >'.
            '<thead>'.
				'<th style="width: 110px">種類 no</th>'.
            	'<th style="width: 110px">電話種類 id</th>'.
            	'<th>電話製造商</th>'.
            	'<th style="width: 145px">電話名稱</th>'.
            	'<th>電話顔色</th>'.
				'<th>oprice</th>'.
            	'<th>sprice</th>'.
				'<th>電話種類狀態</th>'.
				'<th>存貨</th>'.
				'<th>店舖</th>'.
            '</thead>'.
            '<tbody>';
		if ($result) {
			while ($row = $db->fetch_array($result)) {
				echo '<tr><td><a href="#" style="color:#0019FF;"
				onclick="openImeiList('.$row['phoneType_no'].','.$row['retailShop_no'].')">'.$row['phoneType_no'].' 開啟IMEI List</a></td>'.
								'<td>'.$row['phonetype_id'].'</td>'.
            				    '<td>'.$row['manufacturer'].'</td>'.
            				    '<td>'.$row['phone_name'].'</td>'.
            				    '<td>'.$row['color'].'</td>'.
            				    '<td>'.$row['oprice'].'</td>'.
								'<td>'.$row['sprice'].'</td>'.
								'<td>'.$row['stateName'].'</td>';
								if($row['phoneState_no']==2)
									if(($row['qty'])==0)
										echo '<td style="background-color:red;color:yellow">'.($row['qty']).'</td>';
									else
										echo '<td>'.($row['qty']).'</td>';
								else
									echo '<td>'.$row['qty'].'</td>';
				echo			'<td>'.$row['retail_id'].'</td>'.
            				 '</tr>';
			}// End of while fetch_array($result)
		}// End of if $result
		echo '</tbody></table>';		
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";

		break;
	case 'getIMEIList':
		$phoneTypeNo = $_GET['phoneTypeNo'];
		$shopNo = $_GET['shopNo'];
		$sql = "select phone_no, IMEI, rec_date,phoneStateName,ph.phoneState_no, ph.retailShop_no
				from phone ph, phonestate ps
				where ph.phoneState_no = ps.phoneState_no
				and ph.phoneState_no=1 
				and ph.phoneType_no = $phoneTypeNo
				and ph.retailShop_no = $shopNo"; // ph.phoneState_no=1  -> 電話狀態=發售
		$result = $db->query($sql);
		echo '<table id="" class="" border="1" >
            	<tr><td style="width:170px">IMEI</td><td style="width:185px">Receive Date</td><td>電話狀態</td></tr>';
		while ($row = $db->fetch_array($result)) {
			echo '<tr><td>';
			if($row['phoneState_no']==1)
				echo	'<a href="#" style="color:#0019FF;font-size:15px;" onclick="addMobileToInvoice('.$row['phone_no'].','.$row['retailShop_no'].')">'.$row['IMEI'].'</a>';
			else
			if($row['phoneState_no']==2)
				echo	$row['IMEI'];
			else
				$row['IMEI'];
			echo'</td>'.
				 '<td>'.$row['rec_date'].'</td><td style="text-align:center">'.$row['phoneStateName'].'</tr>';
		}
		break;
	
	case 'getInvoiceTypeMenu': //short by mobile type
		$sql = "SELECT * FROM `3shop`.`invoicetype`;";	
		$result = $db->query($sql);
			echo '<lable style="font-size:20px;">Order By</lable>';
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['typeName'].'" class="findInvoiceType" onclick="getInvoiceList(\'inv.invoiceType_no\','.$row['invoiceType_no'].');setRmClass2();"/>';
		}
		echo '<input type="button" value="單據State" class="findInvoiceType fit1" onclick="getInvoiceStateMenu()"/>';
		break;
	case 'getInvoiceStateMenu':
		$sql = "select * from invoicestate;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['invoiceStateName'].'" class="findAccBut" onclick="getInvoiceList(\'invS.invoiceState_no\','.$row['invoiceState_no'].')"/>';
		}
		break;
	case 'getMobileTypeMenu': //short by mobile type
		$sql = "select * from phonetype group by manufacturer;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['manufacturer'].'" class="finMobileBut" onclick="getMobileList(\'pt.phoneType_no\','.$row['phoneType_no'].')"/>';
		}		
		break;
	case 'getAccTypeMenu': //short by acc type
		$sql = "select * from acctype;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['typeName'].'" class="findAccBut" onclick="getAccList(\'acc.accType_no\','.$row['accType_no'].')"/>';
		}		
		break;
	
	case 'getMobileStateMenu':
		$sql = "select * from productstate;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['stateName'].'" class="finMobileBut" onclick="getMobileList(\'pd.productState_no\','.$row['productState_no'].')"/>';
		}
		break;	
	case 'getAccStateMenu':
		$sql = "select * from `3shop`.`productstate`;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['stateName'].'" class="findAccBut" onclick="getAccList(\'acc.productState_no\','.$row['productState_no'].')"/>';
		}
		break;
		
	case 'voidInvoice':
		$invNo = $_GET['invNo'];
		$reason = $_GET['reason'];
		$sql = "select * from invoicedetail id,invoice iv
				where iv.invoice_no=id.invoice_no
				and id.invoice_no= '$invNo'";
		
		$result = $db->query($sql);
		
		$row2 = $db->getrow($sql);
		if($row2['retailShop_no']!=$_SESSION['retail_no']){
			die(error_msg5());
		}
		$sql2="START TRANSACTION;";
		$db->query($sql2);
		$sql2="SELECT invoiceState_no FROM invoice WHERE invoice_no = $invNo FOR UPDATE;";
		$db->query($sql2);
		$sql2 = "UPDATE invoice SET invoiceState_no=2,void_return_desc='$reason' WHERE invoice_no='$invNo';";
		$db->query($sql2);
		$sql2 = "UPDATE invoicedetail SET commission_1=null,commission_2=null WHERE invoice_no='$invNo'";
		$db->query($sql2);
		$sql2="COMMIT;";
		$db->query($sql2);

		while ($row = $db->fetch_array($result)) {
			$goodsType = $row['goodsType'];
			$retailShop_no = $row['retailShop_no'];
			$qty = $row['qty'];
			$product_no = $row['product_no'];

				echo "Qty=".$qty." ";
				
			if($goodsType==0){ //如果是accessories時做的動作
				
				$sql2 ="select stockIn_no, ava_bal,rec_qty from stockin where retailShop_no= $retailShop_no
				  and acc_no = (select acc_no from accessories where barcode = '$product_no' or acc_id = '$product_no')
				  and rec_qty <> ava_bal
				  order by po_date desc, rec_date desc";
				$result2 = $db->query($sql2);
					

				while ($row2 = $db->fetch_array($result2)) {
					
					$tempStockInNo = $row2['stockIn_no'];
					$tempQty = $row2['ava_bal'];
					$maxQty=$row2['rec_qty'];
					echo "tempQty=".$tempQty." ";
					echo "maxQty=".$maxQty." ";
					echo $tempQty+$qty." ";
					
					if(($tempQty+$qty)<=$maxQty){
						$sql = "UPDATE stockin SET ava_bal=ava_bal+$qty WHERE stockIn_no='$tempStockInNo'";
						$db->query($sql);
						echo $sql;
						echo " A ";
//						echo $tempQty;
//						$qty = $qty-$maxQty;
						break;
					} else
					if(($tempQty+$qty)>$row2['rec_qty']){
						if($tempQty!=$maxQty){
							$canmins=$maxQty-$tempQty;
							$sql = "UPDATE stockin SET ava_bal=ava_bal+$canmins WHERE stockIn_no='$tempStockInNo'";
							$db->query($sql);
							$qty = $qty-$canmins;
						} else{
							$sql = "UPDATE stockin SET ava_bal=ava_bal+$maxQty WHERE stockIn_no='$tempStockInNo'";
							$db->query($sql);
							$qty = $qty-$maxQty;
						}						
					}
					if($qty==0)
						break;
				}//end of while
			}
			else
			if($goodsType==1){ //如果是電話時做的動作
				$sql="UPDATE phone SET `phoneState_no`=1 WHERE `IMEI`='$product_no';";
				$db->query($sql);
			}
		}
		break;

	case 'getInvoiceDetails':
//$Staff_name =(isset($_GET['staff_name']))? $_GET['staff_name'] :$_POST['staff_name'] ;
		$invNo = $_GET['invNo'];

		$sql = "select * 
				from invoice inv, retailshop rs ,invoicetype invT, invoicedetail invD, invoicestate invS
				where rs.retailShop_no = inv.retailShop_no 
				and invT.invoiceType_no = inv.invoiceType_no
				and invD.invoice_no = inv.invoice_no
				and invS.invoiceState_no = inv.invoiceState_no
				and inv.invoice_no = '$invNo'";
				
		$result = $db->query($sql);
		$numOfRow = $db->num_rows($db->query($sql));
//		if ($result) {
		if ($numOfRow > 0) {
		
			$row2 = $db->getrow($sql);
			
			$DATE1=$row2['createDate'];
			$DATE1_s1=explode(' ',$DATE1); //cut out the date (without time) into array
			$DATE1_s2=explode('-',$DATE1_s1[0]);  //the date in $DATE1_s1[0]
			$DATE1_time=mktime(0,0,0,$DATE1_s2[1],$DATE1_s2[2],$DATE1_s2[0]); //換做秒
			
			$DATE2=date("Y-m-d");           //must set timezone on the top			
			$DATE2_s1=explode('-',$DATE2);  //cut the date into array
			$DATE2_time=mktime(0,0,0,$DATE2_s1[1],$DATE2_s1[2],$DATE2_s1[0]); //換做秒
			
			//一天是86400秒,10天就是864000秒;
			$RESULT=$DATE2_time-$DATE1_time;
			
			echo  '<script>'.
				  '$(\'#findInvoiceFirMenu\').append(\'<input type="button" value="列印單據" class="finIncel" onclick="printInvoice('.$row2['invoice_no'].');"  />  '.
				  '\')'.
				  '</script>';

			if($row2['invoiceState_no']==1){
			  if($RESULT==0)
				echo  '<script>'.
					  '$(\'#findInvoiceFirMenu\').append(\'<input type="button" value="取消單據" class="finIncel" onclick="voidInvoice('.$row2['invoice_no'].');" />  '.
					  '\')'.
					  '</script>';			
			}
			if($row2['invoiceType_no']==1)
				$numHead='SA-';
			else if($row2['invoiceType_no']==2)
				$numHead='SR-';
						
			$tempInvNo=$row2['invoice_no'];
			$invNoLength=strlen($tempInvNo);
			$i=7;
			$zeroNeedToAdd=$i-$invNoLength;
			$tempZero='';
			while($zeroNeedToAdd!=0){
				$tempZero.='0';
				$zeroNeedToAdd--;
			}
			$finalInvNo=$numHead.$tempZero.$tempInvNo;
			
			echo  '<script>'.
					  "$('#invNo').val('$finalInvNo').select();".
				  '</script>';
			
			echo  '<table  class="gidLeft" style="" >'.
				  '<tr><td style="width: 80px;">單據種類</td><td>:</td><td style="border:red 1px dashed;">'.$row2['typeName'].'</td></tr>'.
				  '<tr><td style="width: 80px">分店</td><td>:</td><td  id="rfRI">'.$row2['retail_id'].'</td></tr>'.
				  '<tr><td style="width: 80px">開單員工</td><td>:</td><td>'.$row2['createBy'].'</td></tr>'.
				  '<tr><td style="width: 80px">單據狀態</td><td>:</td><td style="color:green;">'.$row2['invoiceStateName'].'</td></tr>'.
				  '</table>';
			echo  '<table rules="" border="0" class="gidRight" style="" >'.
				  '<tr><td>日期</td><td>:</td><td>'.$row2['createDate'].'</td></tr>'.
				  '<tr><td style="width: 80px">收據編號</td><td>:</td><td id="rfInvNo">'.$finalInvNo.'</td></tr>';
			if ($row2['invoiceType_no']==2){
				$tempInvNo=$row2['remark'];
				$invNoLength=strlen($tempInvNo);
				$i=7;
				$zeroNeedToAdd=$i-$invNoLength;
				$tempZero='';
				while($zeroNeedToAdd!=0){
					$tempZero.='0';
					$zeroNeedToAdd--;
				}
				$numHead='SA-';
				$finalInvNo=$numHead.$tempZero.$tempInvNo;				  
				echo  '<tr><td>正單編號</td><td>:</td><td id=""><a href="#"style="color:#FF87B5;font-size:20px" onclick="getInvoiceDetails('.$row2['remark'].')">'.$finalInvNo.'</a></td></tr>';
				echo  '<tr><td>退貨原因</td><td>:</td><td id=""><span style="color:#D85D73;font-size:17px">'.$row2['void_return_desc'].'</span></td></tr>';
			}
			if ($row2['invoiceState_no']==2){
				echo  '<tr><td>無效原因</td><td>:</td><td id=""><span style="color:#FF87B5;font-size:17px">'.$row2['void_return_desc'].'</span></td></tr>';
			}
			echo  '</table>';
			echo  '<table rules="all" border="1" class="gidLeft" style="" >'.
				  '<tr>'.
				  '<td style="id="idn">IDN</td>'.
				  '<td style="width: 145px">條碼 / IMEI</td>'.
				  '<td style="width: 245px">貨品名稱</td>'.
				  '<td style="width: 50px">售價</td>';
			if($row2['invoiceState_no']==4)
				echo  '<td style="width: 115px">數量(退貨數量)</td>';
			else
			  	echo  '<td style="width: 115px">數量</td>';
				echo  '<td style="width: 50px">折扣</td>'.
					  '<td style="width: 95px">小計</td>';
				//echo  '<td style="width: 95px">種類</td>';
				echo  '</tr>';
				// $total = 0;		
			
			//7天就是604800
			$RESULT2=$DATE2_time-$DATE1_time;
			
			 while ($row = $db->fetch_array($result)) {
				$retuenQty=array();
				 $smallTotal = ($row['price']-$row['discount'])*$row['qty']; //小計
				echo  	 '<tr><td>';
				if(($row2['invoiceState_no']==1||$row2['invoiceState_no']==4) && $row['pastIDV']==""){
					if($RESULT2<=604800)
						echo '<input type="button" value="退貨" class="finIncel" onclick="$(\'.finIncel\').hide(); salesReturn('.$row['invoiceDetail_no'].','.$row['qty'].');" />';
					else
						echo '已過退貨期限';
					
				} else if ( $row2['invoiceType_no']==1 && $row2['invoiceState_no']!=2){
					$returnNo = $row['invoiceDetail_no'];
					$sql3="select qty, invoice_no 
							from invoicedetail invD
							where pastIDV='$returnNo' ";
					$result3 = $db->query($sql3);
					
					$retuenQty=array();
					$qqty=0;
					while($row3 = $db->fetch_array($result3)){
						$retuenQty[]=$row3['qty'];
						$qqty=$qqty+$row3['qty'];
						echo  '<input type="button" value="退貨數量: '.$row3['qty'].'" class="finIncele" onclick="getInvoiceDetails('.$row3['invoice_no'].')"/>';
					}
					if($row['qty']<=$qqty)
						if($RESULT2<=604800)
							echo '<input type="button" value="退貨" class="finIncel" onclick="$(\'.finIncel\').hide(); salesReturn('.$row['invoiceDetail_no'].','.($row['qty']-$qqty).');" />';
						else
							echo '已過退貨期限';
				}else
				  	echo $row['pastIDV'];
				echo 	'</td>';
				echo	 '<td>'.$row['product_no'].'</td>'.
						 '<td>'.$row['description'].'</td>'.
						 '<td>$'.number_format($row['price'],1,'.',',').'</td>';
				
				if ( $row2['invoiceType_no']==1 && $row2['invoiceState_no']!=2 && $row2['invoiceState_no']==4){
					$qqty=0;
					$tempQty=count($retuenQty);
					for($i=0; $i<$tempQty; $i++){
						$qqty= $qqty+$retuenQty[$i];
					}
					echo '<td>'.$row['qty'].'('.$qqty.')'.'</td>';
				} else
					echo '<td>'.$row['qty'].'</td>';
				echo	 '<td>$'.number_format($row['discount'],1,'.',',').'</td>'.
						 '<td class="dig">$'.number_format($smallTotal,1,'.',',').'</td>'; //小計
				//echo	 '<td>'.$row['goodsType'].'</td>
				echo	 '</tr>';
				//$total += $smallTotal;
			 }
			 	echo	 '<tr><td colspan="5"></td>'.
						 '<td >總數</td>'.						 
				//		 '<td>'.$total.'</td></tr>';
						 '<td class="dig" style="text-decoration: underline;">$'.number_format($row2['total'],1,'.',',').'</td></tr>';
						 
				echo  '</table>';
				
			//	echo count($retuenQty).'     99999';
			

		} else echo '<p style="color:red; font-size:20px;">Record not find</p>';
		break;
case 'getAccListB':
	$sql = "SELECT si.acc_no,acc_id,manufacturer,accName,typeName,color,
				oprice,sprice,stateName,retail_id,sum(ava_bal) as ava_bal
				FROM stockin si, accessories acc, retailShop rs, acctype act ,productstate pd
				WHERE si.acc_no = acc.acc_no
				AND si.retailShop_no = rs.retailShop_no
				AND acc.productState_no = pd.productState_no
				AND acc.accType_no = act.accType_no";
	if (isset($_POST['FindAccKey'])&& isset($_POST['limitShopno'])){
		$keyword = $_POST['FindAccKey'];
		$shopno = $_POST['limitShopno'] ;
		$sql .= " and acc.accName like '%$keyword%'
				and rs.retailShop_no =$shopno";
			//echo $sql;
	} else
	if (isset($_POST['FindAccKey'])){
		$keyword = $_POST['FindAccKey'];
        $sql .=" and acc.accName like '%$keyword%'";
	}
	
	$sql .=" group by si.retailShop_no,si.acc_no";
$pageNo = $_POST['pageNo'];
$result = $db->selectLimit($sql, '14',$pageNo);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<table rules="all" border="1" class="finAcc" style="width:100%;" >'.
            '<thead>'.
				'<th style="width: 110px">配件 no</th>'.
            	'<th style="width: 110px">配件 id</th>'.
            	'<th>配件製造商</th>'.
            	'<th style="width: 145px">配件名稱</th>'.
            	'<th style="width: 100px">配件種類</th>'.
            	'<th style="width: 100px">配件顔色</th>'.
				'<th>oprice</th>'.
            	'<th>sprice</th>'.
            	'<th>配件狀態</th>'.
				'<th>店舖</th>'.
				'<th>QTY</th>'.
            '</thead>'.
            '<tbody>';
		if ($result) {
                while ($row = $db->fetch_array($result)) {
					echo '<tr><td><a href="#" style="color:#0019FF;"
					 onclick="addAccToInvoice('.$row['acc_no'].')">'.$row['acc_no'].' 加到Invoice</a></td>'.
            				     '<td>'.$row['acc_id'].'</td>'.
            				     '<td>'.$row['manufacturer'].'</td>'.
            				     '<td>'.$row['accName'].'</td>'.
            				     '<td>'.$row['typeName'].'</td>'.
            				     '<td>'.$row['color'].'</td>'.
            				     '<td>'.$row['oprice'].'</td>'.
								 '<td>'.$row['sprice'].'</td>'.
								 '<td>'.$row['stateName'].'</td>'.
								 '<td>'.$row['retail_id'].'</td>'.
								 '<td>'.$row['ava_bal'].'</td>'.
            				 	'</tr>';
				}// End of while fetch_array($result)
		}// End of if $result
		echo '</tbody></table>';		
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";
	break;	

	case 'getAccList':
	//join 左stockin			
		$sql = "SELECT si.acc_no,acc_id,manufacturer,accName,typeName,color,
				oprice,sprice,stateName,retail_id,sum(ava_bal) as ava_bal
				FROM stockin si, accessories acc, retailShop rs, acctype act ,productstate pd
				WHERE si.acc_no = acc.acc_no
				AND si.retailShop_no = rs.retailShop_no
				AND acc.productState_no = pd.productState_no
				AND acc.accType_no = act.accType_no";
				
		if (isset($_GET['limitShopno'])){
			$shopno =(isset($_GET['limitShopno']))? $_GET['limitShopno'] :$_POST['limitShopno'];
			$sql .=" and si.retailShop_no = $shopno";
		}
		$pageNo = $_GET['pageNo'];
		if (isset($_GET['shortByA'])&& isset($_GET['shortByB'])){
			$shortByA = $_GET['shortByA'];	$shortByB = $_GET['shortByB'];
			$sql .=" AND $shortByA = '$shortByB'
					group by si.retailShop_no,si.acc_no";
		} else
		if (isset($_GET['orderBy'])&& isset($_GET['ascDesc'])){
			$orderBy = $_GET['orderBy'];	$ascDesc = $_GET['ascDesc'];
			$sql .=" group by si.retailShop_no,si.acc_no";
			$sql .= " ORDER BY $orderBy $ascDesc";			
		} else
			$sql .=" group by si.retailShop_no,si.acc_no";
		
	
		
		
//		$pageNo = 0;
		$result = $db->selectLimit($sql, '14',$pageNo);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<table rules="all" border="1" class="finAcc" style="width:100%;" >'.
            '<thead>'.
				'<th style="width: 110px">配件 no</th>'.
            	'<th style="width: 110px">配件 id</th>'.
            	'<th>配件製造商</th>'.
            	'<th style="width: 145px">配件名稱</th>'.
            	'<th style="width: 100px">配件種類</th>'.
            	'<th style="width: 100px">配件顔色</th>'.
				'<th>oprice</th>'.
            	'<th>sprice</th>'.
            	'<th>配件狀態</th>'.
				'<th>店舖</th>'.
				'<th>QTY</th>'.
            '</thead>'.
            '<tbody>';
		if ($result) {
                while ($row = $db->fetch_array($result)) {
					echo '<tr><td><a href="#" style="color:#0019FF;"
					 onclick="addAccToInvoice('.$row['acc_no'].')">'.$row['acc_no'].' 加到Invoice</a></td>'.
            				     '<td>'.$row['acc_id'].'</td>'.
            				     '<td>'.$row['manufacturer'].'</td>'.
            				     '<td>'.$row['accName'].'</td>'.
            				     '<td>'.$row['typeName'].'</td>'.
            				     '<td>'.$row['color'].'</td>'.
            				     '<td>'.$row['oprice'].'</td>'.
								 '<td>'.$row['sprice'].'</td>'.
								 '<td>'.$row['stateName'].'</td>'.
								 '<td>'.$row['retail_id'].'</td>'.
								 '<td>'.$row['ava_bal'].'</td>'.
            				 	'</tr>';
				}// End of while fetch_array($result)
		}// End of if $result

		echo '</tbody></table>';		
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";

		break;	
	case 'getInvoiceList':
		
		$sql = "select invoice_no ,typeName ,inv.invoiceType_no, createDate ,retail_id ,total ,remark ,invoiceStateName,createBy
				from invoice inv, invoicetype invT, invoicestate invS, retailshop rs
				where invT.invoiceType_no = inv.invoiceType_no
				and invS.invoiceState_no = inv.invoiceState_no
				and rs.retailShop_no = inv.retailShop_no";
		if (isset($_GET['shopno'])){
			$shopno = $_GET['shopno'];
			$sql .=" and inv.retailShop_no=$shopno";
		}
		$sql .=" order by invoice_no desc";
		$pageNo = $_GET['pageNo'];
		
		if (isset($_GET['shortByA'])&& isset($_GET['shortByB'])){
		$shortByA = $_GET['shortByA'];
			$shortByB = $_GET['shortByB'];
			$sql = "select invoice_no ,typeName ,inv.invoiceType_no, createDate ,retail_id ,total ,remark ,invoiceStateName,createBy
				FROM invoice inv, invoicetype invT, invoicestate invS, retailshop rs
				WHERE invT.invoiceType_no = inv.invoiceType_no
				AND invS.invoiceState_no = inv.invoiceState_no
				AND rs.retailShop_no = inv.retailShop_no
				AND $shortByA = '$shortByB'";
				
			if (isset($_GET['shopno'])){
				$shopno = $_GET['shopno'];
				$sql .=" and inv.retailShop_no=$shopno";
			}
			$sql .=" order by invoice_no desc";
		}
		
		
		
		
		$result = $db->selectLimit($sql, '14',$pageNo);
		//$result = $db->query($sql);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<table rules="all" border="1" class="fininv" style="width:100%;" >'.
            '<thead>'.
            	'<th style="width: 110px">單據編號</th>'.
            	'<th>單據種類</th>'.
            	'<th style="width: 145px">日期</th>'.
            	'<th style="width: 100px">分店</th>'.
            	'<th style="width: 100px">總數</th>'.
            	'<th>remark</th>'.
            	'<th>單據State</th>'.
				'<th>開單員工</td>'.
            '</thead>'.
            '<tbody>';
            
		if ($result) {
                while ($row = $db->fetch_array($result)) {
                	$tempInvNo = $row['invoice_no'];
					$invNoLength = strlen($tempInvNo);
					$i=7;
					$zeroNeedToAdd=$i-$invNoLength;
					$tempZero='';
					while($zeroNeedToAdd!=0){
						$tempZero.='0';
						$zeroNeedToAdd--;
					}
					if($row['invoiceType_no']==1)
						$numHead='SA-';
					else if($row['invoiceType_no']==2)
						$numHead='SR-';
						
					$finalInvNo=$numHead.$tempZero.$tempInvNo;
					
					
					echo '<tr><td><a href="#" style="color:#0019FF;"
					 onclick="getInvoiceDetails('.$row['invoice_no'].')">'.$finalInvNo.'</a></td>'.
            				     '<td>'.$row['typeName'].'</td>'.
            				     '<td>'.$row['createDate'].'</td>'.
            				     '<td>'.$row['retail_id'].'</td>'.
            				     '<td>'.$row['total'].'</td>'.
            				     '<td>'.$row['remark'].'</td>'.
            				     '<td>'.$row['invoiceStateName'].'</td>'.
								 '<td>'.$row['createBy'].'</td>'.
            				 	'</tr>';
				}// End of while fetch_array($result)
		}// End of if $result
		
		echo '</tbody></table>';		
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";
		break;
		
	case 'salesReturn':
		$IDN = $_GET['IDN'];
		$date = $_GET['date'].' '.$_GET['timeValue2'];
		$sql ="select invD.*,inv.retailShop_no from invoicedetail invD, invoice inv
			   where invD.invoice_no=inv.invoice_no
			   and invD.invoiceDetail_no= $IDN";
		$row = $db->getrow($sql);
		echo $sql;
//		$qty =(isset($_GET['returnQty']))? $_GET['returnQty'] :$row['qty'];
		$qty = 0-$_GET['returnQty'];
		$cal_qty=$_GET['returnQty'];
		$total = ($row['price']-$row['discount'])*$qty;
		$remark =$row['invoice_no'];
		
		$invoiceTypeNo=2;
		$staffNo=$_SESSION['staff_no'];
		$retailShopNo=$_GET['retailShopNo'];
		$invStateNo=3;
		//$createBy = $_GET['createBy'];
		$createBy =$_SESSION['staff_id'];
		$modify_date=date("Y-m-d H:i:s");
		
		echo $retailShopNo.' '.$row['retailShop_no'];
		if($row['retailShop_no'] != $retailShopNo)
			die(error_msg4());
			
		$reason = $_GET['reason'];
		
		$sql="INSERT INTO invoice (createDate,total,remark,invoiceType_no,staff_no,retailShop_no,invoiceState_no,createBy,void_return_desc)VALUES('$date','$total','$remark','$invoiceTypeNo','$staffNo','$retailShopNo',$invStateNo,'$createBy','$reason')";
		echo $sql;
		$db->query($sql);
		echo $sql;
		$last_insert_id= $db->insert_id();
		
		$invNo=$_GET['invNo'];
		$sql="UPDATE invoice SET `invoiceState_no`=4 WHERE `invoice_no`='$invNo'";
		$db->query($sql);
		echo $sql;
		$sql="UPDATE invoicedetail SET pastIDV=$last_insert_id,modifyDate='$modify_date' WHERE `invoiceDetail_no`='$IDN'";
		$db->query($sql);
		echo $sql;
		$product_no =$row['product_no'];

		
		$discount = $row['discount'];
		$price = $row['price'];
		$invoiceNo = $last_insert_id;
		$description = $row['description'];
		$modifyBy=1;
		$pastIDV = $row['invoiceDetail_no'];
		$goodsType=$row['goodsType'];
		$cost=$row['cost'];
		$commission_1 = 0-$row['commission_1'];
		$commission_2 = 0-$row['commission_2'];
		
		$sql = "INSERT INTO invoicedetail (`product_no`,`qty`,`discount`,`price`,`invoice_no`,`modifyBy`,`pastIDV`,`modifyDate`,`description`,`goodsType`,`cost`,commission_1,commission_2) 
							VALUES ('$product_no','$qty','$discount','$price','$invoiceNo','$modifyBy','$pastIDV','$modify_date','$description','$goodsType','$cost',$commission_1,$commission_2)";
		$db->query($sql);
		echo $sql;
		
		//處理個payment, 現在只-現金, 多個payment method 要問Terence
		$paymentNo=1; // 1 = 現金
		$sql = $sql = "INSERT INTO `payment_has_invoice` (`invoice_no`,`payment_no`,`money`) VALUES ('$invoiceNo','$paymentNo','$total')";
		$db->query($sql);
		echo $sql;
		
		if($goodsType==0){ //如果是accessories時做的動作
			$sql2="select stockIn_no, ava_bal,rec_qty from stockin where retailShop_no= $retailShopNo
				  and acc_no = (select acc_no from accessories where barcode = '$product_no' or acc_id = '$product_no')
				  and rec_qty <> ava_bal
				  order by po_date desc, rec_date desc";
			$result2 = $db->query($sql2);
			
			while ($row2 = $db->fetch_array($result2)) {
					
					$tempStockInNo = $row2['stockIn_no'];
					$tempQty = $row2['ava_bal'];
					$maxQty=$row2['rec_qty'];
					echo "tempQty=".$tempQty." ";
					echo "maxQty=".$maxQty." ";
					echo $tempQty+$cal_qty." ";
					
					if(($tempQty+$cal_qty)<=$maxQty){
						$sql = "UPDATE stockin SET ava_bal=ava_bal+$cal_qty WHERE stockIn_no='$tempStockInNo'";
						$db->query($sql);
						echo $sql;
						echo " A ";
//						echo $tempQty;
//						$cal_qty = $cal_qty-$maxQty;
						break;
					} else
					if(($tempQty+$cal_qty)>$row2['rec_qty']){
						if($tempQty!=$maxQty){
							$canmins=$maxQty-$tempQty;
							$sql = "UPDATE stockin SET ava_bal=ava_bal+$canmins WHERE stockIn_no='$tempStockInNo'";
							$db->query($sql);
							$cal_qty = $cal_qty-$canmins;
						} else{
							$sql = "UPDATE stockin SET ava_bal=ava_bal+$maxQty WHERE stockIn_no='$tempStockInNo'";
							$db->query($sql);
							$cal_qty = $cal_qty-$maxQty;
						}						
					}
					if($cal_qty==0)
						break;
				}//end of while
			}
			else
			if($goodsType==1){ //如果是電話時做的動作
				$sql="UPDATE phone SET `phoneState_no`=1 WHERE `IMEI`='$product_no';";
				$db->query($sql);
			}
		
		$last_insert_id_2= $db->insert_id();
		
		$tempInvNo=$last_insert_id;
		$invNoLength=strlen($tempInvNo);
		$i=7;
		$zeroNeedToAdd=$i-$invNoLength;
		$tempZero='';
		while($zeroNeedToAdd!=0){
			$tempZero.='0';
			$zeroNeedToAdd--;
		}
		$numHead='SR-';
		$finalInvNo=$numHead.$tempZero.$tempInvNo;
		echo '<script> temp =\'<table rules="all" border="1" class="" style="width:100%;" ><th style="width: 110px; texr-align:center;">單據編號 : '.$finalInvNo.'</th></table>\';';

		echo 'temp2=\'<table  class="gidLeft" style="" >'.
			 		  '<tr><td style="width: 80px;">單據種類</td><td>:</td><td style="border:red 1px dashed;">退貨單 Return</td></tr>'.
					  '<tr><td style="width: 80px">分店</td><td>:</td><td>\'+$(\'#rfRI\').html()+\'</td></tr>'.
					  "<tr><td style=\"width: 80px\">開單員工</td><td>:</td><td>".$createBy."</div></td></tr>".
			 		  '</table>'.
			  '<table rules="" border="0" class="gidRight" style="" >'.
					  '<tr><td>日期</td><td>:</td><td>\'+date+\'</td></tr>'.
					  '<tr><td>ref.</td><td>:</td><td>\'+$(\'#rfInvNo\').html()+\'</td></tr>'.
			 		  '</table>'.
			  '<table rules="all" border="1" class="gidLeft" style="" >'.
					  '<tr><td style="width: 130px">IDN</td>'.
					 	  '<td style="width: 145px">條碼 / IMEI</td>'.
						  '<td style="width: 245px">貨品名稱</td>'.
						  '<td style="width: 50px">售價</td>'.
						  '<td style="width: 50px">數量</td>'.
						  '<td style="width: 50px">折扣</td>'.
						  '<td style="width: 95px">小計</td></tr>';
		echo	'<tr><td>'.$last_insert_id_2.'</td><td>'.$row['product_no'].'</td>'.
				'<td>'.$row['description'].'</td><td>'.number_format($price,1,'.',',').'</td>'.
				'<td>'.$qty.'</td><td>'.number_format($discount,1,'.',',').'</td>'.
				'<td>'.number_format($total,1,'.',',').'</td></tr>'.

					  '</table>\';';
		echo '$(\'#salesReturnForm\').dialog(\'open\');</script>';
		
		break;
		
	case 'addInvoice':
		$date = $_GET['date'].' '.$_GET['timeValue2'];
		$total = $_GET['total'];
		$remark = $_GET['remark'];
		$invoiceTypeNo = $_GET['invoiceTypeNo'];
		$staffNo = $_GET['staffNo'];
		$retailShopNo = $_GET['retailShopNo'];
		$createBy = $_GET['createBy'];
		$invStateNo =1;
		if(isset($_GET['customer_no'])){
			$customer_no=$_GET['customer_no'];
			$sql="INSERT INTO invoice (`createDate`, `total`, `remark`, `invoiceType_no`, `customer_no`, `staff_no`, `retailShop_no`, `invoiceState_no`, `createBy`) VALUES ('$date', '$total', '$remark', $invoiceTypeNo, '$customer_no', $staffNo, $retailShopNo, $invStateNo, '$createBy');";
		} else
			$sql="INSERT INTO invoice (`createDate`,`total`,`remark`,`invoiceType_no`,`staff_no`,`retailShop_no`,`invoiceState_no`,`createBy`)VALUES('$date','$total','$remark','$invoiceTypeNo','$staffNo','$retailShopNo',$invStateNo,'$createBy')";
		$db->query($sql);

		echo $db->insert_id();

		break;
		
	case 'addInvoiceDetail':
		$poudNo = $_GET['productNo'];
		$description = $_GET['description'];
		$qty = $_GET['qty'];
		$discount = $_GET['discount'];
		$price = $_GET['price'];
		$invoiceNo = $_GET['invoiceNo'];
		$retailShopNo = $_GET['retailShopNo'];
		$modifyBy = $_GET['modifyBy'];
		$goodsType = $_GET['goodsType'];
		
		if(!checkGoodsState($poudNo,$goodsType,$retailShopNo,$qty)){
			echo $poudNo.'  '.$goodsType.'  '.$retailShopNo.' '.$qty;
			echo "<script>openPrintDialog=0; canAddPayment=0;</script>";
			$sql="DELETE FROM invoicedetail WHERE `invoice_no`='$invoiceNo';";
			//echo $sql;
			$db->query($sql);
			
			$sql="DELETE FROM invoice WHERE `invoice_no`='$invoiceNo';";
			//echo $sql;			
			$db->query($sql);
			
			echo "<script>openPrintDialog=0; canAddPayment=0;</script>";
			die(error_msg3());
		} else {
			echo "<script>openPrintDialog=1; canAddPayment=1;</script>";
		}
		echo '<br>'.$goodsType.'<br>';

		if($goodsType==1){ //如果是電話時做的動作
			$sql="select iprice from phone where IMEI = '$poudNo'";
			$cost = $db->getOne($sql);
			
			$row = $db->getrow("select commission_1,commission_2 from phonetype where phoneType_no = (select phoneType_no from phone where IMEI = '$poudNo')");
				$commission_1 = $row['commission_1'];
				$commission_2 = $row['commission_2'];
			if ($discount > 0){
				$commission_1 = 0;
				$commission_2 = 0;
			}
			$sql = "INSERT INTO invoicedetail (`product_no`,`description`,`qty`,`discount`,`price`,`invoice_no`,`modifyBy`,`goodsType`,`cost`,`commission_1`,`commission_2`)
					VALUES ('$poudNo','$description',$qty,'$discount','$price','$invoiceNo','$modifyBy',1,'$cost','$commission_1','$commission_2')";
			$db->query($sql);
			$db->query("UPDATE phone SET `phoneState_no`=2 WHERE`IMEI`='$poudNo'");
		}else 
		if($goodsType==0){ //如果是accessories時做的動作

			$sql="select stockIn_no, ava_bal from stockin where retailShop_no=$retailShopNo
				  and acc_no = (select acc_no from accessories where barcode = '$poudNo' or acc_id = '$poudNo')
				  and ava_bal>0
				  order by po_date asc, rec_date asc";
			$result = $db->query($sql);
//echo $sql;
			if ($result){
				while ($row = $db->fetch_array($result)) {
					$tempAvaBal = $row['ava_bal'];					
					$tempStockInNo = $row['stockIn_no'];

echo	"<script type=\"text/javascript\">";
echo 	" reverseArray.push($tempStockInNo,$qty);";
echo	"</script>";

					if($qty >= $tempAvaBal){
						$stockInNo = $row['stockIn_no'];
						echo '<br> qty '.$qty;
						
						echo '<br> -qty '.$qty;
						
						if($qty-$tempAvaBal>=0){
							$db->query("START TRANSACTION;");
							$db->query("SELECT ava_bal FROM stockin WHERE stockIn_no = '$stockInNo' FOR UPDATE;");
							$db->query("UPDATE stockin SET `ava_bal`=0 WHERE `stockIn_no`='$stockInNo';");
							$db->query("COMMIT;");
						}
						$sql="select iprice from stockin where stockIn_no = '$stockInNo'";
						$cost = $db->getOne($sql);
						
						$row = $db->getrow("select commission_1,commission_2 from accessories where acc_id = '$poudNo'");
						$commission_1 = $row['commission_1'];
						$commission_2 = $row['commission_2'];
						if ($discount > 0){
							$commission_1 = 0;
							$commission_2 = 0;
						}
						$sql = "INSERT INTO invoicedetail (`product_no`,`description`,`qty`,`discount`,`price`,`invoice_no`,`modifyBy`,`goodsType`,`cost`,`commission_1`,`commission_2`)
							VALUES ('$poudNo','$description',$tempAvaBal,'$discount','$price','$invoiceNo','$modifyBy',0,$cost,'$commission_1','$commission_2')";
						$db->query($sql);
						
						$qty = $qty-$tempAvaBal;
						echo 'cost'.$cost;
						if($qty==0)
							break;
					} else if ($qty < $tempAvaBal){
						if($qty>0){
							$stockInNo = $row['stockIn_no'];
							$ava_bal=$tempAvaBal-$qty;
							
							$db->query("START TRANSACTION;");
							$db->query("SELECT ava_bal FROM stockin WHERE stockIn_no = '$stockInNo' FOR UPDATE;");
							$db->query("UPDATE stockin SET `ava_bal`=$ava_bal WHERE `stockIn_no`='$stockInNo';");
							$db->query("COMMIT;");
							
							$sql="select iprice from stockin where stockIn_no = '$stockInNo'";
							$cost = $db->getOne($sql);
							
							$row = $db->getrow("select commission_1,commission_2 from accessories where acc_id = '$poudNo'");
							$commission_1 = $row['commission_1'];
							$commission_2 = $row['commission_2'];
							
							$sql = "INSERT INTO invoicedetail (`product_no`,`description`,`qty`,`discount`,`price`,`invoice_no`,`modifyBy`,`goodsType`,`cost`,`commission_1`,`commission_2`)
							VALUES ('$poudNo','$description',$qty,'$discount','$price','$invoiceNo','$modifyBy',0,$cost,'$commission_1','$commission_2')";
							$db->query($sql);
							
							$qty=0;
						}
					}

					/*
					if($row['ava_bal']<=$qty){
						$qty = $qty-$tempAvaBal;
						$sql = "UPDATE stockin SET ava_bal=ava_bal-$tempAvaBal WHERE stockIn_no='$tempStockInNo'";
						$db->query($sql);
						echo $sql;
						echo" A ";

					} else{
						echo" B ";
						$sql = "UPDATE stockin SET ava_bal=ava_bal-$qty WHERE stockIn_no='$tempStockInNo'";
						$db->query($sql);
						echo $sql;
						$qty=$qty-$qty;
					}
					if($qty == 0)
						break;
					*/
					
				}
			}
		}  //end of  如果是accessories時做的動作

		break;
		
	case 'addPayment':
		$invoiceNo = $_GET['invoiceNo'];
		$paymentNo = $_GET['paymentNo'];
		$money = $_GET['money'];
		//echo $invoiceNo. " ".$paymentNo." ".$money;
		$sql = "INSERT INTO `payment_has_invoice` (`invoice_no`,`payment_no`,`money`) VALUES ('$invoiceNo','$paymentNo','$money')";
		$db->query($sql);
		
		$sql = "select paymentName from payment where payment_no = $paymentNo";
		$row = $db->getrow($sql);
		
		$pame = $row['paymentName'];

		
		echo "<input type=\"hidden\" id=\"pame\" value=\"$pame\" />";
		break;
	
	case'getMobileInfo':
		$price = 0;
		$qty = 1;
		$total = 0;
		$goodsType=1;
		$inv_type=$_GET['inv_type'];
		if ($inv_type==1){
		
			$sql="SELECT phone_name,imei,manufacturer, sprice, oprice,phoneState_no,color,phonetype_id
						FROM phone ph, phonetype pt
						WHERE ph.phoneType_no = pt.phoneType_no";
			if (isset($_GET['imei']) && isset($_GET['qty'])){
				$imei = $_GET['imei'];
				$qty = $_GET['qty'];
				$sql .=" and imei = '$imei'";
			} else
			if (isset($_GET['phone_no'])){
				$phoneNo = $_GET['phone_no'];
				$sql .=" and ph.phone_no = '$phoneNo'";
			}
			$sql .=" group by ph.phone_no";
			$result = $db->query($sql);
			if ($result){
				while ($row = $db->fetch_array($result)) {
					if($row['phoneState_no']==2)
						die(error_msg2());
					if ($_GET['osarea'] == 0)
						$price = $row['sprice'];
					else if ($_GET['osarea'] == 1)
						$price = $row['oprice'];
					$imei = $row['imei'];
					$phoneName =$row['manufacturer']." ".$row['phone_name']." (".$row['color'].")";
					
					$total = ($price*$qty);
					$discount = 0;
					echo '<tr><td>'.$imei.'</td>'.
							'<td>'.$phoneName.'</td>'.
							'<td>'.$price.'</td>'.
							'<td>'.$qty.'</td>'.
							'<td>'.$discount.'</td>'.
							'<td>'.round($total, 1).'</td>'.
						'</tr>';
				}//  end while
			}// End of if $result
		echo	"<script type=\"text/javascript\">";
		echo 	"	total = total + $total;";
		//echo 	" itemArray.push($bcode,$price,$qty,$discount,$total);";
		echo 	" itemArray.push('$imei','$phoneName',$price,$qty,$discount,$total,$goodsType);";
		echo	"setInvTableListener();";
		echo	"</script>";
	} else if ($inv_type==2){
		echo "This is two";
	}
		break;
	
	case'getGdInfo':
		$price = 0;
		$total = 0;
		$qty = 1;
		$goodsType=0;
		$shopno = $_GET['shopno'];
		
		$sql = "SELECT accName, barcode,acc_id, sum(ava_bal) as ava_bal, typeName, sprice,oprice
				FROM accessories acc,stockin si, acctype act
				WHERE si.retailShop_no = $shopno
        		AND acc.acc_no = si.acc_no
        		AND acc.accType_no = act.accType_no";
		
		if (isset($_GET['bcode']) && isset($_GET['qty'])){
			$bcode = $_GET['bcode'];
			$qty = $_GET['qty'];
			$sql .=" AND si.acc_no =(select acc_no from accessories where barcode='$bcode' or acc_id = '$bcode')";
			 
					 
		} else
		if (isset($_GET['accNo'])){
			$accNo = $_GET['accNo'];
			$sql .=" AND acc.acc_no = $accNo";
				
		}
			$sql .=" group by acc.acc_no";

		$result = $db->query($sql);
		if ($result) {
            while ($row = $db->fetch_array($result)) {
				if(($row['ava_bal']-$qty)<0)
					die(error_msg1());
				if ($_GET['osarea'] == 0)
					$price = $row['sprice'];
				else if ($_GET['osarea'] == 1)
					$price = $row['oprice'];
				
				
				if($row['barcode']!=null && $row['barcode'])
					$bcode = $row['acc_id'];
					//$bcode = $row['barcode'];
				else
					$bcode = $row['acc_id'];
				
				$accName = $row['accName'];
			
				$total = ($price*$qty);
			/*
			a = 5/3
			a應該等於1.6666666

			1.$a = number_format($a, 1, '.', '');
			2.sprintf("%.1f",$a);
			3.round($a, 1);
			*/
			
			
				$discount = 0;
				echo '<tr><td>'.$bcode.'</td>'.
	            	     '<td>'.$accName.'</td>'.
	            	     '<td>'.$price.'</td>'.
//	            	     '<td><input type="text" style="border: 1px solid #000000; width:50px;" value="'.$qty.'"/></td>'.
	            	     '<td>'.$qty.'</td>'.
	            	     '<td>'.$discount.'</td>'.
	            	     '<td>'.round($total, 1).'</td>'.
	             	'</tr>';
			}
		}// End of if $result

echo	"<script type=\"text/javascript\">";
echo 	"	total = total + $total;";
//echo 	" itemArray.push($bcode,$price,$qty,$discount,$total);";
echo 	" itemArray.push('$bcode','$accName',$price,$qty,$discount,$total,$goodsType);";
echo	"setInvTableListener();";
echo	"</script>";



//the sql had us in this case
//INSERT INTO `3shop`.`retailshop_ass` (`retailShop_no`,`acc_no`,`qty`,`price`) VALUES (1,1,10,30);
//UPDATE `3shop`.`retailshop_ass` SET `price`=20 WHERE `acc_no`='1' and retailShop_no = 1;

	break;
	
	default :
		echo "ERROR OR NOT FIND, PLEASE CALL THE POS ADMINISTRATOR";
	break;
		
}

function error_msg1(){
	echo '<script>alert(\'存庫不足\');</script>';
}
function error_msg2(){
	echo '<script>alert(\'電話已被賣出\');</script>';
}
function error_msg3(){
	echo '<script>alert(\'存庫不足, StockIn reversed\');</script>';
	echo '<script>';
	echo 'reverseStockIn();';
	echo '</script>';
}
function error_msg4(){
	echo '<script>alert(\'非本店退貨單, 不能退貨\');getInvoiceDetails(filteInvNo($(\'#rfInvNo\').html()));</script>';
}
function error_msg5(){
	echo '<script>alert(\'非本店售貨單, 不能Void\');</script>';
}
function checkGoodsState($poudNo,$goodsType,$retailShopNo,$qty){
	require_once('../conn/sqlconnect.php');
	mysql_select_db($database_conn, $conn);
	if($goodsType==1){  //check phone
		$sql="select *
			  from phone
			  where IMEI = '$poudNo'
		  	  and phoneState_no !=2";
		$rs = mysql_query($sql, $conn) or die(mysql_error());
		$totalrow = mysql_num_rows($rs);
		if($totalrow==0){
			//die(error_msg1());
			return false;
		}else
			return true;
	} else
	if($goodsType==0) {	//check acc

		$sql="select sum(ava_bal) as ava_bal
			  from stockin
			  where retailShop_no=$retailShopNo
			  and acc_no = (select acc_no from accessories where barcode = '$poudNo' or acc_id = '$poudNo');";
		$rs = mysql_query($sql, $conn) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		$ava_bal = $row['ava_bal'];
		//echo ($ava_bal-$qty);
		if(($ava_bal-$qty)>=0){
			return true;
		}else
			return false;
	}
		


}
$db->closeConn();
?>