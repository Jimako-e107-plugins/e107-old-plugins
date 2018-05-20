<?php
/**
*ClanProcess.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN.'ebattles/include/clan.php');
require_once(e_PLUGIN.'ebattles/include/gamer.php');

/*******************************************************************
********************************************************************/

$clan_id = intval($_GET['clanid']);
$action = eb_sanitize($_GET['actionid']);
$clan = new Clan($clan_id);

$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if (USERID==$clan->getField('Owner')) $can_manage = 1;
if(($action=='create')&&(check_class($pref['eb_teams_create_class']))) $can_manage = 1;

if ($can_manage == 0)
{
	header("Location: ./claninfo.php?clanid=$clan_id");
	exit();
}

if(isset($_POST['clandelete']))
{
	$q_ClanScores = "SELECT ".TBL_DIVISIONS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_PLAYERS.".*, "
	.TBL_SCORES.".*"
	." FROM ".TBL_DIVISIONS.", "
	.TBL_TEAMS.", "
	.TBL_PLAYERS.", "
	.TBL_SCORES
	." WHERE (".TBL_DIVISIONS.".Clan = '$clan_id')"
	." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
	." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
	$result_ClanScores = $sql->db_Query($q_ClanScores);
	$numClanScores = mysql_numrows($result_ClanScores);
	if ($numClanScores == 0)
	{
		// Delete players, teams, members, divisions and clan
		$q_ClanDivs = "SELECT ".TBL_DIVISIONS.".*"
		." FROM ".TBL_DIVISIONS
		." WHERE (".TBL_DIVISIONS.".Clan = '$clan_id')";
		$result_ClanDivs = $sql->db_Query($q_ClanDivs);
		$numClanDivs = mysql_numrows($result_ClanDivs);
		for ($i = 0; $i < $numClanDivs; $i ++)
		{
			$div_id = mysql_result($result_ClanDivs, $i, TBL_DIVISIONS.".DivisionID");
			$division = new Division($div_id);
			$division->deleteDivPlayers();
			$division->deleteDivTeams();
			$division->deleteDivMembers();
			$division->deleteDiv();
		}
		$clan->deleteClan();
	}
	//echo "-- clandelete --<br />";
	header("Location: clans.php");
	exit();
}
if(isset($_POST['clandeletediv']))
{
	$div_id = $_POST['clandiv'];
	$division = new Division($div_id);
	
	$q_DivScores = "SELECT ".TBL_DIVISIONS.".*, "
	.TBL_TEAMS.".*, "
	.TBL_PLAYERS.".*, "
	.TBL_SCORES.".*"
	." FROM ".TBL_DIVISIONS.", "
	.TBL_TEAMS.", "
	.TBL_PLAYERS.", "
	.TBL_SCORES
	." WHERE (".TBL_DIVISIONS.".DivisionID = '$div_id')"
	." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
	." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
	." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
	$result_DivScores = $sql->db_Query($q_DivScores);
	$numDivScores = mysql_numrows($result_DivScores);
	if ($numDivScores == 0)
	{
		// Delete players, teams, members and divison
		$division->deleteDivPlayers();
		$division->deleteDivTeams();
		$division->deleteDivMembers();
		$division->deleteDiv();
	}
	//echo "-- clandeletediv --<br />";
	header("Location: clanmanage.php?clanid=$clan_id");
	exit();
}
if(isset($_POST['clanadddiv']))
{
	$clan_owner = $tp->toDB($_POST['clanowner']);
	$div_game = $_POST['divgame'];
	
	$q = "SELECT ".TBL_DIVISIONS.".*"
	." FROM ".TBL_DIVISIONS
	." WHERE (".TBL_DIVISIONS.".Clan = '$clan_id')"
	."   AND (".TBL_DIVISIONS.".Game  = '$div_game')";
	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);
	if ($num_rows==0)
	{
		$q = "INSERT INTO ".TBL_DIVISIONS."(Clan,Game,Captain)"
		." VALUES ('$clan_id','$div_game','$clan_owner')";
		$result = $sql->db_Query($q);

		$last_id = mysql_insert_id();
		$division = new Division($last_id);

		// Automatically add the clan owner to that divison
		$division->addMember($clan_owner, FALSE);
	}
	//echo "-- clanadddiv --<br />";
	header("Location: clanmanage.php?clanid=$clan_id&gameid=$divgame");
	exit();
}

