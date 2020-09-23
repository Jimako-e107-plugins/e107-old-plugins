<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_ADMIN')) {
    die ("You can't access this file directly...");
}

//CLEAN WARS
$yesterday = time()-(24*3600);
$sql->db_Delete("clan_wars", "active=0 AND opp_tag='' AND opp_name='' AND lastupdate<$yesterday");
if($conf['lastclean'] < time()-(7*24*3600)) include("admin/cleanup.php");

?>
<style type="text/css">
.iconpointer{
	cursor:pointer;
}
</style>
<script type="text/javascript">
	//LANG
	var suredelwar = "<?php echo _WSUREDELWAR;?>";
	var errordelwar = "<?php echo _WERRORDELWAR;?>";
	
function TdHover(id){
	var tds = document.getElementById('war'+id).getElementsByTagName('td');
	for(var i = 0;i<tds.length;i++){
		tds[i].className = 'forumheader3';
	}
}
function TdOut(id){
	var tds = document.getElementById('war'+id).getElementsByTagName('td');
	for(var i = 0;i<tds.length;i++){
		tds[i].className = 'forumheader3';
	}
}	
</script>
<script type="text/javascript" src="includes/main.js"></script>

<?php	
	$teams = $sql->db_Count("clan_teams", "(*)", "WHERE inwars='1'");

	$text = "<table style='".ADMIN_WIDTH."' class='fborder'>"
	."<tr>"
		."<td class='fcaption' style='text-align:center'></td>"
		."<td class='fcaption' style='text-align:center'><b>"._WDATE."</b></td>";
		if($teams>0){
			$text .= "<td class='fcaption' style='text-align:center' nowrap><b>"._WTEAM."</b></td>";
		}
		$text .= "<td class='fcaption' style='text-align:center' width='50%'><b>"._WOPP."</b></td>"
		."<td class='fcaption' style='text-align:center'><b>"._WSTATUS."</b></td>"
		."<td class='fcaption' style='text-align:center' nowrap><b>"._WRESULTS."</b></td>"
		."<td class='fcaption' style='text-align:center'></td>"
	."</tr>";
	
	$actshown = false;
	$inactshown = false;
	$upcshown = false;
	$finshown = false;
	$sql1 = new db;
	$result = $sql->db_Select("clan_wars", "*", "opp_tag!='' OR opp_name!='' order by active, ".($conf['seperate']?"status ASC,":"")." wardate DESC");
	while ($row = $sql->db_Fetch()) {
		$wid = $row['wid'];
		$active = $row['active'];
		$wardate = $row['wardate'];
		$team = $row['team'];
		$status = $row['status'];
		$opp_tag = $row['opp_tag'];
		$opp_name = $row['opp_name'];
		$opp_url = $row['opp_url'];
		$opp_country = $row['opp_country'];
		$game = $row['game'];
		$our_score = $row['our_score'];
		$opp_score = $row['opp_score'];	
		
		if(!$active && !$inactshown){
			$text .= "<tr><td class='fcaption' colspan='".(($teams) ? 7 : 6)."'><b>Awaiting Approval</b></td></tr>";
			$inactshown = true;
		}if($active && !$actshown && $inactshown){
			$actshown = true;
		}if($conf['seperate']){
			if(($actshown || $active) && !$upcshown && !$status){
				$text .= "<tr><td class='fcaption' colspan='".(($teams) ? 7 : 6)."'><b>Upcoming Matches</b></td></tr>";
				$upcshown = true;
			}
			if(!$finshown && $upcshown && $status){
				$text .= "<tr><td class='fcaption' colspan='".(($teams) ? 7 : 6)."'><b>Finished Matches</b></td></tr>";
				$finshown = true;
			}
		}
	
		if (strlen($opp_name) > 30){
	  		$opp_name = substr($opp_name, 0, 30 - 3)."..."; 
		}
		$gotowar = "onclick=\"GTWar('$wid".(($active) ? "" : "&new=1")."');\"";
			
		$text .= "<tr id='war$wid' title='Edit this war' class='iconpointer' onmouseover=\"TdHover($wid);\" onmouseout=\"TdOut($wid);\">";
		$sql1->db_Select("clan_games", "*", "gid='$game'");
		$rowg = $sql1->db_Fetch();
			$abbr = $rowg['abbr'];
			$gname = $rowg['gname'];
			$icon = $rowg['icon'];
		$text .= "<td class='forumheader3' style='text-align:center' nowrap='nowrap' $gotowar>".(($icon != "" && file_exists(e_IMAGE."clan/games/$icon")) ? "<img border='0' src='".e_IMAGE."clan/games/$icon' title='$gname' alt='".($abbr?$abbr:$gname)."' />" : ($abbr?$abbr:$gname))."</td>";
	
		$text .= "<td class='forumheader3' style='text-align:center' nowrap $gotowar>".(($wardate == -1) ? "" : date($conf['formatlist'],$wardate))."</td>";
		if($teams>0){
			$sql1->db_Select("clan_teams", "*", "tid='$team'");
			$row = $sql1->db_Fetch();
			$team_tag = $row['team_tag'];
			if($conf['showteamflag']){
				$team_country = $row['team_country'];			
				$text .= "<td align='left' class='forumheader3' style='text-align:left' nowrap $gotowar><img src='".e_IMAGE."clan/flags/$team_country.png' title='$team_country'/>&nbsp;$team_tag</td>";
			}else{
				$text .= "<td class='forumheader3' style='text-align:center' nowrap $gotowar>$team_tag</td>";
			}
		}
		$text .= "<td class='forumheader3' nowrap $gotowar>&nbsp;<img src='".e_IMAGE."clan/flags/$opp_country.png' title='$opp_country'/>&nbsp;$opp_tag"
				.($opp_tag !="" && $opp_name!=""?"&nbsp;-&nbsp;":"").$opp_name."</td>
				<td class='forumheader3' style='text-align:center' nowrap $gotowar>".(($status) ? _WFINISHED : _WNEXTMATCH)."</td>";
		
		if($status==1){
			if ($our_score > $opp_score){
				$scorecolor = "#009900";
			}elseif($our_score < $opp_score){
				$scorecolor = "#990000";
			}else{
				$scorecolor = "#3333FF";
			}
			if($conf['colorbox']){
				//Colored Boxes					
				$text .= "<td class='forumheader3' style='text-align:center;background-color:$scorecolor' nowrap><b style='color: #FFF;'>$our_score/$opp_score</b></td>";
			}else{
				//Colored Text					
				$text .= "<td class='forumheader3' style='text-align:center;'><b style='color: $scorecolor;'>$our_score/$opp_score</b></td>";			
			}
		}else{
			//No score
			$text .= "<td style='text-align:center;' class='forumheader3' nowrap $gotowar><b>N/A</b></td>";
		}
		
		$text .= "<td style='text-align:center;' class='forumheader3' width='5'><input type='button' onclick='DelWar($wid);' value='"._WDEL."' class='button' /></td>
	</tr>";
	}
$text .= "</table>";

$ns->tablerender(_CLANWARS, $text);
		
?>