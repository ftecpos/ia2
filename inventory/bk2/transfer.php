<?php include("../conn/sqlconnect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增轉貨單</title>
<script src="../js/SpryCollapsiblePanel.js" type="text/javascript"></script>
<script src="../js/transfer.js" type="text/javascript"></script>
<link href="../css/wbstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
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
   if(ty == "trandetail") {
   	   objWin.style.width="700px";
   	   objWin.style.height="650px";
   } else if(ty == "confirm" || ty == "viewTran") {
	   objWin.style.width="700px";
	   objWin.style.height="450px";
   }
   objWin.style.top = "10%";
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
  if(ty == "trandetail") {
	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯轉貨單</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+=UTF8.decode(urldecode(decodeURIComponent(edit)));
  	str+='</div>';
  } else if(ty == "confirm") {
	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">確認轉貨單</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+=UTF8.decode(urldecode(decodeURIComponent(edit)));
  	str+='</div>';
  } else if(ty == "viewTran") {
	var str="";
	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">觀看轉貨單</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
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

<body onload="selectTran();disab(true);disableSubmit(true);">
<span id="showResult">
</span>

<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">新增轉貨單</div>
  <div class="CollapsiblePanelContent">
  		    <div>
           			 <form name="searchFormTest" id="searchFormTest">
                    	<fieldset>
						<legend>貨品搜尋</legend>   
						<table border="0">
								<tr>
									<td>貨品編號:</td>
    								<td><input type="text" id="productCode1" name="productCode1" size="10" /></td>
    								<td>貨品名稱:</td>
    								<td><input type="text" id="productName1" name="productName1" /></td>
								</tr>
								<tr>
									<td>分店:</td>
    								<td>
    									<select id ="branch1" name="branch1">
                        				<?php
										session_start();
											$result = mysql_query("select * from retailshop"); 
											while($row = mysql_fetch_array($result)) {
												if($row['retail_id'] == $_SESSION['retail_id'] || $_SESSION['retail_no'] == 1)
													echo "<option value='".$row['retail_id']."'>".$row['retail_id']."</option>";
											}
										?>
       				 					</select>
    								</td>
                                    <td>IMEI:</td>
                                    <td><input type="text" id="findImei" name="findImei" size="20" onkeypress="checkIMEI(event)" onkeyup="validateNumber($(this),value)" maxlength="15" /><label id="imeierror" class="error"></label><input type="hidden" id="IMEIPass" name="IMEIPass" /></td>
								</tr>
								<tr>
									<td colspan="2">種類:</td>
    								<td colspan="2"><input type="radio" id="productType1" name="productType1" value="phone" onClick="disab(false)" />電話<input type="radio" id="productType1" name="productType1" value="ass" onClick="disab(false)" />配件 <font color="red">*</font></td>
								</tr>
								<tr>
									<td colspan="4" align="right"><input type="button" name="search1" id="search1" value="尋找" onClick="processTran('getProduct')" /><input type="reset" value="重設" onClick="clearResult();disab(true)" /></td>
								</tr>
						</table>
					</fieldset>
                  </form>
          </div>
          <div id="searchResult" class="searchResult"></div><br />
          <form name="trandetail" id="trandetail" method="post">
			<div class="tranHeader">
				<table border="1">	
					<tr>
						<td>分店</td>
			    		<td>傳貨至
                     		<select id ="branchto" name="branchto" onchange="disableSubmit(false)">
    							<option value=""></option>
                       			 <?php
									$result = mysql_query("select * from retailshop"); 
									while($row = mysql_fetch_array($result)) {
										if($row['retail_id'] != $_SESSION['retail_id'])
											echo "<option value='".$row['retail_id']."'>".$row['retail_id']."</option>";
									}
								?>
       				 		</select>
                		</td>
                        <td>轉貨原因</td>
                        <td>
                        	<select id="transreson" name="transreson">
                                <option value="普通轉貨" selected="selected">普通轉貨</option>
                                <option value="不銷售退貨">不銷售退貨</option>
                                <option value="壞貨退貨">壞貨退貨</option>
                                <option value="其它">其它<input type="text" id="otherReson" name="otherReson" /></option>
                            </select>
                        </td>
					</tr>
                    </table>
                    </div>
                    <div class="tranDetail">
                    <div align="center">手提電話</div>
            			<form>
                  	 	 	<table border="1" name="tranDetailMobile" id="tranDetailMobile" class="custContent" width="100%">
                      			<thead>
                    				<tr>
                        				<td width="15%">行動</td>
                            			<td width="15%">貨品編號</td>
   										<td width="20%">貨品名稱</td>
    									<td width="20%">IMEI</td>
           							</tr>
                        		</thead>
                      		  <tbody></tbody> 
                      		</table>
                 	 </form>  
                <div align="center">配件</div>
                <form>
                  	 	 	<table border="1" name="tranDetailAcc" id="tranDetailAcc" class="custContent" width="100%">
                      			<thead>
                    				<tr>
                        				<td width="15%">行動</td>
                            			<td width="15%">貨品編號</td>
   										<td width="20%">貨品名稱</td>
    									<td width="20%">數量</td>
           							</tr>
                        		</thead>
                      		  <tbody></tbody>   
                      		</table>
                 	 </form>  
                <table border="0" width="100%">
           		<tr>
           			<td colspan="4" width="74%"></td>
           			<td width="16%"><input type="button" value="新增" name="submit1" id="submit1" onClick="insertTran();disadd('3')" /><input type="reset" value="重設" onClick="disadd('3')" /></td>
           		</tr>
		   </table>	
           </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
</script>
</body>
</html>
