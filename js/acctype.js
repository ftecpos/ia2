var pagenum = 1;
var totalPage;
window.onload = selectType();
function selectType() {
	processType("selectType");
}
function insertType() {
	processType("insertType");
}
function updateType() {
	processType("updateType");
}
function exInsert() {
	selectType();
}
function addPage() {
	if((pagenum+1) <= totalPage) {
		pagenum = parseInt(pagenum) + 1;
		processType("selectType");
	}
}
function lessPage() {
	if((pagenum-1) > 0) {
		pagenum = parseInt(pagenum) - 1;
		processType("selectType");
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
			processType("selectType");
		} else {
			document.getElementById('specPageError').innerHTML = "無效頁碼";
		}
	}
}
function processType(str) {
if(str == "updateType") {
	var no = document.getElementById('editNo').value;
	var typename = document.getElementById('editName').value;
} else if(str == "exInsert") {
	var file = document.getElementById('exTypeIn').value;
	var pos =file.lastIndexOf( file.charAt( file.indexOf(":")+1) ); 
	var filename = file.substring( pos+1);
} else {
	var typename = document.getElementById('typeName').value;
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
if(str == "updateType") {
	xmlhttp.open("GET","../maintain/getall.php?action="+str+"&page="+pagenum+"&type="+typename+"&no="+no,true);
} else if(str == "exInsert") {
	xmlhttp.open("GET","../maintain/getall.php?action="+str+"&page="+pagenum+"&file="+filename,true);
} else {
	xmlhttp.open("GET","../maintain/getall.php?action="+str+"&page="+pagenum+"&type="+typename,true);
}
xmlhttp.send();
}
function formClear(a) {
	var frm = document.getElementById(a);
	frm.reset();
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
	processType('exInsert');
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
function clear() {
	document.getElementById('processing').innerHTML = "";
}