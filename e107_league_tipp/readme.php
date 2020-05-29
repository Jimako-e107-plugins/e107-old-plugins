<?
/*
+---------------------------------------------------------------+
|        e107 website system
|        Easy Admin Page by Cameron. (www.e107coders.org)
|        a part of Your_plugin v3.1  multilanguage by Juan  Reseau.li
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/readme.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/English/readme.php");

require_once(e_ADMIN."auth.php");
$caption = "";//"Readme";
$text =    "";

$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
?>
