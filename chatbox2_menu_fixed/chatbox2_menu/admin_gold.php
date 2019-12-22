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

$pageid = "cb2_gold";

if (file_exists(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php")) {
	include_once(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php");
} else {
	include_once(e_PLUGIN."chatbox2_menu/languages/English/English_config.php");
}

require_once(e_ADMIN."auth.php");
//require_once(e_HANDLER."userclass_class.php");

if (isset($_POST['updatesettings'])) {

	if (isset($_POST['cb2_gold_enable'])) {
		$pref['cb2_gold_enable'] = 1;
	}else{
		$pref['cb2_gold_enable'] = 0;
	}

	$pref['cb2_gold_name_height'] = (ctype_digit($_POST['cb2_gold_name_height']) ? $_POST['cb2_gold_name_height'] : 10);


	save_prefs();
	$message = CB2LAN_1;
}

if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cbform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_GLD1."
		</td>
		<td class='forumheader3' style='width:60%'>
			".($pref['cb2_gold_enable'] == 1 ? "<input type='checkbox' name='cb2_gold_enable' value='1' checked='checked' />" : "<input type='checkbox' name='cb2_gold_enable' value='0' />")."<br />
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:40%'>
			".CB2LAN_GLD2."
		</td>
		<td class='forumheader3' style='width:60%'>
			<input class='tbox' type='text' name='cb2_gold_name_height' size='5' value='".$pref['cb2_gold_name_height']."' maxlength='2' />
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
		<td  class='forumheader' colspan='3' style='text-align:center'>
		<input class='button' type='submit' name='updatesettings' value='".CB2LAN_19."' />
		</td>
		</tr>
		</table>
		</form>
		</div>
	";

$ns->tablerender(CB2LAN_GLD_B1, $text);


$ns->tablerender(CB2_LAN_HELP_TITLE, CB2_LAN_HELP_ADMIN_GLD);

require_once(e_ADMIN."footer.php");
?>