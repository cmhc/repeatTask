var request;
function get(url,cb){
	if(window.XMLHttpRequest)
		request = new window.XMLHttpRequest();
	else
		request = new ActiveXObject("Microsoft.XMLHTTP");
	request.open("GET",url,true);
	request.send();
	request.onreadystatechange = cb;
}