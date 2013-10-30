<script language="javascript" type="text/javascript">
//var time_variable;
 
function getXMLObject()  //XML OBJECT
{
   var xmlHttp = false;
   try {
     xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")  // For Old Microsoft Browsers
   }
   catch (e) {
     try {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")  // For Microsoft IE 6.0+
     }
     catch (e2) {
       xmlHttp = false   // No Browser accepts the XMLHTTP Object then false
     }
   }
   if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
     xmlHttp = new XMLHttpRequest();        //For Mozilla, Opera Browsers
   }
   return xmlHttp;  // Mandatory Statement returning the ajax object created
}
 
var xmlhttp = new getXMLObject();	//xmlhttp holds the ajax object
 
function updatepro_state(getid) {
  var getdate = new Date();  //Used to prevent caching during ajax call
  if(xmlhttp) { 
  var edit_proNo = document.getElementById("edit_proNo");
  var edit_proName = document.getElementById("edit_proName");
  //var url = "../sales/voidformquery.php?InvoiceNo=" + InvoiceNo.value + "&selvoid=" + selvoid.checked;
  if(edit_proNo.value==""||edit_proName.value==""){
  alert("請輸入產品分類編號和名稱");
  return false;
  }else{
	  var url = "../maintain/productstatequery.php?edit_proNo=" + edit_proNo.value +"&edit_proName=" + edit_proName.value + "&getid=" + getid +"&type=update";
	  //var url = "productstatequery.php?edit_proNo=" + edit_proNo.value +"&edit_proName=" + edit_proName.value + "&getid=" + getid;
	  closeWindow()
	  }
  xmlhttp.onreadystatechange  = handleServerResponse;
  xmlhttp.open("GET",url,true);
  xmlhttp.send(null);
  
  }
}

function delrecord(getid){
	if(confirm("是否要刪除 ID : "+getid)){
	var url = "../maintain/productstatequery.php?getid=" + getid +"&type=delete";
	xmlhttp.onreadystatechange  = handleServerResponse;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
		}
	}

function handleServerResponse() {
   if (xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
       document.getElementById("proquery").innerHTML=xmlhttp.responseText; //Update the HTML Form element 
     }
     else {
        alert("Error during AJAX call. Please try again");
     }
   }
}

function showWindow(getid,getname){
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
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯產品名稱</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">CLOSE</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">分類編號:<input type = "text" value="'+getid+'" id="edit_proNo"/><br>分類名稱:<input type = "text"  value="'+getname+'" id="edit_proName"/><br><input type = "button" onclick="updatepro_state('+getid+')" value="更改"/></div>';
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

<?php
include("../conn/sqlconnect.php");
if(isset($_GET['type'])){
switch($_GET['type']){
	case "insert":
	$sql_query = "INSERT INTO productstate(stateName) VALUE ('".$_GET['productstate']."')";
	break;
	
	case "update":
	$sql_query="UPDATE productstate SET `productState_no` = '".$_GET['edit_proNo']."' , `stateName` = '".$_GET['edit_proName']."' WHERE `productState_no` = '".$_GET['getid']."'";	
	break;
	
	case "delete":
	$sql_query="DELETE FROM productstate WHERE `productState_no` = '".$_GET['getid']."'";		
	break;
	}
	mysql_query($sql_query);
}
?>
<?php
$query_rs = "SELECT * FROM productstate";
$rs = mysql_query($query_rs);
?>
<div id="proquery">
<table width="828" border="1" >
<tr>
<td>產品分類編號</td>
<td>產品分類名稱</td>
</tr>
<?php while($row_rs = mysql_fetch_assoc($rs)){?>
<tr>
<td><?php echo $row_rs['productState_no']." ";?><input type="button" onclick="showWindow(<?php echo $row_rs['productState_no'];?>,'<?php echo $row_rs['stateName'];?>')" value="Edit" name="edit"/>
<input type="button" onClick="delrecord(<?php echo $row_rs['productState_no'];?>)" value="Delete" name="Delete"/>
</td>
<td><?php echo $row_rs['stateName'];?></td>
</tr>	
<?php }?>
</table>
</div>

