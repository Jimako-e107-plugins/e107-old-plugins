<?php
/**
* ChallengeRequest.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN.'ebattles/include/main.php');
require_once(e_PLUGIN.'ebattles/include/match.php');
require_once(e_PLUGIN."ebattles/include/event.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
require_once(e_PLUGIN."ebattles/include/challenge.php");

/*******************************************************************
********************************************************************/
// Specify if we use WYSIWYG for text areas
global $e_wysiwyg;
$e_wysiwyg = "challenge_comments";  // set $e_wysiwyg before including HEADERF
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

if (e_WYSIWYG)
{
	$insertjs = "rows='15'";
}
else
{
	require_once(e_HANDLER."ren_help.php");
	$insertjs = "rows='5' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
}

$text .= "
<script type='text/javascript'>
<!--//
// Forms
$(function() {
$('.timepicker').datetimepicker({
ampm: true,
timeFormat: 'hh:mm TT',
stepHour: 1,
stepMinute: 10,
minDate: 0
});
});
//-->
</script>
";

$text .= '
<script type="text/javascript">
<!--//
function clearDate(frm, index)
{
document.getElementById("f_date"+index).value = ""
}
//-->
</script>
';
/* Event Name */
$event_id = intval($_GET['eventid']);
if(!$event_id)
{
	$text .= '<br />'.EB_ERROR.'<br />';
	$ns->tablerender(EB_CHALLENGE_L1, $text);
	require_once(FOOTERF);
	exit;
}

$event = new Event($event_id);

if(isset($_POST['challenged_player_choice']) && $_POST['challenged_player_choice']!="")
{
	$challenger = $_POST['submitted_by'];
	$challenged = $_POST['challenged_player_choice'];

	$text .= PlayerChallengeForm($event_id, $challenger, $challenged);
}
if(isset($_POST['challenge_player']))
{
	$challenger = $_POST['submitted_by'];
	$challenged = $_POST['Challenged'];
	
	$text .= PlayerChallengeForm($event_id, $challenger, $challenged);
}
if(isset($_POST['challenge_player_submit']))
{
	$challenger = $_POST['submitted_by'];
	$challenged = $_POST['Challenged'];

	// Verify form
	$error_str = '';

	for($date=1; $date <= $event->getField('MaxDatesPerChallenge'); $date++)
	{
		if ($_POST['date'.$date] == '')
		{
			$error_str .= '<li>'.EB_CHALLENGE_L10.'&nbsp;'.$date.'&nbsp;'.EB_CHALLENGE_L11.'</li>';
		}
	}

	if (!empty($error_str)) {
		// show form again
		$text .= PlayerChallengeForm($event_id, $challenger, $challenged);

		// errors have occured, halt execution and show form again.
		$text .= '<div class="eb_errors">'.EB_MATCHR_L14;
		$text .= '<ul>'.$error_str.'</ul></div>';
	}
	else
	{
		SubmitPlayerChallenge($event_id, $challenger, $challenged, $event->getField('MaxDatesPerChallenge'));
		$text .= EB_CHALLENGE_L12;
		$text .= '<br />';
		$text .= '<br />'.EB_CHALLENGE_L13.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.EB_CHALLENGE_L14.'</a>]<br />';
	}
}
if(isset($_POST['challenged_team_choice']) && $_POST['challenged_team_choice']!="")
{
	$challenger = $_POST['submitted_by'];
	$challenged = $_POST['challenged_team_choice'];

	$text .= TeamChallengeForm($event_id, $challenger, $challenged);
}
if(isset($_POST['challenge_team']))
{
	$challenger = $_POST['submitted_by'];
	$challenged = $_POST['Challenged'];

	$text .= TeamChallengeForm($event_id, $challenger, $challenged);
}
if(isset($_POST['challenge_team_submit']))
{
	$challenger = $_POST['submitted_by'];
	$challenged = $_POST['Challenged'];

	// Verify form
	$error_str = '';

	for($date=1; $date <= $event->getField('MaxDatesPerChallenge'); $date++)
	{
		if ($_POST['date'.$date] == '')
		{
			$error_str .= '<li>'.EB_CHALLENGE_L10.'&nbsp;'.$date.'&nbsp;'.EB_CHALLENGE_L11.'</li>';
		}
	}

	if (!empty($error_str)) {
		// show form again
		$text .= TeamChallengeForm($event_id, $challenger, $challenged);

		// errors have occured, halt execution and show form again.
		$text .= '<div class="eb_errors">'.EB_MATCHR_L14;
		$text .= '<ul>'.$error_str.'</ul></div>';
	}
	else
	{
		SubmitTeamChallenge($event_id, $challenger, $challenged, $event->getField('MaxDatesPerChallenge'));
		$text .= EB_CHALLENGE_L12;
		$text .= '<br />';
		$text .= '<br />'.EB_CHALLENGE_L13.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.EB_CHALLENGE_L14.'</a>]<br />';
	}
}
$ns->tablerender($event->getField('Name')." (".$event->eventTypeToString().") - ".EB_CHALLENGE_L1, $text);
require_once(FOOTERF);
exit;

