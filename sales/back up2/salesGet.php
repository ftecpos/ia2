<?php include ("../conn/db_include.php")?>
<?php

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
		 $db->query("INSERT INTO `3shop`.`postate` (`stateName`) VALUES ('2')");
		echo $db->insert_id();
		break;
		
		
		
		
	case 'getbaseinfo':
		if(isset($_GET['retail_id'])){
			$retail_id = $_GET['retail_id'];
		
		$sql = "select addr,phone,location from retailshop where retail_id = '$retail_id'";
		$row = $db->getrow($sql);
		
		$addr = $row['addr'];
		$phone = $row['phone'];
		$location = $row['location'];

	echo "<input type=\"hidden\" id=\"addr\" value=\"$addr\" />";
	echo "<input type=\"hidden\" id=\"location\" value=\"$location\" />";
	echo "<input type=\"hidden\" id=\"phone\" value=\"$phone\" />";
		}

		break;
		
		
		
		
		
		
		
		
	case 'getMobileList':

		$sql = "select * 
				from phonetype pt, productstate pd, phone ph,retailShop rs
				where pt.phoneType_no = ph.phoneType_no
				and pt.productState_no = pd.productState_no
				and ph.retailShop_no = rs.retailShop_no";

		$pageNo = $_GET['pageNo'];

		if (isset($_GET['shortByA'])&& isset($_GET['shortByB'])){
			$shortByA = $_GET['shortByA'];
			$shortByB = $_GET['shortByB'];
			$sql = "select *
					from phonetype pt, productstate pd, phone ph,retailShop rs
					where pt.phoneType_no = ph.phoneType_no
					and pt.productState_no = pd.productState_no
					and ph.retailShop_no = rs.retailShop_no
					AND $shortByA = '$shortByB'";
				
		}
		//未join retailshop_ass
		if (isset($_GET['orderBy'])&& isset($_GET['ascDesc'])){
			$orderBy = $_GET['orderBy'];
			$ascDesc = $_GET['ascDesc'];
			$sql = "select * 
					from phonetype pt, productstate pd, phone ph,retailShop rs
					where pt.phoneType_no = ph.phoneType_no
					and pt.productState_no = pd.productState_no
					and ph.retailShop_no = rs.retailShop_no
					ORDER BY $orderBy $ascDesc";	
					
		}
		//未join retailshop_ass
		if (isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
			$sql = "select * 
					from phonetype pt, productstate pd, phone ph,retailShop rs
					where pt.phoneType_no = ph.phoneType_no
					and pt.productState_no = pd.productState_no
					and ph.retailShop_no = rs.retailShop_no
					AND pt.phone_name like '%$keyword%'";
					
		}
