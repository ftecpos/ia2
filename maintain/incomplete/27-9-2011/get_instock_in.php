<?php require_once('Connections/conn.php');?>
<table border="1" width = "100%">
	<thead>
		<tr>
			<td>貨品編號</td>
			<td>貨品名稱</td>
			<td>訂購數量</td>
			<td>收取數量</td>
			<td>完成</td>
		</tr>
	</thead>
	<tbody>
<?php
	if(empty($_GET) && isset($_GET)){
		mysql_select_db($database_conn, $conn);
		$SQL = "SELECT * FROM po as p, poDetail as pd, phone as ph , phonetype as pt WHERE p.po_no = pd.po_no AND pd.poDetail_no = ph.poDetail_no AND ph.phonetype_no = pt.phonetype_no"
		$rs = mysql_query($SQL, $conn) or die(mysql_error());
   		$row = mysql_fetch_assoc($rs);
		$totalrow = mysql_num_rows($rs);
	}
do{	
if($totalrow == 0){echo "不存在資料"; break;}
?>
	
		<tr>
			<td><?php echo $row['phonetype_id']; ?></td>
			<td><?php echo $row['phone_name']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td><input type = "text" value = "0"/></td>
			<td><input type = "checkbox"/></td>
		</tr>
<?php
}while($row = mysql_fetch_assoc($rs))	
?>			
</tbody>
</table>