//=================================================================================
// Functions
//=================================================================================
function PlayerChallengeForm($event_id, $challengerpuid, $challengedpid)
{
	global $sql;
	global $tp;
	global $time;
	
	//$output .= "$event_id, $challengerpuid, $challengedpid".'<br />';
	$event = new Event($event_id);

	$output .= '<form action="'.e_PLUGIN.'ebattles/challengerequest.php?eventid='.$event_id.'" method="post">';

	$output .= '<b>'.EB_CHALLENGE_L2.'</b><br />';
	$output .= '<br />';
	// Challenger Info
	// Attention here, we use user_id, so there has to be 1 user for 1 player
	$output .= '<b>'.EB_CHALLENGE_L5.'</b>'; // Challenger
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_GAMERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	."   AND (".TBL_USERS.".user_id = '$challengerpuid')";
	$result = $sql->db_Query($q);

	$pid    = mysql_result($result,0 , TBL_PLAYERS.".PlayerID");
	$puid   = mysql_result($result,0 , TBL_USERS.".user_id");
	$prank  = mysql_result($result,0 , TBL_PLAYERS.".Rank");
	$pname  = mysql_result($result,0 , TBL_GAMERS.".Name");
	$pteam  = mysql_result($result,0 , TBL_PLAYERS.".Team");
	list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);

	if ($prank==0)
	$prank_txt = EB_EVENT_L54;
	else
	$prank_txt = "#$prank";
	$str = $pclantag.$pname.' ('.$prank_txt.')';
	$output .= ' '.$str.'<br />';

	// Challenged Info
	$output .= '<b>'.EB_CHALLENGE_L6.'</b>'; // Challenged
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_GAMERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	."   AND (".TBL_PLAYERS.".PlayerID = '$challengedpid')";
	$result = $sql->db_Query($q);

	$pid    = mysql_result($result, 0, TBL_PLAYERS.".PlayerID");
	$puid   = mysql_result($result, 0, TBL_USERS.".user_id");
	$prank  = mysql_result($result, 0, TBL_PLAYERS.".Rank");
	$pname  = mysql_result($result, 0, TBL_GAMERS.".Name");
	$pteam  = mysql_result($result, 0, TBL_PLAYERS.".Team");
	list($pclan, $pclantag, $pclanid) = getClanInfo($pteam);

	if ($prank==0)
	$prank_txt = EB_EVENT_L54;
	else
	$prank_txt = "#$prank";
	$str = $pclantag.$pname.' ('.$prank_txt.')';
	$output .= ' '.$str.'<br />';

	$output .= '<br />';

	// Select Dates
	$output .= '<b>'.EB_CHALLENGE_L7.'</b><br />'; // Select Dates
	$output .= '<table class="table_left">';
	for($date=1; $date <= $event->getField('MaxDatesPerChallenge'); $date++)
	{
		//<!-- Select date Date -->
		$output .= '
		<tr>
		<td><b>'.EB_CHALLENGE_L10.' #'.$date.'</b></td>
		<td>
		<table>
		<tr>
		<td>
		<div><input class="tbox timepicker" type="text" name="date'.$date.'" id="f_date'.$date.'" value="'.$_POST['date'.$date].'" readonly="readonly" /></div>
		</td>
		<td>
		<div><input class="eb_button" type="button" value="'.EB_EVENTM_L34.'" onclick="clearDate(this.form, '.$date.');"/></div>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		';
	}
	$output .= '</table>';

	// comments
	//----------------------------------
	if(isset($_POST['challenge_comments']))
	{
		$comments = $tp->toDB($_POST['challenge_comments']);
	} else {
		$comments = '';
	}
	$output .= '<br />';
	$output .= '<div>';
	$output .= EB_CHALLENGE_L8.'<br />';
	$output .= '<textarea class="tbox" id="challenge_comments" name="challenge_comments" style="width:500px" cols="70" '.$insertjs.'>'.$comments.'</textarea>';
	if (!e_WYSIWYG)
	{
		$output .= '<br />'.display_help("helpb","comments");
	}
	$output .= '</div>';

	$output .= '<br />';

	$output .= '<div>';
	$output .= '<input type="hidden" name="submitted_by" value="'.$challengerpuid.'"/>';
	$output .= '<input type="hidden" name="Challenged" value="'.$challengedpid.'"/>';

	$output .= '
	</div>
	<div>
	'.ebImageTextButton('challenge_player_submit', 'challenge.png', EB_CHALLENGE_L9).'
	</div>
	</form>
	';

	return $output;
}

