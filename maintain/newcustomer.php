<?php include("../check_login.php");?>
<?php include("../conn/sqlconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增客戶</title>
<script src="../js/newcustomer.js" type="text/javascript"></script>
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
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">新增客戶</div>
  <div class="CollapsiblePanelContent">
			<table border="0"> 
            	<tr>
                <form name="myform" id="myform">
                	<td>客戶編號</td>
                    <td><input type="text" id="customerId" name="customerId" onchange="validId(this.value)" /><font color="red">*</font><label id = "custid" class="error"></label></td>  
                </tr>
				<tr>
					<td>客戶名稱</td>
				    <td><input type="text" id="customerName" name="customerName" onChange="validName(this.value)" /><font color="red">*</font><label id = "name" class="error"></label></td>   
				</tr>    
				<tr>
					<td>地址</td>
				    <td><input type="text" id="address" name="address" size="100" onChange="validAdd(this.value)" /><font color="red">*</font><label id="address" class="error"></label></td>
				</tr>
				<tr>
					<td>電話</td>
				    <td><input type="text" id="tel" name="tel" onChange="validTel(this.value)" /><font color="red">*</font><label id="telError" class="error"></label></td>
				</tr>   
				<tr>
					<td>傳真</td>
				    <td><input type="text" id="fax" name="fax" onChange="validFax(this.value)" /><label id="faxError" class="error"></label></td>   
				</tr> 
				<tr>
					<td>電郵</td>
				    <td><input type="text" id="email" name="email" onChange="validEmail(this.value)" /><label id="error" class="error"></label></td>
				</tr>
				<tr>
					<td>數期</td>
				    <td><input type="text" id="period" name="period" /></td>
				</tr>
				<tr>
					<td>備註</td>
				    <td><textarea id="remark" name="remark" cols="30" rows="10"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="button" disabled value="新增" name="submit1" id="submit1" onclick="insertCust();clearError()" /><input type="reset" value="重設" onClick="clearError()" /></td>
                </form>
				</tr>
                <tr>
               	 <form name="myform2" id="myform2" enctype="multipart/form-data" action="exUpload.php" method="post" target="form-target" onsubmit="startUpload();">
             		<input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE" value="10000000" />
                    <input type="hidden" name="upType" id="upType" value="2" />
            		<td>以Excel輸入</td>
               		<td><input type="file" id="exCustIn" name="exCustIn" /><div id="processing"></div></td>
            	</tr>
            	<tr>
            		<td colspan="2" align="right"><input type="submit" value="導入" name="sub" id="sub" /><input type="reset" value="重設" onclick="clear()"/></td>
            </form>
           		</tr>
            	<iframe style="width:0; height:0; border:0;" name="form-target"></iframe>
			</table>
		</div>
</div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>
