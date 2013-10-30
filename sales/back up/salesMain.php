<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>salesMain</title>
</head>
<style>
.currRow{
 background-color:#F0BD00;
 cursor:pointer;
}



</style>





<body>
<table id="saltb" class="saltb"  cellpadding="0" cellspacing="0" style="width: 100%;" >
            		<thead><th style="width: 100px">條碼/IMEI</th><th>貨品名稱</th><th style="width: 100px">售價</th>
            			<th style="width: 100px">數量</th><th style="width: 100px">折扣</th><th>小計</th></thead>
                    <tbody></tbody>
</table>


</body>
</html>

<!--//多選payment method  張form-->
<div id="receipt" title="列印銷售收據">
<style>
#receiptHead, #receiptTop, #receiptBottom, #receiptDown, #receiptFoot{
	width: 210mm;
}
#receiptHead{
	float:left;
	height:35mm;
	background:#F00;
}
#receiptTop{
	float:left;
	height:40mm;
	background:#F60;
}
#receiptBottom{
	float:left;
	height:137mm;
	background:#CCCC66;
}
#receiptDown{
	float:left;
	height:30mm;
	background:#03C;
}
#receiptFoot{
	float:left;
	height:50mm;

}
.under{
	background: #000;
	height: 1px;
	width: 210mm;
	margin: 0 0 0 0;
}
</style>
	<div id="receiptHead">
    	<img src="../img/TT1006.jpg" width="178" height="105" />
		<table class=""  cellpadding="0" cellspacing="0" border="1" style="border: 1px solid #000;float:right;font-family: arial,'微軟正黑體';" >            		
			<tr style="height:2cm;"><td style="width:3.5cm; text-align:center">Customer Copy<br />客戶存單</td>
            						<td style="width:5cm; text-align:center; font-family: arial,'微軟正黑體';"><strong>RECEIPT 銷售收據</strong></td></tr>
        </table>
    </div>  <!--CSS temp-->
	<div id="receiptTop">
    <table id="" class="" style="float:left; font-family: arial,'微軟正黑體'; font-size:14px;font-weight:100;" >
    	<tr><th style="font-weight:100; text-align:left; ">分店 Shop : <span id="recShop" style=""></span></th></tr>
        <tr><th style="font-weight:100; text-align:left; ">地址 Address : <span id="recAddrA"></span><br /><span id="recAddrB" style="margin:0 0 0 95px"></span></th></tr>
        <tr><th style="font-weight:100; text-align:left; ">電話 Tel : <span id="recTel"></span></th></tr>
	</table>
    <table id="" class="" style="float:right; font-family: arial,'微軟正黑體'; font-size:14px;" >
    	<tr><th style="font-weight:100; text-align:left;">日期 Date :<span id="recDate"></span></th></tr>
        <tr><th style="font-weight:100; text-align:left;">收據編號 Receipt No. : <span id="recRecNo"></span></th></tr>
        <tr><th style="font-weight:100; text-align:left;">開單員工 Prepare by : <span id="recCreateBy"></span></th></tr>
	</table>
    </div> <!--CSS temp-->
	
    <div id="receiptBottom">
    <table id="rectb" class="rectb" style="float:left; font-family:arial,'微軟正黑體'; font-size:14px;" border="0" >
    	<tr style="height:0.6cm;">
        	<th style="font-weight:100; width:3.5cm; text-align:left;">產品編號<br />Product Code</th>
            <th style="font-weight:100; width:7.3cm; text-align:left;">產品名稱<br />Product Description</th>
            <th style="font-weight:100; width:1.5cm; text-align:left;">數量<br />Qty</th>
            <th style="font-weight:100; width:2cm; text-align:left;">單價<br />Unit Price</th>
            <th style="font-weight:100; width:2cm; text-align:left;">折扣<br />Discount</th>
            <th style="font-weight:100; width:3cm; text-align:left;">總金額<br />Total Amount</th>
		</tr>
        <tr style="height:0.6cm;"><th colspan="6"><hr color="#000000" noshade="noshade" /></th></tr>
        
        <tr>
        	<td >SAM1234</td>
            <td>SAMSUNG B7330<br />351125456321145</td>
            <td>1</td>
            <td>2688.00</td>
            <td>50</td>
            <td>2638.00</td>
		</tr>
	</table>
    </div>
    
    <div id="receiptDown">
    <table id="" class="" style="float:right; font-family: arial,'微軟正黑體';" >
    	<tr><th style="font-weight:100;text-align:left;">銷售總額 : </th><th>HKD</th><th style="width:5cm; text-align:right"><span id="recTotalSales"></span></th></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><th style="font-weight:100;text-align:left;">合計金額 : </th><th>HKD</th><th style="width:5cm; text-align:right"><span id="recTotalPay"></span></th></tr>
        <tr><th style="font-weight:100;text-align:left;">已付 : </th><th>CASH</th><th style="width:5cm; text-align:right"><span id="recPay"></span></th></tr>
	</table>
    </div>
	<div id="receiptFoot">
    <table id="" class="" style="float:left; font-family: arial,'微軟正黑體';" border="1">
    	<tr style="height:4cm;">
        	<td style="font-weight:100; width:8.4cm; border:#90C; vertical-align:bottom; font-size:9px; padding:5px; font-weight:bold;font-size:10px;">
            	顧客簽署 / 蓋印 CUSTOMER SIGNATURE/CHOP
        	</td>
        </tr>
	</table>
    <table id="" class="" style="float:left; font-family: arial,'微軟正黑體';">
    	<tr style="height:2.7cm;">
        	<td style="font-weight:100; width:12cm; border:#90C; vertical-align:top; font-size:6px; padding:5px; font-weight:bold;font-size:12px;">
				備註 REMARK(S)
            </td>
        </tr>
        <tr>
        	<td style="font-weight:100; width:12cm; border:#90C; vertical-align:bottom; font-size:6px; padding:5px; font-weight:bold;font-size:12px;">
            	顧客現同意及接受列明之條款及細則<br />CUSTOMER CONFIRM AGREEMENT AND ACCEPTANCE OF LISTED TERMS AND CONDITIONS
        	</td>
        </tr>
	</table>
    </div>  <!--CSS temp-->
</div>


<script>
<!-- JQ DECARE AREA  -->

	
		$('#receipt').dialog('distory');
		var dialogOption5 = {
			autoOpen:false,  //defult must be false			
		};//end of dialogOption

		
		$('#receipt').dialog(dialogOption5);
//---End of findMobileForm dialog------------------------------





</script>