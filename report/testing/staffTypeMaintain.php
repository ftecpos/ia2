<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script language="javascript" type="text/javascript">
	var xmlhttp;
	//check new type name empty
	function check01(){
		if(document.getElementById("new_stype").value==""){
			document.getElementById("add_stype").disabled=true;
		}else{
			document.getElementById("add_stype").disabled=false;
		}
	}
	//insert new staff type
	function insert_new_type(){
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		//alert("submit_new_type:send text");
		if(document.getElementById("new_stype").value==""){
			alert("新增職位名稱不能空白");
			return;
		}
		else{
		  	var url = "../../report/testing/showStaffType.php?action=insert&type_Name="+document.getElementById("new_stype").value;
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				document.getElementById("staffTypeList").innerHTML = xmlhttp.responseText;
			}
		}
		alert(url);
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
		document.getElementById("add_stype").disabled=true;
	}
</script>
</head>

<body>
<div id="staffTypeList">
<?php include ("../../report/testing/showStaffType.php"); ?>
</div>

<div id="CollapsiblePanel2" class="CollapsiblePanel">
	<div class="CollapsiblePanelTab" tabindex="0">新增職位</div>
	<div class="CollapsiblePanelContent">
	<table>
	<tr>
		<td>輸入職位名稱 :</td> 
		<td><input type="text" name="new_type" id="new_stype" onKeyUp="check01()"/></td><td><input type="text" id="ck01text" maxlength="10" readonly="readonly" style="color:#FF0000;border: none;" value="" /></td>
	</tr>
	<tr>
		<td></td>
        <td><div align="right"><input type="button" name="add_type" id="add_stype" value="新增" onClick="insert_new_type()" disabled/></div></td>
        <td></td>
	</tr>
	</table>
	</div>
</div>

<script type="text/javascript">
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");
</script>
</body>
</html>
