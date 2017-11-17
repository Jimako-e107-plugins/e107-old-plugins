wars_jq().ready(function() {
	wars_jq("#opp_tag").autocomplete('admin.php?Search&type=opp_tag', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	}).result(function(){OppFields('tag');});
	wars_jq("#opp_name").autocomplete('admin.php?Search&type=opp_name', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	}).result(function(){OppFields('name');});
	wars_jq("#opp_url").autocomplete('admin.php?Search&type=opp_url', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	});
	wars_jq("#style").autocomplete('admin.php?Search&type=style', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	});
	wars_jq("#mapname").autocomplete('admin.php?Search&type=mapname&gid='+gid, {
		matchContains: true,
		selectFirst: false,
		mustMatch: mapmustmatch,
		minChars: 1
	});
	wars_jq("#gametype").autocomplete('admin.php?Search&type=gametype', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	});
	wars_jq("#playername0").autocomplete('admin.php?Search&type=player', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	}).result(function(){AddPlayer(0);});
	wars_jq("#playername1").autocomplete('admin.php?Search&type=player', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	}).result(function(){AddPlayer(1);});
	wars_jq("#playername2").autocomplete('admin.php?Search&type=player', {
		matchContains: true,
		selectFirst: false,
		minChars: 1
	}).result(function(){AddPlayer(2);});
});

wars_jq(document).ready(function() {
	wars_jq("a.screens").fancybox();
});

function ChangeGame(obj){
	gid = obj.value;
	wars_jq().ready(function() {
		wars_jq("#mapname").autocomplete('admin.php?Search&type=mapname&gid='+gid, {
			matchContains: true,
			selectFirst: false,
			mustMatch: mapmustmatch,
			minChars: 1
		});
	});
}

function submitenter(avail,e){
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	
	if (keycode == 13){
		   AddPlayer(avail);
		   return false;
	}else{
	   return true;
	}
}

function autoIframe(frameId) { 
   try{ 
      frame = document.getElementById(frameId); 
      innerDoc = (frame.contentDocument) ? frame.contentDocument : frame.contentWindow.document; 
      objToResize = (frame.style) ? frame.style : frame; 
      objToResize.height = innerDoc.body.scrollHeight + 10; 
   } 
   catch(err){ 
      window.status = err.message; 
   } 
} 

function ChangeFlag(obj) {
	var cflag = document.getElementById("opp_flag");
	cflag.src = imgfolder+"clan/flags/"+obj.value+".png"
}

function ChangeStatus(obj){
	if(obj.value == "1"){
		document.getElementById('lineupfindiv').style.display = "";
		document.getElementById('lineupupcdiv').style.display = "none";
		document.getElementById('lineupdiv0').innerHTML = "";		
	}else{
		document.getElementById('lineupfindiv').style.display = "none";
		document.getElementById('lineupupcdiv').style.display = "";
	}	
}
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

function OppFields(type){
	var tag = document.getElementById('opp_tag').value;
	var name = document.getElementById('opp_name').value;
	var url = document.getElementById('opp_url').value;
	var country = document.getElementById('opp_country').value;
	if((type=="tag" && tag !="" && name == "" && url == "")||(type=="name" && name !="" && tag == "" && url == "")){
		if(type == "tag"){var stype=stag;}else{var stype=sname;}
		var sure = confirm(alrindbaddsame1+stype+alrindbaddsame2);
		if(sure){
			if(type == "tag"){
				var param = tag;
			}else if(type == "name"){
				var param = name;
			}
    http.open("GET","admin.php?GetInfo&type=" + escape(type) + "&param=" + escape(param)+"&code="+Math.floor(Math.random()*99999),true);
    
    http.onreadystatechange = function() {
        if(http.readyState == 4) {
            if(http.status == 200) {
                var result = http.responseText.replace(/(<([^>]+)>)/ig,"");
                if(result !="") {
					infos = result.split('((oppinfseperator))');
					if(type == "tag"){
						document.getElementById('opp_name').value = infos[0];
					}else if(type == "name"){
						document.getElementById('opp_tag').value = infos[0];
					}
					document.getElementById('opp_url').value = infos[1];
					sel = document.getElementById('opp_country');
					for (i=0; i<sel.options.length; i++) {
						if (sel.options[i].text == infos[2]) {
							sel.selectedIndex = i;
						}
					}
					ChangeFlag(sel);
				} else {
					alert(errorgetinfo);
                }
            }
        }
    }
    http.send(null);   
		}
	}
}

