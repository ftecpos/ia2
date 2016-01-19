<?php 
	$list = mysql_query("select product_no, description, qty, discount, price from invoice inv, invoicedetail inde where inv.invoice_no = inde.invoice_no and inv.invoice_no=".$receipt_No);
	//$sql_paid = mysql_query("select money from payment_has_invoice where invoice_no='".$receipt_No."'");
	//$refund = mysql_result($sql_paid,0);
	$ta = 0;
	echo '<table width="1000" border="0">';
    echo '<tr>';
	echo '<td width="200">編號<br>CODE</td>';
    echo '<td width="400">產品資料<br>PRODUCT DESCRIPTION</td>';
    echo '<td width="68"><div align="center">數量<br>QTY</div></td>';
    echo '<td width="100"><div align="right">單價<br>UNIT PRICE</div></td>';
    echo '<td width="100"><div align="right">折扣 %<br>DISCOUNT</div></td>';
    echo '<td width="130"><div align="right">金額<br>AMOUNT HKD</div></td>';
    echo '</tr>';
	echo '</table>';
	echo '<hr>';
	echo '<table width="1000" border="0">';
	for($i=0; $i<mysql_num_rows($list); $i++){
		echo "<tr>";
		echo '<td width="200" id="code"><div align="left">'.mysql_result($list,$i,0).'</div></td>';
		echo '<td width="400" id="name"><div align="left">'.mysql_result($list,$i,1).'</div></td>';
		echo '<td width="68" id="qty"><div align="center"> '.$q=mysql_result($list,$i,2).'</div></td>';
		echo '<td width="100" id="unitPrice"><div align="right">'.$p=mysql_result($list,$i,4).'</div></td>';
		echo '<td width="100" id="discount"><div align="right">'.$d=mysql_result($list,$i,3).'</div></td>';
		if($d==0){
		echo '<td width="130" id="amount"><div align="right">'.$a=$q*$p.'</div></td>';
		}else{
		echo '<td width="130" id="amount"><div align="right">'.$a=$q*$p-$d.'</div></td>';
		}
		$ta+=$a;
		echo "</tr>";
	}
	echo "</table>";
	echo "<br />";
	echo '<table width="900" border="0">';
	echo '<tr><td width="700"><div align="right">退貨總額 :</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right"> '.$ta.'</div></td></tr>';
	echo '<tr><td width="700"><div align="right">合計金額 Total:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right"> '.$total.'</div></td></tr>';
	/*echo '<tr><td width="700"><div align="right">已付 Paid:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">'.$refund.'</div></td></tr>';
	echo '<tr><td width="700"><div align="right">Change:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">400</div></td></tr>';
	*/
	echo "</table>";
?>
