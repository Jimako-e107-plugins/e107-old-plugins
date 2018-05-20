<?php
/**
* MatchProcess.php
* Quick match report process
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN.'ebattles/include/main.php');
require_once(e_PLUGIN.'ebattles/include/match.php');
require_once(e_PLUGIN.'ebattles/include/event.php');

if(isset($_POST['qrsubmitloss']))
{
	$event_id = $_POST['eventid'];
	$reported_by = $_POST['reported_by'];
	$pwinnerID = $_POST['Player'];

	$event = new Event($event_id);

	// Attention here, we use user_id, so there has to be 1 user for 1 player
	$plooserUser = $reported_by;
	$q = "SELECT *"
	." FROM ".TBL_PLAYERS
	." WHERE (Event = '$event_id')"
	."   AND (User = '$plooserUser')";
	$result = $sql->db_Query($q);
	$row = mysql_fetch_array($result);
	$plooserID = $row['PlayerID'];

	// Create Match ------------------------------------------
	$comments = '';
	$q =
	"INSERT INTO ".TBL_MATCHS."(Event,ReportedBy,TimeReported, Comments, Status)
	VALUES ($event_id,'$reported_by',$time, '$comments', 'pending')";
	$result = $sql->db_Query($q);

	$last_id = mysql_insert_id();
	$match_id = $last_id;
	$match = new Match($match_id);

	// Create Scores ------------------------------------------
	$q =
	"INSERT INTO ".TBL_SCORES."(MatchID,Player,Player_MatchTeam,Player_Rank)
	VALUES ($match_id,$pwinnerID,1,1)
	";
	$result = $sql->db_Query($q);

	$q =
	"INSERT INTO ".TBL_SCORES."(MatchID,Player,Player_MatchTeam,Player_Rank)
	VALUES ($match_id,$plooserID,2,2)
	";
	$result = $sql->db_Query($q);

	// Update scores stats
	$match->match_scores_update();

	// Automatically Update Players stats only if Match Approval is Disabled
	if ($event->getField('MatchesApproval') == eb_UC_NONE)
	{
		switch($event->getMatchPlayersType())
		{
		case 'Players':
			$match->match_players_update();
			break;
		case 'Teams':
			$match->match_teams_update();
			break;
		default:
		}
		if($event->getField('FixturesEnable') == TRUE)
		{
			$event->brackets(true);
		}

	}
	$event->setFieldDB('IsChanged', 1);

	header("Location: matchinfo.php?matchid=$match_id");
	exit;
}
if (isset($_POST['approvematch']))
{
	$event_id = $_POST['eventid'];
	$match_id = $_POST['matchid'];

	$event = new Event($event_id);
	$match = new Match($match_id);

	switch($event->getMatchPlayersType())
	{
	case 'Players':
		$match->match_players_update();
		break;
	case 'Teams':
		$match->match_teams_update();
		break;
	default:
	}
	if($event->getField('FixturesEnable') == TRUE)
	{
		$event->brackets(true);
	}
	$event->setFieldDB('IsChanged', 1);

	header("Location: eventinfo.php?eventid=$event_id");
	exit;
}
if (isset($_POST['addmedia']))
{
	$event_id = $_POST['eventid'];
	$match_id = $_POST['matchid'];
	$match = new Match($match_id);
	$media_type = $_POST['mediatype'];
	$media_path = $_POST['mediapath'];
	$submitter = USERID;

	if (preg_match("/http:\/\//", $media_path))
	{
		$match->add_media($submitter, $media_path, $media_type);
	}

	header("Location: matchinfo.php?matchid=$match_id");
	exit;
}
if (isset($_POST['del_media']) && $_POST['del_media']!="")
{
	$match_id = $_POST['matchid'];
	$media = $_POST['del_media'];

	delete_media($media);

	header("Location: matchinfo.php?matchid=$match_id");
	exit;
}

// should not be here -> redirect
header("Location: events.php");

?>
