<?php require("../../conn/sqlconnect.php");  ?>
<?php
	$select_stafftype = "SELECT * FROM stafftype";
	$stafftype = mysql_query($select_stafftype);
	$stafftype_data = mysql_fetch_assoc($stafftype);
	$totalRows_stafftype = mysql_num_rows($stafftype);

	$typeNumber = array();
	$typeString = array();
	$total_type = 1;
	do{
		$typeNumber[$total_type]=$stafftype_data['staffType_no'];
		$typeString[$total_type]=$stafftype_data['typeName'];
		$total_type++;
	}while($stafftype_data = mysql_fetch_assoc($stafftype));
	?>
<?php
$all_staff_sql = "select * from staff";
$rs_staff = mysql_query($all_staff_sql);
?>

<script language="javascript" type="text/javascript">

function showWindow(staff_no,ri,pwsd,post_no){
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
  var staff_type_option = document.getElementById("sType").value;
  
  var table = document.getElementById("staffContent");
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯職員</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">CLOSE</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">職員No: <input type="text" value="'+staff_no+'" id="edit_staff_no" disabled /><br>職員ID: <input type="text"  value="'+table.rows[ri].cells[1].innerHTML+'" id="edit_staff_id"/><br>職員名稱:<input type="text"  value="'+table.rows[ri].cells[2].innerHTML+'" id="edit_staffName"/><br>職位: <span id="typeOption"></span>'+'<br>密碼:<input type="password"  value="'+pwsd+'" id="edit_staffpswd" disabled/><input type="button" id="change_pw" value="更改密碼"onclick="ch_pswd()"/><br><br><br><br><input type="button" onclick="update_staff('+staff_no+', '+post_no+')" value="更改"/>';
  str+='</div>'
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

function update_staff(up_staff_no, up_sType_no){
	var xmlhttp;
	var edit_staff_id = document.getElementById("edit_staff_id").value;
	var edit_staffName = document.getElementById("edit_staffName").value;
	var edit_staff_pswd = document.getElementById("edit_staffpswd").value;
	var edit_staffType_no;
	
	var url = "../../report/testing/staffSQL.php?action=updateStaff&esno="+up_staff_no+"&esid="+edit_staff_id+"&esname=" + edit_staffName +"&espwsd="+edit_staff_pswd+"&=estypeno"+up_sType_no;
	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	alert(up_staff_no+", "+edit_staff_id+", "+edit_staffName+", "+edit_staff_pswd+", "+up_sType_no);

	closeWindow()
	
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
<td><?php echo $row_staff['staff_no']." "; ?><input type="button" onclick="showWindow(<?php echo $row_staff['staff_no'];?>,this.parentNode.parentNode.rowIndex,<?php echo $row_staff['pwd'];?>,<?php echo $row_staff['staffType_no'];?>)" value="修改" name="edit" id="edit"/></td>
<td><?php echo $row_staff['staff_id']; ?></td><td><?php echo $row_staff['name']; ?></td>
<td><?php echo $typeString[$row_staff['staffType_no']]; ?></td>
</tr>
<?php }?>
</tbody></table>
</div>