/////////
//MAPS
/////////
function AddAutoComplete(id){
	wars_jq().ready(function() {
		wars_jq("#mapname"+id).autocomplete('admin.php?Search&type=mapname&gid='+gid, {
			matchContains: true,
			selectFirst: false,
			mustMatch: mapmustmatch,
			minChars: 1
		});
		wars_jq("#gametype"+id).autocomplete('admin.php?Search&type=gametype', {
			matchContains: true,
			selectFirst: false,
			minChars: 1
		});
	});
}

var mapwidth = new Array();
if(scorepermap == 1){
	mapwidth[0] = 126;
	mapwidth[1] = mapwidth[0] - 10;
	mapwidth[2] = 74;
	mapwidth[3] = mapwidth[2] - 10;						
}else{
	mapwidth[0] = 180;
	mapwidth[1] = mapwidth[0] - 10;
	mapwidth[2] = 110;
	mapwidth[3] = mapwidth[2] - 10;
}

function AddMap() {
    var mapname = document.getElementById("mapname").value;
    var gametype = document.getElementById("gametype").value;
	if(scorepermap == 1){
		var our_score = document.getElementById("ourscore").value;
    	var opp_score = document.getElementById("oppscore").value;
	}
	if(!mapname){alert(fillinmapname);return;}
	
    //By calling this file, we have saved the data.
    http.open("GET","admin.php?AddMap&mapname=" + escape(mapname) + "&gametype=" + escape(gametype) + "&our_score=" + parseInt(our_score) + "&opp_score=" + parseInt(opp_score) +"&wid=" + wid +"&gid=" + gid+"&code="+Math.floor(Math.random()*99999),true);
    
    http.onreadystatechange = function() {
        if(http.readyState == 4) {
            if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
                if(result > 0) {
					var newcontent = '<div class="mainwrap forumheader3" id="map'+result+'"> <table border="0" cellspacing="0" cellpadding="2"> <tr> <td width="'+mapwidth[0]+'" id="mapnametext'+result+'">&nbsp;'+mapname+'</td> <td width="'+mapwidth[2]+'" id="gametypetext'+result+'">&nbsp;'+gametype+'</td>';
					if(scorepermap == 1){
						newcontent += '<td width="36" style="text-align:right;" id="our_scoretext'+result+'">'+our_score+'</td> <td width="6" style="text-align:center;">/</td> <td width="36" id="opp_scoretext'+result+'">'+opp_score+'</td>';
					}
					newcontent += '<td width="118"  style="text-align:right;" nowrap><input type="button" class="button iconpointer" value="'+edittext+'" onclick="EditMap('+result+');">&nbsp;<input type="button" class="button iconpointer" value="'+deltext+'" onclick="DelMap('+result+');"></td> </tr> </table> </div>';
					newcontent += '<div class="mainwrap forumheader3" id="editmap'+result+'" style="display:none;"> <table border="0" cellspacing="0" cellpadding="2"> <tr> <td width="'+mapwidth[0]+'"><input type="text" id="mapname'+result+'" value="'+mapname+'" style="width:'+mapwidth[1]+'px;"></td> <td width="'+mapwidth[2]+'"><input type="text" id="gametype'+result+'" value="'+gametype+'" style="width:'+mapwidth[3]+'px;"></td>';
					if(scorepermap == 1){
						newcontent += '<td width="36" style="text-align:right;"><input class="bginput" type="text" id="our_score'+result+'" value="'+our_score+'" style="width:30px;margin:0"></td> <td width="6" style="text-align:center;">/</td> <td width="36"><input class="bginput" type="text" id="opp_score'+result+'" value="'+opp_score+'" style="width:30px;margin:0"></td>';
					}
					newcontent += '<td width="118" style="text-align:right;" nowrap><input type="button" class="button iconpointer" value="'+savetext+'" onclick="SaveMap('+result+');">&nbsp;<input type="button" class="button iconpointer" value="'+canceltext+'" onclick="CancelMap('+result+');"></td> </tr> </table> </div>';
					
	                document.getElementById("mapsdiv").innerHTML = document.getElementById("mapsdiv").innerHTML + newcontent;
					
					document.getElementById("mapname").value = "";
					document.getElementById("gametype").value = "";
					if(scorepermap == 1){
						document.getElementById("ourscore").value = "";
						document.getElementById("oppscore").value = "";
					}
					document.getElementById("mapname").focus();
					
				} else {
					alert(erroraddmap);
                }
            }
        }
    }
    http.send(null);    
}

