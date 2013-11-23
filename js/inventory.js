var imeiArray = [];
var imeiQty=0;

function subStInQtyByEnt(e){
	var recqty = document.getElementById('recQty');
    var Trecqty = recqty.value;
	if(Trecqty.length>0 && e.which==13 && Trecqty!='0'){
		subStInQty();
	}
}//end of subStInQtyByEnt(e)

function createRecNo(pod_no){
    $.ajax({
        url: "../inventory/invGet.php?action=createRecNo",
        cache: false,
        dataType: 'html',
        type:'GET',
        async: false,
        data: {
            pod_no:pod_no,
            staffid:$('#siRec_staff').val(),
        },
        error: function(xhr) {
            alert('Ajax request Error!!!!!');
        },
        success: function(response) {
            sinno_ref_no = response;
        }
    });//----End of ajax------
}

function subStInQty(){
    if($('#recQty').val()!=null&&$('#recQty').val()<=tempRecqty){
        checkQty($('#recQty').val());
        createRecNo(temppodNo);
        $.ajax({
            url: "../inventory/invGet.php?action=recGoods",
            cache: false,
            dataType: 'html',
            type:'GET',
            data: {
                podNo:temppodNo,
                rec_Qty:$('#recQty').val(),
                poDate:$('#si_bot_pcd').html(),
                staffid:$('#siRec_staff').val(),
                shopno:shopno,
	//				po_State_no:po_State_no,
                poNo:tempPoNoVal,
                sinno_ref_no:sinno_ref_no,
                forshop:tempforshop
            },
            error: function(xhr) {
                alert('Ajax request Error!!!!!');
            },
            success: function(response) {
                findPOHead($('#si_poNo').val());
            }
        });//----End of ajax------
        $('#moreGoodsReceForm').dialog("close");
    } else {
        $('#maxQtyMsg_z').addClass( "newClass", 100 );
        $('#qtyMsg').addClass( "newClass", 100 );
        $('#recQty').select();
    }
}// end of subStInQty(forshop) function
function recMobile(){
	var imeiArrLength = imeiArray.length;
	createRecNo(temppodNo);
	for ( i=0; i < imeiArrLength; i++) {
		
			$.ajax({
				url: "../inventory/invGet.php?action=recMobile",
				cache: false,
				dataType: 'html',
				type:'GET',
				data: {
					imei:imeiArray[i],
					phoneType_no:$('#ph_typeNo').html(),
					shopno:shopno,
					phoneState_no:1,
					poDetail_no:$('#ph_podno').html(),
					sinno_ref_no:sinno_ref_no,
					cost:$('#ph_cost').html(),
				},
				error: function(xhr) {
					alert('Ajax request Error!!!!!');
				},
				success: function(response) {
					findPOHead($('#si_poNo').val());
				},
			});//----End of ajax------
	}
	
	a=parseInt($('#totalNonRecQty').html());
	b=parseInt($('#totalRecQty').html());
	a = a-imeiQty;
	
	
	var temppoNo=$('#si_bot_poNo').html();
	var needToCut=temppoNo.indexOf('-');
	var finalpoNo=temppoNo.substr(needToCut+1,9);
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
	
	$('#phoneReceForm').dialog('close');
	
}// end of recMobile() function


