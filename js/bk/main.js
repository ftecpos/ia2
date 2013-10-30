/////////------------------salesOrder-------------------------------------------------
var salesOrderQty = 0;
var total=remainder = 0.0;
var itemArray = [];
var reverseArray=[];
var mpRecordArray = [];
var cash,eps,cdcard,oc = 0;
var paymentNo;
var timeValue2;
var osarea=0; //0是特價, 1是原價
var delrow=0;
var sDiscount=sSalprice=sDisprice=tempdis=0;
var sDisprice=0;
var tempInvNo, tempTotal;
retailShopNo = 0;
var shopid =localStorage.getItem("shopid");
var shopno =localStorage.getItem("shopno");
var openPrintDialog=0; //0=cannot open 1=can open
var canAddPayment=0; //0=cannot open 1=can open
var dailog=0 //0=close 1=open


//------------get the date-------------------------------------------
var tdate,tmonth,tyear,RightNow,date;
RightNow = new Date();
	tdate = RightNow.getDate();
	tmonth = RightNow.getMonth()+1;
	tyear = RightNow.getFullYear();
	date = tyear +'-'+tmonth+'-'+tdate;
	
//-------------addqty function-----minqty function--------------------
function addmin(z)
{
	var qty = document.getElementById('sQty');
	var nQty = parseInt(qty.value);
	if (z==2) nQty++;
	else if (z==1&&nQty>1) nQty--;
	else if (z==0) nQty=1;
	qty.value = nQty;
}
/*
 * 參巧用 
 *function tp(){
        var Qty = document.getElementById('qty');
        var qtyy = parseInt(Qty.value);
        var c = document.getElementById('price');
        var b = parseInt(c.value);
        totalPrice(b,qtyy);
    }
  function totalPrice(a,b){
        var total = a*b;
        $("#tol").val(total);
    }
*/
//-------------ENd of addqty function-----minqty function-------------

//------------this used to check the input if is number---------------
function validateNumber(e, pnumber)
{
    if (!/^\d+$/.test(pnumber))
    {
        $(e).val(/^\d+/.exec($(e).val()));
    }
    return false;
  }
//------------Enf of validateNumber function--------------------------

//------------this used to check the input if is number or point e.g  10.1 
function validateNumberB(e, pnumber)
{
//    if (!/^(\d|\.?)+$/.test(pnumber))   //有可有 點數
	if (!/^\d+$/.test(pnumber))
    {
        $(e).val(/^\d+/.exec($(e).val()));
    }
    return false;
  }
//------------Enf of validateNumber function--------------------------




//-------------getMobileInfo(e) function----------------------------------
function getMobileInfo(e){
            //alert(e.which);
	var imei = document.getElementById('imei');
    var Imei = imei.value;
    
    response = null;
    
    if(Imei.length==15&& e.which==13){
    	
    	var cimei  = $('#imei').val();
    	$('#imei').val(null);// clear the barcode
    
      	salesOrderQty = $('#sQty').val();
		
       	$.ajax({
    		url: "../sales/salesGet.php?action=getMobileInfo",
        	cache: false,
        	dataType: 'html',
        	type:'GET',
         	data: {
            	imei : cimei,
            	qty : salesOrderQty,
				osarea : osarea,
				inv_type:get_inv_type_val(),
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
				$('#tol').val(total.toFixed(1)); // .toFixed(n) 取小數點後n個位  正式寫法 document.write(total.toFixed(1));

			}
        });//----End of ajax------
	}//--------End of if (13)-------------
		else if(Imei.length==0&& e.which==13){
        		endOrder();
        	}
}//-------------End of getMobileInfo(e) function---------






//-------------getGdInfo(e) function----------------------------------
function getGdInfo(e){
            //alert(e.which);
	var bcn = document.getElementById('bcode');
    var c = bcn.value;
    
    response = null;
    
    if(c.length>0 && e.which==13){
    	
    	var cBcode  = $('#bcode').val();

    	$('#bcode').val(null);// clear the barcode
    
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
				$('#tol').val(total.toFixed(1)); // .toFixed(n) 取小數點後n個位  正式寫法 document.write(total.toFixed(1));
				setInvTableListener();
			}
        });//----End of ajax------
	}//--------End of if (13)-------------
		else if(c.length==0&& e.which==13){
        		endOrder();
        	}
}//-------------End of getGdInfo(e) function---------

