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
	$list[] = _CONTACT;
	$list[] = "<a href='clanmembers.php?Ranks'>"._INFORanks."</a>";
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

$steam = $sql->db_Count("clan_members_info", "(*)", "WHERE steam!=''");
$xfire = $sql->db_Count("clan_members_info", "(*)", "WHERE xfire!=''");
$realn = $sql->db_Count("clan_members_info", "(*)", "WHERE realname!=''");
$gmembers = $sql->db_Count("clan_members_info");

if($gmembers == 0){
	$text .=  "<tr><td class='forumheader3' style='text-align:center;'><br />"._NOMEMBERS."<br /><br /></td></tr>\n";
}else{

	$text .=   "<tr class='forumheader3'>";
	$showarray = array("Username");
	if($realn && VisibleInfo("Realname")) $showarray[]= "Realname";
	if(VisibleInfo("Country")) $showarray[]= "Country";
	if($xfire && VisibleInfo("Xfire")) $showarray[]= "Xfire";
	if($steam && VisibleInfo("Steam ID")) $showarray[]= "Steam ID";
	foreach($showarray as $infoname){
		if(in_array($infoname, $showarray)){
			$infotitle = $infolang[$infoname];
			$text .=  "<td class='fcaption' style='text-align:".$conf['titlealign'].";'><b>".$infotitle."</b></td>";
		}
	}
	$text .=   "</tr>";

	$sql->db_Select_gen("SELECT i.userid, u.user_name, i.xfire, i.steam, i.realname, i.country 
		FROM #clan_members_info i 
		INNER JOIN #user u ON i.userid=u.user_id 
		ORDER BY u.user_name");
		
	$t = 0;
	while($row2 = $sql->db_Fetch()){
		$memberid = $row2['userid'];
		$member = $row2['user_name'];
		$xfire = $row2['xfire'];
		$steam = $row2['steam'];
		$realname = $row2['realname'];
		$country = $row2['country'];

		if($country == "" or !file_exists(e_IMAGE."clan/flags/$country.png")){
			$country = "Unknown";
		}
				
		
	$text .=   "<tr>";



	foreach($showarray as $infoname){
	
	$newcontent = "";
	$infotitle = $infolang[$infoname];
	
	if(in_array($infoname, $showarray)){
		switch($infoname){
			case "Username":
				$url = "";
				if($conf['enableprofile'] && (USER or $conf['profiletoguests'])){
					$newcontent = "<a href='clanmembers.php?profile&memberid=$memberid' title='View Profile'>$member</a>";
				}else{
					$newcontent = "$member";
				}			
			break;
			case "Realname":
				$newcontent = $realname;			
			break;
			case "Country":
				$newcontent = "<img src='".e_IMAGE."clan/flags/$country.png' border='0' title='$country' align='absmiddle'>";			
			break;
			case "Xfire":
				if($xfire !="")
				$newcontent = "<a href='http://www.xfire.com/profile/$xfire' target='_blank'>$xfire</a>";			
			break;
			case "Steam ID":
				if($steam !="")
				$newcontent = "<a href='http://steamcommunity.com/id/$steam' target='_blank'>$steam</a>";			
			break;
		}
		
		$text .=  "<td class='forumheader3' style='text-align: ".($infoname == "Username"? "left" : "center")."' nowrap>$newcontent</td>\n";
	}
}	
	
	$text .=   "</tr>";

}
	

	}
	
	
	$text .=  "</table></div></center>\n";

$ns->tablerender(_CONTACTLIST, $text);


?>