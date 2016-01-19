<?php 
  require('../../conn/sqlconnect.php');	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>

<script type="text/javascript">
var pagenum = 1;
var totalPage;
var from,to,cusName;
var xmlhttp;

window.onload = selectCust();
function selectCust() {
	processCust("getCustomer");
}

function updateCust() {
	processCust("updateCustomer");
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
	xmlhttp.open("GET","../../report/testing/editStaff.php?action="+str+"&page="+pagenum+"&id="+custid+"&name="+name+"&address="+address+"&tel="+tel+"&fax="+fax+"&email="+email+"&period="+period+"&remark="+remark+"&idfrom="+from+"&idto="+to+"&custName="+cusName+"&no="+no,true);
} else {
	xmlhttp.open("GET","../../report/testing/editStaff.php?action="+str+"&page="+pagenum+"&id="+custid+"&name="+name+"&address="+address+"&tel="+tel+"&fax="+fax+"&email="+email+"&period="+period+"&remark="+remark+"&idfrom="+from+"&idto="+to+"&custName="+cusName,true);
}
xmlhttp.send();
}

function search() {
	from = document.getElementById('idfrom').value;
	to = document.getElementById('idto').value;
	cusName = document.getElementById('custName').value;
	pagenum = 1;
	processCust("getCustomer");
}	

function clearform() {
	var custSearch = document.getElementById('custSearch');
	from = undefined;
	to = undefined;
	cusName = undefined;
	selectCust();
	custSearch.reset();
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

////////////////////////////////////////////////////////////////////////////////////////////

function showWindow(no,ty,ri,edit){
  if(document.getElementById("divWin"))
  {
   call("divWin").style.zIndex=999;
   call("divWin").style.display="";
  }
  else
  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="380px";
   objWin.style.height="450px";
   objWin.style.top = "10%";
   objWin.style.left = "20%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_bg"))
  {

   call("win_bg").style.zIndex=998;
   call("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }
  if(ty == "customer") {
 	var table = document.getElementById("custContent");
  	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯客戶資料</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+="<table border='0' id='editTable'><tbody><tr><td>客戶排序</td><td><input type='text' id='editNo' name='editNo' size='10' disabled value='"+no+"'></td></tr>";
 	str+="<tr><td>客戶編號</td><td><input type='text' id='editId' name='editId' size='10' value='"+table.rows[ri].cells[1].innerHTML+"'></td></tr><tr><td>客戶名稱</td><td><input type='text' id='editName' name='editName' value='"+table.rows[ri].cells[2].innerHTML+"'></td></tr><tr><td>地址</td><td><input type='text' id='editAdd' name='editAdd' value='"+table.rows[ri].cells[3].innerHTML+"'></td></tr><tr><td>電話</td><td><input type='text' id='editTel' name='editTel' value='"+table.rows[ri].cells[4].innerHTML+"'></td></tr><tr><td>傳真</td><td><input type='text' id='editFax' name='editFax' value='"+table.rows[ri].cells[5].innerHTML+"'></td></tr><tr><td>電郵</td><td><input type='text'' id='editEmail' name='editEmail' value='"+table.rows[ri].cells[6].innerHTML+"'></td></tr><tr><td>數期</td><td><input type='text' id='editPeriod' name='editPeriod' value='"+table.rows[ri].cells[7].innerHTML+"'></td></tr><tr><td>備注</td><td><textarea id='editRemark' name='editRemark' cols='30' rows='10' value='"+table.rows[ri].cells[8].innerHTML+"'></textarea></td></tr><tr><td><input type='button' id='editSubmit' name='editSubmit' value='更改' onclick='updateCust();closeWindow()'></td></tr></tbody></table>";
  	str+='</div>';
  }
  call("divWin").innerHTML=str;
}
function closeWindow(){
  call("divWin").style.display="none";
  call("win_bg").style.display="none";
}
function call(o){
  return document.getElementById(o);
}
function startMove(o,e){
  var wb;
  if(document.all && e.button==1) wb=true;
  else if(e.button==0) wb=true;
  if(wb)
  {
    var x_pos=parseInt(e.clientX-o.parentNode.offsetLeft);
    var y_pos=parseInt(e.clientY-o.parentNode.offsetTop);
    if(y_pos<=o.offsetHeight)
    {
      document.documentElement.onmousemove=function(mEvent)
      {
        var eEvent=(document.all)?event:mEvent;
        o.parentNode.style.left=eEvent.clientX-x_pos+"px";
        o.parentNode.style.top=eEvent.clientY-y_pos+"px";
      }
    }
  }
}
function stopMove(o,e){
  document.documentElement.onmousemove=null;
}

</script>
</head>

<body onload="selectCust()">
<div id="content">
	<label id = "test"></label>
	<span id="showResult">
	</span>
	<div>
		<form name='custSearch' id='custSearch'>客戶排序    由<input type='text' size='10' id='idfrom' name='idfrom'>&nbsp;至<input type='text' size='10' id='idto' name='idto'>&nbsp;&nbsp;客戶名稱<input type='text' size='30' id='custName' name='custName'>&nbsp;&nbsp;<input type='button' value='尋找' onclick='search()'><input type='button' value='重設' onclick='clearform()'></form>
	</div>
</div>

</body>
</html>
