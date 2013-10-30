<?php
		session_start();
	if(!isset($_SESSION['staff_no'])){
		header('location:../no_login.html');
	} else if(!isset($_SESSION['staff_id'])){
		header('location:../no_login.html');
	} else if(!isset($_SESSION['retail_id'])){
		header('location:../no_login.html');
	} else if(!isset($_SESSION['retail_no'])){
		header('location:../no_login.html');
	}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主頁</title>
<link href="../css/main.css" type="text/css" link rel="stylesheet" media="screen"/>



<link type="text/css" href="../css/black-tie/jquery-ui-1.8.14.custom.css" rel="Stylesheet" />	

<script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>

<script type="text/javascript" src="../js/jquery-ui-1.8.14.custom.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="../script/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../script/jquery.printElement.js"></script>
<script type="text/javascript" src="../script/jquery.PrintArea.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.effects.blind.js"></script>

<script src="../js/SpryCollapsiblePanel.js" type="text/javascript"></script>
<!--<script src="http://hamster.no-ip.org:2000/socket.io/socket.io.js" rel="nofollow" type="text/javascript"></script>-->


<link href="../css/wbstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />


<script language="JavaScript">
<!-- 
var now,hours,minutes,seconds,timeValue,timeValue2;
function showclock(){
now = new Date();
hours = now.getHours();
minutes = now.getMinutes();
seconds = now.getSeconds();
timeValue = (hours >= 12) ? "Now is : PM " : "Now is : AM ";
timeValue += ((hours > 12) ? hours - 12 : hours) + " :";

timeValue += ((minutes < 10) ? " 0" : " ") + minutes + " :";
timeValue += ((seconds < 10) ? " 0" : " ") + seconds + " ";
document.getElementById("clock").innerHTML = timeValue;
timeValue2 = hours+":"+minutes+":"+seconds;
setTimeout("showclock()",1000);
}
showclock();
//-->

</script>
 
            
<style type="text/css">
        <!--
            .highlight{background:red;}
        -->
</style>
</head>

<body onLoad="showclock();" id="body">
	<div id="header" >
    	<div id = "topmenu">
			<a href="../main/main.php" class="button">Home</a>
			<a href="#" class="sales" onClick="callSales();">銷售</a>
			<a href="#" class="inven" onClick="callInventory();">倉庫</a>
			<?php
				if ($_SESSION['retail_no']==1)
					echo '<a href="#" class="maint" onClick="callSetting();">管理功能</a>';
			?>
			
			<a href="#" onClick="logout()" class="button" style="color:#ffffff; background:red;">Logout</a>
			<div id="clock"></div>
		</div><!-- //end of topmenu -->
	</div> <!-- //end of box -->
    
    <div id="userInfo">
		<span style="display:inline;">你的Staff No. :<span id="staff_no"><?php echo $_SESSION['staff_no']; ?></span></span>
        <span style="display:inline;">你的Staff ID :<span id="staff_id"><?php echo $_SESSION['staff_id']; ?></span></span>
        <span style="display:inline;">你在店舖ID : <?php echo $_SESSION['retail_id']; ?></span>
        <span style="display:inline;">你在店舖No. : <?php echo $_SESSION['retail_no']; ?></span>
    </div>
        
    <div id="middle">
    	<div class = "leftup">

		</div><!-- //end of leftup -->
	
		<div class = "right">    		
		</div><!-- //end of right -->
    
    </div><!-- //end of middle -->
        
    <div id = "footer">
		<div class = "foot">
		
        
		</div> <!-- //end of foot -->
	</div><!-- //end of footer -->
	



    
</body>
</html>
<div id="shopNo"></div>
<div id="temppp"></div>
<div id="chatForm">
	<form action="" method="post" name="charForm" id="chat">
		
	</form>
</div>

<div id="chatArea">

</div>





<script>
<!-- JQ DECARE AREA  -->
$(function() {


	

	$('#date').datepicker();
		
   		$(".sales").click(function(){rmClass();addClass('.sales'); });
	    $(".inven").click(function(){rmClass();addClass('.inven'); });
	    $(".maint").click(function(){rmClass();addClass('.maint'); });
	    $(".dend").click(function(){rmClass();addClass('.dend'); });

			
			
	
});
<!--End of JQ DECARE AREA  -->
	
