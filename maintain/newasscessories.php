﻿
<?php require_once('../conn/sqlconnect.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Accessories</title>
<script type = "text/javascript">
var ls = 1;
var pg = 1;
var radioOnclick;
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");

var c1 = false;
var c2 = false;
	function checking(x){
		if(document.getElementById(x).id == "aname"){
			if(document.getElementById(x).value != ""){
				document.getElementById("err").innerHTML = '';
				c1 = true;
			}else{document.getElementById("err").innerHTML = '不可空白';
			c1 = false;}				
		}else if(document.getElementById(x).id == "productid"){
					if(document.getElementById(x).value != ""){
				document.getElementById("err1").innerHTML = '';
				c2 = true;
			}else{document.getElementById("err1").innerHTML = '不可空白';
			c2 = false;	
		}
}
		if(c1 == true){
					if(c2 == true){
						document.getElementById("insert").disabled = false;}
					else{
						document.getElementById("insert").disabled = true;}
			}else{
				document.getElementById("insert").disabled = true;}
	}

	function varreset(){
	c1 = false;
	c4 = false;
	document.getElementById("insert").disabled  = true;
	document.getElementById("err1").innerHTML = '';
	document.getElementById("err").innerHTML = '';
	document.getElementById("aname").value = "";
	document.getElementById("color").value = "";
	document.getElementById("abar").value = "";
	document.getElementById("oprice").value = "";
	document.getElementById("sprice").value = "";
	document.getElementById("manufacturer").value = "";
	document.getElementById("man_commiss").value = "";
	document.getElementById("staff_commiss").value = "";
	document.getElementById("productid").value = "";
	}
	function searchreset(){
		ls = 1;
	}
	function fm2(){
		if (ls > 1 && ls <= tp){
		ls = parseInt(ls) - 1;
		var fm = "fm";
		showHint2(fm);
		
		}
	}
	function bk2(){	
	
		if(ls < tp && ls >= 1){
			ls = parseInt(ls) + 1;
			var bk = "bk";
			showHint2(bk);
		}
	}	
	
	function keypress(e){

		if(e.keyCode ==13){
			if(document.getElementById("topage").value != "" && document.getElementById("topage").value >= 1 && document.getElementById("topage").value <= tp){
				ls = document.getElementById("topage").value;
				showHint2("select");

			}
		}
	}
	
function showHint2(x){

var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  	
  if (xmlhttp.readyState==4)	// && xmlhttp.status==200
    {

    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;

    }
  }
  if(x == "select" || x == "fm" || x == "bk"){
xmlhttp.open("GET","../maintain/get_asscessories_info.php?q="+document.getElementById("sname").value
				+"&id1="+document.getElementById("id").value
				+"&id2="+document.getElementById("id2").value
				+"&st="+document.getElementById("satype").value
				+"&ls="+ls
				+"&stype="+document.getElementById("stype").value
				+"&act=select"
				,true);

}else if(x == "update"){
var test1 = document.getElementById("mod_man_commiss").value;
	var test2 = document.getElementById("mod_staff_commiss").value;
	if (test1.length == 0)
		test1=0;
	if (test2.length == 0)
		test2=0;
	xmlhttp.open("GET","../maintain/get_asscessories_info.php?id="+document.getElementById("eid").value
	+"&n="+document.getElementById("ename").value+"&ma="+document.getElementById("ema").value
	+"&c="+document.getElementById("ecolor").value+"&bar="+document.getElementById("ebar").value
	+"&op="+document.getElementById("eoprice").value+"&sp="+document.getElementById("esprice").value
	+"&no="+document.getElementById("eno").value
	+"&sta="+document.getElementById("estype").value+"&type="+document.getElementById("etype").value
	+"&id1="+document.getElementById("id").value+"&id2="+document.getElementById("id2").value
	+"&q="+document.getElementById("aname").value+"&st="+document.getElementById("satype").value
	+"&stype="+document.getElementById("stype").value
	+"&ls="+ls
	+"&mod_man_commiss="+test1
	+"&mod_staff_commiss="+test2
	+"&act=update",true);	

}else if(x == "insert"){
	var test1 = document.getElementById("man_commiss").value;
	var test2 = document.getElementById("staff_commiss").value;
	if (test1.length == 0)
		test1=0;
	if (test2.length == 0)
		test2=0;
	xmlhttp.open("GET","../maintain/get_asscessories_info.php?iid="+document.getElementById("productid").value
	+"&ima="+document.getElementById("manufacturer").value
	+"&ic="+document.getElementById("color").value
	+"&in="+document.getElementById("aname").value
	+"&iop="+document.getElementById("oprice").value
	+"&isp="+document.getElementById("sprice").value
	+"&ist="+document.getElementById("istate").value	
	+"&ibar="+document.getElementById("abar").value
	+"&itype="+document.getElementById("atype").value
	+"&ls="+ls
	+"&q="+document.getElementById("sname").value
	+"&id1="+document.getElementById("id").value
	+"&id2="+document.getElementById("id2").value
	+"&st="+document.getElementById("satype").value
	+"&stype="+document.getElementById("stype").value
	+"&man_commiss="+test1
	+"&staff_commiss="+test2
	+"&act=insert"	
	,true);	

}
xmlhttp.send();

}
/*
function update(){
var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
    }
  }
	xmlhttp.open("GET","get_asscessories_info.php?id="+document.getElementById("eid").value
	+"&n="+document.getElementById("ename").value+"&ma="+document.getElementById("ema").value
	+"&c="+document.getElementById("ecolor").value+"&bar="+document.getElementById("ebar").value
	+"&op="+document.getElementById("eoprice").value+"&sp="+document.getElementById("esprice").value
	+"&no="+document.getElementById("eno").value
	+"&sta="+document.getElementById("estype").value+"&type="+document.getElementById("etype").value
	+"&id1="+document.getElementById("id").value+"&id2="+document.getElementById("id2").value
	+"&q="+document.getElementById("aname").value+"&st="+document.getElementById("satype").value
	+"&ls="+ls
	+"&act=update",true);
	xmlhttp.send();
}*/
</script>
<script type="text/javascript">
///////////////////////////////////////////////////////////////////////
function showWindow_ass(rp,rid,rname,rma,rcolor,rop,rsp,rno,rba,rls,rst,mod_man_commiss,mod_staff_commiss){

var xmlhttp3;    
if (window.XMLHttpRequest)
  {
  xmlhttp3=new XMLHttpRequest();
  }
else
  {
  xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp3.onreadystatechange=function()
  {
  if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
    {
    document.getElementById("txtHint3").innerHTML=xmlhttp3.responseText;
    }
  }
xmlhttp3.open("GET","../maintain/get_type_info.php?q="+rp,true);
xmlhttp3.send();
var xmlhttp2;    
if (window.XMLHttpRequest)
  {
  xmlhttp2=new XMLHttpRequest();
  }
else
  {
  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp2.onreadystatechange=function()
  {
  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    {
    document.getElementById("txtHint4").innerHTML=xmlhttp2.responseText;
    }
  }
xmlhttp2.open("GET","../maintain/get_state_info.php?qt="+rst,true);
xmlhttp2.send();

  /*
  
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="Close">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">'
  +'<table border="1"><tbody>'
  +'<tr><td>ID</td><td><input type = "text" readonly = "readonly" id = "eno" value = "'+rno+'" size = "30"></td></tr>'
  +'<tr><td>編號:</td><td><input type = "text" id ="eid" value = "'+rid+'" size = "30"/></td></tr>'
  +'<tr><td>種類:</td><td><span id = "txtHint3"></span></td></tr>'
  +'<tr><td>牌子:</td><td><input type = "text" id = "ema" value = "'+rma+'" size = "30"></td></tr>'
  +'<tr><td>名稱:</td><td><input type = "text" id = "ename" value = "'+rname+'" size = "30"/></td></tr>'
  +'<tr><td>顏色:</td><td><input type = "text" id = "ecolor" value = "'+rcolor+'" size = "30"/></td></tr>'
  +'<tr><td>原價:</td><td><input type = "text" id = "eoprice" value = "'+rop+'" size = "30"/></td></tr>'
  +'<tr><td>特價:</td><td><input type = "text" id = "esprice" value = "'+rsp+'" size = "30"/></td></tr>'
  +'<tr><td>最近來貨價</td><td><input type = "text" readonly = "readonly" value = "'+rls+'" size = "30"></td></tr>'
  +'<tr><td>條碼</td><td><input type = "text" id = "ebar" value = "'+rba+'" size = "30"></td></tr>'
  +'<tr><td>狀況</td><td><span id = "txtHint4"></span></td></tr>'
  +'<tr><td colspan = "2" align = "right"><input type = "button" value = "修改" id = "update" onclick = "showHint2(this.id);closeWindow()"/></td></table></div>';
  #("divWin").innerHTML=str;
  */

 
 
 if(document.getElementById("divWin"))
  {
   cal("divWin").style.zIndex=999;
   cal("divWin").style.display="";
  }
  else
  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="520px";
   objWin.style.height="600px";
   objWin.style.top = "5%";
   objWin.style.left = "5%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_bg"))
  {
   cal("win_bg").style.zIndex=998;
   cal("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }

  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">CLOSE</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">'
  +'<table border="1"><tbody>'
  //+'<tr><td>ID</td><td>'
  +'<input type = "hidden" readonly = "readonly" id = "eno" value = "'+rno+'" size = "30">'
  //+'</td></tr>'
  +'<tr><td>編號:</td><td><input type = "text" id ="eid" value = "'+rid+'" size = "30"/></td></tr>'
  +'<tr><td>種類:</td><td><span id = "txtHint3"></span></td></tr>'
  +'<tr><td>牌子:</td><td><input type = "text" id = "ema" value = "'+rma+'" size = "30"></td></tr>'
  +'<tr><td>名稱:</td><td><input type = "text" id = "ename" value = "'+rname+'" size = "30"/></td></tr>'
  +'<tr><td>顏色:</td><td><input type = "text" id = "ecolor" value = "'+rcolor+'" size = "30"/></td></tr>'
  +'<tr><td>原價:</td><td><input type = "text" id = "eoprice" value = "'+rop+'" size = "30"/></td></tr>'
  +'<tr><td>特價:</td><td><input type = "text" id = "esprice" value = "'+rsp+'" size = "30"/></td></tr>'
  //+'<tr><td>最近來貨價</td><td><input type = "text" readonly = "readonly" value = "'+rls+'" size = "30"></td></tr>'
  +'<tr><td>條碼</td><td><input type = "text" id = "ebar" value = "'+rba+'" size = "30"></td></tr>'
  +'<tr><td>狀況</td><td><span id = "txtHint4"></span></td></tr>'
  +'<tr><td>店長佣金:</td><td><input type = "text" id = "mod_man_commiss" value = "'+mod_man_commiss+'" tabindex="7"/></td></tr>'
  +'<tr><td>店員佣金:</td><td><input type = "text" id = "mod_staff_commiss" value = "'+mod_staff_commiss+'" tabindex="7"/></td></tr>'
  +'<tr><td colspan = "2" align = "right"><input type = "button" value = "修改" id = "update" onclick = "showHint2(this.id);closeWindow()"/></td></table></div>';
  cal("divWin").innerHTML=str;
}
function closeWindow(){
  cal("divWin").style.display="none";
  cal("win_bg").style.display="none";
}
function cal(o){
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

<body>
<h1 align="center">配件貨物紀錄</h1>
<form method = "post" action = "newasscessories.php">
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增資料</div>
  <div class="CollapsiblePanelContent">
<table width = "100%">
	<tr>	
		<td>
		種類:	
		</td>
		<td>
<?php
	echo "<select name = 'atype' id = 'atype'>";
	mysql_select_db($database_conn, $conn);
	//$sql = "SELECT name FORM asscessoriestype";
	$sql = "SELECT accType_no,typeName FROM acctype";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	do{
	echo "<option value = '".$row['accType_no']."'> ".$row['typeName']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
		</td>
	</tr>
	<tt>
		<td>編號:</td>
		<td><input type="text" name = "productid" id = "productid" size = "30" tabindex="1" onchange = "checking(this.id)"/>
		<label style = "color:red">*</label>
		<label id = "err1" style = "color:red"></label>
		</td>
		<td>原價:</td>
		<td><input type = "text" id = "oprice"/ tabindex="6"></td>		
	</tr>	
	<tr>
		<td>牌子:</td>
		<td><input type = "text" id = "manufacturer" size = "30" tabindex="2"/></td>
		<td>特價:</td>
		<td><input type = "text" id = "sprice" tabindex="7"/></td>
	</tr>
	<tr>
		<td>名稱: </td>
		<td><input type = "text" id = "aname" onchange = "checking(this.id)"  size = "30" tabindex="3"/>
        <label style = "color:red">*</label>
        <label id = "err" style = "color:red"></label>
		</td>
		<td>狀況:</td>
		<td>
<?php
	echo "<select name = 'istate' id = 'istate'>";
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT productState_no,stateName FROM productstate";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	do{
	if($totalrow == 0) break;
	echo "<option value = '".$row['productState_no']."'> ".$row['stateName']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
		</td>
	</tr>
	<tr>
		<td>
		顏色:
		</td>
		<td>
		<input type = "text"  size = "30" onchange ="checking(this.id)" id  = "color" tabindex="4"/>
		</td>
		<td>店長佣金:</td>
		<td><input type = "text" id = "man_commiss" tabindex="7"/></td>

	</tr>
	<tr>
		<td>
		條碼: 
		</td>
		<td>
		<input type ="text" onchange = "checking(this.id)" id = "abar"  size = "30" tabindex="5"/>
		</td>
		<td>店員佣金:</td>
		<td><input type = "text" id = "staff_commiss" tabindex="7"/></td>

	</tr>
	<tr>
		<td>
		<p><input type = "button" disabled = "true" value = "新增" id = "insert" onclick="showHint2(this.id);varreset()"/>
		<input type = "reset" value = "取消" onclick = "varreset()"></p>	
		</td>
	</tr>
</table>
</div>
</div>
</form>

<script src="SpryCollapsiblePanel.js" type = "text/javascript">
</script>
<br>

修改資料
<form>
<br>種類:<?php
	echo "<select name = 'stype' id = 'stype'>";
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT accType_no,typeName FROM acctype";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	echo "<option value = 'all'>全部</option>";
	do{
	echo "<option value = '".$row['accType_no']."'> ".$row['typeName']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
<br>名稱:<input type = "text" id = "sname"/>
<br>編號:<input type = "text" id  = "id"/>~<input type = "text" id = "id2"/>
<br>狀況:<?php
	echo "<select name = 'satype' id = 'satype'>";
	echo "<option value = 'all'>全部</option>";
	mysql_select_db($database_conn, $conn);
	$sql = "SELECT productState_no,stateName FROM productstate";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	do{
	if($totalrow == 0) break;
	echo "<option value = '".$row['productState_no']."'> ".$row['stateName']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
<br><input type = "button" value = "搜索" id = "select" onclick = "showHint2(this.id);searchreset();"/><input type = "reset" value = "重設"/>
</form>

<span id = "txtHint">
	<?php include("get_asscessories_info.php");?></span>
<script type = "text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>