//		$pageNo = 0;
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
				'<th style="width: 110px">電話 no</th>'.
            	'<th style="width: 110px">電話種類 id</th>'.
            	'<th>電話製造商</th>'.
            	'<th style="width: 145px">電話名稱</th>'.
            	'<th style="width: 100px">電話顔色</th>'.
				'<th>oprice</th>'.
            	'<th>sprice</th>'.
            	'<th>電話狀態</th>'.
				'<th>電話種類狀態</th>'.
				'<th>店舖</th>'.
            '</thead>'.
            '<tbody>';
		if ($result) {
                while ($row = $db->fetch_array($result)) {
					echo '<tr><td><a href="#" style="color:#0019FF;"
					 onclick="addMobileToInvoice('.$row['phone_no'].')">'.$row['phone_no'].' 加到Invoice</a></td>'.
            				     '<td>'.$row['phonetype_id'].'</td>'.
            				     '<td>'.$row['manufacturer'].'</td>'.
            				     '<td>'.$row['phone_name'].'</td>'.
            				     '<td>'.$row['color'].'</td>'.
            				     '<td>'.$row['oprice'].'</td>'.
								 '<td>'.$row['sprice'].'</td>'.
								 '<td>'.$row['phoneState_no'].'</td>'.
								 '<td>'.$row['productState_no'].'</td>'.
								 '<td>'.$row['retail_id'].'</td>'.
            				 	'</tr>';
				}// End of while fetch_array($result)
		}// End of if $result

		echo '</tbody></table>';		
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";

		break;
	
	case 'getMobileTypeMenu': //short by mobile type
		$sql = "select * from `3shop`.`phonetype` group by manufacturer;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['manufacturer'].'" class="finMobileBut" onclick="getMobileList(\'pt.phoneType_no\','.$row['phoneType_no'].')"/>';
		}		
		break;
	case 'getAssTypeMenu': //short by ass type
		$sql = "select * from `3shop`.`asscessoriestype`;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['typeName'].'" class="findAssBut" onclick="getAssList(\'ass.asscessoriesType_no\','.$row['asscessoriesType_no'].')"/>';
		}		
		break;
	
	case 'getMobileStateMenu':
		$sql = "select * from `3shop`.`productstate`;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['stateName'].'" class="finMobileBut" onclick="getMobileList(\'phoneState_no\','.$row['productState_no'].')"/>';
		}
		break;	
	case 'getAssStateMenu':
		$sql = "select * from `3shop`.`productstate`;";	
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			echo '<input type="button" value="'.$row['stateName'].'" class="findAssBut" onclick="getAssList(\'ass.productState_no\','.$row['productState_no'].')"/>';
		}
		break;
		
	case 'voidInvoice':
		$invNo = $_GET['invNo'];
		$sql = "UPDATE `3shop`.`invoice` SET `invoiceState_no`=2 WHERE `invoice_no`='$invNo';";	
		$db->query($sql);
		break;
		
		
	case 'getInvoiceDetails':