function SubmitPlayerChallenge($event_id, $challengerpuid, $challengedpid)
{
	global $sql;
	global $text;
	global $tp;
	global $time;
	global $pref;

	$event = new Event($event_id);

	// Challenger Info
	// Attention here, we use user_id, so there has to be 1 user for 1 player
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	."   AND (".TBL_USERS.".user_id = '$challengerpuid')";
	$result = $sql->db_Query($q);
	$challengerpid   = mysql_result($result, 0,TBL_PLAYERS.".PlayerID");
	// $challengerpuid   = mysql_result($result, 0, TBL_USERS.".user_id");
	$challengerpname  = mysql_result($result, 0, TBL_USERS.".user_name");
	$challengerpemail  = mysql_result($result, 0, TBL_USERS.".user_email");


	// Challenged Info
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	."   AND (".TBL_PLAYERS.".PlayerID = '$challengedpid')";
	$result = $sql->db_Query($q);

	// $challengedpid    = mysql_result($result, 0, TBL_PLAYERS.".PlayerID");
	$challengedpuid   = mysql_result($result, 0, TBL_USERS.".user_id");
	$challengedpname  = mysql_result($result, 0, TBL_USERS.".user_name");
	$challengedpemail  = mysql_result($result, 0, TBL_USERS.".user_email");

	$challenge_times = '';
	for($date=1; $date <= $event->getField('MaxDatesPerChallenge'); $date++)
	{
		$challenge_date = $_POST['date'.$date];
		$challenge_time_local = strtotime($challenge_date);
		$challenge_time_local = $challenge_time_local - TIMEOFFSET;	// Convert to GMT time
		if ($date > 1) $challenge_times .= ',';
		$challenge_times .= $challenge_time_local;
	}

	// comments
	//----------------------------------
	$comments = $tp->toDB($_POST['challenge_comments']);
	$time_reported = $time;

	// Create Challenge ------------------------------------------
	$q =
	"INSERT INTO ".TBL_CHALLENGES."(Event,ChallengerPlayer,ChallengedPlayer,ReportedBy,TimeReported,Comments,Status,MatchDates)
	VALUES (
	'$event_id',
	'$challengerpid',
	'$challengedpid',
	'$challengerpuid',
	'$time_reported',
	'$comments',
	'requested',
	'$challenge_times'
	)";
	$result = $sql->db_Query($q);

	$subject = SITENAME." ".EB_CHALLENGE_L23;
	$message = EB_CHALLENGE_L24.$challengedpname.EB_CHALLENGE_L25.$challengerpname.EB_CHALLENGE_L26.$event->getField('Name').EB_CHALLENGE_L27;
	if (check_class($pref['eb_pm_notifications_class']))
	{
		// Send PM
		$sendto = $challengedpuid;
		$fromid = 0;
		sendNotification($sendto, $subject, $message, $fromid);
	}

	if (check_class($pref['eb_email_notifications_class']))
	{
		// Send email
		require_once(e_HANDLER."mail.php");
		sendemail($challengedpemail, $subject, $message);
	}
}

