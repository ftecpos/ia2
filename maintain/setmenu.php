<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理功能的菜單</title>
</head>

<body>
<div id="dmenu">
	<div class="menutitle">Maintain Menu</div>
	<ul>
		<li><a href="#" class="sm1" onClick="callNewCust()">客戶管理</a></li>

		<li><a href="#" class="sm3" onClick="callacctype()">配件分類管理</a></li>
		<li><a href="#" class="sm5" onClick="callnewacc()">配件貨物管理</a></li>
		<li><a href="#" class="sm4" onClick="callnewmobile()">手提電話管理</a></li>
        <li><a href="#" class="sm6" onClick="callnewshop()">店舖管理</a></li>
        <!--<li><a href="#" class="sm7" onClick="callAlertTable()">alter_table_info.php</a></li>-->
        <!--<li><a href="#" class="sm8" onClick="callbuildone()">test build_one.php</a></li>-->


        <li><a href="#" class="sm9" onClick="callmodSupplier()">供應商資料管理</a></li>
        <li><a href="#" class="sm10" onClick="callmodStaff()">員工管理</a></li>
		<!--<li><a href="#" class="sm11" onClick="callmodInvState()">單據狀態管理</a></li>-->
		<!--<li><a href="#" class="sm12" onClick="callmodProdState()">產品狀態管理</a></li>-->
		<!--<li><a href="#" class="sm13" onClick="callmodTransState()">轉貨狀態管理</a></li>-->
        
	</ul>

	<ul>
		<div class="menutitle" ></div>
	</ul>
</div>
</html>

<script>
function callNewCust(){
	setAddClass('.sm1');
	$('.rightContent').load("../maintain/newcustomer.php");
//$('.rightContent').load("http://wing735.no-ip.org/IA/newcustomer.php");
}


function callacctype(){
	setAddClass('.sm3');
	$('.rightContent').load("../maintain/acctype.php");
}
function callnewmobile(){
	setAddClass('.sm4');
	$('.rightContent').load("../maintain/newmobile.php");
}
function callnewacc(){
	setAddClass('.sm5');
	$('.rightContent').load("../maintain/newasscessories.php");
}
function callnewshop(){
	setAddClass('.sm6');
	$('.rightContent').load("../maintain/newshop.php");
}
function callAlertTable(){
	setAddClass('.sm7');
	$('.rightContent').load("../maintain/alter_table_info.php");
}
function callbuildone(){
	setAddClass('.sm8');
	$('.rightContent').load("../maintain/buildone.php");
}

function callmodSupplier(){
	setAddClass('.sm9');
	$('.rightContent').load("../maintain/modSupplier.php");
}
function callmodStaff(){
	setAddClass('.sm10');
	$('.rightContent').load("../maintain/modStaff.php");
}
function callmodInvState(){
	setAddClass('.sm11');
	$('.rightContent').load("../maintain/invoicestate.php");
}
function callmodProdState(){
	setAddClass('.sm12');
	$('.rightContent').load("../maintain/productstate.php");
}
function callmodTransState(){
	setAddClass('.sm13');
	$('.rightContent').load("../maintain/transstate.php");
}



function setRmClass(){
	$('.sm1').removeClass("selected");

    $('.sm3').removeClass("selected");
    $('.sm4').removeClass("selected");
	$('.sm5').removeClass("selected");
	$('.sm6').removeClass("selected");
	$('.sm7').removeClass("selected");
	$('.sm8').removeClass("selected");


	$('.sm9').removeClass("selected");
	$('.sm10').removeClass("selected");
	$('.sm11').removeClass("selected");
	$('.sm12').removeClass("selected");
	$('.sm13').removeClass("selected");
}

function setAddClass($clsname){
	setRmClass();
    $($clsname).addClass("selected");
}

</script>