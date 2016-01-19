<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增手機狀態</title>
</head>
<script>



function add_phone_state(){

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 
var phoneStateName = document.getElementById("phone_state_name");
if(phoneStateName.value==""){
	alert("手機狀態不能為空白, 請輸入手機狀態名稱");
}else{
	var url = "newStateSql.php?phoneState=" + phoneStateName.value;
}
xmlhttp.open("GET",url,true);
xmlhttp.send();

}
</script>
<body>
<b>新增手機狀態</b>
<br /><br />
<table>
	<tr><td>手機狀態名稱</td><td><input type='text' id='phone_state_name' /></td></tr>
    <tr><td><input type='button' name='add_phone_state' value='新增' onclick='add_phone_state()' />
    		<input type='reset' /></td></tr>
</table>
<br /><br />

<?php
require ("../../conn/sqlconnect.php");
$query_rs = "select * from phonestate";
$rs = mysql_query($query_rs);
?>
<table width="600" border="1">
<tr>
<td>手機狀態編號</td>
<td>手機狀態名稱</td>
</tr>
<?php while($row_rs = mysql_fetch_assoc($rs)){?>
<tr>
<td width="200"><?php echo $row_rs['phoneState_no']." ";?></td>
<td width="400"><?php echo $row_rs['phoneStateName'];?></td>
<?php } ?>
</table>
</body>
</html>
