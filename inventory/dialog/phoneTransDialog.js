function valid_imei(imei){
	var pattern=new RegExp(/^[0-9]+$/);
	return pattern.test(imei);
}

function addImeiToTransList(e){
    temp_ph_transImei = document.getElementById('ph_transImei');
    temp_ph_transImei_val = temp_ph_transImei.value;

    if(temp_ph_transImei_val.length == 15 && e.which==13){
       if(valid_imei(temp_ph_transImei_val)){
            checkTransImeiExist($('#ph_transImei').val());
            $('#ph_transImei').val(null);
            $('#tempListNum').html('列表中數量 : '+imeiQty);
       }else{
            alert('Invalid IMEI');
       }
    }
}// end of addImeiToTransList(e) funciton
//
//function area


function addTransMobile(){
    if(!checkmobileTransferShopList()){
        alert("Please select retail shop");
        return false;
    }
    var shopInfoObj = new Object();
    shopInfoObj.staff_id=$('#staff_id').html();
    shopInfoObj.staff_no=$('#staff_no').html();
    shopInfoObj.toRetail=$('#phoneTransShoplist #shop_list').val();
    
    $.ajax({
        url: "../inventory/invGet.php?action=addtransmobile",
        cache: false,
        dataType: 'json',
        type:'POST',
        data: {
            imei:imeiArray,
            shopinfo:shopInfoObj            
        },
        error: function(xhr) {
            alert('Ajax request Error!!!!!');
        },
        success: function(response) {
            //findPOHead($('#si_poNo').val());
            console.log(response);
            //var data = response;
            if(response.isok==1){
                imeiArray = null;
                imeiQty=0;
                $('#phoneTransForm').dialog("close");
            } else {
            
            }
        },
    });//----End of ajax------

}// end of recMobile() function


$('#phoneTransForm').dialog('distory');
    var phoneTransForm_dialog = {
        autoOpen:false,  //defult must be false
        height: 530,
        width: 800,
        closeOnEscape: true,
        modal: true,
        resizable: false,
        beforeOpen: function(){
            imeiArray=[];
        },
        open: function () {
            $(this).dialog(phoneTransForm_dialog); //initializ the dailog once again to clean the data that saved at before
        },
        close: function () {

        },
        beforeClose: function() {
            $('#phoneTransTableArea').html(null);
            imeiQty=0;
            imeiArray=[];
        },
        buttons : {
            "儲存": function() {
                addTransMobile();
        },
            "取消": function() {
                $( this ).dialog("close");
            },
        },
    }; //end of dialogOption13

    $('#phoneTransForm').dialog(phoneTransForm_dialog);
//---End of phoneTransForm dialog------------------------------

$('#phoneTransLeft').html('<fieldset>'+
        
    '<legend>電話資料</legend>'+
    /*
    '    <table border="1" cellpadding="2px" style="float:left;" width"100%" >'+
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
    */
    '<div id="phoneTransShoplist" style="margin:10px 0 10px 0"></div>'+
    '<label for="ph_transImei" class="tt">IMEI : </label>'+
    '<input type="text" id="ph_transImei"  maxlength="15" onclick="select();" onkeyup="return validateNumber($(this),value)"/>'+
    '<br /><sapn class="recQty_msg tau"></sapn><sapn id="tempListNum" class="tau" style="margin:0 0 0 50px;">列表中數量 : 0</sapn>'+
    '<div class="err_msg tat" style="display:none;"></div>');
									
    document.getElementById('ph_transImei').onkeydown = addImeiToTransList;

    $('#phoneTransTableArea').html('<table  width="100%" id="phoneTransTable" border="1">'+
                                    '<tr>'+
                                            '<td style="width: 25px">No.</td>'+
                                            '<td style="width:150px; text-align: center;">IMEI</td>'+
                                            '<td style="width:100px;text-align: center;">Del</td>'+
                                    '</tr>'+
                                    '</table>');
    getPhoneDetail(podNo);
    $('#ph_pono').html($('#si_bot_poNo').html());
    $('#ph_podno').html(podNo);
    $('#ph_oqty').html(qty);
    $('#ph_cost').html(incost);
    $('.recQty_msg').html('已收數量 : '+recedQty);
