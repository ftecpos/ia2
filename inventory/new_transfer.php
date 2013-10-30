<?php include("../check_login.php");?>
<?php error_reporting(0); ?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Goods Transfer</title>
<script src="../js/new_transfer.js" type="text/javascript"></script>
<script src="../js/comm.js" type="text/javascript"></script>
<script src="../inventory/dialog/phoneTransDialog.js" type="text/javascript"></script>
<link href="../css/inventory.css" type="text/css" link rel="stylesheet" media="screen"/>
<style>
.newClass { color:#FF0000;}
</style>
</head>

<script>
var transferGoodsOjbArrList = new Array();

$(function(){
//---------------findTransAccForm------------------------------------------
	$('#findTransAccForm').dialog('distory');
	var dialogOption_tr1 = {
		autoOpen:false,  //defult must be false
		height: 530,
		width: 1010,
		closeOnEscape: false,
		modal: true,
		resizable: true,
		open: function () {
		//	$('#findTransAccForm').dialog('distory');
			$(this).dialog(dialogOption_tr1); //initializ the dailog once again to clean the data that saved at before
			$('#findAccTop').hide().show("fade", { }, 1300, callback );
			$('#findAccFirMenu').hide().show("fade", { }, 1400, callback );
			$('#findAccSecMenu').hide().show("fade", { }, 1600, callback );
		},
		buttons : {
			"關閉": function() {
				$( this ).dialog( "close" );
			},
		},
	};//end of dialogOption	
	$('#findTransAccForm').dialog(dialogOption_tr1);
//---End of findTransAccForm dialog------------------------------
//---------------findTransMobileForm------------------------------------------
	$('#findTransMobileForm').dialog('distory');
	var dialogOption_tr12 = {
		autoOpen:false,  //defult must be false
		height: 530,
		width: 1010,
		closeOnEscape: false,
		modal: true,
		resizable: true,
		open: function () {
			$(this).dialog(dialogOption_tr12); //initializ the dailog once again to clean the data that saved at before
			$('#findTransMobileTop').hide().show("fade", { }, 1300, callback );
			$('#findTransMobileFirMenu').hide().show("fade", { }, 1400, callback );
			$('#findTransMobileSecMenu').hide().show("fade", { }, 1600, callback );
		},
		buttons : {
			"關閉": function(){ $(this).dialog("close"); },
		},
	};
	
	$('#findTransMobileForm').dialog(dialogOption_tr12);
//---End of findTransMobileForm dialog------------------------------
//---------------listTransImeiForm------------------------------------------
		$('#listTransImeiForm').dialog('distory');
		var dialogOption_tr3 = {
			autoOpen:false,  //defult must be false
			height: 530,
			width: 430,
			closeOnEscape: true,
//			show:'fade',
//			hide:'fade',
			modal: true,
			resizable: false,
			open: function () {
				$(this).dialog(dialogOption_tr3); //initializ the dailog once again to clean the data that saved at before
			},
			buttons : {
				"關閉": function() {
					$( this ).dialog( "close" );
				},
			},
		};//end of dialogOption
		$('#listTransImeiForm').dialog(dialogOption_tr3);
//---End of listTransImeiForm dialog------------------------------

//---------------goodsTransferForm------------------------------------------
	$('#goodsTransferForm').dialog('distory');
	var dialogOption_tr2 = {
		autoOpen:false,  //defult must be false
		height: 200,
		width: 400,
		closeOnEscape: false,
		modal: true,
		resizable: true,
		open: function () {
			$(this).dialog(dialogOption_tr2);
		},
		close:function(){
			$('#transQty').val(null);
		},
		buttons : {
			"關閉": function() {
				$( this ).dialog( "close" );
			},
		},
	};//end of dialogOption	
	$('#goodsTransferForm').dialog(dialogOption_tr2);
//---End of goodsTransferForm dialog------------------------------

	$.ajax({
            url: "../inventory/invGet.php?action=get_shop_list",
            cache: false,
            dataType: 'html',
            type:'POST',
            async: false,
            data: { no_name:1
            },
            error: function(xhr) {
                alert('Ajax request Error!!!!!');
            },
            success: function(response){
                $('#trans_shopList').html(response);
                $('#phoneTransShoplist').html(response);
                //$('#phoneTransLeft').html(response);
            }
	});//----End of ajax------

});

document.getElementById('findTransAccKey').onkeyup = findAccByKeyword;
document.getElementById('findTransAccCode').onkeydown = findCodeDetail;
document.getElementById('TranspID').onkeyup = findTransAccDetail;

</script>

<input type="button" value="加入配件" onclick="findTransAcc()"/>
<input type="button" value="加入電話" onclick="findTransMobile()"/>
<?php 
    if($_SESSION['retail_no']== 1 ){
        print_r('<div>DN No.<input type="text" id="dn_no" placeholder="Enter Delivery Note No."/></div>');
    }
?>

<div id="trans_shopList"></div>
<section id="productList">
	<table id="trtb" class="saltb"  cellpadding="0" cellspacing="0" style="width: 100%;" >
            		<thead><th style="width: 100px">條碼/IMEI</th><th>貨品名稱</th><th style="width: 100px">售價</th>
            			<th style="width: 100px">數量</th></thead>
                    <tbody></tbody>
	</table>
</section>
<div id="addTransBut"></div>
 
<!-- Dialog area -->
<div id="findTransAccForm" title="查找配件(轉貨)" style="display:none">
	<div id="findTransAccTop">
		<label for="TranspID" class="ttsmall">Product id </label>
		<input type="text" name="TranspID" id="TranspID" class="text ui-widget-content ui-corner-all"
         onkeyup="//return cleanAccRecord($(this),value);" onclick="select();" style="color:#FF9787; width:160px;"/>
         <label for="findTransAccCode" class="ttsmall">Barcode </label>
		<input type="text" name="findTransAccCode" id="findTransAccCode" class="text ui-widget-content ui-corner-all" maxlength="13"
         onkeyup="return cleanAccRecord($(this),value);" onclick="select();" style="color:#FF9787; width:160px;"/>
         <label for="findTransAccKey" class="ttsmall">Keyword </label>
		<input type="text" name="findTransAccKey" id="findTransAccKey" class="text ui-widget-content ui-corner-all"
         onkeyup="" onclick="select();" style="color:#FF9787; width:160px;"/>
         <input type="button" value="Reset" class="finAccByType" onclick="findTransAcc()"style="height:25px;"/>
	</div>  <!--CSS temp-->
	<div id="findTransAccFirMenu"></div>
    <div id="findTransAccSecMenu"></div>
	<div id="findTransAccBottom"></div>
    <div id="findTransAccFoot"></div>
</div>

<div id="goodsTransferForm" title="轉貨數量" style="display:none;">
    <div id="goodsTransferFormBottom">
        <span id="transQtyMsg">不可超過</span><span id="goodsTransferForm_maxqty"></span>
        <fieldset>
            <table cellpadding="5">
                <tr>
                    <td><label for="transQty" >轉貨數量   </label></td>
                    <td>
                        <input type="text" name="transQty" id="transQty" onkeyup="return validateNumber($(this),value)"
                                class="text ui-widget-content ui-corner-all" maxlength="5"
                                onclick="select()"/>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>
<div id="findTransMobileForm" title="查找手機(轉貨)" style="display:none;">
	<div id="findTransMobileTop">         
         <label for="findMobileCode" class="ttsmall">IMEI </label>
		<input type="text" name="findMobileCode" id="findMobileCode" class="text ui-widget-content ui-corner-all" maxlength="15"
         onkeyup="return cleanMobileRecord($(this),value);" onclick="select();" style="color:#34C631; width:175px;"/>
         
         <label for="findMobileKey" class="ttsmall">Keyword </label>
		<input type="text" name="findMobileKey" id="findMobileKey" class="text ui-widget-content ui-corner-all"
         onkeyup="" onclick="select();" style="color:#34C631; width:160px;"/>
         
         <input type="button" value="Reset" class="finMobileBut" onclick="findMobile()"style="height:25px;"/>
	</div>  
	<div id="findTransMobileFirMenu"></div>
    <div id="findTransMobileSecMenu"></div>
	<div id="findTransMobileBottom"></div>
    <div id="findTransMobileFoot"></div>
</div>

<div id="listTransImeiForm" title="IMEI List" style="display:none;">
	<div id="listTransImeiTop">1</div>
	<div id="listTransImeiBottom">
    123
    </div>
</div>

<div id="phoneTransForm" title="電話轉貨" style="display:none;">
	<div id="phoneTransLeft"></div>
    <div id="phoneTransTableArea"></div>
</div>

<!-- End of dialog area-->
</html>