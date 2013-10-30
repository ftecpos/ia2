<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>salesMain</title>
<script>
$(function() {
	$( "#payt" ).buttonset();
});

function showZ() {
 var val = $('#payt').find(':checked').val();
}

$('#morepay').is(':checked');
</script>

<style>


</style>

</head>


<body>
<table class="ftltable" border="0">
	<tr>
		<td rowspan="2">
			<label for="tol" class="tt">總數 : </label>
			<input type="text" name="tol" id="tol" class="disabled" value="0.0" disabled="disabled" />
		</td>

		<td>
			<div id="payt">
				<input type="radio" id="radio1" name="radio" value="1" onclick="showZ()" checked/><label for="radio1">現金</label>
				<input type="radio" id="radio2" name="radio" value="2" onclick="showZ()"/><label for="radio2">EPS</label>
				<input type="radio" id="radio5" name="radio" value="3" onclick="showZ()"/><label for="radio5">信用卡</label>
				<input type="radio" id="radio6" name="radio" value="4" onclick="showZ()" /><label for="radio6">八逹通</label>
			</div>
		</td>
		
		<td rowspan="2">
			<input type="button" class="srbut" value="結帳" onclick="endOrder()">
		</td>
	</tr>
	<tr>
		<td>
			<input type="checkbox" id="morepay" name="morepay" value="" onclick=""/><label for="morepay">多個付款方式</label>
		</td>
	</tr>

</table>

<table border="0" class="ftrtable">
	<tr>
		<td>
		<!--	<fieldset class="sff"> -->
		<!--	<legend>單據管理</legend>-->
				<input type="button" value="取消單據" onclick="findInvoice()" style="color: red; background: #fff">
				<input type="button" value="重印單據" onclick="findInvoice()">
				<input type="button" value="查找單據" onclick="findInvoice()">
				<input type="button" value="123" onclick="alert('1')" style="display: none"/>
				<input type="button" value="123" onclick="alert('1')" style="display: none"/>
		<!--	</fieldset>	-->
		</td>
	</tr>
	<tr>
		<td>

		<!--	<legend >查找商品</legend>-->
				<input type="button" value="查找商品"  style="background:#FFF; border-color:#FFFFFF;"/>
				<input type="button" value="查找配件" onclick="findAss();"/>
				<input type="button" value="查找手機" onclick="findMobile()"/>
				<input type="button" value="" onclick="addmin(0);" style="display: none"/>
				<input type="button" value="" onclick="addmin(0);" style="display: none"/>
	
				
		</td>
	</tr>

</table>


</body>
</html>
<script>
<!-- JQ DECARE AREA  -->
$(function() {
	//findInvoiceForm------------------------------------------
		$('#findInvoiceForm').dialog('distory');
//		var hide = $( '#findInvoiceForm' ).dialog( "option", "hide" );
		var dialogOption = {
			autoOpen:false,  //defult must be false
			height: 500,
			width: 1010,
			closeOnEscape: false,
//			position: [50, 80],
			show:true,
			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
			//	$('#findInvoiceForm').dialog('distory');
				$(this).dialog(dialogOption); //initializ the dailog once again to clean the data that saved at before
				$('#findInvoiceTop').hide().show("fade", { }, 1300, callback );
			},
			buttons : {
				"確認": function() {
					$( this ).dialog( "close" );
				},
				"取消": function() {
					//$('#findInvoiceTop').show( "fade", { }, 5000, callback ).fadeOut();
					
				},
				"列印": function() {
					$( this ).dialog().fadeOut();
				},
			},
		};//end of dialogOption
//		$(".ui-dialog-titlebar").css("background","#C6F");
		
			

		function callback() {
		//	setTimeout(function() {
		//		$( "#effect:visible" ).removeAttr( "style" ).fadeOut();
		//	}, 1000 );
		};
		
		$('#findInvoiceForm').dialog(dialogOption);
		
		//$(".ui-dialog-titlebar").hide();
	//---End of morePayForm dialog------------------------------
	
	//-------------salesReturnForm dialog-------------------------------------
		$('#salesReturnForm').dialog('distory');
		var dialogOption2 = {
			autoOpen:false,  //defult must be false
			height: 400,
			width: 800,
			closeOnEscape: false,
			show:true,
			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {

				$(this).dialog(dialogOption2); //initializ the dailog once again to clean the data that saved at before
				
//				alert(temp);
			},
			close: function () {

			},
			drag: function () {

			},
			beforeOpen: function(){
				
			},
			beforeClose: function() {
//				alert(temp);
			},
			buttons : {
				"確認": function() {
					$( this ).dialog( "close" );
					//alert(temp2);
					getInvoiceDetails($('#rfInvNo').html());
					//$( this ).dialog( "close" );					
				},
				"列印": function() {
					$( this ).dialog( "close" );
				},
			},
		}; //end of dialogOption
//		$(".ui-dialog-titlebar").css("background","#C6F");
		$('#salesReturnForm').dialog(dialogOption2);
		
		//$(".ui-dialog-titlebar").hide();
	//---End of salesReturnForm dialog------------------------------
	
});//----End of $(function()--------------------
<!-- End of JQ DECARE AREA  -->


var b=0;


//---------------findAssForm------------------------------------------
		$('#findAssForm').dialog('distory');
//		var hide = $( '#findAssForm' ).dialog( "option", "hide" );
		var dialogOption3 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 1010,
			closeOnEscape: false,