//$Staff_name =(isset($_GET['staff_name']))? $_GET['staff_name'] :$_POST['staff_name'] ;
		$invNo = $_GET['invNo'];
		/*$sql = "select * 
				from invoice inv, retailshop rs ,invoicetype invT, invoicedetail invD,asscessories ass, invoicestate invS
				where rs.retailShop_no = inv.retailShop_no	
				and invT.invoiceType_no = inv.invoiceType_no
				and invD.invoice_no = inv.invoice_no
				and ass.barcode=invD.product_no
				and invS.invoiceState_no = inv.invoiceState_no
				and inv.invoice_no = '$invNo'";    */
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
				echo  '<script>'.
					  '$(\'#findInvoiceMenu\').append(\'<input type="button" value="列印單據" class="finIncel" onclick="printInvoice('.$row2['invoice_no'].');"  />  '.
					  
					  '\')'.
					  '</script>';
			
			  if($row2['invoiceState_no']==1){
				echo  '<script>'.
					  '$(\'#findInvoiceMenu\').append(\'<input type="button" value="取消單據" class="finIncel" onclick="voidInvoice('.$row2['invoice_no'].');" />  '.
					  
					  '\')'.
					  '</script>';
			  }
				echo  '<table  class="gidLeft" style="" >'.
					  '<tr><td style="width: 80px;">單據種類</td><td>:</td><td style="border:red 1px dashed;">'.$row2['typeName'].'</td></tr>'.
					  '<tr><td style="width: 80px">分店</td><td>:</td><td  id="rfRI">'.$row2['retail_id'].'</td></tr>'.
					  '<tr><td style="width: 80px">開單員工</td><td>:</td><td>'.$row2['createBy'].'</td></tr>'.
					  '<tr><td style="width: 80px">單據狀態</td><td>:</td><td style="color:green;">'.$row2['invoiceStateName'].'</td></tr>'.
					  '</table>';
				echo  '<table rules="" border="0" class="gidRight" style="" >'.
					  '<tr><td>日期</td><td>:</td><td>'.$row2['createDate'].'</td></tr>'.
					  '<tr><td style="width: 80px">收據編號</td><td>:</td><td id="rfInvNo">'.$row2['invoice_no'].'</td></tr>';
			  if ($row2['invoiceType_no']==2){
				echo  '<tr><td>正單編號</td><td>:</td><td id=""><a href="#"style="color:#FF87B5;font-size:20px" onclick="getInvoiceDetails('.$row2['remark'].')">'.$row2['remark'].'</a></td></tr>';
			  }
				echo  '</table>';
				
				echo  '<table rules="all" border="1" class="gidLeft" style="" >'.
						 '<tr>'.
						  '<td style="width: 130px">IDN</td>'.
					 	  '<td style="width: 145px">條碼 / IMEI</td>'.
						  '<td style="width: 245px">貨品名稱</td>'.
						  '<td style="width: 50px">售價</td>'.
						  '<td style="width: 50px">數量</td>'.
						  '<td style="width: 50px">折扣</td>'.
						 '<td style="width: 95px">小計</td></tr>';
				// $total = 0;
			 while ($row = $db->fetch_array($result)) {
				 $smallTotal = ($row['price']*$row['qty'])-$row['discount'];
				echo  	 '<tr>';
				if(($row2['invoiceState_no']==1||$row2['invoiceState_no']==4) && $row['pastIDV']==""){
					echo '<td>'.'<input type="button" value="退貨" class="finIncel" onclick="$(\'.finIncel\').hide(); salesReturn('.$row['invoiceDetail_no'].');" />'.'</td>';
				} else if ( $row2['invoiceType_no']==1 && $row2['invoiceState_no']!=2)
					echo  '<td>'.'<input type="button" value="退貨單編號 '.$row['pastIDV'].'" class="finIncele" onclick="getInvoiceDetails('.$row['pastIDV'].')"/>'.'</td>';
				  else
				  	echo '<td>'.$row['pastIDV'].'</td>';
				echo	
						 '<td>'.$row['product_no'].'</td>'.
						 '<td>'.$row['description'].'</td>'.
						 '<td>'.$row['price'].'</td>'.
						 '<td>'.$row['qty'].'</td>'.
						 '<td>'.$row['discount'].'</td>'.
						 '<td class="dig">'.$smallTotal.'</td></tr>';
				//$total += $smallTotal;
			 }
			 	echo	 '<tr><td colspan="5"></td>'.
						 '<td >總數</td>'.						 
				//		 '<td>'.$total.'</td></tr>';
						 '<td class="dig" style="text-decoration: underline;">'.$row2['total'].'</td></tr>';
						 
				echo  '</table>';
		} else echo '<p style="color:red; font-size:20px;">Record not find</p>';
		break;
	

	case 'getAssList':
	//join 左retailshop_ass
		$sql = "SELECT *
				FROM asscessories ass, retailshop_ass rsa,retailShop rs, asscessoriestype ast ,productstate pd
				WHERE ass.asscessories_no = rsa.asscessories_no
				AND rsa.retailShop_no = rs.retailShop_no
				AND ass.productState_no = pd.productState_no
				AND ass.asscessoriesType_no = ast.asscessoriesType_no";

		$pageNo = $_GET['pageNo'];
		//未join retailshop_ass
		if (isset($_GET['shortByA'])&& isset($_GET['shortByB'])){
			$shortByA = $_GET['shortByA'];
			$shortByB = $_GET['shortByB'];
			$sql = "SELECT *
				FROM asscessories ass, retailshop_ass rsa,retailShop rs, asscessoriestype ast ,productstate pd
				WHERE ass.asscessories_no = rsa.asscessories_no
				AND rsa.retailShop_no = rs.retailShop_no
				AND ass.productState_no = pd.productState_no
				AND ass.asscessoriesType_no = ast.asscessoriesType_no
				AND $shortByA = '$shortByB'";
				
		}
		//未join retailshop_ass
		if (isset($_GET['orderBy'])&& isset($_GET['ascDesc'])){
			$orderBy = $_GET['orderBy'];
			$ascDesc = $_GET['ascDesc'];
			$sql = "SELECT *
				FROM asscessories ass, retailshop_ass rsa,retailShop rs, asscessoriestype ast ,productstate pd
				WHERE ass.asscessories_no = rsa.asscessories_no
				AND rsa.retailShop_no = rs.retailShop_no
				AND ass.productState_no = pd.productState_no
				AND ass.asscessoriesType_no = ast.asscessoriesType_no
				ORDER BY $orderBy $ascDesc";	
				
		}
		//未join retailshop_ass
		if (isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
			$sql = "SELECT *
				FROM asscessories ass, retailshop_ass rsa,retailShop rs, asscessoriestype ast ,productstate pd
				WHERE ass.asscessories_no = rsa.asscessories_no
				AND rsa.retailShop_no = rs.retailShop_no
				AND ass.productState_no = pd.productState_no
				AND ass.asscessoriesType_no = ast.asscessoriesType_no
				AND ass.assName like '%$keyword%'";
				
		}
