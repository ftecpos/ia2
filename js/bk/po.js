var pagenum = pagenum1 = 1;
var totalPage,totalPage1,po_no;
var sum = subtotal = count = 0.0;
var portmb = portacc = editPInsertPoint = editAInsertPoint = 0;
var portmbnum = portaccnum= 0;
var detailMobile = new Array();
var detailAcc = new Array();
var editPhoneInsert = new Array();
var editAccInsert = new Array();
var arrayMobile = "";
var arrayAcc = "";
var statesId = "";
var deleteItem = "";
var changeItem = "";
var minsertItem = "";
var ainsertItem = "";
window.onload = selectPo();
window.onload = disadd('1');
window.onload = disab(true);
function addPage(ty) {
	if(ty == "getProduct") {
		if((pagenum+1) <= totalPage) {
			pagenum = parseInt(pagenum)+1;
			findPro("getProduct");
		}
	} else if(ty == "getPo") {
		if((pagenum1+1) <= totalPage1) {
			pagenum1 = parseInt(pagenum1)+1;
			findPro("getPo");
		}
	}
}
function lessPage(ty) {
	if(ty == "getProduct") {
		if((pagenum-1) > 0) {
			pagenum = parseInt(pagenum)-1;
			findPro("getProduct");
		}
	} else if(ty == "getPo") {
		if((pagenum1-1) > 0) {
			pagenum1 = parseInt(pagenum1)-1;
			findPro("getPo");
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
				findPro("getProduct");
			} else {
				document.getElementById('specPageError').innerHTML = "無效頁碼";
			}
		}	
	} else if(ty == "getPo") {
		var specPage = document.getElementById('specPage1').value;
		if(specPage == "")
			document.getElementById('specPageError1').innerHTML = "";
		if(event.keyCode == 13) {
			if(specPage > 0 && parseInt(specPage) <= parseInt(totalPage1)) {
				document.getElementById('specPageError1').innerHTML = "";
				pagenum1 = specPage;
				findPro("getPo");
			} else {
				document.getElementById('specPageError1').innerHTML = "無效頁碼";
			}
		}
	}
}
function changeArray(chid,chcol,ty,rw) {
	if(ty == "phone") {
		detailMobile[rw-1][chcol] = document.getElementById(chid).value;
		var table = document.getElementById('poDetailMobile');
		table.rows[rw].cells[5].innerHTML = (detailMobile[rw-1][0]) * (detailMobile[rw-1][1]);
	} else {
		detailAcc[rw-1][chcol] = document.getElementById(chid).value;
		var table = document.getElementById('poDetailAcc');
		table.rows[rw].cells[5].innerHTML = (detailAcc[rw-1][0]) * (detailAcc[rw-1][1]);
	}
	CalSub(ty);
	CalTotal();
}
function changeEditInsert(chid,chcol,ty) {
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
		editAccInsert[num][chcol] = document.getElementById(chid).value;
	}
}
function CalSub(ty) {
	subtotal = 0.0;
	if(ty == "phone") {
		for(var i = 0; i < detailMobile.length;i++) {
			subtotal += (detailMobile[i][0]) * (detailMobile[i][1]);
		}
		document.getElementById('mobileSubTotal').innerHTML = subtotal;
	} else {
		for(var i = 0; i < detailAcc.length;i++) {
			subtotal += (detailAcc[i][0]) * (detailAcc[i][1]);
		}
		document.getElementById('accSubTotal').innerHTML = subtotal;
	}
}
function CalTotal() {
	sum = 0.0;
	for(var i=0; i<detailMobile.length;i++) {
		sum += (detailMobile[i][0])*(detailMobile[i][1]);
	}
	for(var i=0; i<detailAcc.length;i++) {
		sum += (detailAcc[i][0])*(detailAcc[i][1]);
	}
	document.getElementById('total').innerHTML = sum;
}
function insertPo() {
	findPro("insertPo");
}
function selectPo() {
	findPro("getPo");
}
function updatePo() {
	minsertItem = "";
	ainsertItem = "";
	po_no = document.getElementById('editPoNo').value;
	var editPhone = document.getElementById('editPhoneDetail');
	var editAcc = document.getElementById('editAssDetail');
	for(var i =0;i<editPhoneInsert.length;i++) {
		if(editPhoneInsert[i][0] != 0 && editPhoneInsert[i][0] != "") {
			minsertItem += editPhone.rows[getRowIndex(i,"phone")].cells[1].innerHTML+":";
			minsertItem += editPhoneInsert[i][0]+":";
			minsertItem += editPhoneInsert[i][1]+"~";
		}
	}
	for(var i =0;i<editAccInsert.length;i++) {
		if(editAccInsert[i][0] != 0 && editAccInsert[i][0] != "") {
			ainsertItem += editAcc.rows[getRowIndex(i,"acc")].cells[1].innerHTML+":";
			ainsertItem += editAccInsert[i][0]+":";
			ainsertItem += editAccInsert[i][1]+"~";
		}
	}
	findPro("updatePo");
}
function getRowIndex(id,ty) {
	if(ty == "phone") {
		var tmp = document.getElementById('editInsertPhoneQty'+id);
	} else {
		var tmp = document.getElementById('editInsertAccQty'+id);
	}
	return tmp.parentNode.parentNode.rowIndex;
}
function changeStates(id) {
	statesId = id;
	findPro("getStates");
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
function changeEdit(no,qty,cost) {
	if(!IsNumeric(qty)) { 
		if(qty.substring(0,7) == "editAss" || qty.substring(0,9) == "editPhone") {
			qty = qty.replace("Cost","Qty");
			var qtyvalue = document.getElementById(qty).value;
		}
	} else { var qtyvalue = qty; }
	if(!IsNumeric(cost)) {
		if(cost.substring(0,7) == "editAss" || cost.substring(0,9) == "editPhone") {
			cost = cost.replace("Qty","Cost");
			var costvalue = document.getElementById(cost).value;
		}
	} else { var costvalue = cost; }
	changeItem += no+"~"+qtyvalue+"~"+costvalue+"/^/";
}
function findPro(action) {
if(action == "getProduct" || action == "getStates") {
	var code = document.getElementById('productCode').value;
	var name = document.getElementById('productName').value;
	var branch = document.getElementById('branch').value;
	var productType1 = document.getElementById('productType');
	if(productType1.checked)
		var type = productType1.value;
} else if(action == "getSupplier") {
	var supplierid = document.getElementById('supplierNo').value;
} else if(action == "insertPo") {
	var podetailm = document.getElementById('poDetailMobile');
	var podetaila = document.getElementById('poDetailAcc');
	var supno = document.getElementById('supplierNo').value;
	for(var i = 0;i < podetailm.tBodies[0].rows.length;i++) {
		arrayMobile += podetailm.rows[i+1].cells[1].innerHTML ;
		arrayMobile += "Mobile: "+detailMobile[i][0];
		arrayMobile += "Mobile: "+detailMobile[i][1] + "||";
	}
	for(var i = 0;i < podetaila.tBodies[0].rows.length;i++) {
		arrayAcc += podetaila.rows[i+1].cells[1].innerHTML;
		arrayAcc += "Acc: "+detailAcc[i][0];
		arrayAcc += "Acc: "+detailAcc[i][1] + "||";
	}
	
	
} else if(action == "editSearch") {
	var code = document.getElementById('editFindPro').value;
	for (var i=0; i < document.editSearchForm.editProductType.length; i++) {
   		if (document.editSearchForm.editProductType[i].checked) {
      		var type = document.editSearchForm.editProductType[i].value;
      	}
   }
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
		} else if(action == "getSupplier") {
			if(supplierid == "") {
				document.getElementById('supplierName').innerHTML = "";
				document.getElementById('supplierTel').innerHTML = "";
			} else {
				var tmpArray = xmlhttp.responseText.split("#&#");
				document.getElementById('supplierName').innerHTML = tmpArray[0];
				document.getElementById('supplierTel').innerHTML = tmpArray[1];
			}
		} else if(action == "editSearch") {
			document.getElementById('editResult').innerHTML = xmlhttp.responseText;
			totalPage = document.getElementById('totalPage1').innerHTML;
		} else if(action == "insertPo") {
			print_po_no = xmlhttp.responseText;
			$('#printPO').dialog('open');
			$('.rightContent').load("../inventory/po.php");
		} else {
			document.getElementById('showResult').innerHTML = xmlhttp.responseText;
			totalPage1 = document.getElementById('totalPage1').innerHTML;
		}
    }
  }
