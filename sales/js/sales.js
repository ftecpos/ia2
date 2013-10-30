$(function() {
	document.getElementById('pID').onkeyup = getAccDetail;
});


function getAccDetail(e){
	getAccsList($('#pID').val());
}

function getAccsList(keywords){
	$.ajax({
		url: "../sales/get_acc_phone.php",
		cache: false,
		dataType: 'json',
		type:'POST',
		data: {
			action : 'get_acc',
			shopInfoObj:get_shopInfoObj() ,
			keywords : keywords,
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
			var html_a=''; var html_b=''; var html_c='';
			html_a+='<table rules="all" border="1" class="finAcc" style="width:100%;" >'+
						'<thead>'+
							'<th style="width: 110px">配件 no</th>'+
							'<th style="width: 110px">配件 id</th>'+
							'<th>配件製造商</th>'+
							'<th style="width: 145px">配件名稱</th>'+
							'<th style="width: 100px">配件種類</th>'+
							'<th style="width: 100px">配件?色</th>'+
							'<th>oprice</th>'+
							'<th>sprice</th>'+
							'<th>配件狀態</th>'+
							'<th>店舖</th>'+
							'<th>QTY</th>'+
						'</thead>'+
					'<tbody>';
			
			var numOfData = response.length;
			for(var i = 0; i<numOfData; i++){
				html_b+='<tr><td><a href="#" style="color:#0019FF;"'+
							"onclick=\"addAccToInvoice('"+response[i].acc_no+"')\">加到Invoice</a></td>"+
							'<td>'+response[i].acc_id+'</td>'+
							'<td>'+response[i].manufacturer+'</td>'+
							'<td>'+response[i].accName+'</td>'+
							'<td>'+response[i].typeName+'</td>'+
							'<td>'+response[i].color+'</td>'+
							'<td>'+response[i].oprice+'</td>'+
							'<td>'+response[i].sprice+'</td>'+
							'<td>'+response[i].stateName+'</td>'+
							'<td>'+response[i].retail_id+'</td>'+
							'<td>'+response[i].ava_bal+'</td>'+
						 '</tr>';
			}
			html_c += '</tbody></table>';
			
			$('#findAccBottom').html(html_a+html_b+html_c);
			$('#findAccFirMenu').html(null);
			$('#findAccFoot').html(null);
		}
	});//----End of ajax------
}
function confirmmobilessa(){
    
    if ($("#phone_ssa1").val()=="") {
        alert("Please input Phone SSA1");
        return false;
    } else if ($("#mobile1").val()=="") {
        alert("Please input Mobile No.");
        return false;
    }
    /* else if ($("#phone_ssa2").val()=="") {
        alert("Please input Phone SSA2");
        return false;
    }*/ else if ($("#phone_ssa1").val().length <9){
        alert("Please input Correct length of Phone SSA1");
        return false;
    } else if ($("#mobile1").val().length <8){
        alert("Please input Correct length of Mobile No.");
        return false;
    }
    /* else if ($("#phone_ssa2").val().length <9){
        alert("Please input Correct length of Phone SSA2");
        return false;
    }*/ else if ($("#phone_offer").val()==""){
        alert("Please input Offer");
        return false;
    } else {
        var cBcode  = $('#bcode').val();
        salesOrderQty = $('#sQty').val();
        $.ajax({
            url:"../sales/salesGet.php?action=getMobileInfo",
            cache:false,
            dataType:'html',
            type:'GET',
            data:{ inv_type:get_inv_type_val(),
                   phone_no:_phoneNo,
                    osarea : osarea,
                phone_ssa1 : $("#phone_ssa1").val(),
                   mobile1 : $("#mobile1").val(),
               phone_offer : $("#phone_offer").val()
            },
            error:function(xhr){alert('Ajax request Error!!!');},
            success:function(response){
                $('#saltb').append(response);
                $('#sQty').val(1);  //reset the qty to 1
                $('#tol').val(total.toFixed(1)); // .toFixed(n) 取小數點後n個位  正式寫法 document.write(total.toFixed(1))
            }
        });
         /*
        $.ajax({
            url: "../sales/salesGet.php?action=getGdInfo",
            cache: false,
            dataType: 'html',
            type:'GET',
            data: {
                bcode : cBcode,
                        qty : salesOrderQty,
                        osarea : osarea,
                        shopno : shopno,
                        ssa_code : $("#ssa").val()
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
                        $('#saltb').append(response);
                        $('#sQty').val(1);  //reset the qty to 1
                        $('#tol').val(total.toFixed(1));
                        $("#ssa").val(null);
                        $('#bcode').val(null);
                        $("#ssa_dialog").dialog("close");
                        setInvTableListener();
                        document.getElementById('bcode').focus();
                        return true;
                    }
         });//----End of ajax------
         */
    }
    return true;
}

function confirmssa(){
    if ($("#ssa").val()=="") {
        $("#ssa").select();
        alert("Please input SSA code");
        return false;
    } else if ($("#ssa_mobile1").val()=="") {
        $("#ssa_mobile1").select();
        alert("Please input Mobile No.");
        return false;
    } else if ($("#ssa").val().length <9){
        $("#ssa").select();
        alert("Please input Correct length of SSA code");
        return false;
    } else if ($("#ssa_mobile1").val().length <8){
        $("#ssa_mobile1").select();
        alert("Please input Correct length of Mobile No.");
        return false;
    } else {
        var cBcode  = $('#bcode').val();
        salesOrderQty = $('#sQty').val();
         
        $.ajax({
            url: "../sales/salesGet.php?action=getGdInfo",
            cache: false,
            dataType: 'html',
            type:'GET',
            data: {
                bcode : cBcode,
                  qty : salesOrderQty,
               osarea : osarea,
               shopno : shopno,
             ssa_code : $("#ssa").val(),
          ssa_mobile1 : $("#ssa_mobile1").val()
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
                $('#saltb').append(response);
                $('#sQty').val(1);  //reset the qty to 1
                $('#tol').val(total.toFixed(1));
                $("#ssa").val(null);
                $("#ssa_mobile1").val(null);
                $('#bcode').val(null);
                $("#ssa_dialog").dialog("close");
                setInvTableListener();
                document.getElementById('bcode').focus();
                return true;
            }
         });//----End of ajax------
    }
    return true;
}
