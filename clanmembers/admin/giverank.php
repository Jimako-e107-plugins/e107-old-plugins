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

$rank = intval($_POST['rank']);

if($rank == ""){
	header("Location: admin.php?ranks");
}

$text = "";
if($conf['rank_per_game'])
$text = "<br/>"._WILLSETRANKFORALL.($conf['gamesorteams']=="Games"?_INFOGames:_INFOTeams)."!<br /><br />";
$text .= "<form method='post' action='admin.php?assign&type=Ranks'>";	

$text .= "<input type='hidden' name='rank' value='$rank'>";


$result = $sql->db_Select_gen("SELECT u.user_name, i.userid from #clan_members_info i, #user u WHERE u.user_id=i.userid order by u.user_name");
	while($row = $sql->db_Fetch()){
		$memberid = $row['userid'];
		$member = $row['user_name'];
		
		$text .= "<label><input type='checkbox' name='cmnames[]' value='$memberid'> $member</label><br />";
	}

$text .= "<br /><input type='submit' class='button' value='"._GIVERANK."'>
<input type='hidden' name='e-token' value='".e_TOKEN."' />
</form>";

$ns->tablerender(_GIVERANKTO, $text);
			
?>