//		$pageNo = 0;
		$result = $db->selectLimit($sql, '14',$pageNo);
		$result2 = $db->num_rows($db->select($sql));
		$result3 = $db->num_rows($db->select($sql));
		$totalPage=1;
		while($result2 - 14 >0){
			$totalPage++;
			$result2 = $result2-14;
		}
		echo '<table rules="all" border="1" class="finAss" style="width:100%;" >'.
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
					 onclick="addAssToInvoice('.$row['asscessories_no'].')">'.$row['asscessories_no'].' 加到Invoice</a></td>'.
            				     '<td>'.$row['asscessories_id'].'</td>'.
            				     '<td>'.$row['manufacturer'].'</td>'.
            				     '<td>'.$row['assName'].'</td>'.
            				     '<td>'.$row['typeName'].'</td>'.
            				     '<td>'.$row['color'].'</td>'.
            				     '<td>'.$row['oprice'].'</td>'.
								 '<td>'.$row['sprice'].'</td>'.
								 '<td>'.$row['stateName'].'</td>'.
								 '<td>'.$row['retail_id'].'</td>'.
								 '<td>'.$row['qty'].'</td>'.
            				 	'</tr>';
				}// End of while fetch_array($result)
		}// End of if $result

		echo '</tbody></table>';		
		echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";

		break;	
	case 'getInvoiceList':
		$sql = "select invoice_no ,typeName ,createDate ,retail_id ,total ,remark ,invoiceStateName,createBy
				from invoice inv, invoicetype invT, invoicestate invS, retailshop rs
				where invT.invoiceType_no = inv.invoiceType_no
				and invS.invoiceState_no = inv.invoiceState_no
				and rs.retailShop_no = inv.retailShop_no
				order by invoice_no desc";
		$pageNo = $_GET['pageNo'];
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
                	echo '<tr><td><a href="#" style="color:#0019FF;"
					 onclick="getInvoiceDetails('.$row['invoice_no'].')">'.$row['invoice_no'].'</a></td>'.
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
		$sql ="select * from invoicedetail invD
			   where invD.invoiceDetail_no= $IDN";
		$row = $db->getrow($sql);
		
		$total = $row['qty']*$row['price'];
		$remark =$row['invoice_no'];
		
		$invoiceTypeNo=2;
		$staffNo=1;
		$invStateNo=3;
		$createBy = $_GET['createBy'];
		$retailShopNo=1;
		$sql="INSERT INTO `3shop`.`invoice` (`createDate`,`total`,`remark`,`invoiceType_no`,`staff_no`,`retailShop_no`,`invoiceState_no`,`createBy`)VALUES('$date','$total','$remark','$invoiceTypeNo','$staffNo','$retailShopNo',$invStateNo,'$createBy')";
		$db->query($sql);
		$last_insert_id= $db->insert_id();
		
		$invNo=$_GET['invNo'];
		$sql="UPDATE `3shop`.`invoice` SET `invoiceState_no`=4 WHERE `invoice_no`='$invNo'";
		$db->query($sql);
		
		$sql="UPDATE `3shop`.`invoicedetail` SET `pastIDV`=$last_insert_id WHERE `invoiceDetail_no`='$IDN'";
		$db->query($sql);
		
		$poudNo =$row['product_no'];
		$qty =$row['qty'];
		$discount = $row['discount'];
		$price = $row['price'];
		$invoiceNo = $last_insert_id;
		$description = $row['description'];
		$modifyBy=1;
		$pastIDV = $row['invoiceDetail_no'];
		$sql = "INSERT INTO `3shop`.`invoicedetail` (`product_no`,`qty`,`discount`,`price`,`invoice_no`,`modifyBy`,`pastIDV`,`description`) VALUES ('$poudNo','$qty','$discount','$price','$invoiceNo','$modifyBy','$pastIDV','$description')";
		$db->query($sql);
		$last_insert_id_2= $db->insert_id();
		
		
		
		echo '<script> temp =\'<table rules="all" border="1" class="" style="width:100%;" ><th style="width: 110px; texr-align:center;">單據編號 : '.$last_insert_id.'</th></table>\';';

				

		echo 'temp2=\'<table  class="gidLeft" style="" >'.
			 		  '<tr><td style="width: 80px;">單據種類</td><td>:</td><td style="border:red 1px dashed;">退貨單 Return</td></tr>'.
					  '<tr><td style="width: 80px">分店</td><td>:</td><td>\'+$(\'#rfRI\').html()+\'</td></tr>'.
					  '<tr><td style="width: 80px">開單員工</td><td>:</td><td><div id="">\'+$(\'#createBy\').html()+\'</div></td></tr>'.
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
				'<td>'.$row['description'].'</td><td>'.$price.'</td>'.
				'<td>'.$qty.'</td><td>'.$discount.'</td>'.
				'<td>'.$total.'</td></tr>'.

					  '</table>\';';
		echo '</script>';
		
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
		$sql="INSERT INTO `3shop`.`invoice` (`createDate`,`total`,`remark`,`invoiceType_no`,`staff_no`,`retailShop_no`,`invoiceState_no`,`createBy`)VALUES('$date','$total','$remark','$invoiceTypeNo','$staffNo','$retailShopNo',$invStateNo,'$createBy')";
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
		$modifyBy = $_GET['modifyBy'];
		
		$sql = "INSERT INTO `3shop`.`invoicedetail` (`product_no`,`description`,`qty`,`discount`,`price`,`invoice_no`,`modifyBy`)
				VALUES ('$poudNo','$description',$qty,'$discount','$price','$invoiceNo','$modifyBy')";
		$db->query($sql);
		

		break;
		
	case 'addPayment':
		$invoiceNo = $_GET['invoiceNo'];
		$paymentNo = $_GET['paymentNo'];
		$money = $_GET['money'];
		//echo $invoiceNo. " ".$paymentNo." ".$money;
		$sql = "INSERT INTO `3shop`.`payment_has_invoice` (`invoice_no`,`payment_no`,`money`) VALUES ('$invoiceNo','$paymentNo','$money')";
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
		$sql="";
		if (isset($_GET['imei']) && isset($_GET['qty'])){
			$imei = $_GET['imei'];
			$qty = $_GET['qty'];
			$sql = "SELECT phone_name,imei,manufacturer, sprice, oprice
					FROM phone ph, phonetype pt
					WHERE ph.phoneType_no = pt.phoneType_no
					and imei = '$imei'
					group by ph.phone_no";
		}
		if (isset($_GET['phone_no'])){
			$phoneNo = $_GET['phone_no'];
			$sql = "SELECT phone_name,imei,manufacturer, sprice, oprice
					FROM phone ph, phonetype pt
					WHERE ph.phoneType_no = pt.phoneType_no
					and ph.phone_no = '$phoneNo'
					group by ph.phone_no";
		}
		$result = $db->query($sql);
		if ($result){
			while ($row = $db->fetch_array($result)) {
				if ($_GET['osarea'] == 0)
					$price = $row['sprice'];
				else if ($_GET['osarea'] == 1)
					$price = $row['oprice'];
				$imei = $row['imei'];
				$phoneName =$row['manufacturer']." ".$row['phone_name'];
				$total = ($price*$qty);
				$discount = 0;
				echo '<tr><td>'.$row['imei'].'</td>'.
	            	     '<td>'.$phoneName.'</td>'.
	            	     '<td>'.$price.'</td>'.
	            	     '<td>'.$qty.'</td>'.
	            	     '<td>'.$discount.'</td>'.
	            	     '<td>'.$total.'</td>'.
	             	'</tr>';
			}//  end while
		}// End of if $result
