<?php
/*
################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
*/

// ##################################
// FOR CHAT PAGE NOT CHAT BOX
// ##################################

header("Expires: Mon, 2 Jun 2008 08:23:56 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-Type: text/plain; charset=utf-8");

include_once("../../class2.php");

if (file_exists(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN."chatbox2_menu/languages/English/English.php");
}

// ##################################
// CHAT PAGE - INSERT MESSAGE IN DB
// ##################################
//Check to see if a message was sent.
if($_POST['cp2_insert']) {

	if(check_class($pref['cb2_mute_class'])){
		$cp2_emessage = CB2_L25;
		echo $cp2_emessage;
		exit;
	}

	if(!check_class($pref['cb2_post_class'])){
		$cp2_emessage = CB2_L27;
		echo $cp2_emessage;
		exit;
	}

	// ###########################
	// SAVING USER FONT COLOR PREF
	// ###########################
	if($_POST['cp2_user_font_color']){
		$cp2_user_font_color = $_POST['cp2_user_font_color'];
		if(USER){
			$user_pref['cb2_user_font_color'] = $cp2_user_font_color;
			save_prefs('user');
		}
	}

	$cp2_emessage='';
	// ###########################
	// NICK SET UP
	// ###########################
	if(USER){
		$nick = USERID.".".USERNAME;
		$nick = trim(preg_replace("#\[.*\]#si", "", $tp -> toDB($nick)));
	// IF NOT LOGGED IN  BUT ANON POSTS ALLOWED
	}else if($pref['anon_post']){
		$nick = "0.Anonymous";
	// OR DISALLOW
	}else{
	//		$cp2_emessage = CB2_L1;
		$nick = "";
	}

	// ###############################
	// CHECK FOR ALLOW USER MULTI-POST
	// ###############################
	if($pref['cb2_multipost'] == 0){
		$sql -> db_Select("chatbox2", "cb2_nick", "1=1 ORDER BY cb2_id DESC LIMIT 1");
		$row = $sql->db_Fetch();
		$cp2_multipost = 0;
		if( ($row[0] == $nick) && (!check_class($pref['cb2_mod_class'])) ){
			$cp2_multipost = 1;
			$cp2_emessage = CB2_L40;
		}
	}

	$cp2_message = $_POST['cp2_message'];

	// ###########################
	// SAVING MESSAGE
	// ###########################
	$fp = new floodprotect;
	if( ($fp -> flood("chatbox2", "cb2_datestamp")) || ($cp2_multipost != 1) || (!check_class($pref['cb2_mod_class'])) ){
		if((strlen(trim($cp2_message)) < 1000) && trim($cp2_message) != ""){

			$nick =	$_POST['cp2_nick'];
			$nick = trim(preg_replace("#\[.*\]#si", "", $tp -> toDB($nick)));
			$ip = $_POST['cp2_ip'];

			// ##############
			// MANAGE MESSAGE
			// ##############
			if($pref['cb2_user_font_color_activate'] == 1){
				$cp2_font_color = $cp2_user_font_color;
			}else{
				$cp2_font_color = "";
			}

			$search[0] = "#\[.*?\](.*?)\[/.*?\]#s";
			$replace[0] = "\\1";

			if($pref['cb2_whitespace'] != 1){
				$search[1] = "/\s/si";
				$replace[1] = " ";
			}
			$cp2_message = preg_replace($search, $replace, $cp2_message);

			$cp2_message = $tp -> toDB($cp2_message);

			if($pref['cb2_allow_dups'] != 1){
				if($sql -> db_Select("chatbox2", "*", "cb2_message='$cp2_message' AND cb2_datestamp+".$pref['cb2_dup_timer'].">".time())){
					$cp2_emessage = CB2_L17;
				}
			}

			if(!$cp2_emessage){
				$cp2_emessage = ($sql -> db_Insert("chatbox2", "0, '$nick', '$cp2_message',  '$cp2_font_color', '".time()."', '0' , '$ip' ")) ? "noerr" : CB2_L30;
				if($cp2_emessage == "noerr"){
					$edata_cp = array("cmessage" => $cp2_message, "ip" => $ip);
					$e_event -> trigger("cbox2post", $edata_cp);

					// DISABLING CACHE FOR NOW
					// $e107cache->clear("nq_chatbox2");

					if(USER){
						$cp2_emessage = ($sql -> db_Update("user", "user_chats=user_chats+1, user_lastpost='".time()."' WHERE user_id='".USERID."' ")) ? "noerr" : CB2_L31;
					}
					if( (USERID)  && (isset($pref['gold_chatbox'])) ){
						add_gold($pref['gold_chatbox'], USERID);
					}
				}
			}
		}else{
			$cp2_emessage = CB2_L15;
		}
	}else{
		$cp2_emessage = CB2_L19;
	}
	echo $cp2_emessage;
	exit;
}