function endOrder(){
	if(get_inv_type_val()==1){ //普通invoice
		customer_no=null;
	} else if(get_inv_type_val()==2){ //invoice To Customer / supplier
		customer_no=inv_cust_val();
		if (!customer_no){
			alert('Customer No. Cannot be Null!');
			exit(0);
		}
	}
	var fw = $('#morepay').attr( 'checked' ); 
	if(!$('#morepay').attr('checked')){
	// var dw = $('#morepay').is(':checked');
	// alert (dw);
	// 兩個方法也可以check 佢是不是有check
		$('#charge').val(total.toFixed(1));
		
		var fname;
 		$('#payt :input[type=radio]').each( function(){
 			fname=this.name;
 			if(this.checked){
 				paymentNo = $(this).val();
 			}
 		});
		if(paymentNo!=1){
			$('#change_tr').css("display","none");
			$('#underline_tr').css("display","none");
			$('#endOrderForm').dialog('open');
		} else {
			$('#change_tr').css("display","");
			$('#underline_tr').css("display","");
			$('#endOrderForm').dialog('open');
		}
		
	} else if($('#morepay').attr( 'checked' )&&total!=0){
		cash,eps,cdcard,oc,mpRecordNum = 0; //reset all needed attr
		 mpRecordArray = [];
		
		remainder = total.toFixed(1);
		
		$('#morePayLeft').replaceWith('<table border="0">'+  //class must be change later
									//	'<tr><td><a>付款方法</a></td>'+'<td rowspan="5"><div id="morePayRight"></div></td></tr>'+
										'<tr><td><input type="button" value="現金" class="ssbut" style="color:#FFA8B5;" onclick="changePay(1);"/></td></tr>'+
										'<tr><td><input type="button" value="EPS" class="ssbut" style="color:#FFCAA8;" onclick="changePay(2);" /></td></tr>'+
										'<tr><td><input type="button" value="信用卡" class="ssbut" style="color:#FFF1A8;" onclick="changePay(3);" /></td></tr>'+
										'<tr><td><input type="button" value="八達通" class="ssbut" style="color:#CAFFA8;" onclick="changePay(4);" /></td></tr>'+
										'</table>');
		$('#mpRecordTableArea').html('<table rules="all" width="100%" id="mpRecordTable"> <!-- mp = morePay -->'+
											'<tr>'+
												'<td  style="width: 25px">#</td>'+
												'<td style="width:150px; text-align: center;">付款方式</td>'+
												'<td style="width:100px;text-align: center;">金額</td>'+
											'</tr>'+
										'</table>');
		$('#morePayForm').dialog( 'open' );
	}
}//---end of endOrder()--------------------------------------------------------------
var temp,temp2="";
var maxReturnQty=0;
var tempIDN=0;
//-------salesReturn(invNo)-----------------------------------------------------------
function salesReturn(IDN,qty){
	$('#returnConForm').dialog('open');
	temp_qty=qty;
	tempIDN=IDN;
	
}

//-------end of salesReturn(invNo)----------------------------------------------------


//-------voidInvoice(invNo)-----------------------------------------------------------
function voidInvoice(invNo){
	$('#voidInvoiceConForm').dialog('open');
	$('#voidInvoiceConForm_pwd').select();
	invNo_s1=invNo;
	
}
//----end of voidInvoice(invNo)----------------------------------------------------

//-------findMobile()-----------------------------------------------------------------
function findMobile(){
	$('#findMobileFirMenu').html(null);
	$('#findMobileSecMenu').html(null);
	$('#findMobileBottom').html(null);
	$('#findMobileForm').dialog(null);
	$('#findMobileCode').val(null);
	$('#findMobileKey').val(null);
	
	$('#pdID').val(null);
		
	$('#findMobileFirMenu').html('<span style="font-size:20px; margin:0 0 0 0px;">Order by</span>'+
        '<input type="button" value="電話製造商" class="finMobileBut faby1" onclick="getMobileTypeMenu()"/>'+
        '<input type="button" value="電話顔色" class="finMobileBut faby2" onclick="getMobileColorMenu()"/>'+
        '<input type="button" value="電話名稱" class="finMobileBut faby3" onclick="getMobileNameMenu()"/>'+
        '<input type="button" value="電話種類狀態" class="finMobileBut faby4" onclick="getMobileStateMenu()"/>');
b=0;
	$('#findMobileBottom').load("../sales/salesGet.php?action=getMobileList&pageNo=0&shopno="+shopno);
	addFindMobileFoot();

	$('#findMobileForm').dialog( 'open' );
}
//---end of findMobile()-----------------------------------------------------------


//-------getMobileTypeMenu()----------------------------------------------------------------
function getMobileTypeMenu(){
	setAddClass2('.faby1');
	$('#findMobileSecMenu').css({'margin-left':'77px'});
	$('#findMobileSecMenu').load("../sales/salesGet.php?action=getMobileTypeMenu").hide().fadeIn();
}
//---end of getMobileTypeMenu()-------------------------------------------------------------
//------getMobileColorMenu()-----------------------------------------------------------------
function getMobileColorMenu(){
	setAddClass2('.faby2');
//	$('#div2').css({'background-color':'pink','font-size':'24px','color':'blue'});
	$('#findMobileSecMenu').css({'margin-left':'168px'});
	$('#findMobileSecMenu').html('<input type="button" value="a ~ z" class="finMobileBut" onclick="getMobileOrderList(\'color\',\'asc\');"/>'+
							  '<input type="button" value="z ~ a" class="finMobileBut" onclick	="getMobileOrderList(\'color\',\'desc\');"/>').hide().fadeIn();	
}
//---end of getMobileColorMenu()-------------------------------------------------------------
//-------getMobileNameMenu()------------------------------------------------------------------
function getMobileNameMenu(){
	setAddClass2('.faby3');
	$('#findMobileSecMenu').css({'margin-left':'245px'});
	$('#findMobileSecMenu').html('<input type="button" value="a ~ z" class="finMobileBut" onclick="getMobileOrderList(\'phone_name\',\'asc\');"/>'+
							  '<input type="button" value="z ~ a" class="finMobileBut" onclick	="getMobileOrderList(\'phone_name\',\'desc\');"/>').hide().fadeIn();	
}
//--------end of getMobileNameMenu()----------------------------------------------------------
//-------getMobileStateMenu()-----------------------------------------------------------------
function getMobileStateMenu(){
	setAddClass2('.faby4');
	$('#findMobileSecMenu').css({'margin-left':'322px'});
	$('#findMobileSecMenu').load("../sales/salesGet.php?action=getMobileStateMenu").hide().fadeIn();
}
//---end of getMobileStateMenu()-------------------------------------------------------------
//-------getMobileList(shortByA,shortByB,countTotal))--------------------------------------------------------------------
function getMobileList(shortByA,shortByB,countTotal){
	$('#findMobileBottom').load("../sales/salesGet.php?action=getMobileList&pageNo=0&shortByA="+shortByA+"&shortByB="+shortByB+"&shopno="+shopno);	
}
//---end of getMobileList(shortByA,shortByB,countTotal))-------------------------------------------------------------------

