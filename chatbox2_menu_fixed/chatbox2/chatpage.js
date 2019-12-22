/*
################################################################
#
#	Javascript ChatPage Updater
#
#		http://www.vitalogix.com
#		Copyright - Billy Smith
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#		Revision: 1.0.2
#		Date: 2008-7-27
################################################################
- 1.0.1 - Moved Languages to top, so they could be edited easier
- 1.0.2 - Added trim to fix spaces passed by some servers
*/

// ################################################################
// LANGUAGE
// ################################################################
var updating = 'Updating...';
var updated = 'Updated!';
var noNew = 'No New Posts...';
var refreshing = 'Refreshing...';
var noMsg = "You have not entered a message";
var msgNotSent = 'ERROR: Message not Sent';
var inQueue = 'In Queue...';
var unknownError = "Unknown Error";
var errorLabel = "ERROR: ";
var browserError = 'Your browser is not IE 5 or higher, or Firefox or Safari or Opera';


// ################################################################
// INITIALIZATION
// ################################################################
var cpTimer = 0;
var cpLastPostID = 0;
var cpNewLastPostID = 0;
var cpFullPath = "";
var cp2RefreshTime = 8;
var cp2RefreshSubmit = 2;
var cpSendResponse = "";
var cpIDResponse = "";
var cpReceiveResponse = "";
var cpChatDiv = "";
var cpChatUserDiv = "";
var cpRetries = 0;
var cpSound = 0;

// ################################################################
// FUNCTIONS
// ################################################################
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g, "");
}

// ################################################################
// GET NEW LAST POST ID
// ################################################################
function cpGetNewLastID() {
	document.getElementById('cp2_emessage').innerHTML = refreshing;
	if (cpidReceiveReq.readyState == 4 || cpidReceiveReq.readyState == 0) {
		cpidReceiveReq.open("POST", cpFullPath + "chatpage_control.php", true);
		cpidReceiveReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var param = 'cp2_getlastid=1';
		cpidReceiveReq.send(param);
		cpidReceiveReq.onreadystatechange = cpHandleReceiveLast;
	}
}

function cpHandleReceiveLast() {
	cpReceivedInfo = new Array();
	if (cpidReceiveReq.readyState == 4) {
		cpIDResponse = cpidReceiveReq.responseText;
		cpNewLastPostID = cpIDResponse;
		cpNewLastPostID = cpNewLastPostID.trim();
		if(cpNewLastPostID > cpLastPostID){
			document.getElementById('cp2_emessage').innerHTML = updating;
			cpGetChat();
			document.getElementById('cp2_emessage').innerHTML = updated;
		}else{
			document.getElementById('cp2_emessage').innerHTML = noNew;
		}
	}
}

//// ################################################################
//// GET CHAT USERS
//// ################################################################
function cpGetChatUsers() {
	if (cpcuReceiveReq.readyState == 4 || cpcuReceiveReq.readyState == 0) {
		cpcuReceiveReq.open("POST", cpFullPath + "chatpage_control.php", true);
		cpcuReceiveReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var uparam = 'cp2_getchatusers=1';
		cpcuReceiveReq.send(uparam);
		cpcuReceiveReq.onreadystatechange = cpHandleReceiveUsers;
	}
}

function cpHandleReceiveUsers() {
	if (cpcuReceiveReq.readyState == 4) {
		cpChatUserDiv = document.getElementById('chat_page_users');
		cpReceiveResponse = cpcuReceiveReq.responseText;
		cpReceiveResponse = cpReceiveResponse.trim();
		if(cpReceiveResponse != ""){
			cpChatUserDiv.innerHTML = cpReceiveResponse;
		}
	}
}

// ################################################################
// GET CHAT
// ################################################################
function cpGetChat() {
	if (cpReceiveReq.readyState == 4 || cpReceiveReq.readyState == 0) {
		cpReceiveReq.open("POST", cpFullPath + "chatpage_control.php", true);
		cpReceiveReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var param = 'cp2_getchat=1';
		param += '&cp2_old_last_post_id=' + cpLastPostID;
		param += '&cp2_new_last_post_id=' + cpNewLastPostID;
		cpReceiveReq.send(param);
		cpReceiveReq.onreadystatechange = cpHandleReceiveChat;
	}
}

function cpHandleReceiveChat() {
	if (cpReceiveReq.readyState == 4) {
		cpChatDiv = document.getElementById('chat_page_posts');    
		cpReceiveResponse = cpReceiveReq.responseText;
		cpReceiveResponse = cpReceiveResponse.trim();
		if(cpReceiveResponse != ""){
			cpChatDiv.innerHTML = cpReceiveResponse + cpChatDiv.innerHTML;
			cpLastPostID = cpNewLastPostID;
			// USE NORMAL TIMER AGAIN
			cpSelfSubmit = 0;
			if(document.getElementById('cp2_sound_status')){
				if(document.getElementById('cp2_sound_status').value == 1){
					cpSound = document.getElementById('cp2_newpost_sound');
					cpSound.Play();
				}
			}
		}
	}
}

