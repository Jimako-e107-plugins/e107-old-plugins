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

function Unsubscribe() {
	if(is_user && username !=""){
		var sure = confirm(sureunsubscr);	
		if(sure){
			var sure2 = confirm(unsubops);	
			if(sure2){
				http.open("GET","clanwars.php?Unsubscribe&del=1&code="+Math.floor(Math.random()*99999),true);
				
				http.onreadystatechange = function() {
					if(http.readyState == 4) {
						if(http.status == 200) {
							var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
							if(result == '1') {
								confirm(mailremoved);	
							    document.getElementById("warsmaildiv").innerHTML = "<br /><a href='javascript:Subscribe(0);'>"+subscr+"</a>";
							}else{
								alert(errorunsub);
							}
						}
					}
				}
				http.send(null);  
			}else{
				http.open("GET","clanwars.php?Unsubscribe&del=0&code="+Math.floor(Math.random()*99999),true);
				
				http.onreadystatechange = function() {
					if(http.readyState == 4) {
						if(http.status == 200) {
							var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
							if(result == '1') {
								confirm(emaildeact);	
							    document.getElementById("warsmaildiv").innerHTML = "<br /><a href='javascript:Subscribe(1);'>"+reactmail+"</a>";
							}else{
								alert(errorunsub);
							}
						}
					}
				}
				http.send(null); 
			}
		}
	}
}

function Subscribe(val) {
	if(is_user && username !=""){
		if(val == 1){
			http.open("GET","clanwars.php?Subscribe&react=1&code="+Math.floor(Math.random()*99999),true);
			
			http.onreadystatechange = function() {
				if(http.readyState == 4) {
					if(http.status == 200) {
						var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
						if(result == '1') {
							confirm(emailisreact);	
							document.getElementById("warsmaildiv").innerHTML = "<br /><a href='javascript:Unsubscribe();'>"+unsub+"</a>";
						}else{
							alert(errorreact);
						}
					}
				}
			}
			http.send(null);  
		}else{
			var email = prompt(enteremail, "");
			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
   			if (email.search(emailRegEx) == -1){alert(entervalid);Subscribe(0);return;}
			http.open("GET","clanwars.php?Subscribe&email=" + escape(email)+"&code="+Math.floor(Math.random()*99999),true);
			
			http.onreadystatechange = function() {
				if(http.readyState == 4) {
					if(http.status == 200) {
						var result = http.responseText.replace(/(<([^>]+)>)/ig,"");
						if(result == 'userinlist') {
							alert(alrsubscr);
						}else if(result == 'emailinlist') {
							alert(emailinlist);
						}else if(result == '1') {
							if(emailact){
								confirm(emailsent);	
							}else{
								confirm(aresubscr);	
							}
							document.getElementById("warsmaildiv").innerHTML = "<br /><a href='javascript:Unsubscribe();'>"+unsub+"</a>";
						}else{
							alert("Error while subscribing...");
						}
					}
				}
			}
			http.send(null);
		}
	}
}
