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

// ###########################
// INITIALIZATION
// ###########################
require_once("../../class2.php");
require_once(HEADERF);

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English.php");
}

global $tp, $e107cache, $e_event, $e107, $pref, $user_pref, $footer_js, $PLUGINS_DIRECTORY;

if(!defined("e_HANDLER")){
	exit;
}

if($pref['smiley_activate']){
	require_once(e_HANDLER."emote.php");
}

if( (check_class($pref['cb2_view_class'])) && ( ($pref['cp2_layer'] == 2) || ($pref['cp2_layer'] == 3) ) ){
	//$footer_js[] = e_PLUGIN."chatbox2/chatpage.js";
    e107::js('footer', e_PLUGIN."chatbox2/chatpage.js") ;
}

if($pref['cb2_user_font_color_activate']){
	//$footer_js[] = e_PLUGIN."chatbox2/jscolor/cb2color.js";
    e107::js('footer', e_PLUGIN."chatbox2/jscolor/cb2color.js") ;
}

// ###########################
// VARS
// ###########################
$ip = $e107->getip();
 
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

// ###########################
// USER DELETE MESSAGE
// ###########################
if($_POST['cp2_delete_message_id']){
	$sql -> db_Select_gen("DELETE FROM #chatbox2 WHERE cb2_id='".$_POST['cp2_delete_message_id']."'");
	if (USERID  && (isset($pref['gold_chatbox'])) ){
		subtract_gold($pref['gold_chatbox'], USERID);
	}
}

// ###########################
// USER MUTE
// ###########################
if($_POST['cb2_mute_user']){

	// DELETE MESSAGE FIRST
	$sql -> db_Select_gen("DELETE FROM #chatbox2 WHERE cb2_id='".$_POST['cb2_delete_message_id']."'");
	if (USERID  && (isset($pref['gold_chatbox'])) ){
		subtract_gold($pref['gold_chatbox'], USERID);
	}

	// GET MUTED CLASS ID
	$cp2_mute_class = $pref['cb2_mute_class'];

	// ADD TO MUTED CLASS
	if ($sql->select('user', 'user_id, user_class', "user_id='".$_POST['cb2_mute_user']."'")){
		$row = $sql->fetch();
		$uidList[$row['user_id']] = $row['user_class'];
		require_once(e_HANDLER."userclass_class.php");
		$uclass = new e_userclass;
		$uclass->class_add($cp2_mute_class, $uidList);
	}
}

