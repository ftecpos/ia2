<?php
$hostname_conn = "127.0.0.1";
$database_conn = "3shop";
$username_conn = "root";
$password_conn = "qqqwdresa";
$conn = mysql_connect($hostname_conn,$username_conn,$password_conn);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($database_conn,$conn);
mysql_query("set names 'utf8'");
?>