<?php
/*
 require_once('Connections/conn.php'); 
$mcolor;
$mdec;
$wc = false;

if(!empty($_POST) && isset($_POST)){
	do{
	if(file_exists("mobile_description")){
		$filename = "mobile_description/".$_POST["mname"];
		if(file_exists($filename)){
			break;
		}else{
			$data = $_POST["mdec"];
			$fp = fopen("$filename","w");
			//foreach($data as $key => $value){
			fwrite($fp,$data);
			fclose($fp);
			$wc = true;}
	}else{
		mkdir("mobile_description");
	}
	}while($wc = true);
$FileName = $_POST['mname'];
$id = $_POST['mobileid'];
if($_POST['mcolor'] == ""){
	$color = "N/A";
	}else{$color = $_POST['mcolor'];}
if($_POST['mdec'] == ""){
	$dec = "N/A";
	}
if ($_POST['oprice']==''){
	$op = 0;
}else{$op = $_POST['oprice'];}

if ($_POST['sellprice']==''){
	$sp = 0;
}else{$sp = $_POST['sellprice'];}

    mysql_select_db($database_conn, $conn);
    $SQL = "SELECT phonetype_id FROM phoneType WHERE phonetype_id = '".$_POST['productid']."'";  
    $rsProd = mysql_query($SQL, $conn) or die(mysql_error());
    $row_rsProd = mysql_fetch_assoc($rsProd);
	if($row_rsProd == 0){
	
	$next_prodSeq = $_POST['productid'];
	$SQL = "SELECT IFNULL(MAX(phonetype_no),0)+1 as phonetype_no FROM phonetype";  
    $rs = mysql_query($SQL, $conn) or die(mysql_error());
    $row = mysql_fetch_assoc($rs);
    $next = $row['phonetype_no'];
	$SQL = "INSERT INTO phoneType(phonetype_no,phonetype_id,manufacturer,color,phone_name,oprice,sprice,state)VALUES
	(".$next.",'".$next_prodSeq."','".$_POST['manufacturer']."', '".$color."', '".$_POST['mname']."',".$op.",".$sp.",1)";
    @mysql_query($SQL, $conn) or die(mysql_error());
  	}}

*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Mobile</title>
<script type="text/javascript">
//////////////////////////////////Open Windows///////////////////////////
function showWindow(rid,rname,rma,rcolor,rop,rsp,rno,rls,rst){
	
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
xmlhttp2.open("GET","get_state_info.php?qt="+rst,true);
xmlhttp2.send();
	
	
  if(document.getElementById("divWin"))
  {
   $("divWin").style.zIndex=999;
   $("divWin").style.display="";
  }
  else
  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="520px";
   objWin.style.height="600px";
   objWin.style.top = "20%";
   objWin.style.left = "10%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_bg"))
  {
   $("win_bg").style.zIndex=998;
   $("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }


alert("打開文件"+rname+".txt");
var arr=GetHeader("mobile_descriptionrname/"rname+".txt").split("\r\n");
alert("讀取文件");
for(var i=0;i<arr.length;i++){
alert("第"+(i+1)+"行数据为:"+arr[i]);
}
alert("關閉文件");



  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="Close">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">'
  +'<table border="1">'
  +'<tr><td>ID</td><td><input type = "text" readonly = "readonly" id = "eno" value = "'+rno+'"></td></tr>'
  +'<tr><td>編號:</td><td><input type = "text" id ="eid" value = "'+rid+'"/></td></tr>'
  +'<tr><td>牌子:</td><td><input type = "text" id = "ema" value = "'+rma+'"></td></tr>'
  +'<tr><td>名稱:</td><td><input type = "text" id = "ename" value = "'+rname+'"/></td></tr>'
  +'<tr><td>顏色:</td><td><input type = "text" id = "ecolor" value = "'+rcolor+'"/></td></tr>'
  +'<tr><td>描述:</td><td><textarea cols = "30" rows = "10" id = "edesc"></textarea></td></tr>'
  +'<tr><td>原價:</td><td><input type = "text" id = "eoprice" value = "'+rop+'"/></td></tr>'
  +'<tr><td>特價:</td><td><input type = "text" id = "esprice" value = "'+rsp+'"/></td></tr>'
  +'<tr><td>最近來貨價</td><td><input rype = "text" readonly = "readonly" value = "'+rls+'"/></td></tr>'
  +'<tr><td>狀況</td><td><span id = txtHint3></span></td>'//<input rype = "text" id = "estate" value = "'+rst+'"/>
  +'</tr><tr><td colspan = "2" align = "right"><input type = "button" value = "修改" id = "update" onclick = "showHint(this.id);closeWindow()"/></td></table></div>';
  $("divWin").innerHTML=str;
}
function closeWindow(){
  $("divWin").style.display="none";
  $("win_bg").style.display="none";
}
function $(o){
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
		}
		if (c1 == true && c2 == true){document.getElementById("insert").disabled = false;}
		else{document.getElementById("insert").disabled = true;}
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
	}
	
	
	//var tpg = document.getElementById("totalpage").value;
	
	function fm(){
		if (ls > 1 && ls <= tp){
		ls -= 1;
		//alert(ls +":"+tp);
		var fm = "fm";
		showHint(fm);
		}
	}
	function bk(){
		if(ls < tp && ls >= 1){
			ls += 1;
			//alert("ls : "+ls +"=tp: "+tp);
			var bk = "bk";
			showHint(bk);
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
    if(x == 'search' ||  x == 'fm' || x == 'bk'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }else if(x == 'update'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;	
    }else if(x == 'insert'){
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;	
    }
    }
  }
  if(x == 'search' || x == 'fm' || x == 'bk'){
	xmlhttp.open("GET","getinfo.php?q="+document.getElementById("phonename").value
	+"&id1="+document.getElementById("phoneid").value
	+"&id2="+document.getElementById("phoneid2").value
	+"&ls="+ls
	+"&ma="+document.getElementById("ma").value
	+"&st="+document.getElementById("satype").value
	+"&act=select"
	,true);
	}else if(x == 'update'){
	xmlhttp.open("GET","getinfo.php?id="+document.getElementById("eid").value
	+"&n="+document.getElementById("ename").value
	+"&upma="+document.getElementById("ema").value
	+"&c="+document.getElementById("ecolor").value//+"&co="+document.getElementById("ecost").value
	+"&op="+document.getElementById("eoprice").value
	+"&sp="+document.getElementById("esprice").value
	+"&no="+document.getElementById("eno").value
	+"&ls="+ls
	+"&q="+document.getElementById("phonename").value
	+"&id1="+document.getElementById("phoneid").value
	+"&id2="+document.getElementById("phoneid2").value
	+"&ma="+document.getElementById("ma").value
	+"&sta="+document.getElementById("estype").value
	+"&st="+document.getElementById("satype").value
	+"&act=update"
	,true);	
	}else if(x == 'insert'){
	xmlhttp.open("GET","getinfo.php?iid="+document.getElementById("productid").value
	+"&ima="+document.getElementById("manufacturer").value
	+"&ic="+document.getElementById("color").value
	+"&in="+document.getElementById("mname").value
	+"&iop="+document.getElementById("oprice").value
	+"&isp="+document.getElementById("sprice").value
	+"&st="+document.getElementById("istate").value	
	+"&idesc="+document.getElementById("desc").value
	+"&ls="+ls
	+"&act=insert"	
	,true);
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
	xmlhttp.open("GET","checkid.php?id="+document.getElementById("productid").value,true);
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
	xmlhttp.open("GET","getinfo.php?id="+document.getElementById("eid").value
	+"&n="+document.getElementById("ename").value+"&upma="+document.getElementById("ema").value
	+"&c="+document.getElementById("ecolor").value//+"&co="+document.getElementById("ecost").value
	+"&op="+document.getElementById("eoprice").value+"&sp="+document.getElementById("esprice").value
	+"&no="+document.getElementById("eno").value+"&ls="+ls+"&q="+document.getElementById("phonename").value
	+"&id1="+document.getElementById("phoneid").value+"&id2="+document.getElementById("phoneid2").value
	+"&ma="+document.getElementById("ma").value+"&sta="+document.getElementById("estype").value+"&st="+document.getElementById("satype").value+"&act=update"
	,true);
	xmlhttp.send();

}
*/
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
		<td><input type = "text" id = "oprice" size = "30" tabindex = "6"/></td>
	<tr>
		<td>名稱:</td>
		<td><input type = "text" onchange = "checking(this.id)" name = "mname" id = "mname" size = "30" tabindex = "3"/>
            <label style = "color:red">*</label>
		    <label id = "err" style = "color:red"></label>
        </td>
        <td>特價:</td>
        <td><input type = "text" id = "sprice" size = "30" tabindex = "7"/></td>
	</tr>
	<tr>
		<td>顏色:</td>
		<td><input type  = "text" id = "color"  tabindex = "4"/></td>
		<td>狀況:</td>
		<td>
<?php require_once('Connections/conn.php');?>
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
		<td>描述:</td>
		<td><textarea cols = "30" rows = "10" id = "desc" tabindex = "5"></textarea></td>
	</tr>
	<tr>
		<td>
		<br><input type = "button" disabled value = "新增" id  = "insert" onclick="showHint(this.id);varreset()"/>
		<input type = "reset" onclick = "varreset()" value = "取消"/>
		</td>
	<tr>
</table>
  </div>
</div>
</form>
<script src="SpryCollapsiblePanel.js" type = "text/javascript">
</script>
<script src="openDailog.js" type = "text/javascript">
</script>
<p>修改資料</p>
<form>
<br>牌子:<input type = "text" id = "ma" name = "ma"/>
<br>名稱:<input type="text" id="phonename"/ name = "phonename"/><!--onkeyup = "showHint(this.value)" -->
<br>編號:<input type = "text" id = "phoneid" name = "phoneid"/> - <input type = "text" id = "phoneid2" name = "phoneid2"/>
<br>狀況:
<?php require_once('Connections/conn.php');?>
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
<br><input type = "button" value = "尋找" id = "search" onclick = "searchreset();showHint(this.id)"/>
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

