<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>salesRight</title>

</head>
<?php session_start(); ?>
<script>
$(function() {

	
	
	$( "#opriceA" ).button();
	$( "#spriceA" ).button();
	$( "#opriceB" ).button();
	$( "#spriceB" ).button();
//	$("#osprice").click(function(){

// 	});

    $("#ospricetestA").toggle(function(){
		$("#ospricetestB").show('fast');
		$("#ospricetestA").hide('slow');
    },function(){
		$("#ospricetestB").show('fast');
		$("#ospricetestA").hide('slow');
   });
   
   $("#ospricetestB").toggle(function(){
		$("#ospricetestA").show('slow');
		$("#ospricetestB").hide('slow');
    },function(){
		$("#ospricetestA").show('slow');
		$("#ospricetestB").hide('slow');
   });
   //----
   $("#ospricetestC").toggle(function(){
		$("#ospricetestD").show('fast');
		$("#ospricetestC").hide('slow');
    },function(){
		$("#ospricetestD").show('fast');
		$("#ospricetestC").hide('slow');
   });
   
   $("#ospricetestD").toggle(function(){
		$("#ospricetestC").show('slow');
		$("#ospricetestD").hide('slow');
    },function(){
		$("#ospricetestC").show('slow');
		$("#ospricetestD").hide('slow');
   });



	 
});

function showZ() {
 var val = $('#payt').find(':checked').val();}	

//$('#morepay').is(':checked');

</script>
<body>
<fieldset>
	<legend>單據資料</legend>
	<table class="salesinfo">
    	<tr class="sit">
			<td>單據種類</td><td colspan="3">發票</td>
       	</tr>
		<tr>
        	<td>店號</td><td id="shop_No" class="rightline"><?php echo $_SESSION['retail_id']; ?></td><td>日期</td><td><div id="dd"></div></td>
        </tr>
        <tr>
        	<td>開單者</td>
        	<td class="rightline" style="color: #f00">
        		<div id="createBy">8001</div>
        	</td>
        </tr>
	</table>
</fieldset>
<table>
	<tr>
		<td style="overflow:hidden">
			<label for="bcode" class="tt">條碼 : </label>
			<input type="text" name="bcode" id="bcode" class="bcode" maxlength="13"	onclick="select();"  onkeyup="//return validateNumber($(this),value)"/>
               <div id="osareaA">
               <div id="ospricetestA" onclick="osarea=1"><a href="#" id="opriceA">特價</a></div>
               <div id="ospricetestB" style="display:none;" onclick="osarea=0"><a href="#" id="spriceA">原價</a></div>
               </div>
		</td>
	</tr>
    <tr>
		<td style="overflow:hidden">
			<label for="imei" class="tt">IMEI : </label>
			<input type="text" name="imei" id="imei" class="imei" maxlength="15" onclick="select();"  onkeyup="return validateNumber($(this),value)"
             style=" width:225px;"/>
               <div id="osareaB">
               <div id="ospricetestC" onclick="osarea=1"><a href="#" id="opriceB">特價</a></div>
               <div id="ospricetestD" style="display:none;" onclick="osarea=0"><a href="#" id="spriceB">原價</a></div>
               </div>
		</td>
	</tr>	
	<tr>
		<td>
			<label for="sQty" class="tt">數量 : </label>
			<input type="text" name="sQty" id="sQty" class="qty" maxlength="5" value="1" onclick="select();" />
			<input type="button" id="" class="addmin" value="+1" onclick="addmin(2);" />
			<input type="button" id="" class="addmin" value="-1" onclick="addmin(1);"/>
			<input type="button" id="" class="addmin" value="重置" onclick="addmin(0);"/>
		</td>
	</tr>
	<tr>
		<td align="center">
        	<input type="button" class="srbut" id="chQty" value="更改數量" >
			<input type="button" class="srbut" id="discount" value="折扣" onclick="">
			<input type="button" class="srbut" id="del" value="刪除" >

		</td>
	</tr>
</table>
</body>
</html>



