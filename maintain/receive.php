<?php include("../check_login.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PO</title>
<style type="text/css">
tr.w{color:#FFFFFF;}
</style>
</head>
<body>
  <table height="10" border="1">
    <tr bgcolor="#0000FF" class="w">
      <td>編號</td><td>日期</td><td>數量</td><td>售價</td><td>確認</td><td>列印</td>
    </tr>
<?php
  if(isset($confirm)){}
  print(
  " <tr>
      <td>no</td><td>date</td><td>qty</td><td>price</td>
	  <td><input type=\"submit\" name=\"confirm\" value=\"button\"</td>
	  <td><input type=\"button\" name=\"print\" value=\"button\"</td>
	</tr>");
?>
  <!--?php
  ?-->
</table>
<input type="button" name="allprint" value="列印所有">
</body>
</html>