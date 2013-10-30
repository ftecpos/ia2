<?php require ("../../conn/db_include.php")?>
<?php include("../../check_login.php");?>
<?php
//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//must set timezone on the top	
?>
<?php
global $db;

switch($_GET['action']){
	case 'getMobileList':
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
            	'<th>電話?色</th>'.
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
				onclick="openTransImeiList('.$row['phoneType_no'].','.$row['retailShop_no'].')">'.$row['phoneType_no'].' 開啟IMEI List</a></td>'.
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
		echo '<table id="mobile_imei_list" class="" border="1" >
            	<tr><td style="width:170px">IMEI</td><td style="width:185px">Receive Date</td><td>電話狀態</td></tr>';
		while ($row = $db->fetch_array($result)) {
			echo '<tr><td>';
			if($row['phoneState_no']==1){
                            echo '<a href="#" style="color:#0019FF;font-size:15px;" 
                                     onclick="addMobileToTransfer('.$row['phone_no'].','.$row['retailShop_no'].');
                                              deleteRow(this);">'.$row['IMEI'].'</a>';
                        } else 
			if($row['phoneState_no']==2)
				echo	$row['IMEI'];
			else
				$row['IMEI'];
			echo'</td>'.
				 '<td>'.$row['rec_date'].'</td><td style="text-align:center">'.$row['phoneStateName'].'</tr>';
		}
	break;
	case'getTransMobileInfo':
		$price = 0;
		$qty = 1;
		$total = 0;
		$goodsType=1;
		
		
		
		$sql="SELECT phone_name,imei,manufacturer, sprice, oprice,phoneState_no,color,phonetype_id,is_acc
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
				$is_acc = $row['is_acc'];
				$total = ($price*$qty);
				
				
			}//  end while
		}// End of if $result
		echo  ' transObj = { "imei" : "'.$imei.'",
						"phoneName" : "'.$phoneName.'",
							"price" : "'.$price.'",
							  "qty" : "'.$qty.'",
						   "is_acc" : "'.$is_acc.'",
											  } ';
	
	break;
}