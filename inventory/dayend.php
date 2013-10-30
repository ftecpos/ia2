<?php include("../check_login.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>day end</title>
<script type="text/javascript" src="../js/inventory.js"></script>
</head>
<script>
$(function() {
	$('#dend_bottom').load("../inventory/invGet.php?action=get_dayend&shopno="+shopno);
	$('#dend_staff').val($('#staff_id').html());
	$('#si_poNo').focus();
	$('#shopNo').val(shopno);
	$('#shopId').val(shopid);
});
</script>
<style>
.newClass { color:#FF0000;}
</style>
<body>
	<div id="dend_head">
    	<label for="dend_staff" class="gg">日結員工 : </label>
		<input type="text" name="dend_staff" id="dend_staff" class="dend_col rec_staff" maxlength="4"	onclick="select();"  onkeyup="//return validateNumber($(this),value)"/>

        <label for="si_poNo" class="gg">Enter No. : </label>
		<input type="text" name="si_poNo" id="si_poNo" class="dend_col si_poNo" maxlength="10"	onclick="select();"  onkeyup="//return validateNumber($(this),value)"/>
        <label for="shopNo" class="gg">Shop No. : </label>
		<input type="text" id="shopNo" class="dend_col si_shopNo" maxlength="2" readonly="readonly"/>
        <label for="shopId" class="gg">Shop ID : </label>
		<input type="text" id="shopId" class="dend_col shopId" maxlength="2" readonly="readonly"/>
	</div>
	
    <div id="dend_fir_menu" display:none;>結帳後不能修改</div>
	<div id="dend_bottom"></div>
	<div id="dend_foot" style="display:none;">
		<div id="si_but_area" style="float:right;"></div>
		<div id="po_detail_area" style="clear:both"></div>
    </div>
  <!--  <div id="totalNonRecQty" style="display:none;"></div>-->
    <div id="totalNonRecQty" style="display:none;"></div>
    <br />
    <div id="totalRecQty" style="display:none;"></div>
    
</body>
</html>

<div id="dend_confirm_form" title="確認結帳" style="display:none;">
	<fieldset>
    	<p>結帳後不能修改</p>
    </fieldset>
</div>

<script>
$('#dend_confirm_form').dialog('distory');
		var dialogOption22 = {
			autoOpen:false,  //defult must be false
			height: 170,
			width: 350,
			closeOnEscape: true,
			modal: true,
			resizable: false,
			buttons : {
				"確認": function() {
					$.ajax({
						url: "../inventory/invGet.php?action=insert_dend",
						cache: false,
						dataType: 'html',
						type:'GET',
						async:false,
						data: {
							date:date,
							dendArray : sendToServer,
							shopno : shopno,
							dend_staff:$('#dend_staff').val(),
						},
						error: function(xhr) {
							alert('Ajax request Error!!!!!');
						},
						success: function(response) {
							$('#dend_confirm_form').dialog('close');
							callDayEnd();
							//alert(response);
						},
					});//----End of ajax------
				},
				"取消": function() {
					$( this ).dialog("close");
					
				},
			},
		}; //end of dialogOption22
		$('#dend_confirm_form').dialog(dialogOption22);
//---End of dend_confirm_form dialog------------------------------

</script>

<link href="../css/inventory.css" type="text/css" link rel="stylesheet" media="screen"/>


