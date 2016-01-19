<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刪除資料</title>
<script type = "text/javascript">
var ls = 1;
function b(id,type){
	alert(id,type);
	//TableAction(x2)
}
function searchreset(){
		ls = 1;
}
function TableAction(x){
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
		if(x == "select"){
   		 document.getElementById("txtHint2").innerHTML=xmlhttp2.responseText;		
    	}else{
    	 document.getElementById("txtHint2").innerHTML=xmlhttp2.responseText;	
    	}
    }
  }
if(x == "select"){
xmlhttp2.open("GET","../maintain/get_table_info.php?act=select"
	+"&tables="+document.getElementById("showAllTable").value
	+"&ls="+ls,true);
}else{
xmlhttp2.open("GET","../maintain/get_table_info.php?act=delete"
	+"&tables="+document.getElementById("showAllTable").value
	+"&id="+x
	+"&ls="+ls,true);
}
xmlhttp2.send();
}

</script>
</head>
<body>
	<form>
			<select id = 'showAllTable'>
				<option value = 'phonetype'>手提電話</option>
				<option value = 'asscessories'>配件</option>
				<option value = 'asscessoriestype'>配件種類</option>
				<option value = 'productState'>狀況</option>
				<option value = 'retailshop'>店舖</option>
				<option value = 'customer'>顧客</option>
				<option value = 'staff'>職員</option>
				<option value = 'stafftype'>職位</option>
				<option value = 'supplier'>供應商</option>
			</select>
				<!--
				//<input type = "button" value = "搜索" id = "select" onclick = "TableAction(this.id)"></td>
				
<br>牌子:<input type = "text" id = "ma" name = "ma"/>
<br>名稱:<input type="text" id="phonename"/ name = "phonename"/><!--onkeyup = "showHint(this.value)"
<br>編號:<input type = "text" id = "phoneid" name = "phoneid"/> - <input type = "text" id = "phoneid2" name = "phoneid2"/>
<br>狀況:
<?php require_once('../conn/sqlconnect.php');?>
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
?>-->
<br><input type = "button" value = "尋找" id = "select" onclick = "searchreset();TableAction(this.id)"/>
<input type= "reset" value = "重設" id = "reset"/>
</form>
資料<br>
<span id = "txtHint2"><span>

</body>
</html>
