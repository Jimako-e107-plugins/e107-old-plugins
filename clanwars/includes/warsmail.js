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

function addData() {
    var uname = document.getElementById("uname").value;
    var address = document.getElementById("address").value;
	if(!uname){alert(fillinusername);return;}
	if(!address){alert(fillinmail);return;}
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (address.search(emailRegEx) == -1){alert(entervalidmail);return;}
	
    http.open("GET","admin.php?AddMail&uname=" + escape(uname) + "&address=" + escape(address)+"&code="+Math.floor(Math.random()*99999),true);
    
    http.onreadystatechange = function() {
        if(http.readyState == 4) {
            if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
                if(result > 0) {
	                document.getElementById("mailsdiv").innerHTML = document.getElementById("mailsdiv").innerHTML + '<div class="mainwrap forumheader3" id="mail'+result+'"> <table border="0" cellspacing="0" cellpadding="2"> <tr> <td width="28" style="text-align:center;"> <img id="img'+result+'" src="images/active.png" border="0" value="1" onclick="ChangeStatus('+result+');" class="iconpointer"> </td> <td width="98" id="unametext'+result+'">'+uname+'</td> <td width="188" id="addresstext'+result+'">'+address+'</td> <td width="118" style="text-align:right;" nowrap> <input type="button" class="iconpointer button" value="'+edittext+'" onclick="EditMail('+result+');">&nbsp;<input type="button" class="iconpointer button" value="'+deltext+'" onclick="delData('+result+');"> </td> </tr> </table> </div> <div class="mainwrap forumheader3" id="edit'+result+'" style="display:none;"> <table border="0" cellspacing="0" cellpadding="2"> <tr> <td width="28" style="text-align:center;"> <img id="editimg'+result+'" src="images/active.png" border="0" value="1" onclick="ChangeStatus('+result+');" class="iconpointer"> </td> <td width="98"> <input type="text" id="uname'+result+'" value="'+uname+'" style="width:90px;margin:0;padding:2px;"> </td> <td width="188"> <input type="text" id="address'+result+'" value="'+address+'" style="width:180px;margin:0;padding:2px;"> </td> <td width="118" style="text-align:right;" nowrap> <input type="button" class="iconpointer button" value="'+savetext+'" onclick="saveData('+result+');">&nbsp;<input type="button" class="iconpointer button" value="'+canceltext+'" onclick="CancelMail('+result+');"> </td> </tr> </table> </div>';
					
					document.getElementById("uname").value = "";
					document.getElementById("address").value = "";
					document.getElementById("uname").focus();
					
				} else {
					alert(erroraddmail);
                }
            }
        }
    }
    http.send(null);    
}

function delData(id) {
	var sure = confirm(suredelmail);
	
	if(sure){
		http.open("GET","admin.php?DelMail&mid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
						document.getElementById("mail"+id).innerHTML = "";
						document.getElementById("mail"+id).style.display = "none";
					}else{
						alert(errordelmail);
					}
				}
			}
		}
		http.send(null);  
	}
}

function EditMail(id){
	document.getElementById("mail"+id).style.display = "none";
	document.getElementById("edit"+id).style.display = "block";
}

function CancelMail(id){
	document.getElementById("mail"+id).style.display = "block";
	document.getElementById("edit"+id).style.display = "none";
}

function saveData(id) {	
	var uname = document.getElementById("uname"+id).value;
	var address = document.getElementById("address"+id).value;
	if(!uname){alert(fillinusername);return;}
	if(!address){alert(fillinmail);return;}
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (address.search(emailRegEx) == -1){alert(entervalidmail);return;}
	
	http.open("GET","admin.php?SaveMail&mid=" + id + "&uname=" + escape(uname) + "&address=" + escape(address)+"&code="+Math.floor(Math.random()*99999),true);
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
				if(result == 1) {
					document.getElementById("unametext"+id).innerHTML = "<div>"+uname+"</div>";
					document.getElementById("addresstext"+id).innerHTML = "<div>"+address+"</div>";
				}else{
					alert(errorsavechanges);
				}
			}
		}
	}
	http.send(null); 
	CancelMail(id);
}
function ChangeStatus(id){
	img = document.getElementById("img"+id);
	editimg = document.getElementById("editimg"+id);

	http.open("GET","admin.php?MailStatus&mid=" +  parseInt(id) + "&status=" + parseInt(img.value)+"&code="+Math.floor(Math.random()*99999),true);
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
				if(result == 1) {
					if(img.value == 1){
						img.src = "images/inactive.png";
						img.title = "Inactive. Click to change";
						img.value= 0;
						editimg.src = "images/inactive.png";
						editimg.title = "Inactive. Click to change";
						editimg.value= 0;
					}else{
						img.src = "images/active.png";
						img.title = "Active. Click to change";
						img.value= 1;
						editimg.src = "images/active.png";
						editimg.title = "Active. Click to change";
						editimg.value= 1;
					}
				}else{
					alert(errorchangestatus);
				}
			}
		}
	}
	http.send(null); 
}