function findPOHead(poNo){
	
    $('#si_poNo').val(poNo);
    $('#si_poNo').select();
    var temppoNo=poNo;
    var needToCut=temppoNo.indexOf('-');
    var finalpoNo=temppoNo.substr(needToCut+1,9);
    //alert(finalpoNo);
    $.ajax({
        url:"../inventory/invGet.php?action=getPOD",
        cache: false,
        dataType: 'script',
        type:'GET',
        data:{	poNo:finalpoNo,	},
        error: function(xhr){ alert('Ajax request Error!!!!!');	},
        success: function(response) {
            $('#poTable').html(null);

            if(tt[0]==1){
                $('#si_bottom').html(null);
                $('#si_foot').css("display","block");
                $('#si_bot_poNo').html(tt[1]);
                $('#si_bot_pcd').html(tt[2]);
                $('#si_bot_cstaff').html(tt[3]);
                $('#si_bot_supp').html(tt[4]);
                $('#si_bot_poState').html(tt[5]);
                $('#si_bot_plocation').html(tt[6]);
                $('#po_detail_area').html(tt[7]);
                po_State_no=tt[8];
                $('#totalNonRecQty').html(tt[9]);
                $('#totalRecQty').html(tt[10]);
                $('#si_forshop').html(tt[14]);

                if(po_State_no==1){
                    //$('#si_but_area').html('<input type="button" value="設定PO指定收貨店舖" class="si_but" onclick="po_updateforshop(\''+tt[1]+'\')"/>');
                } else if(po_State_no==2){
                    if(tt[14] == localStorage.shopid){
                        $('#si_but_area').html('<input type="button" value="Close Order" class="si_but" onclick="si_co(\''+tt[1]+'\')"/>');
                    }
                } else if(po_State_no==3){
                    if(tt[14] != localStorage.shopid){
                        $('#si_but_area').html('<input type="button" value="新增轉貨單到指定店舖" class="si_but" onclick="get_dnno_from_po(\''+tt[1]+'\')"/>');
                    }
                } else if(po_State_no==4){
                    $('#si_but_area')
                        .html('<table border="1" cellpadding="2px" style="float:left;">'+
                                '<tr><td style="width:130px; background-color:#CCC;">Modify By</td><td style="width:180px; background-color:#999;"><div id="">'+tt[11]+'</div></td>'+
                                '<tr><td style="width:130px; background-color:#CCC;">Modify Date</td><td style="width:180px; background-color:#999;"><div id="">'+tt[13]+'</div></td>'+
                                '<tr><td style="width:130px; background-color:#CCC;">Description</td><td style="width:180px; background-color:#999;"><div id="">'+tt[12]+'</div></td>'+
                              '</table>');
                } else
                    $('#si_but_area').html(null);
            } else {
                $('#si_bottom').html('<p style="color:red; font-size:30px;">Record NOT Find</p>');
                $('#si_foot').css('display','none');
            }

				//$('#si_bottom').html(response);
        },
    });//end of ajax
} //end of findPOHead(poNo)
function get_dnno_from_po(pono){
    $('#si_dnno_form_input_pono').val(pono);
    $('#si_dnno_form').dialog('open');
}
function add_transfer_from_po(pono, dnno){
    $.ajax({
        url: "../inventory/invlib.php?action=add_transfer_from_po",
        cache: false,
        async: false,
        dataType: 'json',
        type:'GET',
        data: {	
            pono:pono,
            dnno:dnno
        },
        error: function(xhr) {
            alert('Ajax request Error!!!!!');
        },
        success: function(response) {
            console.log(response);
            if(response.error){
                alert(response.error);
                $('#si_dnno_form').dialog('close');
            }
            if(response.success){
                $('#si_dnno_form').dialog('close');
                findPOHead(pono);
            }
        }
    });//----End of ajax------
}

function recTransfer(trNo){
$('#button_inTable').html(null);
    $.ajax({
        url:"../inventory/invTrans.php?action=upTrans",
        cache: false,
        dataType: 'script',
        type:'GET',
        async: false,
        data:{	
            retailShop_no:shopno,
            transfer_no:trNo,
            userLoginId:$('#siRec_staff').val(),
        },
        error: function(xhr){ alert('Ajax request Error!!!!!');	},
        success: function(response) {
            $('#tr_bot_trState').html('已收貨');
                //alert(response);
        },
    });//end of ajax
}