// ##################################
// PAGE - RETRIEVE USERS IN CHAT
// ##################################
if($_POST['cp2_getchatusers']) {

	if(!check_class($pref['cb2_view_class'])){
		exit;
	}

//	if (MEMBERS_ONLINE) {
		global $listuserson, $ADMIN_DIRECTORY;
		$cutext = "";

		foreach($listuserson as $uinfo => $pinfo) {

			list($oid, $oname) = explode(".", $uinfo, 2);

			$online_location_page = substr(strrchr($pinfo, "/"), 1);

			if ( ($online_location_page == "chatpage.php") || ($online_location_page == "chatpage_control.php") ) {

				// SET CUSTOM LOOKS
				if( ($pref['cp2_name_font_color']) && ($pref['cp2_custom_look'] == 1) ){
					$cutext .= "
						<a href='".e_BASE."user.php?id.$oid'><span style='color:#".$pref['cp2_name_font_color']."'>$oname</span></a>&nbsp;&nbsp;
					";
				}else{
					$cutext .= "
						<a href='".e_BASE."user.php?id.$oid'>$oname</a>&nbsp;&nbsp;
					";
				}
			}
		}
//	}
	echo $cutext;
	exit;
}

// ##################################
// PAGE - RETRIEVE LAST CHAT NUMBER
// ##################################
if($_POST['cp2_getlastid']) {

	if(!check_class($pref['cb2_view_class'])){
		exit;
	}

	$sql->db_Select("chatbox2", "MAX(cb2_id)");
	$row = $sql->db_Fetch();
	echo $row[0];
	exit;
}

