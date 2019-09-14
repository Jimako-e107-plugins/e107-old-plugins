<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}

global$tp, $sql, $e107cache, $LEAGUE_PREFS;
define(e_PAGETITLE, LEAGUE_PAGE);
require_once(HEADERF);
require_once(e_HANDLER . "cache_handler.php");

if ($league_table_cache = $e107cache->retrieve("league_table_page"))
{
    echo $league_table_cache;
}
else
{
    unset($league_text);
    unset($league_head);
    include_lan(e_PLUGIN . "league_table/languages/" . e_LANGUAGE . ".php");
    require_once(e_PLUGIN . "league_table/includes/league_table_class.php");
    if (!is_object($league_obj))
    {
        $league_obj = new league_table;
    }
    require_once(e_HANDLER . "date_handler.php");
    if (!is_object($league_gen))
    {
        $league_gen = new convert;
    }
    if ($league_lcount = $sql2->db_Select("league_leagues", "*", "order by league_league_order asc", "nowhere", false))
    {
        if (is_readable(e_PLUGIN . "league_table/images/logo.png"))
        {
            $league_text .= "
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' style='text-align:left;'>" . LEAGUE_PAGE . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='text-align:center;'>
			<img src='" . e_PLUGIN . "league_table/images/logo.png' style='border:0;' alt='' />
		</td>
	</tr>
</table>";
        }
        while ($league_lrow = $sql2->db_Fetch())
        {
            extract($league_lrow);
            unset($league_head);
            $league_display = ($league_league_open == 1?"block":"none");
            $league_teamcount = $sql->db_Select("league_team", "*", "where league_team_league = {$league_league_id} order by league_team_points desc", "nowhere", false);
            // display this league
            $league_colspan = 2;
            if ($LEAGUE_PREFS['league_played'] == 1)
            {
                $league_head = "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A003 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_won'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A004 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_lost'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A005 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_drawn'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A006 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_scored'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A007 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_conceded'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A008 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_bonus'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A037 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_points'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A009 . "</span></td>";
                $league_colspan++;
            }
            $league_text .= "
<div class='forumheader2'>
<div onclick=\"expandit('leaguedivpage" . $league_league_id . "');\" style='width:98%;text-align:left;cursor:pointer;background-image:url(".SITEURL.$PLUGINS_DIRECTORY."league_table/images/expand.png);background-repeat: no-repeat;background-position:center right;'>" . $league_league_name . "</div>
<div id='leaguedivpage" . $league_league_id . "' style='width:100%;text-align:center;display:" . $league_display . "' >";

            $league_text .= "
<table style='width:100%;' class='fborder'>
	<tr>
		<td class='fcaption' colspan='$league_colspan'>" . LEAGUE_003 . " " . $league_gen->convert_date($league_league_last, $LEAGUE_PREFS['league_dateform']) . "</td>
	</tr>";
            $league_text .= "
	<tr>
		<td class='forumheader2' style='width:10%;text-align:center;'><span class='smalltext'>" . LEAGUE_A016 . "</span></td>
		<td class='forumheader2'  style='text-align:left;'><span class='smalltext'>" . LEAGUE_A002 . "</span></td>";
            $league_text .= $league_head;
            $league_text .= "
	</tr>";
            $league_count = 1;

            if ($league_teamcount > 0)
            {
                while ($league_row = $sql->db_Fetch())
                {
                    extract($league_row);

                    $league_text .= "
	<tr>
		<td class='forumheader3' style='text-align:center;'>" . $league_count . "</td>
		<td class='forumheader3' style='text-align:left;'>" . $tp->toHTML($league_team_name, false) . "</td>";
                    if ($LEAGUE_PREFS['league_played'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_played, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_won'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_won, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_lost'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_lost, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_drawn'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_drawn, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_scored'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_scored, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_conceded'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_conceeded, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_bonus'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_bonus, false) . "</td>";
                    }
                    if ($LEAGUE_PREFS['league_points'] == 1)
                    {
                        $league_text .= "
		<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_points, false) . "</td>";
                    }
                    $league_text .= "
	</tr>";

                    $league_count++;
                }
            }
            else
            {
                $league_text .= "
	<tr>
		<td class='forumheader3' colspan='$league_colspan'>" . LEAGUE_A043 . "</td>
	</tr>";
            }
            $league_text .= "
	<tr>
		<td class='fcaption' colspan='$league_colspan'>&nbsp;</td>
	</tr>
</table>
</div>
</div>";
        } // while
    }
    ob_start();
    $ns->tablerender(LEAGUE_PAGE, $league_text);
    $league_table_cache = ob_get_flush();
    $e107cache->set("league_table_page", $league_table_cache);
}
require_once(FOOTERF);

?>