function findTrDetail(trNo){
	
	$('#tr_transNo').val(trNo);
	$('#tr_transNo').select();
	var temptrNo=trNo;
	var needToCut=temptrNo.indexOf('-');
	var finaltrNo=temptrNo.substr(needToCut+1,9);
	//alert(finalpoNo);
		$.ajax({
			url:"../inventory/invTrans.php?action=getTransDetail",
			cache: false,
			dataType: 'script',
			type:'GET',
			data:{	trNo:finaltrNo,	},
			error: function(xhr){ alert('Ajax request Error!!!!!');	},
			success: function(response) {
				$('#poTable').html(null);
				
				if(tr[0]==1){
					$('#tr_bottom').html(null);
					$('.si_headB').css("display","none");
					
					$('#tr_foot').css("display","block");
					$('#tr_bot_trNo').html(tr[1]);
					
					$('#tr_bot_tcd').html(tr[2]);
					$('#tr_bot_cstaff').html(tr[3]);
//					$('#si_bot_supp').html(tr[4]);
					$('#tr_bot_trState').html(tr[5]);
					$('#tr_bot_fromshop').html(tr[6]);
					$('#tr_bot_toshop').html(tr[7]);
					
					$('#tr_detail_area').html(tr[8]);
					$('#button_inTable').html(tr[9]);
					
					$('#tr_bottom').html(tr[10]);
					$('#tr_bot_dnno').html(tr[11]);
                                        
					
					
				//	po_State_no=tr[8];
				//	$('#totalNonRecQty').html(tr[9]);
				//	$('#totalRecQty').html(tr[10]);
					
				//	if(po_State_no==2)
				//		$('#si_but_area').html('<input type="button" value="Close Order" class="si_but" onclick="si_co(\''+tr[1]+'\')"/>');
				//	else if(po_State_no==4){
				//		$('#si_but_area').html('<table border="1" cellpadding="2px" style="float:left;">'+
				//							   '<tr><td style="width:130px; background-color:#CCC;">Modify By</td><td style="width:180px; background-color:#999;"><div id="">'+tr[11]+'</div></td>'+
				//							   '<tr><td style="width:130px; background-color:#CCC;">Modify Date</td><td style="width:180px; background-color:#999;"><div id="">'+tr[13]+'</div></td>'+
				//							   '<tr><td style="width:130px; background-color:#CCC;">Description</td><td style="width:180px; background-color:#999;"><div id="">'+tr[12]+'</div></td>'+
				//							   '</table>');
				//	} else
						$('#si_but_area').html(null);
				}
				
				else{
					$('#tr_bottom').html('<p style="color:red; font-size:30px;">Record NOT Find</p>');
					$('#tr_foot').css('display','none');
				}
				
				//$('#si_bottom').html(response);
			},
		});//end of ajax
} //end of findTrDetail(trNo)



function getPhoneDetail(podNo){
	$.ajax({
		url:"../inventory/invGet.php?action=getPhoneDetail",
		cache: false,
		dataType: 'script',
		type:'GET',
		data:{	podNo:podNo,	},
		error: function(xhr){ alert('Ajax request Error!!!!!');	},
		success: function(response) {			
			if(phDetail[0]==1){
				$('#ph_phID').html(phDetail[1]);
				$('#ph_manu').html(phDetail[2]);
				$('#ph_name').html(phDetail[3]);
				$('#ph_color').html(phDetail[4]);
				$('#ph_state').html(phDetail[5]);
				$('#ph_opri').html(phDetail[6]);
				$('#ph_spri').html(phDetail[7]);
				$('#ph_typeNo').html(phDetail[8]);
			}
			else{
				alert("System error, please contact the system Administrator");
			}
		},
	});//end of ajax
	
}// end of getPhoneDetail(podNo)

