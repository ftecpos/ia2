<?php include("../check_login.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>stock in by kuen</title>


<script type="text/javascript" src="../js/inventory.js"></script>
</head>
<script>
$(function() {
	$('#si_bottom').load("../inventory/invGet.php?action=getSiBottom&pageNo=0");
	$('#siRec_staff').val($('#staff_id').html());
	$('#si_poNo').focus();
	$('#shopNo').val(shopno);
	$('#shopId').val(shopid);
});
var tempNonRecQty;
var tempRecedQty;
var po_State_no;
var totalNonRecQty;
var tempPoNo;
var tempPoNoVal;

</script>
<style>
.newClass { color:#FF0000;}
</style>
<body>
	<div id="si_head">
    	<label for="siRec_staff" class="gg">收貨員工 : </label>
		<input type="text" name="siRec_staff" id="siRec_staff" class="inv_col rec_staff" maxlength="4"	onclick="select();"  onkeyup="//return validateNumber($(this),value)"/>

        <label for="si_poNo" class="gg">Enter PO No. : </label>
		<input type="text" name="si_poNo" id="si_poNo" class="inv_col si_poNo" maxlength="10"	onclick="select();"  onkeyup="//return validateNumber($(this),value)"/>
        <label for="shopNo" class="gg">Shop No. : </label>
		<input type="text" id="shopNo" class="inv_col si_shopNo" maxlength="2" readonly="readonly"/>
        <label for="shopId" class="gg">Shop ID : </label>
		<input type="text" id="shopId" class="inv_col shopId" maxlength="2" readonly="readonly"/>
	</div>
	
    <div id="si_fir_menu">Table只顯示未完成單據</div>
	<div id="si_bottom"></div>
	<div id="si_foot" style="display:none;">
    <table border="1" cellpadding="2px" style="float:left;">
    	<tr><td style="width:130px; background-color:#CCC;">PO No.</td><td style="width:180px; background-color:#999;"><div id="si_bot_poNo"></div></td>
        	<td style="background-color:#CCC;">開單員工</td><td style="background-color:#999;"><div id="si_bot_cstaff"></div></td></tr>
        <tr><td style="background-color:#CCC;">PO Create Date</td>
        	<td style="background-color:#999;"><div id="si_bot_pcd"></div></td>
        	<td style="background-color:#CCC;">開單位置</td><td style="background-color:#999;"><div id="si_bot_plocation"></div></td></tr>
        <tr><td colspan="2"></td><td style="background-color:#CCC;">單據State</td><td style="background-color:#999;"><div id="si_bot_poState" style="color:#AFDEFF;"></div></td></tr>
        <tr><td style="background-color:#CCC;">Supplier</td><td colspan="3" style="background-color:#999;"><div id="si_bot_supp"></div></td></tr>
    </table>
	<div id="si_but_area" style="float:right;"></div>
    <div id="po_detail_area" style="clear:both"></div>
    </div>
  <!--  <div id="totalNonRecQty" style="display:none;"></div>-->
    <div id="totalNonRecQty" style="display:none;"></div>
    <br />
    <div id="totalRecQty" style="display:none;"></div>
    
</body>
</html>

<div id="moreGoodsReceForm" title="配件進貨數量" style="display:none;">

<div id="moreGoodsReceFormBottom">
	<span id="qtyMsg">不可超過</span><span id="maxQtyMsg_z"></span>
	<fieldset>
    	<table cellpadding="5">
        	<tr>
            	<td><label for="recQty" >進貨數量   </label></td>
                <td>
	                <input type="text" name="recQty" id="recQty" onkeyup="return validateNumber($(this),value)"
						class="text ui-widget-content ui-corner-all" maxlength="5"
						onclick="select()"/>
                </td>
            </tr>
        </table>
    </fieldset>

</div>
</div>

<div id="phoneReceForm" title="電話進貨數量" style="display:none;">
	<div id="phoneReceLeft"></div>
    <div id="phoneReceTableArea"></div>
</div>

<div id="si_co_form" title="強制完結入貨" style="display:none;">
	<div id="si_co_form_bottom">
            
	</div>
</div>

<script>
function checkQty(recQty){
	var temppoNo=$('#si_bot_poNo').html();
	var needToCut=temppoNo.indexOf('-');
	var finalpoNo=temppoNo.substr(needToCut+1,9);

	a=parseInt($('#totalNonRecQty').html());
	b=parseInt($('#totalRecQty').html());
	$('#totalNonRecQty').load(b-(recQty+a));
	a=a-recQty;
	
	//if((b-a)!=0 &&(b-a)!=b){
	if(b-a==b){
		$.ajax({
			url: "../inventory/invGet.php?action=upPoState",
			cache: false,
			async: false,
			dataType: 'html',
			type:'GET',
			data: {	upD_po_State_no:3,
					poNo:finalpoNo,
					modify_by:$('#siRec_staff').val(),
					},
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
		});//----End of ajax------
	} else if(b-a!=b){
		$.ajax({
			url: "../inventory/invGet.php?action=upPoState",
			cache: false,
			async: false,
			dataType: 'html',
			type:'GET',
			data: {	upD_po_State_no:2,
					poNo:finalpoNo,
					modify_by:$('#siRec_staff').val(),
					},
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
		});//----End of ajax------
	}
	
}

    
$('#si_co_form').dialog('distory');
		var dialogOption20 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 340,
			closeOnEscape: true,
			modal: true,
			resizable: false,
			beforeOpen: function(){
			},
			open: function () {
			},
			close: function () {	
			},
			beforeClose: function() {
			},
			buttons : {
				"儲存": function() {
					var bValid = false;
					var legth = $('#si_co_desc').val().length;
					bValid = ( legth == 0 ) ? 0:true;
					var pono = $('#si_co_poNo').val();
					if (bValid){
						$.ajax({
							url: "../inventory/invGet.php?action=upPoState",
							cache: false,
							async: false,
							dataType: 'script',
							type:'GET',
							data: {	
								upD_po_State_no:4,
								poNo:cutPoNo(pono),
								modify_by:$('#si_co_staff').val(),
								desc:$('#si_co_desc').val(),
							},
							error: function(xhr) {
								alert('Ajax request Error!!!!!');
							},
							success: function(response) {
								if(upPoState[0]==0)
									$("#si_co_errMsg").html("員工編號不存在").css({"display":"block","color":"red"}).delay(1000).fadeOut(300);
								else if(upPoState[0]==1){
									$("#si_co_form").dialog("close");
									findPOHead($('#si_poNo').val());
								}
							},
						});//----End of ajax------
					} else if (bValid ==0){
						$("#si_co_errMsg").html("請輸入原因").css({"display":"block","color":"red"}).delay(1000).fadeOut(300);
					}
						
				},
				"取消": function() {
					$( this ).dialog("close");
				},
			},
		}; //end of dialogOption20

$('#si_co_form').dialog(dialogOption20);
//---End of si_co_form dialog------------------------------

$('#phoneReceForm').dialog('distory');
		var dialogOption13 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 900,
			closeOnEscape: true,
			modal: true,
			resizable: false,
			beforeOpen: function(){
				imeiArray=[];
			},
			open: function () {

				$(this).dialog(dialogOption13); //initializ the dailog once again to clean the data that saved at before
			},
			close: function () {
				
			},
			beforeClose: function() {
				$('#phoneReceTableArea').html(null);
				imeiQty=0;
				imeiArray=[];
			},
			buttons : {
				"儲存": function() {
					recMobile();
				},
				"取消": function() {
					$( this ).dialog("close");
				},
			},
		}; //end of dialogOption13

		$('#phoneReceForm').dialog(dialogOption13);
