<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

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
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
e107_require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");

if (!is_object($reviewer_obj))
{
    $reviewer_obj = new reviewer;
}

if (intval($_POST['reviewer_recalc']) == 1)
{
    // Do recalc
    $reviewer_msgtext .= REVIEWER_A042 ;
    $reviewer_obj->recalc_all();
    $reviewer_obj->clear_cache();
}
if ($_POST['recalc'] && intval($_POST['reviewer_recalc']) != 1)
{
    $reviewer_msgtext .= REVIEWER_A043 ;
}
$reviewer_text .= "
<form method='post' action='" . e_SELF . "' id='confrecipe'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . REVIEWER_A041 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' ><strong>{$reviewer_msgtext}</strong>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2' >" . REVIEWER_A038 . " <input type='checkbox' class='tbox' name='reviewer_recalc' value='1' /></td>
		</tr>
";
// Submit button
$reviewer_text .= "
		<tr>
			<td colspan='2' class='forumheader2' style='text-align: left;'><input type='submit' name='recalc' value='" . REVIEWER_A039 . "' class='button' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender(REVIEWER_A001, $reviewer_text);
require_once(e_ADMIN . "footer.php");

?>