// ##################################
// PAGE - RETRIEVE NEWEST MESSAGES
// ##################################
if($_POST['cp2_getchat']) {

	if(!check_class($pref['cb2_view_class'])){
		$cp2_emessage = CB2_L28;
		echo $cp2_emessage;
		exit;
	}

	require_once(e_HANDLER."emote.php");
	$text = "";

	$cp2_old_last_post_id =	$_POST['cp2_old_last_post_id'];
	$cp2_new_last_post_id =	$_POST['cp2_new_last_post_id'];

	global $pref,$tp;

	if(!$pref['cb2_mod_class']){
		$pref['cb2_mod_class'] = e_UC_ADMIN;
		save_prefs();
	}

	define("CP2_MOD", check_class($pref['cb2_mod_class']));

	// ###########################
	// GET CHATS FROM DB
	// ###########################
	$qry = "
		SELECT c.*, u.user_name FROM #chatbox2 AS c
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(c.cb2_nick,'.',1) = u.user_id
		WHERE c.cb2_id > '$cp2_old_last_post_id' AND c.cb2_id <= '$cp2_new_last_post_id'  ORDER BY c.cb2_datestamp DESC";

	if($sql -> db_Select_gen($qry)) {
		$obj2 = new convert;
		$cpost = $sql -> db_getList();

		$cp2_last_post = 0;

		foreach($cpost as $cp){
			list($cp2_uid, $cp2_nick) = explode(".", $cp['cb2_nick'], 2);

			// ###########################
			// LAST POST VALUE
			// ###########################
			if($cp2_last_post == 0){
				$cp2_last_post = $cp['cb2_id'];
			}

			$cp2_id = $cp['cb2_id'];

			// ###########################
			// NICK
			// ###########################
			if($cp['user_name']){

				if (USERID  && (isset($pref['gold_chatbox'])) && ($pref['cb2_gold_enable']== 1) ){
					// IF USER AND GOLD SYSTEM INSTALLED AND CHATBOX ENABLES GOLD
					$sql -> db_Select("gold_system", "id, orb", "id={$cp2_uid} LIMIT 1");
					$row = $sql -> db_Fetch();
					if ($row['orb'] != "") {
						// IF ORB IS ON
		        		$cp2_nick= "
							<DIV class='{$row['orb']}' style='height:15px;' id='b_{$row['id']}'>
								<a href='".e_BASE."user.php?id.{$cp2_uid}'>{$cp['user_name']}</a>
				         </DIV>
						";
					}else if( ($pref['cp2_name_font_color']) && ($pref['cp2_custom_look'] == 1) ){
						// OTHERWISE CHECK IF CHATBOX CUSTOM LOOK ENABLED
						$cp2_nick = "
							<a href='".e_BASE."user.php?id.{$cp2_uid}'>
								<span style='color:#".$pref['cp2_name_font_color']."'>{$cp['user_name']}</span>
							</a>
						";
					}else{
						// OTHERWISE PLAIN OLE NICK LOOK
						$cp2_nick = "
							<a href='".e_BASE."user.php?id.{$cp2_uid}'>
								{$cp['user_name']}
							</a>
						";
					}

				}else if( ($pref['cp2_name_font_color']) && ($pref['cp2_custom_look'] == 1) ){
					// NOT GOLD SYS SO CHECK IF CHATBOX CUSTOM LOOK ENABLED
					$cp2_nick = "
						<a href='".e_BASE."user.php?id.{$cp2_uid}'>
							<span style='color:#".$pref['cp2_name_font_color']."'>{$cp['user_name']}</span>
						</a>
					";
				}else{
					// OTHERWISE PLAIN OLE NICK LOOK
					$cp2_nick = "
						<a href='".e_BASE."user.php?id.{$cp2_uid}'>
							{$cp['user_name']}
						</a>
					";
				}
			}else{
				// MAKE ANON NICK NAME
				$cp2_nick = $tp -> toHTML($cp2_nick,FALSE,'USER_TITLE, emotes_off, no_make_clickable');
				$cp2_nick = str_replace("Anonymous", LAN_ANONYMOUS, $cp2_nick);
			}

			// ###########################
			// DATESTAMP
			// ###########################
			$cp2_datestamp = $obj2->convert_date($cp['cb2_datestamp'], "short");

			$emotes_active = $pref['cb2_emote'] ? 'USER_BODY, emotes_on' : 'USER_BODY, emotes_off';

			// ###########################
			// CHAT MESSAGE
			// ###########################
			$cp2_message = $cp['cb2_message'];

			// DISABLE TAGS
			$search[0] = "/\</si";
			$replace[0] = "&lt";
			$cp2_message = preg_replace($search, $replace, $cp2_message);

			$cp2_message = $tp -> toHTML($cp2_message, FALSE, $emotes_active, $cp2_uid, $pref['main_wordwrap']);

			if($pref['cb2_user_font_color_activate'] == 1){
				if($cp['cb2_color'] != ""){
					$cp2_message = "<span style='color:#".$cp['cb2_color']."'>".$cp2_message."</span>";
				}else if ( ($pref['cp2_msg_font_color']) && ($pref['cb2_custom_look'] == 1) ){
					$cp2_message = "<span style='color:#".$pref['cp2_msg_font_color']."'>".$cp2_message."</span>";
				}
			}else if ( ($pref['cp2_msg_font_color']) && ($pref['cb2_custom_look'] == 1) ){
				$cp2_message = "<span style='color:#".$pref['cp2_msg_font_color']."'>".$cp2_message."</span>";
			}

			// ###########################
			// BULLET
			// ###########################
			if($pref['cb2_show_bullet'] == 1){
				$bullet = (defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle;' />" : "<img src='".THEME_ABS."images/".(defined("BULLET") ? BULLET : "bullet2.gif")."' alt='' style='vertical-align: middle;' />");
			}else{
				$bullet = "";
			}

			// ###########################
			// CONTROLS
			// ###########################
				$cp_control = "";
			// IF DELETE POSTS ALLOWED
			if( ((USERID == $cp2_uid) || CP2_MOD) && ($pref['cb2_enable_deletes'] == 1) ){
				$cp_control = "
					<input class='tbox' type='hidden' id='cp2_delete_message_id' name='cp2_delete_message_id' value='".$cp2_id."' />
					<INPUT TYPE='image' SRC='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2_menu/images/delete.png' HEIGHT='8' WIDTH='8' BORDER='0' ALT='".CB2_L35." - #".$cp2_id."' onClick=\"this.form.cp2_mute_user.value='';this.form.submit();\">
				";

			}

			// APPEND IF MUTING IS ENABLED AND NOT A MODS POST
			if( (CP2_MOD) && ($pref['cb2_enable_muting'] == 1) && ($cp2_uid != USERID) ){
				$cp_control .= "
					<input class='tbox' type='hidden' id='cp2_mute_user' name='cp2_mute_user' value='".$cp2_uid."' />
					<INPUT TYPE='image' SRC='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2_menu/images/mute.png' HEIGHT='8' WIDTH='8' BORDER='0' ALT='".CB2_L36."' onClick='this.form.submit();'>
			 	";
			}

			// ###########################
			// CHATPAGE FORMATTING
			// ###########################
			global $CHATPAGESTYLE;
			if(!$CHATPAGESTYLE){
				// default chatpage style
					$CHATPAGESTYLE = "
						<table style='width:97%;border:solid;border-width:0px'>
							<tr>
								<td style='width:25%;border:solid;border-width:1px;padding:1px;vertical-align:top;text-indent:1px;'>
										{BULLET} <b>{USERNAME}</b>
										{GOLDBREAK}
										{CPCONTROL}
					";
					if($pref['cp2_show_date'] == 1){
						$CHATPAGESTYLE .= "
										<br />
										<span class='smallblacktext'>
										{TIMEDATE}
										</span>
						";
					}
					$CHATPAGESTYLE .= "
								</td>
								<td style='width:75%;border:solid;border-width:1px;padding:1px;vertical-align:top;text-indent:1px;'>
									{MESSAGE}
								</td>
							</tr>
						</table>
						";
				}


			// NOW WRAP IN CHATPAGESTYLE_WRAP
			$CHATPAGESTYLE_WRAP = "
				<!-- chat page -->
			";

			$CHATPAGESTYLE_WRAP .= "
				<form method='post' action='' onLoad='this.action=this.cp2_eself.value;'>
			";

			$CHATPAGESTYLE_WRAP .= $CHATPAGESTYLE;

			$CHATPAGESTYLE_WRAP .= "
				</form>
			";

			// MICKEY MOUSE FIX FOR GOLD USE AND INTERNAL CHATBOXSTYLE WHEN NAME HAS NO ORB DONE
			// THIS ADDS A BR, SO DATE IS OK ON NEXT LINE
				$search[5] = "/\{GOLDBREAK\}(.*?)/si";
			if( ($row['orb'] != "")  && ($pref['cb2_gold_enable'] == 1) ){
				$replace[5] = "";
			}else{
				$replace[5] = "<br />";
			}

			// SEARCH REPLACE
			$search[0] = "/\{USERNAME\}(.*?)/si";
			$replace[0] = $cp2_nick;

			if($pref['cp2_show_date'] == 1){
				$search[1] = "/\{TIMEDATE\}(.*?)/si";
				if(  ($pref['cp2_date_font_color'])  && ($pref['cp2_custom_look'] == 1) ){
					$replace[1] = "<span style='color:#".$pref['cp2_date_font_color']."'>[".$cp2_datestamp."]</span>";
				}else{
					$replace[1] = "[".$cp2_datestamp."]";
				}
			}else{
				$search[1] = "/\{TIMEDATE\}(.*?)/si";
				$replace[1] = "";
			}

			$search[2] = "/\{MESSAGE\}(.*?)/si";
			$replace[2] = ($cp['cb2_blocked'] ? CB2_L6 : $cp2_message);

			$search[3] = "/\{BULLET\}(.*?)/si";
			$replace[3] = $bullet;

			$search[4] = "/\{CPCONTROL\}(.*?)/si";
			$replace[4] = $cp_control;

			$text .= preg_replace($search, $replace, $CHATPAGESTYLE_WRAP);
		}
	}

	// DISABLING CACHE FOR NOW
	//$e107cache->set("nq_chatbox2", $text);

	$text = str_replace(e_IMAGE, e_IMAGE_ABS, $text);

	echo $text;
	exit;
}

?>