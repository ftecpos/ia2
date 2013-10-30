<?php include("../check_login.php");?>
<?php
	$timezone = "Asia/Hong_Kong";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	include("../conn/sqlconnect.php");

	switch($_GET['action']) {
		case "checkIMEI":
			$imei = $_GET['IMEI'];
			$result = mysql_query("select * from phone,phonetype where IMEI = ".$imei." and phone.phoneType_no = phonetype.phoneType_no and phone.phoneState_no = 1 and retailShop_no = ".$_SESSION['retail_no']);
			$rownum = mysql_num_rows($result);
			if($rownum > 0) {
				while($row = mysql_fetch_array($result)) {
					echo $row['phonetype_id']."~".$row['phone_name'];
				}
			} 
			break;
		case "updateTran":
			$deleteItem = $_GET['deleteItem'];
			$changeItem = $_GET['changeItem'];
			$minsert = $_GET['minsert'];
			$ainsert = $_GET['ainsert'];
			$tran_no = $_GET['tran_no'];
			$tran_no = explode_transNo($tran_no);
		case "voidTran":
			$tran_no = $_GET['tran_no'];
			$tran_no = explode_transNo($tran_no);
		case "confirmTran":
			if($_GET['action'] == "confirmTran") {
				$tran_no = $_GET['tran_no'];
				$tran_no = explode_transNo($tran_no);
				$confirmdate = $_GET['confirmdate'];
				$confirmby = $_SESSION['staff_no'];
				$result = mysql_query("select * from transfer where transfer_no = ".$tran_no);
				while($row = mysql_fetch_array($result)) {
					$branchto = $row['toRetail_no'];
					$branchfrom = $row['fromRetail_no'];
				}
				$result1 = mysql_query("select * from transdetail where transfer_no = ".$tran_no);
				while($row = mysql_fetch_array($result1)) {
							if($row['IMEI'] != "") {
								$sql5 = "update phone set retailShop_no = ".$branchto." where IMEI = '".$row['IMEI']."'";
							} else {
								$result6 = mysql_query("select * from stockin where retailShop_no = ".$branchto." and acc_no = ".$row['acc_no']." and po_date = '".$row['po_date']."'");
								$rownum = mysql_num_rows($result6);
								if($rownum != 0) {
									$sql5 = "update stockin set ava_bal = ava_bal + ".$row['trans_qty'].", rec_qty = rec_qty + ".$row['trans_qty']." where retailShop_no = ".$branchto." and acc_no = ".$row['acc_no']." and po_date = '".$row['po_date']."'"; 
								} else {
									$sql5 = "insert into stockin(poDetail_no,staff_no,acc_no,retailShop_no,po_date,iprice,ava_bal,rec_qty,rec_date) values(".getPoDetailNo($row['acc_no'],$row['po_date']).",".$confirmby.",".$row['acc_no'].",".$branchto.",'".$row['po_date']."',".getCost($row['acc_no'],$row['po_date']).",".$row['trans_qty'].",".$row['trans_qty'].",'".date("Y-m-d H:i:s")."')";
								}
							}
					mysql_query($sql5);
				}
				mysql_query("update transfer set receiveDate = ".$confirmdate.",confirmBy = '".$confirmby."'");
				mysql_query("update transfer set transState_no = 2 where transfer_no = ".$tran_no);
			}
		case "insertTran":
				if($_GET['action'] == "insertTran") {
					$branchto = $_GET['branchto'];
					$trandetailMobile = $_GET['trandetailm'];
					$trandetailAcc = $_GET['trandetaila'];
					$currTime = $_GET['currTime'];
					$tranReson = $_GET['tranReson'];
					$result = mysql_query("select * from retailshop where retail_id = '".$branchto."'");
						while($row = mysql_fetch_array($result)) {
							$branchto1 = $row['retailShop_no'];
						}
					$data = explode('||', $trandetailMobile); 
					$trandetailm = array(); 
					foreach($data as $d) { 
   			 			$d = explode('Mobile: ', $d); 
   						$trandetailm[] = $d; }
					$data = explode('||', $trandetailAcc); 
					$trandetaila = array(); 
					foreach($data as $d) { 
   						$d = explode('Acc: ', $d); 
   			 			$trandetaila[] = $d; }
						if(checkQty($trandetaila)) {
							$sql = "insert into transfer(transDate,fromRetail_no,toRetail_no,staff_no,transState_no,tranReson) values('".$currTime."','".$_SESSION['retail_no']."','".$branchto1."',".$_SESSION['staff_no'].",1,'".$tranReson."')";
							mysql_query($sql);
							$tran_no = mysql_insert_id($conn);
					echo "<input type='hidden' id='trans_no' value='".$tran_no."'>";
							for($i = 0; $i < sizeof($trandetailm); $i++) {
								if($trandetailm[$i][0] != "") {	
									$sql1 = "insert into transdetail(trans_qty,IMEI,transfer_no,po_date) values(1,".$trandetailm[$i][1].",".($tran_no).",'".phonePoDetailNo($trandetailm[$i][1])."')";
									mysql_query($sql1);
									$sql3 = "update phone set retailShop_no = 9999 where IMEI = ".$trandetailm[$i][1];
									mysql_query($sql3);
								}
							}	
							for($i = 0; $i < sizeof($trandetaila); $i++) {
								if($trandetaila[$i][0] != "") {
									$result = mysql_query("select * from stockin where acc_no = ".(checkAssNo($trandetaila[$i][0]))." and retailShop_no = ".$_SESSION['retail_no']." order by po_date,rec_date");
									$totalqty = $trandetaila[$i][1];
									while($row = mysql_fetch_array($result)) {
										if($totalqty != 0) {
											if($row['ava_bal'] - $totalqty >= 0) {
												$sql2 = "insert into transdetail(trans_qty,transfer_no,acc_no,po_date) values(".$totalqty.",".($tran_no).",".(checkAssNo($trandetaila[$i][0])).",'".$row['po_date']."')";	
												mysql_query($sql2);
												$sql3 = "update stockin set ava_bal = ava_bal - ".$totalqty.", trans_qty = trans_qty + ".$totalqty." where retailShop_no = ".$_SESSION['retail_no']." and acc_no = ".(checkAssNo($trandetaila[$i][0]))." and po_date = '".$row['po_date']."' and stockIn_no = ".$row['stockIn_no']; 
												mysql_query($sql3);
												$totalqty = 0;
												break;
											} else {
												$totalqty = $totalqty - $row['ava_bal'];
												$sql2 = "insert into transdetail(trans_qty,transfer_no,acc_no,po_date) values(".$row['ava_bal'].",".($tran_no).",".(checkAssNo($trandetaila[$i][0])).",'".$row['po_date']."')";
												mysql_query($sql2);
												$sql3 = "update stockin set ava_bal = 0, trans_qty = trans_qty + ".$row['ava_bal']." where retailShop_no = ".$_SESSION['retail_no']." and acc_no = ".(checkAssNo($trandetaila[$i][0]))." and po_date = '".$row['po_date']."' and stockIn_no = ".$row['stockIn_no']; 
												mysql_query($sql3);
											}
										}
									}
									//$sql2 = "insert into transdetail(qty,transfer_no,asscessories_no,transRecord_no) values(".$trandetaila[$i][1].",".($tran_no).",".(checkAssNo($trandetaila[$i][0])).",".$transrecord.")";
									//mysql_query($sql2);						
								}
							} 
							echo "<input type='hidden' id='insertError' value='noError'>";
						} else {
							echo "<input type='hidden' id='insertError' value='error'>";
						}
				} else if($_GET['action'] == "updateTran") {
				if(isset($changeItem) && $changeItem != "") {
				$data = explode('/^/',$changeItem);
				foreach($data as $d) { 
   					$d = explode('~', $d); 
   			 		$changerow[] = $d; }
				for($i = 0; $i < sizeof($changerow); $i++) {
					if($changerow[$i][0] != "") {
						$result6 = mysql_query("select * from transfer,transdetail where transDetail_no = ".$changerow[$i][0]." and transfer.transfer_no = transdetail.transfer_no");
						while($row = mysql_fetch_array($result6)) {
							$branchfrom2 = $row['fromRetail_no'];
							$ass = $row['asscessories_no'];
							$qq = $row['qty'];
							$transRecord_no = $row['transRecord_no'];
						}
						$num = $qq - $changerow[$i][1];
						if($num  > 0) {  
									mysql_query("update transaction_record set qty = qty - ".$num." where transRecord_no = ".$transRecord_no);
						} else if($num < 0) { 
									mysql_query("update transaction_record set qty = qty + ".$num." where transRecord_no = ".$transRecord_no);
						}
						mysql_query("update transdetail set qty = qty - ".$num." where transDetail_no = ".$changerow[$i][0]);
					/*	$sql4 = "update retailshop_ass set qty = qty + ".$num." where retailShop_no = ".$branchfrom2." and asscessories_no = ".$ass." and poDetail_no = ".$podetail;
						mysql_query($sql4);
						$sql = "update transdetail set qty = ".$changerow[$i][1]." where transDetail_no = ".$changerow[$i][0];
						mysql_query($sql); */
					}
				}
			}
			if(isset($deleteItem) && $deleteItem != "") {
				$deleletrow = explode("~",$deleteItem);
				for($i = 0; $i < sizeof($deleletrow); $i++) {
					if($deleletrow[$i] != "") {
						$result6 = mysql_query("select * from transfer,transdetail where transDetail_no = ".$deleletrow[$i][0]." and transfer.transfer_no = transdetail.transfer_no");
						while($row = mysql_fetch_array($result6)) {
							$branchfrom2 = $row['fromRetail_no'];
							$ass = $row['asscessories_no'];
							$qq = $row['qty'];
							$transRecord_no = $row['transRecord_no'];
						}
						$sql = "delete from transdetail where transDetail_no = ".$deleletrow[$i];
						mysql_query($sql);
						mysql_query("delete from transaction_record where transRecord_no = ".$transRecord_no);
					}
				}
			}
			if(isset($minsert) && $minsert != "") {
				$data = explode('~', $minsert); 
				$minsertItem = array(); 
				foreach($data as $d) { 
   			 		$d = explode(':', $d); 
   			 		$minsertItem[] = $d; }
				for($i = 0; $i < sizeof($minsertItem); $i++) {
					if($minsertItem[$i][0] != "") {	
						$sql1 = "insert into transdetail(qty,IMEI,transfer_no,product_no,po_date) values(1,".$minsertItem[$i][1].",".($tran_no).",'".getPhonetype($minsertItem[$i][0])."',".phonePoDetailNo($minsertItem[$i][1]).")";
						mysql_query($sql1);
						$sql3 = "update phone set retailShop_no = 9999 where IMEI = ".$minsertItem[$i][1];
						mysql_query($sql3);
					}
				}
			}
			if(isset($ainsert) && $ainsert != "") {
				$data = explode('~', $ainsert); 
				$ainsertItem = array(); 
				foreach($data as $d) { 
   			 		$d = explode(':', $d); 
   			 		$ainsertItem[] = $d; }
				for($i = 0; $i < sizeof($ainsertItem); $i++) {
					if($ainsertItem[$i][0] != "") {	
						$result = mysql_query("select * from retailshop_ass where asscessories_no = ".(checkAssNo($trandetaila[$i][0]))." order by po_date");
						$totalqty = $ainsertItem[$i][1];
						while($row = mysql_fetch_array($result)) {
							if($totalqty != 0) {
								if($row['qty'] - $totalqty >= 0) {
									$sql2 = "insert into transdetail(qty,transfer_no,asscessories_no,poDetail_no) values(".$totalqty.",".($tran_no).",".(checkAssNo($ainsertItem[$i][0])).",".$row['poDetail_no'].")";
									mysql_query($sql2);
									$sql3 = "update retailshop_ass set qty = qty - ".$totalqty." where retailShop_no = 1 and asscessories_no = ".(checkAssNo($ainsertItem[$i][0]))." and poDetail_no = ".$row['poDetail_no']; 
									mysql_query($sql3);
								} else {
									$totalqty = $totalqty - $row['qty'];
									$sql2 = "insert into transdetail(qty,transfer_no,asscessories_no,poDetail_no) values(".$row['qty'].",".($tran_no).",".(checkAssNo($ainsertItem[$i][0])).",".$row['poDetail_no'].")";
									mysql_query($sql2);
									$sql3 = "update retailshop_ass set qty = 0 where retailShop_no = 1 and asscessories_no = ".(checkAssNo($ainsertItem[$i][0]))." and poDetail_no = ".$row['poDetail_no']; 
									mysql_query($sql3);
								}
							}
						}
					}
				}
			}
		} else if($_GET['action'] == "voidTran") {
			$tran_no = $_GET['tran_no'];
			$tran_no = explode_transNo($tran_no);

			$result = mysql_query("select * from transfer,transdetail where transfer.transfer_no = transdetail.transfer_no and transdetail.transfer_no = ".$tran_no);
			while($row = mysql_fetch_array($result)) {
				if($row['IMEI'] == "")  {
					$result7 = mysql_query("select * from stockin where acc_no = ".$row['acc_no']." and retailShop_no = ".$row['fromRetail_no']." order by po_date,rec_date");
					while($row7 = mysql_fetch_array($result7)) {
						if($row7['ava_bal'] + $row['trans_qty'] <= $row7['rec_qty']) {
							$sql2 = "update stockin set ava_bal = ava_bal + ".$row['trans_qty'].", trans_qty = trans_qty - ".$row['trans_qty']." where acc_no = ".$row['acc_no']." and po_date = '".$row['po_date']."' and retailShop_no = ".$row['fromRetail_no']." and stockIn_no = ".$row7['stockIn_no'];
						}
					}
				} else {
					$sql2 = "update phone set retailShop_no = ".$row['fromRetail_no']." where IMEI = '".$row['IMEI']."'";
				}
				mysql_query($sql2);
			}
			mysql_query("update transfer set transState_no = 3 where transfer_no = ".$tran_no);
		}
		//break;
		case "selectTran":
			$page = $_GET['page'];
			$currentPage = (int)(($page*10)-10);
			$maxPageNum = checkTotalPage("select * from transfer");
			if($_SESSION['retail_no'] != 1)
				$result = mysql_query("select * from transfer,transstate,staff where transfer.transState_no = transstate.transState_no and (transfer.fromRetail_no = ".$_SESSION['retail_no']." or transfer.toRetail_no = ".$_SESSION['retail_no'].") and transfer.staff_no = staff.staff_no order by transfer.transState_no,transfer_no limit ".$currentPage.",10");
			else
				$result = mysql_query("select * from transfer,transstate,staff where transfer.transState_no = transstate.transState_no and transfer.staff_no = staff.staff_no order by transfer.transState_no,transfer_no limit ".$currentPage.",10");
			echo "	<table border='1' class='custContent' width='100%' id='tranContent'>
				<thead>
				<tr>
				<td width='13%'>轉貨單編號</td>
				<td width='13%'>日期</td>
				<td width='10%'>分店（由)</td>
				<td width='10%'>分店（至)</td>
				<td width='6%'>新增者</td>
				<td width='20%'>轉貨原因</td>
				<td width='10%'>狀態</td>
				</tr></thead><tbody>";
		while($row = mysql_fetch_array($result)) {
			$tempTransNo = $row['transfer_no'];
			$finalTransNo = getTransNo($tempTransNo);
				echo "<tr>";
				echo "<td>".$finalTransNo;
				if($row['fromRetail_no'] == $_SESSION['retail_no']) {
					echo "<input type='button' value='Void' id='editTran' onclick='showWindow(".$row['transfer_no'].",\"trandetail\",this.parentNode.parentNode.rowIndex,\"".checkEdit($row['transState_no'],$row['transfer_no'],$row['staff_no'])."\");clearVal();'>";
				}
				if($row['transState_no'] != 3 && $row['toRetail_no'] == $_SESSION['retail_no']) {
					echo "<input type='button' value='Confirm' id='buconfitm' onclick='showWindow(".$row['transfer_no'].",\"confirm\",this.parentNode.parentNode.rowIndex,\"".checkConfirm($row['transState_no'],$row['transfer_no'],$row['staff_no'])."\");clearVal();'></td>";
				} 
				if($row['transState_no'] == 3 && $row['toRetail_no'] == $_SESSION['retail_no']) {
					echo "<input type='button' value='View' id='buconfitm' onclick='showWindow(".$row['transfer_no'].",\"viewTran\",this.parentNode.parentNode.rowIndex,\"".checkView($row['transState_no'],$row['transfer_no'],$row['staff_no'])."\");clearVal();'></td>";
				}
				echo "<td>".$row['transDate']."</td>";
				echo "<td>".checkRetailId($row['fromRetail_no'])."</td>";
				echo "<td>".checkRetailId($row['toRetail_no'])."</td>";
				echo "<td>".$row['staff_id']."</td>";
				echo "<td>".$row['tranReson']."</td>";
				echo "<td>".$row['stateName']."</td>";
				echo "</tr>";
			}
		echo "</tbody>";
		echo "<tfoot><tr><td colspan='7'><input type='button' value='<' onclick='lessPage(\"selectTran\")'>".$page."<input type='button' value='>' onclick='addPage(\"selectTran\")'><input type='text' name='specPage1' id='specPage1' length='10' onkeypress='specPage(event,\"selectTran\")'><label id='specPageError1' class='error'></label>&nbsp;共<label id='totalPage1'>".$maxPageNum."</label>頁</td>
				  </table>"; 
		break;
		case "getStates":
			$stateId = $_GET['statesId'];
		case "editSearch":
			$page = $_GET['page'];
			$code=$_GET["code"];
			$type=$_GET["type"];
		case "getProduct":
			if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
				$page = $_GET['page'];
				$code=$_GET["code"];
				$name=$_GET["name"];
				$branch=$_GET["branch"];
				$type=$_GET["type"];
			}	
			$ed = $_GET['ed'];
			$addAnd = false;
			$addWhere = false;
			$currentPage = (int)(($page*10)-10);
			if($type == "phone") {
				$sql = "select phonetype.phonetype_id,phonetype.phonetype_no, phonetype.phone_name, retailshop.retail_id, phonetype.oprice, productstate.stateName,phone.IMEI from phone,retailshop,phonetype,productstate";
				if($code != "") {
					if(!$addWhere) { $sql .= " where "; }
					$sql .= "phonetype_id like '".$code."%'";
					$addAnd = true;
					$addWhere = true;
				}
				if($_GET['action'] != "editSearch") {
					if($name != "") {
						if(!$addWhere) { $sql .= " where "; }
						if($addAnd) { $sql .= " and "; }
						$sql .= "phone_name like '".$name."%'";
						$addAnd = true;
						$addWhere = true;
					}
					if($branch != "") {
						if(!$addWhere) { $sql .= " where "; }
						if($addAnd) { $sql .= " and "; }
						$sql .= "retail_id = '".$branch."'";
						$addAnd = true;
						$addWhere = true;
					}
				}
				if(!$addWhere) { $sql .= " where "; }
				if($addAnd) { $sql .= " and "; }
				$sql .= "phone.retailShop_no=retailshop.retailShop_no and phone.phoneType_no = phonetype.phoneType_no and productstate.productState_no = phonetype.productState_no and phone.phoneState_no = 1";	
				if($_GET['action'] == "getStates") {
					$sql .= " and phone.phoneState_no = ".$stateId; 
				}
				if($addWhere) { $sql1 = str_replace("phonetype.phonetype_id,phonetype.phonetype_no, phonetype.phone_name, retailshop.retail_id, phonetype.oprice, productstate.stateName,phone.IMEI","count(*)",$sql); $result1 = mysql_query($sql1); }
			} else {
				$sql = "select acc_id,accName,retail_id,stateName,SUM(ava_bal) from accessories ass,stockin si,retailshop,productstate";
				if($code != "") {
					if(!$addWhere) { $sql .= " where "; }
					$sql .= "ass.acc_id like '".$code."%'";
					$addAnd = true;
					$addWhere = true;
				}
				if($_GET['action'] != "editSearch") {
					if($name != "") {
						if(!$addWhere) { $sql .= " where "; }
						if($addAnd) { $sql .= " and "; }
						$sql .= "ass.accName like '".$name."%'";
						$addAnd = true;
						$addWhere = true;
					}
					if($branch != "") {
						if(!$addWhere) { $sql .= " where "; }
						if($addAnd) { $sql .= " and "; }
						$sql .= "retail_id = '".$branch."'";
						$addAnd = true;
						$addWhere = true;
					}
				}
				if(!$addWhere) { $sql .= " where "; }
				if($addAnd) { $sql .= " and "; }
				$sql .= "si.retailShop_no=retailshop.retailShop_no and productstate.productState_no = ass.productState_no and ass.acc_no = si.acc_no";
				if($_GET['action'] == "getStates") {
					$sql .= " and ass.productState_no = ".$stateId;
				}
				if($addWhere) { $sql1 = str_replace("*","SUM(ava_bal)",$sql); $result1 = mysql_query($sql1); }
				$sql .= " group by si.acc_no, si.retailShop_no";
			}
			$maxPageNum = checkTotalPage($sql);
			$sql.=" limit ".$currentPage.",10";
			$result = mysql_query($sql);
			$rownum = mysql_num_rows($result);
			if($_GET['action'] == "editSearch") {
				echo "<table border='1' width='100%' class='custContent' id='eresult'>";
			} else {
				echo "<table border='1' width='100%' class='custContent' id='result'>";
			}
			if($type == "phone") {
				echo	"<thead>
					<tr>
					<td width='15%'>貨品編號</td>
					<td width='30%'>貨品名稱</td>
					<td width='15%'>分店</td>
					<td width='8%'>貨存數量</td>
					<td width='8%'>IMEI</td>
					<td width='8%'>狀況</td>
					</tr></thead><tbody>";
			} else {
				echo	"<thead>
					<tr>
					<td width='15%'>貨品編號</td>
					<td width='30%'>貨品名稱</td>
					<td width='15%'>分店</td>
					<td width='8%'>貨存數量</td>
					<td width='8%'>狀況</td>
					</tr></thead><tbody>";
			}
			if($rownum != 0 && $page <= $maxPageNum && $page > 0) {
					while($row = mysql_fetch_array($result))
 		 				{
  							echo "<tr>";
  							if($type == "phone") {
  								echo "<td>" . $row['phonetype_id'] ;
								if($_SESSION['retail_id'] == $row['retail_id']) {
									echo "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['phonetype_id']."\",this.parentNode.parentNode.rowIndex,\"phone\",null,\"".$ed."\",null,null,null,null)'></td>"; 
								}
								echo "<td>" . $row['phone_name'] . "</td>";
								echo "<td>" . $row['retail_id'] . "</td>";
								echo "<td>1</td>";
								echo "<td>" . $row['IMEI'] . "</td>";
								echo "<td>" . $row['stateName']. "</td>";
							} else {
	  							echo "<td>" . $row['acc_id'];
								if($_SESSION['retail_id'] == $row['retail_id']) {
									echo "  <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['acc_id']."\",this.parentNode.parentNode.rowIndex,\"acc\",null,\"".$ed."\",null,null,null,null)'></td>";
								}
								echo "<td>" . $row['accName'] . "</td>";
								echo "<td>" . $row['retail_id'] . "</td>";
								echo "<td>" . $row['SUM(ava_bal)'] . "</td>";
								echo "<td>" . $row['stateName']. "</td>";
							} 
  							echo "</tr>";
  						}
					if(!$addWhere) { 
						if($type == "phone") {
							echo "</tbody><tfoot><tr><td colspan='5'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>";
						} else {
							echo "</tbody><tfoot><tr><td colspan='4'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>";
						}
						if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
							echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
						echo "</table>"; 
					} else {
						while($row = mysql_fetch_array($result1)) {
							echo "</tbody><tfoot><tr><td colspan='3'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td><td colspan='1'>總數: ".(($type=="phone")?$row['count(*)']:$row['SUM(ava_bal)'])."</td>";
							if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
								echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
				  				echo "</table>";
						}	
					}
				} else {	
					echo "<tr><td colspan='6'>沒有符合的數據</td></tr></table>";
				}
		mysql_close($conn);
		break;
	}
