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
require_once(e_PLUGIN . "league_table/includes/league_table_class.php");
if (!is_object($league_obj))
{
    $league_obj = new league_table;
}
include_lan(e_PLUGIN . "league_table/languages/" . e_LANGUAGE . ".php");

require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$league_current = intval($_POST['league_current']);
if (!empty($_POST['addnew']))
{
    if ($sql->db_Select("league_team", "league_team_name", "where league_team_name='" . $tp->toDB($_POST['newteam']) . "'", "nowhere", false))
    {
        $league_msg .= LEAGUE_A059 . "<br />";
    }
    else
    {
        $sql->db_Insert("league_team", "0,'" . $tp->toDB($_POST['newteam']) . "',0,0,0,0,0,0,0,1," . $league_current . ",0");
        $league_msg .= LEAGUE_A057 . "<br />";
    }
    $league_action = "save";
}
if ($_POST['league_team_confirm'] == 1)
{
    foreach($_POST['league_team_delete'] as $key => $row)
    {
        $sql->db_Delete("league_team", "league_team_id=" . intval($key), false);
    }
    $league_msg .= LEAGUE_A057 . "<br />";
    $league_action = "save";
}
if ($league_action == "save" || !empty($_POST['addnew']) || !empty($_POST['league_filter']) || !empty($_POST['submitchange']))
{
    foreach($_POST['league_team_name'] as $key => $row)
    {
        $sql->db_Update("league_team", "
	    league_team_name = '" . $tp->toDB($row) . "',
	    league_team_played = '" . intval($_POST['league_team_played'][$key]) . "',
	    league_team_won = '" . intval($_POST['league_team_won'][$key]) . "',
	    league_team_lost = '" . intval($_POST['league_team_lost'][$key]) . "',
	    league_team_drawn = '" . intval($_POST['league_team_drawn'][$key]) . "',
	    league_team_scored = '" . intval($_POST['league_team_scored'][$key]) . "',
	    league_team_bonus = '" . intval($_POST['league_team_bonus'][$key]) . "',
	    league_team_conceeded = '" . intval($_POST['league_team_conceeded'][$key]) . "',
	    league_team_points = '" . $tp->toDB($_POST['league_team_points'][$key]) . "',
	    league_team_show = '" . intval($_POST['league_team_show'][$key]) . "'
	    where league_team_id=" . intval($key), false) ;
    }
    $league_msg .= LEAGUE_A058;
    if ($_POST['league_dodate'] == 1)
    {
        $sql->db_Update("league_leagues", "league_league_last='" . time() . "' where league_league_id=" . intval($_POST['league_saved']), false);
    }
    $e107cache->clear("nq_league_table");
    $e107cache->clear("league_table_page");
}
// get list of leagues
$league_selector = "<select class='tbox' name='league_current' onchange=\"this.form.submit\">";
$sql->db_Select("league_leagues", "*");
while ($league_row = $sql->db_Fetch())
{
    if ($league_current == 0)
    {
        $league_current = $league_row['league_league_id'];
    }
    $league_selector .= "<option value='" . $league_row['league_league_id'] . "' " . ($league_row['league_league_id'] == $league_current?"selected='selected'":"") . ">" . $league_row['league_league_name'] . "</option>";
}
$league_selector .= "</select>";
$league_text .= "
<form id='dataform' method='post' action='" . e_SELF . "?update'>
<div>
<input type='hidden' name='league_saved' value='$league_current' />
</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
			<tr>
			<td class='fcaption' colspan='11' style='text-align:left'>" . LEAGUE_A001 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='11' style='text-align:left'><b>" . $league_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='11' style='text-align:left'><b>" . LEAGUE_A055 . "</b>&nbsp;</td>
		</tr>";
$league_text .= "
		<tr>
			<td class='forumheader2' colspan='1' style='text-align:left'>" . LEAGUE_A022 . "</td>
			<td class='forumheader2' colspan='10' style='text-align:left'>" . $league_selector . "
			<input type='submit' class='button' name='league_filter' value='" . LEAGUE_A025 . "' /></td>
		</tr>
		<tr>
			<td class='fcaption' colspan='11' style='text-align:left'><b>" . LEAGUE_A054 . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2'  style='text-align:left;width:20%;'>" . LEAGUE_A002 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A003 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A004 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A005 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A006 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A007 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A008 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A037 . "</td>
			<td class='forumheader2'  style='text-align:right;width:8%;'>" . LEAGUE_A009 . "</td>
			<td class='forumheader2'  style='text-align:center;width:8%;'>" . LEAGUE_A010 . "</td>
			<td class='forumheader2'  style='text-align:center;width:8%;'>" . LEAGUE_A014 . "</td>
		</tr>";
$sql->db_Select("league_leagues", "*", "where league_league_id=$league_current", "nowhere", false);
$league_lrow = $sql->db_Fetch();
extract($league_lrow);
$sql->db_Select("league_team", "*", "where league_team_league = " . $league_current . " order by league_team_points desc", "nowhere", false);
while ($league_row = $sql->db_Fetch())
{
    extract($league_row);
    $league_text .= "
		<tr>
			<td class='forumheader3' style='text-align:left'>
				<input class='tbox' style='width:85px' type='text' name='league_team_name[$league_team_id]' value='" . $tp->toFORM($league_team_name) . "' />
			</td>
			<td class='forumheader3' style='text-align:right;'>
				<input class='tbox' style='width:25px' type='text' name='league_team_played[$league_team_id]' value='$league_team_played' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:25px' type='text' name='league_team_won[$league_team_id]' value='$league_team_won' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:25px' type='text' name='league_team_lost[$league_team_id]' value='$league_team_lost' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:25px' type='text' name='league_team_drawn[$league_team_id]' value='$league_team_drawn' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:25px' type='text' name='league_team_scored[$league_team_id]' value='$league_team_scored' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:25px' type='text' name='league_team_conceeded[$league_team_id]' value='$league_team_conceeded' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:35px' type='text' name='league_team_bonus[$league_team_id]' value='$league_team_bonus' />
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:40px' type='text' name='league_team_points[$league_team_id]' value='$league_team_points' />
			</td>
			<td class='forumheader3' style='text-align:center'>
				<input class='tbox' type='checkbox' name='league_team_show[$league_team_id]' value='1' " . ($league_team_show == 1?"checked='checked'":"") . "/>
			</td>
			<td class='forumheader3' style='text-align:center'>
				<input class='tbox' type='checkbox' name='league_team_delete[$league_team_id]' value='1' />
			</td>
		</tr>";
} // while
// calendar options
$league_text .= "
		<tr>
			<td class='fcaption' colspan='11' style='text-align:left'>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' style='text-align:left'>" . LEAGUE_A026 . "</td>
			<td class='forumheader2' colspan='8' style='text-align:left'>
				<input type='checkbox' class='tbox' value='1' name='league_dodate' /> &nbsp;<i>" . LEAGUE_A042 . "</i>
			</td>
			<td class='forumheader2' colspan='1' style='text-align:left'>" . LEAGUE_A015 . "</td>
			<td class='forumheader2' colspan='1' style='text-align:center'>
				<input class='tbox' type='checkbox' name='league_team_confirm' value='1' />
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='11' style='text-align:left'>
				<input type='submit' class='button' name='submitchange' value='" . LEAGUE_A011 . "'  />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='11' style='text-align:left'><b>" . LEAGUE_A056 . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' style='text-align:left'>" . LEAGUE_A012 . "</td>
			<td class='forumheader2' colspan='10' style='text-align:left'>
				<input type='text' class='tbox' style='width:30%' name='newteam' value=''  />
				<input type='submit' class='button' name='addnew' value='" . LEAGUE_A013 . "'  />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='11' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender(LEAGUE_M001, $league_text);
require_once(e_ADMIN . "footer.php");

?>