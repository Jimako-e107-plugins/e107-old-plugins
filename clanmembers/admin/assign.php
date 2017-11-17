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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$type = $_GET['type'];
$cmnames = $_POST['cmnames'];

if($type == "Awards"){
	//Awards
	$cmawards = $_POST['cmawards'];
	for($i=0;$i<count($cmawards);$i++){
	if($cmawards[$i] != ""){
		for($j=0;$j<count($cmnames);$j++){
		if($cmnames[$j] != ""){
			if($sql->db_Count("clan_members_awardlink", "(*)", "WHERE userid='$cmnames[$j]' and award='$cmawards[$i]'") == 0){
				$sql->db_Insert("clan_members_awardlink", array("userid" => $cmnames[$j], "award" => $cmawards[$i], "awardtime" => time()));
			}
		}
		}
	}
	}
	
	$text = _MEMBERSRECAWARDS;
	header("refresh:1;url=admin.php?awards");

}elseif($type == "Ranks"){
	//Ranks
	$rank = $_POST['rank'];
	for($j=0;$j<count($cmnames);$j++){
		if($cmnames[$j] != ""){
			$sql->db_Update("clan_members_info", "rank='$rank' WHERE userid='".$cmnames[$j]."'");
			$sql->db_Update("clan_members_gamelink", "rank='$rank' WHERE userid='".$cmnames[$j]."'");
			$sql->db_Update("clan_members_teamlink", "rank='$rank' WHERE userid='".$cmnames[$j]."'");
		}
	}


	$text = _RANKOFMEMHBCHANGED;
	header("refresh:1;url=admin.php?ranks");
	
}elseif($type == "Games"){
	//Games
	$games = $_POST['games'];
	for($i=0;$i<count($games);$i++){
	if($games[$i] != ""){
		for($j=0;$j<count($cmnames);$j++){
		if($cmnames[$j] != ""){
			if($sql->db_Count("clan_members_gamelink", "(*)", "WHERE userid='$cmnames[$j]' and gid='$games[$i]'") == 0){
				$sql->db_Select("clan_members_info", "rank", "userid='$cmnames[$j]'");
				$row = $sql->db_Fetch();				
				$sql->db_Insert("clan_members_gamelink", array("gid" => $games[$i], "userid" => $cmnames[$j], "rank" => $row['rank']));
			}
		}
		}
	}
	}
	
	$text = _GAMESASSIGNED;
	header("refresh:1;url=admin.php?games");
}elseif($type == "Teams"){
	//Teams
	$teams = $_POST['teams'];
	for($i=0;$i<count($teams);$i++){
	if($teams[$i] != ""){
		for($j=0;$j<count($cmnames);$j++){
		if($cmnames[$j] != ""){
			if($sql->db_Count("clan_members_teamlink", "(*)", "WHERE userid='$cmnames[$j]' and tid='$teams[$i]'") == 0){
				$sql->db_Select("clan_members_info", "rank", "userid='$cmnames[$j]'");
				$row = $sql->db_Fetch();				
				$sql->db_Insert("clan_members_teamlink", array("tid" => $teams[$i], "userid" => $cmnames[$j], "rank" => $row['rank']));
			}
		}
		}
	}
	}
	
	$text = _TEAMSASSIGNED;
	header("refresh:1;url=admin.php?teams");
}

$ns->tablerender("", "<center>".$text."</center>");

?>