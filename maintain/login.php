<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登入頁面</title>
<script src="js/login.js" type="text/javascript"></script>
<link href="css/wbstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-image: url(img/bg.jpg);
	background-repeat: no-repeat;
	background-position: center;
}
</style>
</head>
<body>
<div class="mainbody" align="center" id="mainbody">
<font color="red">POS System</font><br />
<form>
<table border="0">
<tr>
	<td>帳號:</td> 
    <td><input type="text" name="id" id="id" /></td>
</tr>
<tr>
	<td>密碼:</td> 
    <td><input type="password" name="pw" id="pw" /></td>
</tr> 
<tr>
	<td colspan="2" align="right">
    <input type="button" value="登入" name="submit1" onclick="checkLogin('login')"/>
    <input type="button" value="重設" onclick="reset1()" />
    </td> 
</tr> 
<tr><td colspan='2' align="center"><label id="error"></label></td></tr>
</table>
</form>
</div>
</body>
</html>
