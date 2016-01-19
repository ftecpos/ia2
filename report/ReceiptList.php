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
                $product_no = mysql_result($list,$i,0);
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
		$unit_price = $p=mysql_result($list,$i,4);
                if($product_no=='Jabra BT2046' or $product_id=='SH930W'){
                    $unit_price = '--';
                }
                echo '<td width="100" id="unitPrice"><div align="right">'.$unit_price.'</div></td>';
                $discount = $d=mysql_result($list,$i,3);
                if($product_no=='Jabra BT2046' or $product_id=='SH930W'){
                    $discount = '--';
                }
		echo '<td width="100" id="discount"><div align="right">'.$discount.'</div></td>';
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
            if ($goodstype == 0 && $product_no=='Jabra BT2046'){ //if is acc
                echo '<br>';
                echo '<br>';
                echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
                echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
                echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
                echo '<tr><td>1. 牌子 ( Brand ): </td><td>Jabra</td></tr>';
                echo '<tr><td>2. 產品型號 ( Model ):</td><td>BT2046</td></tr>';
                echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
                echo '<tr><td>4. 藍芽耳筒 ( Bluetooth ) :</td><td>Bluetooth Headset</td></tr>';
                echo '<tr><td>5. 規格 ( Specification ): </td><td>支援藍牙無線連接</td></tr>';
                echo '<tr><td></td><td>支援藍牙2.1版本</td></tr>';
                echo '<tr><td></td><td>自動配對</td></tr>';
                echo '<tr><td></td><td>微型USB 充電接口</td></tr>';
                echo '<tr><td></td><td>同時連接2個藍芽裝置</td></tr>';
                echo '<tr><td>6. 保養期限 ( Warranty ) :</td><td>二年保養</td></tr>';
                echo '<tr><td>7. 維修商名稱 ( Warranty Provider ) :</td><td>Jos Distribution</td></tr>';
                echo '<tr><td>8. 維修地址 ( Repair Center Address ) :</td><td>觀塘海濱道173號申新大廈2樓</td></tr>';
                echo '</table>';
            }
	    if ($goodstype == 0 && $product_no=='IHAVE_6000MAH/YL'){ //if is acc
                echo '<br>';
                echo '<br>';
                echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
                echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
                echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
                echo '<tr><td>1. 牌子 ( Brand ): </td><td>ihave</td></tr>';
                echo '<tr><td>2. 產品型號 ( Model ):</td><td>Delta Power Bank 6000mAh</td></tr>';
                echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
                echo '<tr><td>4. 規格 ( Specification ): </td><td>Output Voltage: 2.1A/5V</td></tr>';
                echo '<tr><td></td><td>Input Voltage: 1.0A/5V</td></tr>';
                echo '<tr><td>5. 維修商名稱 ( Warranty Provider): </td><td>GCI Ltd .</td></tr>';
                echo '<tr><td>6. 維修地址 (Repair Center Address):</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
                echo '<tr><td>7. 保養(Warranty):</td><td>一年</td></tr>';
                echo '</table>';
            }
            if ($goodstype == 0 && $product_no=='IHAVE_6000MAH/PK'){ //if is acc
                echo '<br>';
                echo '<br>';
                echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
                echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
                echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
                echo '<tr><td>1. 牌子 ( Brand ): </td><td>ihave</td></tr>';
                echo '<tr><td>2. 產品型號 ( Model ):</td><td>Delta Power Bank 6000mAh</td></tr>';
                echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
                echo '<tr><td>4. 規格 ( Specification ): </td><td>Output Voltage: 2.1A/5V</td></tr>';
                echo '<tr><td></td><td>Input Voltage: 1.0A/5V</td></tr>';
                echo '<tr><td>5. 維修商名稱 ( Warranty Provider): </td><td>GCI Ltd .</td></tr>';
                echo '<tr><td>6. 維修地址 (Repair Center Address):</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
                echo '<tr><td>7. 保養(Warranty):</td><td>一年</td></tr>';
                echo '</table>';
            }
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
        if ($goodstype == 1 && $product_id=='SH837'){ //if is phone
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
            echo '<tr><td>1. 牌子 ( Brand ): </td><td> </td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Sh 837 W</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 頻率 ( Frequency) :</td><td>HSDPA / WCDMA / GSM 900/1800/1900 3.5G 雙制式三頻</td></tr>';
            echo '<tr><td>5. 規格 ( Specification ): </td><td>1.2GHz 雙核心處理器</td></tr>';
            echo '<tr><td></td><td>1280 x 720 pixels (4.7 吋)</td></tr>';
            echo '<tr><td></td><td>1600 萬色 Super Clear LCD 螢幕</td></tr>';
            echo '<tr><td></td><td>800 萬像素 CMOS 鏡頭 (3264 x 2448 pixels)</td></tr>';
            echo '<tr><td></td><td>130 萬像素 CMOS 鏡頭</td></tr>';
            echo '<tr><td></td><td>外置Micro-SD</td></tr>';
            echo '<tr><td></td><td>1GB RAM、4GB 內存</td></tr>';
            echo '<tr><td></td><td>鋰電池 (1900 mAh)</td></tr>';
            echo '<tr><td>6. 配件 ( Accessory ) </td><td>Charger x1</td></tr>';
            echo '<tr><td></td><td>Battery x1</td></tr>';
            echo '<tr><td></td><td>3.5mm stereo Headser x1</td></tr>';
            echo '<tr><td></td><td>快速指南, 用戶指南與產哈說明資訊說明頁</tr>';
            echo '<tr><td>7. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>8. 維修商名稱 ( Warranty Provider ) :</td><td>Brighstar Aisa Ltd</td></tr>';
            echo '<tr><td>9. 維修地址 ( Repair Center Address ) :</td><td>旺角西洋菜街2A-2H號銀地廣場12樓12505-1206室</td></tr>';
            //echo '<tr><td></td><td>﹙港鐵油麻地站A2出口﹚</td></tr>';

            echo '</table>';
        }
        if ($goodstype == 1 && $product_id=='SH930W'){ //if is phone for product SH930W
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
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Sharp</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>SH930W</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 頻率 ( Frequency) :</td><td>GSM Quad Band (850/900/1800/1900), UMTS/HSDPA Bands(900/1900/2100)</td></tr>';
            echo '<tr><td>5. 規格 ( Specification ): </td><td>Dual Core 1.5GHz, 2GB RAM, 32GB ROM</td></tr>';
            echo '<tr><td></td><td>5”Full HD 1920 X 1080 TFT Screen, 443 ppi AQUOS</td></tr>';
            echo '<tr><td></td><td>800 萬像素後鏡頭 , 200 萬像素前置鏡頭</td></tr>';
            echo '<tr><td>6. 配件 ( Accessory ) </td><td>Charger x1</td></tr>';
            echo '<tr><td></td><td>Battery x1</td></tr>';
            echo '<tr><td></td><td>3.5mm stereo Headser x1</td></tr>';
            echo '<tr><td>7. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>8. 維修商名稱 ( Warranty Provider ) :</td><td>Brighstar Aisa Ltd</td></tr>';
            echo '<tr><td>9. 維修地址 ( Repair Center Address ) :</td><td>旺角西洋菜街2A-2H號銀地廣場12樓12505-1206室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 && $product_no=='XPR6000BK'
            || $product_no=='XPR6000PK'
            || $product_no=='XPR6000LP'
            || $product_no=='XPR6000WH'
            || $product_no=='XPR6000BL'
            || $product_no=='XPR6000DP'
            || $product_no=='XPR6000PP'
                ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>XPR6000</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>顏色(Color): 黑/白/淺紫/粉紅/藍/深紫</td></tr>';
            echo '<tr><td></td><td>電量(Capacity): 6000Mah</td></tr>';
            echo '<tr><td></td><td>輸入(Input): 5V – 1A</td></tr>';
            echo '<tr><td></td><td>輸出 1(Output 1) : 5V – 1A</td></tr>';
            echo '<tr><td></td><td>輸出 2(Output 2):  5V – 2.1A</td></tr>';
            echo '<tr><td></td><td>重量(Weight): 146 g</td></tr>';
            echo '<tr><td></td><td>尺寸(Dimension): 126*61*15.6mm</td></tr>';
            echo '<tr><td></td><td>特色(feature): Build in micro cable</td></tr>';
            echo '<tr><td></td><td>超薄機身, 3.1A Output</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        //2015-04-20
        if ($goodstype == 0 
            && $product_no=='XPOW_HUBs_10P_WH'
            || $product_no=='XPOW_HUBs_10P_BK'
                ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpower 10 USB ports charger</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>顏色(Color): 黑/白</td></tr>';
            echo '<tr><td></td><td>智能充電技術，根據不同裝置自動分配最大電力輸出</td></tr>';
            echo '<tr><td></td><td>120W超大功率輸出。超高輸出: 5V/24A(2.4A x 10Max)</td></tr>';
            echo '<tr><td></td><td>10 USB輸出: 支援10個裝置同時充電</td></tr>';
            echo '<tr><td></td><td>可極速(2.4A)充10部iPad/Tablet</td></tr>';
            echo '<tr><td></td><td>附送純銅高速充電伸縮線</td></tr>';
            echo '<tr><td></td><td>提供過流保護、過壓保護、短路保護、智能限流等</td></tr>';
            echo '<tr><td></td><td>防火ABS物料，安全可靠</td></tr>';
            echo '<tr><td></td><td>充電器尺寸: 137 x 69 x 25mm</td></tr>';
            echo '<tr><td></td><td>香港機電工程署測試編號:IEC60950-1:2005+A1:2009+A2:2013</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
	if ($goodstype == 0 
            && $product_no=='XPOW_PowerB_13000_WH'
            || $product_no=='XPOW_PowerB_13000_BK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpower 13000mAh power bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>顏色(Color): 黑/白</td></tr>';
            echo '<tr><td></td><td>電量(Capacity): 13000mAh</td></tr>';
            echo '<tr><td></td><td>輸出: Max 3.4A Output</td></tr>';
            echo '<tr><td></td><td>。內置 Micro USB 插頭，簡單易用</td></tr>';
            echo '<tr><td></td><td>。尊貴彷皮革物料及華麗電鍍邊框</td></tr>';
            echo '<tr><td></td><td>。採用高質原廠韓國LG鋰聚合物電池 (Li-Polymer)</td></tr>';
            echo '<tr><td></td><td>。最高 3.4A 極速輸出及 2.1A 輸入</td></tr>';
            echo '<tr><td></td><td>。雙輸出，可同時為 2 部手機充電</td></tr>';
            echo '<tr><td></td><td>。內置智慧晶片(防過充,過放,過熱保護)</td></tr>';
            echo '<tr><td></td><td>。具備 CE , FC , RoHS 安全認證</td></tr>';
            echo '<tr><td></td><td>。尺寸: 163 x 73 x 15mm</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='XPOW_PowerB_X5_WT'
            || $product_no=='XPOW_PowerB_X5_BL'
            || $product_no=='XPOW_PowerB_X5_BK'
            || $product_no=='XPOW_PowerB_X5_PK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpower X5 2.4A Ultra High Speed Power Bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>容量: 5000mAh</td></tr>';
            echo '<tr><td></td><td>輸出: Max 2.4A Output</td></tr>';
            echo '<tr><td></td><td>。內置 Micro USB 插頭，簡單易用</td></tr>';
            echo '<tr><td></td><td>。超薄 13mm 輕巧設計，方便攜帶</td></tr>';
            echo '<tr><td></td><td>。採用高質三洋 SANYO 聚合物鋰電池(Li-Polymer)</td></tr>';
            echo '<tr><td></td><td>。最高 2.4A 極速輸出及 1.5A 輸入</td></tr>';
            echo '<tr><td></td><td>。雙 USB 輸出，可同時為 2 部裝置充電</td></tr>';
            echo '<tr><td></td><td>。內置智慧晶片(防過充,過放,過熱保護)</td></tr>';
            echo '<tr><td></td><td>。具備CE, FC, RoHS安全認證</td></tr>';
            echo '<tr><td></td><td>。尺寸: 106 x 62 x 13mm</td></tr>';
            echo '<tr><td></td><td>。重量: 110g</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
	
        if ($goodstype == 0 
            && $product_no=='XP-11000WH'
            || $product_no=='XP-11000BK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpower 11000mAh Power Bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>容量: 11000mAh</td></tr>';
            echo '<tr><td></td><td>輸出: Max 3.4A Output</td></tr>';
            echo '<tr><td></td><td>。獨特觸控式開關</td></tr>';
            echo '<tr><td></td><td>。尊貴彷皮革物料及華麗電鍍邊框</td></tr>';
            echo '<tr><td></td><td>。採用高質聚合物鋰電池(Li-Polymer)</td></tr>';
            echo '<tr><td></td><td>。最高 3.4A 極速輸出及 1.5A 輸入</td></tr>';
            echo '<tr><td></td><td>。雙 USB 輸出，可同時為 2 部手機充電</td></tr>';
            echo '<tr><td></td><td>。內置智慧晶片(防過充,過放,過熱保護)</td></tr>';
            echo '<tr><td></td><td>。具備 CE , FC , RoHS 安全認證</td></tr>';
            echo '<tr><td></td><td>。尺寸: 144 x 75.2 x 14mm</td></tr>';
            echo '<tr><td></td><td>。重量: 236g</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='XPOW_PowerB_X6_GD'
            || $product_no=='XPOW_PowerB_X6_PK'
            || $product_no=='XPOW_PowerB_X6_BL'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpower X6 2.4A Aluminium Alloy Power Bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>。特點：鋁合金物料，高貴耐用，內置智慧晶片(防過充,過放,過熱保護)、內置 LED 電筒</td></tr>';
            echo '<tr><td></td><td>。容量：6000mAh</td></tr>';
            echo '<tr><td></td><td>。電芯：原廠 Samsung SDI 電池</td></tr>';
            echo '<tr><td></td><td>。輸出：Max 2.4A Output</td></tr>';
            echo '<tr><td></td><td>。輸入：5V/ 1.5A</td></tr>';
            echo '<tr><td></td><td>。尺寸：100 x 54 x 22mm</td></tr>';
            echo '<tr><td></td><td>。重量：172g</td></tr>';
            echo '<tr><td></td><td>。具備 CE , FC , RoHS 安全認證</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='ANKER_HUBs_BK'
            || $product_no=='ANKER_HUBs_WT'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>ANKER</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>40W 5-Port Family-Sized Desktop USB Charger (PowerIQ™ Technology)</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>特點: PowerIQ 智能技術，根據不同裝置自動分配最大電力輸出、5 x USB 輸出、最高8A</td></tr>';
            echo '<tr><td></td><td>輸出、輕巧迷你</td></tr>';
            echo '<tr><td></td><td>5 x USB 輸出: 5V/8A (Max)</td></tr>';
            echo '<tr><td></td><td>輸入: AC 100-240V</td></tr>';
            echo '<tr><td></td><td>尺寸: 91*58*26mm (L*W*H)</td></tr>';
            echo '<tr><td></td><td>重量: 130 克</td></tr>';
            echo '<tr><td></td><td>顏色: black, white</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='ANKER_PowerB_2ndAst3_BK'
            || $product_no=='ANKER_PowerB_2ndAst3_WT'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>ANKER</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>2nd Gen. Astro 3 External Battery Charger</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>特點: PowerIQ 智能技術，根據不同裝置自動分配最大電力輸出、極速充電(2A 輸入)、3 X USB 輸出、最高 4A 輸出</td></tr>';
            echo '<tr><td></td><td>容量: 12000 mAh</td></tr>';
            echo '<tr><td></td><td>3 x USB 輸出: 5V/4A (Max)</td></tr>';
            echo '<tr><td></td><td>Mirco USB 輸入: 5V/2A (Max)</td></tr>';
            echo '<tr><td></td><td>尺寸: 111*83*26mm (L*W*H)</td></tr>';
            echo '<tr><td></td><td>重量: 300 克</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='Ver_PowerB_6000mAh_PP'
            || $product_no=='Ver_PowerB_6000mAh_BK'
            || $product_no=='Ver_PowerB_6000mAh_SL'
            || $product_no=='Ver_PowerB_6000mAh_GD'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Verbatim</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Verbatim 6000mAh Li-Polymer Power Pack</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>•電池種類： 鋰離子聚合物電池</td></tr>';
            echo '<tr><td></td><td>•電池容量： 6000mAh</td></tr>';
            echo '<tr><td></td><td>•輸出： DC 5V/2.5A</td></tr>';
            echo '<tr><td></td><td>•輸入： DC 5V/1.5A</td></tr>';
            echo '<tr><td></td><td>•運作溫度： 0°C - 40°C</td></tr>';
            echo '<tr><td></td><td>•可用回數： 500回</td></tr>';
            echo '<tr><td></td><td>•保固期： 1年</td></tr>';
            echo '<tr><td></td><td>•內附： 鈍銅microUSB 充電傳輸線 (20cm) x 1</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>RMA 維修服務中心</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>Room 1303-1304, Kwai Hung Holdings Centre, 89, King\'s Road, North Point, HK</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='Le_touch_8400_BK'
            || $product_no=='Le_touch_8400_RD'
            || $product_no=='Le_touch_8400_GR'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Le Touch</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Le Touch 8400mAH dual usb 2.1a Power Bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>顏色(Color): 黑/紅/綠</td></tr>';
            echo '<tr><td></td><td>電量(Capacity): 8400 Mah</td></tr>';
            echo '<tr><td></td><td>輸入(Input): 5V – 1A</td></tr>';
            echo '<tr><td></td><td>輸出(Output): 5V-2.1A</td></tr>';
            echo '<tr><td></td><td>輸出2(Output2): 2.1A</td></tr>';
            echo '<tr><td></td><td>重量(Weight): 180G</td></tr>';
            echo '<tr><td></td><td>尺寸(Dimension): 97x60x27mm</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='iFans_Car_5.1_SL'
            || $product_no=='iFans_Car_5.1_GD'
            || $product_no=='iFans_Car_5.1_BL'
            || $product_no=='iFans_Car_5.1_RD'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>iFans</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>iFans 3USB output Car Charger EL-IP4-C06  (5.1A)</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>3 USB 插口,5.1A輸出,快速充電,輸入:DC12-18V,輸出:  5.0V,尺寸: 35*24*60mm</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        //2015-06-16
        if ($goodstype == 1 && $product_id=='10801'){ //if is phone for product E1085T
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
            echo '<tr><td>1. 牌子 ( Brand )：</td><td>Samsung</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model )：</td><td>E1085T</td></tr>';
            echo '<tr><td>3. 產地 ( Original County )：</td><td>China</td></tr>';
            echo '<tr><td>4. 頻率 ( Frequency)：</td><td>雙頻GSM（900/1800MHz）</td></tr>';
            echo '<tr><td>5. 規格 ( Specification )：</td><td>重量：64.5克</td></tr>';
            echo '<tr><td></td><td>體積：107.4（長）x 45.4（闊）x 13.6（深）毫米</td></tr>';
            echo '<tr><td></td><td>顯示屏幕：1.43吋6萬5千色CSTN彩色屏幕</td></tr>';
            echo '<tr><td></td><td>顯示屏幕像素：128x128像素</td></tr>';
            echo '<tr><td></td><td>顯示屏幕尺寸：1.43吋</td></tr>';
            echo '<tr><td></td><td>電池  :通話時間：長達9小時</td></tr>';
            echo '<tr><td></td><td>備用時間：(標準電池)</td></tr>';
            echo '<tr><td></td><td>備用時間：長達560小時</td></tr>';
            echo '<tr><td>6. 配件 ( Accessory ) </td><td>鋰電池 x1</td></tr>';
            echo '<tr><td></td><td>數據線 x1</td></tr>';
            echo '<tr><td></td><td>耳機 x1</td></tr>';
            echo '<tr><td></td><td>充電器 x1</td></tr>';
            echo '<tr><td></td><td>說明書 x1</td></tr>';
            echo '<tr><td>7. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>8. 維修商名稱 ( Warranty Provider ) :</td><td>Phone On Line</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 1 && $product_id=='10802BK'){ //if is phone for product 10802BK
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
            echo '<tr><td>1. 牌子 ( Brand )：</td><td>Samsung</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model )：</td><td>E1252 BK</td></tr>';
            echo '<tr><td>3. 產地 ( Original County )：</td><td>China</td></tr>';
            echo '<tr><td>4. 頻率 ( Frequency)：</td><td>雙頻GSM（900/1800MHz）</td></tr>';
            echo '<tr><td>5. 規格 ( Specification )：</td><td>重量：76.7克</td></tr>';
            echo '<tr><td></td><td>體積：112.7（長）x 46.65（闊）x 13.9（深）毫米</td></tr>';
            echo '<tr><td></td><td>顯示屏幕：TFT彩色屏幕</td></tr>';
            echo '<tr><td></td><td>顯示屏幕像素：26萬色(128 x 160像素)</td></tr>';
            echo '<tr><td></td><td>顯示屏幕尺寸：2.0吋</td></tr>';
            echo '<tr><td></td><td>電池  :通話時間：高達11小時</td></tr>';
            echo '<tr><td></td><td>備用時間：(標準電池)</td></tr>';
            echo '<tr><td></td><td>備用時間：長達620小時</td></tr>';
            echo '<tr><td>6. 配件 ( Accessory ) </td><td>鋰電池 x1</td></tr>';
            echo '<tr><td></td><td>數據線 x1</td></tr>';
            echo '<tr><td></td><td>耳機 x1</td></tr>';
            echo '<tr><td></td><td>充電器 x1</td></tr>';
            echo '<tr><td></td><td>說明書 x1</td></tr>';
            echo '<tr><td>7. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>8. 維修商名稱 ( Warranty Provider ) :</td><td>Phone On Line</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='adam power 5000mahpowerbank_BL'
            || $product_no=='adam power 5000mahpowerbank_GN'
            || $product_no=='adam power 5000mahpowerbank_PP'
            || $product_no=='adam power 5000mahpowerbank_RD'
            || $product_no=='adam power 5000mahpowerbank_YL'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Adam</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Adam Power wireless charger (5000 mAh)</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>Taiwan</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>Battery type: Rechargeable litium-ion polymer battery</td></tr>';
            echo '<tr><td></td><td>Battery Capacity: 5000mAh/ 18.4 Wh</td></tr>';
            echo '<tr><td></td><td>Power input: 5V/ 2A</td></tr>';
            echo '<tr><td></td><td>Power output: 5V/ 2.4A Max</td></tr>';
            echo '<tr><td></td><td>Wireless 5V/ 1A</td></tr>';
            echo '<tr><td></td><td>Charge time Approx. 2 hours</td></tr>';
            echo '<tr><td></td><td>Product weight: approx 150g</td></tr>';
            echo '<tr><td></td><td>Compatible with qi (Wireless Charge)</td></tr>';
            echo '<tr><td></td><td>Accessories: Micro-USB cable</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>Global communication international</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>Rm 701, 7/F, Sun Cheong Industrial Bldg, 1 Cheung Shun Street, Lai Chi Kok, Kln.</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='Xpow_DuoCable_GD'
            || $product_no=='Xpow_DuoCable_BL'
            || $product_no=='Xpow_DuoCable_PP'
            || $product_no=='Xpow_DuoCable_BK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower lighting+micro duo cable</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>APPLE MFI 認證</td></tr>';
            echo '<tr><td></td><td>24AWG 線芯充電( 支援2.4A 輸出)</td></tr>';
            echo '<tr><td></td><td>30AWG Micro + Lightning 2 in 1高速傳輸USB</td></tr>';
            echo '<tr><td></td><td>USB接頭採用尊貴鋁合金物料</td></tr>';
            echo '<tr><td></td><td>防干擾高密度6 芯尼龍編織線身</td></tr>';
            echo '<tr><td></td><td>MAX. 2.4A快速充電</td></tr>';
            echo '<tr><td></td><td>具備資料傳輸功能</td></tr>';
            echo '<tr><td></td><td>長度: 25CM</td></tr>';
            echo '<tr><td></td><td>黑, 金, 籃, 紫*</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>二年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='AHHA_Car_WH'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Ahha</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Ahha Dual USB Car Charger kit with sync and charge cable 1.2m</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>Maximum output: 5V DC 2.4A</td></tr>';
            echo '<tr><td></td><td>12/24V DC input</td></tr>';
            echo '<tr><td></td><td>LED power indicator</td></tr>';
            echo '<tr><td></td><td>Overcharge fail-safe protection</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        if ($goodstype == 0 
            && $product_no=='XPow_Alluminium1.2m_BK'
            || $product_no=='XPow_Alluminium1.2m_GD'
            || $product_no=='XPow_Alluminium1.2m_BL'
            || $product_no=='XPow_Alluminium1.2m_PP'
            || $product_no=='XPow_Alluminium1.2m_PK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower Alluminium 1.2m cable</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>24AWG 線芯充電(支援2.4A 輸出)</td></tr>';
            echo '<tr><td></td><td>USB接頭採用雙面USB正反抽插 +尊貴鋁合金物料+鈑24K鍍金物料</td></tr>';
            echo '<tr><td></td><td>2.4A快速充電</td></tr>';
            echo '<tr><td></td><td>具備資料傳輸功能</td></tr>';
            echo '<tr><td></td><td>長度: 1.2 米</td></tr>';
            echo '<tr><td></td><td>5 隻金屬顏色任君選擇</td></tr>';
            echo '<tr><td></td><td>(Black, Blue, Gold, Pink, Purple)</td></tr>';
            echo '<tr><td></td><td>* 一年保用, 30日內有壞一換一保證</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='Ver_5200_BK'
            || $product_no=='Ver_5200_PK'
            || $product_no=='Ver_5200_PP'
            || $product_no=='Ver_5200_LB'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Verbatim</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Verbatim 5200 mAh power bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>電池種類: Li-ion</td></tr>';
            echo '<tr><td></td><td>容量: 5200mAh</td></tr>';
            echo '<tr><td></td><td>輸出: DC5V/2.5A</td></tr>';
            echo '<tr><td></td><td>輸入: DC5V/2A</td></tr>';
            echo '<tr><td></td><td>體積: 98mm x 47mm x 24mm (L x W x H)</td></tr>';
            echo '<tr><td></td><td>淨重: 128g</td></tr>';
            echo '<tr><td></td><td>運作溫度: 0℃- 40℃</td></tr>';
            echo '<tr><td></td><td>可用回數: 500 cycles</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>Verbatim customer service</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>北角英皇道89號桂洪集團中心1304室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='Ver_Andriodduocable_PP'
            || $product_no=='Ver_Andriodduocable_GY'
            || $product_no=='Ver_Andriodduocable_LB'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Verbatim</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Verbatim MicroUSB Cable 2 pcs Se</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>產品尺寸: 1225 x 14.8 x 7.9毫米 (L x W x H) 及 </td></tr>';
            echo '<tr><td></td><td>225 x 14.8 x 7.9毫米(L x W x H)</td></tr>';
            echo '<tr><td></td><td>產品淨重: 39克</td></tr>';
            echo '<tr><td></td><td>包裝尺寸: 115 x 30 x 175毫米 (W x D x H)</td></tr>';
            echo '<tr><td></td><td>包裝重量: 78.3克</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>Verbatim customer service</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>北角英皇道89號桂洪集團中心1304室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='Sky_1.2mLightingcable_GY'
            || $product_no=='Sky_1.2mLightingcable_GD'
            || $product_no=='Sky_1.2mLightingcable_SL'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Sky Power</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Sky Power 1.2m lighting cable</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>- Compatible with all lightning USB interface smartphones and tablets</td></tr>';
            echo '<tr><td></td><td>- Pure Copper wire inside for higher efficient of transfer (24 AWG)</td></tr>';
            echo '<tr><td></td><td>- Support both power charging and data transfer</td></tr>';
            echo '<tr><td></td><td>- Supports up to 2.4A current with faster power charging</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='XPR_LAA_0.5M_GD'
            || $product_no=='XPR_LAA_0.5M_PP'
            || $product_no=='XPR_LAA_0.5M_PK'
            || $product_no=='XPR_LAA_0.5M_BL'
            || $product_no=='XPR_LAA_0.5M_BK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower Xpro 0.5M Aluminium Alloy Lighting Cable</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>USB接頭採用雙面USB正反抽插 +尊貴鋁合金物料+鈑24K鍍金物料</td></tr>';
            echo '<tr><td></td><td>防干擾高密度尼龍編織線身+高純度銅線導體</td></tr>';
            echo '<tr><td></td><td>2.4A快速充電</td></tr>';
            echo '<tr><td></td><td>具備資料傳輸功能</td></tr>';
            echo '<tr><td></td><td>長度: 0.5 米</td></tr>';
            echo '<tr><td></td><td>5 隻金屬顏色任君選擇</td></tr>';
            echo '<tr><td></td><td>(Black, Blue, Gold, Pink, Purple)</td></tr>';
            echo '<tr><td></td><td>6個月保用, 14日內有壞一換一保證</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>6 months</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        
        if ($goodstype == 0 
            && $product_no=='X_POW_X4PA_BK'
            || $product_no=='X_POW_X4PA_WH'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower X4PA 30W 6A 4-Port USB Smart Charger</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>智能充電技術,根據不同裝置自動分配最大電力輸出</td></tr>';
            echo '<tr><td></td><td>最大30W 6A 4-Port輸出</td></tr>';
            echo '<tr><td></td><td>超高輸出: 5V/6A (Smart IC)</td></tr>';
            echo '<tr><td></td><td>4 USB輸出: 支援4個裝置同時充電</td></tr>';
            echo '<tr><td></td><td>提供遇流保護, 遇壓保護, 短路保護, 智能限流等</td></tr>';
            echo '<tr><td></td><td>充電器尺寸: 63x73x27mm</td></tr>';
            echo '<tr><td></td><td>高質橡膠表面及鋁合金外框*(只限黑色)</td></tr>';
            echo '<tr><td></td><td>顏色:黑銀/黑藍/黑紫/白金</td></tr>';
            echo '<tr><td></td><td>香港機電工程署測試編號: IEC60950-1:2005+A1:2009+A2:2013</td></tr>';
            echo '<tr><td></td><td>30日內有壞一換一,1年保養</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='X_POW_XP4100_GD'
            || $product_no=='X_POW_XP4100_SL'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower X4PA 30W 6A 4-Port USB Smart Charger</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>容量: 4,100mAh </td></tr>';
            echo '<tr><td></td><td>輸出: Max 2.4A Output</td></tr>';
            echo '<tr><td></td><td>具備蘋果官方認證,支援任何版本IOS高速充電</td></tr>';
            echo '<tr><td></td><td>超薄7.5mm仿iPhone 6設計,外形高貴時尚</td></tr>';
            echo '<tr><td></td><td>內置MFi Lightning 充電線, 輕鬆便攜</td></tr>';
            echo '<tr><td></td><td>4,100mAh鋰聚合物電池(Li-Polymer)</td></tr>';
            echo '<tr><td></td><td>具備UL/FCC/CE認證,安全可靠</td></tr>';
            echo '<tr><td></td><td>支援5V/2.4A高速輸入</td></tr>';
            echo '<tr><td></td><td>高質耐用鋁合金物料</td></tr>';
            echo '<tr><td></td><td>顏色:灰/金/銀</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='X_POW_XP8Q_BK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower XP8Q 3.4A Quick Charger Power Bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>容量: 8,000mAh</td></tr>';
            echo '<tr><td></td><td>Qualcomm Quick Charge 2.0快速充電技術*</td></tr>';
            echo '<tr><td></td><td>手機充電時間快75%</td></tr>';
            echo '<tr><td></td><td>輸出:5V/2.4A(A port)/ 5V/2.4A or 9V/2A or 12V/1.5A (QC port)</td></tr>';
            echo '<tr><td></td><td>8,000mAh大容量鋰聚合物電池(Li-Polymer)</td></tr>';
            echo '<tr><td></td><td>具備CE/FCC/ROHS認證,安全可靠</td></tr>';
            echo '<tr><td></td><td>支援5V/2.2A高速輸入</td></tr>';
            echo '<tr><td></td><td>高質耐用鋁合金物料</td></tr>';
            echo '<tr><td></td><td>顏色:黑</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        
        if ($goodstype == 0 
            && $product_no=='XPow_Alluminium2m_bk'
            || $product_no=='XPow_Alluminium2m_gd'
            || $product_no=='XPow_Alluminium2m_bl'
            || $product_no=='XPow_Alluminium2m_pp'
            || $product_no=='XPow_Alluminium2m_pk'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>GCI- Xpower Alluminium 2m cable</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>24AWG 線芯充電( 支援2.4A 輸出)</td></tr>';
            echo '<tr><td></td><td>USB接頭採用雙面USB正反抽插 +尊貴鋁合金物料+鈑24K鍍金物料</td></tr>';
            echo '<tr><td></td><td>2.4A快速充電</td></tr>';
            echo '<tr><td></td><td>具備資料傳輸功能</td></tr>';
            echo '<tr><td></td><td>長度: 2 米</td></tr>';
            echo '<tr><td></td><td>5 隻金屬顏色任君選擇</td></tr>';
            echo '<tr><td></td><td>(Black, Blue, Gold, Pink, Purple)</td></tr>';
            echo '<tr><td></td><td>一年保用, 30日內有壞一換一保證</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='3DX_6200_SL'
            || $product_no=='3DX_6200_PK'
            || $product_no=='3DX_6200_GD'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Fengenius</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Fengenius Power Color (3DX) 6200 mAh power bank</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>電池種類: li-polymer</td></tr>';
            echo '<tr><td></td><td>容量: 6200mAh</td></tr>';
            echo '<tr><td></td><td>輸出: DC5V/2.1A</td></tr>';
            echo '<tr><td></td><td>輸入: DC5V/0.5-2.1A</td></tr>';
            echo '<tr><td></td><td>體積: 120.8mm x 63mm x 16mm (L x W x H)</td></tr>';
            echo '<tr><td></td><td>淨重: 180g</td></tr>';
            echo '<tr><td></td><td>可用回數: 500 cycles</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>一年保養</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>飛達仕科技(深圳) 有限公司</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>香港九龍旺角亞皆老街62號利安大廈7樓62室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='XPR_LAAlighting_2M_GD'
            || $product_no=='XPR_LAAlighting_2M_BK'
            || $product_no=='XPR_LAAlighting_2M_BL'
            || $product_no=='XPR_LAAlighting_2M_PK'
            || $product_no=='XPR_LAAlighting_2M_PP'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpro</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpro_LAA_2M</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>Lightning cable</td></tr>';
            echo '<tr><td></td><td>usb接頭採用雙面USB正反插+尊貴鋁合金+鈑24K鍍金物料</td></tr>';
            echo '<tr><td></td><td>防干預高密尼龍編織線身+高純度鋼線導體</td></tr>';
            echo '<tr><td></td><td>2.4A 快速充電</td></tr>';
            echo '<tr><td></td><td>具備資料傳輸功能</td></tr>';
            echo '<tr><td></td><td>長度2米</td></tr>';
            echo '<tr><td></td><td>5色 (black/blue/gold/pink/purple)</td></tr>';
            echo '<tr><td></td><td>半年保養, 14日內一換一保證</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>半年</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>King Power international trading Ltd</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>Flat A9, 3/F, Block A, </td></tr>';
            echo '<tr><td></td><td>Hong Kong industrial centre, 489-491 castle peak roadm, lai chi kok, kowloon , Hond Kong</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='XPR_LAA_0.5M_GD'
            || $product_no=='XPR_LAA_0.5M_PP'
            || $product_no=='XPR_LAA_0.5M_PK'
            || $product_no=='XPR_LAA_0.5M_BL'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Xpower</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>Xpower Xpro 0.5M Aluminium Alloy Micro Cable</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>USB接頭採用雙面USB正反抽插 +尊貴鋁合金物料+鈑24K鍍金物料</td></tr>';
            echo '<tr><td></td><td>防干擾高密度尼龍編織線身+高純度銅線導體</td></tr>';
            echo '<tr><td></td><td>防干預高密尼龍編織線身+高純度鋼線導體</td></tr>';
            echo '<tr><td></td><td>2.4A 快速充電</td></tr>';
            echo '<tr><td></td><td>具備資料傳輸功能</td></tr>';
            echo '<tr><td></td><td>長度0.5米</td></tr>';
            echo '<tr><td></td><td>5色 (Black, Blue, Gold, Pink, Purple)</td></tr>';
            echo '<tr><td></td><td>6個月保用, 14日內有壞一換一保證</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>半年</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI / King Power</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='I_TECH_313_BT_YL'
            || $product_no=='I_TECH_313_BT_BL'
            || $product_no=='I_TECH_313_BT_PK'
            || $product_no=='I_TECH_313_BT_SL'
            || $product_no=='I_TECH_313_BT_PP'
            || $product_no=='I_TECH_313_BT_WH'
            || $product_no=='I_TECH_313_BT_BK'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>i.Tech</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>MY VOICE 313</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>1. 待機時間180小時</td></tr>';
            echo '<tr><td></td><td>2. 藍芽規格3.0</td></tr>';
            echo '<tr><td></td><td>3. 通話時間8小時</td></tr>';
            echo '<tr><td></td><td>4. 多點式，可連接兩部手機</td></tr>';
            echo '<tr><td></td><td>5. ONE TOUCH FOR CALL</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>半年</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>(A)   GLOBAL COMM INTERNATIONAL (G.C.I.) LIMITED</td></tr>';
            echo '<tr><td></td><td>(B)   WORLD-TECH</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>觀塘巧明街95號世達中心5樓G室 電話 : 2374 4923</td></tr>';
            echo '</table>';
        }
        
        if ($goodstype == 0 
            && $product_no=='SKY_MIC-C_1_2M_SL'
            || $product_no=='SKY_MIC-C_1_2M_GY'
            || $product_no=='SKY_MIC-C_1_2M_GD'
           ){ //if is acc
            echo '<br>';
            echo '<br>';
            echo '<table width="" border="0" cellspacing="0"  style="border:1px solid black;float:right;" id = "phonedesc">';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">產品資料</td></tr>';
            echo '<tr><td style="border-bottom:1px solid black; text-align:center; font-size:1.3em; font-weight:bold" colspan="2">Product Information</td></tr>';
            echo '<tr><td>1. 牌子 ( Brand ): </td><td>Sky Power</td></tr>';
            echo '<tr><td>2. 產品型號 ( Model ):</td><td>SKY POWER MICRO C USB 1.2M CABLE</td></tr>';
            echo '<tr><td>3. 產地 ( Original County ):</td><td>China</td></tr>';
            echo '<tr><td>4. 規格 ( Specification ): </td><td>Compatible with Micro-C-USB interface smartphones and tablets</td></tr>';
            echo '<tr><td></td><td>Pure Copper wire inside for higher efficiency of transfer (24 AWG)</td></tr>';
            echo '<tr><td></td><td>Supports both power charging and data transfer</td></tr>';
            echo '<tr><td></td><td>Supports up to 2.4A current with faster power charging</td></tr>';
            echo '<tr><td>5. 保養期限 ( Warranty ) :</td><td>1 YR</td></tr>';
            echo '<tr><td>6. 維修商名稱 ( Warranty Provider ) :</td><td>GCI</td></tr>';
            echo '<tr><td>7. 維修地址 ( Repair Center Address ) :</td><td>九龍荔枝角長順街一號, 新昌工業大廈七樓, 七零一室</td></tr>';
            echo '</table>';
        }
        
        
        
        
        
?>
