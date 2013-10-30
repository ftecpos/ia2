<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>倉庫的菜單</title>
</head>

<body>
<div id="dmenu">
	<div class="menutitle">Stock Menu</div>
	<ul>
		<li><a href="#" class="im2" onClick="callTransfer();">轉貨 (By WING)</a></li>            
		<li><a href="#" class="im4" onClick="callKuenStockIn()">進貨 (By KUEN)</a></li>
        <li><a href="#" class="im5" onClick=""></a></li>
        <li><a href="#" class="im6" onClick=""></a></li>
	</ul>

	<div class="menutitle" >Reports</div>
	<ul>
		<li><a href="#" class="im11" onClick="">貨物入倉報表 (By KUEN)</a></li>
		<li><a href="#" class="im12" onClick="call_trans_report()">貨物轉倉報表 (By KUEN)</a></li>
		<li><a href="#" class="im13" onClick="">銷售報表 - 總覧(By KUEN)</a></li>
		<li><a href="#" class="im14" onClick="">銷售報表 - 明細 (By KUEN)</a></li>
		<li><a href="#" class="im15" onClick="">庫存報表 (By KUEN)</a></li>
		<li><a href="#" class="im16" onClick="">庫存報表 - 總覧 (By KUEN)</a></li>
		<li><a href="#" class="im17" onClick="">貨物轉倉報表 (By KUEN)</a></li>
		<li><a href="#" class="im18" onClick="">貨物轉倉報表 (By KUEN)</a></li>
		
	</ul>
</div>
</body>
</html>

<script>
function callTransfer(){
	setAddClass('.im2');
	$('.rightContent').load("../inventory/transfer.php");
}
function callKuenStockIn(){
	setAddClass('.im4');
	$('.rightContent').load("../inventory/stockin_Kuen.php");
}
function callnewass(){
	setAddClass('.im5');
	$('.rightContent').load("../maintain/newasscessories.php");
}
function callnewshop(){
	setAddClass('.im6');
	$('.rightContent').load("../maintain/newshop.php");
}
function call_trans_report(){
	setAddClass('.im12');
	$('.rightContent').load("../inventory/trans_report.php");
	
	
}

function setRmClass(){
	$('.im1').removeClass("selected");
    $('.im2').removeClass("selected");
    $('.im3').removeClass("selected");
    $('.im4').removeClass("selected");
	$('.im5').removeClass("selected");
	$('.im6').removeClass("selected");
	$('.im11').removeClass("selected");
	$('.im12').removeClass("selected");
	$('.im13').removeClass("selected");
	$('.im14').removeClass("selected");
	$('.im15').removeClass("selected");
	$('.im16').removeClass("selected");
	$('.im17').removeClass("selected");
	$('.im18').removeClass("selected");
}
function setAddClass($clsname){
	setRmClass();
    $($clsname).addClass("selected");
}

</script>