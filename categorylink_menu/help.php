<?php
/*
+---------------------------------------------------------------+
|        e107 website system plugin
|        E107Scores Plugin
|        Created By: acidfire
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$eLX_dir = e_PLUGIN."categorylink_menu/";
$lan_file = $eLX_dir."language/".e_LANGUAGE.".php";
include(file_exists($lan_file) ? $lan_file : $eLX_dir."language/English.php");
$caption2 = categorylink_HELP_1;
$text2 = "
<b>".categorylink_HELP_2."</b><br />
".categorylink_HELP_3."
<br /><br />
<b>".categorylink_HELP_4."</b><br />
".categorylink_HELP_5."
<br /><br />
<b>".categorylink_HELP_8."</b><br />
".categorylink_HELP_9."
<br /><br />
<b>".categorylink_HELP_6."</b><br />
".categorylink_HELP_7."
<br /><br />
<b>".categorylink_HELP_10."</b><br />
".categorylink_HELP_11."
<br /><br />
";
$ns -> tablerender($caption2, $text2);
?>