//---End of phoneReceForm dialog------------------------------

$('#moreGoodsReceForm').dialog('distory');
			var dialogOption16 = {autoOpen:false,};
$('#moreGoodsReceForm').dialog(dialogOption16);

function cutPoNo(poNo){
	var _idx_cut=poNo.indexOf("-");
	var poNo_length=poNo.length;
	var after_cut = poNo.substring(_idx_cut+1,poNo_length);
	return after_cut;
}
function recGoods(podNo,qty,accphone,incost,recedQty){
		tempRecedQty=recedQty;
		tempRecqty=qty;
		temppodNo=podNo;
	if(accphone== 0){ //0 是acc 1是phone
            $('#moreGoodsReceForm').dialog('distory');
            var dialogOption16 = {
                autoOpen:false,  //defult must be false
                height: 170,
                width: 350,
                closeOnEscape: true,
                modal: true,
                resizable: false,
                async: false,
                beforeOpen: function(){
                    $('#maxQtyMsg_z').html(qty);
                },
                open: function () {
                    $('#maxQtyMsg_z').html(qty);
                    $(this).dialog(dialogOption16); //initializ the dailog once again to clean the data that saved at before
                },
                close: function () {
                    tempRecqty=0;
                    $('#recQty').val(null);
                    $('maxQtyMsg_z').html(null);
                    $('#maxQtyMsg_z').removeClass("newClass");
                    $('#qtyMsg').removeClass("newClass");
                },
                beforeClose: function() {
                },
                buttons : {
                    "確認": function() {
                        subStInQty();
                    },
                    "取消": function() {
                        $( this ).dialog( "close" );
                    },
                },
            }; //end of dialogOption16

            $('#moreGoodsReceForm').dialog(dialogOption16);
    //---End of moreGoodsReceForm dialog------------------------------
            $('#moreGoodsReceForm').dialog('open');
	}
	else {
		$('#phoneReceLeft').html('<fieldset>'+
                    '<legend>電話資料</legend>'+
                    '    <table border="1" cellpadding="2px" style="float:left;" width"100%">'+
                    '		<tr><td style="width:110px; background-color:#9B9B9B;">Phone ID</td><td style="width:100px; background-color:#CCC;"><div id="ph_phID"></div></td>'+
                    '			<td style="width:110px; background-color:#9B9B9B;">牌子</td><td style="width:100px; background-color:#CCC;"><div id="ph_manu"></div></td></tr>'+
                    '		<tr><td style="background-color:#9B9B9B;">Phone Name</td>'+
                    '			<td td colspan="3" style="background-color:#CCC;"><div id="ph_name"></div></td></tr>'+
                    '		<tr><td style="background-color:#9B9B9B;">Color</td><td style="background-color:#CCC;"><div id="ph_color"></div></td>'+
                    '			<td style="background-color:#9B9B9B;">State</td><td style="background-color:#CCC;"><div id="ph_state"></div></td></tr>'+
                    '		<tr><td style="background-color:#9B9B9B;">原價</td><td style="background-color:#CCC;"><div id="ph_opri"></div></td>'+
                    '			<td style="background-color:#9B9B9B;">特價</td><td style="background-color:#CCC;"><div id="ph_spri"></div></td></tr>'+
                    '	</table>'+
                    '<div id=ph_typeNo style="display:none;"></div>'+
                    '</fieldset>'+
                    '<div class="underline" style="margin:10px 0 10px 0"></div>'+
                    '<fieldset>'+
                    '<legend>電話訂貨資料</legend>'+
                    '    <table border="1" cellpadding="2px" style="float:left;" width"100%">'+
                    '		<tr><td style="width:110px; background-color:#9B9B9B;">PO No.</td><td style="width:100px; background-color:#CCC;"><div id="ph_pono"></div></td>'+
                    '			<td style="width:110px; background-color:#9B9B9B;">POD No.</td><td style="width:100px; background-color:#CCC;"><div id="ph_podno"></div></td></tr>'+
                    '		<tr><td style="background-color:#9B9B9B;">Order Qty</td><td style="background-color:#CCC;"><div id="ph_oqty"></div></td>'+
                    '			<td style="background-color:#9B9B9B;">Cost</td><td style="background-color:#CCC;"><div id="ph_cost"></div></td></tr>'+
                    '	</table>'+
                    '</fieldset>'+
                    '<div class="underline" style="margin:10px 0 10px 0"></div>'+
                    '<label for="ph_recImei" class="tt">IMEI : </label>'+
                    '<input type="text" id="ph_recImei"  maxlength="15" onclick="select();" onkeyup="return validateNumber($(this),value)"/>'+
                    '<br /><sapn class="recQty_msg tau"></sapn><sapn id="tempListNum" class="tau" style="margin:0 0 0 50px;">列表中數量 : 0</sapn>'+
                    '<div class="err_msg tat" style="display:none;"></div>');
									
		document.getElementById('ph_recImei').onkeydown = addImeiToList;
		
		$('#phoneReceTableArea').html('<table  width="100%" id="phoneReceTable" border="1">'+
											'<tr>'+
												'<td style="width: 25px">No.</td>'+
												'<td style="width:150px; text-align: center;">IMEI</td>'+
												'<td style="width:100px;text-align: center;">Del</td>'+
											'</tr>'+
										'</table>');
		getPhoneDetail(temppodNo);
		$('#ph_pono').html($('#si_bot_poNo').html());
		$('#ph_podno').html(temppodNo);
		$('#ph_oqty').html(qty);
		$('#ph_cost').html(incost);
		$('.recQty_msg').html('已收數量 : '+recedQty);
		$('#phoneReceForm').dialog('open');
	}
}

document.getElementById('si_poNo').onkeyup = findPO;
document.getElementById('recQty').onkeydown = subStInQtyByEnt;
</script>


<link href="../css/inventory.css" type="text/css" link rel="stylesheet" media="screen"/>