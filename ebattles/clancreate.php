<?php
/**
* ClanCreate.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
// Specify if we use WYSIWYG for text areas
global $e_wysiwyg;
$e_wysiwyg	= "clandescription";  // set $e_wysiwyg before including HEADERF
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/clan.js"></script>
';

$clan = new Clan();

if ((!isset($_POST['createteam']))||(!check_class($pref['eb_teams_create_class'])))
{
    $text .= '<br />'.EB_CLANS_L8.'<br />';
}
else
{
	$text .= $clan->displayClanSettingsForm(true);
}

$ns->tablerender(EB_CLANC_L1, $text);
require_once(FOOTERF);
exit;
?>
