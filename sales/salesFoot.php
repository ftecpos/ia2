<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>salesMain</title>
<script type="text/javascript" src="../sales/js/sales.js"></script>
<script type="text/javascript" src="../js/comm.js"></script>
<script>
$(function() {
	$('#payt').buttonset();
});

function showZ() {
 var val = $('#payt').find(':checked').val();
}

$('#morepay').is(':checked');
</script>
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
				<input type="radio" id="radio1" name="radio" value="1" onclick="showZ()" checked="checked"/><label for="radio1">現金</label>
				<input type="radio" id="radio2" name="radio" value="2" onclick="showZ()"/><label for="radio2">EPS</label>
				<input type="radio" id="radio5" name="radio" value="3" onclick="showZ()"/><label for="radio5">信用卡</label>
				<!--<input type="radio" id="radio6" name="radio" value="4" onclick="showZ()" /><label for="radio6">八逹通</label>-->
			</div>
		</td>
		
		<td rowspan="2">
			<input type="button" class="srbut" value="結帳" onclick="endOrder()">
		</td>
	</tr>
	<tr>
		<td>
			<!--<input type="checkbox" id="morepay" name="morepay"/><label for="morepay" id="morepay_l">多個付款方式</label>-->
		</td>
	</tr>

</table>

<table border="0" class="ftrtable">
	<!--<tr>-->
	<!--	<td>-->
		<!--	<fieldset class="sff"> -->
		<!--	<legend>單據管理</legend>-->
		<!--		<input type="button" value="取消單據" onclick="voidInvoiceDialog()" style="color: red; background: #fff; display: none">-->
		<!--		<input type="button" value="重印單據" onclick="findInvoice()" style="display: none">-->
		<!--		<input type="button" value="查找單據" onclick="findInvoice()"> -->
		<!--		<input type="button" value="123" onclick="alert('1')" style="display: none"/>-->
		<!--		<input type="button" value="123" onclick="alert('1')" style="display: none"/>-->
		<!--	</fieldset>	-->
	<!--	</td>-->
	<!--</tr>-->
	<tr>
		<td>

		<!--	<legend >查找商品</legend>-->
		<!--		<input type="button" value="查找商品"  style="background:#FFF; border-color:#FFFFFF;"/>-->
				<input type="button" value="查找單據" onclick="findInvoice()">
				<input type="button" value="查找配件" onclick="findAcc();"/>
				<input type="button" value="查找手機" onclick="findMobile()"/>
				<input type="button" value="" onclick="addmin(0);" style="display: none"/>
				<input type="button" value="" onclick="addmin(0);" style="display: none"/>
		</td>
	</tr>

