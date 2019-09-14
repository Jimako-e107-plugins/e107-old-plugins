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
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if (!empty($_POST['addnew']))
{
    if ($sql->db_Select("league_leagues", "league_league_id", "where league_league_name='" . $tp->toDB($_POST['newleague']) . "'", "nowhere", false))
    {
        $league_msg .= LEAGUE_A051 . "<br />";
    }
    else
    {
        if ($sql->db_Insert("league_leagues", "0,'" . $tp->toDB($_POST['newleague']) . "',0," . time() . ",1,1", false))
            $league_msg .= LEAGUE_A050 . "<br />";
    }
    $league_action = "save";
}
if ($_POST['league_league_confirm'] == 1)
{
    foreach($_POST['league_league_delete'] as $key => $row)
    {
        // check if the league is empty
        if ($sql->db_Select_gen("
		select league_league_name from #league_team
		left join #league_leagues on league_team_league=league_league_id
		where league_team_league='" . intval($key) . "'", false))
        {
            $league_row = $sql->db_Fetch();
            $league_msg .= LEAGUE_A046 . " " . $tp->toHTML($league_row['league_league_name']) . " " . LEAGUE_A047 . "<br />";
        }
        else
        {
            // delete the league
            $sql->db_Delete("league_leagues", "league_league_id=" . intval($key), false);
            // delete any teams in that league though they should not be any
            $sql->db_Delete("league_team", "league_team_league=" . intval($key), false);
            $league_msg .= LEAGUE_A048 . "<br />";
        }
    }
    $league_action = "save";
}
if ($league_action == "save" || !empty($_POST['submitchange']))
{
    foreach($_POST['league_league_name'] as $key => $row)
    {
        $sql->db_Update("league_leagues", "
	    league_league_name = '" . $tp->toDB($row) . "',
	    league_league_order = '" . intval($_POST['league_league_order'][$key]) . "',
	    league_league_open = '" . intval($_POST['league_league_open'][$key]) . "',
	    league_league_openmenu = '" . intval($_POST['league_league_openmenu'][$key]) . "'
	    where league_league_id=" . intval($key), false) ;
    }
    $league_msg .= LEAGUE_A049;
    $e107cache->clear("nq_league_table");
    $e107cache->clear("league_table_page");
}
$league_text = "
<form id='dataform' method='post' action='" . e_SELF . "?update'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'>" . LEAGUE_A021 . "</td>
		</tr>

		<tr>
			<td class='forumheader2' colspan='5' style='text-align:left'><b>" . $league_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'><b>" . LEAGUE_A053 . "</b>&nbsp;</td>
		</tr>";
$league_text .= "
		<tr>
			<td class='forumheader2'  style='text-align:left;width:60%;'>" . LEAGUE_A022 . "</td>
			<td class='forumheader2'  style='text-align:center;width:10%;'>" . LEAGUE_A027 . "</td>
			<td class='forumheader2'  style='text-align:center;width:10%;'>" . LEAGUE_A060 . "</td>
			<td class='forumheader2'  style='text-align:center;width:10%;'>" . LEAGUE_A023 . "</td>
			<td class='forumheader2'  style='text-align:center;width:10%;'>" . LEAGUE_A024 . "</td>
		</tr>";
$sql->db_Select("league_leagues", "*", "order by league_league_order asc", "nowhere", false);
while ($league_row = $sql->db_Fetch())
{
    extract($league_row);
    $league_text .= "
		<tr>
			<td class='forumheader3' style='text-align:left'>
				<input class='tbox' style='width:50%' type='text' name='league_league_name[$league_league_id]' value='" . $tp->toFORM($league_league_name) . "' />
			</td>
			<td class='forumheader3' style='text-align:center'>
				<input class='tbox' type='checkbox' name='league_league_open[$league_league_id]' value='1' " . ($league_league_open == 1?"checked='checked'":"") . "/>
			</td>
			<td class='forumheader3' style='text-align:center'>
				<input class='tbox' type='checkbox' name='league_league_openmenu[$league_league_id]' value='1' " . ($league_league_openmenu == 1?"checked='checked'":"") . "/>
			</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='tbox' style='width:25px' type='text' name='league_league_order[$league_league_id]' value='$league_league_order' />
			</td>
			<td class='forumheader3' style='text-align:center'>
				<input class='tbox' type='checkbox' name='league_league_delete[$league_league_id]' value='1' />
			</td>
		</tr>";
} // while
$league_text .= "
		<tr>
			<td class='forumheader2' colspan='3' style='text-align:left'>
				<input type='submit' class='button' name='submitchange' value='" . LEAGUE_A011 . "'  />
			</td>
			<td class='forumheader2' colspan='1' style='text-align:right'>" . LEAGUE_A015 . "</td>
			<td class='forumheader2' colspan='1' style='text-align:center'>
			<input class='tbox' type='checkbox' name='league_league_confirm' value='1' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'><b>" . LEAGUE_A052 . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='5' style='text-align:left'>" . LEAGUE_A020 . "

				<input type='text' class='tbox' style='width:30%' name='newleague' value=''  />
				<input type='submit' class='button' name='addnew' value='" . LEAGUE_A013 . "'  />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender(LEAGUE_M005, $league_text);
require_once(e_ADMIN . "footer.php");

?>