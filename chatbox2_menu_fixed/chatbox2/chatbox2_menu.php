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
//require_once("../../class2.php");

// ###########################
// INITIALIZATION
// ###########################
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

if( (check_class($pref['cb2_view_class'])) && ( ($pref['cb2_layer'] == 2) || ($pref['cb2_layer'] == 3) ) ){
	$footer_js[] = e_PLUGIN."chatbox2/chatbox2.js";
}

if($pref['cb2_user_font_color_activate']){
	$footer_js[] = e_PLUGIN."chatbox2/jscolor/cb2color.js";
}

// ###########################
// VARS
// ###########################
$ip = $e107->getip();

// ###########################
// DIAGS
// ###########################
//echo "<br>GET<br>";
//$getar = $_GET;
//$getkeys = array_keys($getar);
//
//for($i=0; $i<count($getkeys); $i++){
//$k = $getkeys[$i];
//$v = $getar[$k];
//${$k}=$v;
//echo "$k = $v<br>";
//}
//
//echo "<br>POST<br>";
//$getar = $_POST;
//$getkeys = array_keys($getar);
//
//for($i=0; $i<count($getkeys); $i++){
//$k = $getkeys[$i];
//$v = $getar[$k];
//${$k}=$v;
//echo "$k = $v<br>";
//}


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

// ###########################
// DELETE MESSAGE
// ###########################
// If Delete allowed from MOD or User
if($_POST['cb2_delete_message_id']){
	$sql -> db_Select_gen("DELETE FROM #chatbox2 WHERE cb2_id='".$_POST['cb2_delete_message_id']."'");
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
	$cb2_mute_class = $pref['cb2_mute_class'];

	// ADD TO MUTED CLASS
	if ($sql->db_Select('user', 'user_id, user_class', "user_id='".$_POST['cb2_mute_user']."'")){
		$row = $sql->db_Fetch();
		$uidList[$row['user_id']] = $row['user_class'];
		require_once(e_HANDLER."userclass_class.php");
		$uclass = new e_userclass;
		$uclass->class_add($cb2_mute_class, $uidList);
	}
}

