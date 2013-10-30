<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script>
function showWindow(getno,getname){
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
   objWin.style.width="300px";
   objWin.style.height="120px";
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
  var str = "";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">修改職位名稱</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">CLOSE</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent"><table><tr><td>職位編號:</td><td><input type = "text" value="'+getno+'" id="edit_sTypeNo" disabled /></td></tr><tr><td>職位名稱:</td><td><input type = "text"  value="'+getname+'" id="edit_sTypeName" maxlength="10"/></td></tr><tr></tr><tr><td></td><td><input type = "button" onclick="update_sType('+getno+')" value="更改"/></td></tr></table></div>';
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

var xmlhttp;

function update_sType(up_sno){
	if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		//alert("submit_new_type:send text");
		if(document.getElementById("edit_sTypeName").value==""){
			alert("更改職位名稱不能空白");
			return;
		}
		else{
		  	var url = "../../report/testing/showStaffType.php?action=update&type_Name="+document.getElementById("edit_sTypeName").value+"&type_no="+document.getElementById("edit_sTypeNo").value;
			alert(document.getElementById("edit_sTypeNo").value+", "+document.getElementById("edit_sTypeName").value);
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				document.getElementById("staffTypeResult").innerHTML = xmlhttp.responseText;
			}
		}
		alert(url);
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
		closeWindow();
}
</script>
</head>

<body>
<?php
require_once("../../conn/sqlconnect.php");

if(isset($_GET['action'])){
switch($_GET['action']){
	case "insert":
		$new_typeName = $_GET['type_Name'];
		$typeSql = "insert into stafftype(typeName) values('".$new_typeName."');";
		break;
	
	case "update":
		$update_typeName = $_GET['type_Name'];
		$type_no = $_GET['type_no'];
		$typeSql = "update stafftype set typeName ='".$update_typeName."' where staffType_no =".$type_no.";";
		break;
	
}
	mysql_query($typeSql);
}
?>
<?php
	$all_sType = "select * from stafftype";
	$all_sType_rs = mysql_query($all_sType);
?>
<div id"staffTypeResult">
	<table width="500" border="1">
    <tr><th>職位編號</th><th>職位名稱</th></tr>
    <?php while($row_rs = mysql_fetch_assoc($all_sType_rs)){ ?>
    <tr><td><?php echo $row_rs['staffType_no']; ?><input type="button"  name="修改" value="修改" onclick="showWindow(<?php echo $row_rs['staffType_no']; ?>, '<?php echo $row_rs['typeName']; ?>')" /></td>
    <td><?php echo $row_rs['typeName']; ?></td></tr>
    <?php } ?>
    </table>
</div>

</body>
</html>