if(action == "getProduct") {
	xmlhttp.open("GET","../maintain/getall.php?action=getProduct&page="+pagenum+"&code="+code+"&name="+name+"&branch="+branch+"&type="+type+"&ed=getP",true);
} else if(action == "getSupplier") {
	xmlhttp.open("GET","../maintain/getall.php?action=getSupplier&supid="+supplierid,true);
} else if(action == "insertPo") {
	xmlhttp.open("GET","../maintain/getall.php?action=insertPo&podetailm="+arrayMobile+"&podetaila="+arrayAcc+"&supplierno="+supno+"&currTime="+showtime()+"&page="+pagenum1,true);
} else if(action == "getPo") {
	xmlhttp.open("GET","../maintain/getall.php?action=getPo&page="+pagenum1,true);
} else if(action == "getStates") {
	xmlhttp.open("GET","../maintain/getall.php?action=getStates&page="+pagenum1+"&statesId="+statesId+"&code="+code+"&name="+name+"&branch="+branch+"&type="+type,true);
} else if(action == "updatePo") {
	xmlhttp.open("GET","../maintain/getall.php?action=updatePo&page="+pagenum1+"&deleteItem="+deleteItem+"&changeItem="+changeItem+"&minsert="+minsertItem+"&ainsert="+ainsertItem+"&po_no="+po_no,true);
} else if(action == "editSearch") {
	xmlhttp.open("GET","../maintain/getall.php?action=editSearch&page="+pagenum+"&code="+code+"&type="+type+"&ed=edit",true);
}
xmlhttp.send();

}
function addProduct(n,rowindex,type,typeid,ed) {
		var otable = document.getElementById('result');
		if(ed == "edit") {
			if(type == "phone") {
				var ntable = document.getElementById('editPhoneDetail');
			} else {
				var ntable = document.getElementById('editAssDetail');
			}
		} else {
			if(type == "phone") {
				var ntable = document.getElementById('poDetailMobile');
			} else {
				var ntable = document.getElementById('poDetailAcc');
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
			ce1.setAttribute("name", "poDetailMobile" + iteration);
			ce1.setAttribute("id", "poDetailMobile" + iteration);
		} else {
			ce1.setAttribute("name", "poDetailAcc" + iteration);
			ce1.setAttribute("id", "poDetailAcc" + iteration);
		}
		ce1.setAttribute("value", "刪除");
		ce1.setAttribute("onclick","delr(this.parentNode.parentNode.rowIndex,\""+type+"\")");
	}
	cell1.appendChild(ce1);
	var cell2 = row.insertCell(1);
	cell2.appendChild(document.createTextNode(n));	
	var cell3 = row.insertCell(2);
	cell3.appendChild(document.createTextNode(otable.rows[rowindex].cells[1].innerHTML));
	var cell4 = row.insertCell(3);
	var e1 = document.createElement('input');
	e1.setAttribute("type", "text");
	if(ed == "edit") {
		if(type == "phone") {
			e1.setAttribute("name", "editInsertPhoneQty" + editPInsertPoint);
			e1.setAttribute("id", "editInsertPhoneQty" + editPInsertPoint);
		} else {
			e1.setAttribute("name", "editInsertAccQty" + editAInsertPoint);
			e1.setAttribute("id", "editInsertAccQty" + editAInsertPoint);
		}
		e1.setAttribute("size","10");
		e1.setAttribute("value", "1");
		e1.setAttribute("onChange","changeEditInsert(this.id,0,\""+type+"\")");
		if(type == "phone") {
			editPhoneInsert[editPInsertPoint] = new Array();
			editPhoneInsert[editPInsertPoint][0] = 1;
		} else {
			editAccInsert[editAInsertPoint] = new Array();
			editAccInsert[editAInsertPoint][0] = 1;
		}
	} else {
		if(type == "phone") {
			e1.setAttribute("name", "poQtyMobile" + portmbnum);
			e1.setAttribute("id", "poQtyMobile" + portmbnum);
		} else {
			e1.setAttribute("name", "poQtyAcc" + portaccnum);
			e1.setAttribute("id", "poQtyAcc" + portaccnum);
		}
		e1.setAttribute("value", "1");
		e1.setAttribute("onChange","changeArray(this.id,0,\""+type+"\",this.parentNode.parentNode.rowIndex)");
        //e1.setAttribute("onKeyUp",validateNumber($(this),value)));
		if(type == "phone") {
			detailMobile[portmb] = new Array();
			detailMobile[portmb][0] = 1;
		} else {
			detailAcc[portacc] = new Array();
			detailAcc[portacc][0] = 1;
		}
	}
  	cell4.appendChild(e1);
	var cell5 = row.insertCell(4);
	var e2 = document.createElement("input");
	e2.setAttribute("type","text");
	if(ed == "edit") {
		if(type == "phone") {
			e2.setAttribute("name", "editInsertPhoneCost" + editPInsertPoint);
			e2.setAttribute("id", "editInsertPhoneCost" + editPInsertPoint);
			e2.setAttribute("value", typeid);
		} else {
			e2.setAttribute("name", "editInsertAccCost" + editAInsertPoint);
			e2.setAttribute("id", "editInsertAccCost" + editAInsertPoint);
			e2.setAttribute("value", typeid);
		}
		e2.setAttribute("onChange","changeEditInsert(this.id,1,\""+type+"\")");
       // e2.setAttribute("onkeyup",validateNumberB($(this),value)));
		if(type == "phone") {
			editPhoneInsert[editPInsertPoint][1] = typeid;
		} else {
			editAccInsert[editAInsertPoint][1] = typeid;
		}
	} else {
		if(type == "phone") {
			e2.setAttribute("name", "poCostMobile" + portmbnum);
			e2.setAttribute("id", "poCostMobile" + portmbnum);
			e2.setAttribute("value", typeid);
		} else {
			e2.setAttribute("name", "poCostAcc" + portaccnum);
			e2.setAttribute("id", "poCostAcc" + portaccnum);
			e2.setAttribute("value", typeid);
		}
		e2.setAttribute("onChange","changeArray(this.id,1,\""+type+"\",this.parentNode.parentNode.rowIndex)");
       // e2.setAttribute("onkeyup",validateNumberB($(this),value)));
		if(type == "phone") {
			detailMobile[portmb][1] = typeid;
		} else {
			detailAcc[portacc][1] = typeid;
		}
	}
	e2.setAttribute("size","10");
	cell5.appendChild(e2);
	if(ed != "edit") {
		var cell6 = row.insertCell(5);
		if(type == "phone") {
			count = detailMobile[portmb][0] * detailMobile[portmb][1];
			cell6.appendChild(document.createTextNode(count));	
		} else {
			count = detailAcc[portacc][0] * detailAcc[portacc][1];
			cell6.appendChild(document.createTextNode(count));	
		}
		if(type == "phone") {
			portmbnum = portmbnum + 1;
		} else {
			portaccnum = portaccnum + 1;
		}
	CalSub(type);
	CalTotal();
	} else {
		if(type == "phone") {
			editPInsertPoint = editPInsertPoint + 1;
		} else {
			editAInsertPoint = editAInsertPoint + 1;
		}
	}
}
function clearResult() {
	document.getElementById('searchResult').innerHTML="";
	pagenum = 1;
}
function editReset() {
	document.getElementById('editFindPro').value = "";
	document.getElementById('editResult').innerHTML="";
	pagenum = 1;
}
function insertEditDelr(a,ty,pid) {
	if(ty == "phone") {
		var num = pid.substring(12,pid.length);
		editPhoneInsert[num][0] = editPhoneInsert[num][1] = 0;
		document.getElementById('editPhoneDetail').deleteRow(a);
	} else {
		var num = pid.substring(10,pid.length);
		editAccInsert[num][0] = editAccInsert[num][1] = 0;
		document.getElementById('editAssDetail').deleteRow(a);
	}
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
function delr(a,ty) {
	if(ty=="phone") {
		document.getElementById('poDetailMobile').deleteRow(a);
		a=a-1;
		for(var i = a;(i+1)<detailMobile.length;i++) {
			detailMobile[i][0] = detailMobile[i+1][0];
			detailMobile[i][1] = detailMobile[i+1][1];
		}
		detailMobile[detailMobile.length-1][0] = 1;
		detailMobile[detailMobile.length-1][1] = 0;
	} else {
		document.getElementById('poDetailAcc').deleteRow(a);
		a=a-1;
		for(var i = a;(i+1)<detailAcc.length;i++) {
			detailAcc[i][0] = detailAcc[i+1][0];
			detailAcc[i][1] = detailAcc[i+1][1];
		}
		detailAcc[detailAcc.length-1][0] = 1;
		detailAcc[detailAcc.length-1][1] = 0;
	}
	CalSub(ty);
	CalTotal();	
}
function disadd(a) {
	document.podetail.submit1.disabled = true;
	if(a == "2") {
	document.podetail.submit1.disabled = false;
	} else if(a == "3"){
		document.getElementById('supplierName').innerHTML="";
		document.getElementById('supplierTel').innerHTML="";
		var otable=document.getElementById("poDetailMobile"); 
 		while(otable.rows.length>2) 
    	otable.deleteRow(otable.rows.length-2); 
    	otable =document.getElementById("poDetailAcc"); 
    	while(otable.rows.length>2) 
    	otable.deleteRow(otable.rows.length-2); 
    	detailMobile = [];
		detailAcc = [];
		arrayAcc = [];
		arrayMobile = [];
    	portmb = 0;
    	portacc = 0;
    	portaccnum = 0;
    	portmbnum = 0;
    	sum = 0.0;
		subtotal = 0.0;
		document.getElementById('mobileSubTotal').innerHTML = subtotal;
		document.getElementById('accSubTotal').innerHTML = subtotal;
    	document.getElementById('total').innerHTML = sum;
	}
}
function editDisab(a) {
	var btnEditSearch = document.getElementById('editSearch');
	btnEditSearch.disabled = a;
}
function disab(a) {
	var btnSearch = document.getElementById('search');
	btnSearch.disabled = a;
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