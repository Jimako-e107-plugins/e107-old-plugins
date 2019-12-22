/*
################################################################
#
#	Javascript ChatBox Updater
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
var cb2Timer = 0;
var cb2LastPostID = 0;
var cb2NewLastPostID = 0;
var cb2FullPath = "";
var cb2RefreshTime = 8;
var cb2RefreshSubmit = 2;
var cb2SendResponse = "";
var cb2IDResponse = "";
var cb2ReceiveResponse = "";
var cb2ChatDiv = "";
var cb2ChatUserDiv = "";
var cb2Retries = 0;
var cb2Sound = 0;


// ################################################################
// FUNCTIONS
// ################################################################
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g, "");
}


// ################################################################
// GET NEW LAST POST ID
// ################################################################
function cb2GetNewLastID() {
	document.getElementById('cb2_emessage').innerHTML = refreshing;
	if (cb2idReceiveReq.readyState == 4 || cb2idReceiveReq.readyState == 0) {
		cb2idReceiveReq.open("POST", cb2FullPath + "chatbox2_control.php", true);
		cb2idReceiveReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var param = 'cb2_getlastid=1';
		cb2idReceiveReq.send(param);
		cb2idReceiveReq.onreadystatechange = cb2HandleReceiveLast;
	}
}

function cb2HandleReceiveLast() {
	cb2ReceivedInfo = new Array();
	if (cb2idReceiveReq.readyState == 4) {
		cb2IDResponse = cb2idReceiveReq.responseText;
		cb2NewLastPostID = cb2IDResponse;
		cb2NewLastPostID = cb2NewLastPostID.trim();
		if(cb2NewLastPostID > cb2LastPostID){
			document.getElementById('cb2_emessage').innerHTML = updating;
			cb2GetChat();
			document.getElementById('cb2_emessage').innerHTML = updated;
		}else{
			document.getElementById('cb2_emessage').innerHTML = noNew;
		}
	}
}

// ################################################################
// GET CHAT
// ################################################################
function cb2GetChat() {
	if (cb2ReceiveReq.readyState == 4 || cb2ReceiveReq.readyState == 0) {
		cb2ReceiveReq.open("POST", cb2FullPath + "chatbox2_control.php", true);
		cb2ReceiveReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var param = 'cb2_getchat=1';
		param += '&cb2_old_last_post_id=' + cb2LastPostID;
		param += '&cb2_new_last_post_id=' + cb2NewLastPostID;
		cb2ReceiveReq.send(param);
		cb2ReceiveReq.onreadystatechange = cb2HandleReceiveChat;
	}
}

function cb2HandleReceiveChat() {
	if (cb2ReceiveReq.readyState == 4) {
		cb2ChatDiv = document.getElementById('chatbox2_posts');
		cb2ReceiveResponse = cb2ReceiveReq.responseText;
		cb2ReceiveResponse = cb2ReceiveResponse.trim();
		if(cb2ReceiveResponse != ""){
			cb2ChatDiv.innerHTML = cb2ReceiveResponse + cb2ChatDiv.innerHTML;
			cb2LastPostID = cb2NewLastPostID;
			cbSelfSubmit = 0;
			if(document.getElementById('cb2_sound_status')){
				if(document.getElementById('cb2_sound_status').value == 1){
					cb2Sound = document.getElementById('cb2_newpost_sound');
					cb2Sound.Play();
				}
			}
		}
	}
}

// ################################################################
// SEND CHAT (ADD TO DB)
// ################################################################
function cb2SendChat() {
	clearInterval(cb2Timer);
	if(document.getElementById('cb2_message').value == '') {
		alert(noMsg);
		return;
	}else	if (cb2SendReq.readyState == 4 || cb2SendReq.readyState == 0) {
		cb2SendReq.open("POST", cb2FullPath + "chatbox2_control.php", true);
		cb2SendReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var param = 'cb2_insert=1';
		param += '&cb2_nick=' + document.getElementById('cb2_username').value;
		param += '&cb2_message=' + document.getElementById('cb2_message').value;
		if(document.getElementById('cb2_user_font_color')){
			param += '&cb2_user_font_color=' + document.getElementById('cb2_user_font_color').value;
		}
//		param += '&cb2_datestamp=' + document.getElementById('cb2_datestamp').value;
		param += '&cb2_ip=' + document.getElementById('cb2_ip').value;
		cb2SendReq.send(param);
		cb2SendReq.onreadystatechange = cb2HandleSendChat;
		document.getElementById('cb2_message').value = '';
	}else{
		document.getElementById('cb2_emessage').innerHTML = msgNotSent;
	}
	cb2Retries = 1;
	cb2WatchDog();
}

function cb2HandleSendChat() {
	if(cb2SendReq.readyState == 4 && cb2SendReq.status == 200){
		cb2SendResponse = cb2SendReq.responseText;
		cb2SendResponse = cb2SendResponse.trim();
		if (cb2SendResponse == "noerr"){
			// CLEAR MESSAGE BOX AND ERRORS
			document.getElementById('cb2_message').innerHTML = '';
			document.getElementById('cb2_emessage').innerHTML = inQueue;
			cb2ChatDiv.scrollTop = 0;
		}else{
			if(cb2SendResponse == ""){
				cb2SendResponse = unknownError;
			}
			alert (errorLabel + cb2SendResponse);
		}
	}
}

// ################################################################
// cb2WatchDog
// ################################################################
function cb2WatchDog() {
//	clearInterval(cb2Timer);
	document.getElementById('cb2_emessage').innerHTML = '';
	cb2GetNewLastID();
	//Refresh our chat in 2 seconds minimum
	if (cb2Retries > 0){
		cb2Timer = setTimeout("cb2WatchDog()",1000+(cb2RefreshSubmit*1000));
		cb2Retries--;
	}else{
		cb2Timer = setTimeout("cb2WatchDog()",2000+(cb2RefreshTime*1000));
		cb2Retries = 0;
	}
}

// #########################################
// XML HTTP SEND AND RECIEVE INIT
// #########################################
var cb2idReceiveReq = cb2GetXmlHttpRequestObject();
var cb2cuReceiveReq = cb2GetXmlHttpRequestObject();
var cb2ReceiveReq = cb2GetXmlHttpRequestObject();
var cb2SendReq = cb2GetXmlHttpRequestObject();

//Gets the browser specific XmlHttpRequest Object
function cb2GetXmlHttpRequestObject() {
	try{
		// Firefox, Opera, Safari
		return new XMLHttpRequest();
	}
	catch (e){
		// Internet Explorer
		try{
			//For IE 6+
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e){
			try{
				//For IE 5
				return new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e){
				alert(browserError);
			}
		}
	}
}

//// ALTERNATE GET OBJECT
//////Gets the browser specific XmlHttpRequest Object
//function cb2GetXmlHttpRequestObject() {
//	if (window.XMLHttpRequest) {
//		//For Firefox, Safari, Opera
//		alert ('1');
//		return new XMLHttpRequest();
//	} else if(window.ActiveXObject("Microsoft.XMLHTTP")) {
//		//For IE 5
//		alert ('2');
//		return new ActiveXObject("Microsoft.XMLHTTP");
//	} else if(window.ActiveXObject("Msxm12.XMLHTTP")) {
//		//For IE 6+
//		alert ('3');
//		return new ActiveXObject("Msxml2.XMLHTTP");
//	} else {
//		alert("Your browser is not IE 5 or higher, or Firefox or Safari or Opera");
//	}
//}

// ################################################################
// CLOSE EMOTES
// ################################################################
function cb2CloseEmotes() {
	if(document.getElementById('cb2_emote')) {
  		folder=document.getElementById('cb2_emote').style;
	} else {
		if(ns6==1||operaaa==true) {
			folder=cb2_emote.nextSibling.nextSibling.style;
		} else {
			folder=document.all[cb2_emote.sourceIndex+1].style;
		}
   }
	folder.display="none";
}


// ################################################################
// START INIT FUNCTIONS
// ################################################################
function initCB() {
	if(document.getElementById('cb2_last_post')){
		cb2LastPostID = document.getElementById('cb2_last_post').value;
		cb2FullPath = document.getElementById('cb2_full_path').value;
		cb2RefreshTime = document.getElementById('cb2_refresh_time').value;
		cb2RefreshSubmit = document.getElementById('cb2_refresh_submit').value;
		document.getElementById('cb2_emessage').innerHTML = '';
		cb2ChatDiv = document.getElementById('chatbox2_posts');
		cb2WatchDog();
	}else{
//		alert ("Init Error");
		cb2Timer = setTimeout("initCB()",500);
	}
}

initCB();
//window.onload = initCB;