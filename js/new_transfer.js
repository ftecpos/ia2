var imeiArray = [];
var imeiQty=0;
function addTransfer(){
    if(!checkTransferShopList() || !checkFtecdnno(shopno)){
        return false;
    }
        $('#addTransBut').html(null);
        var shopInfoObj = new Object();
        shopInfoObj.shopno = shopno;
        shopInfoObj.shopid = shopid;
        shopInfoObj.staff_id=$('#staff_id').html();
        shopInfoObj.staff_no=$('#staff_no').html();
        shopInfoObj.toRetail=$('#shop_list').val();
        shopInfoObj.ftecdnno=$('#dn_no').val();
		
		
            $.ajax({
                url: "../inventory/invTrans.php?action=addTrans",
                cache: false,
                dataType: 'html',
                type:'POST',
                data: {
                        shopInfoObj:shopInfoObj,
                        transferGoodsOjbArrList : JSON.stringify(transferGoodsOjbArrList),
                },
                error: function(xhr) {
                        alert('Ajax request Error!!!!!');
                },
                statusCode: {
                        404: function() {
                                alert('page not found');
                        }
                },
                success: function(response) { 
                        //alert(response);
                        call_new_transfer();
                }
            });//----End of ajax------
    
}
function addMobileTransfer(){
    
}


function checkTransferGoodsOjbArrList(){
    if(transferGoodsOjbArrList.length>0){
        $('#addTransBut').html('<input type="button" onclick="addTransfer()" value="新增轉貨單" />');
    }
}
function checkTransferShopList(){
    if($('#shop_list').val()==0){
        alert("Please select retail shop");
        return false;
    }
    return true;
}
function checkFtecdnno(shopno){
    $dn_no = $('#dn_no').val();
    //check it is office or not
    if(!$dn_no && shopno == 1){
        alert("Please enter DN No.");
        return false;
    }
    return true;
}
function checkmobileTransferShopList(){
    if($('#phoneTransShoplist #shop_list').val()==0)
        return false;
    else
    return true;
}

function addAccToTransfer(accNo){
	$.ajax({
		url:"../inventory/invTrans.php?action=getTransferGdInfo",
		cache:false,
		dataType:'script',
		type:'GET',
		data:{ accNo:accNo,
                    osarea : osarea,
                    shopno : shopno, },
		error:function(xhr){alert('Ajax request Error!!!');},
		success:function(response){
			$('#goodsTransferForm_maxqty').html(transObj.ava_bal);
			$('#goodsTransferForm').dialog('open');
		}
	});
	$('#findAccForm').dialog('close');
}

function goodsTransferFormEnt(e){
    var transQty = $('#transQty').val();
	if(transQty.length>0 && e.which==13 && transQty!='0'){
		checkTransQty($('#goodsTransferForm_maxqty').html());
	}
}

function checkTransQty(goodsTransferForm_maxqty){
    if($('#transQty').val()!=null&&$('#transQty').val()<=parseInt(goodsTransferForm_maxqty,10)){
        var transQty = parseInt($('#transQty').val(),10);
        transObj.qty= transQty;
		
        $('#trtb').append('<tr> <td>'+transObj.bcode+'</td>'+
                               '<td>'+transObj.accName+'</td>'+
                               '<td>'+transObj.price+'</td>'+
                               '<td>'+transObj.qty+'</td></tr>');
										
		transferGoodsOjbArrList.push(transObj);
		checkTransferGoodsOjbArrList();
		
		$('#goodsTransferForm').dialog('close');
		$('#goodsTransferForm_maxqty').removeClass("newClass");
		$('#transQtyMsg').removeClass("newClass");
	} else {
		$('#goodsTransferForm_maxqty').addClass( "newClass", 100 );
		$('#transQtyMsg').addClass( "newClass", 100 );
		$('#transQty').select();
		return false;
	}
}// end of subStInQty() function

function findTransAccDetail(e){
    PID = $("#TranspID").val();
    getTransAccList('acc.acc_id',PID);
    if(e.which==13){
    }
    if(PID==''){
            $('#findTransAccBottom').load("../sales/salesGet.php?action=getTransAccList&pageNo=0&limitShopno="+shopno);
    }
}

function checkLimit(){
	return	$('#shoplimit').is(':checked');
}

//- - - - -getTransAccList() - - - - - -
//2013-01-11
function getTransAccList(_shortByA,_shortByB){
   $.ajax({
        url:"../sales/salesGet.php?action=getTransAccList",
        cache:false,
        dataType:'html',
        type:'GET',
        data:{ pageNo : 0,
                shortByA : _shortByA,
                shortByB : _shortByB,
            limitShopno : shopno},
        error:function(xhr){alert('Ajax request Error!!!');},
        success:function(response){
                $('#findTransAccBottom').html(response);
        }
    });
        
      /*  
	if(checkLimit())
		$('#findTransAccBottom').load("../sales/salesGet.php?action=getTransAccList&pageNo=0&shortByA="+shortByA+"&shortByB="+shortByB+"&limitShopno="+shopno);	
	else
		$('#findTransAccBottom').load("../sales/salesGet.php?action=getTransAccList&pageNo=0&shortByA="+shortByA+"&shortByB="+shortByB+"&limitShopno="+shopno);
            */
}
//- - - -  end of getTransAccList() - - - - - -