function findPO(e){
	 tempPoNo = document.getElementById('si_poNo');
	 tempPoNoVal = tempPoNo.value;
	 

	if(tempPoNoVal.length > 0 && e.which==13){
		 findPOHead(tempPoNoVal);
	} else if(tempPoNoVal.length==0){
		$('#si_bottom').load("../inventory/invGet.php?action=getSiBottom&pageNo=0");
		$('#si_foot').css("display","none");
	}
}// end of findPo(e) funciton
function findTR(e){
	 tempTrNo = document.getElementById('tr_transNo');
	 tempTrNoVal = tempTrNo.value;
	 

	if(tempTrNoVal.length > 0 && e.which==13){
		 findTrDetail(tempTrNoVal);
	} else if(tempTrNoVal.length==0){
		//$('#tr_bottom').load("../inventory/invTrans.php?action=getTransList&shopno="+shopno);
                $('#tr_foot').css("display","none");
		$('.si_headB').css("display","block");
                $.ajax({
                    url: "../inventory/invTrans.php",
                    cache: false,
                    dataType: 'html',
                    type:'GET',
                    async: false,
                    data: {
                        action : 'getTransList',
                        shopno : shopno,
                        filter_transfer_state : $("select#filter_transfer_type").val()
                    },
                    error: function(xhr) {
                            alert('Ajax request Error!!!!!');
                    },
                    success: function(response){
                        $('#tr_bottom').html(response);
                    }
                });//----End of ajax------
		
	}
}// end of findPo(e) funciton

function addImeiToList(e){
	 temp_ph_recImei = document.getElementById('ph_recImei');
	 temp_ph_recImei_val = temp_ph_recImei.value;

	if(temp_ph_recImei_val.length == 15 && e.which==13){
		if(valid_imei(temp_ph_recImei_val)){
			//alert('OK');
			checkImeiExist($('#ph_recImei').val());
			$('#ph_recImei').val(null);
			$('#tempListNum').html('列表中數量 : '+imeiQty);
		}else{
			alert('Invalid IMEI');
		}
	}
}// end of addImeiToList(e) funciton