// ###########################
// SAVE MESSAGE OPTIONS
// ###########################
if($_POST['cb2_submit']){

	// IF USER IS MUTED
	if(check_class($pref['cb2_mute_class'])){
	$cb2_emessage = CB2_L25;

	// IF USER IS NOT IN POST CLASS
	}else if (!check_class($pref['cb2_post_class'])){

	$cb2_emessage = CB2_L27;

	// IF MESSAGE IS EMPTY
	}else if($_POST['cb2_message']== ""){
		$cb2_emessage = CB2_L15;

	// IF OK TO POST
	}else{

// #####################################
// IGNORE _ FOR FUTURE NAME COLORS MAYBE
// #####################################
//		// #########################
//		// GET USER CLASS COLOR PREF
//		// #########################
//	$cb2_oi_name_color = $pref['onlineinfo_admincolour'];
//
//		if(check_class('254') && $user_perms=="0"){
//			$user_pref['cb2_oi_class_color'] = $pref['onlineinfo_headadmincolour'];
//			echo "main<br />";
//		}else if(check_class($userclass='254')){
//			echo "admin<br />";
//			$user_pref['cb2_oi_class_color'] = $pref['onlineinfo_admincolour'];
//		}else if(check_class($userclass='253')){
//			$script="SELECT forum_moderators FROM ".MPREFIX."forum WHERE forum_parent <> '0' GROUP BY forum_moderators";
//			$fmod_sql = new db;
//			$fmod = $fmod_sql->db_Select_gen($script);
//			while ($row2 = $fmod_sql->db_Fetch()){
//				if(check_class($row2[0])){
//					$fresult=1;
//					continue;
//				}else{
//					$fresult=0;
//				}
//			}
//			echo "Mod match".$fresult."<br />";
//			if($fresult == 1){
//				echo "mod<br />";
//				$user_pref['cb2_oi_class_color'] = $pref['onlineinfo_modcolour'];
//			}else{
//				echo "member<br />";
//				$user_pref['cb2_oi_class_color'] = $pref['onlineinfo_memcolour'];
//			}
//		}
//		save_prefs('user');

		// #########################
		// SAVE USER FONT COLOR PREF
		// #########################
		if($_POST['cb2_user_font_color']){
			$cb2_user_font_color = $_POST['cb2_user_font_color'];
			if(USER){
				$user_pref['cb2_user_font_color'] =  $cb2_user_font_color ;
				save_prefs('user');
			}
		}

		$cb2_emessage='';

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

		// FLOOD CONTROL
		$fp = new floodprotect;
		if( ($fp -> flood("chatbox2", "cb2_datestamp")) || ($cb2_multipost != 1) || (!check_class($pref['cb2_mod_class'])) ){
			if((strlen(trim($cb2_message)) < 1000) && trim($cb2_message) != ""){

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
						$cb2_emessage = "";
						$edata_cb = array("cmessage" => $cb2_message, "ip" => $ip);
						//LEAVE IT TO WORK WITH EVENT
						$e_event -> trigger("cbox2post", $edata_cb);

						// DISABLING CACHE FOR NOW
						//$e107cache->clear("nq_chatbox2");

						if(USER){
							$cb2_emessage = ($sql -> db_Update("user", "user_chats=user_chats+1, user_lastpost='".time()."' WHERE user_id='".USERID."' ")) ? NULL : CB2_L31;
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
	}
}


// ###########################
// CREATE PAGE DESIGN
// ###########################
// IF NO ANONYMOUS POSTING ALLOWED OR MUTED
if( (!USER && ($pref['anon_post'] == 0)) || (check_class($pref['cb2_mute_class'])) || (!check_class($pref['cb2_post_class'])) ){
	$textm = "
		<div style='text-align:center'>
	";
	// HIDDEN INPUTS STILL USED FOR REFRESHING
	if( ($pref['cb2_layer'] == 2) || ($pref['cb2_layer'] == 3) ){
		$textm .= "
			<input class='tbox' type='hidden' id='cb2_full_path' name='cb2_full_path' value='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/' />
			<input class='tbox' type='hidden' id='cb2_refresh_time' name='cb2_refresh_time' value='".$pref['cb2_refresh']."' />
			<input class='tbox' type='hidden' id='cb2_refresh_submit' name='cb2_refresh_submit' value='".$pref['cb2_refresh_submit']."' />
			<input class='tbox' type='hidden' id='cb2_eself' name='cb2_eself' value='".e_SELF."' />
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
	// CREATE CONTROL MENU
	// ###########################
	// SET UP MENU WITH HIDDEN FOR AJAX
	if( ($pref['cb2_layer'] == 2) || ($pref['cb2_layer'] == 3) ){
		$textm = (e_QUERY ? "
			\n
			<form id='chatbox2' action='".e_SELF."?".e_QUERY."'  method='post' onsubmit='return(false);'>
			<div style='text-align:center; width:100%'>
		" : "
			\n
			<form id='chatbox2' action='".e_SELF."'  method='post' onsubmit='return(false);'>
			<div style='text-align:center; width:100%'>
		");
		$textm .= "
				<input class='tbox' type='hidden' id='cb2_username' name='cb2_username' value='".$nick."' />
				<input class='tbox' type='hidden' id='cb2_ip' name='cb2_ip' value='".$ip."' />
		";
	}else{
		$textm = (e_QUERY ? "
			\n
			<form id='chatbox2' method='post' action='".e_SELF."?".e_QUERY."'>
			<div style='text-align:center; width:100%'>
			" : "
			\n
			<form id='chatbox2' method='post' action='".e_SELF."'>
			<div style='text-align:center; width:100%'>
		");
	}

	$textm .= "
				<input class='tbox' type='hidden' id='cb2_full_path' name='cb2_full_path' value='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/' />
				<input class='tbox' type='hidden' id='cb2_refresh_time' name='cb2_refresh_time' value='".$pref['cb2_refresh']."' />
				<input class='tbox' type='hidden' id='cb2_refresh_submit' name='cb2_refresh_submit' value='".$pref['cb2_refresh_submit']."' />
				<input class='tbox' type='hidden' id='cb2_eself' name='cb2_eself' value='".e_SELF."' />
	";

	// HEADER
	if($pref['cb2_header'] != ""){
		$textm .= "
			".$pref['cb2_header']."
		<br />
		";
	}

	// ON CLICK FOR DYNAMIC (ALSO CLOSES EMOTES (1.4.6)
	if( ($pref['cb2_layer'] == 2) || ($pref['cb2_layer'] == 3) ){
		$oc = "onclick=\"javascript:cb2SendChat();cb2CloseEmotes();this.form.cb2_message.focus();\"";
	}else{
		$oc = "";
	}

	// TEXT BOX
	$textm .= "
		<textarea id='cb2_message' name='cb2_message' wrap='hard' class='tbox chatbox' cols='15' rows='5' ".$font_color_data." style='overflow: auto' onselect='storeCaret(this);' onclick='storeCaret(this);' onfocus='storeCaret(this);' onkeyup='storeCaret(this);'></textarea>
		<br />
		<input id='cb2_submit'name='cb2_submit' class='button' type='submit' value='".CB2_L4."' {$oc}/>
		<input id='cb2_reset' name='cb2_reset' class='button' type='reset' value='".CB2_L5."'/>
		<br />
	";

	// SOUND
	if($pref['cb2_sound_activate'] == 1){

		if(USER){

			// IF USER SOUND CHANGE
			if($_POST['cb2_sound_status'] == 111){

				if($user_pref['cb2_sound'] == 1){
					$user_pref['cb2_sound'] = 0;
					$cb2_user_sound = 0;
					$cb2_sound_image = 'soundoff.png';
				} else {
					$user_pref['cb2_sound'] = 1;
					$cb2_user_sound = 1;
					$cb2_sound_image = 'soundon.png';
				}
				save_prefs('user');

			}else if(isset($user_pref['cb2_sound'])){
				$cb2_user_sound = $user_pref['cb2_sound'];
			}else{
				$cb2_user_sound = 0;
				$cb2_sound_image = 'soundoff.png';
			}

			if($cb2_user_sound == 1){
				$cb2_volume = $pref['cb2_sound_volume'];
				$cb2_sound_image = 'soundon.png';
			}else{
				$cb2_volume = 0;
				$cb2_sound_image = 'soundoff.png';
			}

			$textm .= "
				<embed id='cb2_newpost_sound' src='".$pref['cb2_sound_source']."' type='application/x-mplayer2' autostart='false' loop='false' volume='".$cb2_volume."' height='0' width='0' />
				<input class='tbox' type='hidden' id='cb2_sound_status' name='cb2_sound_status' value='".$cb2_user_sound."' />
				<input type='image'src='".SITEURLBASE."".e_PLUGIN_ABS."chatbox2/images/".$cb2_sound_image."' size='16,16' border='0' style='vertical-align:bottom;text-align:top;' onClick=\"this.form.cb2_sound_status.value='111';submit();return false;\" />
			";
		}
	}

	// SET UP MESSAGE FONT COLOR
	if ( ($user_pref['cb2_user_font_color']) && ($pref['cb2_user_font_color_activate'] == 1) ){
		$font_color_data = "value='".$user_pref['cb2_user_font_color']."'";
	}else if(  ($pref['cb2_msg_font_color']) && ($pref['cb2_custom_look'] == 1) ){
		$font_color_data = "value='".$pref['cb2_msg_font_color']."'";
	}else{
		$font_color_data = "";
	}

	// EMOTES
	if($pref['cb2_emote'] && $pref['smiley_activate']){
		$textm .= "
			<input class='button' type ='button' style='cursor:pointer' size='30' value='".CB2_L14."' onclick=\"expandit('cb2_emote');this.form.cb2_message.focus();\" />
		";
	}

	// COLOR SELECTOR
	if($pref['cb2_user_font_color_activate'] == 1){
		$textm .= "
			<span id='font_title' style='font-size:13px;'>".CB2_L32."</span>
			<input id='cb2_user_font_color' name=' cb2_user_font_color_selector' class='cb2color' type='text' style='vertical-align:bottom;text-align:top;width:10px;height:10px' $font_color_data size='3' maxlength='7'/>
		";
	}

	$textm .= "
		</div>
		";

	// EMOTES
	if($pref['cb2_emote'] && $pref['smiley_activate']){
		$textm .= "
			<div style='display:none' id='cb2_emote'>".r_emote()."</div>
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
	<div id='cb2_emessage' style='text-align:center;height:12px;'>
		<b>".$cb2_emessage."</b>
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
	global $pref, $tp;
	$cb2_initial_posts = $pref['cb2_initial_posts'] = ($pref['cb2_initial_posts'] ? $pref['cb2_initial_posts'] : 0);

	if(!$pref['cb2_mod_class']){
		$pref['cb2_mod_class'] = e_UC_ADMIN;
	}
	define("CB2_MOD", check_class($pref['cb2_mod_class']));

	// ###########################
	// GET CHATS FROM DB
	// ###########################
	if($cb2_initial_posts == 0){
		// GET LAST ID IF NO INITIAL POSTS WANTED
		$sql->db_Select("chatbox2", "cb2_id", "1='1' ORDER BY cb2_datestamp DESC LIMIT 1");
		$row = $sql->db_Fetch();
		$cb2_last_post = $row[0];

	}else{

		// ELSE GET INITIAL POSTS
		$qry = "
		SELECT c.*, u.user_name FROM #chatbox2 AS c
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(c.cb2_nick,'.',1) = u.user_id
		ORDER BY c.cb2_datestamp DESC LIMIT 0, ".intval($cb2_initial_posts);

		if($sql -> db_Select_gen($qry)) {
			$obj2 = new convert;
			$cb2_post = $sql -> db_getList();

			$cb2_last_post = 0;

			foreach($cb2_post as $cb){
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
							// IF ORB IS ON

			        		$cb2_nick= "
								<DIV class='{$row['orb']}' style='height:15px;' id='b_{$row['id']}'>
									<a href='".e_BASE."user.php?id.{$cb2_uid}'>{$cb['user_name']}</a>
					         </DIV>
							";

//			        		// STUPID BROWSERS - THIS WORKS RIGHT IN IE6 - NON BLOCK ITEM FAILS IN NEW BROWSERS
//			        		$cb2_nick= "
//								<span style='width:100%' CLASS='{$row['orb']}'id='b_{$row['id']}'>
//									<a href='".e_BASE."user.php?id.{$cb2_uid}'>{$cb['user_name']}</a>
//					         </span>
//							";


//			        		$cb2_nick= "
//			        			<table style='width:100%;'>
//			        				<tr>
//			        					<td style='width:100%;'>
//											<div class='{$row['orb']}'id='b_{$row['id']}'>
//												<a href='".e_BASE."user.php?id.{$cb2_uid}'>{$cb['user_name']}</a>
//								         </div>
//										</td>
//									</tr>
//								</table>
//							";

//FUTURE
//						}else if( ($user_pref['cb2_oi_class_color']) && ($pref['cb2_custom_look'] == 1) ){
//							// OTHERWISE CHECK IF CHATBOX CUSTOM LOOK ENABLED
//							$cb2_nick = "
//								<a href='".e_BASE."user.php?id.{$cb2_uid}'>
//									<span style='color:".$user_pref['cb2_oi_class_color']."'>{$cb['user_name']}</span>
//								</a>
//							";
						}else if( ($pref['cb2_name_font_color']) && ($pref['cb2_custom_look'] == 1) ){
							// NOT GOLD SYS SO CHECK IF CHATBOX CUSTOM LOOK ENABLED
							$cb2_nick = "
								<a href='".e_BASE."user.php?id.{$cb2_uid}'>
									<span style='color:#".$pref['cb2_name_font_color']."'>{$cb['user_name']}</span>
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
//FUTURE
//					}else if( ($user_pref['cb2_oi_class_color']) && ($pref['cb2_custom_look'] == 1) ){
//						// NOT GOLD SYS SO CHECK IF CHATBOX CUSTOM LOOK ENABLED
//						$cb2_nick = "
//							<a href='".e_BASE."user.php?id.{$cb2_uid}'>
//								<span style='color:".$user_pref['cb2_oi_class_color']."'>{$cb['user_name']}</span>
//							</a>
//						";
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

				$CHATBOXSTYLE_II .= (e_QUERY ? "
					<form method='post' action='".e_SELF."?".e_QUERY."'>
					" : "
					<form method='post' action='".e_SELF."'>
				");

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

				// SEARCH REPLACE
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

				$textc .= preg_replace($search, $replace, $CHATBOXSTYLE_II);
			}
		}
	}
	// ###########################
	// MODERATE - VIEW REMAINING
	// ###########################
	$total_chats = $sql -> db_Count("chatbox2");

	if($total_chats > $cb2_initial_posts || CB2_MOD) {

		$show_total = $total_chats - $cb2_initial_posts;
		if ($show_total < 0){
			$show_total = 0;
		}
		$textr = "
			<br />
			<div style='text-align:center'>
				<input class='tbox' type='hidden' id='cb2_last_post' name='cb2_last_post' value='".$cb2_last_post."' />
				<a href='".e_PLUGIN."chatbox2/chat2.php'>".(CB2_MOD ? CB2_L13 : CB2_L12)."</a> (".$show_total.")
			</div>
		";
	}else{
		$textr = "
			<br />
			<div style='text-align:center'>
				<input class='tbox' type='hidden' id='cb2_last_post' name='cb2_last_post' value='".$cb2_last_post."' />
			</div>
		";
	}
// DISABLING CACHE FOR NOW
//	$e107cache->set("nq_chatbox2", $textc);

}else if (check_class(!$pref['cb2_view_class'])) {

	$textc = "";
}

$caption = (file_exists(THEME."images/chatbox2.png") ? "<img src='".THEME_ABS."images/chatbox2.png' alt='' /> ".CB2_L2 : CB2_L2);

// ###############################
// NO SCROLL = ZERO - TWO
// ###############################
if( ($pref['cb2_layer'] == 0) ||  ($pref['cb2_layer'] == 2) ){

	$texto = $textm."
		<div id='chatbox2_posts' style='width:auto; overflow:auto; '>
		".$textc."
		</div>
		".$textr
	;


// ###############################
// SCROLL -  ONE - THREE
// ###############################
}else if( ($pref['cb2_layer'] == 1) || ($pref['cb2_layer'] == 3) ) {

	if($pref['cb2_custom_look'] == 1){
		$texto = $textm."
			<table width='100%'>
			<tr>
			<td style='border:0; width:75%;'>
			<div id='chatbox2_posts'  style='padding : 4px; width : auto; border :".$pref['cb2_border_size']."; border-style: solid; border-color:#".$pref['cb2_border_color'].";
		";
		if($pref['cb2_bg_color']){
			$texto .= "
				background-color:#".$pref['cb2_bg_color'].";
			";
		}
		$texto .= "
			 height : ".$pref['cb2_layer_height']."px; overflow : auto; '>
			".$textc."
			</div>
			</td>
			</tr>
			</table>
			".$textr
		;

	}else{
		$texto = $textm."
			<table width='100%'>
			<tr>
			<td style='border:0; width:75%;'>
			<div id='chatbox2_posts' style='padding : 4px; width : auto; height : ".$pref['cb2_layer_height']."px; overflow : auto; '>
				".$textc."
			</div>
			</td>
			</tr>
			</table>
			".$textr
		;
	}
}


$ns -> tablerender($caption, $texto, CB2_L2);

?>