
<?php require_once('../conn/sqlconnect.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Mobile</title>
<script type="text/javascript">
//////////////////////////////////Open Windows///////////////////////////
function showWindow_mobile(rid,rname,rma,rcolor,rop,rsp,rno,rls,rst,mod_man_commiss,mod_staff_commiss){
	
var allText = "";
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
    document.getElementById("txtHint3").innerHTML=xmlhttp2.responseText;
    }
  }
xmlhttp2.open("GET","../maintain/get_state_info.php?qt="+rst,true);
xmlhttp2.send();


		var txtFile = new XMLHttpRequest();
		txtFile.open("GET", "../maintain/mobile_description/"+rname+".txt", true);
		txtFile.onreadystatechange = function() {
  	if (txtFile.readyState === 4 && txtFile.status === 200) {  // Makes sure the document is ready to parse &&  Makes sure it's found the file.
      	allText = txtFile.responseText;
      	//document.getElementById("edesc").innerHTML = txtFile.responseText;
      	lines = txtFile.responseText.split("\n"); // Will separate each line into an array
      	document.getElementById("edesc").innerHTML = lines;
    }else{document.getElementById("edesc").innerHTML = "No Description";}
}
txtFile.send(null);


  if(document.getElementById("divWin"))
  {
   cal4("divWin").style.zIndex=999;
   cal4("divWin").style.display="";
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
   cal4("win_bg").style.zIndex=998;
   cal4("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }
  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="Close">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">'
  +'<table border="1">'
  //+'<tr><td>ID</td><td>'
  +'<input type = "hidden" readonly = "readonly" id = "eno" value = "'+rno+'" disable = "true">'
  +'</td></tr>'
  +'<tr><td>編號:</td><td><input type = "text" id ="eid" value = "'+rid+'"/></td></tr>'
  +'<tr><td>牌子:</td><td><input type = "text" id = "ema" value = "'+rma+'"></td></tr>'
  +'<tr><td>名稱:</td><td><input type = "text" id = "ename" value = "'+rname+'"/></td></tr>'
  +'<tr><td>顏色:</td><td><input type = "text" id = "ecolor" value = "'+rcolor+'"/></td></tr>'
  +'<tr><td>描述:</td><td><textarea style="resize:none;" cols = "30" rows = "10" id = "edesc">'+allText+'</textarea></td></tr>'
  +'<tr><td>原價:</td><td><input type = "text" id = "eoprice" value = "'+rop+'" onchange="modifyChecking(this.id)"/><label id = "modifyPrice" style = "color:red"></label></td></tr>'
  +'<tr><td>特價:</td><td><input type = "text" id = "esprice" value = "'+rsp+'"/></td></tr>'
  +'<tr><td>店長佣金:</td><td><input type = "text" id = "mod_man_commiss" value = "'+mod_man_commiss+'" tabindex="7"/></td></tr>'
  +'<tr><td>店員佣金:</td><td><input type = "text" id = "mod_staff_commiss" value = "'+mod_staff_commiss+'" tabindex="7"/></td></tr>'
  //+'<tr><td>最近來貨價</td><td><input rype = "text" readonly = "readonly" value = "'+rls+'" style="background-color:gray"/></td></tr>'
  +'<tr><td>狀況</td><td><span id = txtHint3></span></td>'
  +'</tr><tr><td colspan = "2" align = "right"><input type = "button" value = "修改" id = "update" onclick = "showHint(this.id);closeWindow()"/></td></table></div>';
  cal4("divWin").innerHTML=str;
}
function closeWindow(){
  cal4("divWin").style.display="none";
  cal4("win_bg").style.display="none";
}
function cal4(o){
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
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
var c1 = false;
var c2 = false;
var pg = 1;
var radioOnclick;
	function checking(x){
		if(document.getElementById(x).id == "mname"){
			if(document.getElementById(x).value != ""){
				document.getElementById("err").innerHTML = '';
				c1 = true;
			}else{document.getElementById("err").innerHTML = '不可空白';
			c1 = false;}	
		}else if(document.getElementById(x).id == "productid"){
			if(document.getElementById(x).value != ""){
				document.getElementById("productiderr").innerHTML = '';
				c2 = true;
			}else{document.getElementById("productiderr").innerHTML = '不可空白';
			c2 = false;}	
		}else if(document.getElementById(x).id == "oprice"){
		if(document.getElementById("oprice").value != ""){
			var strs = /[^A-Za-z_+!@#$%&]/;
			if(document.getElementById("oprice").value.match(strs)){
			document.getElementById("priceerr").innerHTML = "";	
			}else{
			document.getElementById("priceerr").innerHTML = "只可接受數字";
			}
		}else{
			document.getElementById("priceerr").innerHTML = "";
		}
		}else if(document.getElementById(x).id == "sprice"){
		if(document.getElementById("sprice").value != ""){
			var strs = /^[0-9]/;
			if(document.getElementById("sprice").value.match(strs)){
			document.getElementById("priceerr2").innerHTML = "";	
			}else{
			document.getElementById("priceerr2").innerHTML = "只可接受數字";
			}
		}else{
			document.getElementById("priceerr2").innerHTML = "";
		}
		}
		
		if (c1 == true && c2 == true){document.getElementById("insert").disabled = false;}
		else{document.getElementById("insert").disabled = true;}
		}
		
	function modifyChecking(X){
		if (document.getElementById(x) == "eoprice"){
			var strs = /^[0-9,.^A-Za-z]/;
			if(document.getElementById("eoprice").value.match(strs)){
			document.getElementById("modifyPrice").innerHTML = "";	
			}else{
			document.getElementById("modifyPrice").innerHTML = "只可接受數字";
			}
		}else if (document.getElementById(x) == "esprice"){
			
		}
		
	}
		
	function varreset(){
	c1 = false;
	c2 = false;
	//c3 = false;
	document.getElementById("insert").disabled  = true;
	document.getElementById("productiderr").innerHTML = '';
	//document.getElementById("err1").innerHTML = '';
	document.getElementById("err").innerHTML = '';
	document.getElementById("productid").value = "";
	document.getElementById("manufacturer").value = "";
	document.getElementById("mname").value = "";
	document.getElementById("color").value = "";
	document.getElementById("desc").value = "";
	document.getElementById("sprice").value = "";
	document.getElementById("oprice").value = "";
	document.getElementById("man_commiss").value = "";
	document.getElementById("staff_commiss").value = "";
	}
	
	function fm(){
		if (ls > 1 && ls <= tp){
		ls = parseInt(ls) - 1;
		//alert(ls +":"+tp);
		var fm = "fm";
		showHint(fm);
		}
	}
	function bk(){
		if(ls < tp && ls >= 1){
			ls = parseInt(ls) + 1;
			//alert("ls : "+ls +"=tp: "+tp);
			var bk = "bk";
			showHint(bk);
		}
	}
	function keypress(e){
		if(e.keyCode ==13){
			
			if(document.getElementById("topage").value != "" && document.getElementById("topage").value >= 1 && document.getElementById("topage").value <= tp){
				ls = document.getElementById("topage").value;			
				showHint("select");

			}
		}
	}
	function searchreset(){
		ls = 1;
	}

function showHint(x){
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
    if(x == 'select' ||  x == 'fm' || x == 'bk'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }else if(x == 'update'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;	
    }else if(x == 'insert'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;	
    }else if(x == 'findFile'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
    }
  }
  if(x == 'select' || x == 'fm' || x == 'bk'){
	xmlhttp.open("GET","../maintain/getinfo.php?q="+document.getElementById("phonename").value
	+"&id1="+document.getElementById("phoneid").value
	+"&id2="+document.getElementById("phoneid2").value
	+"&ls="+ls
	+"&ma="+document.getElementById("ma").value
	+"&st="+document.getElementById("satype").value
	+"&act=select"
	,true);
	}else if(x == 'update'){
	var test1 = document.getElementById("mod_man_commiss").value;
	var test2 = document.getElementById("mod_staff_commiss").value;
	if (test1.length == 0)
		test1=0;
	if (test2.length == 0)
		test2=0;
	xmlhttp.open("GET","../maintain/getinfo.php?id="+document.getElementById("eid").value
	+"&n="+document.getElementById("ename").value
	+"&upma="+document.getElementById("ema").value
	+"&c="+document.getElementById("ecolor").value//+"&co="+document.getElementById("ecost").value
	+"&op="+document.getElementById("eoprice").value
	+"&sp="+document.getElementById("esprice").value
	+"&no="+document.getElementById("eno").value
	+"&desc="+document.getElementById("edesc").value
	+"&ls="+ls
	+"&q="+document.getElementById("phonename").value
	+"&id1="+document.getElementById("phoneid").value
	+"&id2="+document.getElementById("phoneid2").value
	+"&ma="+document.getElementById("ma").value
	+"&sta="+document.getElementById("estype").value
	+"&st="+document.getElementById("satype").value
	+"&mod_man_commiss="+test1
	+"&mod_staff_commiss="+test2
	+"&act=update"
	,true);	
	}else if(x == 'insert'){
	var test1 = document.getElementById("man_commiss").value;
	var test2 = document.getElementById("staff_commiss").value;
	if (test1.length == 0)
		test1=0;
	if (test2.length == 0)
		test2=0;
	xmlhttp.open("GET","../maintain/getinfo.php?iid="+document.getElementById("productid").value
	+"&ima="+document.getElementById("manufacturer").value
	+"&ic="+document.getElementById("color").value
	+"&in="+document.getElementById("mname").value
	+"&iop="+document.getElementById("oprice").value
	+"&isp="+document.getElementById("sprice").value
	+"&st="+document.getElementById("istate").value	
	+"&idesc="+document.getElementById("desc").value
	+"&ls="+ls
	+"&q="+document.getElementById("phonename").value
	+"&id1="+document.getElementById("phoneid").value
	+"&id2="+document.getElementById("phoneid2").value
	+"&ma="+document.getElementById("ma").value
	+"&man_commiss="+test1
	+"&staff_commiss="+test2
	//+"&st="+document.getElementById("satype").value
	+"&act=insert"	
	,true);
	}else if(x == 'findFile'){	
	xmlhttp.open("GET","../maintain/getinfo.php?file="+document.getElementById("myfile").value
	+"&act=exInsert"
	,true);
	alert("sent"+document.getElementById("myfile").value);
	}
	xmlhttp.send();
}


function checkid(str){
if (str.length==0)
  {
  return;
  }
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
    document.getElementById("checkerr").innerHTML=xmlhttp.responseText;
    }
  }
	xmlhttp.open("GET","../maintain/checkid.php?id="+document.getElementById("productid").value,true);
	xmlhttp.send();
}
</script>



