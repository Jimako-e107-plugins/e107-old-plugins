<?php
/**
* embedded brackets
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/event.php");

/*******************************************************************
********************************************************************/
$text = '';
$text .= '<html>';
$text .= '<head>';
$text .= '<link rel="stylesheet" type="text/css" href="./css/brackets.css" />';
$text .= '</head>';
$text .= '<body>';

$event_id = intval($_GET['eventid']);

if (!$event_id)
{
	header("Location: ./events.php");
	exit();
}

$event = new Event($event_id);

list($bracket_html) = $event->brackets(false, 0, 'elimination');
$text .= $bracket_html;

$ns->tablerender($event->getField('Name')." ($egame - ".$event->eventTypeToString().")", $text);

?>