function DelMap(id) {
	var sure = confirm(suredelmap);
	
	if(sure){
		http.open("GET","admin.php?DelMap&lid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
						document.getElementById("map"+id).innerHTML = "";
						document.getElementById("map"+id).style.display = "none";
					}else{
						alert(errordelmap);
					}
				}
			}
		}
		http.send(null);  
	}
}

function EditMap(id){
	document.getElementById("map"+id).style.display = "none";
	document.getElementById("editmap"+id).style.display = "";
	AddAutoComplete(id);
}
function CancelMap(id){
	document.getElementById("map"+id).style.display = "";
	document.getElementById("editmap"+id).style.display = "none";
}
function SaveMap(id) {	
	var mapname = document.getElementById("mapname"+id).value;
	var gametype = document.getElementById("gametype"+id).value;
	if(scorepermap == 1){
		var our_score = document.getElementById("our_score"+id).value;
		var opp_score = document.getElementById("opp_score"+id).value;
	}
	if(!mapname){alert(fillinmapname);return;}

	http.open("GET","admin.php?SaveMap&lid=" + id + "&mapname=" + escape(mapname) + "&gametype=" + escape(gametype) + "&our_score=" + parseInt(our_score) + "&opp_score=" + parseInt(opp_score)  + "&gid=" + gid + "&code="+Math.floor(Math.random()*99999),true);
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
				if(result == 1) {
					document.getElementById("mapnametext"+id).innerHTML = "<div>&nbsp;"+mapname+"</div>";
					document.getElementById("gametypetext"+id).innerHTML = "<div>&nbsp;"+gametype+"</div>";
					if(scorepermap == 1){
						document.getElementById("our_scoretext"+id).innerHTML = "<div>"+our_score+"</div>";
						document.getElementById("opp_scoretext"+id).innerHTML = "<div>"+opp_score+"</div>";
					}
				}else{
					alert(errorupdmap);
				}
			}
		}
	}
	http.send(null); 
	CancelMap(id);
}