if(isset($_POST['clansettingssave']))
{
	/* Clan Name */
	$clan->setField('Name', $_POST['clanname']);

	/* Clan Avatar */
	$new_clanavatar = htmlspecialchars($_POST['clanavatar']);
	if ($new_clanavatar != '')
	{
		$clan->setField('Image', $new_clanavatar);
	}
	/* Clan Tag */
	$new_clantag = htmlspecialchars($_POST['clantag']);
	if ($new_clantag != '')
	{
		$clan->setField('Tag', $new_clantag);
	}
	/* Clan Password */
	$clan->setField('password', $_POST['clanpassword']);

	/* Clan Website */
	$clan->setField('websiteURL', $_POST['clanwebsite']);

	/* Clan Email */
	$clan->setField('email', $_POST['clanemail']);

	/* Clan IM */
	$clan->setField('IM', $_POST['clanIM']);

	/* Clan Description */
	$clan->setField('Description', $_POST['clandescription']);

	if ($clan_id) {
		// Need to update the event in database
		$clan->updateDB();

	} else {
		// Need to create a clan.
		$clan->setField('Owner', USERID);
		$clan_id = $clan->insert();
	}

	//echo "-- clansettingssave --<br />";
	header("Location: clanmanage.php?clanid=$clan_id");
	exit();
}
if(isset($_POST['clanchangeowner']))
{
	/* Clan Owner */
	$clan->setFieldDB('Owner', $_POST['clanowner']);

	//echo "-- clanchangeowner --<br />";
	header("Location: clanmanage.php?clanid=$clan_id");
	exit();
}
if(isset($_POST['clanchangedivcaptain']))
{
	$clan_div = $_POST['clandiv'];
	$div_captain = $tp->toDB($_POST['divcaptain']);
	$division = new Division($clan_div);
	$game_id = $division->getField('Game');

	/* Division Captain */
	$q2 = "UPDATE ".TBL_DIVISIONS." SET Captain = '$div_captain' WHERE (DivisionID = '$clan_div')";
	$result2 = $sql->db_Query($q2);

	//echo "-- clanchangedivcaptain --<br />";
	header("Location: clanmanage.php?clanid=$clan_id&gameid=$game_id");
	exit();
}

if (isset($_POST['kick']))
{
	//fm: Not good
	// We can not delete members w/o deleting the corresponding players.
	// And we can delete players only if they have not scored yet.
	// Therefore, we can only delete members if they have not played in a match yet.
	$clan_div = $_POST['clandiv'];
	$division = new Division($clan_div);
	$game_id = $division->getField('Game');

	if (count($_POST['del']) > 0)
	{
		$del_ids = $_POST['del'];

		for($i=0;$i<count($del_ids);$i++)
		{
			$q2 = "DELETE FROM ".TBL_MEMBERS
			." WHERE (".TBL_MEMBERS.".MemberID = '$del_ids[$i]')";
			$result2 = $sql->db_Query($q2);
		}
	}
	//echo "-- kick --<br />";
	header("Location: clanmanage.php?clanid=$clan_id&gameid=$game_id");
	exit();
}

if(isset($_POST['claninviteuser']))
{
	$user = $_POST['user'];
	$clan_div = $_POST['clandiv'];
	$division = new Division($clan_div);
	$game_id = $division->getField('Game');
	
	$division->addMember($user, TRUE);

	//echo "-- claninviteuser --<br />";
	header("Location: clanmanage.php?clanid=$clan_id&gameid=$game_id");
	exit();
}

header("Location: clanmanage.php?clanid=$clan_id");
exit;

?>