function checkImeiExist(imei){
	var canAdd=1; //1=cannot not add 0=can add
	var imeiArrLength = imeiArray.length;
	$.ajax({
		url:"../inventory/invGet.php?action=checkImeiExist",
		cache: false,
		dataType: 'script',
		type:'GET',
		async: false,
		data:{	imei:imei,	},
		error: function(xhr){ alert('Ajax request Error!!!!!');	},
		success: function(response) {
			if(response==0){
				canAdd=0;
				
				if(imeiArrLength==0){
					canAdd==0;
				}
				else{
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
				err_msg="IMEI已存在資料庫中, 不能重複增加, Please contact the system Administrator";
			} //end of response if else
		},
	});//end of ajax

	if(canAdd==0 && (imeiArrLength-$('#ph_oqty').html())==0)
		$(".err_msg").html("超過訂購數!!!").css({"display":"block","color":"red"}).delay(1000).fadeOut(300);
	else if(canAdd==0 && imeiArrLength<=$('#ph_oqty').html()){
		imeiArray.push(imei);
		imeiQty++;
		$(".err_msg").html("Added").css({"display":"block","color":"GREEN"}).delay(800).fadeOut(300);
		$('#phoneReceTable').append('<tr><td>'+imeiQty+'</td><td>'+imei+'</td><td>---</td></tr>');
	}		
	else if(canAdd==3)
		$(".err_msg").html(err_msg).css({"display":"block","color":"red"}).delay(5000).fadeOut(300);
	else{
		err_msg="IMEI 已存在於列表中, 不能重複增加";
		$(".err_msg").html(err_msg).css({"display":"block","color":"red"}).delay(1000).fadeOut(300);
	}
} //end of checkImeiExist(imei)

function po_updateforshop(poNo){
    var _idx_cut=poNo.indexOf("-");
    var poNo_length=poNo.length;
    var after_cut = poNo.substring(_idx_cut+1,poNo_length);
    
    
    
}
function si_co(poNo){
    var _idx_cut=poNo.indexOf("-");
    var poNo_length=poNo.length;
    var after_cut = poNo.substring(_idx_cut+1,poNo_length);
    $('#si_co_form_bottom')
        .html('<fieldset>'+
                '<table cellpadding="5">'+
                '   <tr>'+
                '       <td><label for="si_co_staff" >員工編號   </label></td>'+
                '       <td>'+
                '           <input type="text" id="si_co_staff" onkeyup="return validateNumber($(this),value)"'+
                '			class="text ui-widget-content ui-corner-all" maxlength="4"'+
                '			onclick="select()"/>'+
                '		</td>'+
                '	</tr>'+
                '	<tr>'+
                '		<td><label for="si_co_poNo" >單據編號   </label></td>'+
                '		<td>'+
                '			<input type="text" id="si_co_poNo" class="text ui-widget-content ui-corner-all" disabled="disabled"/>'+
                '		</td>'+
                '	</tr>'+
                '	<tr>'+
                '		<td><label for="si_co_date" >日期   </label></td>'+
                '		<td>'+
                '			<input type="text" id="si_co_date"	class="text ui-widget-content ui-corner-all" disabled="disabled"/>'+
                '		</td>'+
                '	</tr>'+
                '</table>'+
                '</fieldset>'+
                '<div class="underline" style="margin:10px 0 10px 0"></div>'+
                '<span style="font-size:14px;">請輸入強制完結入貨原因</sapn>'+
                '<br><textarea id="si_co_desc" cols="" rows="" style="width:310px;height:230px;border:1px solid #CCC;"></textarea>'+
                '<div id="si_co_errMsg"></div>');
	
	$('#si_co_staff').val($('#staff_id').html());
	$('#si_co_poNo').val(poNo);
	//$('#si_co_poNo').val($('#si_bot_poNo').html());  以後用
	$('#si_co_date').val(date);
	
	$('#si_co_form').dialog('open');
	$('#si_co_desc').focus();	
}

function dend_submit(){
    var arr = $('#dend_table').find("[class*=asdd]").get();
    $.each(arr, function(){
        if(checknum(this.value)){
            $("#"+this.id).css("background","#FFF");
            $("#"+this.id).parent().find("[id*=errorMsg]").html('');
            //alert('OK');
        } else{
            var id=this.id;
            //alert(this.id+'cannot be null');
            $("#"+this.id).css("background","#FFA3AA");
            $("#"+this.id).parent().find("[id*=errorMsg]").html('請輸入金額').css("color","#FFA3AA");
            exit(0);
        }

        var checksame_1=$("#"+this.id).parent().parent().find("[class*=ssdd]").html();
        var checksame_s2 = parseFloat(this.value);
        checksame_s2 = checksame_s2.toFixed(1);

        if(checksame_1==checksame_s2){
        } else{
            $("#"+this.id).parent().find("[id*=errorMsg]").html('金額不正確').css("color","#FFA3AA");
                exit(0);
        }
    });
    $('#dend_confirm_form').dialog('open');

    var dend_table_length = $('#dend_table').find("[class*=asdd]").size();
            sendToServer='';
    for(i=0;i<dend_table_length;i++){
        sendToServer +=arr[i].id+':'+arr[i].value;

        if(i!=(dend_table_length-1)){
            sendToServer+=',';
        }
    }
    //alert(sendToServer);
}


function change_filter(filter_val){
	set_payment_menu(filter_val);
}
function set_payment_menu(filter_val){
	if(filter_val==1){
		$('#filter_menu').html('From : <input class="stockin_col" id="datepicker_from" type="text">'+
				' To : <input class="stockin_col" id="datepicker_to" type="text">  '+
				'<input type="button" value="Search" class="finIncel"  onclick="filter_but(1)" style="height:23;"/>');
		call_datepicker();
	}else if(filter_val==2){ //供應商
		$.ajax({
			url: "../inventory/invGet.php?action=get_supplier_list",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(2)" style="height:23;"/>');
				$('#supplier_list').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();				
			}
		});//----End of ajax------
		
		$('#supplier_list').multiselect("uncheckAll");
		
		
		
	}else if(filter_val==3){
		$.ajax({
			url: "../inventory/invGet.php?action=get_accMobi_list",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(3)" style="height:23;"/>');				
			}
		});//----End of ajax------
		
	}else if(filter_val==4){
		$('#filter_menu').html('<input class="stockin_col" id="filter_product" type="text">'+' '+
									   '<input type="button" value="Search" class="finIncel"  onclick="filter_but(4)" style="height:23;"/>');
		$('#filter_product').select();
	}else if(filter_val==5){
		$.ajax({
			url: "../inventory/invGet.php?action=get_shop_list",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(5)" style="height:23;"/>');
				$('#shop_list').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();				
			}
		});//----End of ajax------
		
		$('#shop_list').multiselect("uncheckAll");
	}else if(filter_val==6){
		$.ajax({
			url: "../inventory/invGet.php?action=get_shop_list",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			data: {	list_type:2, },
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(6)" style="height:23;"/>');
				$('#shop_list').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();
				
				$('#shop_list_b').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();				
			}
		});//----End of ajax------
		
		$('#shop_list').multiselect("uncheckAll");
		$('#shop_list_b').multiselect("uncheckAll");
	}else if(filter_val==7){
		$.ajax({
			url: "../inventory/invGet.php?action=get_payment_list",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(7)" style="height:23;"/>');
				/*$('#payment').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();			*/
			}
		});//----End of ajax------
		
		$('#shop_list').multiselect("uncheckAll");
		$('#shop_list_b').multiselect("uncheckAll");
	} else if (filter_val==8){
		$.ajax({
			url: "../inventory/invGet.php?action=get_staff_list",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(8)" style="height:23;"/>');
				$('#staff_list').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();		
			}
		});//----End of ajax------
		$('#staff_list').multiselect("uncheckAll");
	} else if (filter_val==9){
		$.ajax({
			url: "../inventory/invGet.php?action=get_staff_list_name",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
			async: false,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#filter_menu').html(response+' '+'<input type="button" value="Search" class="finIncel"  onclick="filter_but(9)" style="height:23;"/>');
				$('#staff_list').multiselect({
					selectedText: "# of # selected"
				}).multiselectfilter();		
			}
		});//----End of ajax------
		$('#staff_list').multiselect("uncheckAll");
	} else if (filter_val==10){
		$('#filter_menu').html('<select id="inv_type_list">'+
				'<option value="1" selected="selected">發票 Invoice</option>'+
				'<option value="4">Void單 Void Invoice</option>'+
				'<option value="2">退貨單 Return Invoice</option>'+
				'<option value="5">有折扣的單 Invoice (With Discount)</option>'+
				'<option value="3">換貨單 Exchange</option>'+
				'<input type="button" value="Search" class="finIncel"  onclick="filter_but(10)" style="height:23;"/>');
	} else if (filter_val==11){ //日期(單選)
		$('#filter_menu').html('From : <input class="stockin_col" id="datepicker_from" type="text">'+
				'   <input type="button" value="Search" class="finIncel"  onclick="filter_but(11)" style="height:23;"/>');
		call_datepicker();
	}
}
function filter_but(filter_val){
	switch(filter_val){
		case 1: //日期(多選)
			if(checknum($('#datepicker_from').val()) && checknum($('#datepicker_to').val())){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						datepicker_from:$('#datepicker_from').val(),
						datepicker_to:$('#datepicker_to').val(),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			}
			break;
		case 2: //供應商
			var arr = $('#supplier_list').multiselect("getChecked");
			//alert(arr[0].value);
			if(arr.length>0){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						supplier:in_arr_out_arr(arr),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
						
					}
				});//----End of ajax------
			}
			break;
		case 3: //分類
			$.ajax({
				url: "../inventory/invGet.php?action=report_num",
				cache: false,
				dataType: 'html',
				type:'POST',
				data: {
					report_num:get_current_report_page_index(),
					accMobi_list:$('#accMobi_list').val(),
				},
				async: true,
				error: function(xhr) {
					alert('Ajax request Error!!!!!');
				},
				success: function(response){
					$('#tabs-1').html(response);
				}
			});//----End of ajax------
			break;
		case 4: //產品編號
			$.ajax({
				url: "../inventory/invGet.php?action=report_num",
				cache: false,
				dataType: 'html',
				type:'POST',
				data: {
					report_num:get_current_report_page_index(),
					product_id:$('#filter_product').val(),
				},
				async: true,
				error: function(xhr) {
					alert('Ajax request Error!!!!!');
				},
				success: function(response){
					$('#tabs-1').html(response);
				}
			});//----End of ajax------

			break;
		case 5: // shop list
			var arr = $('#shop_list').multiselect("getChecked");
			//alert(arr[0].value);
			if(arr.length>0){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						shop_list:in_arr_out_arr(arr),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			}
		case 6: // shop list for fromshop and toshop
			var arr = $('#shop_list').multiselect("getChecked");
			var arr_b = $('#shop_list_b').multiselect("getChecked");
			//alert(arr[0].value);
			if(arr.length>0 && arr_b.length>0){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						shop_list:in_arr_out_arr(arr),
						shop_list_b:in_arr_out_arr(arr_b),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			}
			break;
		case 7: // payment list
			//var arr = $('#payment_list').multiselect("getChecked");
			
			//if(arr.length>0){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						//payment_list:in_arr_out_arr(arr),
						payment_list:$('#payment_list').val(),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			//}
			break;
		case 8: // staff list
			var arr = $('#staff_list').multiselect("getChecked");
			
			if(arr.length>0){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						staff_list:in_arr_out_arr(arr),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			}
			break;
		case 9: // staff list (string)
			var arr = $('#staff_list').multiselect("getChecked");
			
			if(arr.length>0){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						staff_list:in_arr_out_arr_string(arr),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			}
			break;
		case 10: // invoice type and state
			$.ajax({
				url: "../inventory/invGet.php?action=report_num",
				cache: false,
				dataType: 'html',
				type:'POST',
				data: {
					report_num:get_current_report_page_index(),
					inv_type:$('#inv_type_list').val(),
				},
				async: true,
				error: function(xhr) {
					alert('Ajax request Error!!!!!');
				},
				success: function(response){
					$('#tabs-1').html(response);
				}
			});//----End of ajax------
			break;
		case 11: //日期(單選)
			if(checknum($('#datepicker_from').val())){
				$.ajax({
					url: "../inventory/invGet.php?action=report_num",
					cache: false,
					dataType: 'html',
					type:'POST',
					data: {
						report_num:get_current_report_page_index(),
						datepicker_from:$('#datepicker_from').val(),
					},
					async: true,
					error: function(xhr) {
						alert('Ajax request Error!!!!!');
					},
					success: function(response){
						$('#tabs-1').html(response);
					}
				});//----End of ajax------
			}
			break;
	}
	
}

