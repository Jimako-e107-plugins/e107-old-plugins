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

$pageid = "cp2_chatpage";

require_once("../../class2.php");

if(!getperms("P")) { header("location:".e_BASE."index.php"); exit; }

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English_config.php");
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");

$footer_js[] = e_PLUGIN."chatbox2/jscolor/jscolor.js";

if (isset($_POST['updatesettings'])) {

	$pref['cp2_initial_posts'] = (ctype_digit($_POST['cp2_initial_posts']) ? $_POST['cp2_initial_posts'] : 50);

	$pref['cp2_layer'] = $_POST['cp2_layer'];
	$pref['cp2_layer_height'] = (ctype_digit($_POST['cp2_layer_height']) ? $_POST['cp2_layer_height'] : 500);

	if($pref['antiflood1'] == 1){
		if($_POST['cp2_refresh'] >= $pref['antiflood_timeout']){
			// SET TO REFRESH IF HIGHER THAN FLOOD TIMEOUT
			$pref['cp2_refresh'] = (ctype_digit($_POST['cp2_refresh']) ? $_POST['cp2_refresh'] : 8);
		}else{
			// SET TO FLOOD TIMEOUT + 1 IF HIGHER THAN REFRESH
			$pref['cp2_refresh'] = $pref['antiflood_timeout'];
			$message = CB2LAN_VLB5."<br />";
		}
	}else{
		$pref['cp2_refresh'] = (ctype_digit($_POST['cp2_refresh']) ? $_POST['cp2_refresh'] : 8);
	}

	$pref['cp2_refresh_submit'] = (ctype_digit($_POST['cp2_refresh_submit']) ? $_POST['cp2_refresh_submit'] : 8);

	$pref['cp2_header'] = $_POST['cp2_header'];


	if (isset($_POST['cp2_ul_top'])) {
		$pref['cp2_ul_top'] = 1;
	}else{
		$pref['cp2_ul_top'] = 0;
	}

	if (isset($_POST['cp2_show_date'])) {
		$pref['cp2_show_date'] = 1;
	}else{
		$pref['cp2_show_date'] = 0;
	}

	if (isset($_POST['cp2_custom_look'])) {
		$pref['cp2_custom_look'] = 	1;
	}else{
		$pref['cp2_custom_look'] = 	0;
	}

	if (isset($_POST['cp2_match_chatbox2_look'])) {

		$pref['cp2_border_size'] = $pref['cb2_border_size'];
		$pref['cp2_border_color'] = $pref['cb2_border_color'];

		$pref['cp2_bg_color'] = $pref['cb2_bg_color'];

		$pref['cp2_name_font_color'] = $pref['cb2_name_font_color'];
		$pref['cp2_date_font_color'] = $pref['cb2_date_font_color'];
		$pref['cp2_msg_font_color'] = $pref['cb2_msg_font_color'];


	}else{

		$pref['cp2_border_size'] = (ctype_digit($_POST['cp2_border_size']) ? $_POST['cp2_border_size'] : 0);
		$pref['cp2_border_color'] = ($_POST['cp2_border_color'] ? $_POST['cp2_border_color'] : "999999");

		$pref['cp2_bg_color'] = $_POST['cp2_bg_color'];

		$pref['cp2_name_font_color'] = $_POST['cp2_name_font_color'];
		$pref['cp2_date_font_color'] = $_POST['cp2_date_font_color'];
		$pref['cp2_msg_font_color'] = $_POST['cp2_msg_font_color'];

	}
	save_prefs();

	$e107cache->clear("nq_chatbox");
	$message .= CB2LAN_1;
}

