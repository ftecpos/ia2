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
        <li><a href="#" class="im5" onClick="callpo()">PO 管理</a></li>
        
	</ul>

	<div class="menutitle" >Reports</div>
	<ul>
		<li><a href="#" class="im11" onClick="call_stockin_report()">貨物入倉報表 (By KUEN)</a></li>
		<li><a href="#" class="im12" onClick="call_trans_report()">貨物轉倉報表 (By KUEN)</a></li>
		<li><a href="#" class="im13" onClick="call_sales_report_all()">銷售報表 - 總覧(By KUEN)</a></li>
		<li><a href="#" class="im14" onClick="//call_sales_report_detail()">銷售報表 - 明細 (By KUEN)</a></li>
		<li><a href="#" class="im15" onClick="call_stock_report()">庫存報表 (By KUEN)</a></li>
		<li><a href="#" class="im16" onClick="call_stock_report_overview()">庫存報表 - 總覧 (By KUEN)</a></li>
		
		
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
function callpo(){
	setAddClass('.im5');
	$('.rightContent').load("../inventory/po.php");
}
function call_stockin_report(){
	setAddClass('.im11');
	$('.rightContent').load("../inventory/stockin_report.php");
}
function call_trans_report(){
	setAddClass('.im12');
	$('.rightContent').load("../inventory/trans_report.php");
}
function call_sales_report_all(){
	setAddClass('.im13');
	$('.rightContent').load("../inventory/sales_repoart_all.php");
}
function call_sales_report_detail(){
	setAddClass('.im14');
	$('.rightContent').load("../inventory/sales_repoart_detail.php");
}
function call_stock_report(){
	setAddClass('.im15');
	$('.rightContent').load("../inventory/stock_report.php");
}
function call_stock_report_overview(){
	setAddClass('.im16');
	$('.rightContent').load("../inventory/stock_report_overview.php");
}
function setRmClass(){
    $('.im2').removeClass("selected");
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