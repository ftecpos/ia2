<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增配件分類</title>
<script src="../js/acctype.js" type="text/javascript"></script>
<script type="text/javascript">
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
  if(ty == "acctype") {
  	var table = document.getElementById("accContent");
  	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯配件資料</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+="<table border='0' id='editTable'><tbody><tr><td>分類編號</td><td><input type='text' id='editNo' name='editNo' size='10' disabled value='"+no+"'><td></tr><tr><td>分類名稱</td><td><input type='text' id='editName' name='editName' value='"+table.rows[ri].cells[1].innerHTML+"'></tr><tr><td><input type='button' id='editSubmit' name='editSubmit' value='更改' onclick='updateType();closeWindow()'></td></tr></tbody></table>";
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

<body onload="selectType()">
<span id="showResult">
</span>

<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">新增分類</div>
  <div class="CollapsiblePanelContent">
            <form action="" method="post" name="myform" id="myform">
				<table border="1">	
				<tr>
                <td>分類名稱</td>
			    <td><input type="text" id="typeName" name="typeName" /></td>
                </tr>
			<tr>
				<td colspan="2" align="right"><input type="button" value="新增" onclick="insertType();formClear('myform')" /><input type="reset" value="重設" /></td></tr></table>
            </form>
            
            
             <form name="myform2" id="myform2" enctype="multipart/form-data" action="exUpload.php" method="post" target="form-target" onsubmit="startUpload();">
             	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            	<table border="1"><tr><td>以Excel輸入</td>
                <td><input type="file" id="exTypeIn" name="exTypeIn" /><div id="processing"></div></td>
            </tr>
            <tr>
            	<td colspan="2" align="right"><input type="submit" value="導入" name="sub" onclick="formClear('myform2')" /><input type="reset" value="重設" onclick="clear()"/></td></tr></table>
            </form>
            
            <iframe style="width:0; height:0; border:0;" name="form-target"></iframe>
		
    
    </div>
</div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>