// ###########################
// SAVE MESSAGE OPTIONS
// ###########################
if($_POST['cp2_submit']){

	// IF USER IS MUTED
	if(check_class($pref['cb2_mute_class'])){
	$cp2_emessage = CB2_L25;

	// IF USER IS NOT IN POST CLASS
	}else if (!check_class($pref['cb2_post_class'])){

	$cp2_emessage = CB2_L27;

	// IF MESSAGE IS EMPTY
	}else if($_POST['cp2_message']== ""){
		$cp2_emessage = CB2_L15;

	// IF OK TO POST
	}else{

// OLD
// IF USER IS MUTED
//if( ($_POST['cp2_submit']) && (check_class($pref['cb2_mute_class'])) ){
//	$cp2_emessage = CB2_L25;
//
// IF MESSAGE IS EMPTY
//}else if( ($_POST['cp2_submit']) && (!isset($_POST['cp2_message'])) ){
//	$cp2_emessage = CB2_L15;
//
// IF OK TO POST
//}else if( ($_POST['cp2_submit']) && ($_POST['cp2_message'] != "") && (check_class($pref['cb2_post_class'])) ){


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

		// ###############################
		// CHECK FOR ALLOW USER MULTI-POST
		// ###############################
		if($pref['cb2_multipost'] == 0){
			$sql -> select("chatbox2", "cb2_nick", "1=1 ORDER BY cb2_id DESC LIMIT 1");
			$row = $sql->fetch();
			$cp2_multipost = 0;
			if( ($row[0] == $nick) && (!check_class($pref['cb2_mod_class'])) ){
				$cp2_multipost = 1;
				$cp2_emessage = CB2_L40;
			}
		}

		$cp2_message = $_POST['cp2_message'];


		// FLOOD CONTROL
		$fp = new floodprotect;
		if( ($fp -> flood("chatbox2", "cb2_datestamp")) || ($cp2_multipost != 1) || (!check_class($pref['cb2_mod_class'])) ){
			if((strlen(trim($cp2_message)) < 1000) && trim($cp2_message) != ""){


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
					$cp2_emessage = ($sql -> db_Insert("chatbox2", "0, '$nick', '$cp2_message', '$cp2_font_color', '".time()."', '0' , '$ip' ")) ? "noerr" : CB2_L30;
					if($cp2_emessage == "noerr"){
						$cp2_emessage = "";
						$edata_cp = array("cmessage" => $cp2_message, "ip" => $ip);
						//LEAVE IT TO WORK WITH CHATBOX EVENT
						$e_event -> trigger("cbox2post", $edata_cp);

						// DISABLING CACHE FOR NOW
						//$e107cache->clear("nq_chatbox2");

						if(USER){
							$cp2_emessage = ($sql -> db_Update("user", "user_chats=user_chats+1, user_lastpost='".time()."' WHERE user_id='".USERID."' ")) ? NULL : CB2_L31;
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
	}
}

// ###########################
// CREATE PAGE DESIGN
// ###########################
// IF NO ANONYMOUS POSTING ALLOWED OR MUTED
if( (!USER && ($pref['anon_post'] == 0)) || (check_class($pref['cb2_mute_class'])) ){
	$textm = "
		<div style='text-align:center'>
	";
	// HIDDEN INPUTS STILL USED FOR REFRESHING
	if( ($pref['cp2_layer'] == 2) || ($pref['cp2_layer'] == 3) ){
		$textm .= "
			<input class='tbox' type='hidden' id='cp2_full_path' name='cp2_full_path' value='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/' />
			<input class='tbox' type='hidden' id='cp2_refresh_time' name='cp2_refresh_time' value='".$pref['cp2_refresh']."' />
			<input class='tbox' type='hidden' id='cp2_refresh_submit' name='cp2_refresh_submit' value='".$pref['cp2_refresh_submit']."' />
			<input class='tbox' type='hidden' id='cp2_eself' name='cp2_eself' value='".e_SELF."' />
		";
	}
	if(!USER && ($pref['anon_post'] == 0)){
		// MUST BE LOGGED IN
		$textm .= "
			".CB2_L3."
		</div>
		";
	}else if(check_class($pref['cb2_mute_class'])) {
		// MUTED - BLOCKED
		$textm .= "
			".CB2_L25."
		</div>
		";
	}else{
		// POSTING NOT ALLOWED
		$textm .= "
			".CB2_L27."
		</div>
		";
	}

// LOGGED IN OR ANON ALLOWED
}else{

	// ###########################
	// MAKE USERS IN CHAT LIST
	// ###########################
	if ( (MEMBERS_ONLINE) && (($pref['cp2_layer'] == 2) || ($pref['cp2_layer'] == 3)) ){
		global $listuserson, $ADMIN_DIRECTORY;
		$textu = "";

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
	}

// ###########################
// CREATE CONTROL MENU
// ###########################
	if( ($pref['cp2_layer'] == 2) || ($pref['cp2_layer'] == 3) ){
		$textm =  (e_QUERY ? "
			\n
			<form id='chatpage' action='".e_SELF."?".e_QUERY."'  method='post' onsubmit='return(false);'>
			<div style='text-align:center; width:100%'>
		" : "
			\n
			<form id='chatpage' action='".e_SELF."'  method='post' onsubmit='return(false);'>
			<div style='text-align:center; width:100%'>
		");
		$textm .= "
				<input class='tbox' type='hidden' id='cp2_username' name='cp2_username' value='".$nick."' />
				<input class='tbox' type='hidden' id='cp2_ip' name='cp2_ip' value='".$ip."' />
		";
	}else{
		$textm =  (e_QUERY ? "
			\n
			<form id='chatpage' method='post' action='".e_SELF."?".e_QUERY."'>
			<div style='text-align:center; width:100%'>
		" : "
			\n
			<form id='chatpage' method='post' action='".e_SELF."'>
			<div style='text-align:center; width:100%'>
		");
	}

	$textm .= "
				<input class='tbox' type='hidden' id='cp2_full_path' name='cp2_full_path' value='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/' />
				<input class='tbox' type='hidden' id='cp2_refresh_time' name='cp2_refresh_time' value='".$pref['cp2_refresh']."' />
				<input class='tbox' type='hidden' id='cp2_refresh_submit' name='cp2_refresh_submit' value='".$pref['cp2_refresh_submit']."' />
				<input class='tbox' type='hidden' id='cp2_eself' name='cp2_eself' value='".e_SELF."' />
	";

	// HEADER
	if($pref['cp2_header'] != ""){
		$textm .= "
			".$pref['cp2_header']."
		<br />
		";
	}

	// ON CLICK
	if( ($pref['cp2_layer'] == 2) || ($pref['cp2_layer'] == 3) ){
		$oc = "onclick=\"javascript:cpSendChat();cp2CloseEmotes();this.form.cp2_message.focus();\"";
	}else{
		$oc = "";
	}

	// TEXT BOX
	$textm .= "
		<textarea id='cp2_message' name='cp2_message' wrap='hard' class='tbox chatbox' cols='20' rows='5' ".$font_color_data." style='width:80%; overflow:auto' onselect='storeCaret(this);' onclick='storeCaret(this);' onfocus='storeCaret(this);' onkeyup='storeCaret(this);'></textarea>
		<br />
		<input id='cp2_submit'name='cp2_submit' class='button' type='submit' value='".CB2_L4."' {$oc}/>
		<input id='cp2_reset' name='cp2_reset' class='button' type='reset' value='".CB2_L5."'/>
	";

	// SOUND
	if($pref['cb2_sound_activate'] == 1){

		if(USER){

			// IF USER SOUND CHANGE
			if($_POST['cp2_sound_status'] == 111){

				if($user_pref['cp2_sound'] == 1){
					$user_pref['cp2_sound'] = 0;
					$cp2_user_sound = 0;
					$cp2_sound_image = 'soundoff.png';
				} else {
					$user_pref['cp2_sound'] = 1;
					$cp2_user_sound = 1;
					$cp2_sound_image = 'soundon.png';
				}
				save_prefs('user');

			}else if(isset($user_pref['cp2_sound'])){
				$cp2_user_sound = $user_pref['cp2_sound'];
			}else{
				$cp2_user_sound = 0;
				$cp2_sound_image = 'soundoff.png';
			}

			if($cp2_user_sound == 1){
				$cp2_volume = $pref['cb2_sound_volume'];
				$cp2_sound_image = 'soundon.png';
			}else{
				$cp2_volume = 0;
				$cp2_sound_image = 'soundoff.png';
			}

			$textm .= "
				<embed id='cp2_newpost_sound' src='".$pref['cb2_sound_source']."' type='application/x-mplayer2' autostart='false' loop='false' volume='".$cp2_volume."' height='0' width='0' />
				<input class='tbox' type='hidden' id='cp2_sound_status' name='cp2_sound_status' value='".$cp2_user_sound."' />
				<input type='image'src='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/images/".$cp2_sound_image."' size='16,16' border='0' style='vertical-align:bottom;text-align:top;' onClick=\"this.form.cp2_sound_status.value='111';submit();return false;\" />
			";
		}
	}

	// SET UP MESSAGE FONT COLOR
	if ( ($user_pref['cb2_user_font_color']) && ($pref['cb2_user_font_color_activate'] == 1) ){
		$font_color_data = "value='".$user_pref['cb2_user_font_color']."'";
	}else if(  ($pref['cp2_msg_font_color']) && ($pref['cp2_custom_look'] == 1) ){
		$font_color_data = "value='".$pref['cp2_msg_font_color']."'";
	}else{
		$font_color_data = "";
	}

	// EMOTES
	if($pref['cb2_emote'] && $pref['smiley_activate']){
		$textm .= "
			<input class='button' type ='button' style='cursor:pointer' size='30' value='".CB2_L14."' onclick=\"expandit('cp2_emote');this.form.cp2_message.focus();\" />
		";
	}

	// COLOR SELECTOR
	if($pref['cb2_user_font_color_activate'] == 1){
		$textm .= "
			<span id='font_title' style='font-size:13px;'>".CB2_L32."</span>
			<input id='cp2_user_font_color'name='cp2_user_font_color' class='cb2color' type='text' style='vertical-align:bottom;text-align:top;width:10px;height:10px' ".$font_color_data." size='3' maxlength='7' />
		";
	}

	$textm .= "
			</div>
		";

	// EMOTES
	if($pref['cb2_emote'] && $pref['smiley_activate']){
		$textm .= "
			<div style='display:none' id='cp2_emote'>".r_emote()."</div>
		";
	}

	$textm .= "
		</form>
	";
}

// ###########################
// MESSAGE - ERRORS
// ###########################
$textm .= "
	<br />
	<div id='cp2_emessage' style='text-align:center;height:12px;'>
		<b>".$cp2_emessage."</b>
	</div>
";

// ###########################
// CREATE CHAT AREA
// ###########################
// DISABLING CACHE FOR NOW
//if( (!$textc = $e107cache->retrieve("nq_chatbox2")) && (check_class($pref['cb2_view_class'])) ){
if(check_class($pref['cb2_view_class'])) {

	// ###########################
	// SET VARS
	// ###########################
	$textc ="";
	global $pref,$tp;
	$cp2_initial_posts = $pref['cp2_initial_posts'] = ($pref['cp2_initial_posts'] ? $pref['cp2_initial_posts'] : 0);

	if(!$pref['cb2_mod_class']){
		$pref['cb2_mod_class'] = e_UC_ADMIN;
	}
	define("CP2_MOD", check_class($pref['cb2_mod_class']));

	// ###########################
	// GET CHATS FROM DB
	// ###########################
	if($cp2_initial_posts == 0){
		// GET LAST ID IF NO INITIAL POSTS WANTED
		$sql->select("chatbox2", "cb2_id", "1='1' ORDER BY cb2_datestamp DESC LIMIT 1");
		$row = $sql->fetch();
		$cp2_last_post = $row[0];

	}else{

		// ELSE GET INITIAL POSTS
		$qry = "
		SELECT c.*, u.user_name FROM #chatbox2 AS c
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(c.cb2_nick,'.',1) = u.user_id
		ORDER BY c.cb2_datestamp DESC LIMIT 0, ".intval($cp2_initial_posts);

		if($sql -> db_Select_gen($qry)) {
			$obj2 = new convert;
			$cp2_post = $sql -> db_getList();

			$cp2_last_post = 0;

			foreach($cp2_post as $cp){
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
						$sql -> select("gold_system", "id, orb", "id={$cp2_uid} LIMIT 1");
						$row = $sql -> fetch();
						if ($row['orb'] != "") {
							// IF ORB IS ON
							$cp2_nick= "
								<DIV class='{$row['orb']}' style='height:15px;' id='b_{$row['id']}'>
									<a href='".e_BASE."user.php?id.{$cp2_uid}'>{$cp['user_name']}</a>
					         </DIV>
							";
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
				//$cp2_datestamp = $obj2->convert_date($cp['cb2_datestamp'], "short");
                $cp2_datestamp = $tp->toDate($cp['cb2_datestamp'], "relative");

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
					}else if ( ($pref['cp2_msg_font_color']) && ($pref['cp2_custom_look'] == 1) ){
						$cp2_message = "<span style='color:#".$pref['cp2_msg_font_color']."'>".$cp2_message."</span>";
					}
				}else if ( ($pref['cp2_msg_font_color']) && ($pref['cp2_custom_look'] == 1) ){
					$cp2_message = "<span style='color:#".$pref['cp2_msg_font_color']."'>".$cp2_message."</span>";
				}

				// ###########################
				// BULLET
				// ###########################
				if($pref['cb2_show_bullet'] == 1){
				//	$bullet = (defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle;' />" : "<img src='".THEME_ABS."images/".(defined("BULLET") ? BULLET : "bullet2.gif")."' alt='' style='vertical-align: middle;' />");
//Bullet
if(defined("BULLET"))
{
	$bullet = "<img src='".THEME_ABS."images/".BULLET."' alt='' class='icon' style='vertical-align: middle;'/>";
	$bullet_src = THEME_ABS."images/".BULLET;
}
elseif(file_exists(THEME."images/bullet2.gif"))
{
	$bullet = "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' class='icon' style='vertical-align: middle;' />";
	$bullet_src = THEME_ABS."images/bullet2.gif";
}
else
{
	$bullet = "";
	$bullet_src = "";
}
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
						<INPUT TYPE='image' SRC='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/images/delete.png' HEIGHT='8' WIDTH='8' BORDER='0' ALT='".CB2_L35." - #".$cp2_id."' onClick=\"this.form.cp2_mute_user.value='';this.form.submit();\">
					";

				}

				// APPEND IF MUTING IS ENABLED AND NOT A MODS POST
				if( (CP2_MOD) && ($pref['cb2_enable_muting'] == 1) && ($cp2_uid != USERID) ){
					$cp_control .= "
						<input class='tbox' type='hidden' id='cp2_mute_user' name='cp2_mute_user' value='".$cp2_uid."' />
						<INPUT TYPE='image' SRC='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/images/mute.png' HEIGHT='8' WIDTH='8' BORDER='0' ALT='".CB2_L36."' onClick='this.form.submit();'>
				 	";
				}

				// ###########################
				// CHATPAGE FORMATTING
				// ###########################
				global $CHATPAGESTYLE;

	if (!$CHATPAGESTYLE) {
		if (file_exists(THEME."chatbox2/chat2_template.php"))
		{
			require_once(THEME."chatbox2/chat2_template.php");
		}
		else
		{
			require_once(e_PLUGIN."chatbox2/templates/chat2_template.php");
		}
	}
 

				// NOW WRAP IN CHATPAGESTYLE_WRAP
				$CHATPAGESTYLE_WRAP = "
					<!-- chat page -->
				";

				$CHATPAGESTYLE_WRAP .= (e_QUERY ? "
					<form method='post' action='".e_SELF."?".e_QUERY."'>
					" : "
					<form method='post' action='".e_SELF."'>
				");

				$CHATPAGESTYLE_WRAP .= $CHATPAGESTYLE;

				$CHATPAGESTYLE_WRAP .= "
					</form>
				";


				// MICKEY MOUSE FIX FOR GOLD WHEN NAME HAS NO ORB DONE
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

				$textc .= preg_replace($search, $replace, $CHATPAGESTYLE_WRAP);
			}
		}
	}
	// ###########################
	// MODERATE - VIEW REMAINING
	// ###########################
	$total_chats = $sql -> db_Count("chatbox2");

	if($total_chats > $cp2_initial_posts || CP2_MOD) {

		$show_total = $total_chats - $cp2_initial_posts;
		if ($show_total < 0){
			$show_total = 0;
		}

		$textr = "
			<br />
			<div style='text-align:center'>
				<input class='tbox' type='hidden' id='cp2_last_post' name='cp2_last_post' value='".$cp2_last_post."' />
				<a href='".e_PLUGIN."chatbox2/chat2.php'>".(CP2_MOD ? CB2_L13 : CB2_L12)."</a> (".$show_total.")
			</div>
		";
	}else{
		$textr = "
			<br />
			<div style='text-align:center'>
				<input class='tbox' type='hidden' id='cp2_last_post' name='cp2_last_post' value='".$cp2_last_post."' />
			</div>
		";
	}

// DISABLING CACHE FOR NOW
//	$e107cache->set("nq_chatbox2", $textc);

}else if (check_class(!$pref['cb2_view_class'])) {

	$textc = "";
}

$caption = (file_exists(THEME."images/chatbox2.png") ? "<img src='".THEME_ABS."images/chatbox2.png' alt='' /> ".CB2_CP40 : CB2_CP40);


// ###############################
// NO SCROLL = ZERO - TWO
// ###############################
if( ($pref['cp2_layer'] == 0) ||  ($pref['cp2_layer'] == 2) ){

	$texto = $textm."
		<div id='chat_page_posts' style='width:auto; overflow:auto; '>
		".$textc."
		</div>
		<br />
		<br />
	";

	if($pref['cp2_layer'] == 2){
		$texto .= "
			<b>".CB2_CP50."</b><br />
			<div id='chat_page_users' style='padding : 4px; width : auto; height : ".$pref['cp2_layer_height']."px; overflow : auto; '>
				".$textu."
			</div>
		";
	}
	$texto = $texto.$textr;

// ###############################
// SCROLL -  ONE - THREE
// ###############################
}else if( ($pref['cp2_layer'] == 1) || ($pref['cp2_layer'] == 3) ) {

	if($pref['cp2_custom_look'] == 1){

		$texto = "";

		if( ($pref['cp2_layer'] == 3) && ($pref['cp2_ul_top'] == 1) ) {

			$texto .= "
			<table width='100%'>
			<tr>
			<td style='border:0; width:100%;'>
				<b>".CB2_CP50."</b><br />
				<div id='chat_page_users' style='border :".$pref['cp2_border_size']."; border-style: solid; border-color:#".$pref['cp2_border_color']."; background-color:#".$pref['cp2_bg_color'].";  padding : 4px; width : auto; height:auto; overflow : auto; '>
					".$textu."
				</div>
			</td>
			</tr>
			</table>
			<br />
			<br />
			";

		}

		$texto .= $textm."
			<table width='100%'>
			<tr>
			<td style='border:0; width:100%;'>
			<div id='chat_page_posts' style='padding : 4px; width : auto; border :".$pref['cp2_border_size']."; border-style: solid; border-color:#".$pref['cp2_border_color'].";
		";
		if($pref['cp2_bg_color']){
			$texto .= "
				background-color:#".$pref['cp2_bg_color'].";
			";
		}
		$texto .= "
			 height : ".$pref['cp2_layer_height']."px; overflow : auto; '>
				".$textc."
			</div>
			</td>
			</tr>
		";

		if( ($pref['cp2_layer'] == 3) && ($pref['cp2_ul_top'] == 0) ) {

			$texto .= "
			<tr>
			<td style='border:0; width:100%;'>
				<br />
				<br />
				<b>".CB2_CP50."</b><br />
				<div id='chat_page_users' style='border :".$pref['cp2_border_size']."; border-style: solid; border-color:#".$pref['cp2_border_color']."; background-color:#".$pref['cp2_bg_color'].";  padding : 4px; width : auto; height:auto; overflow : auto; '>
					".$textu."
				</div>
			</td>
			</tr>
			";
		}

		$texto .= "
			</table>
			".$textr
		;
	}else{

		$texto = "";

		if( ($pref['cp2_layer'] == 3) && ($pref['cp2_ul_top'] == 1) ) {

			$texto .= "
			<table width='100%'>
			<tr>
			<td style='border:0; width:100%;'>
				<b>".CB2_CP50."</b><br />
				<div id='chat_page_users' style='padding : 4px; width : auto; height : auto; overflow : auto; '>
					".$textu."
				</div>
			</td>
			</tr>
			</table>
			<br />
			<br />
			";

		}

		$texto .= $textm."
			<table width='100%'>
			<tr>
			<td style='border:0; width:100%;'>
			<div id='chat_page_posts' style='padding : 4px; width : auto; height : ".$pref['cp2_layer_height']."px; overflow : auto; '>
				".$textc."
			</div>
			</td>
			</tr>
		";

		if( ($pref['cp2_layer'] == 3) && ($pref['cp2_ul_top'] == 0) ) {

			$texto .= "
			<tr>
			<td style='border:0; width:100%;'>
				<br />
				<br />
				<b>".CB2_CP50."</b><br />
				<div id='chat_page_users' style='padding : 4px; width : auto; height : auto; overflow : auto; '>
					".$textu."
				</div>
			</td>
			</tr>
			";
		}

		$texto .= "
			</table>
			".$textr
		;
	}
}

$ns -> tablerender($caption, $texto, CB2_CP40);

require_once(FOOTERF);

?>