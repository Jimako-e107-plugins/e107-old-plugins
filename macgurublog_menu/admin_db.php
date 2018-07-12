<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
require_once(e_PLUGIN."macgurublog_menu/macgurublog_dt.php");
$pageid = "db";
// ------------------------------
$prefcapt[] = MACGURUBLOG_MENU_63;
$prefname[] = "macgurublog_dbdrop";
$preftype[] = "checkbox";
$prefvalu[] = 'true';
$predvalu[] = 'true';

$prefcapt[] = MACGURUBLOG_MENU_64;
$prefname[] = "macgurublog_dbpass";
$preftype[] = "checkbox";
$prefvalu[] = 'true';
$predvalu[] = 'false';


require_once("form_handler.php");
$rs = new form_mgb;
$text = "<div style='text-align:center'>
<form method='post' action='".e_PLUGIN."macgurublog_menu/admin_dump.php'>
<table style='width:94%' class='fborder'>";

for ($i=0; $i<count($prefcapt); $i++) {
	$form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
	$text .="
	<tr>
	<td style=\"width:70%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i].":</td>
	<td style=\"width:30%\" class=\"forumheader3\">";
	$name = $prefname[$i];
	$text .= $rs->  user_extended_element_edit($form_send,$predvalu[$i],$name);
	$text .="</td></tr>";
};

$text .="<tr style='vertical-align:top'>
<td colspan='2'  style='text-align:center' class='forumheader'>
<input class='button' type='submit' name='mgbupdatesettings' value='".MACGURUBLOG_MENU_65."' />
</td>
</tr>
</table>
</form>
</div>";
$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_66.'</div>');
$ns -> tablerender(MACGURUBLOG_MENU_62, $text);
// ------------------------------
require_once(e_ADMIN."footer.php");

?>