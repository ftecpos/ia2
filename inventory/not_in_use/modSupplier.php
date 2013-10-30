<?php 
  require_once('../conn/sqlconnect.php');
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modify Supplier</title>
<script type="text/javascript">
  var cWN=/^[A-z0-9]*/;
  var cTF=/^[0-9]*/;
  var cMail =/^[a-z][a-z0-9_\.]*[a-z0-9]@[a-z][a-z\.]*[a-z]/;
  
  var sno_list = new Array();
  var sid_list = new Array();
  //sid_list[0]="";
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
  
  function check_s(sno){
  	//alert("check_s : open");
	var sid = document.getElementById("modsId"+sno).value;
	var tel = document.getElementById("modsTel"+sno).value;
	var fax = document.getElementById("modsFax"+sno).value;
	var mail = document.getElementById("modsMail"+sno).value;
	if(sid=="" || document.getElementById("modsName"+sno).value=="" || document.getElementById("modsAddr"+sno).value=="" || tel=="" || mail==""){
  	  //alert("check_s : no id");
	  document.getElementById("error"+sno).value="<--請輸入資料";
	  document.getElementById(sno).disabled=true;
	  return;
	}
	if(sid==sid.match(cWN)){
	  var id_num = 0;
      do{
	    //alert(sid+" "+sid_list[id_num]+" "+sno_list[id_num]+" "+sno);
		if(sid==sid_list[id_num] && sno_list[id_num]!=sno){
		  document.getElementById("error"+sno).value="<--ID不能重複使用";
		  document.getElementById(sno).disabled=true;
		  return;
		}
        id_num++;
	  }while(id_num<sid_list.length);
	  if(tel!=tel.match(cTF)){
	    document.getElementById("error"+sno).value="<--電話只能輸入數字";
		document.getElementById(sno).disabled=true;
		return;
	  }  else{
	    if(fax!=fax.match(cTF)){
	      document.getElementById("error"+sno).value="<--傳真只能輸入數字";
		  document.getElementById(sno).disabled=true;
		  return;
	    }
	    else{
		  if(mail!=mail.match(cMail)){
	        document.getElementById("error"+sno).value="<--請輸入正確電郵";
		    document.getElementById(sno).disabled=true;
		    return;
	      } else{
	        document.getElementById("error"+sno).value="";
		    document.getElementById(sno).disabled=false;
			return;
	      }
		}
	  }
	}
	else{
	  document.getElementById("error"+sno).value="<--不能使用符號";
	  document.getElementById(sno).disabled=true;
	}
  }
  
  var cWN=/^[A-z0-9]*/;
  var cTF=/^[0-9]*/;
  var cMail =/^[a-z][a-z0-9_\.]*[a-z0-9]@[a-z][a-z\.]*[a-z]/;
  var id_c = false;
  var name_c = false;
  var addr_c = false;
  var tel_c = false;
  var fax_c = false;
  var mail_c = false;
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
	if(sid==""){
	  document.getElementById("sIdm").value="*<--請輸入資料";
	  id_c=false;
	  return;
	}
	if(sid==sid.match(cWN)){
	  var id_num = 0;
      do{
		if(sid==sid_list[id_num]){
		  document.getElementById("sIdm").value="*<--ID不能重複使用";
		  id_c=false;
		  return;
		}
        id_num=id_num+1;
	  }while(id_num<sid_list.length);
      document.getElementById("sIdm").value="*";
	  id_c=true;
	  checks();
	  return;
	}
	else{
	  document.getElementById("sIdm").value="*<--不能使用符號";
	  id_c=false;
	}
  }
  
  function check_n(){
	if(document.getElementById("sName").value==""){
	  document.getElementById("sNamem").value="*<--請輸入資料";
	  name_c=false;
	  return;
	}
	else{
	  document.getElementById("sNamem").value="*";
	  name_c=true;
	  checks();
	}
  }
  
  function check_a(){
	if(document.getElementById("sAddr").value==""){
	  document.getElementById("sAddrm").value="*<--請輸入資料";
	  addr_c=false;
	  return;
	}
	else{
	  document.getElementById("sAddrm").value="*";
	  addr_c=true;
	  checks();
	}
  }
  
  function check_t(){
    var tel = document.getElementById("sTel").value;
	if(tel==""){
	  document.getElementById("sTelm").value="*<--請輸入資料";
	  tel_c=false;
	  return;
	}
	else{
	  if(tel!=tel.match(cTF)){
	    document.getElementById("sTelm").value="*<--只能輸入數字";
		tel_c=false;
		return;
	  }
	  else{
	    document.getElementById("sTelm").value="*";
		tel_c=true;
		checks();
	  }
    }
  }
  
  function check_f(){
    var fax = document.getElementById("sFax").value;
	if(fax!=fax.match(cTF)){
	  document.getElementById("sFaxm").value="<--只能輸入數字";
	  fax_c=false;
	  return;
	} else{
	  document.getElementById("sFaxm").value="";
	  fax_c=true;
	  checks();	  
	}
  }
  
   function check_m(){
    var mail = document.getElementById("sEM").value;
	if(mail==""){
	  document.getElementById("sEMm").value="*<--請輸入資料";
	  mail_c=false;
	  return;
	}
	else{
	  if(mail!=mail.match(cMail)){
	    document.getElementById("sEMm").value="*<--請輸入正確電郵";
		mail_c=false;
		return;
	  }
	  else{
	    document.getElementById("sEMm").value="*";
		mail_c=true;
		checks();
	  }
	}
  }
  
  function checks(){	
	if(id_c && name_c && addr_c && tel_c && fax_c && mail_c){
	  document.getElementById("inPut").disabled=false;
	  return;
	}
	else{
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
  	var outtest11 = "newSupplier.php?"
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
	xmlhttp11.open("GET","submit_supplier.php",false);
	xmlhttp11.send();
	document.getElementById("submit_supplier").innerHTML=xmlhttp11.responseText;
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
  	var outtest12 = "submit_supplier.php?"
  				+"x=1"
  				+"&a="+document.getElementById("key").value
  				+"&b="+document.getElementById("keytype").value;
	//alert("search_suppli : out text\n"+outtest12);
	xmlhttp12.open("GET",outtest12,false);
	xmlhttp12.send();
	//alert("search_suppli : sent");
	document.getElementById("submit_supplier").innerHTML=xmlhttp12.responseText;
}
function mod_suppli(sno2){
	alert("mod_suppli : open");
	var xmlhttp13;
	if (window.XMLHttpRequest)
	{	alert("mod_suppli : true");
		xmlhttp13=new XMLHttpRequest();  }
	else
	{	alert("mod_suppli : false");
		xmlhttp13=new ActiveXObject("Microsoft.XMLHTTP");  }
	alert("mod_suppli : gen string");
  	var outtest13 = "submit_supplier.php?"
  				+"x=2"
  				+"&a="+document.getElementById("modsNo"+sno2).value
  				+"&b="+document.getElementById("modsId"+sno2).value
  				+"&c="+document.getElementById("modsName"+sno2).value
  				+"&d="+document.getElementById("modsAddr"+sno2).value
  				+"&e="+document.getElementById("modsTel"+sno2).value
  				+"&f="+document.getElementById("modsFax"+sno2).value
  				+"&g="+document.getElementById("modsMail"+sno2).value
  				+"&h="+document.getElementById("modsR"+sno2).value
  				+"&i="+document.getElementById("hider"+sno2).checked;
	alert("mod_suppli : out text\n"+outtest13);
	xmlhttp13.open("GET",outtest13,false);
	xmlhttp13.send();
	alert("mod_suppli : sent");
	document.getElementById("submit_supplier").innerHTML=xmlhttp13.responseText;
}
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
請輸入關鍵字:
<form method="post">
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