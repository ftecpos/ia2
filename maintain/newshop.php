<?php require_once('../conn/sqlconnect.php'); ?>
<?php
/*
if(!empty($_POST) && isset($_POST)){
	mysql_select_db($database_conn, $conn);
	
	$SQL = "SELECT IFNULL(MAX(retailShop_no),0)+1 as retailShop_no FROM retailshop";  
    $rs = mysql_query($SQL, $conn) or die(mysql_error());
    $row = mysql_fetch_assoc($rs);
    $next = $row['retailShop_no'];
	
    $SQL = "INSERT INTO retailshop (retailShop_no,retail_id,addr,phone,fax,email,location)VALUES
    (".$next.",'".$_POST['shopid']."','".$_POST['shopaddr']."',".$_POST['shoptele'].",".$_POST['shopfax'].",'".$_POST['email']."','" .$_POST['location']."')";
	@mysql_query($SQL, $conn) or die(mysql_error());
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新增店舖
</title>
<script type="text/javascript">

///////////////////////////////////////////////////////////////////////

function showWindow_shop(rid,raddr,rphone,rfax,rlocation,remail,rno){
  if(document.getElementById("divWin"))
  {
   cal3("divWin").style.zIndex=999;
   cal3("divWin").style.display="";
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
   cal3("win_bg").style.zIndex=998;
   cal3("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }

  var strs="";
  strs+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="Close">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  strs+='<div class="winContent"><table border="1"><tbody><tr><td>ID</td><td><input type = "text" readonly = "readonly" id = "eno" value = "'+rno+'"></td></tr><tr><td>編號:</td><td><input type = "text" id ="eid" value = "'+rid+'"/></td></tr><tr><td>地區:</td><td><input type = "text" id = "elocation" value = "'+rlocation+'"/></td></tr><tr><td>地址:</td><td><input type = "text" id = "eaddr" value = "'+raddr+'"size="50"></td></tr><tr><td>電話:</td><td><input type = "text" id = "ephone" maxlength = "8" value = "'+rphone+'"/></td></tr><tr><td>傳真:</td><td><input type = "text" id = "efax" maxlength = "8" value = "'+rfax+'"/></td></tr><tr><td>電郵:</td><td><input type = "text" id = "eemail" value = "'+remail+'"/></td></tr><tr><td colspan = "2" align = "right"><input type = "button" value = "修改" id = "update" onclick = "showHint_shop(this.id);closeWindow()"/></td></tr></table></div>';
 
  cal3("divWin").innerHTML=strs;
}
function closeWindow(){
  cal3("divWin").style.display="none";
  cal3("win_bg").style.display="none";
}
function cal3(o){
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



///////////////////////////////////////////////////////////////////////
</script>
<script type = "text/javascript">
var ls = 1;
	function searchreset(){
		ls = 1;
	}
	function fm3(){
		
		if (ls > 1 && ls <= tp){
		ls = parseInt(ls) - 1;
		var fm = "fm";
		showHint_shop(fm);
		
		}
	}
	function bk3(){	
		
		if(ls < tp && ls >= 1){
			ls = parseInt(ls) + 1;
			var bk = "bk";
			showHint_shop(bk);
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
function showHint_shop(x){
	
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
    document.getElementById("txtShop").innerHTML=xmlhttp.responseText;
    }
  }
  
  if(x == 'update'){
  	xmlhttp.open("GET","../maintain/get_shop_info.php?id="+document.getElementById("eid").value
	+"&a="+document.getElementById("eaddr").value+"&p="+document.getElementById("ephone").value
	+"&l="+document.getElementById("elocation").value+"&f="+document.getElementById("efax").value
	+"&e="+document.getElementById("eemail").value+"&no="+document.getElementById("eno").value+"&ls="+ls
	+"&act=update",true);alert("u");
	}else if(x == 'insert'){
	xmlhttp.open("GET","../maintain/get_shop_info.php?shopid="+document.getElementById("shopid").value
	+"&shopaddr="+document.getElementById("shopaddr").value+"&shoptele="+document.getElementById("shoptele").value
	+"&shopfax="+document.getElementById("shopfax").value+"&email="+document.getElementById("email").value
	+"&location="+document.getElementById("location").value+"&ls="+ls
	+"&act=insert",true);alert("i");	
	}else if(x == 'bk' || x == 'fm'){
	xmlhttp.open("GET","../maintain/get_shop_info.php?ls="+ls
				+"&act=select"
				,true);	
				
	}
	xmlhttp.send();
}
/*
function checkid(){
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
    document.getElementById("txtShop").innerHTML=xmlhttp.responseText;
    }
  }
  
  	xmlhttp.open("GET","../get_shop_info.php?id="+document.getElementById("eid").value,true);
	xmlhttp.send();
}
*/
	function fm(){
		if (ls > 1 && ls <= tp){
		ls -= 1;
		//alert(ls +":"+tp);
		showHint();
		}
	}
	function bk(){
		if(ls < tp && ls >= 1){
			ls += 1;
			//alert("ls : "+ls +"=tp: "+tp);
			showHint();
		}
	}
	
	function check(x){
		var strs = /^[0-9]/;
		if(document.getElementById(x).id == "shoptele"){
			if(document.getElementById(x).value.match(strs) || document.getElementById(x).value == ""){
				document.getElementById("err1").innerHTML = "";
			}else{
				document.getElementById("err1").innerHTML = "只接受數字";
			}
		}else if(document.getElementById(x).id == "shopfax"){
			if(document.getElementById(x).value.match(strs) || document.getElementById(x).value == ""){
				document.getElementById("err2").innerHTML = "";
			}else{
				document.getElementById("err2").innerHTML = "只接受數字";
			}
		}else if(document.getElementById(x).id == "email"){
			var strs = /^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;
			if(document.getElementById(x).value.match(strs) || document.getElementById(x).value == ""){
				document.getElementById("err3").innerHTML = "";
			}else{
				document.getElementById("err3").innerHTML = "格式錯誤";
			}
		}
	}
