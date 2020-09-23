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

function nl2br(str) {
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ '<br>' +'$2');
}

function DelWar(id) {
	if(is_admin){
		var sure = confirm(suredelwar);	
		if(sure){
			http.open("GET","admin.php?DelWar&wid=" + id+"&code="+Math.floor(Math.random()*99999),true);
			
			http.onreadystatechange = function() {
				if(http.readyState == 4) {
					if(http.status == 200) {
						var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
						if(result == 1) {
							window.location = "clanwars.php";
						}else{
							alert(errordelwar);
						}
					}
				}
			}
			http.send(null);  
		}
	}
}

function AddComment() {
    var comment = document.getElementById("comment").value;
	
	if(!comment){alert(writecomm);return;}
	if(!username){alert(loginfirstt);return;}
	
    //By calling this file, we have saved the data.
	if(is_user){
		http.open("GET","clanwars.php?AddComment&comment=" + escape(comment) +"&wid=" + wid+"&code="+Math.floor(Math.random()*99999),true);
	}

    
    http.onreadystatechange = function() {
        if(http.readyState == 4) {
            if(http.status == 200) {
 				var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
                if(result > 0) {				
					document.getElementById("commentsdiv").style.display = "block";					
					document.getElementById("commentsdiv").innerHTML = '<div class="mainwrap forumheader3" id="comment'+result+'"> <table width="100%" cellpadding="2" cellspacing="0" border="0"> <tr> <td width="100%" align="left" valign="top"><b>'+username+'</b><br /><div id="commenttext'+result+'" style="padding-left:2px;">'+nl2br(comment)+'</div></td> <td align="right" valign="top"><input type="button" class="iconpointer button" value="'+edittext+'" onclick="EditComment('+result+')" style="margin-bottom:2px;width:100%;"><input type="button" class="iconpointer button" value="'+deltext+'" onclick="DelComment('+result+')"></td> </tr> </table> </div> <div class="mainwrap forumheader3" id="editcomment'+result+'" style="display:none;"> <table width="100%" cellpadding="2" cellspacing="0" border="0"> <tr> <td width="100%" align="left" valign="top"><b>'+username+'</b><br /><textarea id="commarea'+result+'" style="width:95%;height:75px;">'+comment+'</textarea></td> <td align="right" valign="top"><input type="button" class="iconpointer button" value="'+savetext+'" onclick="SaveComment('+result+')" style="margin-bottom:2px;width:100%;"><input type="button" class="iconpointer button" value="'+canceltext+'" onclick="CancelComment('+result+')"></td> </tr> </table> </div>' + document.getElementById("commentsdiv").innerHTML;
					
					document.getElementById("comment").value = "";
				} else {
					alert(erroraddcomm);
                }
            }
        }
    }
    http.send(null);    
}
function DelComment(id) {

	var sure = confirm(suredelcomm);
	
	if(sure){
		if(is_admin){
			http.open("GET","admin.php?DelComment&cid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		}else if(is_user && username !=""){
			http.open("GET","clanwars.php?DelComment&cid=" + id + "&wid=" + wid + "&code="+Math.floor(Math.random()*99999),true);
		}else{
			return;
		}
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
					var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
					if(result == '1') {
						document.getElementById("comment"+id).innerHTML = "";
						document.getElementById("comment"+id).style.display = "none";
					}else{
						alert(errordelcomm);
					}
				}
			}
		}
		http.send(null);  
	}
}
function DelAllComments(id) {
	if(is_admin){
		var sure = confirm(suredelallcomm);
		
		if(sure){
			http.open("GET","admin.php?DelWarComments&wid=" + wid+"&code="+Math.floor(Math.random()*99999),true);		
			http.onreadystatechange = function() {
				if(http.readyState == 4) {
					if(http.status == 200) {
						var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
						if(result == '1') {
							document.getElementById("commentsdiv").innerHTML = "";
							document.getElementById("commentsdiv").style.display = "none";
							document.getElementById("delallcommsdiv").style.display = "none";							
						}else{
							alert(errordelcomms);
						}
					}
				}
			}
		}
		http.send(null);  
	}
}
function EditComment(id){
	document.getElementById("comment"+id).style.display = "none";
	document.getElementById("editcomment"+id).style.display = "";
}
function CancelComment(id){
	document.getElementById("comment"+id).style.display = "";
	document.getElementById("editcomment"+id).style.display = "none";
}
function SaveComment(id) {	
	var comment = document.getElementById("commarea"+id).value;
	if(!comment){alert(writecomm);return;}
	if(!username){alert(loginfirstt);return;}	
	
	if(is_admin){
		http.open("GET","admin.php?SaveComment&cid=" + id + "&comment=" + escape(comment)+"&code="+Math.floor(Math.random()*99999),true);
	}else if(is_user){
		if(!username){return;}
		http.open("GET","clanwars.php?SaveComment&cid=" + id + "&wid=" + wid + "&comment=" + escape(comment)+"&code="+Math.floor(Math.random()*99999),true);
	}else{
		return
	}
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
				var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
				if(result == '1') {
					document.getElementById("commenttext"+id).innerHTML = "<div>"+nl2br(comment)+"</div>";
				}else{
					alert(errorsavecomm);
				}
			}
		}
	}
	http.send(null); 
	CancelComment(id);
}