<!-----------------------------------Upload------------------------------------>
<script type="text/javascript">
function startUpload() {
document.getElementById('processing').innerHTML = '上傳中...';
return true;
}
function stopUpload(rel){
var msg;
switch (rel) {
case 0:
msg = "上傳成功";
break;
case 1:
msg = "上傳的文件超过限制";
break;
case 2:
msg = "只能上傳Excel文件";
break;
default:
msg = "上傳文件失败";
}
document.getElementById('processing').innerHTML = msg;
}
</script> 






</head>

<body>
<h1 align="center">手提電話貨物紀錄</h1>
<form action = "newmobile.php" method = "post">
<input type = "hidden" name = "mobileid" value = "001"/>
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab">新增資料</div>
  <div class="CollapsiblePanelContent">
<table id = "test"width = "100%">
	<tr width = "50%">
		<td>產品編號:</td>
		<td><input type = "text" id = "productid" name = "productid" onchange="checkid(this.value);checking(this.id)" size = "30" tabindex = "1"/>
			<label style = "color:red">*</label>
			<label style = "color:red" id = "productiderr"></label>
			<span id = "checkerr"></span>
		</td>	
	</tr>
	<tr>
		<td>牌子:</td>
		<td><input type = "text" id = "manufacturer" size = "30" tabindex = "2"/></td>
		<td>原價:</td>
		<td><input type = "text" id = "oprice" size = "30" tabindex = "6" onchange="checking(this.id)"/>
			<label id = "priceerr" style = "color:red"></label>
		</td>
	<tr>
		<td>名稱:</td>
		<td><input type = "text" onchange = "checking(this.id)" name = "mname" id = "mname" size = "30" tabindex = "3"/>
            <label style = "color:red">*</label>
		    <label id = "err" style = "color:red"></label>
        </td>
        <td>特價:</td>
        <td><input type = "text" id = "sprice" size = "30" tabindex = "7" onchange="checking(this.id)"/>
        	<label id = "priceerr2" style = "color:red"></label>
        </td>
	</tr>
	<tr>
		<td>顏色:</td>
		<td><input type  = "text" id = "color" size = "30" tabindex = "4"/></td>
		<td>狀況:</td>
		<td>