function checkTotalPage($dbname) {
	$result = mysql_query($dbname);
	$rownum = mysql_num_rows($result);
	$pageNum1 = (int)($rownum/10);
		$pageNum2 = $rownum%10;
		if($pageNum2 < 10 && $pageNum2 > 0) 
			$pageNum2 = 1;
		$maxPageNum = $pageNum1 + $pageNum2;
	return $maxPageNum;
}
function checkAssNo($id) {
	$result = mysql_query("select * from accessories where acc_id = '".$id."'");
	while($row = mysql_fetch_array($result)) {
		$no = $row['acc_no'];
	}
	return $no;
}
function getPhonetype($id) {
	$result = mysql_query("select * from phonetype where phonetype_id = '".$id."'");
	while($row = mysql_fetch_array($result)) {
		$no = $row['phoneType_no'];
	}
	return $no;
}
function checkRetailId($no) {
	$result = mysql_query("select * from retailshop where retailShop_no	 = '".$no."'");
	while($row = mysql_fetch_array($result)) {
		$id = $row['retail_id'];
	}
	return $id;
}
function getPoDate($podetailno) {
	$result = mysql_query("select * from po,podetail where po.po_no = podetail.po_no and podetail.poDetail_no = ".$podetailno);
	while($row = mysql_fetch_array($result)) {
		$crDate = $row['createDate'];
	}
	return $crDate;
}
function getPoDetailNo($acc_no,$po_date) {
	$result = mysql_query("select * from po,podetail where po.po_no = podetail.po_no and acc_no = ".$acc_no." and createDate = '".$po_date."'");
	while($row = mysql_fetch_array($result)) {
		$podeno = $row['poDetail_no'];
	}
	return $podeno;
}
function getCost($acc_no,$po_date) {
	$result = mysql_query("select * from po,podetail where po.po_no = podetail.po_no and acc_no = ".$acc_no." and createDate = '".$po_date."'");
	while($row = mysql_fetch_array($result)) {
		$cost = $row['cost'];
	}
	return $cost;
}
function phonePoDetailNo($imei) {
	$result = mysql_query("select * from phone,po,podetail where IMEI = '".$imei."' and phone.poDetail_no = podetail.poDetail_no and po.po_no = podetail.po_no");
	while($row = mysql_fetch_array($result)) {
		$no = $row['createDate'];
	}
	return $no;
}
function checkQty($trandetaila) {
	for($i = 0; $i < sizeof($trandetaila); $i++) {
		if($trandetaila[$i][0] != "") {	
			$result = mysql_query("select sum(ava_bal) from stockin where acc_no = ".(checkAssNo($trandetaila[$i][0]))." and retailShop_no = ".$_SESSION['retail_no']);
			while($row = mysql_fetch_array($result)) {
				if($trandetaila[$i][1] > $row['sum(ava_bal)'])
					return false;
			}
		}
	}
	return true;
}
function checkEdit($state,$no,$staffno) {
	$tempTransNo = $no;
	$finalTransNo = getTransNo($tempTransNo);
	$out = "";
	if($state != "1") {
		$out .= "<input type=\"button\" value=\"重印轉貨單\" class=\"finIncel\"  onclick=\"printTrans(".$no.");\"/><br>";
		$out .= "<font color='red'>轉貨單不能無效(請聯絡系統管理員)</font>";
	} else {
		$out .= "<input type=\"button\" value=\"重印轉貨單\" class=\"finIncel\"  onclick=\"printTrans(".$no.");\"/>";
		$out .= "<table border=0 id=editTable width=100%><tbody><tr><td>轉貨單編號</td><td colspan=1><input type=text id=editTranNo name=editTranNo size=10 disabled value=".$finalTransNo."></td></tr>";
		$out .= "<tr><td>新增者</td><td colspan=1><input type=text id=editStaffNo name=editStaffNo size=10 disabled value=".$staffno."></td></tr><tr><td colspan=3>手提電話</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editPhoneDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=8%>數量</td><td width=10%>IMEI</td></tr>";
		$result = mysql_query("select * from transfer,transdetail,phone,phonetype where transfer.transfer_no = ".$no." and transfer.transfer_no = transdetail.transfer_no and phone.IMEI = transdetail.IMEI and phone.phoneType_no = phonetype.phoneType_no");
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['phonetype_id']."</td><td>".$row['phone_name']."</td><td>1</td><td>".$row['IMEI']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$result = mysql_query("select sum(transdetail.trans_qty) as TQTY,transdetail.transDetail_no,accessories.acc_id,accessories.accName,transfer.fromRetail_no,accessories.acc_no from transfer,transdetail,accessories where transfer.transfer_no = ".$no." and transfer.transfer_no = transdetail.transfer_no and accessories.acc_no = transdetail.acc_no group by transdetail.acc_no");
		$out .= "<tr><td colspan=3>配件</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editAssDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=10%>數量</td></tr>";
		while($row = mysql_fetch_array($result)) {
			$result2 = mysql_query("select sum(ava_bal) from stockin,transfer where retailShop_no = ".$row['fromRetail_no']." and acc_no = ".$row['acc_no']." group by acc_no order by po_date");
			while($row2 = mysql_fetch_array($result2)) {
				$rqty = $row2['sum(ava_bal)'];
			}
			$out .= "<tr><td>".$row['acc_id']."</td><td>".$row['accName']."</td><td>".$row['TQTY']."</td></tr>";
			// <input type=text id=editAssQty".$row['transDetail_no']." size=10 value=".$row['TQTY']." onchange=changeEdit(".$row['transDetail_no'].",this.value,".($rqty+$row['TQTY']).",this.id)><label id=editError class=error></label>
		}
		$out .= "</tbody></table></td></tr>";
		/*$out .= "<tr><td colspan=3>新增貨品</td></tr>";
		$out .= "<form name=editSearchForm><tr><td>貨品編號&nbsp;&nbsp;&nbsp;<input type=text id=editFindPro size=10></td><td>種類&nbsp;&nbsp;&nbsp;<input type=radio id=editProductType name=editProductType value=phone onchange=editDisab(false)>電話&nbsp;&nbsp;<input type=radio id=editProductType name=editProductType value=ass onchange=editDisab(false)>配件<font color=red>*</font></td><td><input type=button id=editSearch name=editSearch value=尋找 onclick=processTran('editSearch') disabled><input type=button value=重設 onclick=editReset();editDisab(true)></td></tr><tr><td colspan=3><span id=editResult></span></td></tr></form>";
		$out .= "<tr><td colspan=3><input type=button id=editSubmit name=editSubmit value=更改 onclick=updateTran();closeWindow()></td></tr>"; */
		$out .= "<tr><td colspan=2><input type=button id=voidTransfer value=無效 onclick=voidTransfer();closeWindow()></td></tr>";
		$out .= "</tbody></table>";
	}
	return urlencode(utf8_encode($out));
}
function checkConfirm($state,$no,$staffno) {
	$tempTransNo = $no;
	$finalTransNo = getTransNo($tempTransNo);
	$out = "";
	if($state != "1") {
		$out .= "<font color='red'>轉貨單已接收！！！</font>";
	}
		$out .= "<input type=\"button\" value=\"重印轉貨單\" class=\"finIncel\"  onclick=\"printTrans(".$no.");\"/>";
		$out .= "<table border=0 id=editTable width=100%><tbody><tr><td>轉貨單編號</td><td colspan=1><input type=text id=confirmTranNo name=confirmTranNo size=10 disabled value=".$finalTransNo."></td></tr>";
		$out .= "<tr><td>新增者</td><td colspan=1><input type=text id=confirmStaffNo name=confirmStaffNo size=10 disabled value=".$staffno."></td></tr><tr><td colspan=3>手提電話</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=confirmPhoneDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=8%>數量</td><td width=10%>IMEI</td></tr>";
		$result = mysql_query("select * from transfer,transdetail,phone,phonetype where transfer.transfer_no = ".$no." and transfer.transfer_no = transdetail.transfer_no and phone.IMEI = transdetail.IMEI and phone.phoneType_no = phonetype.phoneType_no");
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['phonetype_id']."</td><td>".$row['phone_name']."</td><td>1</td><td>".$row['IMEI']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$result = mysql_query("select sum(transdetail.trans_qty) as TQTY,transdetail.transDetail_no,accessories.acc_id,accessories.accName from transdetail,accessories where transdetail.transfer_no = ".$no." and transdetail.acc_no = accessories.acc_no group by transdetail.acc_no");
		$out .= "<tr><td colspan=3>配件</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editAssDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=10%>數量</td></tr>";
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['acc_id']."</td><td>".$row['accName']."</td><td>".$row['TQTY']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		if($state == "1") {
			$out .= "<tr><td colspan=3><input type=button id=confirmSubmit name=confirmSubmit value=接收 onclick=confirmTran();closeWindow()></td></tr>"; }
		$out .= "</tbody></table>";
	
	return urlencode(utf8_encode($out));
}
function checkView($state,$no,$staffno) {
	$tempTransNo = $no;
	$finalTransNo = getTransNo($tempTransNo);
	$out = "";
		$out .= "<input type=\"button\" value=\"重印轉貨單\" class=\"finIncel\"  onclick=\"printTrans(".$no.");\"/>";
		$out .= "<table border=0 id=editTable width=100%><tbody><tr><td>轉貨單編號</td><td colspan=1><input type=text id=confirmTranNo name=confirmTranNo size=10 disabled value=".$finalTransNo."></td></tr>";
		$out .= "<tr><td>新增者</td><td colspan=1><input type=text id=confirmStaffNo name=confirmStaffNo size=10 disabled value=".$staffno."></td></tr><tr><td colspan=3>手提電話</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=confirmPhoneDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=8%>數量</td><td width=10%>IMEI</td></tr>";
		$result = mysql_query("select * from transfer,transdetail,phone,phonetype where transfer.transfer_no = ".$no." and transfer.transfer_no = transdetail.transfer_no and phone.IMEI = transdetail.IMEI and phone.phoneType_no = phonetype.phoneType_no");
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['phonetype_id']."</td><td>".$row['phone_name']."</td><td>1</td><td>".$row['IMEI']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$result = mysql_query("select sum(transdetail.trans_qty) as TQTY,transdetail.transDetail_no,accessories.acc_id,accessories.accName from transdetail,accessories where transdetail.transfer_no = ".$no." and transdetail.acc_no = accessories.acc_no group by transdetail.acc_no");
		$out .= "<tr><td colspan=3>配件</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editAssDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=10%>數量</td></tr>";
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['acc_id']."</td><td>".$row['accName']."</td><td>".$row['TQTY']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		if($state == "1") {
			$out .= "<tr><td colspan=3><input type=button id=confirmSubmit name=confirmSubmit value=接收 onclick=confirmTran();closeWindow()></td></tr>"; }
		$out .= "</tbody></table>";
	
	return urlencode(utf8_encode($out));
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
function explode_transNo($trans_no){
		$trans_no_s1=explode('-',$trans_no);
	return $trans_no_s1[1];
}

?>