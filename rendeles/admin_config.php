<?php

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN . "rendeles/languages/" . e_LANGUAGE . ".php");
$rendeles_msg = "";
if (e_QUERY == "update")
{
    // Update rest
    $pref['rendeles_perpage'] = intval($_POST['rendeles_perpage']);
    $pref['rendeles_currency'] = $tp->toDB($_POST['rendeles_currency']);
    save_prefs();
    $rendeles_msg .= RENDELES_ADLAN_33 ;
}

$rendeles_text .= "
<form method='post' action='" . e_SELF . "?update' id = 'rendeles'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >
		<tr>
			<td class='fcaption' colspan='2' >" . RENDELES_ADLAN_2 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' ><strong>" . $rendeles_msg . "</strong>&nbsp;</td>
		</tr>";
$rendeles_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . RENDELES_ADLAN_31 . " :</td>
			<td class='forumheader3'>
				<input type='text' name='rendeles_perpage' class='tbox' style='width:200px' value='".$pref['rendeles_perpage']."' />
			</td>
		</tr>";
$rendeles_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . RENDELES_ADLAN_32 . " :</td>
			<td class='forumheader3'>
			  <input type='text' name='rendeles_currency' class='tbox' style='width:200px' value='".$tp->toFORM($pref['rendeles_currency'])."' />
			</td>
		</tr>";
$rendeles_text .= "
		<tr>
			<td colspan='2' style='text - align: left;' class = 'fcaption'><input type='submit' name='update' value='" . RENDELES_ADLAN_23 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";

$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_1."</div>", $rendeles_text);

require_once(e_ADMIN . "footer.php");

?>