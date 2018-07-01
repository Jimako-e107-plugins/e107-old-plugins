<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if(!getperms("4")){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN."auth.php");

@include_once(e_PLUGIN."messenger_status_menu/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."messenger_status_menu/languages/English.php");

function messenger_status_UpdateParm($parmname){
	global $pref;
	$pref[$parmname]=$_POST[$parmname];
}

if(IsSet($_POST['update_menu'])){
	$aj = new textparse;
	messenger_status_UpdateParm("messenger_status_server");
	messenger_status_UpdateParm("messenger_status_yahoo");
	messenger_status_UpdateParm("messenger_status_msn");
	messenger_status_UpdateParm("messenger_status_icq");
	messenger_status_UpdateParm("messenger_status_aim");
	messenger_status_UpdateParm("messenger_status_skype");
	messenger_status_UpdateParm("messenger_status_jabber");
	messenger_status_UpdateParm("messenger_status_caption");

	save_prefs();


	while(list($key, $value) = each($_POST)){
		if($value != "Update Menu Settings"){
			$menu_pref[$key] = str_replace("<br />", "", $aj -> formtpa($value, "admin"));
		}
	}

	$tmp = addslashes(serialize($menu_pref));
	$sql -> db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
	$ns -> tablerender("", "<div style='text-align:center'><b>".MSTAT_1."</b></div>");
}


$messenger_status_server = $pref['messenger_status_server'];
$messenger_status_yahoo = $pref['messenger_status_yahoo'];
$messenger_status_msn = $pref['messenger_status_msn'];
$messenger_status_icq = $pref['messenger_status_icq'];
$messenger_status_aim = $pref['messenger_status_aim'];
$messenger_status_skype = $pref['messenger_status_skype'];
$messenger_status_jabba = $pref['messenger_status_jabber'];
$messenger_status_caption = $pref['messenger_status_caption'];

$text = "<div style='text-align:center'>

<form method='post' action='".e_SELF."?".e_QUERY."' name='menu_conf_form'>
<table style='width:85%' class='fborder' >

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_2.": <br /><span class='smalltext'>".MSTAT_3."</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_caption' size='50' value='".$menu_pref['messenger_status_caption']."' maxlength='51' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_4." <br /><span class='smalltext'>".MSTAT_5."</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_server' size='50' value='".$menu_pref['messenger_status_server']."' maxlength='51' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_6.":</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_yahoo' size='30' value='".$menu_pref['messenger_status_yahoo']."' maxlength='51' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_7.":</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_msn' size='30' value='".$menu_pref['messenger_status_msn']."' maxlength='51' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_8.":</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_icq' size='30' value='".$menu_pref['messenger_status_icq']."' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_9.":</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_aim' size='30' value='".$menu_pref['messenger_status_aim']."' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_16.":</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_skype' size='30' value='".$menu_pref['messenger_status_skype']."' />
</td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'>".MSTAT_10.":</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='text' name='messenger_status_jabber' size='30' value='".$menu_pref['messenger_status_jabber']."' />
</td>
</tr>

<tr>
<td colspan='2' class='forumheader' style='text-align:center'><input class='button' type='submit' name='update_menu' value='".MSTAT_11."' /></td>
</tr>
</table>
</form>
</div>";
$ns -> tablerender("".MSTAT_12."", $text);

require_once(e_ADMIN."footer.php");

?>
