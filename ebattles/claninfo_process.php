<?php
/**
* ClanInfo_process.php
*
*/
require_once(e_PLUGIN.'ebattles/include/clan.php');
require_once(e_PLUGIN.'ebattles/include/event.php');

if(isset($_POST['joindivision']))
{
	$div_id = $_POST['division'];
	$division = new Division($div_id);

	$q = "SELECT ".TBL_CLANS.".*, "
	.TBL_DIVISIONS.".*"
	." FROM ".TBL_CLANS.", "
	.TBL_DIVISIONS
	." WHERE (".TBL_DIVISIONS.".DivisionID = '$div_id')"
	." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)";

	$result = $sql->db_Query($q);
	$clan_password  = mysql_result($result, 0, TBL_CLANS.".password");
	$gid  = mysql_result($result, 0, TBL_DIVISIONS.".Game");
	
	if(($clan_password == "") || ($_POST['joindivisionPassword'] == $clan_password))
	{
		$Name = $_POST["gamername"];
		$UniqueGameID = $_POST["gameruniquegameid"];
		$gamerID = updateGamer(USERID, $gid, $Name, $UniqueGameID);
		
		$division->addMember(USERID, FALSE);
	}
}
if(isset($_POST['quitdivision']))
{
	$div_id = $_POST['division'];
	$division = new Division($div_id);

	// Check that the member has made no games with this division
	$q_MemberScores = "SELECT ".TBL_MEMBERS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_PLAYERS.".*, "
	.TBL_SCORES.".*"
	." FROM ".TBL_MEMBERS.", "
	.TBL_TEAMS.", "
	.TBL_PLAYERS.", "
	.TBL_SCORES
	." WHERE (".TBL_MEMBERS.".User = ".USERID.")"
	." AND (".TBL_MEMBERS.".Division = '$div_id')"
	." AND (".TBL_TEAMS.".Division = '$div_id')"
	." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
	." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
	$result_MemberScores = $sql->db_Query($q_MemberScores);
	$numMemberScores = mysql_numrows($result_MemberScores);
	if ($numMemberScores == 0)
	{
		$division->deleteMemberPlayers();
		$division->deleteMember();
	}
}
?>
