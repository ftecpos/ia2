var pagenum = 1;
var totalPage;
var ch1 = false;
var ch2 = false;
var ch3 = false;
var ch4 = false;
var from,to,cusName;
window.onload = selectCust();
function selectCust() {
	processCust("getCustomer");
}
function insertCust() {
	processCust("insertCustomer");
}
function updateCust() {
	processCust("updateCustomer");
}
function search() {
	from = document.getElementById('idfrom').value;
	to = document.getElementById('idto').value;
	cusName = document.getElementById('custName').value;
	pagenum = 1;
	processCust("getCustomer");
}	
function addPage() {
	if((pagenum+1) <= totalPage) {
		pagenum = parseInt(pagenum)+1;
		processCust("getCustomer");
	}
}
function lessPage() {
	if((pagenum-1) > 0) {
		pagenum = parseInt(pagenum)-1;
		processCust("getCustomer");
	}
}
function specPage(event) {
	var specPage = document.getElementById('specPage').value;
	if(specPage == "")
		document.getElementById('specPageError').innerHTML = "";
	if(event.keyCode == 13) {
		if(specPage > 0 && parseInt(specPage) <= parseInt(totalPage)) {
			document.getElementById('specPageError').innerHTML = "";
			pagenum = specPage;
			processCust("getCustomer");
		} else {
			document.getElementById('specPageError').innerHTML = "無效頁碼";
		}
	}
}
function processCust(str) {
if(str == "updateCustomer") {
	var no= document.getElementById('editNo').value;
	var name= document.getElementById('editName').value;
	var address= document.getElementById('editAdd').value;
	var tel= document.getElementById('editTel').value;
	var fax= document.getElementById('editFax').value;
	var email= document.getElementById('editEmail').value;
	var period= document.getElementById('editPeriod').value;
	var remark= document.getElementById('editRemark').value;
	var custid= document.getElementById('editId').value;
} else if(str == "exCustInsert") {
	var file = document.getElementById('exCustIn').value;
	var pos =file.lastIndexOf( file.charAt( file.indexOf(":")+1) ); 
	var filename = file.substring( pos+1);
} else {
	var name= document.getElementById('customerName').value;
	var address= document.getElementById('address').value;
	var tel= document.getElementById('tel').value;
	var fax= document.getElementById('fax').value;
	var email= document.getElementById('email').value;
	var period= document.getElementById('period').value;
	var remark= document.getElementById('remark').value;
	var custid= document.getElementById('customerId').value;
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
    	document.getElementById('showResult').innerHTML = xmlhttp.responseText;
    	totalPage = document.getElementById('totalPage').innerHTML;
    }
  }
