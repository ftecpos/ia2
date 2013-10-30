<?php include("../check_login.php");?>
<?php include("../conn/sqlconnect.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增購貨單</title>
<script src="../js/po.js" type="text/javascript"></script>
<script type="text/javascript">
    
$('#po_updateforshop_form').dialog('distory');
    var po_updateforshop_option = {
        autoOpen:false,  //defult must be false
        height: 125,
        width: 340,
        closeOnEscape: true,
        modal: true,
        resizable: false,
        //close : function(){ $('.rightContent').html(null);},
        buttons : {
            "確定": function() {
                
                var poshopfor = $('#po_updateforshop_shop #shop_list').val();
                bValid = false;
                if (poshopfor!=0){
                    
                    /*
                    $.ajax({
                        url: "../inventory/invGet.php?action=upposhopfor",
                        cache: false,
                        async: false,
                        dataType: 'script',
                        type:'GET',
                        data: {	
                            poshopfor : poshopfor,
                        },
                        error: function(xhr) {
                            alert('Ajax request Error!!!!!');
                        },
                        success: function(response) {
                            if(upPoState[0]==0)
                                $("#si_co_errMsg").html("員工編號不存在").css({"display":"block","color":"red"}).delay(1000).fadeOut(300);
                            else if(upPoState[0]==1){
                                $("#si_co_form").dialog("close");
                                findPOHead($('#si_poNo').val());
                            }
                        },
                    });//----End of ajax------
                    */
                   $('#costretailid').val(poshopfor);
                   $(this).dialog("close");
                } else {
                    alert("請選擇店舖");
                }
            },
            "取消": function() {
                $('.rightContent').html(null);
                $(this).dialog("close");
            },
        },
    };
$('#po_updateforshop_form').dialog(po_updateforshop_option);
$('.ui-widget-header').hide();
$('#po_updateforshop_bottom')
    .html('<fieldset>'+
            '<table cellpadding="5">'+
            '   <tr>'+
            '       <td><label for="po_updateforshop_shop" >店舗   </label></td>'+
            '       <td><div id="po_updateforshop_shop" ></div></td>'+
            '   </tr>'+
            '</table>'+
            '</fieldset>'+
            '<div id="po_updateforshop_errMsg"></div>');
$.ajax({
    url: "../inventory/invGet.php?action=get_shop_list",
    cache: false,
    dataType: 'html',
    type:'POST',
    async: false,
    data: { all_shop:1
    },
    error: function(xhr) {
        alert('Ajax request Error!!!!!');
    },
    success: function(response){
        $('#po_updateforshop_shop').html(response);
        $('#po_updateforshop_form').dialog('open');
    }
});//----End of ajax------

function urldecode(str) {
    var hash_map = {}, ret = str.toString(), unicodeStr='', hexEscStr='';    
    var replacer = function(search, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(search);
        return tmp_arr.join(replace);
    };    
	    // The hash_map is identical to the one in urlencode.
    hash_map["'"]   = '%27';
    hash_map['(']   = '%28';
    hash_map[')']   = '%29';
    hash_map['*']   = '%2A';
    hash_map['~']   = '%7E';
    hash_map['!']   = '%21';
    hash_map['%20'] = '+';
    hash_map['\u00DC'] = '%DC';
    hash_map['\u00FC'] = '%FC';
    hash_map['\u00C4'] = '%D4';
    hash_map['\u00E4'] = '%E4';
    hash_map['\u00D6'] = '%D6';
    hash_map['\u00F6'] = '%F6';
    hash_map['\u00DF'] = '%DF';
    hash_map['\u20AC'] = '%80';
    hash_map['\u0081'] = '%81';
    hash_map['\u201A'] = '%82';
    hash_map['\u0192'] = '%83';
    hash_map['\u201E'] = '%84';
    hash_map['\u2026'] = '%85';
    hash_map['\u2020'] = '%86';
    hash_map['\u2021'] = '%87';
    hash_map['\u02C6'] = '%88';
    hash_map['\u2030'] = '%89';
    hash_map['\u0160'] = '%8A';
    hash_map['\u2039'] = '%8B';
    hash_map['\u0152'] = '%8C';
    hash_map['\u008D'] = '%8D';
    hash_map['\u017D'] = '%8E';
    hash_map['\u008F'] = '%8F';
    hash_map['\u0090'] = '%90';
    hash_map['\u2018'] = '%91';
    hash_map['\u2019'] = '%92';
    hash_map['\u201C'] = '%93';
    hash_map['\u201D'] = '%94';
    hash_map['\u2022'] = '%95';
    hash_map['\u2013'] = '%96';
    hash_map['\u2014'] = '%97';
    hash_map['\u02DC'] = '%98';
    hash_map['\u2122'] = '%99';
    hash_map['\u0161'] = '%9A';
    hash_map['\u203A'] = '%9B';
    hash_map['\u0153'] = '%9C';
    hash_map['\u009D'] = '%9D';
    hash_map['\u017E'] = '%9E';
    hash_map['\u0178'] = '%9F';
	// on decodeURIComponent failure.
	hash_map['<'] 	   = '%3C';
	hash_map['>'] 	   = '%3E';
	hash_map['/'] 	   = '%2F';
	hash_map['@']	   = '%40'; 
	hash_map['e']	   = '%E9';	
	hash_map[' ']	   = '%20';
    for (unicodeStr in hash_map) {
        hexEscStr = hash_map[unicodeStr]; // Switch order when decoding
        ret = replacer(hexEscStr, unicodeStr, ret); // Custom replace. No regexing
    }   
    // End with decodeURIComponent, which most resembles PHP's encoding functions
    //ret = decodeURIComponent(ret);
    return ret;
}
UTF8 = {
	decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
};
function showWindow(no,ty,ri,edit){
  if(document.getElementById("divWin"))
  {
   call("divWin").style.zIndex=999;
   call("divWin").style.display="";
  }
  else
  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="700px";
   objWin.style.height="650px";
   objWin.style.top = "1%";
   objWin.style.left = "20%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_bg"))
  {

   call("win_bg").style.zIndex=998;
   call("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }
  if(ty == "podetail") {
	//var table = document.getElementById("poContent");
  	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯購貨單</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+=UTF8.decode(urldecode(decodeURIComponent(edit)));
  	str+='</div>';
  }
  call("divWin").innerHTML=str;
}
function closeWindow(){
  call("divWin").style.display="none";
  call("win_bg").style.display="none";
}
function call(o){
  return document.getElementById(o);
}
function startMove(o,e){
  var wb;
  if(document.all && e.button==1) wb=true;
  else if(e.button==0) wb=true;
  if(wb)
  {
    var x_pos=parseInt(e.clientX-o.parentNode.offsetLeft);
    var y_pos=parseInt(e.clientY-o.parentNode.offsetTop);
    if(y_pos<=o.offsetHeight)
    {
      document.documentElement.onmousemove=function(mEvent)
      {
        var eEvent=(document.all)?event:mEvent;
        o.parentNode.style.left=eEvent.clientX-x_pos+"px";
        o.parentNode.style.top=eEvent.clientY-y_pos+"px";
      }
    }
  }
}
function stopMove(o,e){
  document.documentElement.onmousemove=null;
}
</script>
</head>
<body onLoad="disab(true);disadd('1');selectPo()">
<span id="showResult">
</span>
<span id="show2">
</span>
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">新增購貨單</div>
  <div class="CollapsiblePanelContent">
	<div class="productSearch">
		<fieldset>
		<legend>貨品搜尋</legend>
		<table border="0">
			<form name="searchForm">
			<tr>
				<td>貨品編號:</td>
    			<td><input type="text" id="productCode" name="productCode" size="10" /></td>
    			<td>貨品名稱:</td>
    			<td><input type="text" id="productName" name="productName" /></td>
			</tr>
			<tr>
				<td>分店:</td>
    			<td>
    				<select id ="branch" name="branch">
                        <?php
							$result = mysql_query("select * from retailshop where retailShop_no=1"); 
							while($row = mysql_fetch_array($result)) {
								echo "<option value='".$row['retail_id']."'>".$row['retail_id']."</option>";
							}
						?>
       				 </select>
    			</td>
			</tr>
			<tr>
				<td colspan="2">種類:</td>
    			<td colspan="2"><input type="radio" id="productType" name="productType" value="phone" onClick="disab(false)" />電話<input type="radio" id="productType" name="productType" value="ass" onClick="disab(false)" />配件 <font color="red">*</font></td>
			</tr>
			<tr>
				<td colspan="4" align="right"><input type="button" name="search" id="search" value="尋找" onClick="findPro('getProduct')" /><input type="reset" value="重設" onClick="clearResult();disab(true)" /></td>
			</tr>
			</form>
		</table>
		</fieldset>
	</div>
	<br />
	<div id="searchResult" class="searchResult">
	</div>
	<br />
	<form name="podetail" method="post">
	<div class="poHeader">
		<table border="1" width="100%">
			<tr>
				<td width="30%">供應商編號:</td>
    			<td>
    				<select id="supplierNo" onChange="findPro('getSupplier');disadd('2')">
       					<?php
       						$result = mysql_query("select * from supplier"); 
							while($row = mysql_fetch_array($result)) {
								echo "<option value='".$row['supplier_id']."'>".$row['supplier_id']."</option>";
							}
       					?>
       				</select>
   				</td>
			</tr>
			<tr>
				<td>供應商名稱:</td>
    			<td><label id="supplierName"></label></td>
			</tr>
			<tr>
				<td>供應商電話:</td>
			    <td><label id="supplierTel"></label></td>
			</tr>        
			</table>
	</div>
	<br />
	<div class="poDetail">
    		<div align="center">手提電話</div>
        	<table border="1" width="100%" id='poDetailMobile' name='poDetailMobile' class="custContent">
				<thead>
        			<tr>
					<td width="6%">行動</td>
					<td width="20%">貨品編號</td>
   					<td width="40%">貨品名稱</td>
    				<td width="15%">數量</td>
    				<td width="10%">成本</td>
                    <td width="10%">總數</td>
           			</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
                	<tr>
						<td colspan="4"></td>
    					<td>小計</td>
    					<td><label id="mobileSubTotal"></label></td>
					</tr>
               </tfoot>
           </table>
           <div align="center">配件</div>
           <table border="1" width="100%" id='poDetailAcc' name='poDetailAcc' class="custContent">
           		<thead>
        			<tr>
					<td width="6%">行動</td>
					<td width="20%">貨品編號</td>
   					<td width="40%">貨品名稱</td>
    				<td width="15%">數量</td>
    				<td width="10%">成本</td>
                    <td width="10%">總數</td>
           			</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
                	<tr>
						<td colspan="4"></td>
    					<td>小計</td>
    					<td><label id="accSubTotal"></label></td>
					</tr>
               </tfoot>
           </table>
           <table border="0" width="100%">
           		<tr>
           			<td colspan="3" width="74%"></td>
           			<td width="10%">總額&nbsp;&nbsp;&nbsp;<label id="total"></label></td>
           			<td width="16%"><input type="button" value="新增" name="submit1" onClick="addpo($('#costretailid').val());disadd('3')" /><input type="reset" value="重設" onClick="disadd('3')" /></td>
           		</tr>
		   </table>	
	</div>
	</form>
	</div>
</div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>

<script type="text/javascript">
    $('#printPO').dialog('destroy');
    var dialogOption50 = {
        autoOpen:false,  //defult must be false
        height: 150,
        width: 350,
        closeOnEscape: true,
        modal: true,
        buttons : {
            "列印": function() {
                    printPO(print_po_no);
                    $( this ).dialog("close");					
            },
            "不列印": function() {
                    $( this ).dialog("close");
            },
        },
    };//end of dialogOption
    $('#printPO').dialog(dialogOption50);//---End of printPO dialog------------------------------
	
</script>
<!--// printPO 張form-->
<div id="printPO" title="列印PO" style="display:none;">

	<fieldset>
    <p>要列印PO嗎? </p>	
    </fieldset>


</div>

<div id="po_updateforshop_form" title="請選擇PO所屬店舗" style="display:none;">
	<div id="po_updateforshop_bottom">
            
	</div>
</div>
<input type="hidden" id="costretailid" value="1" />