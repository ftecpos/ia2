var pagenum = pagenum1 = 1;
var portmb = portacc = editPInsertPoint = editAInsertPoint = 0;
var portmbnum = portaccnum= 0;
var totalPage,totalPage1,tran_no;
var statesId = "";
var detailMobile = new Array();
var detailAcc = new Array();
var editPhoneInsert = new Array();
var editAccInsert = new Array();
var arrayMobile = "";
var arrayAcc = "";
var deleteItem = "";
var changeItem = "";
var minsertItem = "";
var ainsertItem = "";
window.onload = selectTran();
window.onload = disadd('1');
function selectTran() {
	processTran("selectTran");
}
function updateTran() {
	minsertItem = "";
	ainsertItem = "";
	tran_no = document.getElementById('editTranNo').value;
	var editPhone = document.getElementById('editPhoneDetail');
	var editAcc = document.getElementById('editAssDetail');
	for(var i =0;i<editPhoneInsert.length;i++) {
		if(editPhoneInsert[i][0] != 0 && editPhoneInsert[i][0] != "") {
			minsertItem += editPhone.rows[getRowIndex(i,"phone")].cells[1].innerHTML+":";
			minsertItem += editPhoneInsert[i][0]+"~";
		}
	}
	for(var i =0;i<editAccInsert.length;i++) {
		if(editAccInsert[i][0] != 0 && editAccInsert[i][0] != "") {
			ainsertItem += editAcc.rows[getRowIndex(i,"acc")].cells[1].innerHTML+":";
			ainsertItem += editAccInsert[i][0]+"~";
		}
	}
	processTran("updateTran");
}
function getRowIndex(id,ty) {
	if(ty == "phone") {
		var tmp = document.getElementById('editInsertPhoneQty'+id);
	} else {
		var tmp = document.getElementById('editInsertAccQty'+id);
	}
	return tmp.parentNode.parentNode.rowIndex;
}
function insertTran() {
	processTran("insertTran");
}
function voidTransfer() {
	processTran("voidTran");
}
function changeStates(id) {
	statesId = id;
	processTran("getStates");
}
function confirmTran() {
	tran_no = document.getElementById('confirmTranNo').value;
	processTran("confirmTran");
}
function checkIMEI(event) {
	if(event.keyCode == 13) {
		var imei = document.getElementById('findImei').value;
		if(document.getElementById('findImei').value.length != 0) {
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
 			 xmlhttp=new XMLHttpRequest();
 		 }
		else
		 {// code for IE6, IE5
 			 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 		 }
			xmlhttp.onreadystatechange=function()
 		 {
 	 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
				document.getElementById('searchResult').innerHTML=xmlhttp.responseText;
				var valid = "";
    			document.getElementById('IMEIPass').value = xmlhttp.responseText;
				valid = document.getElementById('IMEIPass').value;
				if(valid != "") {
					document.getElementById('imeierror').innerHTML = ""
					var productimei = valid.split('~');
					addProduct(null,null,"phone",null,"getP",productimei[0],productimei[1],imei);
				} else {
					document.getElementById('imeierror').innerHTML = "IMEI無效"
				}
    		}
 		 }
		xmlhttp.open("GET","../inventory/getTransfer.php?action=checkIMEI&IMEI="+imei,true);
		xmlhttp.send();
		}
	}
}
function addPage(ty) {
	if(ty == "getProduct") {
		if((pagenum+1) <= totalPage) {
			pagenum = parseInt(pagenum)+1;
			processTran("getProduct");
		}
	} else if(ty == "selectTran") {
		if((pagenum1+1) <= totalPage1) {
			pagenum1 = parseInt(pagenum1)+1;
			processTran("selectTran");
		}
	}
}
function lessPage(ty) {
	if(ty == "getProduct") {
		if((pagenum-1) > 0) {
			pagenum = parseInt(pagenum)-1;
			processTran("getProduct");
		}
	} else if(ty == "selectTran") {
		if((pagenum1-1) > 0) {
			pagenum1 = parseInt(pagenum1)-1;
			processTran("selectTran");
		}
	}
}
function specPage(event,ty) {
	if(ty == "getProduct") {
		var specPage = document.getElementById('specPage').value;
		if(specPage == "")
			document.getElementById('specPageError').innerHTML = "";
		if(event.keyCode == 13) {
			if(specPage > 0 && parseInt(specPage) <= parseInt(totalPage)) {
				document.getElementById('specPageError').innerHTML = "";
				pagenum = specPage;
				processTran("getProduct");
			} else {
				document.getElementById('specPageError').innerHTML = "無效頁碼";
			}
		}	
	} else if(ty == "selectTran") {
		var specPage = document.getElementById('specPage1').value;
		if(specPage == "")
			document.getElementById('specPageError1').innerHTML = "";
		if(event.keyCode == 13) {
			if(specPage > 0 && parseInt(specPage) <= parseInt(totalPage1)) {
				document.getElementById('specPageError1').innerHTML = "";
				pagenum1 = specPage;
				processTran("selectTran");
			} else {
				document.getElementById('specPageError1').innerHTML = "無效頁碼";
			}
		}
	}
}
function processTran(action) {
if(action == "insertTran") {
	var branchto = document.getElementById('branchto').value;
	var trandetailm = document.getElementById('tranDetailMobile');
	var trandetaila = document.getElementById('tranDetailAcc');
	for(var i = 0;i < trandetailm.tBodies[0].rows.length;i++) {
		arrayMobile += trandetailm.rows[i+1].cells[1].innerHTML ;
		arrayMobile += "Mobile: "+detailMobile[i][0] + "||";
	}
	for(var i = 0;i < trandetaila.tBodies[0].rows.length;i++) {
		arrayAcc += trandetaila.rows[i+1].cells[1].innerHTML;
		arrayAcc += "Acc: "+detailAcc[i][0] + "||";
	}
	var tranReson = document.getElementById('transreson').value;
	if(tranReson == "其它") tranReson = document.getElementById('otherReson').value;
} else if(action == "getProduct" || action == "getStates") {
	var code = document.getElementById('productCode1').value;
	var name = document.getElementById('productName1').value;
	var branch = document.getElementById('branch1').value;
	var productType = document.getElementById('productType1');
	if(productType.checked)
		var type = productType.value;
} else if(action == "editSearch") {
	var code = document.getElementById('editFindPro').value;
	var ptype = document.getElementById('editProductType');
	var editProductType = document.getElementById('editProductType');
	for (var i=0; i < editProductType.length; i++) {
   		if (editProductType[i].checked) {
      		var type = editProductType[i].value;
      	}
   }
} else if(action == "voidTran") {
	var voidtran_no = document.getElementById('editTranNo').value;
}

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	if(action == "getProduct" || action == "getStates") {
   			document.getElementById('searchResult').innerHTML=xmlhttp.responseText;
			totalPage = document.getElementById('totalPage').innerHTML;
			
		} else if(action == "editSearch") {
			document.getElementById('editResult').innerHTML = xmlhttp.responseText;
			totalPage = document.getElementById('totalPage1').innerHTML;
		} else if(action == "insertTran") {
			//print_po_no = xmlhttp.responseText;
			document.getElementById('showResult').innerHTML = xmlhttp.responseText;
			print_trans_no = $('#trans_no').val();
			$('#printTrans').dialog('open');
			$('.rightContent').load("../inventory/transfer.php");
			add_trans_msg(branchto,print_trans_no);
			
			//if(document.getElementById('inserterror').value == "error") {
			//	alert("配件存貨不足");
			//	disadd('3');
			//}
			
		}  else {
			document.getElementById('showResult').innerHTML = xmlhttp.responseText;
			totalPage1 = document.getElementById('totalPage1').innerHTML;
		}
    }
  }