if (isset($message)) {
	$ns->tablerender("", "
		<div style='text-align:center'>
			<b>".$message."</b>
		</div>
	");
}

$cp2_initial_posts = $pref['cp2_initial_posts'];

$text = "
	<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cpform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
		<td class='forumheader3' style='width:40%'>".CB2LAN_11."
			<div class='smalltext'>".CB2LAN_12."</div>
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cp2_initial_posts' size='8' value='".$pref['cp2_initial_posts']."' maxlength='3' />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_36."
		</td>
		<td class='forumheader3' style='width:60%'>".
			($pref['cp2_layer'] == 0 ? "<input type='radio' name='cp2_layer' value='0' checked='checked' />" : "<input type='radio' name='cp2_layer' value='0' />")."&nbsp;&nbsp;". CB2LAN_37."<br />".
			($pref['cp2_layer'] == 1 ? "<input type='radio' name='cp2_layer' value='1' checked='checked' />" : "<input type='radio' name='cp2_layer' value='1' />")."&nbsp;&nbsp;". CB2LAN_29."<br />".
			($pref['cp2_layer'] == 2 ? "<input type='radio' name='cp2_layer' value='2' checked='checked' />" : "<input type='radio' name='cp2_layer' value='2' />")."&nbsp;&nbsp;". CB2LAN_38."<br />".
			($pref['cp2_layer'] == 3 ? "<input type='radio' name='cp2_layer' value='3' checked='checked' />" : "<input type='radio' name='cp2_layer' value='3' />")."&nbsp;&nbsp;". CB2LAN_VL1."<br />
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_30."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cp2_layer_height' size='8' value='".$pref['cp2_layer_height']."' maxlength='3' />
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL4."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cp2_refresh' size='5' value='".$pref['cp2_refresh']."' maxlength='3' />&nbsp;--&nbsp;". CB2LAN_VL5."<br />
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL70."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cp2_refresh_submit' size='5' value='".$pref['cp2_refresh_submit']."' maxlength='3' />&nbsp;--&nbsp;". CB2LAN_VL71."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL65."
		</td>
		<td class='forumheader3' style='width:60%'>
			<textarea id='cp2_header' name='cp2_header' wrap='hard' class='tbox chatbox' cols='15' rows='5' style='overflow: auto' onselect='storeCaret(this);' onclick='storeCaret(this);' onfocus='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['cp2_header']."</textarea>
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL43."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cp2_ul_top'] == 1 ? "<input type='checkbox' name='cp2_ul_top' value='1' checked='checked' />" : "<input type='checkbox' name='cp2_ul_top' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL3."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cp2_show_date'] == 1 ? "<input type='checkbox' name='cp2_show_date' value='1' checked='checked' />" : "<input type='checkbox' name='cp2_show_date' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL30."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cp2_custom_look'] == 1 ? "<input type='checkbox' name='cp2_custom_look' value='1' checked='checked' />" : "<input type='checkbox' name='cp2_custom_look' value='0' />")."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL32."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cp2_match_chatbox2_look'] == 1 ? "<input type='checkbox' name='cp2_match_chatbox2_look' value='1' checked='checked' />" : "<input type='checkbox' name='cp2_match_chatbox2_look' value='0' />")."
			&nbsp;--&nbsp;". CB2LAN_VL33."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL20."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cp2_border_size' size='4' value='".$pref['cp2_border_size']."' maxlength='1' />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_VL6."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='color' type='text' name='cp2_border_color' size='8' value='".$pref['cp2_border_color']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL21."<br />
			<input class='color' type='text' name='cp2_bg_color' size='8' value='".$pref['cp2_bg_color']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL22."<br />
			<input class='color' type='text' name='cp2_name_font_color' size='8' value='".$pref['cp2_name_font_color']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL8."<br />
			<input class='color' type='text' name='cp2_date_font_color' size='8' value='".$pref['cp2_date_font_color']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL9."<br />
			<input class='color' type='text' name='cp2_msg_font_color' size='8' value='".$pref['cp2_msg_font_color']."' maxlength='6' />&nbsp;--&nbsp;". CB2LAN_VL10."<br />
		</td>
	</tr>

	<tr>
		<td  class='forumheader' colspan='3' style='text-align:center'>
			<input class='button' type='submit' name='updatesettings' value='".CB2LAN_19."' />
		</td>
	</tr>

	</table>
	</form>
	</div>
";

$ns->tablerender(CB2LAN_VLB3, $text);
$ns->tablerender(CB2_LAN_HELP_TITLE, CB2_LAN_HELP_ADMIN_CHATPAGE);

require_once(e_ADMIN."footer.php");
?>