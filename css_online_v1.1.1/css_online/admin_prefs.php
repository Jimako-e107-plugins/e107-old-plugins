<?php
require_once("../../class2.php");
if(!getperms("P")) { echo "You do not have permission"; exit; }
require_once(e_ADMIN."auth.php");

if (isset($_POST['update_css'])) {
	/* check if css_online/css dir is writable ... */
	if(!is_writable(e_PLUGIN."css_online/css/")) {
		/* still not writable - spawn error message */
		$ns->tablerender('Erreur', 'The folder '.e_PLUGIN.'css_online/css/ is not writable, please CHMOD it to 777');
	} else {
		/* css_online/css is writable - continue */
		$oldfile = $pref['css_online_file'];
		$newfile = $pref['css_online_file']+1;
		
		fopen(e_PLUGIN."css_online/css/online".$newfile.".css", 'w');
		file_put_contents(e_PLUGIN."css_online/css/online".$newfile.".css", $_POST['css_data']);
		
		unlink(e_PLUGIN."css_online/css/online".$oldfile.".css");
		
		$pref['css_online_file']++;
		save_prefs();
		
		$ns -> tablerender('Update', 'Changes have been added');

	}
}

$content = file_get_contents(e_PLUGIN."css_online/css/online".$pref['css_online_file'].".css");
$original = file_get_contents(e_THEME.$pref['sitetheme']."/".$pref['themecss']);

$text .= "<div style='text-align:center'>
<form enctype='multipart/form-data' method='post' action='".e_SELF."'>
<table style='".ADMIN_WIDTH."' class='fborder'>
	<tr>
	<td class='forumheader3' style='width: 20%;'>Write your CSS content here :</td>
	<td class='forumheader3' style='width: 80%;'>
		<textarea class='tbox' id='css_data' name='css_data' cols='70' rows='15' style='width:95%' >".$tp->toForm($content)."</textarea>

	</td>
	</tr>
	<tr>
	<td colspan='2' style='text-align:center' class='forumheader'>
		<input class='button' type='submit' name='update_css' value='submit button' />
	</td>
	</tr>
	<tr>
	<td colspan='2'><br />
	Note that the style written in here will only affect the user side view. You won't see the changes in the admin panel.<br />
	<td>
	</tr>
</table>
</form></div>
<br /><table style='".ADMIN_WIDTH."' class='fborder'>
	<tr>
	<td class='forumheader3' style='width: 20%;vertical-align:top'>
	This is your original style sheet currently used :
	</td>
	<td class='forumheader3' style='width: 80%;vertical-align:top'>
		<textarea class='tbox' id='original_css_data' name='original_css_data' cols='70' rows='15' readonly='readonly' style='width:95%' >".$tp->toForm($original)."</textarea>
	</td>
	</tr>
</table>
\n";

$ns -> tablerender('CSS online takeover', $text);

require_once(e_ADMIN."footer.php");
?>