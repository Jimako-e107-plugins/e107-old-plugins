<?php
/*
+---------------------------------------------------------------+
|       Delete Me for e107 v7xx - by Father Barry
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
#require_once(e_HANDLER . "np_class.php");
$gen = new convert;
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
include_lan(e_PLUGIN . "deleteme/languages/admin/" . e_LANGUAGE . ".php");
$deleteme_from = 0;
// Get the starting record if passed by a get or <a>
if (e_QUERY)
{
    $tmp = explode(".", e_QUERY);
    $deleteme_from = $tmp[0];
}
// Get the starting record if it is passed from the form
if (isset($_REQUEST['deleteme_from']))
{
    $deleteme_from = $_REQUEST['deleteme_from'];
}
// If any records marked for deletion then delete them
foreach($_REQUEST['deleteme_dodel'] as $row)
{
    $sql->db_Delete("deleteme_why", "deleteme_id='$row'");
}
// Display the records
$deleteme_text = "
<form id='deletemehist' action='" . e_SELF . "' method='post'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
		<tr>
			<td class='fcaption' colspan = '7'><strong>" . DELETEME_A15 . "</strong></td>
		</tr>
		<tr>
			<td class='forumheader' style='width:5%;'>" . DELETEME_A18 . "</td>
			<td class='forumheader' style='width:15%;'>" . DELETEME_A19 . "</td>
			<td class='forumheader' style='width:25%;'>" . DELETEME_A20 . "</td>
			<td class='forumheader' style='width:15%;'>" . DELETEME_A21 . "</td>
			<td class='forumheader' style='width:10%;'>" . DELETEME_A30 . "</td>
			<td class='forumheader' style='width:20%;'>" . DELETEME_A29 . "</td>
			<td class='forumheader' style='width:10%;text-align:center;'>" . DELETEME_A22 . "</td>
		</tr>";

if ($sql->db_Select("deleteme_why", "*", "order by deleteme_dateleft desc limit " . $deleteme_from . "," . $pref['deleteme_perpage'] . "", "nowhere"))
{
    // If there are records to display
    while ($deleteme_row = $sql->db_Fetch())
    {
        // Display each line
        extract($deleteme_row);
        $deleteme_text .= "
		<tr>
			<td class='forumheader3' >$deleteme_user_id</td>
			<td class='forumheader3' >" . $tp->toHTML($deleteme_user_name) . "</td>
			<td class='forumheader3' >" . $tp->toHTML($deleteme_reason_left) . "</td>
			<td class='forumheader3' >" . $gen->convert_date($deleteme_dateleft, "short") . "</td>
			<td class='forumheader3' >" . $tp->toHTML($deleteme_ipaddress,false,"no_make_clickable no_replace") . "</td>
			<td class='forumheader3' >" . $tp->toHTML($deleteme_email,false,"no_make_clickable no_replace") . "</td>
			<td class='forumheader3' style='text-align:center;'>
				<input type = 'checkbox' name='deleteme_dodel[]' value = '$deleteme_id' class='tbox' />
			</td>
		</tr>";
    }
    $deleteme_text .= "
		<tr>
			<td class='forumheader' colspan='6'>
				<input type = 'submit' name = 'deleteme_del' value ='" . DELETEME_A23 . "' class='button' />
			</td>
			<td class='forumheader' style='text-align:center;'>
				<input class='button' type='button' name='CheckAlls' value='" . DELETEME_A25 . "'
onclick=\"setCheckboxes('deletemehist', true, 'deleteme_dodel[]'); return false;\"  />&nbsp;
				<input class='button' type='button' name='CheckAlls' value='" . DELETEME_A26 . "'
onclick=\"setCheckboxes('deletemehist', false, 'deleteme_dodel[]'); return false;\"  />
			</td>
		</tr>";
}
else
{
    // Otherwise tell user that there are no records
    $deleteme_text .= "
		<tr>
			<td class='forumheader3' colspan = '7'>" . DELETEME_A17 . "</td>
		</tr>";
}
// Get the total number of records
#$deleteme_totalrecs = $sql->db_Count("deleteme_why", "(*)");

$deleteme_count = $sql->db_Count("deleteme_why", "(*)");

$action = "";
$parms = $deleteme_count . "," . $pref['deleteme_perpage'] . "," . $deleteme_from . "," . e_SELF . '?' . "[FROM]." . $action;
$deleteme_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
if (!empty($deleteme_nextprev))
{
    $deleteme_text .= "
		<tr>
			<td class='forumheader3' colspan = '6'>" . $deleteme_nextprev . "</td>
		</tr>";
}

$deleteme_text .= "
	</table>
</form>";
// Render the table
$ns->tablerender(DELETEME_A7, $deleteme_text);

require_once(e_ADMIN . "footer.php");

?>