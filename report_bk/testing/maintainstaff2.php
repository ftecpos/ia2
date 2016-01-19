<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>

<script language="javascript" type="text/javascript">
	var xmlhttp;
	var xmlhttp2;
  	var checker00=/^[0-9,A-z]*/;
	var name_checked=false;
	var id_checked=false;
	var pw_checked=false;
	var idlist=new Array();

	  <?php
	//Open table "staff"
    $select_staf = "SELECT * FROM staff";
    $staf = mysql_query($select_staf);
    $staf_data = mysql_fetch_assoc($staf);
	$num = 0;
	do{
	  print("idlist[".$num."]=\"".$staf_data['staff_id']."\";
  ");
	  $num=$num+1;
	}while($staf_data = mysql_fetch_assoc($staf));?>
	
//check the name of the new userstaff
  function messagerN(){
    var n = document.getElementById("uName").value;
	if (n.length < 2){
	  document.getElementById("uNm").value = "*<--名稱必須有2字或以上";
	  name_checked=false;
	  }
	else{
	  document.getElementById("uNm").value = "*";
	  name_checked=true;
	  check();
	}
  }
//check the id of the new staff
  function messagerI(){
    var i = document.getElementById("uID").value;
	if (i.length<0){
	  document.getElementById("uIDm").value = "*<--ID必須輸入";
      id_checked=false;
      return;
	}else if (i.length!=4){
		document.getElementById("uIDm").value = "*<--ID長度必須為4位";
		id_checked=false;
		return;
	}	
	if (i==i.match(checker00)){
	  var no = 0;
      do{
        if(i==idlist[no].toString()){
          document.getElementById("uIDm").value = "*<--ID已被其他職員使用";
          id_checked=false;
          return;}
        no = no+1;
      }while(no<idlist.length);
      document.getElementById("uIDm").value = "*";
      id_checked=true;
      check();
    }
    else{
      document.getElementById("uIDm").value = "*<--不可使用其他字元";
      id_checked=false;
    }
  }
//check the password of the new staff
  function messagerP(){
    var pw = document.getElementById("uPWord").value;
	if (pw.length >5 && pw==pw.match(checker00)){
	  document.getElementById("uPm").value = "*";
	  pw_checked=true;
	  check();
	}
	else{
	  document.getElementById("uPm").value = "*<--密碼有不當字元或6字以下";
	  pw_checked=false;
	}
  }
//check if every data is correct
  function check(){
    if ( name_checked && id_checked && pw_checked ){
	  document.getElementById("inPut").disabled = false;
	  return;
	}
  document.getElementById("inPut").disabled = true;
  }
// insert Staff record
	function insertStaff(){
  	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var name= document.getElementById('uName').value;
	var id= document.getElementById('uID').value;
	var pswd= document.getElementById('uPWord').value;
	var staffType= document.getElementById('sType').value;
	
	xmlhttp.open("GET","../../report/testing/staffSQL.php?action=insert&id="+id+"&name="+name+"&pswd="+pswd+"&staffType="+staffType,true);
	xmlhttp.send();
	idlist[idlist.length]=document.getElementById("uID").value;
	document.getElementById("reset1").click();
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp2=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp2.onreadystatechange=function()
	{
  		if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    	{
		document.getElementById("show_staff").innerHTML = xmlhttp2.responseText;
		xmlhttp2.open("get","../../report/testing/showStaff.php",true);
		xmlhttp2.send();
		}
	}
	}
  
</script>
</head>
<body>

<div id="staff_result"></div>


<div id="staff_form">
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">新增用戶</div>
  <div class="CollapsiblePanelContent">
   <form name="newStaffForm" id="newStaffForm">
     <table width="650" height="10" border="0">
	   <tr>
	     <td width = "350">名稱 <font size="2">(2~45字)</font>:</td>
	     <td width = "*"><input type="text" name="uName" maxlength="46" id="uName" onKeyUp="messagerN()" /></td>
		 <td width = "*"><input type="text" name="uNm" id="uNm" size="30" style="border: none;color:#FF0000" value="*" readonly/></td>
	   </tr>

	   
	   <tr>
	     <td>ID <font size="2">(4位文字, 英文及數字)</font>:</td>
	     <td><input type="text" name="uID" maxlength="4" id="uID" onKeyUp="messagerI()"/></td>
		 <td><input type="text" name="uIDm" id="uIDm" size="30" style="border: none;color:#FF0000" value="*" readonly/></td>
	   </tr>
	   
	   <tr>
	     <td>密碼 <font size="2">(6~14字, 不能使用符號如 \&, #, *)</font>:</td>
	     <td><input type="password" name="uPWord" maxlength="15" id="uPWord" onKeyUp="messagerP()"/></td>
		 <td><input type="text" name="uPm" id="uPm" size="30" style="border: none;color:#FF0000" value="*" readonly/></td>
	   </tr>
	   
	   <tr>
	     <td>職位:</td>
	     <td><span id= "typeOption"><select name="sType" id="sType">
		<?php
		$select_stafftype = "SELECT * FROM stafftype";
  		$stafftype = mysql_query($select_stafftype);
  		$stafftype_data = mysql_fetch_assoc($stafftype);
  		$totalRows_stafftype = mysql_num_rows($stafftype);
		do {
			printf("<option value=\"%d\">%s</option>",$stafftype_data['staffType_no'],$stafftype_data['typeName']);
		}while($stafftype_data = mysql_fetch_assoc($stafftype));
		?>
		 
		 </select></span></td>
	    </tr>
      </table>
      <input type = "button" name = "inPut" id="inPut" value = "輸入" disabled onclick="insertStaff()"/>
      <input type = "reset" name = "reset" id="reset1" value = "重設" />
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>
