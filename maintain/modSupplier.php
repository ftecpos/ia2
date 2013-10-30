<?php 
  require_once('../conn/sqlconnect.php');
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modify Supplier</title>
<script type="text/javascript">
  //alert("location 1");
  var cWN=/^[A-z0-9]*/;
  var cTF=/^[0-9]*/;
  var cMail =/^[a-z][a-z0-9_\.\-]*@[A-Za-z][A-Za-z\.]*[A-Za-z]/;
  
  //alert("location 2");
  var sno_list = new Array();
  var sid_list = new Array();
  //sid_list[0]="";
  //alert("location 3");
  <?php
  //Open table "supplier"
  $select_suppli = "SELECT * FROM supplier";
  $suppli = mysql_query($select_suppli, $conn) or die(mysql_error());
  $suppli_data = mysql_fetch_assoc($suppli);
  
  $loop = 0;
  do{
	print("
  sno_list[".$loop."]=\"".$suppli_data['supplier_no']."\";
  sid_list[".$loop."]=\"".$suppli_data['supplier_id']."\";");
  $loop++;
  }while($suppli_data = mysql_fetch_assoc($suppli));
  ?>
  //alert("location 4");
  //check the modifying supplier data
  function check_s(sno){
  	//alert("check_s : open");
	var sid = document.getElementById("modsId").value;
	var tel = document.getElementById("modsTel").value;
	var fax = document.getElementById("modsFax").value;
	var stop = false;
	
	if(document.getElementById("modsName").value==""){
		document.getElementById("modsName").value="請輸入資料";
		document.getElementById("modsName").select();
		stop = true;
	}
	
	if(sid=="" || sid.length<3){
		//alert("check_s : no id");/////////////////////////////////////////////////////////////////////////////
		document.getElementById("modsId").value="請輸入資料";
		document.getElementById("modsId").select();
		stop = true;
	}	else	{
		if(sid!=sid.match(cWN)){
		document.getElementById("modsId").value="不能使用符號";
		document.getElementById("modsId").select();
		stop = true;
		}	else	{
			for( var id_num=0;id_num<sid_list.length;id_num++){
	    		//alert(sid+" "+sid_list[id_num]+" "+sno_list[id_num]+" "+sno);/////////////////////////////////
				if(sid==sid_list[id_num] && sno_list[id_num]!=sno){
					document.getElementById("modsId").value="ID不能重複使用";
					document.getElementById("modsId").select();
					stop = true;
					break;
				}
			}
        }
	}
	return stop;
}
	
  var cWN=/^[A-z0-9]*/;
  var cTF=/^[0-9]*/;
  var id_c = false;
  var name_c = false;
  var sid_list = new Array();
  <?php
  //Open table "supplier"
  $select_suppli = "SELECT * FROM supplier";
  $suppli = mysql_query($select_suppli, $conn) or die(mysql_error());
  $suppli_data = mysql_fetch_assoc($suppli);
  $nums = 0;
  
  do{
	print("sid_list[".$nums."]=\"".$suppli_data['supplier_id']."\";");
	$nums=$nums+1;
  }while($suppli_data = mysql_fetch_assoc($suppli));
  ?>
  
  function check_i(){
    var sid = document.getElementById("sID").value;
	if(sid=="" || sid.length<3){
	  document.getElementById("sIdm").value="*<--請輸入資料";
	  id_c=false;
	  checks();
	  return;
	}
	if(sid==sid.match(cWN)){
	  var id_num = 0;
      do{
		if(sid==sid_list[id_num]){
		  document.getElementById("sIdm").value="*<--ID不能重複使用";
		  id_c=false;
	  	  checks();
		  return;
		}
        id_num=id_num+1;
	  }while(id_num<sid_list.length);
      document.getElementById("sIdm").value="*";
	  id_c=true;
	  //alert("check_1 pass, start checks");	////////////////////////////////////////////////////////////////////////
	  checks();
	  return;
	}
	else{
	  document.getElementById("sIdm").value="*<--不能使用符號";
	  id_c=false;
	  checks();
	}
  }
  
  function check_n(){
	if(document.getElementById("sName").value==""){
	  document.getElementById("sNamem").value="*<--請輸入資料";
	  name_c=false;
	  checks();
	  return;
	}
	else{
	  document.getElementById("sNamem").value="*";
	  name_c=true;
	  //alert("check_n pass, start checks");	////////////////////////////////////////////////////////////////////////
	  checks();
	}
  }
  

  function checks(){
  	//alert("checks : "+id_c+","+name_c+","+addr_c+","+tel_c+","+fax_c+","+mail_c);///////////////////////////////////////
	if(id_c && name_c){
	  document.getElementById("inPut").disabled=false;
	  return;
	}else{
	  document.getElementById("inPut").disabled=true;
	}
  }
  
