
<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2013 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
/* EDIT OPTIONS HERE */
/* change to false if you want to disable it, and set it to true to enable*/

//General options
$menu_title = "Clan Wars";
$show_heading = true;
$amount_of_wars = 10;
$seperate_upcoming_finished = true;
$war_date_format = ""; //e.g. j M H:i
$result_colored_box = true;

//Columns to show
$show_game_icon = false;
$show_date = true;
$show_teams = false;
$show_oppenent = true;
$show_style = true;
$show_players = false;
$show_result = false;

//Ordering
$order_by = "Date"; //Date, Game, Team, Opponent, Style or Players
$order = "DESC"; //ASC (for ascending), DESC (for descending)

//Filters
$sel_status = "All"; //1 (for finished), 0 (for upcoming)
$sel_game = 0; //ID of game to show (0 for all)
$sel_team = 0; //ID of team to show (0 for all)
$sel_style = "All"; //Name of style to show

/* END OPTIONS */
if (!defined('e107_INIT')) { exit; }
$text = "<style type=\"text/css\">
.iconpointer{
	cursor:pointer;
}
</style>";
$totalwars = $sql->db_Count("clan_wars", "(*)", "WHERE active='1'");	
	if($totalwars==0){
		$text .= "<center>"._WNOWARSYET."</center>";
	}else{	
	
	
	//Filters
	$orderby = $order;
	$sortby = $order_by;
	if($orderby==""){$orderby="DESC";}
	if($sortby==""){$sortby="Date";}
		
	$wheresql = "";
	$pagefilters = "";
	$selstatus = mysql_real_escape_string($_REQUEST['selstatus']);
	$selgid = intval($_REQUEST['selgid']);
	$seltid = intval($_REQUEST['seltid']);
	$selstyle = mysql_real_escape_string($_REQUEST['selstyle']);
	if($sel_status == "1"){
		$wheresql .= " AND status='1'";
		$pagefilters .= "&selstatus=1";
	}elseif($sel_status == "0"){
		$wheresql .= " AND status='0'";
		$pagefilters .= "&selstatus=0";
	}if($sel_game>0){
		$wheresql .= " AND game='$selgid'";			
		$pagefilters .= "&selgid=".$selgid;
	}if($sel_tid>0){
		$wheresql .= " AND team='$seltid'";			
		$pagefilters .= "&seltid=".$seltid;
	}if($sel_style !="" && $sel_style !="All"){
		$wheresql .= " AND style='$selstyle'";			
		$pagefilters .= "&selstyle=".$selstyle;
	}

$tables = "";
if($orderby=="DESC" && $sortby=="Date"){$ordersort="wardate DESC";}
elseif($orderby=="ASC" && $sortby=="Date"){$ordersort="wardate ASC";}
elseif($orderby=="DESC" && $sortby=="Game"){
	$ordersort="g.gname DESC, wardate DESC";
	$tables = ", #clan_games as g";
	$wheresql .= " AND game=g.gid";
}elseif($orderby=="ASC" && $sortby=="Game"){
	$ordersort="g.gname ASC, wardate DESC";
	$tables = ", #clan_games as g";
	$wheresql .= " AND game=g.gid";
}elseif($orderby=="DESC" && $sortby=="Game"){
	$ordersort="t.team_tag DESC, wardate DESC";
	$tables = ", #clan_teams as t";
	$wheresql .= " AND team=t.tid";
}elseif($orderby=="ASC" && $sortby=="Game"){
	$ordersort="t.team_tag ASC, wardate DESC";
	$tables = ", #clan_teams as t";
	$wheresql .= " AND team=t.tid";
}elseif($orderby=="DESC" && $sortby=="Opponent"){$ordersort="opp_tag DESC, wardate DESC";}
elseif($orderby=="ASC" && $sortby=="Opponent"){$ordersort="opp_tag ASC, wardate DESC";}
elseif($orderby=="DESC" && $sortby=="Style"){$ordersort="style DESC, wardate DESC";}
elseif($orderby=="ASC" && $sortby=="Style"){$ordersort="style ASC, wardate DESC";}
elseif($orderby=="DESC" && $sortby=="Players"){$ordersort="players DESC, wardate DESC";}
elseif($orderby=="ASC" && $sortby=="Players"){$ordersort="players ASC, wardate DESC";}


	$columns = 0;
		
	$text .= "<table width='100%' class='fborder' id='warstable'>";
	if($show_heading){
		$text .= "<tr>";
			if($show_game_icon){ $text .= "<td class='fcaption' nowrap></td>";$columns++;}
			if($show_date){ $text .= "<td class='fcaption' nowrap><b>Date</b></td>";$columns++;}
			if($show_teams){ $text .= "<td class='fcaption' nowrap><b>Team</b></td>";$columns++;}
			if($show_oppenent){ $text .= "<td class='fcaption' nowrap><b>Opponent</b></td>";$columns++;}
			if($show_style){ $text .= "<td class='fcaption' nowrap><b>Style</b></td>";$columns++;}
			if($show_players){ $text .= "<td class='fcaption' nowrap><b>Players</b></td>";$columns++;}
			if($show_result){ $text .= "<td class='fcaption' nowrap><b>Results</b></td>";$columns++;}
		$text .= "</tr>";
	}
	
	$upcshown = false;
	$finshown = false;
	$sql->db_Select_gen("SELECT * from #clan_wars $tables WHERE active='1' $wheresql ORDER BY ".($seperate_upcoming_finished?"status ASC,":"")." $ordersort LIMIT 0, ".$amount_of_wars);
		$sql1 = new db;
		while ($row = $sql->db_Fetch()) {
			$wid = $row['wid'];
			$wardate = $row['wardate'];
			$style = $row['style'];
			$status = $row['status'];
			$team = $row['team'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$game = $row['game'];
			$players = $row['players'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
			
			if($seperate_upcoming_finished && ($sel_status == _WALL || $sel_status == "")){
				if(!$upcshown && !$status){
					$text .= "<tr><td class='fcaption' colspan='".$columns."'><b>Upcoming Matches</b></td></tr>";
					$upcshown = true;
				}
				if(!$finshown && $upcshown && $status){
					$text .= "<tr><td class='fcaption' colspan='".$columns."'><b>Finished Matches</b></td></tr>";
					$finshown = true;
				}
			}
			
			if (strlen($opp_name) > 30){
				$opp_name = substr($opp_name, 0, 30 - 3)."..."; 
			}					

		$text .= "<tr class='forumheader3 iconpointer' title='Show Match Details' onmouseover=\"TdHover($wid);\" onmouseout=\"TdOut($wid);\" onclick=\"window.location='".e_PLUGIN ."clanwars/clanwars.php?Details&wid=$wid'\" id='war$wid'>";	
								
		
			if($show_game_icon){
				$sql1->db_Select("clan_games", "*", "gid='$game'");
				$rowicon = $sql1->db_Fetch();
				$icon = $rowicon['icon'];
				$abbr = $rowicon['abbr'];
				$gname = $rowicon['gname'];
				$text .= "<td class='forumheader3' nowrap>";
				if ($icon != "") {
					$text .= "<img border='0' src='".e_IMAGE."clan/games/$icon' title='$gname' align='absmiddle' alt='".($abbr?$abbr:$gname)."' />";
				}else{
					$text .= ($abbr?$abbr:$gname);
				}
				$text .= "</td>";
			}
			if($show_date){
				if($war_date_format == "") $war_date_format = "j M H:i";
				$text .= "<td class='forumheader3'>".(($wardate == -1) ? "" : date($war_date_format,$wardate))."</td>";
			}
			if($show_teams){
				$sql1->db_Select("clan_teams", "*", "tid='$team'");
				$row = $sql1->db_Fetch();
				$team_tag = $row['team_tag'];
				if($teams){
					if($conf['showteamflag']){
						$team_country = $row['team_country'];			
						$text .= "<td class='forumheader3' style='text-align:left;'><img src='".e_IMAGE."clan/flags/$team_country.png' title='$team_country'/>&nbsp;$team_tag</td>";
					}else{
						$text .= "<td class='forumheader3'>$team_tag</td>";
					}
				}
			}
			if($show_oppenent){
				$text .= "<td class='forumheader3' style='text-align:left;'>&nbsp;<img src='".e_IMAGE."clan/flags/$opp_country.png' border='0' title='$opp_country' align='absmiddle' />&nbsp;";
				
				if($opp_tag !=""){$text .= $opp_tag;}else{$text .= $opp_name;}			
	
				$text .= "</td>";
			}
			if($show_style){
				$text .= "<td class='forumheader3'>$style</td>";
			}
			if($show_players){
				$text .= "<td class='forumheader3'>".((intval($players)) ? $players._WON.$players : "N/A")."</td>";
			}
			if($show_result){
				if($status==1){
					if ($our_score > $opp_score){
						$scorecolor = "#009900";
					}elseif($our_score < $opp_score){
						$scorecolor = "#990000";
					}else{
						$scorecolor = "#3333FF";
					}
					if($result_colored_box){
						//Colored Boxes					
						$text .= "<td class='forumheader3' style='background-color:$scorecolor'><b style='color: #FFF;'>$our_score/$opp_score</b></td>";
					}else{
						//Colored Text					
						$text .= "<td class='forumheader3'><b style='color: $scorecolor;'>$our_score/$opp_score</b></td>";			
					}
				}else{
					//No score
					$text .= "<td class='forumheader3'><b>N/A</b></td>";
				}
			}
			$text .= "</tr>";
		}
		$text .= "</table>";
	}
$ns->tablerender($menu_title, $text);

?>