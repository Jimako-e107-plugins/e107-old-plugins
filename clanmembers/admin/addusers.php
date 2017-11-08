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
	
$members = $_POST['members'];
$games = $_POST['games'];
$teams = $_POST['teams'];
$rank = $_POST['rank'];

for($i=0;$i<count($members);$i++){
	if($members[$i] != ""){
		//Add to info table
		if($sql->db_Count("clan_members_info", "(*)", "userid='".$members[$i]."'") == 0){
			$sql->db_Insert("clan_members_info", array("userid" => $members[$i], "rank" => $rank, "country"=> "Unknown"));
		}
		
		//Add games
		for($j=0;$j<count($games);$j++){
			if($games[$j] != ""){
				if($sql->db_Count("clan_members_gamelink", "(*)", "userid='$members[$i]' and gid='$games[$j]'") == 0){
					$sql->db_Insert("clan_members_gamelink", array("id" => "NULL", "gid" => $games[$j], "userid"=>$members[$i], "rank" => $rank));
				}
			}
		}
		//Add teams
		for($j=0;$j<count($teams);$j++){
			if($teams[$j] != ""){
				if($sql->db_Count("clan_members_teamlink", "(*)", "userid='$members[$i]' and tid='$teams[$j]'") == 0){
					$sql->db_Insert("clan_members_teamlink", array("id" => "NULL", "tid" => $teams[$j], "userid"=>$members[$i], "rank" => $rank));
				}
			}
		}
	}
}
		
	$ns->tablerender("","<center>"._USERSADDED."</center>");
	header("refresh:1;url=admin.php");

?>