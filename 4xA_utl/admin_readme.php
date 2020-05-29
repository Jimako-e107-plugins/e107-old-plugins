<?php
/*
+---------------------------------------------------------------+
|        4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/admin_readme.php
|
|        For the e107 website system
|        Steve Dunstan
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
$lan_file = e_PLUGIN."4xA_utl/languages/".e_LANGUAGE.".php";
$pageid = "readme";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_utl/languages/German.php");
require_once(e_ADMIN."auth.php");
$caption = "Liesmich 4xA-UTL 0.3";
$text    = "<h2>1. ".e4xA_AD_MENU_2.".</h2><br/><br/>
".e4xA_UTL_HELP_TEXT1."
<br/>
<h2>2. ".e4xA_AD_MENU_1.".</h2><br/>
".e4xA_UTL_HELP_TEXT2."

<br/><br/>";
$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");

?>