//-------findTransAcc() - - - - - - -
function findTransAcc(){
	$('#findTransAccFirMenu').html(null);
	$('#findTransAccSecMenu').html(null);
	$('#findTransAccBottom').html(null);
	$('#findTransAccForm').dialog(null);
	$('#findTransAccCode').val(null);
	$('#findTransAccKey').val(null);
	
	$('#TranspID').val(null);
		
	/*
	$('#findTransAccFirMenu').html('<span style="font-size:20px; margin:0 0 0 0px;">Order by</span>'+
        '<input type="button" value="配件種類" class="finAccByType faby1" onclick="getAccTypeMenu()"/>'+
        '<input type="button" value="配件製造商" class="finAccByType faby2" onclick="getAccManuMenu()"/>'+
        '<input type="button" value="配件" class="finAccByType faby3" onclick="getAccColorMenu()"/>'+
        '<input type="button" value="配件狀態" class="finAccByType faby4" onclick="getAccStateMenu()"/>'+
		'<input type="checkbox" id="shoplimit" name="shoplimit"/><label for="shoplimit" style="font-size:17px">只顯示店舖'+shopid+'</label>');
		*/
		
b=0;

	$('#findTransAccBottom').load("../sales/salesGet.php?action=getTransAccList&pageNo=0&limitShopno="+shopno);
	addFindAccFoot();

	$('#findTransAccForm').dialog('open');
}
//---end of findTransAcc() - - - - -

function findTransMobile(){
    /*
	$('#findTransMobileFirMenu').html(null);
	$('#findTransMobileSecMenu').html(null);
	$('#findTransMobileBottom').html(null);
	$('#findTransMobileForm').dialog(null);
	$('#findMobileCode').val(null);
	$('#findMobileKey').val(null);
	
	$('#pdID').val(null);
	*/	
	//$('#findTransMobileFirMenu').html('<span style="font-size:20px; margin:0 0 0 0px;">Order by</span>'+
        //'<input type="button" value="電話製造商" class="finMobileBut faby1" onclick="getMobileTypeMenu()"/>'+
        //'<input type="button" value="電話顔色" class="finMobileBut faby2" onclick="getMobileColorMenu()"/>'+
        //'<input type="button" value="電話名稱" class="finMobileBut faby3" onclick="getMobileNameMenu()"/>'+
        //'<input type="button" value="電話種類狀態" class="finMobileBut faby4" onclick="getMobileStateMenu()"/>');
//b=0;
//	$('#findTransMobileBottom').load("../inventory/mobile/viewmobile.php?action=getMobileList&pageNo=0&shopno="+shopno);
//	addFindMobileFoot();

//	$('#findTransMobileForm').dialog('open');

    $('#phoneTransForm').dialog('open');
}
function checkTransImeiExist(imei){
    var canAdd=1; //1=cannot not add 0=can add
    var imeiArrLength = imeiArray.length;
    $.ajax({
        url:"../inventory/invGet.php?action=checkImeiExist",
        cache: false,
        dataType: 'script',
        type:'GET',
        async: false,
        data:{ imei:imei,
               shopno:shopno,},
        error: function(xhr){ alert('Ajax request Error!!!!!');	},
        success: function(response) {
    //alert(response);
            if(response!=0){
                canAdd=0;
                if(imeiArrLength==0){
                    canAdd==0;
                } else {
                    for ( i=0; i < imeiArrLength; i++) {
                        if(imei==imeiArray[i]){
                            canAdd=1; //1=cannot add 0=can add 3=db err msg
                            break;
                        }
                        else
                            canAdd=0; //1=cannot add 0=can add 3=db err msg
                    }
                }
            }else{
                canAdd=3; //1=cannot add 0=can add 3=db err msg
                err_msg="IMEI不屬於此店舗, 不能增加";
            } //end of response if else
        },
    });//end of ajax

    if(canAdd==0){
        imeiArray.push(imei);
        imeiQty++;
        $(".err_msg").html("Added").css({"display":"block","color":"GREEN"}).delay(800).fadeOut(300);
        $('#phoneTransTable').append('<tr><td>'+imeiQty+'</td><td>'+imei+'</td><td>---</td></tr>');
    }		
    else if(canAdd==3)
        $(".err_msg").html(err_msg).css({"display":"block","color":"red"}).delay(5000).fadeOut(300);
    else{
        err_msg="IMEI 已存在於列表中, 不能重複增加";
        $(".err_msg").html(err_msg).css({"display":"block","color":"red"}).delay(1000).fadeOut(300);
    }
}
function openTransImeiList(phoneTypeNo,shopNo){
	$.ajax({
		url:"../inventory/mobile/viewmobile.php?action=getIMEIList",
		cache:false,
		dataType:'html',
		type:'GET',
		data:{ phoneTypeNo:phoneTypeNo,
			   shopNo : shopNo },
		error:function(xhr){alert('Ajax request Error!!!');},
		success:function(response){
			$('#listTransImeiTop').html('<sapn>只會顯示店舖 '+shopid+' 的IMEI</span>');
			$('#listTransImeiBottom').html(response);
		}
	});
	
	$('#listTransImeiForm').dialog('open');

}
function addMobileToTransfer(phoneNo,shopNo){
	
	if(shopNo==shopno){
		$.ajax({
			url:"../inventory/mobile/viewmobile.php?action=getTransMobileInfo",
			cache:false,
			dataType:'script',
			type:'GET',
			data:{ phone_no:phoneNo,
				   osarea : osarea },
			error:function(xhr){alert('Ajax request Error!!!');},
			success:function(response){
				
				$('#trtb').append('<tr><td>'+transObj.imei+'</td><td>'+transObj.phoneName+
								 '</td><td>'+transObj.price+'</td><td>'+transObj.qty+'</td></tr>');
				transferGoodsOjbArrList.push(transObj);
				checkTransferGoodsOjbArrList();
			}
		});
		$('#listImeiForm').dialog('close');
		$('#findMobileForm').dialog('close');
	} else
		alert("非本店貨物");
}

document.getElementById('transQty').onkeydown = goodsTransferFormEnt;
