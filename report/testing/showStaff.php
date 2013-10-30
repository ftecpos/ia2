<?php require("../../conn/sqlconnect.php");  ?>

<?php
$all_staff_sql = "SELECT staff_no, staff_id, pwd, name, staff.staffType_no, typeName FROM staff LEFT JOIN stafftype ON staff.staffType_no = stafftype.staffType_no ORDER BY staff_no ASC";
$rs_staff = mysql_query($all_staff_sql);
?>

<script language="javascript" type="text/javascript">

function showWindow(staff_no,ri,pwsd,post_no,post_name){
alert(staff_no+','+ri+','+pwsd+','+post_no+','+post_name);
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
    document.getElementById("editTypeOption").innerHTML=xmlhttp2.responseText;
    }
  }
xmlhttp2.open("GET","../../report/testing/get_staff_type.php?stn="+post_no,true);
xmlhttp2.send();

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
   objWin.style.height="300px";
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
  //var staff_type_option = document.getElementById("sType").value;
  
  var table = document.getElementById("staffContent");
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯職員</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">CLOSE</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent"><table><tr><td>職員No:</td><td><input type="text" value="'+staff_no+'" id="edit_staff_no" disabled /></td></tr><tr><td>職員ID: </td><td><input type="text"  value="'+table.rows[ri].cells[1].innerHTML+'" id="edit_staff_id"/></td></tr><tr><td>職員名稱: </td><td><input type="text"  value="'+table.rows[ri].cells[2].innerHTML+'" id="edit_staffName"/></td></tr><tr><td>職位: </td><td><span id="editTypeOption"></span></td></tr><tr><td>密碼: </td><td><input type="password"  value="'+pwsd+'" id="edit_staffpswd" disabled/><input type="button" id="change_pw" value="更改密碼"onclick="ch_pswd()"/></td></tr><tr></tr><tr></tr><tr><td><input type="button" onclick="update_staff('+staff_no+')" value="更改"/></td></tr></table></div>';
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

function ch_pswd(){
	if(document.getElementById("edit_staffpswd").disabled=true)
	document.getElementById("edit_staffpswd").disabled=false;
}

function update_staff(up_staff_no){
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var edit_staff_id = document.getElementById("edit_staff_id").value;
	var edit_staffName = document.getElementById("edit_staffName").value;
	var edit_staff_pswd = document.getElementById("edit_staffpswd").value;
	var edit_staffType_no = document.getElementById("edit_stype").value;
	var edit_staff_no = up_staff_no;
	
	var url = "../../report/testing/staffSQL.php?action=update&esno="+edit_staff_no+"&esid="+edit_staff_id+"&esname=" + edit_staffName +"&espwsd="+edit_staff_pswd+"&estypeno="+edit_staffType_no;
	//alert(url);
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	//alert(up_staff_no+", "+edit_staff_id+", "+edit_staffName+", "+edit_staff_pswd+", "+edit_staffType_no);

	closeWindow();
	
}

</script>


<div id="display_staff">
<table border='1' width='800' id="staffContent">
<thead>
<tr><th>No</th><th>職員ID</th><th>職員名稱</th><th>職位</th></tr>
</thead>
<tbody>
<?php while($row_staff = mysql_fetch_assoc($rs_staff)){?>
<tr>
<td><?php echo $row_staff['staff_no']." "; ?><input type="button" onclick="showWindow(<?php echo $row_staff['staff_no'];?>,this.parentNode.parentNode.rowIndex,<?php echo $row_staff['pwd'];?>,<?php echo $row_staff['staffType_no'];?>,'<?php echo $row_staff['typeName'];?>')" value="修改" name="edit" id="edit"/></td>
<td><?php echo $row_staff['staff_id']; ?></td><td><?php echo $row_staff['name']; ?></td>
<td><?php echo $row_staff['typeName']; ?></td>
</tr>
<?php }?>
</tbody></table>
</div>