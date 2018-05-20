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
require_once(HEADERF);

$event_id = intval($_GET['eventid']);
$challenge_id = intval($_GET['challengeid']);
if((!$event_id)||(!$challenge_id))
{
	$text .= '<br />'.EB_ERROR.'<br />';
	$ns->tablerender(EB_CHALLENGE_L1, $text);
	require_once(FOOTERF);
	exit;
}

$event = new Event($event_id);
$challenge = new Challenge($challenge_id);

$text = '';

if(isset($_POST['challenge_withdraw']))
{
	$challenge->deleteChallenge();
	$text .= EB_EVENT_L69;
	$text .= '<br />';
	$text .= '<br />'.EB_CHALLENGE_L13.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.EB_CHALLENGE_L14.'</a>]<br />';
}
if(isset($_POST['challenge_confirm']))
{
	$text .= $challenge->challengeConfirmForm();
}
if(isset($_POST['challenge_accept']))
{
	// Verify form
	$error_str = '';

	if (!empty($error_str)) {
		// show form again
		$text .= $challenge->challengeConfirmForm();

		// errors have occured, halt execution and show form again.
		$text .= '<div class="eb_errors">'.EB_MATCHR_L14;
		$text .= '<ul>'.$error_str.'</ul></div>';
	}
	else
	{
		$challenge->challengeAccept();
		$text .= EB_CHALLENGE_L22;
		$text .= '<br />';
		$text .= '<br />'.EB_CHALLENGE_L13.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.EB_CHALLENGE_L14.'</a>]<br />';
	}
}
if(isset($_POST['challenge_decline']))
{
	$challenge->challengeDecline();
	$text .= EB_EVENT_L69;

	$text .= '<br />';
	$text .= '<br />'.EB_CHALLENGE_L13.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.EB_CHALLENGE_L14.'</a>]<br />';
}

$ns->tablerender($event->getField('Name')." (".$event->eventTypeToString().") - ".EB_CHALLENGE_L1, $text);
require_once(FOOTERF);
exit;

?>