//			position: [50, 80],

			show:true,
			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
			//	$('#findAssForm').dialog('distory');
				$(this).dialog(dialogOption3); //initializ the dailog once again to clean the data that saved at before
				$('#findAssTop').hide().show("fade", { }, 1300, callback );
				$('#findAssFirMenu').hide().show("fade", { }, 1400, callback );
				$('#findAssSecMenu').hide().show("fade", { }, 1600, callback );
				
			},
			buttons : {
				"確認": function() {
					$( this ).dialog( "close" );
				},
				"取消": function() {
					//$('#findInvoiceTop').show( "fade", { }, 5000, callback ).fadeOut();	
				},
				"列印": function() {
					$("#receipt").dialog('open');
				},
			},
		};//end of dialogOption

		function callback() {
		//	setTimeout(function() {
		//		$( "#effect:visible" ).removeAttr( "style" ).fadeOut();
		//	}, 1000 );
		};
		
		$('#findAssForm').dialog(dialogOption3);
//---End of findAssForm dialog------------------------------

//---------------findMobileForm------------------------------------------
		$('#findMobileForm').dialog('distory');
		var dialogOption4 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 1010,
			closeOnEscape: false,
			show:true,
			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
				$(this).dialog(dialogOption4); //initializ the dailog once again to clean the data that saved at before
				$('#findMobileTop').hide().show("fade", { }, 1300, callback );
				$('#findMobileFirMenu').hide().show("fade", { }, 1400, callback );
				$('#findMobileSecMenu').hide().show("fade", { }, 1600, callback );
				
			},
			buttons : {
				"確認": function() {
					$( this ).dialog( "close" );
				},
				"取消": function() {
					//$('#findMobileTop').show( "fade", { }, 5000, callback ).fadeOut();	
				},
				"列印": function() {
					$( this ).dialog().fadeOut();
				},
			},
		};//end of dialogOption

		function callback() {

		};
		
		$('#findMobileForm').dialog(dialogOption4);
//---End of findMobileForm dialog------------------------------





</script>

<!-- Dialog area -->
<!-- //findInvoiceForm 張form-->
<div id="findInvoiceForm" title="查找單據">
	<div id="findInvoiceTop">
		<label for="invNo" class="ttsmall">單據編號</label>
		<input type="text" name="invNo" id="invNo" value="" class="text ui-widget-content ui-corner-all"
         onkeyup="return cleanInvoiceRecord($(this),value);" onclick="select();" style="color:#6633FF;"/>   
	</div>  <!--CSS temp-->
	<div id="findInvoiceMenu"></div>
	<div id="findInvoiceBottom"></div>
    <div id="findInvoiceFoot"></div>
</div>

<div id="salesReturnForm" title="退貨處理">

	<div id="salesReturnTop"></div>
	<div id="salesReturnBottom"></div>
    <div id="salesReturnFoot"></div>
</div>

<div id="findAssForm" title="查找配件">
	<div id="findAssTop">
		<label for="pID" class="ttsmall">Product id </label>
		<input type="text" name="pID" id="pID" class="text ui-widget-content ui-corner-all"
         onkeyup="//return cleanAssRecord($(this),value);" onclick="select();" style="color:#FF9787; width:160px;"/>
         <label for="findAssCode" class="ttsmall">Barcode </label>
		<input type="text" name="findAssCode" id="findAssCode" class="text ui-widget-content ui-corner-all" maxlength="13"
         onkeyup="return cleanAssRecord($(this),value);" onclick="select();" style="color:#FF9787; width:160px;"/>
         <label for="findAssKey" class="ttsmall">Keyword </label>
		<input type="text" name="findAssKey" id="findAssKey" class="text ui-widget-content ui-corner-all"
         onkeyup="" onclick="select();" style="color:#FF9787; width:160px;"/>
         <input type="button" value="Reset" class="finAssByType" onclick="findAss()"style="height:25px;"/>
	</div>  <!--CSS temp-->
	<div id="findAssFirMenu"></div>
    <div id="findAssSecMenu"></div>
	<div id="findAssBottom"></div>
    <div id="findAssFoot"></div>
</div>

<div id="findMobileForm" title="查找手機">
	<div id="findMobileTop">         
         <label for="findMobileCode" class="ttsmall">IMEI </label>
		<input type="text" name="findMobileCode" id="findMobileCode" class="text ui-widget-content ui-corner-all" maxlength="15"
         onkeyup="return cleanMobileRecord($(this),value);" onclick="select();" style="color:#34C631; width:175px;"/>
         
         <label for="findMobileKey" class="ttsmall">Keyword </label>
		<input type="text" name="findMobileKey" id="findMobileKey" class="text ui-widget-content ui-corner-all"
         onkeyup="" onclick="select();" style="color:#34C631; width:160px;"/>
         
         <input type="button" value="Reset" class="finMobileBut" onclick="findMobile()"style="height:25px;"/>
	</div>  
	<div id="findMobileFirMenu"></div>
    <div id="findMobileSecMenu"></div>
	<div id="findMobileBottom"></div>
    <div id="findMobileFoot"></div>
</div>
<!-- End of Dialog area -->

<script>

//------findAss-----------------------------------------------------
document.getElementById('findMobileKey').onkeyup = findMobileByKeyword;
document.getElementById('findMobileCode').onkeydown = findMobileDetail;
//------findAss-----------------------------------------------------

//------findAss-----------------------------------------------------
document.getElementById('findAssKey').onkeyup = findAssByKeyword;
document.getElementById('findAssCode').onkeydown = findCodeDetail;
document.getElementById('pID').onkeydown = findAssDetail;
//------findAss-----------------------------------------------------

document.getElementById('invNo').onkeydown = findInvoiceRecord;
//document.getElementById('invNo').onkeyup = cleanInvoiceRecord;

</script>