//////////
//LINEUP
//////////
function AddPlayer(avail) {
    var playername = document.getElementById("playername"+avail).value;
	var warstatus = document.getElementById("warstatus").value;
	if(!playername){alert(fillinname);return;}
	
    //By calling this file, we have saved the data.
    http.open("GET","admin.php?AddPlayer&playername=" + escape(playername) + "&avail=" + parseInt(avail) + "&wid=" + parseInt(wid) + "&warstatus="+ parseInt(warstatus)+"&code="+Math.floor(Math.random()*99999),true);
    
    http.onreadystatechange = function() {
        if(http.readyState == 4) {
            if(http.status == 200) {
                var result = http.responseText.replace(/(<([^>]+)>)/ig,"");
				if(result == "inlineup"){
					alert(alrinlu);
					document.getElementById("playername"+avail).value = "";
					document.getElementById("playername"+avail).focus();
					return;
				}
				
                if(parseInt(result) > 0 || result.substring(0,7) == "updated") {
					if(result.substring(0,7) == "updated"){
						result = result.substring(7);
					}
					result = parseInt(result);
					if(avail > 0){
						document.getElementById("lineupdiv2").innerHTML = document.getElementById("lineupdiv2").innerHTML + '<span id="playerfin'+result+'" class="smallwrap forumheader3"><table cellpadding="2" cellspacing="0" border="0" width="100%"><tr> <td>&nbsp;'+playername+'</td> <td style="text-align:right"><input type="button" class="iconpointer button" value="'+deltext+'" onclick="DelPlayer('+result+',2);"></td> </tr></table></span>';						
						document.getElementById("lineupdiv1").innerHTML = document.getElementById("lineupdiv1").innerHTML + '<span class="smallwrap forumheader3" id="playerupc'+result+'"> <table cellpadding="2" cellspacing="0" border="0" width="100%"><tr> <td>&nbsp;'+playername+'</td> <td style="text-align:right"><input type="button" class="iconpointer button" value="'+deltext+'" onclick="DelPlayer('+result+',1);"></td> </tr></table> </span>';						
					}else{
						document.getElementById("lineupdiv0").innerHTML = document.getElementById("lineupdiv0").innerHTML + '<span class="smallwrap forumheader3" id="playerupc'+result+'"> <table cellpadding="2" cellspacing="0" border="0" width="100%"><tr> <td>&nbsp;'+playername+'</td> <td style="text-align:right"><input type="button" class="iconpointer button" value="'+deltext+'" onclick="DelPlayer('+result+',0);"></td> </tr></table> </span>';
					}
					
					document.getElementById("playername"+avail).value = "";
					document.getElementById("playername"+avail).focus();
					
				} else {
					alert(erroraddpl);
                }
            }
        }
    }
    http.send(null);    
}
function DelPlayer(id,avail) {
	var sure = confirm(suredelpl);
	
	if(sure){
		http.open("GET","admin.php?DelPlayer&pid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
						document.getElementById("playerupc"+id).innerHTML = "";
						document.getElementById("playerupc"+id).style.display = "none";
						if(avail > 0){
							document.getElementById("playerfin"+id).innerHTML = "";
							document.getElementById("playerfin"+id).style.display = "none";
						}
					}else{
						alert(errordelpl);
					}
				}
			}
		}
		http.send(null);  
	}
}

///////////
//SCREENS
///////////

function DelScreen(id) {
	var sure = confirm(suredelscr);
	
	if(sure){
		http.open("GET","admin.php?DelScreen&sid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
						document.getElementById("screen"+id).innerHTML = "";
						document.getElementById("screen"+id).style.display = "none";
					}else{
						alert(errordelscr);
					}
				}
			}
		}
		http.send(null);  
	}
}

////////////
//COMMENTS
////////////
function EditComment(id){
	document.getElementById("comment"+id).style.display = "none";
	document.getElementById("editcomment"+id).style.display = "";
}
function CancelComment(id){
	document.getElementById("comment"+id).style.display = "";
	document.getElementById("editcomment"+id).style.display = "none";
}
function DelComment(id) {
	var sure = confirm(suredelcomm);
	
	if(sure){
		http.open("GET","admin.php?DelComment&cid=" + id+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
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
function DelWarComments() {
	var sure = confirm(suredelallcomms);
	
	if(sure){
		http.open("GET","admin.php?DelWarComments&wid=" + wid+"&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
						document.getElementById("commentsdiv").innerHTML = '<div class="mainwrap forumheader3" style="text-align:center;" id="nocommsdiv"><div style="padding:2px;"><i>'+nocommsonwar+'</i></div></div>';						
					}else{
						alert(errordelcomms);
					}
				}
			}
		}
		http.send(null);  
	}
}
function SaveComment(id) {	
	var comment = document.getElementById("commarea"+id).value;
	if(!comment){alert(writecomm);return;}
	http.open("GET","admin.php?SaveComment&cid=" + id + "&comment=" + escape(comment)+"&code="+Math.floor(Math.random()*99999),true);
	
	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			if(http.status == 200) {
                var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
				if(result == 1) {
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

function nl2br(str) {
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ '<br />' +'$2');
}