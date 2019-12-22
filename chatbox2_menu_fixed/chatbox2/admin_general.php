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

require_once("../../class2.php");

if(!getperms("P")) { header("location:".e_BASE."index.php"); exit; }

$pageid = "cb2_general";

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English_config.php");
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");

if (isset($_POST['updatesettings'])) {

	$pref['cb2_mod_class'] = $_POST['cb2_mod_class'];
	$pref['cb2_view_class'] = $_POST['cb2_view_class'];
	$pref['cb2_post_class'] = $_POST['cb2_post_class'];
	$pref['cb2_mute_class'] = $_POST['cb2_mute_class'];

	if (isset($_POST['cb2_enable_muting'])) {
		$pref['cb2_enable_muting'] = 1;
	}else{
		$pref['cb2_enable_muting'] = 0;
	}

	if (isset($_POST['cb2_enable_deletes'])) {
		$pref['cb2_enable_deletes'] = 1;
	}else{
		$pref['cb2_enable_deletes'] = 0;
	}

	if (isset($_POST['cb2_whitespace'])) {
		$pref['cb2_whitespace'] = 	1;
	}else{
		$pref['cb2_whitespace'] = 	0;
	}

	if (isset($_POST['cb2_multipost'])) {
		$pref['cb2_multipost'] = 	1;
	}else{
		$pref['cb2_multipost'] = 	0;
	}

	if (isset($_POST['cb2_allow_dups'])) {
		$pref['cb2_allow_dups'] = 	1;
	}else{
		$pref['cb2_allow_dups'] = 	0;
	}

	$pref['cb2_dup_timer'] = (ctype_digit($_POST['cb2_dup_timer']) ? $_POST['cb2_dup_timer'] : 360);

	if (isset($_POST['cb2_sound_activate'])) {
		$pref['cb2_sound_activate'] = 1;
	}else{
		$pref['cb2_sound_activate'] = 0;
	}

	$pref['cb2_sound_volume'] = (ctype_digit($_POST['cb2_sound_volume']) ? $_POST['cb2_sound_volume'] : 50);
	$pref['cb2_sound_source'] = ($_POST['cb2_sound_source'] ? $_POST['cb2_sound_source'] : e_PLUGIN_ABS."chatbox2/sound/newpost_sound.wav");

	if (isset($_POST['cb2_show_bullet'])) {
		$pref['cb2_show_bullet'] = 	1;
	}else{
		$pref['cb2_show_bullet'] = 	0;
	}

	if (isset($_POST['cb2_emote'])) {
		$pref['cb2_emote'] = 	1;
	}else{
		$pref['cb2_emote'] = 	0;
	}

	if (isset($_POST['cb2_user_font_color_activate'])) {
		$pref['cb2_user_font_color_activate'] = 1;
	}else{
		$pref['cb2_user_font_color_activate'] =	0;
	}

//	if (isset($_POST['class_color_enable'])) {
//		$pref['class_color_enable'] = 1;
//	}else{
//		$pref['class_color_enable'] = 0;
//	}

	save_prefs();
	$e107cache->clear("nq_chatbox");
	$message = CB2LAN_1;
}

if (isset($_POST['prune'])) {
	$chatbox2_prune = $_POST['chatbox2_prune'];
	$prunetime = time() - $chatbox2_prune;

	$sql->db_Delete("chatbox2", "cb2_datestamp < '$prunetime' ");
	$e107cache->clear("nq_chatbox");
	$message = CB2LAN_28;
}

if (isset($_POST['recalculate'])) {
	$sql->db_Update("user", "user_chats = 0");
	$qry = "SELECT u.user_id AS uid, count(c.cb2_nick) AS count FROM #chatbox2 AS c
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(c.cb2_nick,'.',1) = u.user_id
		WHERE u.user_id > 0
		GROUP BY uid";

		if ($sql -> gen($qry)) {
			$ret = array();
			while($row = $sql -> fetch())
			{
				$list[$row['uid']] = $row['count'];
			}
		}

		foreach($list as $uid => $cnt)
		{
			$sql->db_Update("user", "user_chats = '{$cnt}' WHERE user_id = '{$uid}'");
		}
	$message = CB2LAN_33;
}

if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

if(!isset($pref['cb2_mod_class']))
{
	$pref['cb2_mod_class'] = e_UC_ADMIN;
}