//-------getMobileOrderList(orderBy,ascDesc)-----------------------------------------------------------------
function getMobileOrderList(orderBy,ascDesc){
	$('#findMobileBottom').load("../sales/salesGet.php?action=getMobileList&pageNo=0&orderBy="+orderBy+"&ascDesc="+ascDesc+"&shopno="+shopno);	
}
//---end of getMobileOrderList(orderBy,ascDesc)-------------------------------------------------------------
function addFindMobileFoot(){
	$('#findMobileFoot').html('<button id=\"pagesMin\" class=\"pagesMin\" > < </button>'+
							   '<button id=\"pagesAdd\" class=\"pagesAdd\" > > </button>'+
							 '<script>'+
								'$(\'#pagesMin\').click( function(){'+
								 '   if (b-14>=0){'+
									'	b=b-14;'+
									'	$("#findMobileBottom").load("../sales/salesGet.php?action=getMobileList&pageNo="+b+"&shopno="+shopno);'+
									'}'+
								'});'+
								'b=0;'+
								'$(\'#pagesAdd\').click( function(){'+
								'	var oLi=document.getElementById("totalRow").value; '+
								'	if(b+14<=oLi){'+
								'		b=b+14;'+
				                '	$("#findMobileBottom").load("../sales/salesGet.php?action=getMobileList&pageNo="+b+"&shopno="+shopno);'+
								'	}'+
								'});'+
							 '</script>' );
}

//-------findAcc()-----------------------------------------------------------------
function findAcc(){
	$('#findAccFirMenu').html(null);
	$('#findAccSecMenu').html(null);
	$('#findAccBottom').html(null);
	$('#findAccForm').dialog(null);
	$('#findAccCode').val(null);
	$('#findAccKey').val(null);
	
	$('#pID').val(null);
		
	$('#findAccFirMenu').html('<span style="font-size:20px; margin:0 0 0 0px;">Order by</span>'+
        '<input type="button" value="配件種類" class="finAccByType faby1" onclick="getAccTypeMenu()"/>'+
        '<input type="button" value="配件製造商" class="finAccByType faby2" onclick="getAccManuMenu()"/>'+
        '<input type="button" value="配件顔色" class="finAccByType faby3" onclick="getAccColorMenu()"/>'+
        '<input type="button" value="配件狀態" class="finAccByType faby4" onclick="getAccStateMenu()"/>'+
		'<input type="checkbox" id="shoplimit" name="shoplimit"/><label for="shoplimit" style="font-size:17px">只顯示店舖'+shopid+'</label>');
b=0;

	$('#findAccBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0&limitShopno="+shopno);
	addFindAccFoot();

	$('#findAccForm').dialog('open');
}
//---end of findAcc()-------------------------------------------------------------

function addFindAccFoot(){
	$('#findAccFoot').html('<button id=\"pagesMin\" class=\"pagesMin\" > < </button>'+
							   '<button id=\"pagesAdd\" class=\"pagesAdd\" > > </button>'+
							 '<script>'+
								'$(\'#pagesMin\').click( function(){'+
								 '   if (b-14>=0){'+
									'	b=b-14;'+
									'	$("#findAccBottom").load("../sales/salesGet.php?action=getAccList&pageNo="+b+"&limitShopno="+shopno);'+
									'}'+
								'});'+
								'b=0;'+
								'$(\'#pagesAdd\').click( function(){'+
								'	var oLi=document.getElementById("totalRow").value; '+
								'	if(b+14<=oLi){'+
								'		b=b+14;'+
				                '	$("#findAccBottom").load("../sales/salesGet.php?action=getAccList&pageNo="+b+"&limitShopno="+shopno);'+
								'	}'+
								'});'+
							 '</script>' );
}

function findMobileByKeyword(e){
	var findMobileKey = document.getElementById('findMobileKey');
    var FindMobileKey= findMobileKey.value;
		$('#findMobileBottom').load("../sales/salesGet.php?action=getMobileList&pageNo=0&keyword="+FindMobileKey+"&shopno="+shopno);
}
function findMobileDetail(e){
	var findMobileCode = document.getElementById('findMobileCode');
    var FindMobileCode= findMobileCode.value;
	if(e.which==13&&FindMobileCode.length==15){
		getMobileList('ph.IMEI',FindMobileCode,'1');
		$(this).select();
		//$('#findMobileBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0");
	}
}

function findAccDetail(e){
	var pID = document.getElementById('pID');
    var PID= pID.value;
	if(e.which==13){
		getAccList('acc.acc_id',PID);
	}
}
function findAccByKeyword(e){
	var findAccKey = document.getElementById('findAccKey');
    var FindAccKey= findAccKey.value;
	if(checkLimit()){
		$.ajax({
			url: "../sales/salesGet.php?action=getAccListB",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
	        data: {
				FindAccKey:FindAccKey,
				pageNo:0,
				limitShopno:shopno,
			},
			async: true,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response) {
				$('#findAccBottom').html(response);
			}
		});//----End of ajax------
	} else {
		$.ajax({
			url: "../sales/salesGet.php?action=getAccListB",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
	        data: {
				FindAccKey:FindAccKey,
				pageNo:0,
				
			},
			async: true,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response) {
				$('#findAccBottom').html(response);
			}
		});//----End of ajax------
	}


	
}
function findCodeDetail(e){
	var findAccCode = document.getElementById('findAccCode');
    var FindAccCode= findAccCode.value;
	if(e.which==13&&FindAccCode.length==13){
		getAccList('acc.barcode',FindAccCode);
		$(this).select();
	}
}

