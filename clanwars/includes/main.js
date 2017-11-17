
function XMLHTTPObject() {
    var xmlhttp=false;
    //If XMLHTTPReques is available
    if (XMLHttpRequest) {
        try {xmlhttp = new XMLHttpRequest();}
        catch(e) {xmlhttp = false;}
    } else if(typeof ActiveXObject != 'undefined') {
	//Use IE's ActiveX items to load the file.
        try {xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");} 
        catch(e) {
            try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
            catch(E) {xmlhttp = false;}
        }
    } else  {
        xmlhttp = false; //Browser don't support Ajax
    }
    return xmlhttp;
}
var http = new XMLHTTPObject();

function DelWar(id) {	
	var sure = confirm(suredelwar);
	if(sure){
		http.open("GET","admin.php?DelWar&wid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
					var result = http.responseText.replace(/(<([^>]+)>)/ig,"");
					if(result == '1') {
						document.getElementById("war"+id).style.display = "none";
					}else{
						alert(errordelwar);
					}
				}
			}
		}
		http.send(null);  
	}
	
	

}

function GTWar(id){
	window.location.href = "admin.php?EditWar&wid="+id;
}
