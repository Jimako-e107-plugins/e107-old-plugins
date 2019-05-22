<?php
// ***************************************************************
// *
// *		Title		:	Corporate Phone Directory
// *
// *		Author		:	Barry Keal
// *
// ***************************************************************
if (!defined('e107_INIT'))
{
    exit;
}
if (!check_class($pref['phonedir_userclass']))
{
    print LAN_phonedir_82;
    require_once(FOOTERF);
    exit();
}

if ($pd_action == "sendnotify")
{
    $edata_sn = array("pdirchange" => $_REQUEST['pdchanges'], "user" => USERNAME);
    $e_event->trigger("phonedir", $edata_sn);
    $pd_text .= "<form action='" . e_SELF . "' method='post' id='pdnform' >
	<table class='fborder' width='97%'>
	<tr><td class='fcaption'>" . LAN_phonedir_16 . "
	<input type='hidden' name='pd_action' value='list' />
	<input type='hidden' name='pd_from' value='$pd_from' />
	<input type='hidden' name='pdcat_id' value='$pdcat_id' />
	<input type='hidden' name='pd_optioncat' value='$pd_optioncat' />
	<input type='hidden' name='pd_optionsite' value='$pd_optionsite' />
	<input type='hidden' name='pd_project' value='$pd_project' />
	<input type='hidden' name='pd_job' value='$pd_job' />
	<input type='hidden' name='pd_office' value='$pd_office' />
	<input type='hidden' name='pd_name' value='$pd_name' />
	<input type='hidden' name='pd_id' value='$pd_id' />
	<input type='hidden' name='pd_site' value='$pd_site' />
	<input type='hidden' name='pd_dept' value='$pd_dept' /></td></tr>
	<tr><td class='forumheader3'>" . LAN_phonedir_96 . "</td></tr>
<tr><td class='fcaption' ><input type='submit' class='tbox' name='donotifyok' value='" . LAN_phonedir_97 . "' /></td></tr>
	</table></form>";
}
else
{
    $pd_text .= "<form action='" . e_SELF . "' method='post' id='pdnnform' >
	<table class='fborder' width='97%'>
<tr><td colspan='2' class='fcaption'>" . LAN_phonedir_16 . "
	<input type='hidden' name='pd_action' value='sendnotify' />
	<input type='hidden' name='pd_from' value='$pd_from' />
	<input type='hidden' name='pdcat_id' value='$pdcat_id' />
	<input type='hidden' name='pd_optioncat' value='$pd_optioncat' />
	<input type='hidden' name='pd_optionsite' value='$pd_optionsite' />
	<input type='hidden' name='pd_project' value='$pd_project' />
	<input type='hidden' name='pd_job' value='$pd_job' />
	<input type='hidden' name='pd_office' value='$pd_office' />
	<input type='hidden' name='pd_name' value='$pd_name' />
	<input type='hidden' name='pd_id' value='$pd_id' />
	<input type='hidden' name='pd_site' value='$pd_site' />
	<input type='hidden' name='pd_dept' value='$pd_dept' /></td></tr>
	<tr>
	<td colspan = '2' class = 'fcaption'><a href='?$pd_from.list.$pd_params'><img src='./images/back.png' style='border:0;' title='" . LAN_phonedir_22 . "' alt='" . LAN_phonedir_22 . "' /></a></td>
	</tr>
<tr><td class='forumheader3' style='vertical-align:top;width:25%'>" . LAN_phonedir_94 . "<br /><br /><i>" . LAN_phonedir_102 . "</i></td><td class='forumheader3'><textarea class='tbox' style='width:90%' rows='8' name='pdchanges'></textarea></td></tr>
<tr><td class='fcaption' colspan='2' style='vertical-align:top;' ><input type='submit' class='tbox' name='donotifyok' value='" . LAN_phonedir_95 . "' /></td></tr>
</table></form>";
}
define("e_PAGETITLE", LAN_phonedir_1 . " " . LAN_phonedir_104 . " " . $tp->toFORM($pd_dept_name));
require_once(HEADERF);
$ns->tablerender(LAN_phonedir_1, $pd_text);
require_once(FOOTERF);

?>