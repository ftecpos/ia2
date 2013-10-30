<?php 
  require_once('../conn/sqlconnect.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Supplier</title>
</head>
<body>
<?php
if(!empty($_GET) && isset($_GET)){
 
   //connection for insert
	$ins_conn=mysql_connect($hostname_conn, $username_conn, $password_conn);
	if (!$ins_conn){die('Could not connect : ' . mysql_error());}
    mysql_select_db($database_conn, $ins_conn);
		
	//insert data
	if($_GET["g"]!=""){
	  $sql="Insert Into supplier Values(null,'".$_GET["a"]."','".$_GET["b"]."','".$_GET["c"]."','".$_GET["d"]."','".$_GET["e"]."','".$_GET["f"]."','".$_GET["g"]."',0)";
	}
	else {
	  $sql="Insert Into supplier Values(null,'".$_GET["a"]."','".$_GET["b"]."','".$_GET["c"]."','".$_GET["d"]."','".$_GET["e"]."','".$_GET["f"]."',null,0)";
	}
	
	mysql_query("SET NAMES 'utf8'");
	if(!mysql_query($sql,$ins_conn)) {die('Error: '.mysql_error());}
	mysql_close($ins_conn);
}
?>
<form name="writing" method="post">
   <table width="700" height="10" border="0">
	   <tr>
	     <td width = "160">ID<font size="2">(10字內, 不能使用符號)</font>:</td>
	     <td width = "*">
           <input type="text" name="sID" maxlength="10" id="sID" onKeyUp="check_i()">
           <input type="text" name="sIdm" id="sIdm" style=" border: none ; color:#FF0000" value="*" readonly>
		 </td>
	   </tr><tr>
	     <td>名稱 <font size="2">(100字內)</font>:</td>
	     <td>
		   <input type="text" name="sName" maxlength="100" id="sName" onKeyUp="check_n()">
		   <input type="text" name="sNamem" id="sNamem" style=" border: none ; color:#FF0000" value="*" readonly>
		 </td>
	   </tr><tr>
	     <td>地址 <font size="2">(255字內)</font>:</td>
	     <td>
		   <input type="text" name="sAddr" maxlength="255" size="50" id="sAddr" onKeyUp="check_a()">
		   <input type="text" name="sAddrm" id="sAddrm" style=" border: none ; color:#FF0000" value="*" readonly>
		 </td>
	   </tr><tr>
	     <td>電話 <font size="2">(最大15位數字)</font>:</td>
	     <td>
		   <input type="text" name="sTel" maxlength="15" id="sTel" onKeyUp="check_t()">
		   <input type="text" name="sTelm" id="sTelm" style=" border: none ; color:#FF0000" value="*" readonly>
		 </td>
		 </tr><tr>
	     <td>傳真號碼 <font size="2">(最大15位數字)</font>:</td>
	     <td>
		   <input type="text" name="sFax" maxlength="15" id="sFax" onKeyUp="check_f()">
		   <input type="text" name="sFaxm" id="sFaxm" style=" border: none ; color:#FF0000" readonly>
		 </td>
		 </tr><tr>
	     <td>電郵地址 <font size="2">(100字內)</font>:</td>
	     <td>
		   <input type="text" name="sEM" maxlength="100" id="sEM" onKeyUp="check_m()">
		   <input type="text" name="sEMm" id="sEMm" style=" border: none ; color:#FF0000" value="*" readonly>
		 </td>
		 </tr><tr>
	     <td>數期 <font size="2">(20字內)</font>:</td>
	     <td>
		   <input type="text" name="sRem" maxlength="20" id="sRem" onKeyUp="checks()">
		   <input type="text" name="sRemm" id="sRemm" style=" border: none ; color:#FF0000" readonly>
		 </td>
	   </tr>
  </table>
       <input type = "button" name = "inPut" id="inPut" value = "輸入" onClick="submit_new_suppli()" disabled/>
       <input type = "reset" name = "reset" id="reset11" value = "重設" />
</form>
</body>
</html>