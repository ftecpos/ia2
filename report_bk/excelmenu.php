<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Excel MENU</title>
<script type="text/javascript">
function genReport(){
	//alert("a");
	/*var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}*/
	var yr = document.getElementById("yr_of_report").value;
	var mth = document.getElementById("mth_of_report").value;
	if(document.getElementById("reportType").value=="saleEX"){
	  	//var url = "../../report/testing/saleExcelReport.php";
		location.href = "../ia2/report/testing/saleExcelReport.php?yr="+yr+"&mth="+mth;
	}
	if(document.getElementById("reportType").value=="inventoryEX"){
	  	//var url = "../../report/testing/saleExcelReport.php";
		location.href = "../ia2/report/testing/inventoryExcelReport.php";
	}
	//alert("b");
	//xmlhttp.open("GET",url,true);
	//xmlhttp.send();
	//alert("c");
}
</script>

</head>

<body>
<?php
$check_year = date("Y");
?>
<table>
	<tr height="10px"><td width="100px"></td><td width="25px"></td><td width="100px"></td><td width="100px"></td></tr>
	<tr><td><div align="right">報表類型:</div></td><td></td><td><div align="center"><select id="reportType"><option id="saleEX" value="saleEX" />銷售報表<option id="inventoryEX" value="inventoryEX" />存庫報表</select></div></td><td></td></tr>
    <tr height="10px"><td></td><td></td><td></td><td></td></tr>
    <tr><td><div align="right">範圍:</div></td><td></td><td><div align="right">
    <?php
		echo '<select id="mth_of_report">';
		for($i=1;$i<=12;$i++){
			echo '<option value="'.$i.'" />'.$i;
		}
		echo '</select>';
	?> 月
	</div></td><td><div align="left">/
    <?php
		echo '<select id="yr_of_report">';
		for($j=2012;$j<=$check_year;$j++){
			echo '<option value="'.$j.'" />'.$j;
		}
		echo '</select>';
	?> 年</div>
    </td></tr>
    <tr height="10px"><td></td><td></td><td></td><td></td></tr>
    <tr><td></td><td></td><td></td><td><div align="center"><input type="button" width="80px" id="genEX" value="輸出" onclick="genReport()" /></div></td></tr>
</table>


</body>
</html>