</script>
</head>
<body>
<h1 align = "center">新增店舖</h1>


<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增資料</div>
  <div class="CollapsiblePanelContent">
  	<form action = "newshop.php" method = "post">
<table width="100%">
	<tr>
		<td width="81">
		店舖編號:
		</td>
		<td width="478">
		<input type = "text" id = "shopid" name = "shopid" size = "30"/>
		</td>
	</tr>
	<tr>
		<td>
		地區:
		</td>
		<td>
		<input type = "text" id = "location" name = "location" size = "30"/>
	</tr>
	<tr>
		<td>
		地址:
		</td>
		<td>
		<input type = "text" id = "shopaddr" name = "shopaddr" size = "30"/>
        <label id = "err" style = "color:red"></label>
		</td>
	</tr>
	<tr>
		<td>
		電話:
		</td>
		<td>
		<input type = "text" name = "shoptele"  id = "shoptele" onchange = "check(this.id)" maxlength = "8"  size = "30"/><label id = "err1" style = "color:red"></label>
		</td>
	</tr>
	<tr>
		<td>
		傳真:
		</td>
		<td>
		<input type = "text" id = "shopfax" name = "shopfax" maxlength = "8" size = "30" onchange="check(this.id)"/><label id = "err2" style = "color:red"></label>
		</td>
	</tr>
	<tr>
		<td>電郵:</td>
		<td><input type = "text" name = "email" id = "email" size = "30" onchange="check(this.id)"/><label id = "err3" style = "color:red"></label></td>
	</tr>
		<td>
		
		</td>
		<td>
		<input type = "button" id = "insert" value = "新增" onclick="showHint_shop(this.id)"/>
		<input type = "reset" value = "取消"/>
		</td>
	</tr>
	</form>
</table>
</div>
</div>

<form>
<br>修改資料<br>
<span id = "txtShop">
<?php include("get_shop_info.php");?>
</span>
<form>
<script src="SpryCollapsiblePanel.js" type = "text/javascript">
</script>
<script type = "text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>

    

</body>
</html>