<script>
/*

$("#control").toggle( 
function () 
{ 
    $('#money').attr("disabled", true); 
}, 
function () 
{ 
    $('#target').removeAttr("disabled"); 
});

*/
<!-- JQ DECARE AREA  -->

		
$(function() {
	
	//---------------set 開單者------------------
		$('#createBy').click(function(){ //"開單者" 第 一次按的時候
		//$(this).replaceWith('<input type="text" class="createByText">');
			var user = $('#createBy').html();
			$('#createBy').html('<input type="text" class="createByText" id="inputCreateor" />');
			$('#inputCreateor').val(user);
			$('#inputCreateor').select();
			$('#inputCreateor').blur(function(){
				$('#createBy').html($('#inputCreateor').val());
			});
	});
	//---------------End of 開單者---------------

		$('#date').datepicker();
		$('#dd').replaceWith(date);
		//$('#bcode').focus();

		//$( "#dialog:ui-dialog" ).dialog( "destroy" );

		/*	var confirm = function () {
			}
			var cancel = function () {
			}*/

		//普通單選payment method

		$('#endOrderForm').dialog('destroy');
		$( "#endOrderForm" ).dialog({
						
			autoOpen:false,  //defult must be false
			height: 500,
			width: 500,
			closeOnEscape: true,
			modal: true,
			resizable: true,
			
			beforeClose: function() {
				$('#money').val(null);
				$('#change').val(null);
				$('#money').removeAttr("disabled");
			},
			
			buttons : {
				"存儲": function() {
				tempTotal = total;	
					$.ajax({
						url: "../sales/salesGet.php?action=addInvoice",
                    	cache: false,
                    	dataType: 'html',
                    	type:'GET',
                    
                    	data: {
                    		date : date,
							timeValue2 : timeValue2,
                        	total : total,
                        	remark : 'N/A',
                        	invoiceTypeNo : 1,
                        	staffNo : 1,
                        	retailShopNo : shopno,
                        	createBy:$('#createBy').html(),
                    	},
                    	async: false,
                    	error: function(xhr) {
	                        alert('Ajax request Error!!!!!');
                    	},
                    	success: function(response) {
							tempInvNo = response;
							receipt_No = response;
                    		var itemArrLength = itemArray.length;
							for ( i=0; i < itemArrLength; i++) {
								
									//alert(itemArray[0]+" "+itemArray[i+1]+" "+itemArray[i+2]+" "+itemArray[i+3]+" "+itemArray[i+4]+" "+itemArray[i+5]+" "+itemArray[i+6]);
								
								$.ajax({
									url: "../sales/salesGet.php?action=addInvoiceDetail",
                    				cache: false,
                    				dataType: 'html',
                    				type:'GET',
                    
			                    	data: {
            		        			productNo : itemArray[i],
										description :  itemArray[i+1],
            		        			qty: itemArray[i+3],
            		        			discount: itemArray[i+4],
            		        			price: itemArray[i+2],
                    		    		invoiceNo: response,
                    		    		modifyBy: 1, //just for demo, must be change later
										retailShopNo : shopno,
										goodsType:itemArray[i+6],
			                    	},
                    				async: false,
                    				error: function(xhr) {
	                        			alert('Ajax request Error!!!!!');
                    				},
                    				success: function(response) {
										$('#tempRes').html(response);
										//alert(openPrintDialog);
										//alert(canAddPayment);
									}
                    				
			        			});//----End of invoice detail ajax------
								i+=6;
							}//----End of for loop
							
							
							if(canAddPayment==1){
							$.ajax({
									url: "../sales/salesGet.php?action=addPayment",
                    				cache: false,
                    				dataType: 'html',
                    				type:'GET',
                    
			                    	data: {
            		        			invoiceNo : response,
            		        			paymentNo : paymentNo,
            		        			money : total,
			                    	},
                    				async: false,
                    				error: function(xhr) {
	                        			alert('Ajax request Error!!!!!');
                    				},
                    				success: function(response) {
                    					paymNo = paymentNo;
									}
                    				
			        		});//----End of addPayment ajax------
							}
                    	}//----End of success
        			});//----End of ajax------

					$( this ).dialog( "close" );
					if(openPrintDialog==1)
						$('#printForm').dialog("open");												
				},
				"取消": function() {
					$( this ).dialog( "close" );
				},
				
			},
		}); // ----End of endOrderForm dialog-----------------------------
					
		//多選payment method
		$('#morePayForm').dialog('destroy');
		$( "#morePayForm" ).dialog({
					
			autoOpen:false,  //defult must be false
			height: 530,
			width: 900,
			closeOnEscape: true,
			modal: true,
			resizable: true,
			open: function () {
			},
			drag: function () {
			},
			beforeOpen: function(){
				getTotal(mcharge);
				
				
			},
			beforeClose: function() {
				$('#morePayRight').html(null);
				$('#morePayLeft').html(null);
				$('#morePayFoot').html(null);
				$('#mpRecordTableArea').val(null);
				$('#mmoney').removeAttr("disabled");	
			},
			buttons : {
				"存儲": function() {
					tempTotal = total;
					if(remainder!=0){
						alert('尚欠金額 : '+remainder);
					} else {
						$.ajax({
							url: "../sales/salesGet.php?action=addInvoice",
                    		cache: false,
                    		dataType: 'html',
                    		type:'GET',
                    
                    		data: {
                    			date : date,
								timeValue2 : timeValue2,
                        		total : total,
                        		remark : 'N/A',
                        		invoiceTypeNo : 1,
                        		staffNo : 1,
                        		retailShopNo : shopno,
								createBy:$('#createBy').html(),
                    		},
                    		async: false,
                    		error: function(xhr) {
	                        	alert('Ajax request Error!!!!!');
                    		},
                    		success: function(response) {
								tempInvNo = response;
								//alert(response);
	                    		var itemArrLength = itemArray.length;
								for ( i=0; i < itemArrLength; i++) {
								
									//alert(itemArray[i]+" "+itemArray[i+1]+" "+itemArray[i+2]+" "+itemArray[i+3]+" "+itemArray[i+4]+" "+itemArray[i+5]);
								
									$.ajax({
										url: "../sales/salesGet.php?action=addInvoiceDetail",
                    					cache: false,
                    					dataType: 'html',
                    					type:'GET',
                    
			                    		data: {
	            		        			productNo : itemArray[i],
											description :  itemArray[i+1],
            		        				qty: itemArray[i+3],
            		        				discount: itemArray[i+4],
            		        				price: itemArray[i+2],
                    		    			invoiceNo: response,
                    		    			modifyBy: 1, //just for demo, must be change later
											goodsType:itemArray[i+6],
			                    		},
                    					async: true,
                    					error: function(xhr) {
	                        				alert('Ajax request Error!!!!!');
                    					},
                    					success: function(response) {
											$('#tempRes').html(response);
	                    					//alert(response);
										}
                    				
			        				});//----End of invoice detail ajax------
									i+=6;
								}//----End of itemArrLength for loop
								
								if(canAddPayment==1){
									var mpRecordArrayLength = mpRecordArray.length;
									for (j=0; j < mpRecordArrayLength; j++){
										$.ajax({
											url: "../sales/salesGet.php?action=addPayment",
	                    					cache: false,
	                    					dataType: 'html',
	                    					type:'GET',
	                    
				                    		data: {
		            		        			invoiceNo : response,
	            		        				paymentNo : mpRecordArray[j+1],
	            		        				money : mpRecordArray[j+2],
				                    		},
	                    					async: true,
	                    					error: function(xhr) {
		                        				alert('Ajax request Error!!!!!');
	                    					},
	                    					success: function(response) {
	                    						//alert (response);
											}                    				
			        					});//----End of addPayment ajax------
										j+=2;
									}//----End of mpRecordArrayLength for loop
								}
							}//----End of addInvoice's success---
        				});//----End of addInvoice ajax------
        			
						$( this ).dialog( "close" );
						if(openPrintDialog==1)
							$('#printForm').dialog("open");
					}
				},
				"取消": function() {
					$( this ).dialog( "close" );
				},
			},
		});//---End of morePayForm dialog------------------------------
		
var Tdisprice = 0;
	$('#discountForm').dialog('destroy');
	$( "#discountForm" ).dialog({	
		autoOpen:false,  //defult must be false
		height: 250,
		width: 350,
		closeOnEscape: true,
		modal: true,
		resizable: true,
		open: function () {
			var sellingprice = $('#saltb tr:eq('+(delrow+1)+') td:eq(2)').html();
			$('#salprice').val(sellingprice);
			sDisprice = $('#saltb tr:eq('+(delrow+1)+') td:eq(5)').html(); //拿saltb table 中的小計
			
			Tdisprice = sDisprice;
			var disprice = $('#saltb tr:eq('+(delrow+1)+') td:eq(4)').html(); //拿saltb table 中的discount
			$('#tempdiscount').val(disprice);
			
			$('#disprice').val(sDisprice).select();
		},
		beforeOpen: function(){
			
		},
		beforeClose: function() {
			$('#salprice').val(null);
			$('#disprice').val(null);
			$('#tempdiscount').val(null);
			
			$('#disprice').removeAttr("disabled");
		},
		
		buttons : {
			"確認": function() {
				//var tempprice = sDiscount.toFixed(1);					
				$('#saltb tr:eq('+(delrow+1)+') td:eq(4)').html(tempdis);  // star with 0, update table record
				$('#saltb tr:eq('+(delrow+1)+') td:eq(5)').html(sDisprice);  // star with 0, update table record

				if (Tdisprice - sDisprice>0)
					total = total-sDisprice;
				else 
					total = total+(sDisprice - Tdisprice);
				
				
				var deleteOne = (delrow*7);
				itemArray.splice((deleteOne+4),1,tempdis);
				itemArray.splice((deleteOne+5),1,sDisprice);
				//alert(itemArray);
					
				$('#tol').val(total.toFixed(1));
				$( this ).dialog( "close" );
			},
			"取消": function() {
				$( this ).dialog( "close" );
			},
		},
	});//---End of discountForm dialog------------------------------
	
	
	
	$('#chQtyForm').dialog('destroy');
	$( "#chQtyForm" ).dialog({	
		autoOpen:false,  //defult must be false
		height: 165,
		width: 350,
		closeOnEscape: true,
		modal: true,
		resizable: true,
		open: function () {
			orgQty = $('#saltb tr:eq('+(delrow+1)+') td:eq(3)').html(); //拿saltb table 中的數量
			$('#nechqty').val(orgQty).select();
			
			sSellprice = $('#saltb tr:eq('+(delrow+1)+') td:eq(2)').html(); //拿saltb table 中的售價
			disprice = $('#saltb tr:eq('+(delrow+1)+') td:eq(4)').html(); //拿saltb table 中的discount
			sDisprice = $('#saltb tr:eq('+(delrow+1)+') td:eq(5)').html(); //拿saltb table 中的小計
			
		},
		beforeClose: function() {
			//$('#nechqty').val(null);
		},
		
		buttons : {
			"確認": function() {
				newQty = $('#nechqty').val()
				
				sDisprice = newQty*sSellprice;
				
				$('#saltb tr:eq('+(delrow+1)+') td:eq(3)').html(newQty);  // star with 0, update table record
				$('#saltb tr:eq('+(delrow+1)+') td:eq(5)').html(sDisprice);  // star with 0, update table record
				
				if (orgQty - newQty>0)
					total = total-sDisprice;
				else 
					total = total+(sDisprice - Tdisprice);
				
				var deleteOne = (delrow*7);
				itemArray.splice((deleteOne+3),1,orgQty);
				itemArray.splice((deleteOne+5),1,sDisprice);
alert(itemArray);
				
				$( this ).dialog( "close" );
			},
			"取消": function() {
				$( this ).dialog( "close" );
			},
		},
	});//---End of discountForm dialog------------------------------
		


		
});
<!--End of JQ DECARE AREA  -->
</script>
<!-- Dialog area -->

