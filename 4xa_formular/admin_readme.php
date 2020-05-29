<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|        For the e107 website system
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");

if (!getperms("P"))
{
	header("location:".e_HTTP."index.php");
	exit;
}
require_once("constanten.php");
$lan_file = e_PLUGIN.e4xA_FORM_FOLDER."/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.e4xA_FORM_FOLDER."/languages/German.php");
require_once(e_ADMIN."auth.php");
$pageid = "help";
$caption = LAN_4xA_FORM_23;

//$inhalt=LAN_4xA_FORM_24;

$help_file = e_PLUGIN.e4xA_FORM_FOLDER."/readme/".e_LANGUAGE.".pdf";
$link_to_help=(file_exists($help_file) ? $help_file :  e_PLUGIN.e4xA_FORM_FOLDER."/readme/German.pdf");

$inhalt="<a href='".$link_to_help."'>Hier bitte lesen>></a>";

$text    = $tp->toHTML($inhalt, TRUE);
$ns->tablerender($caption, $text);
require_once(e_ADMIN."footer.php");

?>