<?php
	echo "<select id = 'istate'>";
	mysql_select_db($database_conn, $conn);
	//$sql = "SELECT name FORM asscessoriestype";
	$sql = "SELECT productstate_no,stateName FROM productstate";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	//echo "<option></option>";
	do{
	if($totalrow == 0) break;
	echo "<option value = '".$row['productstate_no']."'> ".$row['stateName']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?></td>
	</tr>
	<tr>
	<td></td><td></td><td>店長佣金</td><td><input type = "text" id = "man_commiss" tabindex="7"/></td>
	</tr>
	<tr>
	<td></td><td></td><td>店員佣金</td><td><input type = "text" id = "staff_commiss" tabindex="7"/></td>
	<tr>
		<td>描述:</td>
		<td><textarea style="resize:none;" cols = "30" rows = "10" id = "desc" tabindex = "5"></textarea></td>
	</tr>
	<tr>
		<td colspan="2">
		<br><input type = "button" disabled value = "新增" id  = "insert" onclick="showHint(this.id);varreset()"/>
		<input type = "reset" onclick = "varreset()" value = "取消"/>
		</form>
		</td>
	</tr>
	<tr>
<!-----------------------------------Upload---------------------------------->
<td>


<form action="ExcelRead.php" method="post" enctype="multipart/form-data" target="form-target" onsubmit="startUpload();">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
Excel輸入<input type="file" name="myfile" id="myfile"/>
<input type="submit" name="sub" value="上傳" id = "findFile" onclick="showHint(this.id)"/><span id="processing"></span>
</form>
<iframe style="width:0; height:0; border:0;" name="form-target"></iframe>
</td>
<!----------------------------------------------------------------------------->	
	</tr>
</table>

</div>
</div>




<script src="../js/SpryCollapsiblePanel.js" type = "text/javascript">
</script>
<script src="../maintain/openDailog.js" type = "text/javascript">
</script>
<p>修改資料</p>
<form>
<br>牌子:<input type = "text" id = "ma" name = "ma"/>
<br>名稱:<input type="text" id="phonename"/ name = "phonename"/><!--onkeyup = "showHint(this.value)" -->
<br>編號:<input type = "text" id = "phoneid" name = "phoneid"/> - <input type = "text" id = "phoneid2" name = "phoneid2"/>
<br>狀況:
<?php
	echo "<select name = 'satype' id = 'satype'>";
	echo "<option value = 'all'>全部</option>";
	mysql_select_db($database_conn, $conn);
	//$sql = "SELECT name FORM asscessoriestype";
	$sql = "SELECT productstate_no,stateName FROM productstate";
	$rs = mysql_query($sql, $conn) or die(mysql_error());
   	$row = mysql_fetch_assoc($rs);
	$totalrow = mysql_num_rows($rs);
	//echo "<option></option>";
	do{
	if($totalrow == 0) break;
	echo "<option value = '".$row['productstate_no']."'> ".$row['stateName']."</option>";
	}while($row = mysql_fetch_assoc($rs));
	echo "</select>";
?>
<br><input type = "button" value = "尋找" id = "select" onclick = "searchreset();showHint(this.id)"/>
<input type= "reset" value = "重設" id = "reset"/>
</form>
<span id="txtHint">
<?php include("getinfo.php");?>
</span>	
<script type = "text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>

