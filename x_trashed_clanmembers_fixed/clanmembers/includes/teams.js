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

function DelTeam(id) {
	var sure = confirm(suredelteam);
	
	if(sure){
		http.open("GET","admin_old.php?DelTeam&tid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText);
					if(result == 1) {
						document.getElementById(id).innerHTML = "";
						document.getElementById(id).style.display = "none";
					}else{
						alert(errordelteam);
					}
				}
			}
		}
		http.send(null);  
	}
}

function ChangeFlag(obj) {
	var cflag = document.getElementById("team_flag");
	cflag.src = imgfolder+"clan/flags/"+obj.value+".png"
}

function CheckForm(){
	if(document.getElementById('team_tag').value == ""){alert(fillintag);return false;}
	if(document.getElementById('team_name').value == ""){alert(fillinname);return false;}
	return true;
}
function EnableGive(){
	var field = document.assignteams.elements
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

if(teams > 1){
	clanm_jq(document).ready(function() {
	clanm_jq('#teamstable').tableDnD({
			onDrop: function(table, row) {
				document.getElementById('neworder').value = $.tableDnD.serialize();
				var list = document.getElementById('neworder').value.replace(/teamstable\[\]\=/gi,"").replace(/&/gi,"(amp)").substring(5);
				http.open("GET","admin_old.php?SaveTeamOrder&neworder="+list+"&code="+Math.floor(Math.random()*99999),true);
				http.send(null);  
			}
		});
	});
}