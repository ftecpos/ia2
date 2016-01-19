var shopid =localStorage.getItem("shopid");
var shopno =localStorage.getItem("shopno");

function goTologin(){
	//location.href="login.php";
	location.replace("login.php");
}
function setShopInfoSess(){
    $('#shohID').html(shopid);
    //	$('#loadSession').load("getRetailId.php?shopid="+shopid);
    $.ajax({
        url: "getRetailId.php",
        cache: false,
        dataType: 'html',
        type:'GET',
        async: false,
        data: {
            shopid : shopid,
            shopno : shopno,
        },
        error: function(xhr) {
            alert('Ajax request Error!!!!!');
        },
    });//----End of ajax------		
}