<?php
/**
* EventInfo_process.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN.'ebattles/include/event.php');
require_once(e_PLUGIN.'ebattles/include/gamer.php');

$event_id = intval($_GET['eventid']);
if(!$event_id)
{
	header("Location: ./events.php");
	exit();
}
$event = new Event($event_id);

$error_str = '';

if(isset($_POST['quitevent'])){
	$pid = $_POST['player'];

	// Player can quit an event if he has not played yet
	// TODO - can quit if event not started.
	$q = "SELECT DISTINCT ".TBL_PLAYERS.".*"
	." FROM ".TBL_PLAYERS.", "
	.TBL_SCORES
	." WHERE (".TBL_PLAYERS.".PlayerID = '$pid')"
	." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
	$result = $sql->db_Query($q);
	$nbrscores = mysql_numrows($result);
	if ($nbrscores == 0)
	{
		deletePlayer($pid);
		$event->setFieldDB('IsChanged', 1);
	}
	header("Location: eventinfo.php?eventid=$event_id");
}
if(isset($_POST['checkinevent'])){
	$pid = $_POST['player'];
	checkinPlayer($pid);
	
	if(($event->getField('FixturesEnable') == TRUE)&&($event->getField('Status') == 'active'))
	{
		$event->brackets(true);
	}			
	$event->setFieldDB('IsChanged', 1);
	
	header("Location: eventinfo.php?eventid=$event_id");
}
if(isset($_POST['teamcheckinevent'])){
	$team_id = $_POST['team'];
	checkinTeam($team_id);

	if(($event->getField('FixturesEnable') == TRUE)&&($event->getField('Status') == 'active'))
	{
		$event->brackets(true);
	}			
	$event->setFieldDB('IsChanged', 1);

	header("Location: eventinfo.php?eventid=$event_id");
}
if(isset($_POST['joinevent'])){
	
	if(($event->getField('password') == "") || ($_POST['joinEventPassword'] == $event->getField('password')))
	{
		$Name = $_POST["gamername"];
		$UniqueGameID = $_POST["gameruniquegameid"];
		updateGamer(USERID, $event->getField('Game'), $Name, $UniqueGameID);
		
		// Check gold here.
		if(is_gold_system_active() && ($gold_obj->gold_balance(USERID) < $event->getField('GoldEntryFee'))) {
			$error_str .= EB_EVENT_L98." {$GOLD_PREF['gold_currency_name']}"."</br>";
			$error_str .= EB_EVENT_L99.$gold_obj->formation($gold_obj->gold_balance(USERID))."</br>";
		}
		else
		{
			$event->eventAddPlayer(USERID, 0, FALSE);
			
			if(is_gold_system_active() && ($event->getField('GoldEntryFee')>0)) {
				$gold_param['gold_user_id'] = USERID;
				$gold_param['gold_who_id'] = 0;
				$gold_param['gold_amount'] = $event->getField('GoldEntryFee');
				$gold_param['gold_type'] = EB_L1;
				$gold_param['gold_action'] = "debit";
				$gold_param['gold_plugin'] = "ebattles";
				$gold_param['gold_log'] = EB_GOLD_L7.": event=".$event_id.", user=".USERID;
				$gold_param['gold_forum'] = 0;
				$gold_obj->gold_modify($gold_param);
			}

			header("Location: eventinfo.php?eventid=$event_id");
		}
	}
	else
	{
		$error_str = EB_EVENT_L100;
	}
}
if(isset($_POST['teamjoinevent'])){
	if(($event->getField('password') == "") || ($_POST['joinEventPassword'] == $event->getField('password')))
	{
		$div_id = $_POST['division'];

		// Check gold here.
		if(is_gold_system_active() && ($gold_obj->gold_balance(USERID) < $event->getField('GoldEntryFee'))) {
			$error_str .= EB_EVENT_L98." {$GOLD_PREF['gold_currency_name']}"."</br>";
			$error_str .= EB_EVENT_L99.$gold_obj->formation($gold_obj->gold_balance(USERID))."</br>";
		}
		else
		{
			$event->eventAddDivision($div_id, FALSE);
			
			if(is_gold_system_active() && ($event->getField('GoldEntryFee')>0)) {
				$gold_param['gold_user_id'] = USERID;
				$gold_param['gold_who_id'] = 0;
				$gold_param['gold_amount'] = $event->getField('GoldEntryFee');
				$gold_param['gold_type'] = EB_L1;
				$gold_param['gold_action'] = "debit";
				$gold_param['gold_plugin'] = "ebattles";
				$gold_param['gold_log'] = EB_GOLD_L7.": event=".$event_id.", div=".$div_id;
				$gold_param['gold_forum'] = 0;
				$gold_obj->gold_modify($gold_param);
			}

			header("Location: eventinfo.php?eventid=$event_id");
		}
	}
	else
	{
		$error_str = EB_EVENT_L100;
	}
}
if(isset($_POST['jointeamevent'])){
	$team_id = $_POST['team'];
	$event->eventAddPlayer (USERID, $team_id, FALSE);
	header("Location: eventinfo.php?eventid=$event_id");
}

if(!empty($error_str)) {
	require_once(HEADERF);
	require_once(e_PLUGIN."ebattles/include/ebattles_header.php");
	
	$text = $error_str;
	$text .= '<p>'.EB_EVENT_L101.' [<a href="'.e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id.'">'.$event->getField('Name').'</a>]</p>';

	$ns->tablerender($event->getField('Name')." (".$event->eventTypeToString().")", $text);
	require_once(FOOTERF);
	exit;
}

?>
