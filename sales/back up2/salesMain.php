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
/*	height:137mm;*/


</style>
	<div id="receiptHead" style="width:210mm; float:left; height:35mm;">
    	<img src="../img/TT1006.jpg" width="178" height="105" />
		<table class=""  cellpadding="0" cellspacing="0" border="1" style="border: 1px solid #000;float:right;font-family: arial,'微軟正黑體';" >            		
			<tr style="height:2cm;"><td style="width:3.5cm; text-align:center">Customer Copy<br />客戶存單</td>
            						<td style="width:5cm; text-align:center; font-family: arial,'微軟正黑體';"><strong>RECEIPT 銷售收據</strong></td></tr>
        </table>
    </div>  <!--CSS temp-->
	<div id="receiptTop" style="width:210mm; float:left; height:40mm;">
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
	
    <div id="receiptBottom" style="width:210mm;float:left;">

    </div>
    
    <div id="receiptDown" style="width:210mm; float:left; height:30mm;">
    <table id="" class="" style="float:right; font-family: arial,'微軟正黑體';" >
    	<tr><th style="font-weight:100;text-align:left;">銷售總額 : </th><th>HKD</th><th style="width:5cm; text-align:right"><span id="recTotalSales"></span></th></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><th style="font-weight:100;text-align:left;">合計金額 : </th><th>HKD</th><th style="width:5cm; text-align:right"><span id="recTotalPay"></span></th></tr>
        <tr><th style="font-weight:100;text-align:left;">已付 : </th><th>CASH</th><th style="width:5cm; text-align:right"><span id="recPay"></span></th></tr>
	</table>
    </div>
	<div id="receiptFoot" style="width:210mm; height:50mm;">
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
		
		$('#printForm').dialog('destroy');
		$( "#printForm" ).dialog({	
			autoOpen:false,  //defult must be false
			height: 150,
			width: 350,
			closeOnEscape: true,
			modal: true,

			
			buttons : {
				"列印": function() {
					$('#receipt').dialog('open');
					//var tempprice = sDiscount.toFixed(1);
					$('#recShop').html($('#shop_No').html());
					$('#recAddrA').html($('#addr').val());
					$('#recAddrB').html($('#location').val());
					$('#recTel').html($('#phone').val());
					$('#recDate').html(date);
					$('#recRecNo').html(tempInvNo);
					$('#recCreateBy').html($('#createBy').html());
					
					$('#recTotalSales').html(tempTotal.toFixed(1));
					$('#recTotalPay').html(tempTotal.toFixed(1));
					$('#recPay').html(tempTotal.toFixed(1));
					
					$('#receiptBottom').html('<p><table id="rectb" class="rectb" style="float:left; font-family:arial,\'微軟正黑體\'; font-size:14px;" border="0" >'+
											 '<tr style="height:0.6cm;">'+
											 '<th style="font-weight:100; width:3.5cm; text-align:left;">產品編號<br />Product Code</th>'+
											 '<th style="font-weight:100; width:7.3cm; text-align:left;">產品名稱<br />Product Description</th>'+
											 '<th style="font-weight:100; width:1.5cm; text-align:left;">數量<br />Qty</th>'+
											 '<th style="font-weight:100; width:2cm; text-align:left;">單價<br />Unit Price</th>'+
											 '<th style="font-weight:100; width:2cm; text-align:left;">折扣<br />Discount</th>'+
											 '<th style="font-weight:100; width:3cm; text-align:left;">總金額<br />Total Amount</th>'+
											 '</tr>'+
											 '<tr style="height:0.6cm;"><th colspan="6"><hr color="#000000" noshade="noshade" /></th></tr>'+
											 '</table></p>');
											 
					
					var recItemArrLength = itemArray.length;
					for ( i=0; i < recItemArrLength; i++) {
						//getBottomHeight();
						if($('#receiptBottom').height() <= 518){
							
						$('#rectb').append('<tr><td>'+itemArray[i]+'</td>'+
												'<td>'+itemArray[i+1]+'</td>'+
												'<td>'+itemArray[i+3]+'</td>'+
												'<td>'+itemArray[i+2]+'</td>'+
												'<td>'+itemArray[i+4]+'</td>'+
												'<td>'+itemArray[i+5]+'</td></tr>');
						i+=5;
						
						}
						
						else if($('#receiptBottom').height() > 518){
							$('#rectb').append('<br /><br />');
							$('#receiptBottom').css('height','1036px');							
						}
					}
					
					if ($('#receiptBottom').height() == 1036){
						$('#receiptBottom').css('height','518px');	
						$('#receipt').append('<div id="receiptHeadB">'+
												 '<img src="../img/TT1006.jpg" width="178" height="105" />'+
												 '<table class=""  cellpadding="0" cellspacing="0" border="1" style="border: 1px solid #000;float:right;font-family: arial,\'微軟正黑體\';" >'+
												 '<tr style="height:2cm;"><td style="width:3.5cm; text-align:center">Customer Copy<br />客戶存單</td>'+
												 '<td style="width:5cm; text-align:center; font-family: arial,\'微軟正黑體\';"><strong>RECEIPT 銷售收據</strong></td></tr>'+
												 '</table>'+
												 '</div>'+
												 '<div id="receiptBottomB">'+'</div>'+
												 '<div id=""></div>'+
												 '<div id="receiptBottomB"></div>'+
												 '<div id="receiptFootB"></div>'+
												 '<div id="receiptBottomB"></div>'+
												 '<div id="receiptBottomB"></div>' );
							 $('#receiptBottomB').html('<p><table id="rectbB" class="rectbB" style="float:left; font-family:arial,\'微軟正黑體\'; font-size:14px;" border="0" >'+
											 '<tr style="height:0.6cm;">'+
											 '<th style="font-weight:100; width:3.5cm; text-align:left;">產品編號<br />Product Code</th>'+
											 '<th style="font-weight:100; width:7.3cm; text-align:left;">產品名稱<br />Product Description</th>'+
											 '<th style="font-weight:100; width:1.5cm; text-align:left;">數量<br />Qty</th>'+
											 '<th style="font-weight:100; width:2cm; text-align:left;">單價<br />Unit Price</th>'+
											 '<th style="font-weight:100; width:2cm; text-align:left;">折扣<br />Discount</th>'+
											 '<th style="font-weight:100; width:3cm; text-align:left;">總金額<br />Total Amount</th>'+
											 '</tr>'+
											 '<tr style="height:0.6cm;"><th colspan="6"><hr color="#000000" noshade="noshade" /></th></tr>'+
											 '</table></p>');
							$('#receiptDownB').html('<table id="" class="" style="float:right; font-family: arial,\'微軟正黑體\';" >'+
													'<tr><th style="font-weight:100;text-align:left;">銷售總額 : </th><th>HKD</th><th style="width:5cm; text-align:right"><span id="recTotalSales"></span></th></tr>'+
													'<tr><td>&nbsp;</td></tr>'+
													'<tr><th style="font-weight:100;text-align:left;">合計金額 : </th><th>HKD</th><th style="width:5cm; text-align:right"><span id="recTotalPay"></span></th></tr>'+
													'<tr><th style="font-weight:100;text-align:left;">已付 : </th><th>CASH</th><th style="width:5cm; text-align:right"><span id="recPay"></span></th></tr>'+
													'</table></div>');
							$('#receiptFootB').html('<table id="" class="" style="float:left; font-family: arial,\'微軟正黑體\';" border="1">'+
													'<tr style="height:4cm;">'+
													'<td style="font-weight:100; width:8.4cm; border:#90C; vertical-align:bottom; font-size:9px; padding:5px; font-weight:bold;font-size:10px;">'+
													'顧客簽署 / 蓋印 CUSTOMER SIGNATURE/CHOP'+
													'</td></tr></table>'+
													'<table id="" class="" style="float:left; font-family: arial,\'微軟正黑體\';">'+
													'<tr style="height:2.7cm;">'+
													'<td style="font-weight:100; width:12cm; border:#90C; vertical-align:top; font-size:6px; padding:5px; font-weight:bold;font-size:12px;">'+
													'備註 REMARK(S)'+
													'</td></tr><tr>'+
													'<td style="font-weight:100; width:12cm; border:#90C; vertical-align:bottom; font-size:6px; padding:5px; font-weight:bold;font-size:12px;">'+
													'顧客現同意及接受列明之條款及細則<br />CUSTOMER CONFIRM AGREEMENT AND ACCEPTANCE OF LISTED TERMS AND CONDITIONS'+
													'</td></tr></table> </div>');
					}
					
					
					
					if($('#receiptBottom').height() <= 518)
						$('#receiptBottom').css('height','518px');
						
					if($('#receiptBottomB').height() <= 518)
						$('#receiptBottomB').css('height','518px');








					i=i-6;
					for ( i; i < recItemArrLength; i++) {
						$('#rectbB').append('<tr><td>'+itemArray[i]+'</td>'+
												'<td>'+itemArray[i+1]+'</td>'+
												'<td>'+itemArray[i+3]+'</td>'+
												'<td>'+itemArray[i+2]+'</td>'+
												'<td>'+itemArray[i+4]+'</td>'+
												'<td>'+itemArray[i+5]+'</td></tr>');
						i+=5;
					}

										
					
					
					
					//$( this ).dialog( "close" );
					//$('#receipt').dialog('distory');
					

					//$('#receipt').dialog('close');
					
					$("#receipt").printArea({});
					callSales();
				},
				"不列印": function() {
					$('#receipt').dialog('distory');
					$( this ).dialog( "close" );
					callSales();
				},
				"test": function() {
					$('#receipt').dialog('enable');
				},
				"getBottomHeight()": function() {
					getBottomHeight();
				},
			},
		});//---End of printForm dialog------------------------------

		
		$('#receipt').dialog('distory');
		var dialogOption5 = {
			autoOpen:false,  //defult must be false	
			stack :true,
			zIndex: -5000,
			open: function () {
			},
			buttons : {
				"關閉": function() {
					$( this ).dialog( "close" );
				},
				"test": function() {
					getBottomHeight();
				},		
			},		
		};//end of dialogOption
		$('#receipt').dialog(dialogOption5);
//---End of findMobileForm dialog------------------------------


function getBottomHeight(){
	alert($('#receiptBottom').height());
}


</script>
<!--// printForm 張form-->
<div id="printForm" title="列印">

	<fieldset>
    <p>要列印收據嗎? </p>	
    </fieldset>


</div>