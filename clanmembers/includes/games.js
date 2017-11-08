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

function DelGame(id) {
	var sure = confirm(suredelgame);
	
	if(sure){
		http.open("GET","admin.php?DelGame&gid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText);
					if(result == 1) {
						document.getElementById(id).innerHTML = "";
						document.getElementById(id).style.display = "none";
					}else{
						alert(errordelgame);
					}
				}
			}
		}
		http.send(null);  
	}
}

function CheckForm(){
	if(document.getElementById('gname').value !=""){
		return true;
	}else{
		alert(fillinname);
		return false;
	}
}
function EnableGive(){
	var field = document.assigngames.elements
	var enable = false
	var i;
	for(i=0;i<field.length;i++){
		if(field[i].checked){
			enable = true;
		}
	}
	if(enable){
		document.getElementById('give1').disabled = false;
		document.getElementById('give2').disabled = false;
	}else{
		document.getElementById('give1').disabled = true;
		document.getElementById('give2').disabled = true;
	}
}

if(games > 1){
	clanm_jq(document).ready(function() {
	clanm_jq('#gamestable').tableDnD({
			onDrop: function(table, row) {
				document.getElementById('neworder').value = $.tableDnD.serialize();
				var list = document.getElementById('neworder').value.replace(/gamestable\[\]\=/gi,"").replace(/&/gi,"(amp)").substring(5);
				http.open("GET","admin.php?SaveGameOrder&neworder="+list+"&code="+Math.floor(Math.random()*99999),true);
				http.send(null);  
			}
		});
	});
}