$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cbform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_32."
		</td>
		<td class='forumheader3' style='width:60%'>
		".r_userclass("cb2_mod_class", $pref['cb2_mod_class'], 'off', "admin, classes")."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL60."
		</td>
		<td class='forumheader3' style='width:60%'>
		".r_userclass("cb2_view_class", $pref['cb2_view_class'], 'off', 'nobody,public,member,admin,classes')."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL61."
		</td>
		<td class='forumheader3' style='width:60%'>
		".r_userclass("cb2_post_class", $pref['cb2_post_class'], 'off', 'nobody,public,member,admin,classes')."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL63."
		</td>
		<td class='forumheader3' style='width:60%'>
		".r_userclass("cb2_mute_class", $pref['cb2_mute_class'], 'off', 'nobody,public,member,classes')."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL76."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_enable_muting'] == 1 ? "<input type='checkbox' name='cb2_enable_muting' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_enable_muting' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL75."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_enable_deletes'] == 1 ? "<input type='checkbox' name='cb2_enable_deletes' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_enable_deletes' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL44."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_whitespace'] == 1 ? "<input type='checkbox' name='cb2_whitespace' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_whitespace' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL41."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_multipost'] == 1 ? "<input type='checkbox' name='cb2_multipost' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_multipost' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL42."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_allow_dups'] == 1 ? "<input type='checkbox' name='cb2_allow_dups' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_allow_dups' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL50."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cb2_dup_timer' size='10' value='".$pref['cb2_dup_timer']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL51."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL80."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_sound_activate'] == 1 ? "<input type='checkbox' name='cb2_sound_activate' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_sound_activate' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL90."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cb2_sound_volume' size='10' value='".$pref['cb2_sound_volume']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL91."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL82."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cb2_sound_source' size='50' value='".$pref['cb2_sound_source']."' maxlength='150' />
		</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>
		".CB2LAN_VL2."
	</td>
	<td class='forumheader3' style='width:60%'>
		".($pref['cb2_show_bullet'] == 1 ? "<input type='checkbox' name='cb2_show_bullet' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_show_bullet' value='0' />")."<br />
	</td>
	</tr>
";

	if($pref['smiley_activate'])
	{
		$text .= "<tr><td class='forumheader3' style='width:40%'>".CB2LAN_31." </td>
			<td class='forumheader3' style='width:60%'>". ($pref['cb2_emote'] == 1 ? "<input type='checkbox' name='cb2_emote' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_emote' value='0' />")."
			</td>
			</tr>
		";
	}

	$text .= "
		<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL31."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_user_font_color_activate'] == 1 ? "<input type='checkbox' name='cb2_user_font_color_activate' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_user_font_color_activate' value='0' />")."
		</td>
		</tr>
	";

//		<tr>
//		<td class='forumheader3' style='width:40%'>
//			".CB2LAN_VL35."
//		</td>
//		<td class='forumheader3' style='width:60%'>
//			".($pref['class_color_enable'] == 1 ? "<input type='checkbox' name='class_color_enable' value='1' checked='checked' />" : "<input type='checkbox' name='class_color_enable' value='0' />")."
//		</td>
//		</tr>



	$text .= "<tr>
		<td class='forumheader3' style='width:40%'>".CB2LAN_21." <div class='smalltext'>".CB2LAN_22."</div></td>
		<td class='forumheader3' style='width:60%'>
		".CB2LAN_23." <select name='chatbox2_prune' class='tbox'>
		<option></option>
		<option value='86400'>".CB2LAN_24."</option>
		<option value='604800'>".CB2LAN_25."</option>
		<option value='2592000'>".CB2LAN_26."</option>
		<option value='1'>".CB2LAN_27."</option>
		</select>
		<input class='button' type='submit' name='prune' value='".CB2LAN_21."' />
		</td>
		</tr>
	";


	$text .= "<tr>
		<td class='forumheader3' style='width:40%'>".CB2LAN_34."</td>
		<td class='forumheader3' style='width:60%'>
		<input class='button' type='submit' name='recalculate' value='".CB2LAN_35."' />
		</td>
		</tr>
	";

	$text .= "<tr>
		<td  class='forumheader' colspan='3' style='text-align:center'>
		<input class='button' type='submit' name='updatesettings' value='".CB2LAN_19."' />
		</td>
		</tr>
		</table>
		</form>
		</div>
	";

$ns->tablerender(CB2LAN_VLB1, $text);


$ns->tablerender(CB2_LAN_HELP_TITLE, CB2_LAN_HELP_ADMIN_GEN);

require_once(e_ADMIN."footer.php");
?>