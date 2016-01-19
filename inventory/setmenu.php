<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>倉庫的菜單</title>
<script type="text/javascript" src="../script/jquery.multiselect.min.js"></script>
<script type="text/javascript" src="../script/jquery.multiselect.filter.js"></script>
<link href="../css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.multiselect.filter.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="dmenu">
	
           
        <?php
            if(!$_SESSION['retail_no']){
                die();
            }
            switch ($_SESSION['retail_no']){
                case 1:
                    echo '<div class="menutitle">Stock Menu</div><ul>';
                    echo '<li><a href="#" class="im8" onClick="callTransferB()">轉貨</a></li>';
                    echo '<li><a href="#" class="im20" onClick="call_new_transfer()">新增轉貨單</a></li>';
                    
                    echo '<li><a href="#" class="im4" onClick="callKuenStockIn()">進貨</a></li>';
                    echo '<li><a href="#" class="im5" onClick="callpo()">PO 管理</a></li>';
                    echo '<li><a href="#" class="im7" onClick="call_return_supplier()">退貨到供應商</a></li>';
                    echo '<li><a href="#" class="im21" onClick="call_doa()">DOA</a></li>';
                    echo '<li><a href="#" class="im22" onClick="call_view_doa()">View DOA</a></li>';
                    echo '</ul>';

                    echo '<div class="menutitle" >Reports</div>';
                    echo '<ul>';
                    echo    '<li><a href="#" class="im11" onClick="call_stockin_report()">貨物入倉報表</a></li>';
                    echo    '<li><a href="#" class="im12" onClick="call_trans_report()">貨物轉倉報表</a></li>';
                    echo    '<li><a href="#" class="im13" onClick="call_sales_report_all()">銷售報表 - 總覧</a></li>';
                    echo    '<li><a href="#" class="im14" onClick="call_sales_report_detail()">銷售報表 - 明細</a></li>';
                    echo    '<li><a href="#" class="im18" onClick="call_in_money()">收入報表</a></li>';
                    echo    '<li><a href="#" class="im15" onClick="call_stock_report()">庫存報表</a></li>';
                    echo    '<li><a href="#" class="im16" onClick="call_stock_report_overview()">庫存報表 - 總覧</a></li>';
                    echo    '<li><a href="#" class="im19" onClick="call_dayend_report()">日結報表</a></li>';
                    echo   '</ul>';
                    echo '<div class="menutitle" >To Excel</div>';
                    echo '<ul>';
                    echo    '<li><a href="#" class="im17" onClick="callExcel()">excel_link.php</a></li>';
                    echo '</ul>';
                break;
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 10:
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                case 16:
                case 17:
                case 18:
                case 19:
                case 20:
                case 21:
                case 30:
                case 31:
                case 10000:
                case 10002:
                    echo '<div class="menutitle">Stock Menu</div><ul>';
                    echo '<li><a href="#" class="im8" onClick="callTransferB()">轉貨</a></li>';
                    echo '<li><a href="#" class="im20" onClick="call_new_transfer()">新增轉貨單</a></li>';
                    echo '<li><a href="#" class="im6" onClick="callDayEnd()">日結</a></li>';
                    echo '</ul>';

                    echo '<div class="menutitle" >Reports</div>';
                    echo '<ul>';
                    echo    '<li><a href="#" class="im11" onClick="call_stockin_report()">貨物入倉報表</a></li>';
                    echo    '<li><a href="#" class="im12" onClick="call_trans_report()">貨物轉倉報表</a></li>';
                    echo    '<li><a href="#" class="im13" onClick="call_sales_report_all()">銷售報表 - 總覧</a></li>';
                    echo    '<li><a href="#" class="im14" onClick="call_sales_report_detail()">銷售報表 - 明細</a></li>';
                    echo    '<li><a href="#" class="im18" onClick="call_in_money()">收入報表</a></li>';
                    echo    '<li><a href="#" class="im15" onClick="call_stock_report()">庫存報表</a></li>';
                    echo    '<li><a href="#" class="im16" onClick="call_stock_report_overview()">庫存報表 - 總覧</a></li>';
                    echo    '<li><a href="#" class="im19" onClick="call_dayend_report()">日結報表</a></li>';
                    echo   '</ul>';
                    
                break;
                case 10001:
                    echo '<div class="menutitle" >Reports</div>';
                    echo '<ul>';
                    echo    '<li><a href="#" class="im14" onClick="call_sales_report_detail()">銷售報表 - 明細</a></li>';
                    echo '</ul>';
                    echo '<div class="menutitle" >To Excel</div>';
                    echo '<ul>';
                    echo    '<li><a href="#" class="im17" onClick="callExcel()">excel_link.php</a></li>';
                    echo '</ul>';
                break;
            
                default :
                    
                break;
            }
        ?>
