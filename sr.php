<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登記店舖</title>
<link href="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.5.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/main.js"></script>
<script>
$(function() {
//	$('#shopDetail').load("shopRegister.php?action=getShopDetail&shopid=FTEC010");
	$('#search').click(function(){loadDetail();});
});


function getshopDetail(e){if(e.which==13)loadDetail();}
function loadDetail(){
	var pwd = $('#pwd').val();
	var shopId = document.getElementById('regShopID');
	    var shopId_d = shopId.value;
		if(shopId_d.length>0){
			$('#shopDetail').load("shopRegister.php?action=getShopDetail&shopid="+shopId_d+"&pwd="+pwd);
		}
}


</script>
<style>
.but-span{
	width:30px !important;
}
</style>
</head>

<body>

<div data-role="page" id="page">
  <div data-role="header">
    <h1>登記店舖</h1>
  </div>
  <div data-role="content">
    <div data-role="fieldcontain">
      <label for="regShopID">店舖ID:</label>
      <input type="text" name="regShopID" id="regShopID" value=""  />
	  <label for="regShopID">PWD:</label>
      <input type="password" name="pwd" id="pwd" value=""  />
      <span class="but-span"><input type="button" value="Search" id="search" class="searchBut" /></span>
      <span class="but-span"><a href="#" >  </a></span>
    </div>
    <div id="shopDetail"></div>
    <div id="shopAddDetail"></div>
  </div>
  <div data-role="footer">
    <h4>&nbsp;</h4>
  </div>
</div>
</body>
</html>
<script>
document.getElementById('regShopID').onkeydown = getshopDetail;
</script>
