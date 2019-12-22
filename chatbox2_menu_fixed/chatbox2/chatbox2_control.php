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

header("Expires: Mon, 2 Jun 2008 08:23:56 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-Type: text/plain; charset=utf-8");

include_once("../../class2.php");

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English.php");
}

// ##################################
// CHATBOX - INSERT MESSAGE IN DB
// ##################################
//Check to see if a message was sent.
if($_POST['cb2_insert']) {

	if(check_class($pref['cb2_mute_class'])){
		$cb2_emessage = CB2_L25;
		echo $cb2_emessage;
		exit;
	}

	if(!check_class($pref['cb2_post_class'])){
		$cb2_emessage = CB2_L27;
		echo $cb2_emessage;
		exit;
	}

	// ###########################
	// SAVING USER FONT COLOR PREF
	// ###########################
	// USE cb - same used by chst page
	if($_POST['cb2_user_font_color']){
		$cb2_user_font_color = $_POST['cb2_user_font_color'];
		if(USER){
			$user_pref['cb2_user_font_color'] = $cb2_user_font_color;
			save_prefs('user');
		}
	}

	$cb2_emessage='';
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
	//	$cb2_emessage = CB2_L1;
		$nick = "";
	}

	// ###############################
	// CHECK FOR ALLOW USER MULTI-POST
	// ###############################
	if($pref['cb2_multipost'] == 0){
		$sql -> db_Select("chatbox2", "cb2_nick", "1=1 ORDER BY cb2_id DESC LIMIT 1");
		$row = $sql->db_Fetch();
		$cb2_multipost = 0;
		if( ($row[0] == $nick) && (!check_class($pref['cb2_mod_class'])) ){
			$cb2_multipost = 1;
			$cb2_emessage = CB2_L40;
		}
	}

	$cb2_message = $_POST['cb2_message'];

	// ###########################
	// SAVING MESSAGE
	// ###########################
	$fp = new floodprotect;
	if( ($fp -> flood("chatbox2", "cb2_datestamp")) || ($cb2_multipost != 1) || (!check_class($pref['cb2_mod_class'])) ){
		if((strlen(trim($cb2_message)) < 1000) && trim($cb2_message) != ""){

			$nick =	$_POST['cb2_nick'];
			$nick = trim(preg_replace("#\[.*\]#si", "", $tp -> toDB($nick)));
			$ip = $_POST['cb2_ip'];

			// ##############
			// MANAGE MESSAGE
			// ##############
			if($pref['cb2_user_font_color_activate'] == 1){
				$cb2_font_color = $cb2_user_font_color;
			}else{
				$cb2_font_color = "";
			}

			$search[0] = "#\[.*?\](.*?)\[/.*?\]#s";
			$replace[0] = "\\1";

			if($pref['cb2_whitespace'] != 1){
				$search[1] = "/\s/si";
				$replace[1] = " ";
			}

			$cb2_message = preg_replace($search, $replace, $cb2_message);

			$cb2_message = $tp -> toDB($cb2_message);

			if($pref['cb2_allow_dups'] != 1){
				if($sql -> db_Select("chatbox2", "*", "cb2_message='$cb2_message' AND cb2_datestamp+".$pref['cb2_dup_timer'].">".time())){
					$cb2_emessage = CB2_L17;
				}
			}
			if(!$cb2_emessage){
				$cb2_emessage = ($sql -> db_Insert("chatbox2", "0, '$nick', '$cb2_message', '$cb2_font_color', '".time()."', '0' , '$ip' ")) ? "noerr" : CB2_L30;
				if($cb2_emessage == "noerr"){
					$edata_cb = array("cmessage" => $cb2_message, "ip" => $ip);
					$e_event -> trigger("cbox2post", $edata_cb);

					// DISABLING CACHE FOR NOW
					//$e107cache->clear("nq_chatbox2");

					if(USER){
						$cb2_emessage = ($sql -> db_Update("user", "user_chats=user_chats+1, user_lastpost='".time()."' WHERE user_id='".USERID."' ")) ? "noerr" : CB2_L31;
					}
					if( (USERID)  && (isset($pref['gold_chatbox'])) ){
						add_gold($pref['gold_chatbox'], USERID);
					}
				}
			}
		}else{
			$cb2_emessage = CB2_L15;
		}
	}else{
		$cb2_emessage = CB2_L19;
	}
	echo $cb2_emessage;
	exit;
}

// ##################################
// CHATBOX - RETRIEVE LAST CHAT NUMBER
// ##################################
if($_POST['cb2_getlastid']) {

	if(!check_class($pref['cb2_view_class'])){
		exit;
	}

	$sql->db_Select("chatbox2", "MAX(cb2_id)");
	$row = $sql->db_Fetch();
	echo $row[0];
	exit;
}

