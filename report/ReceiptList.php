<?php 
	global $db;
	$list = mysql_query("select product_no, description, qty, discount, price,goodstype,product_id from invoice inv, invoicedetail inde where inv.invoice_no = inde.invoice_no and inv.invoice_no=".$receipt_No);
	$sql_paid = mysql_query("select payment_no, money from payment_has_invoice where invoice_no='".$receipt_No."'");
	$payment_method = mysql_result($sql_paid,0,0);
	$paid = mysql_result($sql_paid,0,1);
	$ta = 0;
	echo '<table width="1000" border="0">';
    echo '<tr>';
	echo '<td width="200">編號<br>CODE</td>';
    echo '<td width="400">產品資料<br>PRODUCT DESCRIPTION</td>';
    echo '<td width="68"><div align="center">數量<br>QTY</div></td>';
    echo '<td width="100"><div align="right">單價<br>UNIT PRICE</div></td>';
    echo '<td width="100"><div align="right">折扣<br>DISCOUNT</div></td>';
    echo '<td width="130"><div align="right">金額<br>AMOUNT HKD</div></td>';
    echo '</tr>';
	echo '</table>';
	echo '<hr>';
	
	for($i=0; $i<mysql_num_rows($list); $i++){
		$goodstype = mysql_result($list,$i,5);
		$goodscode = mysql_result($list,$i,0);
		$product_id = mysql_result($list,$i,6);
		
		echo '<table width="1000" border="0">';
		echo "<tr>";
		if ($goodstype == 1){
			echo '<td width="200" id="code"><div align="left">'.mysql_result($list,$i,6).'</div></td>';
		} else
			echo '<td width="200" id="code"><div align="left">'.mysql_result($list,$i,0).'</div></td>';
			
		if ($goodstype == 1){
			echo '<td width="400" id="name"><div align="left">'.mysql_result($list,$i,1).' <br>IMEI : '.mysql_result($list,$i,0).' </div></td>';
		} else
			echo '<td width="400" id="name"><div align="left">'.mysql_result($list,$i,1).'</div></td>';
			
		echo '<td width="68" id="qty"><div align="center">'.$q=mysql_result($list,$i,2).'</div></td>';
		echo '<td width="100" id="unitPrice"><div align="right">'.$p=mysql_result($list,$i,4).'</div></td>';
		echo '<td width="100" id="discount"><div align="right">'.$d=mysql_result($list,$i,3).'</div></td>';
		if($d==0){
		echo '<td width="130" id="amount"><div align="right">'.number_format($a=$q*$p,1,'.','').'</div></td>';
		}else{
			//echo '<td width="130" id="amount"><div align="right">'.number_format($a=$q*$p-$d,1,'.','').'</div></td>';
			//$smallTotal = ($row['price']-$row['discount'])*$row['qty']; //小計
			echo '<td width="130" id="amount"><div align="right">'.number_format($a=$q*($p-$d),1,'.','').'</div></td>';
		}
		$ta+=$a;
		echo "</tr>";
		echo "</table>";
		
		echo "<style>
					#phonedesc td{
						/*border-bottom:1px solid black;*/
					}
				</style>";
		
	}
	
	echo "<br />";
	echo '<table width="900" border="0">';
	echo '<tr><td width="700"><div align="right">銷售總額 :</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">'. number_format($ta, 1, '.', '') .'</div></td></tr>';
	echo '<tr><td width="700"><div align="right">合計金額 Total:</div></td>';
		echo '<td width="100"><div align="left">$HKD</div></td>';
		echo '<td width="100" id="total"><div align="right">'.$total.'</div></td></tr>';
	echo '<tr border="1"><td width="700"><div align="right">已付 Paid:</div></td>';
	for($j=0; $j<mysql_num_rows($sql_paid); $j++){
		switch($payment_method){
			case "1":
				echo '<td width="100"><div align="left">Cash-in $HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$paid.'</div></td></tr>';
				break;
			case "2":
				echo '<td width="100"><div align="left">EPS $HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$paid.'</div></td></tr>';
				break;
			case "3":
				echo '<td width="100"><div align="left">信用卡 $HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$paid.'</div></td></tr>';
				break;
			case "4":
				echo '<td width="100"><div align="left">八逹通 $HKD</div></td>';
				echo '<td width="100" id="total"><div align="right">'.$paid.'</div></td></tr>';
				break;
		}
	}
	echo "</table>";
	
	
		if ($goodstype == 1 && $product_id=='11901PB'){ //if is phone
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
			echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
			echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
			echo '<tr><td>1. 牌子 ( Brand ): </td><td>Nokia</td></tr>';
			echo '<tr><td>2. 產品型號 ( Model ):</td><td>Nokia 100</td></tr>';
			echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
			echo '<tr><td>4. 頻率 ( Frequency) :</td><td>GSM 900 / 1800</td></tr>';
			echo '<tr><td>5. 規格 ( Specification ): </td><td>1.8 吋 TFT主螢幕</td></tr>';
			echo '<tr><td></td><td>Symbian S30 作業系統</td></tr>';
			echo '<tr><td></td><td>內建FM收音機, 8.0MB 記憶體及LED手電筒功能</td></tr>';
			echo '<tr><td>6. 配件 ( Accessory ) </td><td>Nokia High-Efficiency Charger AC - 11X </td></tr>';
			echo '<tr><td></td><td>Nokia Battery BL-5CB </td></tr>';
			echo '<tr><td></td><td>Nokia 3.5mm Stereo Headset WH-102</td></tr>';
			echo '<tr><td></td><td>快速指南、用戶指南與產品資訊說明頁</tr>';
			echo '<tr><td>7. 保養期限 ( Warranty ) :</td><td>一年</td></tr>';
			echo '<tr><td>8. 維修商名稱 ( Warranty Provider ) :</td><td>NOKIA</td></tr>';
			echo '<tr><td>9. 維修地址 ( Repair Center Address ) :</td><td>九龍旺角登打士街56號柏裕商業中心910-14室</td></tr>';
			echo '<tr><td></td><td>﹙港鐵油麻地站A2出口﹚</td></tr>';

			echo '</table>';
		}
	
	
?>