function submit_new_suppli(){
	//alert("submit_new_suppli : open");
	var xmlhttp11;
	if (window.XMLHttpRequest)
	{	//alert("submit_new_suppli : true");
		xmlhttp11=new XMLHttpRequest();  }
	else
	{	//alert("submit_new_suppli : false");
		xmlhttp11=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("submit_new_suppli : gen string");
  	var outtest11 = "../maintain/newSupplier.php?"
  				+"a="+document.getElementById("sID").value
  				+"&b="+document.getElementById("sName").value
  				+"&c="+document.getElementById("sAddr").value
  				+"&d="+document.getElementById("sTel").value
  				+"&e="+document.getElementById("sFax").value
  				+"&f="+document.getElementById("sEM").value
  				+"&g="+document.getElementById("sRem").value;
	//alert("submit_new_suppli : out text\n"+outtest3);
	xmlhttp11.open("GET",outtest11,false);
	xmlhttp11.send();
	document.getElementById("new_suppli").innerHTML=xmlhttp11.responseText;
	xmlhttp11.open("GET","../maintain/submit_supplier.php",false);
	xmlhttp11.send();
	document.getElementById("submit_supplier").innerHTML=xmlhttp11.responseText;
	document.getElementById("uploadM").innerHTML='<font color="green" size = "3">資料已輸入</font>';
	//alert("submit_new_suppli : sent");
	//document.getElementById("submit_mod2").innerHTML=xmlhttp11.responseText;
}
function search_suppli(){
	//alert("search_suppli : open");
	var xmlhttp12;
	if (window.XMLHttpRequest)
	{	//alert("search_suppli : true");
		xmlhttp12=new XMLHttpRequest();  }
	else
	{	//alert("search_suppli : false");
		xmlhttp12=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("search_suppli : gen string");
  	var outtest12 = "../maintain/submit_supplier.php?"
  				+"x=1"
  				+"&a="+document.getElementById("key").value
  				+"&b="+document.getElementById("keytype").value;
	//alert("search_suppli : out text\n"+outtest12);
	xmlhttp12.open("GET",outtest12,false);
	xmlhttp12.send();
	//alert("search_suppli : sent");
	document.getElementById("submit_supplier").innerHTML=xmlhttp12.responseText;
}
function mod_suppli(){
	if(check_s(document.getElementById("modsNo").value)){return;}
	//alert("mod_suppli : open");
	var xmlhttp13;
	if (window.XMLHttpRequest)
	{	//alert("mod_suppli : true");
		xmlhttp13=new XMLHttpRequest();  }
	else
	{	//alert("mod_suppli : false");
		xmlhttp13=new ActiveXObject("Microsoft.XMLHTTP");  }
	//alert("mod_suppli : gen string");
  	var outtest13 = "../maintain/submit_supplier.php?"
  				+"x=2"
  				+"&a="+document.getElementById("modsNo").value
  				+"&b="+document.getElementById("modsId").value
  				+"&c="+document.getElementById("modsName").value
  				+"&d="+document.getElementById("modsAddr").value
  				+"&e="+document.getElementById("modsTel").value
  				+"&f="+document.getElementById("modsFax").value
  				+"&g="+document.getElementById("modsMail").value
  				+"&h="+document.getElementById("modsR").value
  				+"&i="+document.getElementById("hider").checked;
	//alert("mod_suppli : out text\n"+outtest13);
	xmlhttp13.open("GET",outtest13,false);
	xmlhttp13.send();
	//alert("mod_suppli : sent");
	document.getElementById("submit_supplier").innerHTML=xmlhttp13.responseText;
	closeSuppWin();
}
</script>
<script type="text/javascript">
///////////////////////////////////////////////////////////////////////
function delrecord(getSupNo){
	var xmlhttp14;
	if (window.XMLHttpRequest)
	{	//alert("search_suppli : true");
		xmlhttp14=new XMLHttpRequest();  }
	else
	{	//alert("search_suppli : false");
		xmlhttp14=new ActiveXObject("Microsoft.XMLHTTP");  }
	
	if(confirm("是否要刪除 ID : "+getSupNo)){
	var url = "../maintain/submit_supplier.php?getid=" + getSupNo +"&type=delete"+"&x=2"
  		
 
		
    xmlhttp14.open("GET",url,true);
    xmlhttp14.send();
	document.getElementById("submit_supplier").innerHTML=xmlhttp14.responseText;
		}
	}
	

function getSuppInfo(getSupNo) {
//alert(number);
	var getSupId = document.getElementById("supid"+getSupNo).value;
	var getSupNa = document.getElementById("supna"+getSupNo).value;
	var getSupAd = document.getElementById("supad"+getSupNo).value;
	var getSupTe = document.getElementById("supte"+getSupNo).value;
	var getSupFa = document.getElementById("supfa"+getSupNo).value;
	var getSupEm = document.getElementById("supem"+getSupNo).value;
	var getSupRm = document.getElementById("suprm"+getSupNo).value;
	var getSupHi = document.getElementById("suphi"+getSupNo).value;
	//alert(getSupNo+","+getSupId+","+getSupNa+","+getSupAd+","+getSupTe+","+getSupFa+","+getSupEm+","+getSupRm+","+getSupHi);
	showSuppWindow(getSupNo,getSupId,getSupNa,getSupAd,getSupTe,getSupFa,getSupEm,getSupRm,getSupHi);
}
function showSuppWindow(supNo,supId,supNa,supAd,supTe,supFa,supEm,supRm,supHi){
  if(document.getElementById("divSuppWin"))
  {
   con("divSuppWin").style.zIndex=999;
   con("divSuppWin").style.display="";
  }  else  {
   var objWin=document.createElement("div");
   objWin.id="divSuppWin";
   objWin.style.position="absolute";
   objWin.style.width="520px";
   objWin.style.height="400px";
   objWin.style.top = "40%";
   objWin.style.left = "10%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_Suppbg"))
  {
   con("win_Suppbg").style.zIndex=998;
   con("win_Suppbg").style.display="";
  }  else  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_Suppbg";
   obj_bg.className="win_Suppbg";
   document.body.appendChild(obj_bg);
  }

  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)">'
  +'<span class="title_left">Edit Suppliers</span>'
  +'<span class="title_right"><a href="javascript:closeSuppWin()" title="Close" id="closer">取消</a></span>'
  +'<br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">'
  +'<form id="inputSuppForm" onsubmit="return false">'
  +'<table border="0" id="supp_info" height="270px" width="510px">'
  +'<tr><td>No.</td>'
  +'<td><input type="text" readonly="yes" name="modsNo" id="modsNo" value="'+supNo+'"/></td>'
  +'<td align="right" colspan="2">隠藏<input type="checkbox" id="hider" '+supHi+'/></td></tr>'
  +'<tr><td>ID</td>'
  +'<td colspan="3"><input type="text" name="modsId" id="modsId" maxlength="10" value="'+supId+'"/></td></tr>'
  +'<tr><td>名稱</td>'
  +'<td colspan="3"><input type="text" name="modsName" id="modsName" maxlength="100" value="'+supNa+'"/></td></tr>'
  +'<tr><td>地址</td>'
  +'<td colspan="3"><input type="text" size="60" name="modsAddr" id="modsAddr" maxlength="255" value="'+supAd+'"/></td></tr>'
  +'<tr><td>電話</td>'
  +'<td><input type="text" name="modsTel" id="modsTel" maxlength="15" value="'+supTe+'"/></td>'
  +'<td>傳真</td>'
  +'<td><input type="text" name="modsFax" id="modsFax" maxlength="15" value="'+supFa+'"/></td></tr>'
  +'<tr><td>電郵</td>'
  +'<td colspan="3"><input type="text" size="60" name="modsMail" id="modsMail" maxlength="100" value="'+supEm+'"/></td></tr>'
  +'<tr><td>數期</td>'
  +'<td colspan="3"><input type="text" size="60" name="modsR" id="modsR" maxlength="20" value="'+supRm+'"/></td></tr>'
  +'<tr><td align="right" colspan = "4">'
  +'<input type="submit" value="確定" onclick="mod_suppli()"/>'
  +'<input type="reset" value="重設"/>'
  +'</td></tr></table></form></div>';
  con("divSuppWin").innerHTML=str;
  //document.getElementById("cancel").disabled=true;
}
function closeSuppWin(){
  con("divSuppWin").style.display="none";
  con("win_Suppbg").style.display="none";
}

function con(o){  return document.getElementById(o);	}

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
///////////////////////////////////////////////////////////////////////
</script>
</head>
<body>
<h1 align="center">供應商資料</h1>
</br>
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增資料</div>
  <div class="CollapsiblePanelContent">
  	<span id = "new_suppli">
	<?php require_once('newSupplier.php'); ?>
  	</span>
</div>
</div>
<font color="blue">
請輸入關鍵字:
</font>
<form method="post" onSubmit="return false;">
<input type="text" name="key" id="key">
<select name="keytype" id="keytype">
<option value="supplier_no" selected>No.</option>
<option value="supplier_id">ID</option>
<option value="supplierName">名稱</option>
<option value="phone">電話號碼</option>
<option value="fax">傳真號碼</option>
<option value="hide">已隱藏資料</option>
</select>
<input type="button" name="searcher" onClick="search_suppli()" value="搜尋">
</form>
<span id="submit_supplier">
	<?php require_once("submit_supplier.php");?>
</span>
  <script src="SpryCollapsiblePanel.js" type = "text/javascript"></script>
  <script type="text/javascript">
  var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</table>
</body>
</html>