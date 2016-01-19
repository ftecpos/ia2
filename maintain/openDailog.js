
// JavaScript Document<script language="javascript">
function showWindow(){
  if(document.getElementById("divWin"))
  {
   $("divWin").style.zIndex=999;
   $("divWin").style.display="";
  }
  else
  {
   var objWin=document.createElement("div");
   objWin.id="divWin";
   objWin.style.position="absolute";
   objWin.style.width="520px";
   objWin.style.height="220px";
   objWin.style.border="2px solid #AEBBCA";
   objWin.style.background="#FFF";
   objWin.style.zIndex=999;
   document.body.appendChild(objWin);
  }
 
  if(document.getElementById("win_bg"))
  {
   $("win_bg").style.zIndex=998;
   $("win_bg").style.display="";
  }
  else
  {
   var obj_bg=document.createElement("div");
   obj_bg.id="win_bg";
   obj_bg.className="win_bg";
   document.body.appendChild(obj_bg);
  }

  var str="";
  str+='<div class="winTitle" onMouseDown="startMove(this,event)" onMouseUp="stopMove(this,event)"><span class="title_left">Edit Recode</span><span class="title_right"><a href="javascript:closeWindow()" title="CLICK">CLOSE</a></span><br style="clear:right" mce_style="clear:right"/></div>';
  str+='<div class="winContent">名稱:<input type = "text"/><br>原價格:<input type = "text"/><br><input type = "submit"/></div>';
  $("divWin").innerHTML=str;
}
function closeWindow(){
  $("divWin").style.display="none";
  $("win_bg").style.display="none";
}
function $(o){
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