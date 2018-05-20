<?php
/**
*EventCreate.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/event.php");
// Specify if we use WYSIWYG for text areas
global $e_wysiwyg;
$e_wysiwyg	= "eventdescription,eventrules";  // set $e_wysiwyg before including HEADERF
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/event.js"></script>
';

$event = new Event();

if ((!isset($_POST['createevent']))||(!check_class($pref['eb_events_create_class'])))
{
	$text .= '<br />'.EB_EVENTC_L2.'<br />';
}
else
{
	$text .= $event->displayEventSettingsForm(true);
}

$ns->tablerender(EB_EVENTC_L1, $text);
require_once(FOOTERF);
exit;
?>