//LINEUP
function removeItem(originalArray, itemToRemove) {
var j = 0;
	while (j < originalArray.length) {
		if (originalArray[j] == itemToRemove) {
			originalArray.splice(j, 1);
		} else {
			j++; 
		}
	}
}
function in_array(needle, haystack) {
    var key = ''; 
	for (key in haystack) {
		if (haystack[key] == needle) {               
			return true;
		}
	}    
    return false;
}
function BuildLineUp(lineup, start, end){
	var content = "";
	for(i=start;i<end;i++){
		if(lineup[i] != ""){
			content += ", " + lineup[i];
		}
	}
	return content.substring(2);
}
function AddToLineup() {	
	var selval = parseInt(document.getElementById('availability').value);
	if(is_user && username !=""){
		http.open("GET","clanwars.php?AddToLineup&wid=" + wid +"&avail="+selval+"&code="+Math.floor(Math.random()*99999),true);
	}else{
		return;
	}
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
				var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
				if(result == '1') {
					var content;
					var end = 0;
					if(selval == 1){
						//available
						content = document.getElementById("available").innerHTML;
						if(usesubs == "1" && document.getElementById("subs").innerHTML !=""){
							content += ", " + document.getElementById("subs").innerHTML;
						}
						lineup = content.split(", ");
						lineup[lineup.length] = username;
						end = lineup.length;
						if(end > players && usesubs == "1"){
							if(players>0){
								end = players;
								document.getElementById("subs").innerHTML = BuildLineUp(lineup, end, lineup.length);
								document.getElementById("trsubs").style.display = "";
							}
						}if(usesubs == "0"){
							lineup.sort();
						}
						document.getElementById("available").innerHTML = BuildLineUp(lineup, 0, end);
						document.getElementById("travailable").style.display = "";
					}else {						
						//unavailable
						content = document.getElementById("unavailable").innerHTML;
						lineup = content.split(", ");						
						lineup[lineup.length] = username;
						lineup.sort();
						document.getElementById("unavailable").innerHTML = BuildLineUp(lineup, 0, lineup.length);
						document.getElementById("trunavailable").style.display = "";
					}
					
					document.getElementById("addlineup").style.display = "none";
					document.getElementById("dellineup").style.display = "block";
				}else{
					alert(erroraddlineup);
				}
			}
		}
	}
	http.send(null);
}

function CheckContent(id){
	if(document.getElementById(id).innerHTML.replace(' ','').replace(',','') == ""){
		document.getElementById("tr"+id).style.display = "none";
	}else{
		document.getElementById("tr"+id).style.display = "";
	}
}

function DelFromLineup() {	
	if(is_user && username !=""){
		http.open("GET","clanwars.php?DelFromLineup&wid=" + wid +"&code="+Math.floor(Math.random()*99999),true);
	}else{
		return;
	}
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
				var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,""));
				if(result == '1') {
					var content;
					var end = 0;
					//available
					content = document.getElementById("available").innerHTML;
					if(usesubs == "1"){
						content += ", " + document.getElementById("subs").innerHTML;
					}
					lineup = content.split(", ");
					if(in_array(username, lineup)){
						removeItem(lineup, username);
						end = lineup.length;
						if(end > players && usesubs == "1" && players>0){
							end = players;
							document.getElementById("subs").innerHTML = BuildLineUp(lineup, end, lineup.length);
							CheckContent("subs");
						}else if(usesubs == "1"){
							document.getElementById("subs").innerHTML = "";							
							document.getElementById("trsubs").style.display = "none";
						}
						document.getElementById("available").innerHTML = BuildLineUp(lineup, 0, end);
						CheckContent("available");
					}
					//subs
					if(usesubs == "1"){
						content = document.getElementById("subs").innerHTML;
						lineup = content.split(", ");
						if(in_array(username, lineup)){
							removeItem(lineup, username);
							document.getElementById("subs").innerHTML = BuildLineUp(lineup, 0, lineup.length);
							CheckContent("subs");
						}
						}
					//unavailable
					content = document.getElementById("unavailable").innerHTML;
					lineup = content.split(", ");
					if(in_array(username, lineup)){
						removeItem(lineup, username);
						document.getElementById("unavailable").innerHTML = BuildLineUp(lineup, 0, lineup.length);
						CheckContent("unavailable");
					}
					
					document.getElementById("addlineup").style.display = "block";
					document.getElementById("dellineup").style.display = "none";
				}else{
					alert(errorremovelu);
				}
			}
		}
	}
	http.send(null);
}