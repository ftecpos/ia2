<?php include("../check_login.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
</head>
<body>
<?php

  require_once('../conn/sqlconnect.php');
	
 	if(!empty($_GET) && isset($_GET)){
    
  //connection for insert
	$ins_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
	if (!$ins_conn){die('Could not connect : ' . mysql_error());}
    mysql_select_db($database_conn, $ins_conn);
	
	//insert data
	$sql="Insert Into staff Values(null,'".$_GET['b']."','".$_GET['c']."','".$_GET['a']."',null,".$_GET['d'].",null)";
	mysql_query("SET NAMES 'utf8'");
	if(!mysql_query($sql,$ins_conn)) {die('Error: '.mysql_error());}
	mysql_close($ins_conn);
  }
  //Open table "stafftype"
  $select_stafftype = "SELECT * FROM stafftype";
  $stafftype = mysql_query($select_stafftype, $conn) or die(mysql_error());
  $stafftype_data = mysql_fetch_assoc($stafftype);
  $totalRows_stafftype = mysql_num_rows($stafftype);
  ?>
  <form name="new_user" method="post">
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
	     <td><select id="sType" name="sType">
		 <?php
		 do {
		   printf("<option value=\"%d\">%s</option>",$stafftype_data['staffType_no'],$stafftype_data['typeName']);
		 }while($stafftype_data = mysql_fetch_assoc($stafftype));
		 ?>
		 </select></td>
	    </tr>
      </table>
      <input type = "button" name = "inPut" id="inPut" value = "新增" onClick="submiter()" disabled/>
      <input type = "reset" name = "reset" id="reset1" value = "重設" />
    </form>
</body>
</html>