function addAccToInvoice(accNo){
	$.ajax({
		url:"../sales/salesGet.php?action=getGdInfo",
		cache:false,
		dataType:'html',
		type:'GET',
		data:{ accNo:accNo,
			   osarea : osarea,
			   shopno : shopno, },
		error:function(xhr){alert('Ajax request Error!!!');},
		success:function(response){
			$('#saltb').append(response);
			$('#sQty').val(1);  //reset the qty to 1
			$('#tol').val(total.toFixed(1)); // .toFixed(n) 取小數點後n個位  正式寫法 document.write(total.toFixed(1))
		}
	});
	$('#findAccForm').dialog('close');
}
function addMobileToInvoice(phoneNo,shopNo){
	if(shopNo==shopno){
		$.ajax({
			url:"../sales/salesGet.php?action=getMobileInfo",
			cache:false,
			dataType:'html',
			type:'GET',
			data:{ inv_type:get_inv_type_val(),
				   phone_no:phoneNo,
				   osarea : osarea },
			error:function(xhr){alert('Ajax request Error!!!');},
			success:function(response){
				$('#saltb').append(response);
				$('#sQty').val(1);  //reset the qty to 1
				$('#tol').val(total.toFixed(1)); // .toFixed(n) 取小數點後n個位  正式寫法 document.write(total.toFixed(1))
			}
		});
		$('#listImeiForm').dialog('close');
		$('#findMobileForm').dialog('close');
	} else
		alert("非本店貨物");
}
function openImeiList(phoneTypeNo,shopNo){
	$.ajax({
		url:"../sales/salesGet.php?action=getIMEIList",
		cache:false,
		dataType:'html',
		type:'GET',
		data:{ phoneTypeNo:phoneTypeNo,
			   shopNo : shopNo },
		error:function(xhr){alert('Ajax request Error!!!');},
		success:function(response){
			$('#listImeiTop').html('<sapn>只會顯示店舖 '+shopid+' 的IMEI</span>');
			$('#listImeiBottom').html(response);
		}
	});
	
	$('#listImeiForm').dialog('open');
}