if(str == "updateCustomer") {
	xmlhttp.open("GET","../maintain/getall.php?action="+str+"&page="+pagenum+"&id="+custid+"&name="+name+"&address="+address+"&tel="+tel+"&fax="+fax+"&email="+email+"&period="+period+"&remark="+remark+"&idfrom="+from+"&idto="+to+"&custName="+cusName+"&no="+no,true);
} else if(str == "exCustInsert") {
	xmlhttp.open("GET","../maintain/getall.php?action="+str+"&page="+pagenum+"&file="+filename,true);
} else {
	xmlhttp.open("GET","../maintain/getall.php?action="+str+"&page="+pagenum+"&id="+custid+"&name="+name+"&address="+address+"&tel="+tel+"&fax="+fax+"&email="+email+"&period="+period+"&remark="+remark+"&idfrom="+from+"&idto="+to+"&custName="+cusName,true);
}
xmlhttp.send();
}
function validId(str) {
	var submit1 = document.getElementById('submit1');
	submit1.disabled = true;
	ch4 = false;
	if(str != "") {
		document.getElementById('custid').innerHTML = "";
		ch4 = true;
		checkButton();
	} else {
		document.getElementById('custid').innerHTML = "不可空白";
	}
}
function validName(str) {
	var submit1 = document.getElementById('submit1');
	submit1.disabled = true;
	ch1 = false;
	if(str != "") {
		document.getElementById('name').innerHTML = "";
		ch1 = true;
		checkButton();
	} else {
		document.getElementById('name').innerHTML = "不可空白";
	}
}
function validAdd(str) {
	var submit1 = document.getElementById('submit1');
	submit1.disabled = true;
	ch2 = false;
	if(str != "") {
		document.getElementById('address').innerHTML = "";
		ch2 = true;
		checkButton();
	} else {
		document.getElementById('address').innerHTML = "不可空白";
	}
}
function validEmail(str) {
	var submit1 = document.getElementById('submit1');
	var textEmail = document.getElementById('email');
	submit1.disabled = true;
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str)) {
		document.getElementById('error').innerHTML = "";
		if(ch1 == true && ch2 == true && ch3 == true) {
		submit1.disabled = false;
		}
	} else if(str == "") {
		document.getElementById('error').innerHTML = "";
		if(ch1 == true && ch2 == true && ch3 == true) {
		submit1.disabled = false;
		}
	} else {
		document.getElementById('error').innerHTML = "電郵格式有誤";
		textEmail.focus();
	}
}
function validTel(str) {
	var submit1 = document.getElementById('submit1');
	var textTel = document.getElementById('tel');
	submit1.disabled = true;
	var numeric = /^[0-9]+$/;
	ch3 = false;
	if(str.match(numeric)) {
		document.getElementById('telError').innerHTML = "";
		ch3 = true;
		checkButton();
	} else if(str == "") { 		
		document.getElementById('telError').innerHTML = "不可空白";
	} else {
		document.getElementById('telError').innerHTML = "必須為有效數字";
		textTel.focus();
	}
}
function validFax(str) {
	var submit1 = document.getElementById('submit1');
	var textFax = document.getElementById('fax');
	submit1.disabled = true;
	var numeric = /^[0-9]+$/;
	if(str.match(numeric)) {
		document.getElementById('faxError').innerHTML = "";
		if(ch1 == true && ch2 == true && ch3 == true) {
		submit1.disabled = false;
		}
	} else if(str == "") {
		document.getElementById('faxError').innerHTML = "";
		if(ch1 == true && ch2 == true && ch3 == true) {
		submit1.disabled = false;
		}
	} else {
		document.getElementById('faxError').innerHTML = "必須為有效數字";
		textFax.focus();
	}
}
function checkButton() {
	var submit1 = document.getElementById('submit1');
	if(ch1 == true && ch2 == true && ch3 == true && ch4 == true) {
		submit1.disabled = false;
	} else {
		submit1.disabled = true;
	}
}
function clearError() {
	var submit1 = document.getElementById('submit1');
	var myform = document.getElementById('myform');
	document.getElementById('name').innerHTML = "";
	document.getElementById('address').innerHTML = "";
	document.getElementById('faxError').innerHTML = "";
	document.getElementById('telError').innerHTML = "";
	document.getElementById('error').innerHTML = "";
	submit1.disabled = true;
	myform.reset();
	ch1 = false;
	ch2 = false;
	ch3 = false;
	ch4 = false;
}
function clearform() {
	var custSearch = document.getElementById('custSearch');
	from = undefined;
	to = undefined;
	cusName = undefined;
	selectCust();
	custSearch.reset();
}
function startUpload() {
document.getElementById('processing').innerHTML = '導入中,請稍候...';
return true;
}
function stopUpload(rel){
var msg;
switch (rel) {
case 0:
	msg = "";
	processCust('exCustInsert');
	break;
case 1:
	msg = "導入的文件過大";
	break;
case 2:
	msg = "只能導入xls,xlsx的Excel檔案";
	break;
default:
	msg = "導入錯誤";
}
document.getElementById('processing').innerHTML = msg;
}