function TeamChallengeForm($event_id, $challengerpuid, $challengedtid)
{
	global $sql;
	global $tp;
	global $time;

	$event = new Event($event_id);

	$output .= '<form action="'.e_PLUGIN.'ebattles/challengerequest.php?eventid='.$event_id.'" method="post">';

	$output .= '<b>'.EB_CHALLENGE_L3.'</b><br />';
	$output .= '<br />';
	// Challenger Info
	// Attention here, we use user_id, so there has to be 1 user for 1 player
	$output .= '<b>'.EB_CHALLENGE_L5.'</b>'; // Challenger
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_USERS.".*, "
	.TBL_TEAMS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS.", "
	.TBL_TEAMS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_TEAMS.".TeamID = ".TBL_PLAYERS.".Team)"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	."   AND (".TBL_USERS.".user_id = '$challengerpuid')";
	$result = $sql->db_Query($q);

	$uteam  = mysql_result($result,0 , TBL_PLAYERS.".Team");
	$trank  = mysql_result($result,0 , TBL_TEAMS.".Rank");
	list($tclan, $tclantag, $tclanid) = getClanInfo($uteam);

	if ($trank==0)
	$trank_txt = EB_EVENT_L54;
	else
	$trank_txt = "#$trank";
	$str = $tclan.' ('.$trank_txt.')';
	$output .= ' '.$str.'<br />';

	// Challenged Info
	$output .= '<b>'.EB_CHALLENGE_L6.'</b>'; // Challenged

	$q = "SELECT ".TBL_TEAMS.".*"
	." FROM ".TBL_TEAMS
	." WHERE (".TBL_TEAMS.".TeamID = '$challengedtid')";
	$result = $sql->db_Query($q);
	$uteam  = mysql_result($result,0 , TBL_TEAMS.".TeamID");
	$trank  = mysql_result($result, 0, TBL_TEAMS.".Rank");
	list($tclan, $tclantag, $tclanid) = getClanInfo($uteam);

	if ($trank==0)
	$trank_txt = EB_EVENT_L54;
	else
	$trank_txt = "#$trank";
	$str = $tclan.' ('.$trank_txt.')';
	$output .= ' '.$str.'<br />';

	$output .= '<br />';

	// Select Dates
	$output .= '<b>'.EB_CHALLENGE_L7.'</b><br />'; // Select Dates
	$output .= '<table class="table_left">';
	for($date=1; $date <= $event->getField('MaxDatesPerChallenge'); $date++)
	{
		//<!-- Select date Date -->
		$output .= '
		<tr>
		<td><b>'.EB_CHALLENGE_L10.' #'.$date.'</b></td>
		<td>
		<table>
		<tr>
		<td>
		<div><input class="tbox timepicker" type="text" name="date'.$date.'" id="f_date'.$date.'" value="'.$_POST['date'.$date].'" readonly="readonly" /></div>
		</td>
		<td>
		<div><input class="eb_button" type="button" value="'.EB_EVENTM_L34.'" onclick="clearDate(this.form, '.$date.');"/></div>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		';
	}
	$output .= '</table>';

	// comments
	//----------------------------------
	if(isset($_POST['challenge_comments']))
	{
		$comments = $tp->toDB($_POST['challenge_comments']);
	} else {
		$comments = '';
	}
	$output .= '<br />';
	$output .= '<div>';
	$output .= EB_CHALLENGE_L8.'<br />';
	$output .= '<textarea class="tbox" id="challenge_comments" name="challenge_comments" style="width:500px" cols="70" '.$insertjs.'>'.$comments.'</textarea>';
	if (!e_WYSIWYG)
	{
		$output .= '<br />'.display_help("helpb","comments");
	}
	$output .= '</div>';

	$output .= '<br />';

	$output .= '<div>';
	$output .= '<input type="hidden" name="submitted_by" value="'.$challengerpuid.'"/>';
	$output .= '<input type="hidden" name="Challenged" value="'.$challengedtid.'"/>';

	$output .= '
	</div>
	<div>
	'.ebImageTextButton('challenge_team_submit', 'challenge.png', EB_CHALLENGE_L9).'
	</div>
	</form>
	';

	return $output;
}

