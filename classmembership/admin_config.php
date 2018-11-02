<?php
// ***************************************************************
// *
// *		Plugin		:	Class Membership (e107 v7)
// *
// ***************************************************************
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}

require_once(e_HANDLER . "userclass_class.php");
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "classmembership/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "classmembership/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "classmembership/languages/admin/English.php");
}

require_once(e_ADMIN . "auth.php");

$caption = CLASSY_A1;
if (e_QUERY == "update")
{
    $pref['classy_userclass'] = $_POST['classy_userclass'];
save_prefs();
    $classy_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . CLASSY_A9 . "</strong></td></tr>";

}

$classy_text .= "<form method='post' action='" . e_SELF . "?update' id='confclassy'>
	<table style='width: 97%;' class='fborder' >";

$classy_text .= "<tr><td class='fcaption' colspan='2'>" . CLASSY_A1 . "</td></tr>$classy_msg
	<tr>
	<td style='width:30%' class='forumheader3'>" . CLASSY_A2 . "</td>
	<td style='width:70%' class='forumheader3'>" . r_userclass("classy_userclass", $pref['classy_userclass']) . "
	</td></tr>";
// Submit button
$classy_text .= "
	<tr>
	<td class='fcaption' colspan='2' style='text-align:left;'><input type='submit' name='update' value='" . CLASSY_A3 . "' class='button' />
	</td>
	</tr>";

$classy_text .= "</table></form>";

$ns->tablerender($caption, $classy_text);
require_once(e_ADMIN . "footer.php");

?>