</div>
</body>
</html>

<script>

function callTransfer(){
	setAddClass('.im2');
	resetRightContentCss();
	$('.rightContent').load("../inventory/transfer.php");
}
function callTransferB(){
	setAddClass('.im8');
	resetRightContentCss();
	$('.rightContent').load("../inventory/transfer_Kuen.php");
}
function callKuenStockIn(){
	setAddClass('.im4');
	resetRightContentCss();
	$('.rightContent').load("../inventory/stockin_Kuen.php");
}
function callpo(){
	setAddClass('.im5');
	resetRightContentCss();
	$('.rightContent').load("../inventory/po.php");
}
function callDayEnd(){
	setAddClass('.im6');
	resetRightContentCss();
	$('.rightContent').load("../inventory/dayend.php");
}
function call_return_supplier(){
	setAddClass('.im7');
	resetRightContentCss();
	$('.rightContent').load("../inventory/return_supplier.php");
}
function call_new_transfer(){
	setAddClass('.im20');
	resetRightContentCss();
	$('.rightContent').load("../inventory/new_transfer.php");
}
function call_doa(){
	setAddClass('.im21');
	resetRightContentCss();
	//$('.rightContent').load("../inventory/doa/doa.php");
        //open a new page and load new javascript
        window.open("../inventory/doa/doa.php");
}
function call_view_doa(){
    setAddClass('.im22');
    resetRightContentCss();
}
function call_stockin_report(){
	setAddClass('.im11');
	resetRightContentCss();
	$('.rightContent').load("../inventory/stockin_report.php");
}
function call_trans_report(){
	setAddClass('.im12');
	resetRightContentCss();
	$('.rightContent').load("../inventory/trans_report.php");
}
function call_sales_report_all(){
	setAddClass('.im13');
	resetRightContentCss();
	$('.rightContent').load("../inventory/sales_repoart_all.php");
	$('.rightContent').css("position","absolute");
	$('.rightContent').css("margin","0 0 0 230px");
	$('.rightContent').css("width","auto");
}
function call_sales_report_detail(){
	setAddClass('.im14');
	resetRightContentCss();
	$('.rightContent').load("../inventory/sales_repoart_detail.php");
	$('.rightContent').css("position","absolute");
	$('.rightContent').css("margin","0 0 0 230px");
	$('.rightContent').css("width","auto");
}
function call_stock_report(){
	setAddClass('.im15');
	resetRightContentCss();
	$('.rightContent').load("../inventory/stock_report.php");
}
function call_in_money(){
	setAddClass('.im18');
	resetRightContentCss();
	$('.rightContent').load("../inventory/in_money.php");
}
function call_stock_report_overview(){
	setAddClass('.im16');
	resetRightContentCss();
	$('.rightContent').load("../inventory/stock_report_overview.php");
	$('.rightContent').css("position","absolute");
	$('.rightContent').css("margin","0 0 0 230px");
	$('.rightContent').css("width","auto");
}
function callExcel(){
	setAddClass('.im17');
	resetRightContentCss();
	$('.rightContent').load("../report/excel_link.php");	
}
function call_dayend_report(){
	//setAddClass('.im19');
	//resetRightContentCss();
	//$('.rightContent').load("../inventory/in_money.php");	
}
function setRmClass(){
    $('.im2').removeClass("selected");
    $('.im4').removeClass("selected");
	$('.im5').removeClass("selected");
	$('.im6').removeClass("selected");
	$('.im7').removeClass("selected");
	$('.im8').removeClass("selected");
	$('.im9').removeClass("selected");
	$('.im11').removeClass("selected");
	$('.im12').removeClass("selected");
	$('.im13').removeClass("selected");
	$('.im14').removeClass("selected");
	$('.im15').removeClass("selected");
	$('.im16').removeClass("selected");
	$('.im17').removeClass("selected");
	$('.im18').removeClass("selected");
	$('.im19').removeClass("selected");
	$('.im20').removeClass("selected");
	$('.im21').removeClass("selected");
	$('.im22').removeClass("selected");
}
function setAddClass($clsname){
    setRmClass();
    $($clsname).addClass("selected");
}
function resetRightContentCss(){
	$('.rightContent').css("width","1010px");
	$('.rightContent').css("position","relative");
	$('.rightContent').css("margin","0 0 0 10px");
}

</script>