// ################################################################
// SEND CHAT (ADD TO DB)
// ################################################################
function cpSendChat() {
	clearInterval(cpTimer);
	if(document.getElementById('cp2_message').value == '') {
		alert(noMsg);
		return;
	}else	if (cpSendReq.readyState == 4 || cpSendReq.readyState == 0) {
		cpSendReq.open("POST", cpFullPath + "chatpage_control.php", true);
		cpSendReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var param = 'cp2_insert=1';
		param += '&cp2_nick=' + document.getElementById('cp2_username').value;
		param += '&cp2_message=' + document.getElementById('cp2_message').value;
		if(document.getElementById('cp2_user_font_color')){
			param += '&cp2_user_font_color=' + document.getElementById('cp2_user_font_color').value;
		}
		param += '&cp2_ip=' + document.getElementById('cp2_ip').value;
		cpSendReq.send(param);
		cpSendReq.onreadystatechange = cpHandleSendChat;
		document.getElementById('cp2_message').value = '';
	}else{
		document.getElementById('cp2_emessage').innerHTML = msgNotSent;
	}
	// SET TO UPDATE FAST ON SUBMIT
	cpRetries = 1;   
	cpWatchDog();
}

function cpHandleSendChat() {
	if(cpSendReq.readyState == 4 && cpSendReq.status == 200){
		cpSendResponse = cpSendReq.responseText;
		cpSendResponse = cpSendResponse.trim();
		if (cpSendResponse == "noerr"){
			// CLEAR MESSAGE BOX AND ERRORS
			document.getElementById('cp2_message').innerHTML = '';
			document.getElementById('cp2_emessage').innerHTML = inQueue;
			cpChatDiv.scrollTop = 0;
		}else{
			if(cpSendResponse == ""){
				cpSendResponse = unknownError;
			}
			alert (errorLabel + cpSendResponse);
		}
	}
}

// ################################################################
// cpWatchDog
// ################################################################
function cpWatchDog() {
//	clearInterval(cpTimer);
	document.getElementById('cp2_emessage').innerHTML = '';
	cpGetNewLastID();
	if(document.getElementById('chat_page_users')){
		cpGetChatUsers();
	}   
	//Refresh our chat in 2 seconds minimum
	if (cpRetries > 0){
		cpTimer = setTimeout("cpWatchDog()",1000+(cpRefreshSubmit*1000));   
		cpRetries--;
	}else{
		cpTimer = setTimeout("cpWatchDog()",2000+(cpRefreshTime*1000));
		cp2Retries = 0;
	}
}

// #########################################
// XML HTTP SEND AND RECIEVE INIT
// #########################################
var cpidReceiveReq = cpGetXmlHttpRequestObject();
var cpcuReceiveReq = cpGetXmlHttpRequestObject();
var cpReceiveReq = cpGetXmlHttpRequestObject();
var cpSendReq = cpGetXmlHttpRequestObject();

////Gets the browser specific XmlHttpRequest Object
function cpGetXmlHttpRequestObject() {
	try{
		// Firefox, Opera, Safari
		return new XMLHttpRequest();
	}catch (e){
		// Internet Explorer
		try{
			//For IE 5
			return new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e){
			try{
				//For IE 6+
				return new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				alert(browserError);
			}
		}
	}
}

// ALTERNATE GET OBJECT
////Gets the browser specific XmlHttpRequest Object
//function cpGetXmlHttpRequestObject() {
//	if (window.XMLHttpRequest) {
//		//For Firefox, Safari, Opera
//		return new XMLHttpRequest();
//	} else if(window.ActiveXObject) {
//		//For IE 5
//		return new ActiveXObject("Microsoft.XMLHTTP");
//	} else if{
//		//For IE 6+
//		return new ActiveXObject("Msxml2.XMLHTTP");
//	} else {
//		alert("Your browser is not IE 5 or higher, or Firefox or Safari or Opera");
//	}
//}


// ################################################################
// CLOSE EMOTES
// ################################################################
function cp2CloseEmotes() {
	if(document.getElementById('cp2_emote')) {
  		folder=document.getElementById('cp2_emote').style;
	} else {
		if(ns6==1||operaaa==true) {
			folder=cp2_emote.nextSibling.nextSibling.style;
		} else {
			folder=document.all[cp2_emote.sourceIndex+1].style;
		}
   }
	folder.display="none";
}

// ################################################################
// START INIT FUNCTIONS
// ################################################################
function initCP() {
	if(document.getElementById('cp2_last_post')){
		cpLastPostID = document.getElementById('cp2_last_post').value;
		cpFullPath = document.getElementById('cp2_full_path').value;
		cpRefreshTime = document.getElementById('cp2_refresh_time').value;
		cpRefreshSubmit = document.getElementById('cp2_refresh_submit').value;
		document.getElementById('cp2_emessage').innerHTML = '';
		cpChatDiv = document.getElementById('chat_page_posts');
		cpWatchDog();
	}else{
//		alert ("Init Error");
		cpTimer = setTimeout("initCP()",500);
	}
}

initCP();
//window.onload = initCP;

