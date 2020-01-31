; function req_f(id) {
	hr = new XMLHttpRequest();
	
	hr.open('GET', 'http://Lab7/Srv.php?id='+id,true);
	hr.send(null);
	
	hr.onreadystatechange=function(){
		if((hr.readyState==4) && (hr.status==200))
		{
			var myObj = JSON.parse(this.responseText);
			document.getElementById('item'+id).innerHTML="<p>Year: "+myObj.prod_year+"</p> <p>Country: "+myObj.prod_country+"</p><p>Type: "+myObj.type+"</p><a onclick='hide("+myObj.id+")' href='#'>Hide</a>";
			document.getElementById('item'+id).style = "display: block";
			document.getElementById('btn').style = "display: none";
			//document.getElementById('item'+id).innerHTML=hr.responseText;
		}
	}
}

function hide(id)
{
	document.getElementById('item'+id).innerHTML="";
	document.getElementById('item'+id).style = "display: none";
	document.getElementById('btn').style = "display: block";
}