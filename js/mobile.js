
function showWindow_mobile(rid,rname,rma,rcolor,rop,rsp,rno,rls,rst,strs){
	
var allText = "";
var xmlhttp2;    
if (window.XMLHttpRequest)
  {
  xmlhttp2=new XMLHttpRequest();
  }
else
  {
  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp2.onreadystatechange=function()
  {
  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    {
    document.getElementById("txtHint3").innerHTML=xmlhttp2.responseText;
    }
  }
xmlhttp2.open("GET","/ia/maintain/get_state_info.php?qt="+rst,true);
xmlhttp2.send();


		var txtFile = new XMLHttpRequest();
		txtFile.open("GET", "mobile_description/"+rname, true);
		txtFile.onreadystatechange = function() {
  	if (txtFile.readyState === 4 && txtFile.status === 200) {  // Makes sure the document is ready to parse &&  Makes sure it's found the file.
      	allText = txtFile.responseText;
      	//document.getElementById("edesc").innerHTML = txtFile.responseText;
      	lines = txtFile.responseText.split("\n"); // Will separate each line into an array
      	document.getElementById("edesc").innerHTML = lines;
    }else{document.getElementById("edesc").innerHTML = "No Description";}
}
txtFile.send(null);


  if(document.getElementById("divWin"))
  {
   cal4("divWin").style.zIndex=999;
   cal4("divWin").style.display="";
  }
  else
  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="520px";
   objWin.style.height="600px";
   objWin.style.top = "20%";
   objWin.style.left = "10%";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
  if(document.getElementById("win_bg"))
  {
   cal4("win_bg").style.zIndex=998;
   cal4("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }
  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="Close">關閉</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+=strs;
  cal4("divWin").innerHTML=str;
}
function closeWindow(){
  cal4("divWin").style.display="none";
  cal4("win_bg").style.display="none";
}
function cal4(o){
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