function SubmitTeamChallenge($event_id, $challengerpuid, $challengedtid)
{
	global $sql;
	global $text;
	global $tp;
	global $time;
	global $pref;

	$event = new Event($event_id);

	// Challenger Info
	// Attention here, we use user_id, so there has to be 1 user for 1 player
	$q = "SELECT ".TBL_PLAYERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_GAMERS.", "
	.TBL_USERS
	." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
	."   AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
	."   AND (".TBL_USERS.".user_id = ".TBL_GAMERS.".User)"
	."   AND (".TBL_USERS.".user_id = '$challengerpuid')";
	$result = $sql->db_Query($q);
	$challengerpid   = mysql_result($result, 0,TBL_PLAYERS.".PlayerID");
	$challengertid   =mysql_result($result, 0,TBL_PLAYERS.".Team");
	list($challengertclan, $challengertclantag, $challengertclanid) = getClanInfo($challengertid);

	// Challenged Info
	// Nothing needed here
	// ...

	$challenge_times = '';
	for($date=1; $date <= $event->getField('MaxDatesPerChallenge'); $date++)
	{
		$challenge_date = $_POST['date'.$date];
		$challenge_time_local = strtotime($challenge_date);
		$challenge_time_local = $challenge_time_local - TIMEOFFSET;	// Convert to GMT time
		if ($date > 1) $challenge_times .= ',';
		$challenge_times .= $challenge_time_local;
	}

	// comments
	//----------------------------------
	$comments = $tp->toDB($_POST['challenge_comments']);
	$time_reported = $time;

	// Create Challenge ------------------------------------------
	$q =
	"INSERT INTO ".TBL_CHALLENGES."(Event,ChallengerTeam,ChallengedTeam,ReportedBy,TimeReported,Comments,Status,MatchDates)
	VALUES (
	'$event_id',
	'$challengertid',
	'$challengedtid',
	'$challengerpuid',
	'$time_reported',
	'$comments',
	'requested',
	'$challenge_times'
	)";
	$result = $sql->db_Query($q);

	// Send PM
	$fromid = 0;
	$subject = SITENAME." ".EB_CHALLENGE_L23;

	// All members of the challenged division will receive the PM
	$q = "SELECT ".TBL_TEAMS.".*, "
	.TBL_MEMBERS.".*, "
	.TBL_USERS.".*"
	." FROM ".TBL_TEAMS.", "
	.TBL_USERS.", "
	.TBL_MEMBERS
	." WHERE (".TBL_TEAMS.".TeamID = '$challengedtid')"
	." AND (".TBL_MEMBERS.".Division = ".TBL_TEAMS.".Division)"
	." AND (".TBL_USERS.".user_id = ".TBL_MEMBERS.".User)";
	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);
	if($num_rows > 0)
	{
		for($j=0; $j < $num_rows; $j++)
		{
			$challengedpname = mysql_result($result, $j, TBL_USERS.".user_name");
			$challengedpemail = mysql_result($result, $j, TBL_USERS.".user_email");
			$message = EB_CHALLENGE_L24.$challengedpname.EB_CHALLENGE_L25.$challengertclan.EB_CHALLENGE_L26.$event->getField('Name').EB_CHALLENGE_L27;
			if (check_class($pref['eb_pm_notifications_class']))
			{
				$sendto = mysql_result($result, $j, TBL_USERS.".user_id");
				sendNotification($sendto, $subject, $message, $fromid);
			}
			if (check_class($pref['eb_email_notifications_class']))
			{
				// Send email
				require_once(e_HANDLER."mail.php");
				sendemail($challengedpemail, $subject, $message);
			}
		}
	}
}
?>