</table>
</body>
</html>
<style>
	.newClass { color:#FF0000;}
</style>
<script>
<!-- JQ DECARE AREA  -->
$(function() {
	//findInvoiceForm------------------------------------------
		$('#findInvoiceForm').dialog('distory');
//		var hide = $( '#findInvoiceForm' ).dialog( "option", "hide" );
		var dialogOption = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 1010,
			closeOnEscape: false,
//			position: [50, 80],
//			show:true,
//			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
			//	$('#findInvoiceForm').dialog('distory');
				$(this).dialog(dialogOption); //initializ the dailog once again to clean the data that saved at before
				$('#findInvoiceTop').hide().show("fade", { }, 1300, callback );
			},
			buttons : {
				"關閉": function() {
					$( this ).dialog( "close" );
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
//			show:true,
//			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
				$(this).dialog(dialogOption2); //initializ the dailog once again to clean the data that saved at before
			},
			close: function () {
			},
			drag: function () {
			},
			beforeOpen: function(){
			},
			beforeClose: function() {
			},
			buttons : {
				"確認": function() {
					$( this ).dialog( "close" );
					//alert(temp2);
					getInvoiceDetails(filteInvNo($('#rfInvNo').html()));
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

//-------------salesRenQtyForm dialog-------------------------------------

	$('#salesRenQtyForm').dialog('distory');
		var dialogOption10 = {
			autoOpen:false,  //defult must be false
			height: 170,
			width: 350,
			closeOnEscape: false,
			modal: true,
			resizable: false,
			open: function () {
				$(this).dialog(dialogOption10); //initializ the dailog once again to clean the data that saved at before
//				alert(maxReturnQty);
				$('#maxQtyMsg').html(maxReturnQty);
			},
			close: function () {
				maxReturnQty=0;
				$('#returnQty').val(null);
			},
			beforeClose: function() {
			},
			buttons : {
				"確認": function() {
					var buttons = $('#salesRenQtyForm').dialog( "option", "buttons" );
					$('#salesRenQtyForm').dialog( "option", "buttons", [{text: "Loading..",}] );
					if($('#returnQty').val()!=null&&$('#returnQty').val()<=maxReturnQty){
						$.ajax({
    						url: "../sales/salesGet.php?action=salesReturn",
				        	cache: false,
					        dataType: 'html',
					        type:'GET',
					        data: {
					           	IDN : tempIDN,
								date: date,
								timeValue2:timeValue2,
								createBy:$('#createBy').html(),
								invNo:filteInvNo($('#rfInvNo').html()),
								returnQty:$('#returnQty').val(),
								retailShopNo:shopno,
								reason : $('#returnConForm_reason').val(),
					        },
					        error: function(xhr) {
								alert('Ajax request Error!!!!!');
					        },
					        success: function(response) {    
								$('#salesReturnTop').append(response);
							
								$('#salesReturnTop').html(null);
								$('#salesReturnBottom').html(null);
								$('#salesReturnFoot').html(null);
									
								$('#salesReturnTop').html(temp);
								$('#salesReturnBottom').html(temp2);
				
								$('#returnConForm').dialog('close');
								$('#salesReturnForm').dialog('open');
							}
						});//----End of ajax------
						$( this ).dialog( "close" );
					} else {
						$('#maxQtyMsg').addClass( "newClass", 100 );
						$('#qtyMsg').addClass( "newClass", 100 );
						$('#returnQty').select();
					}
				},
				"取消": function() {
					$( this ).dialog('close');
					$('#returnConForm').dialog('close');
					getInvoiceDetails(filteInvNo($('#rfInvNo').html()));
				},
			},
		}; //end of dialogOption

		$('#salesRenQtyForm').dialog(dialogOption10);
//---End of salesRenQtyForm dialog------------------------------
	
});//----End of $(function()--------------------
<!-- End of JQ DECARE AREA  -->


var b=0;


//---------------findAccForm------------------------------------------
		$('#findAccForm').dialog('distory');
//		var hide = $( '#findAccForm' ).dialog( "option", "hide" );
		var dialogOption3 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 1010,
			closeOnEscape: false,
//			position: [50, 80],

//			show:true,
//			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
			//	$('#findAccForm').dialog('distory');
				$(this).dialog(dialogOption3); //initializ the dailog once again to clean the data that saved at before
				$('#findAccTop').hide().show("fade", { }, 1300, callback );
				$('#findAccFirMenu').hide().show("fade", { }, 1400, callback );
				$('#findAccSecMenu').hide().show("fade", { }, 1600, callback );
				
			},
			buttons : {
				"關閉": function() {
					//$('#findInvoiceTop').show( "fade", { }, 5000, callback ).fadeOut();	
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption

		function callback() {
		//	setTimeout(function() {
		//		$( "#effect:visible" ).removeAttr( "style" ).fadeOut();
		//	}, 1000 );
		};		
		$('#findAccForm').dialog(dialogOption3);
//---End of findAccForm dialog------------------------------

//---------------findMobileForm------------------------------------------
		$('#findMobileForm').dialog('distory');
		var dialogOption4 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 1010,
			closeOnEscape: false,
//			show:true,
//			hide:'fade',
			modal: true,
			resizable: true,
			open: function () {
				$(this).dialog(dialogOption4); //initializ the dailog once again to clean the data that saved at before
				$('#findMobileTop').hide().show("fade", { }, 1300, callback );
				$('#findMobileFirMenu').hide().show("fade", { }, 1400, callback );
				$('#findMobileSecMenu').hide().show("fade", { }, 1600, callback );
				
			},
			buttons : {
				"關閉": function() {
					//$('#findMobileTop').show( "fade", { }, 5000, callback ).fadeOut();
					//$( this ).dialog().fadeOut();
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption

		function callback() {

		};
		
		$('#findMobileForm').dialog(dialogOption4);
//---End of findMobileForm dialog------------------------------

//---------------listImeiForm------------------------------------------
		$('#listImeiForm').dialog('distory');
		var dialogOption6 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 430,
			closeOnEscape: true,
//			show:'fade',
//			hide:'fade',
			modal: true,
			resizable: false,
			open: function () {
				$(this).dialog(dialogOption6); //initializ the dailog once again to clean the data that saved at before
			},
			buttons : {
				"關閉": function() {
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption
		$('#listImeiForm').dialog(dialogOption6);
//---End of listImeiForm dialog------------------------------

//---------------voidInvoiceForm------------------------------------------
		$('#voidInvoiceForm').dialog('distory');
		var dialogOption9 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 1030,
			closeOnEscape: true,
//			show:'fade',
//			hide:'fade',
			modal: true,
			resizable: false,
			open: function () {
				$(this).dialog(dialogOption9); //initializ the dailog once again to clean the data that saved at before
			},
			buttons : {
				"關閉": function() {
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption
		$('#voidInvoiceForm').dialog(dialogOption9);
//---End of voidInvoiceForm dialog------------------------------

//---------------voidInvoiceConForm------------------------------------------
		$('#voidInvoiceConForm').dialog('distory');
		var dialogOption11 = {
			autoOpen:false,  //defult must be false
			height: 305,
			width: 410,
			closeOnEscape: true,
//			show:'fade',
//			hide:'fade',
			modal: true,
			resizable: false,
			open: function () {
				$(this).dialog(dialogOption11); //initializ the dailog once again to clean the data that saved at before
			},
			close: function() {
				$('#voidInvoiceConForm_pwd').val(null);
				$('#voidInvoiceConForm_reason').val(null);
				$('#voidInvoiceConForm_errMsg').html(null);
			},
			buttons : {
				"確認": function() {
				
					var val = $('#voidInvoiceConForm_reason').val();
					var pw_val=$('#voidInvoiceConForm_pwd').val();
					if(val.length==0)
						$('#voidInvoiceConForm_errMsg').html('<font color="red">請輸入取消原因</font>');
					else if (pw_val.length==0)
						$('#voidInvoiceConForm_errMsg').html('<font color="red">請輸入密碼</font>');
					else if(val.length>0 && pw_val.length>0){
						$.ajax({
							url: "../maintain/getall.php?action=login",
							dataType: 'html',
							async: false,
							data: {
								id : $('#staff_id').html(),
								pw : $('#voidInvoiceConForm_pwd').val(),
							},
							success: function(response) {
								
								canVoid=false;
								if(response == ''){
									canVoid=true;
									if(canVoid==true){
									var buttons = $('#voidInvoiceConForm').dialog( "option", "buttons" );
									$('#voidInvoiceConForm').dialog( "option", "buttons", [{text: "Loading..",}] );
										$.ajax({
											url: "../sales/salesGet.php?action=voidInvoice",
											dataType: 'html',
											data: { invNo : invNo_s1,
													reason : val },
											success: function(response) {
												$('#temppp').html(response);
												getInvoiceDetails(invNo_s1);
												$('#temppp').html(null);
												$('#voidInvoiceConForm').dialog( "close" );
											}
										});
									}
								}else
									$('#voidInvoiceConForm_errMsg').html(response);
							}
						});
					}
				},
				"取消": function() {
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption
		$('#voidInvoiceConForm').dialog(dialogOption11);
//---End of voidInvoiceConForm dialog------------------------------

//---------------returnConForm------------------------------------------
		$('#returnConForm').dialog('distory');
		var dialogOption12 = {
			autoOpen:false,  //defult must be false
			height: 305,
			width: 410,
			closeOnEscape: true,
			modal: true,
			resizable: false,
			open: function () {
				//$(this).dialog(dialogOption12); //initializ the dailog once again to clean the data that saved at before
			},
			close: function() {
				$('#returnConForm_pwd').val(null);
				$('#returnConForm_reason').val(null);
				$('#returnConForm_pwd_errMsg').html(null);
				getInvoiceDetails(filteInvNo($('#rfInvNo').html()));
			},
			buttons : {
				"確認": function() {
					var val = $('#returnConForm_reason').val();
					var pw_val=$('#returnConForm_pwd').val();
					if(val.length==0)
						$('#returnConForm_pwd_errMsg').html('<font color="red">請輸入退貨原因</font>');
					else if (pw_val.length==0)
						$('#returnConForm_pwd_errMsg').html('<font color="red">請輸入密碼</font>');
					else if(val.length>0 && pw_val.length>0){
						
						$.ajax({
							url: "../maintain/getall.php?action=login",
							dataType: 'html',
							async: false,
							data: {
								id : $('#staff_id').html(),
								pw : $('#returnConForm_pwd').val(),
							},
							success: function(response) {
								canReturn=false;
								if(response == ''){
									canReturn=true;
									var buttons = $('#returnConForm').dialog( "option", "buttons" );
									$('#returnConForm').dialog( "option", "buttons", [{text: "Loading..",}] );
									if(canReturn==true){
										if(temp_qty==1){
											$.ajax({
												url: "../sales/salesGet.php?action=salesReturn",
												cache: false,
												dataType: 'html',
												type:'GET',
												data: {
													IDN : tempIDN,
													date: date,
													timeValue2:timeValue2,
													createBy:$('#createBy').html(),
													invNo:filteInvNo($('#rfInvNo').html()),
													returnQty:1,
													retailShopNo:shopno,
													reason : $('#returnConForm_reason').val(),
												},
												error: function(xhr) {
													alert('Ajax request Error!!!!!');
												},
												success: function(response) {    
													$('#salesReturnTop').append(response);
												
													$('#salesReturnTop').html(null);
													$('#salesReturnBottom').html(null);
													$('#salesReturnFoot').html(null);
													
													$('#salesReturnTop').html(temp);
													$('#salesReturnBottom').html(temp2);
													
													$('#returnConForm').dialog( "close" );
													//$('#salesReturnForm').dialog('open');
												}
											});//----End of ajax------
										} else {
											maxReturnQty = temp_qty;
											$('#salesRenQtyForm').dialog('open');
										}
									}
								}else
									$('#returnConForm_pwd_errMsg').html(response);
							}
						});
					} else
						$('#voidInvoiceConForm_errMsg').html('<font color="red">請輸入退貨原因</font>');
				},
				"取消": function() {
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption
		$('#returnConForm').dialog(dialogOption12);
//---End of returnConForm dialog------------------------------


</script>

<!-- Dialog area -->

<div id="returnConForm" title="確認退貨">
	<fieldset>
    	<table cellpadding="5">
			<tr>
            	<td><label for="returnConForm_pwd" >請輸入密碼   </label></td>
                <td>
	                <input type="password" name="returnConForm_pwd" id="returnConForm_pwd"
						class="text ui-widget-content ui-corner-all" onclick="select()"/>
                </td>
            </tr>
			<tr>
            	<td><label for="returnConForm_reason" >請輸入退貨原因   </label></td>
                <td>
	                <textarea id="returnConForm_reason" rows="4" cols="18"
								class="text ui-widget-content ui-corner-all"></textarea>
                </td>
            </tr>
        </table>
    </fieldset>
	<table cellpadding="5">
		<tr>
			<td>
				<div id="returnConForm_pwd_errMsg"></div>
			</td>
		</tr>
	</table>
</div>

<div id="voidInvoiceConForm" title="確認取消單據" style="display:none">
	<fieldset>
    	<table cellpadding="5">
			<tr>
            	<td><label for="voidInvoiceConForm_pwd" >請輸入密碼   </label></td>
                <td>
	                <input type="password" name="voidInvoiceConForm_pwd" id="voidInvoiceConForm_pwd"
						class="text ui-widget-content ui-corner-all" onclick="select()"/>
                </td>
            </tr>
			<tr>
            	<td><label for="voidInvoiceConForm_reason" >請輸入取消原因   </label></td>
                <td>
	                <textarea id="voidInvoiceConForm_reason" rows="4"
								class="text ui-widget-content ui-corner-all"></textarea>
                </td>
            </tr>
        </table>
    </fieldset>
	<table cellpadding="5">
		<tr>
            <td>
	            <div id="voidInvoiceConForm_errMsg"></div>
			</td>
        </tr>
    </table>
</div>

<div id="voidInvoiceForm" title="查找單據">
	<div id="voidInvoiceBottom">
	</div>
</div>


<!-- //findInvoiceForm 張form-->
<div id="findInvoiceForm" title="查找單據">
	<div id="findInvoiceTop">
		<label for="invNo" class="ttsmall">Search By 單據編號</label>
		<input type="text" name="invNo" id="invNo" value="" class="text ui-widget-content ui-corner-all"
          onclick="select();" style="color:#6633FF;"/>
		 
		 <label for="" class="ttsmall">IMEI</label>
		<input type="text" name="" id="" value="" class="text ui-widget-content ui-corner-all"
         onkeyup="//return cleanInvoiceRecord($(this),value);" onclick="select();" style="color:#6633FF;"/>
        <input type="button" value="Reset" class="findInvoiceType" onclick="findInvoice()"style="height:25px;"/>
	</div>  <!--CSS temp-->
	<div id="findInvoiceFirMenu"></div>
    <div id="findInvoiceSecMenu"></div>
	<div id="findInvoiceBottom"></div>
    <div id="findInvoiceFoot"></div>
</div>

<div id="salesReturnForm" title="退貨處理">

	<div id="salesReturnTop"></div>
	<div id="salesReturnBottom"></div>
    <div id="salesReturnFoot"></div>
</div>
<div id="salesRenQtyForm" title="退貨數量">

<div id="salesRenQtyBottom">
	<span id="qtyMsg">不可超過<span id="maxQtyMsg"></span>件</span>
	<fieldset>
    	<table cellpadding="5">
        	<tr>
            	<td><label for="returnQty" >退貨數量   </label></td>
                <td>
	                <input type="text" name="returnQty" id="returnQty" onkeyup="return validateNumber($(this),value)"
						class="text ui-widget-content ui-corner-all" maxlength="5"
						onclick="select()"/>
                </td>
            </tr>
        </table>
    </fieldset>

</div>
</div>

<div id="findAccForm" title="查找配件" style="position: relative;">
	<div id="findAccTop">
		<label for="pID" class="ttsmall">Product id </label>
		<input type="text" name="pID" id="pID" class="text ui-widget-content ui-corner-all"
         onkeyup="//return cleanAccRecord($(this),value);" onclick="select();" style="color:#FF9787; width:160px;"/>
         <label for="findAccCode" class="ttsmall">Barcode </label>
		<input type="text" name="findAccCode" id="findAccCode" class="text ui-widget-content ui-corner-all" maxlength="13"
         onkeyup="return cleanAccRecord($(this),value);" onclick="select();" style="color:#FF9787; width:160px;"/>
         <label for="findAccKey" class="ttsmall">Keyword </label>
		<input type="text" name="findAccKey" id="findAccKey" class="text ui-widget-content ui-corner-all"
         onkeyup="" onclick="select();" style="color:#FF9787; width:160px;"/>
         <input type="button" value="Reset" class="finAccByType" onclick="findAcc()"style="height:25px;"/>
	</div>  <!--CSS temp-->
	<div id="findAccFirMenu"></div>
    <div id="findAccSecMenu"></div>
	<div id="findAccBottom"></div>
    <div id="findAccFoot"></div>
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

<div id="listImeiForm" title="IMEI List">
	<div id="listImeiTop">1</div>
	<div id="listImeiBottom">
    123
    </div>
</div>
<!-- End of Dialog area -->

<script>

//------findMobile-----------------------------------------------------
document.getElementById('findMobileKey').onkeyup = findMobileByKeyword;
document.getElementById('findMobileCode').onkeydown = findMobileDetail;
//------findMobile-----------------------------------------------------

//------findAcc-----------------------------------------------------
document.getElementById('findAccKey').onkeyup = findAccByKeyword;
document.getElementById('findAccCode').onkeydown = findCodeDetail;

//------findAcc-----------------------------------------------------

document.getElementById('invNo').onkeyup = findInvoiceRecord;
//document.getElementById('invNo').onkeyup = cleanInvoiceRecord;

</script>
