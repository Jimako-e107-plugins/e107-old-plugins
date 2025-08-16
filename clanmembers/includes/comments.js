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
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ '<br />' +'$2');
}

function AddComment() {
    var comment = document.getElementById("comment").value;
	
	if(!comment){alert(writecomm);return;}
	if(!userid){alert(loginfirstt);return;}
	
    //By calling this file, we have saved the data.
	if(userid > 0){
		http.open("GET","admin.php?AddComment&comment=" + escape(comment) +"&memberid=" + memberid+"&code="+Math.floor(Math.random()*99999),true);
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
	if(!is_admin && userid == 0){
		return;
	}
	var sure = confirm(suredelcomm);
	
	if(sure){
		http.open("GET","admin.php?DelComment&cid=" + id + "&memberid=" + memberid + "&userid=" + userid + "&code="+Math.floor(Math.random()*99999),true);
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
	
	if(is_admin || userid > 0){
		http.open("GET","admin.php?SaveComment&cid=" + id + "&memberid=" + memberid + "&userid=" + userid + "&comment=" + escape(comment)+"&code="+Math.floor(Math.random()*99999),true);
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