<!--// chQtyForm 張form-->
<div id="chQtyForm" title="更改數量">
<form>
	<fieldset>
    	<table cellpadding="5">
        	<tr>
            	<td><label for="nechqty" >數量   </label></td>
                <td>
	                <input type="text" name="nechqty" id="nechqty" 
						class="text ui-widget-content ui-corner-all" maxlength="5"
						onclick="select()"/>
                </td>
            </tr>
        </table>
    </fieldset>
</form>
</div>

<!--// discount 張form-->
<div id="discountForm" title="折扣">
<form>
	<fieldset>
    	<table cellpadding="5">
        	<tr>
            	<td><label for="salprice" >售價   </label></td>
                <td>
	                <input type="text" name="salprice" id="salprice" 
						class="text ui-widget-content ui-corner-all" maxlength="7" disabled="disabled"
						onclick="select()"/>
                </td>
            </tr>
            <tr><td colspan="3"><div class="underline"></div></td></tr>
            <tr>
            	<td><label for="disprice" >折扣後售價</label></td>
                <td>
	                <input type="text" name="disprice" id="disprice" 
						class="text ui-widget-content ui-corner-all" maxlength="7"
						onclick="select()" onkeyup="return validateNumberB($(this),value)"/>
                </td>
            </tr>
            
            <tr>
            	<td><label for="tempdiscount" class="">拆扣了   </label></td>
                <td>
	                <input type="text" name="tempdiscount" id="tempdiscount" 
						class="text ui-widget-content ui-corner-all" maxlength="7" disabled="disabled"
						onclick="select()"/>
                </td>
            </tr>
        </table>
    </fieldset>