<!--normal javascript area-->
function rmClass(){	$(".sales").removeClass("highlight");	$(".inven").removeClass("highlight");
			    	$(".maint").removeClass("highlight");  	$(".dend").removeClass("highlight");
}
function addClass($clsname){
    return $($clsname).addClass("highlight");
}

function callSales(){  //Call 銷售
	resetRightContentCss();
	$('.rightContent').html(null);
	total = 0.0;  //reset the total
	itemArray = [];
	reverseArray = [];

	openPrintDialog=0; canAddPayment=0;
	$('.leftmenu').replaceWith('<div class = "leftup"></div>');
	$('.rightContent').replaceWith('<div class = "right"></div>');
	$('.nofoot').replaceWith('<div class = "foot"></div>');
	
	$('.leftup').load("../sales/salesMain.php");
	$('.right').load("../sales/salesRight.php");
	$('.foot').load("../sales/salesFoot.php");
}

function callInventory(){  //Call inv功能
	resetRightContentCss();
	$('.rightContent').html(null);
	$('.leftup').replaceWith('<div class = "leftmenu"></div>');
	$('.right').replaceWith('<div class = "rightContent"></div>');
	$('.foot').replaceWith('<div class = "nofoot"></div>');
	
	$('.leftmenu').load("../inventory/setmenu.php");
}
<?php

	if ($_SESSION['retail_no']==1){
		echo 'function callSetting(){'.
		'resetRightContentCss();'.
		'$(\'.rightContent\').html(null);'.
	'$(\'.leftup\').replaceWith(\'<div class = "leftmenu"></div>\');'.
	'$(\'.right\').replaceWith(\'<div class = "rightContent"></div>\');'.
	'$(\'.foot\').replaceWith(\'<div class = "nofoot"></div>\');'.	
	'$(\'.leftmenu\').load("../maintain/setmenu.php");'.
	'}';
	}

?>

function resetRightContentCss(){
	
	$('.rightContent').css("width","1010px");
	$('.rightContent').css("position","relative");
	$('.rightContent').css("margin","0 0 0 10px");
}
function logout(){
	location.href="../logout.php";
	//location.replace("../logout.php");
}

<!--End of  normal javascript area-->
</script>
<div id="dialog" title="Information" style="display:none">
	
</div>

<script>
function scrollChatArea()
    {

    }

	socket = io.connect("127.0.0.1", {'port':3000});
	//var nickname = shopid+' '+$('#staff_id').html();
	var nickname = shopid;

	socket.on('reqNickname', function(){
		nickname = nickname;
		socket.emit('setNickname', nickname);
	});
	
	socket.on('reqNickname_err', function(){
		alert('User name overlap');
	});

	socket.on('ready', function(){
		$("#nickname").html("<strong>" + nickname + "</strong>");
		$("#chat").submit(function(e){
			//var msg = $('input[name="message"]').val();
			var msg = 'Transfer note to FTEC01';
			socket.emit('chat', msg);
			$('input[name="message"]').val('').focus();

			return false;

		});
	});

	socket.on('chat', function(data){
		$("<div><strong>" + data.nickname + "</strong> Says: " + data.msg + "</div>").hide().appendTo("#chatArea").fadeIn();
		$("#chatArea").scrollTop( $("#chatArea").innerHeight() );
	});

    socket.on('system', function(data){
    	$("<div>&gt; " + data.msg + "</div>").hide().appendTo("#chatArea").fadeIn();
		$("#chatArea").scrollTop( $("#chatArea").innerHeight() );
	});

    socket.on('pm', function(data){
        $("<div><strong>" + data.nickname + "</strong> to <strong>" + data.rec + "</strong> Msg: " + data.msg + "</div>").hide().appendTo("#chatArea").fadeIn();
    	$("#chatArea").scrollTop( $("#chatArea").innerHeight() );
		$( "#dialog" ).html('<p><strong>From: '+data.nickname+'</strong></p>'+
							'<p><strong>To: '+data.rec+'<strong>'+
							'<p>'+data.msg+'</p>');
		$( "#dialog" ).dialog({
			autoOpen: false,
			show: "blind",
			hide: "drop",
			width :220,
			position:['left','bottom'],
		});
		$( "#dialog" ).dialog( "open" );
    });

</script>