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
   if(ty == "customer") {
   		objWin.style.width="380px";
   		objWin.style.height="450px";
   } else if(ty == "acctype") {
   		objWin.style.width="300px";
   		objWin.style.height="120px";
   } else if(ty == "podetail" || ty == "trandetail") {
	   	objWin.style.width="700px";
   		objWin.style.height="650px";
   } else if(ty == "confirm") {
	   	objWin.style.width="700px";
   		objWin.style.height="450px";
   }
   if(ty =="podetail") {
	    objWin.style.top = "1%";
   		objWin.style.left = "20%";
   } else {
   objWin.style.top = "10%";
   objWin.style.left = "20%";
   }
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
  if(ty == "customer") {
 	var table = document.getElementById("custContent");
  	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯客戶資料</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+="<table border='0' id='editTable'><tbody><tr><td>客戶排序</td><td><input type='text' id='editNo' name='editNo' size='10' disabled value='"+no+"'></td></tr>";
 	str+="<tr><td>客戶編號</td><td><input type='text' id='editId' name='editId' size='10' value='"+table.rows[ri].cells[1].innerHTML+"'></td></tr><tr><td>客戶名稱</td><td><input type='text' id='editName' name='editName' value='"+table.rows[ri].cells[2].innerHTML+"'></td></tr><tr><td>地址</td><td><input type='text' id='editAdd' name='editAdd' value='"+table.rows[ri].cells[3].innerHTML+"'></td></tr><tr><td>電話</td><td><input type='text' id='editTel' name='editTel' value='"+table.rows[ri].cells[4].innerHTML+"'></td></tr><tr><td>傳真</td><td><input type='text' id='editFax' name='editFax' value='"+table.rows[ri].cells[5].innerHTML+"'></td></tr><tr><td>電郵</td><td><input type='text'' id='editEmail' name='editEmail' value='"+table.rows[ri].cells[6].innerHTML+"'></td></tr><tr><td>數期</td><td><input type='text' id='editPeriod' name='editPeriod' value='"+table.rows[ri].cells[7].innerHTML+"'></td></tr><tr><td>備注</td><td><textarea id='editRemark' name='editRemark' cols='30' rows='10' value='"+table.rows[ri].cells[8].innerHTML+"'></textarea></td></tr><tr><td><input type='button' id='editSubmit' name='editSubmit' value='更改' onclick='updateCust();closeWindow()'></td></tr></tbody></table>";
  	str+='</div>';
  } else if(ty == "acctype") {
  	var table = document.getElementById("accContent");
  	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯配件資料</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+="<table border='0' id='editTable'><tbody><tr><td>分類編號</td><td><input type='text' id='editNo' name='editNo' size='10' disabled value='"+no+"'><td></tr><tr><td>分類名稱</td><td><input type='text' id='editName' name='editName' value='"+table.rows[ri].cells[1].innerHTML+"'></tr><tr><td><input type='button' id='editSubmit' name='editSubmit' value='更改' onclick='updateType();closeWindow()'></td></tr></tbody></table>";
  	str+='</div>';
  } else if(ty == "podetail") {
	//var table = document.getElementById("poContent");
  	var str="";
  	str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">編輯購貨單</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  	str+='<div class="winContent">';
  	str+=UTF8.decode(urldecode(decodeURIComponent(edit)));
  	str+='</div>';
  } else if(ty == "trandetail") {
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