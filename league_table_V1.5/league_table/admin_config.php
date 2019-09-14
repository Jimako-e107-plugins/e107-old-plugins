<?php

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
include_lan(e_PLUGIN . "league_table/languages/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "league_table/includes/league_table_class.php");
if (!is_object($league_obj))
{
    $league_obj = new league_table;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}

if (e_QUERY == "update")
{
    $LEAGUE_PREFS['league_played'] = intval($_POST['league_played']);
    $LEAGUE_PREFS['league_won'] = intval($_POST['league_won']);
    $LEAGUE_PREFS['league_lost'] = intval($_POST['league_lost']);
    $LEAGUE_PREFS['league_drawn'] = intval($_POST['league_drawn']);
    $LEAGUE_PREFS['league_scored'] = intval($_POST['league_scored']);
    $LEAGUE_PREFS['league_conceded'] = intval($_POST['league_conceded']);
    $LEAGUE_PREFS['league_points'] = intval($_POST['league_points']);
    $LEAGUE_PREFS['league_bonus'] = intval($_POST['league_bonus']);
    $LEAGUE_PREFS['league_dateform'] = $tp->toDB($_POST['league_dateform']);
    $LEAGUE_PREFS['league_mplayed'] = intval($_POST['league_mplayed']);
    $LEAGUE_PREFS['league_mwon'] = intval($_POST['league_mwon']);
    $LEAGUE_PREFS['league_mlost'] = intval($_POST['league_mlost']);
    $LEAGUE_PREFS['league_mdrawn'] = intval($_POST['league_mdrawn']);
    $LEAGUE_PREFS['league_mscored'] = intval($_POST['league_mscored']);
    $LEAGUE_PREFS['league_mconceded'] = intval($_POST['league_mconceded']);
    $LEAGUE_PREFS['league_mpoints'] = intval($_POST['league_mpoints']);
    $LEAGUE_PREFS['league_mbonus'] = intval($_POST['league_mbonus']);
    $LEAGUE_PREFS['league_mdateform'] = $tp->toDB($_POST['league_mdateform']);
    $LEAGUE_PREFS['league_mtop'] = intval($_POST['league_mtop']);
    $LEAGUE_PREFS['league_mbot'] = intval($_POST['league_mbot']);
    $league_obj->save_prefs();
    $e107cache->clear("nq_league_table");
    $e107cache->clear("league_table_page");
}
$league_text .= LEAGUE_A028;
$league_text = "
<form id='dataform' method='post' action='" . e_SELF . "?update'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . LEAGUE_A017 . "</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . LEAGUE_A041 . "</td><td class='forumheader3'>
				<select class='tbox' name='league_dateform'>
					<option value='short' " . ($tp->toFORM($LEAGUE_PREFS['league_dateform']) == "short" ?"selected='selected'":"") . ">" . LEAGUE_A039 . "</option>
					<option value='long' " . ($tp->toFORM($LEAGUE_PREFS['league_dateform']) == "long" ?"selected='selected'":"") . ">" . LEAGUE_A040 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . LEAGUE_A044 . "</td>
		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A030 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_played' value='1' " . ($LEAGUE_PREFS['league_played'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A031 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_won' value='1' " . ($LEAGUE_PREFS['league_won'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A032 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_lost' value='1' " . ($LEAGUE_PREFS['league_lost'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A033 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_drawn' value='1' " . ($LEAGUE_PREFS['league_drawn'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A034 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_scored' value='1' " . ($LEAGUE_PREFS['league_scored'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A035 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_conceded' value='1' " . ($LEAGUE_PREFS['league_conceded'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A038 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_bonus' value='1' " . ($LEAGUE_PREFS['league_bonus'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A036 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_points' value='1' " . ($LEAGUE_PREFS['league_points'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>

		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . LEAGUE_A045 . "</td>
		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A030 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mplayed' value='1' " . ($LEAGUE_PREFS['league_mplayed'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A031 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mwon' value='1' " . ($LEAGUE_PREFS['league_mwon'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A032 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mlost' value='1' " . ($LEAGUE_PREFS['league_mlost'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A033 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mdrawn' value='1' " . ($LEAGUE_PREFS['league_mdrawn'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A034 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mscored' value='1' " . ($LEAGUE_PREFS['league_mscored'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A035 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mconceded' value='1' " . ($LEAGUE_PREFS['league_mconceded'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A038 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mbonus' value='1' " . ($LEAGUE_PREFS['league_mbonus'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A036 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='checkbox' class='tbox' name='league_mpoints' value='1' " . ($LEAGUE_PREFS['league_mpoints'] == 1?"checked='checked'":"") . " />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A061 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='text' class='tbox' name='league_mtop' value='" . $LEAGUE_PREFS['league_mtop'] . "' />
 			</td>
 		</tr>
 		<tr>
 			<td class='forumheader3'  style='text-align:left;width:30%'>" . LEAGUE_A062 . "</td>
 			<td class='forumheader3'  style='text-align:left'>
 				<input type='text' class='tbox' name='league_mbot' value='" . $LEAGUE_PREFS['league_mbot'] . "' />
 			</td>
 		</tr>
 		<tr>
 			<td class='fcaption' colspan='2' style='text-align:left'>
			 	<input type='submit' class='button' name='subconf' value='" . LEAGUE_A019 . "' />
			</td>
 		</tr>
 	</table>
</form>";
$ns->tablerender(LEAGUE_M001, $league_text);
require_once(e_ADMIN . "footer.php");

?>