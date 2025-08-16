<?
/*
===============================================================
   GOOGLE Maps - v1.3 - by keithschm
   www.keithschmitt.com
keithschm AT GMAIL DOT COM

MAp Class from   www.phpinsider.com  ported for use on E107
===============================================================
*/
require_once("../../class2.php");

$lan_file = e_PLUGIN."google_maps/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."google_maps/languages/English.php");

require_once(e_ADMIN."auth.php");
$caption = "Readme";
$text =    LAN_YPLUG_14;

$ns -> tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
?>
