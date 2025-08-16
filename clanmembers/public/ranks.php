<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_PUB')) {
    die ("You can't access this file directly...");
}

if(!(ADMIN or !USER && $conf['guestviewcontactinfo'])){
	header("Location: clanmembers.php");	
}
?>
<style type="text/css">
.listtitle{
	font-weight:bold;
	padding:<?php echo  ($conf['padding']?$conf['padding']:5);?>px;
}
</style>
<?php
$firstarray = unserialize($conf['listorder']);
$secondarray = $firstarray['show'];

$games = $sql->db_Count("clan_games", "(*)", "WHERE inmembers='1'");
$teams = $sql->db_Count("clan_teams", "(*)", "WHERE inmembers='1'");

$text = "<center>";
$list = array();
if($conf['showview']){
	$text .= _VIEW.": ";
	if($games > 0) $list[] = "<a href='clanmembers.php?Main&view=Games'>"._INFOGames."</a>";
	if($teams > 0) $list[] = "<a href='clanmembers.php?Main&view=Teams'>"._INFOTeams."</a>";	
	if((USER or $conf['guestviewcontactinfo']) && $conf['showcontactlist']) $list[] = "<a href='clanmembers.php?Contact'>"._CONTACT."</a>";
	$list[] = _INFORanks;
}else{
	$list[] = "<a href='clanmembers.php'>"._CLANMEMBERSLIST."</a>";
}

if(count($list)){
	$show = "";
	foreach($list as $item){
		$show .= $item." | ";
	}
	$text .= substr($show,0,-3);
	$text .= "<br />&nbsp;";
}
$text .= "<table width='".$conf['listwidth']."' border='0' cellpadding='0' cellspacing='0' class='fborder'><tr><td>";

$gmembers = $sql->db_Count("clan_members_info");

if($gmembers == 0){
	$text .=  "<tr><td class='forumheader3' style='text-align:center;'><br />"._NOMEMBERS."<br /><br /></td></tr>\n";
}else{

	$text .=   "<tr class='forumheader3'>";
	$text .=  "<td class='fcaption' style='text-align:".$conf['titlealign'].";'><b>Rank</b></td>";
	$text .=  "<td class='fcaption' style='text-align:".$conf['titlealign'].";'><b>Members</b></td>";
	$text .=   "</tr>";

	$orderby = str_replace(array("Username|ASC","Username|DESC","Activity|ASC","Activity|DESC","-","Rank|"),"", $conf['memberorder']);
	$sql->db_Select("clan_members_ranks", "*", "ORDER BY rank $orderby", "");
		
	$sql1 = new db;
	while($row = $sql->db_Fetch()){
		$rid = $row['rid'];
		$rank = $row['rank'];
		$rimage = $row['rimage'];
		
		if($conf['rankpergame']){
			$sql1->db_Select_gen("SELECT u.user_name FROM #user u, #clan_members_".strtolower(substr($conf['gamesorteams'], 0, 4))."link l WHERE l.userid=u.user_id and l.rank=$rid ORDER BY u.user_name");
		}else{
			$sql1->db_Select_gen("SELECT u.user_name FROM #user u, #clan_members_info l WHERE l.userid=u.user_id and l.rank=$rid ORDER BY u.user_name");
		}
		$t = 0;
		$mbrs = "";
		while($row2 = $sql1->db_Fetch()){
			$username = $row2['user_name'];
			$t++;
			if($t > 1) $mbrs .= "</tr><tr>";
			$mbrs .=  "<td class='forumheader3' style='text-align: left' nowrap>$username</td>\n";
		}
		
		if($t > 0){
			$text .=   "<tr>";
			$text .=   "<td class='forumheader3' width='40%' rowspan='$t' style='text-align: center;vertical-align:top' nowrap><b>$rank</b>";
			if(VisibleInfo("Rank Image") && file_exists("images/Ranks/$rimage")) $text .=   "<br /><br /><img src='images/Ranks/$rimage' border='0' alt='$rank' title='$rank' />";
			$text .=   "</td>\n";
			$text .= $mbrs;
			$text .=   "</tr>";
		}
	}	
	

}
	
	
	$text .=  "</table></div></center>\n";

$ns->tablerender(_CONTACTLIST, $text);


?>