// ##################################
// CHATBOX - RETRIEVE NEWEST MESSAGES
// ##################################
if($_POST['cb2_getchat']) {

	if(!check_class($pref['cb2_view_class'])){
		$cb2_emessage = CB2_L28;
		echo $cb2_emessage;
		exit;
	}

	require_once(e_HANDLER."emote.php");
	$text = "";

	$old_last_post_id =	$_POST['cb2_old_last_post_id'];
	$new_last_post_id =	$_POST['cb2_new_last_post_id'];

	global $pref,$tp;

	if(!$pref['cb2_mod_class']){
		$pref['cb2_mod_class'] = e_UC_ADMIN;
		save_prefs();
	}
	define("CB2_MOD", check_class($pref['cb2_mod_class']));

	// ###########################
	// GET CHATS FROM DB
	// ###########################
	$qry = "
		SELECT c.*, u.user_name FROM #chatbox2 AS c
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(c.cb2_nick,'.',1) = u.user_id
		WHERE c.cb2_id > '$old_last_post_id' AND c.cb2_id <= '$new_last_post_id'  ORDER BY c.cb2_datestamp DESC";

	if($sql -> db_Select_gen($qry)) {
		$obj2 = new convert;
		$cbpost = $sql -> db_getList();

		$cb2_last_post = 0;

		foreach($cbpost as $cb){
			list($cb2_uid, $cb2_nick) = explode(".", $cb['cb2_nick'], 2);

			// ###########################
			// LAST POST VALUE
			// ###########################
			if($cb2_last_post == 0){
				$cb2_last_post = $cb['cb2_id'];
			}

			$cb2_id = $cb['cb2_id'];

			// ###########################
			// NICK
			// ###########################
			// SET UP NICK
			if($cb['user_name']){
				if (USERID  && (isset($pref['gold_chatbox'])) && ($pref['cb2_gold_enable']== 1) ){
					// IF USER AND GOLD SYSTEM INSTALLED AND CHATBOX ENABLES GOLD
					$sql -> db_Select("gold_system", "id, orb", "id={$cb2_uid} LIMIT 1");
					$row = $sql -> db_Fetch();
					if ($row['orb'] != "") {
		        		$cb2_nick= "
							<DIV class='{$row['orb']}' style='height:15px;' id='b_{$row['id']}'>
								<a href='".e_BASE."user.php?id.{$cb2_uid}'>{$cb['user_name']}</a>
				         </DIV>
						";
	          	}else if( ($pref['cb2_name_font_color']) &&($pref['cb2_custom_look'] == 1) ){
						// OTHERWISE CHECK IF CHATBOX CUSTOM LOOK ENABLED
						$cb2_nick = "
							<a href='".e_BASE."user.php?id.{$cb2_uid}'>
								<span style='color:#".$pref['cb2_name_font_color']."'>
									{$cb['user_name']}
								</span>
							</a>
						";
					}else{
						// OTHERWISE PLAIN OLE NICK LOOK
						$cb2_nick = "
							<a href='".e_BASE."user.php?id.{$cb2_uid}'>
								{$cb['user_name']}
							</a>
						";
					}
				}else if( ($pref['cb2_name_font_color']) && ($pref['cb2_custom_look'] == 1) ){
					// NOT GOLD SYS SO CHECK IF CHATBOX CUSTOM LOOK ENABLED
					$cb2_nick = "
						<a href='".e_BASE."user.php?id.{$cb2_uid}'>
							<span style='color:#".$pref['cb2_name_font_color']."'>{$cb['user_name']}</span>
						</a>
					";
				}else{
					$cb2_nick = "
						<a href='".e_BASE."user.php?id.{$cb2_uid}'>
							{$cb['user_name']}
						</a>
					";
				}
			}else{
				// MAKE ANON NICK NAME
				$cb2_nick = $tp -> toHTML($cb2_nick,FALSE,'USER_TITLE, emotes_off, no_make_clickable');
				$cb2_nick = str_replace("Anonymous", LAN_ANONYMOUS, $cb2_nick);
			}

			// ###########################
			// DATESTAMP
			// ###########################
			$cb2_datestamp = $obj2->convert_date($cb['cb2_datestamp'], "short");

			$emotes_active = $pref['cb2_emote'] ? 'USER_BODY, emotes_on' : 'USER_BODY, emotes_off';

			// ###########################
			// CHAT MESSAGE
			// ###########################
			$cb2_message = $cb['cb2_message'];

			// DISABLE TAGS
			$search[0] = "/\</si";
			$replace[0] = "&lt";
			$cb2_message = preg_replace($search, $replace, $cb2_message);

			$cb2_message = $tp -> toHTML($cb2_message, FALSE, $emotes_active, $cb2_uid, $pref['menu_wordwrap']);

			if($pref['cb2_user_font_color_activate'] == 1){
				if($cb['cb2_color'] != ""){
					$cb2_message = "<span style='color:#".$cb['cb2_color']."'>".$cb2_message."</span>";
				}else if ( ($pref['cb2_msg_font_color']) && ($pref['cb2_custom_look'] == 1) ){
					$cb2_message = "<span style='color:#".$pref['cb2_msg_font_color']."'>".$cb2_message."</span>";
				}
			}else if ( ($pref['cb2_msg_font_color']) && ($pref['cb2_custom_look'] == 1) ){
				$cb2_message = "<span style='color:#".$pref['cb2_msg_font_color']."'>".$cb2_message."</span>";
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
			$cbcontrol = "";
			// IF DELETE POSTS ALLOWED
			if( ((USERID == $cb2_uid) || CB2_MOD) && ($pref['cb2_enable_deletes'] == 1) ){
				$cbcontrol = "
					<input class='tbox' type='hidden' id='cb2_delete_message_id' name='cb2_delete_message_id' value='".$cb2_id."' />
					<INPUT TYPE='image' SRC='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/images/delete.png' HEIGHT='8' WIDTH='8' BORDER='0' ALT='".CB2_L35." - #".$cb2_id."' onClick=\"this.form.cb2_mute_user.value='';this.form.submit();\">
				";
			}

			// APPEND IF MUTING IS ENABLED AND NOT A MODS POST
			if( (CB2_MOD) && ($pref['cb2_enable_muting'] == 1) && ($cb2_uid != USERID) ){
				$cbcontrol .= "
					<input class='tbox' type='hidden' id='cb2_mute_user' name='cb2_mute_user' value='".$cb2_uid."' />
					<INPUT TYPE='image' SRC='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/images/mute.png' HEIGHT='8' WIDTH='8' BORDER='0' ALT='".CB2_L36."' onClick='this.form.submit();'>
			 	";
			}

			// ###########################
			// CHATBOX FORMATTING
			// ###########################
			global $CHATBOXSTYLE;
			if(!$CHATBOXSTYLE){
			// default chatbox style
				$CHATBOXSTYLE = "
					<div style='text-align:center;' class='spacer'>
					{BULLET}
					<b>{USERNAME}</b>
					{GOLDBREAK}
				";

				if($pref['cb2_show_date'] == 1){
					$CHATBOXSTYLE .= "
					<span class='smallblacktext'>
					{TIMEDATE}
					<br />
					{CBCONTROL}
					</span>
					<br />
					<span class='smalltext'>
					{MESSAGE}
					</span>
					</div>
					<hr>
					";

				}else{
					$CHATBOXSTYLE .= "
					<span class='smallblacktext'>
					{CBCONTROL}
					</span>
					<br />
					<span class='smalltext'>
					{MESSAGE}
					</span>
					</div>
					<hr>
					";

				}
			}

			// NOW WRAP IN CHATBOXSTYLE_II
			$CHATBOXSTYLE_II = "
				<!-- chatbox II -->
			";

			$CHATBOXSTYLE_II .= "
				<form method='post' action='' onLoad='this.action=this.cb2_eself.value;'>
			";

			$CHATBOXSTYLE_II .= $CHATBOXSTYLE;

			$CHATBOXSTYLE_II .= "
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

			$search[0] = "/\{USERNAME\}(.*?)/si";
			$replace[0] = $cb2_nick;

			if($pref['cb2_show_date'] == 1){
				$search[1] = "/\{TIMEDATE\}(.*?)/si";
				if(  ($pref['cb2_date_font_color'])  && ($pref['cb2_custom_look'] == 1) ){
					$replace[1] = "<span style='color:#".$pref['cb2_date_font_color']."'>[".$cb2_datestamp."]</span>";
				}else{
					$replace[1] = "[".$cb2_datestamp."]";
				}
			}else{
				$search[1] = "/\{TIMEDATE\}(.*?)/si";
				$replace[1] = "";
			}

			$search[2] = "/\{MESSAGE\}(.*?)/si";
			$replace[2] = ($cb['cb2_blocked'] ? CB2_L6 : $cb2_message);

			$search[3] = "/\{BULLET\}(.*?)/si";
			$replace[3] = $bullet;

			$search[4] = "/\{CBCONTROL\}(.*?)/si";
			$replace[4] = $cbcontrol;

			$text .= preg_replace($search, $replace, $CHATBOXSTYLE_II);

		}
	}

	// DISABLING CACHE FOR NOW
	//$e107cache->set("nq_chatbox2", $text);

	$text = str_replace(e_IMAGE, e_IMAGE_ABS, $text);

	echo $text;
	exit;
}

?>