echo	"<script type=\"text/javascript\">";
echo 	"	total = total + $total;";
//echo 	" itemArray.push($bcode,$price,$qty,$discount,$total);";
echo 	" itemArray.push('$imei','$phoneName',$price,$qty,$discount,$total);";

echo	"setInvTableListener();";


echo	"</script>";






		break;
	
	case'getGdInfo':
		$price = 0;
		$total = 0;
		$qty = 1;
		
		/*$sql = "SELECT * from asscessories a, retailshop_ass rsa
				WHERE a.asscessories_no = rsa.asscessories_no
				AND barcode = $bcode";*/
		if (isset($_GET['bcode']) && isset($_GET['qty'])){
			$bcode = $_GET['bcode'];
			$qty = $_GET['qty'];
			$sql = "SELECT assName, barcode, qty, typeName, sprice,oprice
				FROM asscessories a, retailshop_ass rsa, asscessoriestype ast
				WHERE a.asscessories_no = rsa.asscessories_no
        		AND a.asscessoriesType_no = ast.asscessoriesType_no
				AND barcode = $bcode
				group by a.asscessories_no";
		}
		if (isset($_GET['assNo'])){
			
			$assNo = $_GET['assNo'];
			$sql = "SELECT assName, barcode, qty, typeName, sprice, oprice
				FROM asscessories a, retailshop_ass rsa, asscessoriestype ast
				WHERE a.asscessories_no = rsa.asscessories_no
        		AND a.asscessoriesType_no = ast.asscessoriesType_no
				AND a.asscessories_no = $assNo
				group by a.asscessories_no";
				
		}
		
		$result = $db->query($sql);
		if ($result) {
			//echo "<select id=\"st_list\" name=\"st_list\">";
            while ($row = $db->fetch_array($result)) {
            //echo "<option value=\"".
            //$row['st_no']."\">".
            //$row['st_name'].
            //"</option>";
			//echo $row['assName'].$row['assName'];
			if ($_GET['osarea'] == 0)
				$price = $row['sprice'];
			else if ($_GET['osarea'] == 1)
				$price = $row['oprice'];
			$bcode = $row['barcode'];
			$assName = $row['assName'];
			$total = ($price*$qty);
			$discount = 0;
			echo '<tr><td>'.$row['barcode'].'</td>'.
            	     '<td>'.$assName.'</td>'.
            	     '<td>'.$price.'</td>'.
            	     '<td>'.$qty.'</td>'.
            	     '<td>'.$discount.'</td>'.
            	     '<td>'.$total.'</td>'.
             	'</tr>';
			}
		}// End of if $result

echo	"<script type=\"text/javascript\">";
echo 	"	total = total + $total;";
//echo 	" itemArray.push($bcode,$price,$qty,$discount,$total);";
echo 	" itemArray.push($bcode,'$assName',$price,$qty,$discount,$total);";

echo	"setInvTableListener();";
echo	"</script>";

//testingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtesting







//testingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtesting

//the sql had us in this case
//INSERT INTO `3shop`.`retailshop_ass` (`retailShop_no`,`asscessories_no`,`qty`,`price`) VALUES (1,1,10,30);
//UPDATE `3shop`.`retailshop_ass` SET `price`=20 WHERE `asscessories_no`='1' and retailShop_no = 1;

	break;
	
	default :
		echo "ERROR OR NOT FIND, PLEASE CALL THE POS ADMINISTRATOR";
	break;
		
}

?>