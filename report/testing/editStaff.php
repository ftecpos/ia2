<?php
require('../../conn/sqlconnect.php');
switch($_GET['action']) {
case "updateCustomer":
		$id = $_GET['id'];
		$name = $_GET['name'];
		$address = $_GET['address'];
		$tel = $_GET['tel'];
		$fax = $_GET['fax'];
		$email = $_GET['email'];
		$period = $_GET['period'];
		$remark = $_GET['remark'];
		$sql = "update customer set customer_id = '".$id."', name = '".$name."', addr = '".$address."', phone = '".$tel."', period = ".$period.", email = '".$email."', fax  = '".$fax."', remark = '".$remark."' where customer_no = ".$no;
		mysql_query($sql);
		
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

?>