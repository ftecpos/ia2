function checkLogin(str){
var id=document.getElementById('id').value;
var pw=document.getElementById('pw').value;
if(window.XMLHttpRequest){
	xmlhttp=new XMLHttpRequest();
}else{
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function(){
	if(xmlhttp.readyState==4 && xmlhttp.status==200){
		if(xmlhttp.responseText != "") {
			document.getElementById('error').innerHTML = xmlhttp.responseText;
		} else {
			location.href = "main/main.php";
		}
	} 
} 
xmlhttp.open("GET","maintain/getall.php?action="+str+"&id="+id+"&pw="+pw,true);
xmlhttp.send();
}
function reset1(){
	document.getElementById('id').value = "";
	document.getElementById('pw').value = "";
	document.getElementById('error').innerHTML = "";
}
function checkLoginEvent(event){
	if(event.keyCode == 13) {
		checkLogin('login');
	}
}