<?php
if (!defined('e107_INIT'))
{
    exit;
}
global$tp, $sql, $sql2, $league_gen, $LEAGUE_PREFS, $league_obj,$PLUGINS_DIRECTORY;
include_lan(e_PLUGIN . "league_table/languages/" . e_LANGUAGE . ".php");
require_once(e_HANDLER . "cache_handler.php");
require_once(e_HANDLER . "date_handler.php");
if (!is_object($league_gen))
{
    $league_gen = new convert;
}
unset($league_text);
if ($league_tablemenu_cache = $e107cache->retrieve("nq_league_table"))
{
    echo $league_tablemenu_cache;
    return;
}
else
{
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
        while ($league_lrow = $sql2->db_Fetch())
        {
            unset($league_head);
            extract($league_lrow);
            $league_display = ($league_league_openmenu == 1?"block":"none");

            $league_teamcount = $sql->db_Select("league_team", "*", "where league_team_league = {$league_league_id} order by league_team_points desc", "nowhere", false);
            // display this league
            $league_colspan = 2;
            if ($LEAGUE_PREFS['league_mplayed'] == 1)
            {
                $league_head = "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A003 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mwon'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A004 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mlost'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A005 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mdrawn'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A006 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mscored'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A007 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mconceded'] == 1)
            {
                $league_head .= "
		<td class='forumheader2'  style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A008 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mbonus'] == 1)
            {
                $league_head .= "
		<td class='forumheader2' style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A037 . "</span></td>";
                $league_colspan++;
            }
            if ($LEAGUE_PREFS['league_mpoints'] == 1)
            {
                $league_head .= "
		<td class='forumheader2' style='text-align:right;width:8%;'><span class='smalltext'>" . LEAGUE_A009 . "</span></td>";
                $league_colspan++;
            }
         // Create the league's heading
		    $league_text .= "
		    <div class='forumheader2'>
<div onclick=\"expandit('leaguemdivpage" . $league_league_id . "');\" style='width:95%;text-align:left;cursor:pointer;background-image:url(".SITEURL.$PLUGINS_DIRECTORY."league_table/images/expand.png);background-repeat: no-repeat;background-position:center right;'>" . $league_league_name . "</div>";
	// the league's table
			    $league_text .= "
<div id='leaguemdivpage" . $league_league_id . "' style='width:100%;text-align:center;display:" . $league_display . "' >";
            $league_text .= "
	<table style='width:100%;' >
		<tr>
			<td class='fcaption' colspan='$league_colspan'>" . LEAGUE_003 . " " . $league_gen->convert_date($league_league_last, $LEAGUE_PREFS['league_dateform']) . "</td>
		</tr>";
            $league_text .= "
		<tr>
			<td class='forumheader2' style='text-align:center;'><span class='smalltext'>" . LEAGUE_A016 . "</span></td>
			<td class='forumheader2'  style='text-align:left;'><span class='smalltext'>" . LEAGUE_A002 . "</span></td>";
            $league_text .= $league_head;
            $league_text .= "
		</tr>";
            $league_rcount = 1;
            $league_count = 1;
            $league_elipsis = false;
            if ($league_teamcount > 0)
            {
                while ($league_row = $sql->db_Fetch())
                {
                    extract($league_row);
                    if (!$league_elipsis && ($LEAGUE_PREFS['league_mtop'] == 0 || ($LEAGUE_PREFS['league_mbot'] > 0 && $league_rcount > ($league_teamcount - $LEAGUE_PREFS['league_mbot']))))
                    {
                        $league_elipsis = true;
                        $league_text .= "
        <tr>
			<td class='forumheader2' colspan='$league_colspan' style='text-align:center;'>...</td>
		</tr>";
                    }
                    if ($LEAGUE_PREFS['league_mtop'] == 0 || ($LEAGUE_PREFS['league_mbot'] > 0 && $league_rcount > ($league_teamcount - $LEAGUE_PREFS['league_mbot'])) || ($LEAGUE_PREFS['league_mtop'] > 0 && $league_rcount <= $LEAGUE_PREFS['league_mtop']))
                    {
                        $league_text .= "
		<tr>
			<td class='forumheader3' style='width:10%;text-align:center;'>" . $league_count . "</td>
			<td class='forumheader3' style='text-align:left;'>" . $tp->toHTML($league_team_name, false) . "</td>";
                        if ($LEAGUE_PREFS['league_mplayed'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_played, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mwon'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_won, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mlost'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_lost, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mdrawn'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_drawn, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mscored'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_scored, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mconceded'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_conceeded, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mbonus'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_bonus, false) . "</td>";
                        }
                        if ($LEAGUE_PREFS['league_mpoints'] == 1)
                        {
                            $league_text .= "
			<td class='forumheader3'  style='text-align:right;'>" . intval($league_team_points, false) . "</td>";
                        }
                        $league_text .= "
		</tr>";
                    }
                    $league_rcount++;
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
        $league_text .= "
<div style='text-align:center;width:95%' class='forumheader2'>
		<a href='" . e_PLUGIN . "league_table/table.php' >" . LEAGUE_002 . "</a>
</div>";
    }
    ob_start();
    $ns->tablerender(LEAGUE_MENU, $league_text);
    $league_tablemenu_cache = ob_get_flush();
    $e107cache->set("nq_league_table", $league_tablemenu_cache);
}

?>