</form>

</div>

<!--//多選payment method  張form-->
<div id="morePayForm" title="多個付款方式">
	<div id="morePayLeft"></div>  <!--CSS temp-->
	<div id="morePayRight"></div> <!--CSS temp-->
	<div id="mpRecordTableArea"></div>
	<div id="morePayFoot"></div>  <!--CSS temp-->
</div>


<!--//一個payment method  張form-->
<div id="endOrderForm" title="存儲單據">
	<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
	<form>
	<fieldset>
		<table cellpadding="5">
			<tr>
				<td><label for="money" class="tt">輸入金額   </label></td>
				<td><input type="text" name="money" id="money" 
					class="text ui-widget-content ui-corner-all" maxlength="7"
					onclick="select()"/></td>
			</tr>
			
			<tr>
				<td><label for="charge" class="tt">應付金額      -</label></td>
				<td><input type="text" name="charge" id="charge" class="text ui-widget-content ui-corner-all" disabled="disabled" /></td>
			</tr>

			<tr>
				<td colspan="2"><div class="underline"></div></td>
			</tr>
		
			<tr>
				<td><label for="change" class="tt">找鑟</label></td>
				<td><input type="text" name="change" id="change" value="" class="text ui-widget-content ui-corner-all" disabled="disabled"/></td>
			</tr>
		</table>
		
		
	</fieldset>
	</form>