function cleanAccRecord(e, pnumber){
	var findAccCode = document.getElementById('findAccCode');
	var FindAccCode= findAccCode.value;
	if(FindAccCode.length ==0){
		$('#findAccBottom').html(null);
		//addFindInvoiceFoot();
		$('#findAccBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0"+"&limitShopno="+shopno);
	}
	if (!/^\d+$/.test(pnumber))
    {
        $(e).val(/^\d+/.exec($(e).val()));
    }
    return false;
}
function cleanMobileRecord(e, pnumber){
	var findMobileCode = document.getElementById('findMobileCode');
	var FindMobileCode= findMobileCode.value;
	if(FindMobileCode.length ==0){
		$('#findMobileBottom').html(null);
		//addFindInvoiceFoot();
		$('#findMobileBottom').load("../sales/salesGet.php?action=getMobileList&pageNo=0&shopno="+shopno);
	}
	if (!/^\d+$/.test(pnumber))
    {
        $(e).val(/^\d+/.exec($(e).val()));
    }
    return false;
}

function checkLimit(){
	return	$('#shoplimit').is(':checked');
}

//-------getAccTypeMenu()----------------------------------------------------------------
function getAccTypeMenu(){
	setAddClass2('.faby1');
	$('#findAccSecMenu').css({'margin-left':'77px'});
	$('#findAccSecMenu').load("../sales/salesGet.php?action=getAccTypeMenu").hide().fadeIn();
}
//---end of getAccTypeMenu()-------------------------------------------------------------
//-------getAccList()--------------------------------------------------------------------
function getAccList(shortByA,shortByB){
	if(checkLimit())
		$('#findAccBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0&shortByA="+shortByA+"&shortByB="+shortByB+"&limitShopno="+shopno);	
	else
		$('#findAccBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0&shortByA="+shortByA+"&shortByB="+shortByB+"&limitShopno="+shopno);
}
//---end of getAccList()-------------------------------------------------------------------
//-------getAccOrderList()-----------------------------------------------------------------
function getAccOrderList(orderBy,ascDesc){
	if(checkLimit())
		$('#findAccBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0&orderBy="+orderBy+"&ascDesc="+ascDesc+"&limitShopno="+shopno);
	else
		$('#findAccBottom').load("../sales/salesGet.php?action=getAccList&pageNo=0&orderBy="+orderBy+"&ascDesc="+ascDesc+"&limitShopno="+shopno);
}
//---end of getAccOrderList()-------------------------------------------------------------


//-------getAccManuMenu()-----------------------------------------------------------------
function getAccManuMenu(){
	setAddClass2('.faby2');
//	$('#div2').css({'background-color':'pink','font-size':'24px','color':'blue'});
	$('#findAccSecMenu').css({'margin-left':'153px'});
	$('#findAccSecMenu').html('<input type="button" value="a ~ z" class="findAccBut" onclick="getAccOrderList(\'manufacturer\',\'asc\');"/>'+
							  '<input type="button" value="z ~ a" class="findAccBut" onclick="getAccOrderList(\'manufacturer\',\'desc\');"/>').hide().fadeIn();	
}
//---end of getAccManuMenu()-------------------------------------------------------------

//-------getAccColorMenu()-----------------------------------------------------------------
function getAccColorMenu(){
	setAddClass2('.faby3');
//	$('#div2').css({'background-color':'pink','font-size':'24px','color':'blue'});
	$('#findAccSecMenu').css({'margin-left':'245px'});
	$('#findAccSecMenu').html('<input type="button" value="a ~ z" class="findAccBut" onclick="getAccOrderList(\'color\',\'asc\');"/>'+
							  '<input type="button" value="z ~ a" class="findAccBut" onclick="getAccOrderList(\'color\',\'desc\');"/>').hide().fadeIn();	
}
//---end of getAccColorMenu()-------------------------------------------------------------
//-------getAccStateMenu()-----------------------------------------------------------------
function getAccStateMenu(){
	setAddClass2('.faby4');
	$('#findAccSecMenu').css({'margin-left':'322px'});
	$('#findAccSecMenu').load("../sales/salesGet.php?action=getAccStateMenu").hide().fadeIn();
}
//---end of getAccStateMenu()-------------------------------------------------------------


//-------getAccStateMenu()-----------------------------------------------------------------
function getInvoiceStateMenu(){
	setAddClass2('.fit1');
	$('#findInvoiceSecMenu').css({'margin-left':'322px'});
	$('#findInvoiceSecMenu').load("../sales/salesGet.php?action=getInvoiceStateMenu").hide().fadeIn();
}
//---end of getAccStateMenu()-------------------------------------------------------------


function voidInvoiceDialog(){
	$('#voidInvoiceBottom').load("../sales/voidform.php");
	$('#voidInvoiceForm').dialog("open");
}
//-------findInvoice()-----------------------------------------------------------------
function findInvoice(){
	$('#findInvoiceFirMenu').html(null);
	$('#findInvoiceBottom').html(null);
	$('#findInvoiceForm').dialog(null);
	$('#invNo').val(null);
	$('#findInvoiceFirMenu').load("../sales/salesGet.php?action=getInvoiceTypeMenu");
	b=0;
	
	$('#findInvoiceBottom').load("../sales/salesGet.php?action=getInvoiceList&shopno="+shopno+"&pageNo=0");
	

		
	addFindInvoiceFoot();
//$('#findInvoiceTop').hide();  用了這句會引起dialog CSS問題

	$('#findInvoiceForm').dialog( 'open' );
}
//---end of findInvoice()-------------------------------------------------------------

//-------getInvoiceList(shortByA,shortByB)-----------------------------------------------------
function getInvoiceList(shortByA,shortByB){
	//$('#findInvoiceSecMenu').fadeOut();
	$('#findInvoiceBottom').load("../sales/salesGet.php?action=getInvoiceList&pageNo=0&shortByA="+shortByA+"&shortByB="+shortByB+"&shopno="+shopno);	
}

//---end of getInvoiceList(shortByA,shortByB)--------------------------------------------------


function addFindInvoiceFoot(){
	$('#findInvoiceFoot').html('<button id=\"pagesMin\" class=\"pagesMin\" > < </button>'+
							   '<button id=\"pagesAdd\" class=\"pagesAdd\" > > </button>'+
							 '<script>'+
								'$(\'#pagesMin\').click( function(){'+
								 '   if (b-14>=0){'+
									'	b=b-14;'+
									'	$("#findInvoiceBottom").load("../sales/salesGet.php?action=getInvoiceList&pageNo="+b);'+
									'}'+
								'});'+
								'b=0;'+
								'$(\'#pagesAdd\').click( function(){'+
								'	var oLi=document.getElementById("totalRow").value; '+
								'	if(b+14<=oLi){'+
								'		b=b+14;'+
				                '	$("#findInvoiceBottom").load("../sales/salesGet.php?action=getInvoiceList&pageNo="+b);'+
								'	}'+
								'});'+
							 '</script>' );
}
//---- findInvoiceRecord()-------------------------------------------------------------
function findInvoiceRecord(e){
	var bInvNo = document.getElementById('invNo');
    var cbInvNo= bInvNo.value;

	if(cbInvNo.length>0&& e.which==13){
//		$('#invNo').val(cbInvNo).select();
		getInvoiceDetails(filteInvNo(cbInvNo));
	}else if(cbInvNo.length==0)
		findInvoice();
}
//----end of findInvoiceRecord()-------------------------------------------------------
function getInvoiceDetails(invNo){
	//$('#invNo').val(invNo).select();
	$('#findInvoiceBottom').load("../sales/salesGet.php?action=getInvoiceDetails&invNo="+invNo);
	$('#findInvoiceFoot').html(null);
	$('#findInvoiceFirMenu').html(null);
}
//function cleanInvoiceRecord(e, pnumber){
function cleanInvoiceRecord(pnumber){
//	var bInvNo = document.getElementById('invNo');
//	var cbInvNo= bInvNo.value;
//	if(cbInvNo.length ==0){
//		$('#findInvoiceFirMenu').html(null);
//		//$('#findInvoiceFoot').html(null);
//		addFindInvoiceFoot();
//		$('#findInvoiceFirMenu').load("../sales/salesGet.php?action=getInvoiceTypeMenu");
//		$('#findInvoiceBottom').load("../sales/salesGet.php?action=getInvoiceList&pageNo=0");
//	}
	if (!/^\d+$/.test(pnumber))
    {
        $(e).val(/^\d+/.exec($(e).val()));
    }
    return false;
}
function filteInvNo(invNo){
	var test = invNo;
	var needToCut=test.indexOf('-');
	return (test.substr(needToCut+1,9));	
}

function getMcharge(){
	$('#mcharge').val(remainder);
	//return $('#mcharge').val(total.toFixed(1));
}
function callmorePayFoot(){
	/*
	$('#morePayFoot').html('<label for="tol" class="tt">總數 : </label>'+
		'<input type="text" id="tol" value = "'+total+'" class="disabled" disabled="disabled" />'+
		'<br />'+
		'<label for="remain" class="tt" style="color:red;">尚欠金額 : </label>'+
		'<input type="text" id="remain" value = "'+remainder+'" class="disabled" disabled="disabled" />');
	*/
	$('#morePayFoot').html('<table><tr><td><label for="tol" class="tt">總數  </label></td>'+
		'<td style="font-size:40px;" align="right">'+total+'</td><tr>'+
		'<td width="250px"><label for="remain" class="tt" style="color:red;">尚欠金額</label></td>'+
		'<td><input type="text" id="remain" value = "'+remainder+'" class="text ui-widget-content ui-corner-all" disabled="disabled" style="color:red;" />'+
		'</td></tr></table>');
	
	document.getElementById('mmoney').onkeydown = calMorePayOrder;
	
}

function changePay(cp){
	switch(cp){
		case 1:
			$('#morePayRight').html(null);
			$('#morePayFoot').html(null);
			
			$('#morePayRight').html(
				'<p style="color:#FFA8B5;" id="mpMethodName">現金</p>'+
			'<table cellpadding="5" id="morePayDialogTable">'+
			'<tr>'+
				'<td><label for="mcharge" class="tt">應付</label></td>'+
				'<td><input type="text" name="mcharge" id="mcharge" class="text ui-widget-content ui-corner-all" disabled="disabled" /></td>'+
			'</tr>'+
			'<tr>'+
				'<td><label for="mmoney" class="tt">輸入金額      -</label></td>'+
				'<td><input type="text" name="mmoney" id="mmoney" class="text ui-widget-content ui-corner-all" maxlength="7" onclick="select()"/></td>'+
			'</tr>'+	
			'</table>'+
			'<input type="hidden" value="1" id="paymentNum" />');
			getMcharge();
			setMmoneyFocus();
			callmorePayFoot();
			
			$('#remain').val(remainder);
			
			document.getElementById('mmoney').onkeydown = calMorePayOrder;
			
		break;
		
		case 2:
			$('#morePayRight').html(null);
			$('#morePayFoot').html(null);
			
			$('#morePayRight').html(
				'<p style="color:#FFCAA8;" id="mpMethodName">EPS</p>'+
			'<table cellpadding="5" id="morePayDialogTable">'+
			'<tr>'+
				'<td><label for="mcharge" class="tt">應付</label></td>'+
				'<td><input type="text" name="mcharge" id="mcharge" class="text ui-widget-content ui-corner-all" disabled="disabled" /></td>'+
			'</tr>'+
			'<tr>'+
				'<td><label for="mmoney" class="tt">輸入金額      -</label></td>'+
				'<td><input type="text" name="mmoney" id="mmoney" class="text ui-widget-content ui-corner-all" maxlength="7" onclick="select()"/></td>'+
			'</tr>'+
			'</table>'+
			'<input type="hidden" value="2" id="paymentNum" />');
			getMcharge();
			setMmoneyFocus();
			callmorePayFoot();
			
			$('#remain').val(remainder);
			
			document.getElementById('mmoney').onkeydown = calMorePayOrder;
			
		break;
		
		case 3:
			$('#morePayRight').html(null);
			$('#morePayFoot').html(null);
			
			$('#morePayRight').html(
				'<p style="color:#FFF1A8;" id="mpMethodName">信用卡</p>'+
			'<table cellpadding="5" id="morePayDialogTable">'+
			'<tr>'+
				'<td><label for="mcharge" class="tt">應付</label></td>'+
				'<td><input type="text" name="mcharge" id="mcharge" class="text ui-widget-content ui-corner-all" disabled="disabled" /></td>'+
			'</tr>'+
			'<tr>'+
				'<td><label for="mmoney" class="tt">輸入金額      -</label></td>'+
				'<td><input type="text" name="mmoney" id="mmoney" class="text ui-widget-content ui-corner-all" maxlength="7" onclick="select()"/></td>'+
			'</tr>'+
			'</table>'+
			'<input type="hidden" value="3" id="paymentNum" />');
			getMcharge();
			setMmoneyFocus();
			callmorePayFoot();
			
			$('#remain').val(remainder);
			
			document.getElementById('mmoney').onkeydown = calMorePayOrder;
		break;
		
		case 4:
			$('#morePayRight').html(null);
			$('#morePayFoot').html(null);
			
			$('#morePayRight').html(
				'<p style="color:#CAFFA8;" id="mpMethodName">八達通</p>'+
			'<table cellpadding="5" id="morePayDialogTable">'+
			'<tr>'+
				'<td><label for="mcharge" class="tt">應付</label></td>'+
				'<td><input type="text" name="mcharge" id="mcharge" class="text ui-widget-content ui-corner-all" disabled="disabled" /></td>'+
			'</tr>'+
			'<tr>'+
				'<td><label for="mmoney" class="tt">輸入金額      -</label></td>'+
				'<td><input type="text" name="mmoney" id="mmoney" class="text ui-widget-content ui-corner-all" maxlength="7" onclick="select()"/></td>'+
			'</tr>'+
			'</table>'+
			'<input type="hidden" value="4" id="paymentNum" />');
			
			getMcharge();
			setMmoneyFocus();
			callmorePayFoot();
			
			$('#remain').val(remainder);
		break;
	}
	
}


//-----------------------------------------------------------------

function calMorePayOrder(e){  //---計算張order
	var mmon = document.getElementById('mmoney');
    var sMmon = parseFloat(mmon.value).toFixed(1);
	var sTotal = total.toFixed(1);
    var sChange = 0;
    
    response = null;
    
    //當
    if(sMmon.length >0&& e.which==13 && sMmon>0){
    	//$('#money').attr("disabled", true); 
    	$('#mmoney').val(sMmon);
    	$('#mcharge').val(remainder);
    	
    	if ((sMmon - remainder)<= 0 ) {
    		
			remainder = (remainder - sMmon).toFixed(1);
    		$('#morePayDialogTable').append(
    			'<tr>'+
					'<td colspan="2"><div class="underline"></div></td>'+
				'</tr>'+
    			'<tr>'+
					'<td><label for="change" class="tt">尚欠金額</label></td>'+
					'<td><input type="text" id="change" value="'+remainder+'" class="text ui-widget-content ui-corner-all disabled" disabled="disabled" style="color:red;" /></td>'+
				'</tr>'	
			);
			$('#remain').val(remainder);
			disMmoney(); //個function在salesRight.php 用來disable個money個field
			addMpRecordTable();
    	} else {
    		$('#mmoney').select();
    		alert ('false');
    	}

    	var itemArrLength = itemArray.length;

		for ( i=0; i < itemArrLength; i++) {
			//alert(itemArray[i]+" "+itemArray[i+1]+" "+itemArray[i+2]+" "+itemArray[i+3]+" "+itemArray[i+4]+" "+itemArray[i+5]);
			i+=6;
		}

	}//--------End of if (13)-------------
}//-------------End of getGdInfo(e) function---------
    
//-----------------------------------------------------------------------++++++++++++++++++++

var mpRecordNum = 0;
function addMpRecordTable(){
	//mpRecordArray
	mpRecordNum++;
	var mmn = $('#mpMethodName').html();
	var mmVal = $('#mmoney').val();
	//alert (mpRecordNum+$('#mpMethodName').html()+$('#mmoney').val());
	mpRecordArray.push(mpRecordNum,$('#paymentNum').val(),$('#mmoney').val());
	
	//alert(mpRecordArray[0]+" "+mpRecordArray[0+1]+" "+mpRecordArray[0+2]);
	$('#mpRecordTable').append('<tr>'+
								'<td>'+mpRecordNum+'</td>'+'<td>'+mmn+'</td><td>'+mmVal+'</td>'+
							   '</tr>'
	);
}
//-----------------------------------------------------------------------++++++++++++++++++++
var op =0;
function calOrder(e){  //---計算張order
	var mon = document.getElementById('money');
    var sMon = parseFloat(mon.value).toFixed(1);
	var sMonVal = mon.value;
	var sTotal = total.toFixed(1);
    var sChange = (sMon-sTotal);
    response = null;
    canSave=false;
    //當
    
    if(sMonVal.length >0&& e.which==13 && (sMon-sTotal)>=0){
		if(paymentNo!=1){
			if(sChange>0){
				alert('輸入金額不相符');
				document.getElementById('money').select();
				exit(0);
			}
		}
    	//$('#money').attr("disabled", true); 
    	// 	alert(sMFX);
    	$('#money').val(sMon);
    	$('#change').val(sChange.toFixed(1));
    	//disMoney(); //個function在salesRight.php 用來disable個money個field
    	document.getElementById('money').select();
		op=op+1;
    	var itemArrLength = itemArray.length;
		canSave=true;
		
		for ( i=0; i < itemArrLength; i++) {
			//alert(itemArray[i]+" "+itemArray[i+1]+" "+itemArray[i+2]+" "+itemArray[i+3]+" "+itemArray[i+4]+" "+itemArray[i+5]+" "+itemArray[i+6]);
			i+=6;
		}
	}//--------End of if (13)-------------
	//var attr = $('#money').attr("disabled");
	//var hasCSS = (parseInt($('#wrapper').css('width')) === 960) ? true : false;

	
	
	
}//-------------End of calOrder(e) function---------

function caldiscount(e){  //---計算張order的discount
	var disprice = document.getElementById('disprice');
    sDisprice = parseFloat(disprice.value).toFixed(1);
	var sDispriceVal = disprice.value;
	
	var salprice = document.getElementById('salprice');
	sSalprice = parseFloat(salprice.value).toFixed(1);
	
	newPrice = $('#disprice').val();
	newPrice = parseFloat(newPrice);

    
    if(sDispriceVal.length >0&& e.which==13 && (sSalprice-sDisprice)>=0){
	  	sDiscount = (sSalprice-sDisprice);
    	$('#disprice').attr("disabled", true); 
		$('#disprice').val(sDisprice);
		tempdis = sDiscount.toFixed(1);
    	$('#tempdiscount').val(tempdis);
		$('#saltb tr:eq('+(delrow+1)+') td:eq(4)').html(tempdis);  // star with 0, update table record
		$('#saltb tr:eq('+(delrow+1)+') td:eq(5)').html(sDisprice);  // star with 0, update table record
		total = total+0+newPrice;
		var deleteOne = (delrow*7);
				itemArray.splice((deleteOne+4),1,tempdis);
				itemArray.splice((deleteOne+5),1,sDisprice);
				//alert(itemArray);
		$('#tol').val(total.toFixed(1));
		$('#discountForm').dialog('close');
	}//--------End of if (13)-------------
}//-------------End of caldiscount(e) function---------

function endChQtyForm(e){
	var dnechqty = document.getElementById('nechqty');
	var nechqtyVal = dnechqty.value;
	 if(nechqtyVal.length >0 && e.which==13){
	 	newQty = $('#nechqty').val()
		newDiscount = disprice; // 原本的discount
		newPrice = (newQty*sSellprice)-disprice;
		$('#saltb tr:eq('+(delrow+1)+') td:eq(3)').html(newQty);  // star with 0, update table record
		$('#saltb tr:eq('+(delrow+1)+') td:eq(4)').html(newDiscount); // star with 0, update table record
		$('#saltb tr:eq('+(delrow+1)+') td:eq(5)').html(newPrice.toFixed(1));  // star with 0, update table record
				total = total+0+newPrice;
				var deleteOne = (delrow*7);
				itemArray.splice((deleteOne+3),1,newQty);
				itemArray.splice((deleteOne+4),1,newDiscount);
				itemArray.splice((deleteOne+5),1,newPrice);
		$('#tol').val(total.toFixed(1));
	 	$('#chQtyForm').dialog('close');
	 }
}

//-----------------------------------------------------------------------++++++++++++++++++++

function printInvoice(invNo){
//	alert (invNo);
	window.open("../report/ReceiptReview.php?receipt_No="+invNo,"Print","toolbar=no");
}

function printPO(poNo){
	//alert (poNo);
	window.open("../report/POrderViewPHP.php?PO_no="+poNo,"Print","toolbar=no");
}
function printTrans(transNo){
	//alert (poNo);
	window.open("../report/TranferNotesPHP.php?trans_No="+transNo,"Print","toolbar=no");
}
/////////================End of salesOrder============================================



function reverseStockIn(){
var reverseArrayLength = reverseArray.length;

for (var z=0; z < reverseArrayLength; z++) {
	$.ajax({
    	url: "../sales/salesGet.php?action=reverseStockIn",
        cache: false,
        dataType: 'html',
        type:'GET',
		async: false,
        data: {
           	stockInNo : reverseArray[z],
           	qty : reverseArray[z+1],
        },
        error: function(xhr) {
			alert('Ajax request Error!!!!!');
        },
         success: function(response) { 
		}
	});
	z+=1;
}
reverseArray=[];
}





//---------------------------Function------------------------------------------
function setAddClass2($clsname){
	setRmClass2();
    $($clsname).addClass("findAccButSelect");
}
function setRmClass2(){
	$('.faby1').removeClass("findAccButSelect");
	$('.faby2').removeClass("findAccButSelect");
	$('.faby3').removeClass("findAccButSelect");
	$('.faby4').removeClass("findAccButSelect");
	$('.fit1').removeClass("findAccButSelect");
	$('#findInvoiceSecMenu').fadeOut();
}

function setInvTableListener(){

	$('#saltb tr').filter(function() {
		return $('td', this).length && !$('table', this).length
	}).click(function() {
		$('#discount').removeAttr("disabled");
		$('#chQty').removeAttr("disabled");
		$('#del').removeAttr("disabled");
		$('#saltb tr').removeClass('currRow');
		$(this).toggleClass('currRow');
		delrow =(this.rowIndex -1);
//	alert(delrow);
//	alert(itemArray);
	var targetcol = ((delrow*7)+4);

	//alert (targetcol);
	$('#saltb tr:eq('+(delrow+1)+') td:eq(4)').html();

	

});





}

function build_one(){
         alert("inside build_one");
  }
  
function rmLeftMenu(){
        $('.leftup').replaceWith('<div class = "leftup"></div>');
}
