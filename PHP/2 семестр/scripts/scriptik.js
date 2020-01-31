; function req_f(id) {
    if(XMLHttpRequest)
		hr = new XMLHttpRequest();
	else if (window.ActiveXObject)
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	hr.open('GET', 'http://Lab7/Srv.php?id='+id,true);
	hr.send(null);
	
	hr.onreadystatechange=function(){
		if((hr.readyState==4) && (hr.status==200))
		{
			document.getElementById('item'+id).innerHTML=hr.responseText;
		}
	}
}

function hide(id)
{
	document.getElementById('item'+id).innerHTML="";
}