</div>
<!-- END of --Dialog area -->


<script>
$('#discount').attr("disabled", true);
<!--javascript function -->
	//delete row
	var clk= clk;
        $("#del").click(function() {
//			alert(delrow);
			var deleteFrom=(delrow*7);

            var hideRows = $("#saltb tr").hasClass("currRow");
            if (hideRows == true) {
                $("#saltb tr.currRow td").fadeOut(500);
				
//				alert (itemArray[deleteFrom]+ " "+itemArray[deleteFrom+1]+ " "+itemArray[deleteFrom+2]+ " "+itemArray[deleteFrom+3]+ " "+itemArray[deleteFrom+4]+ " "+itemArray[deleteFrom+5]);
				
				
				total = (total - itemArray[deleteFrom+5]);

				$('#tol').val(total);
				itemArray.splice(deleteFrom,7,"","","","","","","");

				
				
//				alert(itemArray);
				//$('#saltb tr td').unbind("click");				
            }
        });//----end of del.click
	
$("#discount").click(function() {
	$('#discountForm').dialog('open');
});

$("#chQty").click(function() {
	$('#chQtyForm').dialog('open');
});
		
		
		
   //document.onkeydown = getGdInfo;
   document.getElementById('disprice').onkeydown = caldiscount;
   document.getElementById('imei').onkeydown = getMobileInfo;
   document.getElementById('bcode').onkeydown = getGdInfo;
   document.getElementById('bcode').focus();
   document.getElementById('money').onkeydown = calOrder;
   
   
function disMoney(){ //must here
	$('#money').attr("disabled", true);
}
function disMmoney(){ //must here
	$('#mmoney').attr("disabled", true);
}
function setMmoneyFocus(){
   	document.getElementById('mmoney').focus();
} 
<!--End of javascrtion-->


</script>