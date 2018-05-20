<?php

require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");

$e_gold[] = array("plug_name" => EB_L1, "plug_folder" => "ebattles", "add" => true, "deduct" => true);


if (!function_exists('ebattles_configure_edit')) {

	function ebattles_configure_edit() {
	global $gold_obj, $pref;
        $retval = "
	<form method='POST' action='".e_SELF."' id='ebattles' >
	<div><input type='hidden' name='gold_plugin' value='ebattles' /></div>
	<table class='fborder' style='".ADMIN_WIDTH."'>
	<tr>
	<td class='fcaption' colspan='2'  style='text-align:center; font-size:12pt'><b>".EB_GOLD_L1."</b></td>
	</tr>
	<tr>
	<td class='forumheader3' style='width:386'>".EB_GOLD_L4." <div class='smalltext'>".EB_GOLD_L5."</div></td>
	<td class='forumheader3' style='width:451'>
        ". r_userclass("eb_gold_userclass", $pref['eb_gold_userclass'], 'off', "public, member, admin, classes, nobody")."</td>
	</tr>
	<tr>
	<td class='forumheader3' style='width:386'>".EB_GOLD_L6."</td>
	<td class='forumheader3' style='width:451'>
        <input type='textbox' class='tbox' name='eb_gold_playmatch' value='".$pref['eb_gold_playmatch']."'></td>
	</tr>
	<tr>
	<td class='forumheader2' colspan='2' style='text-align:center'><input type='submit' class='button' name='gold_save' value='" . EB_GOLD_L2 . "'</td>
	</tr>			
	</table>
	</form>";
			
        return $retval;
    }
}

if (!function_exists("ebattles_configure_save")) {

    function ebattles_configure_save() {

		global $gold_obj, $pref, $arcade_obj;
		$pref['eb_gold_userclass'] = $_POST['eb_gold_userclass'];
		$pref['eb_gold_playmatch'] = $_POST['eb_gold_playmatch'];
		save_prefs();
		return EB_GOLD_L3;
    }

} else {

return "Error";

}

?>