if(action== "updateTran") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action=updateTran&page="+pagenum1+"&deleteItem="+deleteItem+"&changeItem="+changeItem+"&minsert="+minsertItem+"&ainsert="+ainsertItem+"&tran_no="+tran_no,true);
} else if(action == "insertTran") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action=insertTran&trandetailm="+arrayMobile+"&trandetaila="+arrayAcc+"&branchto="+branchto+"&currTime="+showtime()+"&tranReson="+tranReson+"&page="+pagenum1,true);
} else if(action == "getProduct") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action=getProduct&page="+pagenum+"&code="+code+"&name="+name+"&branch="+branch+"&type="+type+"&ed=getP",true);
} else if(action == "getStates") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action=getStates&page="+pagenum1+"&statesId="+statesId+"&code="+code+"&name="+name+"&branch="+branch+"&type="+type+"&ed=getP",true);
} else if(action == "editSearch") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action=editSearch&page="+pagenum+"&code="+code+"&type="+type+"&ed=edit",true);
} else if(action == "confirmTran") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action=confirmTran&page="+pagenum+"&tran_no="+tran_no+"&confirmdate="+showtime()+"&confirmby=2",true);
} else if(action == "voidTran") {
	xmlhttp.open("GET","../inventory/getTransfer.php?action="+action+"&tran_no="+voidtran_no+"&page="+pagenum,true);
} else {
	xmlhttp.open("GET","../inventory/getTransfer.php?action="+action+"&page="+pagenum1,true);
}
xmlhttp.send();
}
function addProduct(n,rowindex,type,typeid,ed,pno,pname,imei) {
		if(ed == "edit") {
			if(pno == null) {
				var otable = document.getElementById('eresult');
			}
			if(type == "phone") {
				var ntable = document.getElementById('editPhoneDetail');
			} else {
				var ntable = document.getElementById('editAssDetail');
			}
		} else {
			if(pno == null) {
				var otable = document.getElementById('result');
			}
			if(type == "phone") {
				var ntable = document.getElementById('tranDetailMobile');
			} else {
				var ntable = document.getElementById('tranDetailAcc');
			}
		}
		if(type == "phone") {
			if(!validTrandetail(otable.rows[rowindex].cells[4].innerHTML,type)) {
				alert("Product existed in transfer.");
				return ""; 
			}
		} else {
			if(!validTrandetail(n,type)) {
				alert("Product existed in transfer.");
				return ""; 
			}
		}
	var lastrow = ntable.tBodies[0].rows.length;
	var iteration = lastrow; 
	if(type == "phone") {
		portmb = iteration;
	} else {
		portacc = iteration;
	}
	var row = ntable.tBodies[0].insertRow(lastrow);
	var cell1 = row.insertCell(0);
	var ce1 = document.createElement('input');
	ce1.setAttribute("type", "button");
	if(ed == "edit") {
		if(type == "phone") {
			ce1.setAttribute("name", "editPhoneDel" + editPInsertPoint);
			ce1.setAttribute("id", "editPhoneDel" + editPInsertPoint);
		} else {
			ce1.setAttribute("name", "editAccDel" + editAInsertPoint);
			ce1.setAttribute("id", "editAccDel" + editAInsertPoint);
		}
		ce1.setAttribute("value", "刪除");
		ce1.setAttribute("onclick","insertEditDelr(this.parentNode.parentNode.rowIndex,\""+type+"\",this.id)");
	} else {
		if(type == "phone") {
			ce1.setAttribute("name", "tranDetailMobile" + iteration);
			ce1.setAttribute("id", "tranDetailMobile" + iteration);
		} else {
			ce1.setAttribute("name", "tranDetailAcc" + iteration);
			ce1.setAttribute("id", "tranDetailAcc" + iteration);
		}
		ce1.setAttribute("value", "刪除");
		ce1.setAttribute("onclick","delr(this.parentNode.parentNode.rowIndex,\""+type+"\")");
	}
	cell1.appendChild(ce1);
	var cell2 = row.insertCell(1);
	if(pno == null) {
		cell2.appendChild(document.createTextNode(n));	
	} else {
		cell2.appendChild(document.createTextNode(pno));	
	}
	var cell3 = row.insertCell(2);
	if(pno == null) {
		cell3.appendChild(document.createTextNode(otable.rows[rowindex].cells[1].innerHTML));
	} else {
		cell3.appendChild(document.createTextNode(pname));
	}
	var cell4 = row.insertCell(3);
	if(type == "phone") {
		if(pno == null) {
			cell4.appendChild(document.createTextNode(otable.rows[rowindex].cells[4].innerHTML));
			detailMobile[portmb] = new Array();
			detailMobile[portmb][0] = otable.rows[rowindex].cells[4].innerHTML;
		} else {
			cell4.appendChild(document.createTextNode(imei));
			detailMobile[portmb] = new Array();
			detailMobile[portmb][0] = imei;
		}
	} else {
	var e1 = document.createElement('input');
	e1.setAttribute("type", "text");
	if(ed == "edit") {
		e1.setAttribute("name", "editInsertAccQty" + editAInsertPoint);
		e1.setAttribute("id", "editInsertAccQty" + editAInsertPoint);
		e1.setAttribute("size","10");
		e1.setAttribute("value", "1");
		e1.setAttribute("onChange","changeEditInsert(this.id,0,\""+type+"\","+otable.rows[rowindex].cells[3].innerHTML+")");
		editAccInsert[editAInsertPoint] = new Array();
		editAccInsert[editAInsertPoint][0] = 1;
		var e2 = document.createElement('label');
		e2.setAttribute("id","editError"+editAInsertPoint);
		e2.setAttribute("class","error");
	} else {
		e1.setAttribute("name", "tranQtyAcc" + portaccnum);
		e1.setAttribute("id", "tranQtyAcc" + portaccnum);
		e1.setAttribute("value", "1");
		//e1.setAttribute("onKeyUp",validateNumber($(this),value));
		e1.setAttribute("onChange","changeArray(this.id,0,\""+type+"\",this.parentNode.parentNode.rowIndex,"+otable.rows[rowindex].cells[3].innerHTML+")");
		detailAcc[portacc] = new Array();
		detailAcc[portacc][0] = 1;
		var e2 = document.createElement('label');
		e2.setAttribute("id","insertError");
		e2.setAttribute("class","error1");
	}
	}
  	cell4.appendChild(e1);
	cell4.appendChild(e2);
	if(ed != "edit") {
		if(type == "phone") {
			portmbnum = portmbnum + 1;
		} else {
			portaccnum = portaccnum + 1;
		}
	} else {
		if(type == "phone") {
			editPInsertPoint = editPInsertPoint + 1;
		} else {
			editAInsertPoint = editAInsertPoint + 1;
		}
	}
}
function changeArray(chid,chcol,ty,rw,maxvalue) {
	if(ty == "phone") {
		detailMobile[rw-1][chcol] = document.getElementById(chid).value;
	} else {
		var valu = document.getElementById(chid).value;
		if(valu <= maxvalue) {
			document.getElementById('insertError').innerHTML = "";
			detailAcc[rw-1][chcol] = valu;
		} else {
			document.getElementById('insertError').innerHTML = "不能大於存貨數量";
			document.getElementById(chid).value = 1;
		}
	}
}
function changeEditInsert(chid,chcol,ty,maxvalue) {
	if(chcol == "0") {
		if(ty == "phone") {
			var num = chid.substring(18,chid.length);	
		} else {
			var num = chid.substring(16,chid.length);
		}
	} else {
		if(ty == "phone") {
			var num = chid.substring(19,chid.length);	
		} else {
			var num = chid.substring(17,chid.length);
		}
	}
	if(ty == "phone") {
		editPhoneInsert[num][chcol] = document.getElementById(chid).value;
	} else {
		var valu = document.getElementById(chid).value;
		if(valu <= maxvalue) {
			document.getElementById('editError'+num).innerHTML = "";
			editAccInsert[num][chcol] = valu;
		} else {
			document.getElementById('editError'+num).innerHTML = "不能大於存貨數量";
			document.getElementById(chid).value = 1;
		}
	}
}
function delr(a,ty) {
	if(ty=="phone") {
		document.getElementById('tranDetailMobile').deleteRow(a);
		a=a-1;
		for(var i = a;(i+1)<detailMobile.length;i++) {
			detailMobile[i][0] = detailMobile[i+1][0];
			detailMobile[i][1] = detailMobile[i+1][1];
		}
		detailMobile[detailMobile.length-1][0] = 0;
	} else {
		document.getElementById('tranDetailAcc').deleteRow(a);
		a=a-1;
		for(var i = a;(i+1)<detailAcc.length;i++) {
			detailAcc[i][0] = detailAcc[i+1][0];
			detailAcc[i][1] = detailAcc[i+1][1];
		}
		detailAcc[detailAcc.length-1][0] = 0;
	}
}
function editDisab(a) {
	var butt = document.getElementById('editSearch');
	butt.disabled = a;
}
function validTrandetail(a,type) {
	if(type == "phone") {
		var trantable = document.getElementById('tranDetailMobile');
		for(var i = 0;i < trantable.tBodies[0].rows.length;i++) {
			if(trantable.rows[i+1].cells[3].innerHTML == a) {
				return false;
			}
		}
	return true;
	} else {
		var trantable = document.getElementById('tranDetailAcc');
		for(var i = 0;i < trantable.tBodies[0].rows.length;i++) {
			if(trantable.rows[i+1].cells[1].innerHTML == a) {
				return false;
			}
		}
	return true;
	}
}
function editReset() {
	document.getElementById('editFindPro').value = "";
	document.getElementById('editResult').innerHTML="";
	pagenum = 1;
}
function editDelr(a,ty,id) {
	if(ty == "phone") {
		var table = document.getElementById('editPhoneDetail');
		deleteItem += id+"~";
		table.deleteRow(a);
	} else {
		var table = document.getElementById('editAssDetail');
		deleteItem += id+"~";
		table.deleteRow(a);
	}
}
function changeEdit(no,qty,maxnum,id) {
	if(qty <= maxnum) {
		document.getElementById('editError').innerHTML = "";
		changeItem += no+"~"+qty+"/^/";
	} else {
		document.getElementById('editError').innerHTML = "不能大於存貨數量";
		document.getElementById(id).value = 1;
	}
}
function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) { IsNumber = false; }
      }
   return IsNumber;  
}
function disadd(a) {
	var btnsubmit = document.getElementById('submit1');
	btnsubmit.disabled = true;
	if(a == "2") {
	btnsubmit.disabled = false;
	} else if(a == "3"){
		var otable=document.getElementById("tranDetailMobile"); 
 		while(otable.rows.length>1) 
    	otable.deleteRow(otable.rows.length-1); 
    	otable =document.getElementById("tranDetailAcc"); 
    	while(otable.rows.length>1) 
    	otable.deleteRow(otable.rows.length-1); 
    	detailMobile = [];
		detailAcc = [];
		arrayAcc = [];
		arrayMobile = [];
    	portmb = 0;
    	portacc = 0;
    	portaccnum = 0;
    	portmbnum = 0;
		clearResult();
	}
}
function disab(a) {
	var btnsearch = document.getElementById('search1');
	btnsearch.disabled = a;
}
function disableSubmit(a) {
	var btnsubmit = document.getElementById('submit1');
	btnsubmit.disabled = a;
}
function clearResult() {
	document.getElementById('imeierror').innerHTML = "";
	document.getElementById('searchResult').innerHTML="";
	pagenum = 1;
}
function clearVal() {
	deleteItem = "";
	changeItem = "";
	minsertItem = "";
	ainsertItem = "";
	editPhoneInsert = [];
	editAccInsert = [];
	editPInsertPoint = 0;
	editAInsertPoint = 0;
}

function showtime() {
var now = new Date();
var year = now.getFullYear();
var month = now.getMonth();
var day = now.getDate();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = year+"-"+(month+1)+"-"+day;
timeValue += " " + hours;
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
return timeValue;
}