//--------------------------------------------------------------------------------------------------------
function get_current_report_page_index(){
	var page_name = $('div#middle div.rightContent title').html();
	switch(page_name){
		case '貨物入倉報表':
			return 1;
			break;
		case '貨物轉倉報表':
			return 2;
			break;
		case '銷售報表 - 總覧':
			return 3;
			break;
		case '銷售報表 - 明細':
			return 4;
			break;
		case '收入報表':
			return 5;
			break;
		case '庫存報表':
			return 6;
			break;
		case '庫存報表 - 總覧':
			return 7;
			break;
	}
}

function in_arr_out_arr(arr){
	sendToServer='';
	for(i=0;i<arr.length;i++){
		sendToServer += arr[i].value;
		if(i!=(arr.length-1))
			sendToServer+=',';
	}
	return sendToServer;
}
function in_arr_out_arr_string(arr){
	sendToServer='';
	for(i=0;i<arr.length;i++){
		sendToServer += "'"+arr[i].value+"'";
		if(i!=(arr.length-1))
			sendToServer+=',';
	}
	return sendToServer;
}

function valid_imei(imei){
	var pattern=new RegExp(/^[0-9]+$/);
	return pattern.test(imei);
}
function checknum(val){
	if(val.length >0)
		return true;
	else
		return false;
}
