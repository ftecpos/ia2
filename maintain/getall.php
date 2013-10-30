<?php include("../check_login.php");?>
<?php

include_once("../conn/sqlconnect.php");
include_once("../conn/db_include.php");
switch($_GET['action']) {
	case "login":
		$id = $_GET['id'];
		$pw = $_GET['pw'];
		$pass = false;
		$result = mysql_query("select * from staff");
		while($row = mysql_fetch_array($result)) {
			if($id == $row['staff_id']) 
				if($pw == $row['pwd']) {
					$_SESSION['staff_id'] = $id;
					$_SESSION['staff_no'] = $row['staff_no'];
					$pass = true;
					echo "";
					break;
				}
		}
		if($pass == false)
			echo "<font color='red'>帳戶資料不正確</font>";
		break;
	case "getStates":
		$stateId = $_GET['statesId'];
	case "editSearch":
		if($_GET['action'] == "editSearch") {
			$page = $_GET['page'];
			$code=$_GET["code"];
			$type=$_GET["type"];
		}
	case "getProdectforPo":
            $page = $_GET['page'];
            $code=$_GET["code"];
            $name=$_GET["name"];
            $branch=$_GET["branch"];
            $type=$_GET["type"];
            $retail_id = 1;
            if(isset($_GET["retailid"])){
                $retail_id = $_GET["retailid"];
            }
		
            $ed = $_GET['ed'];
            $addAnd = false;
            $addWhere = false;
            $currentPage = (int)(($page*10)-10);
            if($type != "phone") {
                $sql = "select * from accessories ass";
                    if($code != "") {
                        if(!$addWhere) { $sql .= " where "; }
                            $sql .= "ass.acc_id like '%".$code."%'";
                        $addAnd = true;
                        $addWhere = true;
                    }
		} else {
                    $sql = "select phonetype.phonetype_id,phonetype.phonetype_no, phonetype.phone_name, retailshop.retail_id, phonetype.oprice, productstate.stateName, count(*) as TQY from phone,retailshop,phonetype,productstate";
                    if($code != "") {
                        if(!$addWhere) { $sql .= " where "; }
                            $sql .= "phonetype_id like '".$code."%'";
                            $addAnd = true;
                            $addWhere = true;
                    }
                    $sql .=" group by phonetype_no";
		}
		//	echo $sql;

		//$maxPageNum = checkTotalPage($sql);
		//$sql.=" limit ".$currentPage.",10";
		$result = mysql_query($sql);
		$result9 = mysql_query($sql);
		$rownum = mysql_num_rows($result);
		if($_GET['action'] == "editSearch") {
			echo "<table border='1' width='100%' class='custContent' id='eresult'>";
		} else {
			echo "<table border='1' width='100%' class='custContent' id='result'>";
		}
		echo	"<thead>
				<tr>
				<td width='15%'>貨品編號</td>
				<td width='30%'>貨品名稱</td>
				<td width='15%'>分店</td>
				<td width='8%'>貨存數量</td>
				<td width='8%'>售價</td>
				<td width='8%'>狀況</td>
				</tr></thead><tbody>";
				$row8 = mysql_fetch_row($result9);
	//	if($rownum != 0 && $page <= $maxPageNum && $page > 0 && $row8[0] != "") {
		if($rownum != 0) {
			while($row = mysql_fetch_array($result))
 		 	{
  				echo "<tr>";
  				if($type == "phone") {
  					echo "<td>" . $row['phonetype_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['phonetype_id']."\",this.parentNode.parentNode.rowIndex,\"phone\",".checkPrice($row['phonetype_no'],"phone", $retail_id).",\"".$ed."\")'></td>"; 
					echo "<td>" . $row['phone_name'] . "</td>";
					echo "<td>" . $row['retail_id'] . "</td>";
					echo "<td>" . $row['TQY']."</td>";
					echo "<td>" . $row['oprice'] . "</td>";
					echo "<td>" . $row['stateName']. "</td>";
				} else {
	  				echo "<td>" . $row['acc_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['acc_id']."\",this.parentNode.parentNode.rowIndex,\"acc\",".checkPrice($row['acc_no'],"acc", $retail_id).",\"".$ed."\")'></td>";
					echo "<td>" . $row['accName'] . "</td>";
					echo "<td>" . $row['retail_id']='' . "</td>";
					echo "<td>" . $row['SUM(ava_bal)']='' . "</td>";
					echo "<td>" . $row['oprice'] . "</td>";
					echo "<td>" . $row['stateName']=''. "</td>";
				} 
  				echo "</tr>";
  			}
			if(!$addWhere) { 
				//echo "</tbody><tfoot><tr><td colspan='5'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>";
				echo "</tbody><tfoot><tr><td colspan='5'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'></label>頁</td>";
				if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
				echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
				echo "</table>"; 
			} else {
				while($row = mysql_fetch_array($result1)) {
					echo "</tbody><tfoot><tr><td colspan='3'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'></label>頁</td><td colspan='2'>總數: ".(($type=="phone")?$row['count(*)']:$row['SUM(ava_bal)'])."</td>";
					if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
					echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
				  echo "</table>";
				}
			}
		} else {
			
				$sql = str_replace("acc_id,accName,retail_id,stateName,SUM(ava_bal),ass.acc_no,oprice","acc_id,accName,stateName,ass.acc_no,oprice",$sql);
				$sql = str_replace("accessories ass,stockin si,retailshop,productstate","accessories ass,productstate",$sql);
				$sql = str_replace("si.retailShop_no=retailshop.retailShop_no and productstate.productState_no = ass.productState_no and ass.acc_no = si.acc_no","productstate.productState_no = ass.productState_no",$sql);
				$sql = str_replace("group by si.acc_no, si.retailShop_no"," ",$sql);
			
				$sql = str_replace("retail_id = '".$branch."' and"," ",$sql);
				$maxPageNum = checkTotalPage($sql);
				$result = mysql_query($sql);
				$rownum = mysql_num_rows($result);
				if($rownum != 0 && $page <= $maxPageNum && $page > 0) {
						while($row = mysql_fetch_array($result))	{
							if($type == "phone") {
  								echo "<td>" . $row['phonetype_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['phonetype_id']."\",this.parentNode.parentNode.rowIndex,\"phone\",".checkPrice($row['phoneType_no'],"phone").",\"".$ed."\")'></td>"; 
								echo "<td>" . $row['phone_name'] . "</td>";
								echo "<td>N/A</td>";
								echo "<td>N/A</td>";
								echo "<td>" . $row['oprice'] . "</td>";
								echo "<td>" . $row['stateName']. "</td>";
							} else {
	  							echo "<td>" . $row['acc_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['acc_id']."\",this.parentNode.parentNode.rowIndex,\"acc\",".checkPrice($row['acc_no'],"acc").",\"".$ed."\")'></td>";
								echo "<td>" . $row['accName'] . "</td>";
								echo "<td>N/A</td>";
								echo "<td>N/A</td>";
								echo "<td>" . $row['oprice'] . "</td>";
								echo "<td></td>";
							} 
  						echo "</tr>";			
						}
						echo "</tbody><tfoot><tr><td colspan='5'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>";
						if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
							echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
						echo "</table>"; 
				} else {	
					echo "<tr><td colspan='6'>沒有符合的數據</td></tr></table>";
				}
		}
		mysql_close($conn);
	
	
	
	break;
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
			$sql = "select phonetype.phonetype_id,phonetype.phonetype_no, phonetype.phone_name, retailshop.retail_id, phonetype.oprice, productstate.stateName, count(*) as TQY from phone,retailshop,phonetype,productstate";
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
					$sql .= " and phone.productState_no = ".$stateId; 
			}
			$sql .= " group by phone.phonetype_no";
			if($addWhere) { 
				$sql1 = str_replace("phonetype.phonetype_id,phonetype.phonetype_no, phonetype.phone_name, retailshop.retail_id, phonetype.oprice, productstate.stateName, count(*) as TQY","count(*)",$sql); 
				$sql1 = str_replace("group by phone.phonetype_no"," ",$sql1);
				$result1 = mysql_query($sql1); 
			}
		} else {
			$sql = "select acc_id,accName,retail_id,stateName,SUM(ava_bal),ass.acc_no,oprice from accessories ass,stockin si,retailshop,productstate";
			if($code != "") {
				if(!$addWhere) { $sql .= " where "; }
				$sql .= "ass.acc_id like '%".$code."%'";
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
			echo $sql;
		}
		$maxPageNum = checkTotalPage($sql);
		$sql.=" limit ".$currentPage.",10";
		$result = mysql_query($sql);
		$result9 = mysql_query($sql);
		$rownum = mysql_num_rows($result);
		if($_GET['action'] == "editSearch") {
			echo "<table border='1' width='100%' class='custContent' id='eresult'>";
		} else {
			echo "<table border='1' width='100%' class='custContent' id='result'>";
		}
		echo	"<thead>
				<tr>
				<td width='15%'>貨品編號</td>
				<td width='30%'>貨品名稱</td>
				<td width='15%'>分店</td>
				<td width='8%'>貨存數量</td>
				<td width='8%'>售價</td>
				<td width='8%'>狀況</td>
				</tr></thead><tbody>";
				$row8 = mysql_fetch_row($result9);
		if($rownum != 0 && $page <= $maxPageNum && $page > 0 && $row8[0] != "") {
			while($row = mysql_fetch_array($result))
 		 	{
  				echo "<tr>";
  				if($type == "phone") {
  					echo "<td>" . $row['phonetype_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['phonetype_id']."\",this.parentNode.parentNode.rowIndex,\"phone\",".checkPrice($row['phonetype_no'],"phone").",\"".$ed."\")'></td>"; 
					echo "<td>" . $row['phone_name'] . "</td>";
					echo "<td>" . $row['retail_id'] . "</td>";
					echo "<td>" . $row['TQY']."</td>";
					echo "<td>" . $row['oprice'] . "</td>";
					echo "<td>" . $row['stateName']. "</td>";
				} else {
	  				echo "<td>" . $row['acc_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['acc_id']."\",this.parentNode.parentNode.rowIndex,\"acc\",".checkPrice($row['acc_no'],"acc").",\"".$ed."\")'></td>";
					echo "<td>" . $row['accName'] . "</td>";
					echo "<td>" . $row['retail_id'] . "</td>";
					echo "<td>" . $row['SUM(ava_bal)'] . "</td>";
					echo "<td>" . $row['oprice'] . "</td>";
					echo "<td>" . $row['stateName']. "</td>";
				} 
  				echo "</tr>";
  			}
			if(!$addWhere) { 
				echo "</tbody><tfoot><tr><td colspan='5'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>";
				if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
				echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
				echo "</table>"; 
			} else {
				while($row = mysql_fetch_array($result1)) {
					echo "</tbody><tfoot><tr><td colspan='3'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td><td colspan='2'>總數: ".(($type=="phone")?$row['count(*)']:$row['SUM(ava_bal)'])."</td>";
					if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
					echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
				  echo "</table>";
				}
			}
		} else {
			if($type == "phone") {
				$sql = str_replace("phonetype.phonetype_id,phonetype.phonetype_no, phonetype.phone_name, retailshop.retail_id, phonetype.oprice, productstate.stateName, count(*) as TQY","*",$sql);
				$sql = str_replace("phone,retailshop,phonetype,productstate","phonetype,productstate",$sql);
				$sql = str_replace("phone.retailShop_no=retailshop.retailShop_no and phone.phoneType_no = phonetype.phoneType_no and productstate.productState_no = phonetype.productState_no and phone.phoneState_no = 1","phonetype.productState_no = productstate.productState_no",$sql);
				$sql = str_replace("group by phone.phonetype_no","",$sql);
			} else {
				$sql = str_replace("acc_id,accName,retail_id,stateName,SUM(ava_bal),ass.acc_no,oprice","acc_id,accName,stateName,ass.acc_no,oprice",$sql);
				$sql = str_replace("accessories ass,stockin si,retailshop,productstate","accessories ass,productstate",$sql);
				$sql = str_replace("si.retailShop_no=retailshop.retailShop_no and productstate.productState_no = ass.productState_no and ass.acc_no = si.acc_no","productstate.productState_no = ass.productState_no",$sql);
				$sql = str_replace("group by si.acc_no, si.retailShop_no"," ",$sql);
			}
				$sql = str_replace("retail_id = '".$branch."' and"," ",$sql);
				$maxPageNum = checkTotalPage($sql);
				$result = mysql_query($sql);
				$rownum = mysql_num_rows($result);
				if($rownum != 0 && $page <= $maxPageNum && $page > 0) {
						while($row = mysql_fetch_array($result))	{
							if($type == "phone") {
  								echo "<td>" . $row['phonetype_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['phonetype_id']."\",this.parentNode.parentNode.rowIndex,\"phone\",".checkPrice($row['phoneType_no'],"phone").",\"".$ed."\")'></td>"; 
								echo "<td>" . $row['phone_name'] . "</td>";
								echo "<td>N/A</td>";
								echo "<td>N/A</td>";
								echo "<td>" . $row['oprice'] . "</td>";
								echo "<td>" . $row['stateName']. "</td>";
							} else {
	  							echo "<td>" . $row['acc_id'] . "   <input type='button' name='add' id='add' value='增加' onclick='addProduct(\"".$row['acc_id']."\",this.parentNode.parentNode.rowIndex,\"acc\",".checkPrice($row['acc_no'],"acc").",\"".$ed."\")'></td>";
								echo "<td>" . $row['accName'] . "</td>";
								echo "<td>N/A</td>";
								echo "<td>N/A</td>";
								echo "<td>" . $row['oprice'] . "</td>";
								echo "<td>" . $row['stateName']. "</td>";
							} 
  						echo "</tr>";			
						}
						echo "</tbody><tfoot><tr><td colspan='5'><input type='button' value='<' onclick='lessPage(\"getProduct\")'>".$page."<input type='button' value='>' onclick='addPage(\"getProduct\")'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event,\"getProduct\")'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>";
						if($_GET['action'] == "getProduct" || $_GET['action'] == "getStates") {
							echo "<td><select id='states' name='states' onchange='changeStates(this.value)'><option value=''></option><option value='1'>停售</option><option value='2'>發售</option></select></td>"; } else { echo "<td></td>"; }
						echo "</table>"; 
				} else {	
					echo "<tr><td colspan='6'>沒有符合的數據</td></tr></table>";
				}
		}
		mysql_close($conn);
		break;
	case "updateCustomer":
		$no = $_GET['no'];
	case "exCustInsert":
		if($_GET['action'] == "exCustInsert")
			$file = $_GET['file'];
	case "insertCustomer":
		if($_GET['action'] != "exCustInsert") {
			$id = $_GET['id'];
			$name = $_GET['name'];
			$address = $_GET['address'];
			$tel = $_GET['tel'];
			$fax = $_GET['fax'];
			$email = $_GET['email'];
			$period = $_GET['period'];
			$remark = $_GET['remark'];
		}
		if($_GET['action'] == "updateCustomer") {
			$sql = "update customer set customer_id = '".$id."', name = '".$name."', addr = '".$address."', phone = '".$tel."', period = ".$period.", email = '".$email."', fax  = '".$fax."', remark = '".$remark."' where customer_no = ".$no;
			mysql_query($sql);
		} else if($_GET['action'] == "exCustInsert") {
			require_once("PHPExcel.php");
			require_once("PHPExcel/IOFactory.php");
			if(substr($file,-4,-1) == "xls") {
				require_once("PHPExcel/Reader/Excel2007.php");
				$objReader = new PHPExcel_Reader_Excel2007(); 
			} else {
				require_once("PHPExcel/Reader/Excel5.php");
				$objReader = new PHPExcel_Reader_Excel5(); 
			}
			$objReader->setReadDataOnly(true); 
			$objPHPExcel = $objReader->load('uploads/'.$file);
			$currentSheet = $objPHPExcel->getSheet(0);
			$allLine = $currentSheet->getHighestRow();
			for($excel_line = 2;$excel_line<=$allLine;$excel_line++) {
				$sql = "insert into customer(customer_id,name,addr,phone,period,email,fax,remark) values('".$currentSheet->getCellByColumnAndRow(0,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(1,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(2,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(3,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(4,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(5,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(6,$excel_line)->getValue()."','".$currentSheet->getCellByColumnAndRow(7,$excel_line)->getValue()."')"; 
				mysql_query($sql) or die(mysql_error);
			}
		} else {
			$sql = "insert into customer(customer_id,name,addr,phone,period,email,fax,remark) values('".$id."','".$name."','".$address."','".$tel."','".$period."','".$email."','".$fax."','".$remark."')";
			mysql_query($sql);
		}
	case "getCustomer":
		$page = $_GET['page'];
		$idfrom = $_GET['idfrom'];
		$idto = $_GET['idto'];
		$custName = $_GET['custName'];
		$currentPage = (int)(($page*10)-10);
		$sql = "select * from customer";
		$addAnd = false;
		$addWhere = false;
		if($idfrom != "undefined" && $idto != "undefined" && $idfrom != "" && $idto != "") {
			if(!$addWhere) { $sql .= " where "; }
			$sql .= "customer_no between ".$idfrom." and ".$idto;
			$addWhere = true;
			$addAnd = true;
		} else if($idfrom != "undefined" && $idto == "" && $idfrom != "") {
			if(!$addWhere) { $sql .= " where "; }
			$sql .= "customer_no = ".$idfrom;
			$addWhere = true;
			$addAnd = true;
		} 
		if($custName != "undefined" && $custName != "") {
			if(!$addWhere) { $sql .= " where "; }
			if($addAnd) { $sql .= " and "; }
			$sql .= "name = '".$custName."'";
		} 
		$maxPageNum = checkTotalPage($sql);
		$sql.=" limit ".$currentPage.",10";
		$result = mysql_query($sql);
		$rownum = mysql_num_rows($result);
		echo "	<table border='1' id='custContent' class='custContent' width='100%'>
				<thead><tr>
				<td width='8%'>行動</td>
				<td width='10%'>客戶編號</td>
				<td width='20%'>客戶名稱</td>
   				<td width='25%'>地址</td>
 				<td width='5%'>電話</td>
   				<td width='5%'>傳真</td>
    			<td width='15%'>電郵</td>
   				<td width='5%'>數期</td>
   				<td width='15%'>備注</td>
				</tr></thead><tbody>"; 
		if($rownum != 0 && $page <= $maxPageNum && $page > 0) {
			while($row = mysql_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$row['customer_no']."  <input type='button' value='Edit' id='editCust' onclick='showWindow(".$row['customer_no'].",\"customer\",this.parentNode.parentNode.rowIndex,null)'></td>";
				echo "<td>".$row['customer_id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['addr']."</td>";
				echo "<td>".$row['phone']."</td>";
				echo "<td>".$row['fax']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['period']."</td>";
				echo "<td>".$row['remark']."</td>";
				echo "</tr>";
			}
				echo "</tbody><tfoot><tr><td colspan='9'><input type='button' value='<' onclick='lessPage()'>".$page."<input type='button' value='>' onclick='addPage()'><input type='text' name='specPage' id='specPage' onkeypress='specPage(event)' size='5'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td></tfoot></table>";
		} else {
			echo "<tr><td colspan='9'>沒有符合的數據</td></tr>";
		}
		mysql_close($conn);
		break;
	case "updateType":
		$no = $_GET['no'];
	case "exInsert":
		if($_GET['action'] == "exinsert") 
			$file = $_GET['file'];
	case "insertType":
		if($_GET['action'] != "exinsert") 
			$type = $_GET['type'];
		if($_GET['action'] == "updateType") {
			$sql = "update acctype set typeName = '".$type."' where accType_no = ".$no;
			mysql_query($sql);
		} else if($_GET['action'] == "exInsert") {
			require_once("PHPExcel.php");
			require_once("PHPExcel/IOFactory.php");
			if(substr($file,-4,-1) == "xls") {
				require_once("PHPExcel/Reader/Excel2007.php");
				$objReader = new PHPExcel_Reader_Excel2007(); 
			} else {
				require_once("PHPExcel/Reader/Excel5.php");
				$objReader = new PHPExcel_Reader_Excel5(); 
			}
			$objReader->setReadDataOnly(true); 
			$objPHPExcel = $objReader->load('uploads/'.$file);
			$currentSheet = $objPHPExcel->getSheet(0);
			$allLine = $currentSheet->getHighestRow();
			for($excel_line = 2;$excel_line<=$allLine;$excel_line++) {
				$sql = "insert into acctype(typeName) values('".$currentSheet->getCellByColumnAndRow(0,$excel_line)->getValue()."')"; 
				mysql_query($sql) or die(mysql_error);
			}
		} else {
			$result = mysql_query("select * from acctype");
			$typeNo = mysql_num_rows($result);
			$sql = "insert into acctype(typeName) values('".$type."')";
			mysql_query($sql);
		}
	case "selectType":
		$page = $_GET['page'];
		$currentPage = (int)(($page*10)-10);
		$maxPageNum = checkTotalPage("select * from acctype");
		$result = mysql_query("select * from acctype limit ".$currentPage.",10");
		$rownum = mysql_num_rows($result);
		echo "	<table border='1' width='100%' id='accContent' class='custContent'>
				<thead><tr>
        		<td width='40%'>分類編號</td>
            	<td width='60%'>分類名稱</td>
       			</tr></thead><tbody>";
		if($rownum != 0 && $page <= $maxPageNum && $page > 0) {
    		while($row = mysql_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$row['accType_no']."  <input type='button' value='Edit' id='editType' onclick='showWindow(".$row['accType_no'].",\"acctype\",this.parentNode.parentNode.rowIndex,null)'></td>";
				echo "<td>".$row['typeName']."</td>";
				echo "</tr>";
			}	
			echo "</tbody>";
			echo "<tfoot><tr><td colspan='2'><input type='button' value='<' onclick='lessPage()'>".$page."<input type='button' value='>' onclick='addPage()'><input type='text' name='specPage' id='specPage' length='10' onkeypress='specPage(event)'><label id='specPageError' class='error'></label>&nbsp;共<label id='totalPage'>".$maxPageNum."</label>頁</td>
				  </table>";
		} else {
			echo "<tr><td colspan='2'>沒有符合的數據</td></tr>";
		}
		mysql_close($conn);
		break;
	case "getSupplier":
		$supid = $_GET['supid'];
		$result = mysql_query("select * from supplier where supplier_id = '".$supid."'");
		while($row = mysql_fetch_array($result)) {
			echo $row['supplierName']."#&#".$row['phone'];
		}
		break;
	case "updatePo":
		$deleteItem = $_GET['deleteItem'];
		$changeItem = $_GET['changeItem'];
		$minsert = $_GET['minsert'];
		$ainsert = $_GET['ainsert'];
		$po_no = $_GET['po_no'];
	case "insertPo":
            global $db;
            if($_GET['action'] == "insertPo") {
                $supno = $_GET['supplierno'];	
                $podetailMobile = $_GET['podetailm'];
                $podetailAcc = $_GET['podetaila'];
                $currTime = $_GET['currTime'];
                $po_to_retail_no = $_GET['potoretailno'];
                $result = mysql_query("select * from supplier where supplier_id = '".$supno."'");
                while($row = mysql_fetch_array($result)) {
                    $supplierNo = $row['supplier_no'];
                }
                if($podetailMobile){
                    $data = explode('||', $podetailMobile); 
                    $podetailm = array(); 
                    foreach($data as $d) { 
                        $d = explode('Mobile: ', $d); 
                        $podetailm[] = $d; 
                    }
                }
                if($podetailAcc){
                    $data = explode('||', $podetailAcc);
                    $podetailacc = array(); 
                    foreach($data as $key => $d) {
                        $d = explode('Acc: ', $d);
                        //print_r($d);
                        $poobj = new stdClass();
                        $poobj->accid = $d[0];
                        $poobj->qty = $d[1];
                        $poobj->cost = $d[2];
                        $podetailacc[] = $poobj;
                    }
                    //print_r($podetailacc);
                }
                $sql = "insert into po(createDate,staff_no,retailShop_no,poState_no,supplier_no, forshop)
                        values('".$currTime."',".$_SESSION['staff_no'].",1,1,".$supplierNo.", $po_to_retail_no)";
                //mysql_query($sql);
                //$rownum = mysql_insert_id($conn);
		//print_r($sql);
                $db->query($sql);
                $rownum = $db->insert_id();
                echo $rownum;//==================================================================================
                if($podetailMobile){
                    for($i = 0; $i < sizeof($podetailm); $i++) {
                        if($podetailm[$i][0] != "") {
                            $sql1 = "insert into podetail(qty,cost,po_no,phonetype_no,acc_no) values(".$podetailm[$i][1].",".$podetailm[$i][2].",".($rownum).",'".getPhonetype($podetailm[$i][0])."',null)";
                            mysql_query($sql1);
                        }
                    }
                }
                //print_r($podetaila);
                if($podetailacc){
                    foreach ($podetailacc as $key => $poacc) {
                        if($poacc->qty >0){
                            $_acc_no = getaccno($poacc->accid);
                            $sql2 = "insert into podetail (qty,cost,po_no,phonetype_no,acc_no)
                                        values('$poacc->qty', '$poacc->cost', '$rownum', null, '$_acc_no')";
                            $db->query($sql2);
                            print_r('<br>'.$_acc_no);
                            print_r('<br>'.$sql2);
                            $last_insert_id= $db->insert_id();
                            $podate = time();
                            $cost = $poacc->cost;
                            $costsql = "insert into cost_by_retail(acc_no,retail_id,podate,podetail_no,cost) 
                                        values ($_acc_no, $po_to_retail_no, $podate, $last_insert_id, $cost)";
                            mysql_query($costsql);
                        }
                    }
                }
            } else if($_GET['action'] == "updatePo") {
			if(isset($changeItem) && $changeItem != "") {
				$data = explode('/^/',$changeItem);
				foreach($data as $d) { 
   					$d = explode('~', $d); 
   			 		$changerow[] = $d; }
				for($i = 0; $i < sizeof($changerow); $i++) {
					if($changerow[$i][0] != "") {
						$sql = "update podetail set qty = ".$changerow[$i][1].", cost = ".$changerow[$i][2]." where poDetail_no = ".$changerow[$i][0];
						mysql_query($sql);
					}
				}
			}
			if(isset($deleteItem) && $deleteItem != "") {
				$deleletrow = explode("~",$deleteItem);
				for($i = 0; $i < sizeof($deleletrow); $i++) {
					if($deleletrow[$i] != "") {
						$sql = "delete from podetail where poDetail_no = ".$deleletrow[$i];
						mysql_query($sql);
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
						$sql1 = "insert into podetail(qty,cost,po_no,phonetype_no,acc_no) values(".$minsertItem[$i][1].",".$minsertItem[$i][2].",".($po_no).",'".getPhonetype($minsertItem[$i][0])."',null)";
						mysql_query($sql1);
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
						$sql2 = "insert into podetail(qty,cost,po_no,phonetype_no,acc_no) values(".$ainsertItem[$i][1].",".$ainsertItem[$i][2].",".($po_no).",null,".(checkAssNo($ainsertItem[$i][0])).")";
					mysql_query($sql2);
					}
				}
			}
		}
	break;
	case "getPo":
		$page = $_GET['page'];
		$currentPage = (int)(($page*10)-10);
		$maxPageNum = checkTotalPage("select * from po");
		$result = mysql_query("select * from po,postate,staff where po.poState_no = postate.poState_no and staff.staff_no = po.staff_no order by createDate desc,po.poState_no,po_no asc limit ".$currentPage.",10");
		echo "	<table border='1' class='custContent' width='100%' id='poContent'>
				<thead>
				<tr>
				<td width='30%'>購貨單編號</td>
				<td width='30%'>日期</td>
				<td width='20%'>新增者(員工編號)</td>
				<td width='20%'>狀態</td>
				</tr></thead><tbody>";
		while($row = mysql_fetch_array($result)) {
				$tempPoNo = $row['po_no'];
				$finalPoNo = getPoNo($tempPoNo);
				echo "<tr>";
				echo "<td>".$finalPoNo;
				if($row['poState_no'] == 1) {
					echo "<input type='button' value='Edit' id='editType' onclick='showWindow(".$row['po_no'].",\"podetail\",this.parentNode.parentNode.rowIndex,\"".checkEdit($row['poState_no'],$row['po_no'],$row['staff_id'])."\");clearVal();'></td>";
				} else {
					echo "<input type='button' value='View' id='viewType' onclick='showWindow(".$row['po_no'].",\"podetail\",this.parentNode.parentNode.rowIndex,\"".viewpo($row['poState_no'],$row['po_no'],$row['staff_id'])."\");clearVal();'></td>";
				}
				echo "<td>".$row['createDate']."</td>";
				echo "<td>".$row['staff_id']."</td>";
				echo "<td>".$row['stateName']."</td>";
				echo "</tr>";
			}	
		echo "</tbody>";
		echo "<tfoot><tr><td colspan='4'><input type='button' value='<' onclick='lessPage(\"getPo\")'>".$page."<input type='button' value='>' onclick='addPage(\"getPo\")'><input type='text' name='specPage1' id='specPage1' length='10' onkeypress='specPage(event,\"getPo\")'><label id='specPageError1' class='error'></label>&nbsp;共<label id='totalPage1'>".$maxPageNum."</label>頁</td>
				  </table>"; 
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
function getaccno($accid) {
    global $db;
    $sql = "SELECT acc_no
            FROM accessories
            WHERE acc_id = '$accid' ";
    $row = $db->getrow($sql);
    
    return $row['acc_no'];
}
function getPhonetype($id) {
	$result = mysql_query("select * from phonetype where phonetype_id = '".$id."'");
	while($row = mysql_fetch_array($result)) {
		$no = $row['phoneType_no'];
	}
	return $no;
}
function checkEdit($state,$no,$staffno) {
	$finalPoNo = getPoNo($no);
	$out = "";
	if($state != "1") {
		$out .= "<font color='red'>購貨單不能編輯(請聯絡系統管理員）</font>";
	} else {
		$out .= "<input type=\"button\" value=\"重印PO\" class=\"finIncel\"  onclick=\"printPO(".$no.");\"/>";
		$out .= "<table border=0 id=editTable width=100%><tbody><tr><td>購貨單編號</td><td colspan=1><input type=text id=editPoNo name=editPoNo size=10 disabled value=".$finalPoNo."></td></tr>";
		$out .= "<tr><td>新增者(員工編號)</td><td colspan=1><input type=text id=editStaffNo name=editStaffNo size=10 disabled value=".$staffno."></td></tr><tr><td colspan=3>手提電話</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editPhoneDetail width=100%><tbody><tr><td width=8%>行動</td><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=5%>數量</td><td width=8%>成本</td></tr>";
		$result = mysql_query("select * from po,podetail,phonetype where po.po_no = ".$no." and po.po_no = podetail.po_no and phonetype.phoneType_no = podetail.phonetype_no");
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td><input type=button id=".$row['poDetail_no']." value=刪除 onclick=editDelr(this.parentNode.parentNode.rowIndex,'phone',this.id)></td><td>".$row['phonetype_id']."</td><td>".$row['phone_name']."</td><td><input type=text id=editPhoneQty".$row['poDetail_no']." name=editPhoneQty".$row['poDetail_no']." size=10 value=".$row['qty']." onchange=changeEdit(".$row['poDetail_no'].",this.value,this.id)></td><td><input type=text id=editPhoneCost".$row['poDetail_no']." name=editPhoneCost".$row['poDetail_no']." size=10 value=".$row['cost']." onchange=changeEdit(".$row['poDetail_no'].",this.id,this.value)></td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$result = mysql_query("select * from po,podetail,accessories where po.po_no = ".$no." and po.po_no = podetail.po_no and podetail.acc_no = accessories.acc_no");
		$out .= "<tr><td colspan=3>配件</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editAssDetail width=100%><tbody><tr><td width=8%>行動</td><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=5%>數量</td><td width=8%>成本</td></tr>";
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td><input type=button id=".$row['poDetail_no']." value=刪除 onclick=editDelr(this.parentNode.parentNode.rowIndex,'ass',this.id)></td><td>".$row['acc_id']."</td><td>".$row['accName']."</td><td><input type=text id=editAssQty".$row['poDetail_no']." size=10 value=".$row['qty']." onchange=changeEdit(".$row['poDetail_no'].",this.value,this.id)></td><td><input type=text id=editAssCost".$row['poDetail_no']." size=10 value=".$row['cost']." onchange=changeEdit(".$row['poDetail_no'].",this.id,this.value)></td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$out .= "<tr><td colspan=3>新增貨品</td></tr>";
		$out .= "<form name=editSearchForm><tr><td>貨品編號&nbsp;&nbsp;&nbsp;<input type=text id=editFindPro size=10></td><td>種類&nbsp;&nbsp;&nbsp;<input type=radio id=editProductType name=editProductType value=phone onchange=editDisab(false)>電話&nbsp;&nbsp;<input type=radio id=editProductType name=editProductType value=ass onchange=editDisab(false)>配件<font color=red>*</font></td><td><input type=button id=editSerach name=editSearch id=editSearch value=尋找 onclick=findPro('editSearch') disabled><input type=button value=重設 onclick=editReset();editDisab(true)></td></tr><tr><td colspan=3><span id=editResult></span></td></tr></form>";
		$out .= "<tr><td colspan=3><input type=button id=editSubmit name=editSubmit value=更改 onclick=updatePo();closeWindow()></td></tr>";
		$out .= "</tbody></table>";
	}
	return urlencode(utf8_encode($out));
}
function viewpo($state,$no,$staffno) {
	$finalPoNo = getPoNo($no);
	$out = "";
		$out .= "<input type=\"button\" value=\"重印PO\" class=\"finIncel\"  onclick=\"printPO(".$no.");\"/>";
		$out .= "<table border=0 id=editTable width=100%><tbody><tr><td>購貨單編號</td><td colspan=1><input type=text id=editPoNo name=editPoNo size=10 disabled value=".$finalPoNo."></td></tr>";
		$out .= "<tr><td>新增者(員工編號)</td><td colspan=1><input type=text id=editStaffNo name=editStaffNo size=10 disabled value=".$staffno."></td></tr><tr><td colspan=3>手提電話</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editPhoneDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=5%>數量</td><td width=8%>成本</td></tr>";
		$result = mysql_query("select * from po,podetail,phonetype where po.po_no = ".$no." and po.po_no = podetail.po_no and phonetype.phoneType_no = podetail.phonetype_no");
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['phonetype_id']."</td><td>".$row['phone_name']."</td><td>".$row['qty']."</td><td>".$row['cost']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$result = mysql_query("select * from po,podetail,accessories where po.po_no = ".$no." and po.po_no = podetail.po_no and podetail.acc_no = accessories.acc_no");
		$out .= "<tr><td colspan=3>配件</td></tr>";
		$out .= "<tr><td colspan=3><table border=1 id=editAssDetail width=100%><tbody><tr><td width=13%>貨品編號</td><td width=60%>貨品名稱</td><td width=5%>數量</td><td width=8%>成本</td></tr>";
		while($row = mysql_fetch_array($result)) {
			$out .= "<tr><td>".$row['acc_id']."</td><td>".$row['accName']."</td><td>".$row['qty']."</td><td>".$row['cost']."</td></tr>";
		}
		$out .= "</tbody></table></td></tr>";
		$out .= "</tbody></table>";
	
	return urlencode(utf8_encode($out));
}
function checkPrice($id,$type, $retail_id) {
    global $db;
    $price = 0;
    if($type == "phone") {
        $result = mysql_query("SELECT pd.cost from podetail as pd where pd.po_no = ( select max( po_no ) from podetail where phonetype_no =".$id." ) and phonetype_no =".$id);
        $rownum = mysql_num_rows($result);
        if($rownum != 0) {
                while($row = mysql_fetch_array($result)) {
                        $price = $row['cost'];
                }
        } 
    } else {
        $sql ="SELECT cost
               FROM cost_by_retail
               WHERE retail_id = $retail_id
               AND acc_no = $id
               ORDER BY podate DESC";
        //$result = $db->query($sql);
        $row = $db->getrow($sql);
        $price = $row['cost'];
    }

    if(!$price)
        $price = 0;
    return $price;
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
?>