<?php
/*
+ ----------------------------------------------------------------------------+
|     eBattles admin help
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

$lan_file = e_PLUGIN."ebattles/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."ebattles/languages/English.php");

require_once(e_PLUGIN.'ebattles/plugin.php');

$text .= '<div style="text-align:center; font-weight: bold;">';
$text .= '<img src="'.e_PLUGIN.'ebattles/images/ebattles_32.ico" alt=""/><br />';
$text .= EB_ADMINHELP_L2.': '.$eplug_version;
$text .= '</div>';
$text .= '<hr />';
$text .= EB_ADMINHELP_L3.'<br />';
$text .= EB_ADMINHELP_L4.'<br />';
$text .= EB_ADMINHELP_L5.'<br />';
$text .= EB_ADMINHELP_L6.'<br />';
$text .= EB_ADMINHELP_L7.'<br />';


$text .= '<hr />';



$ns->tablerender(EB_ADMINHELP_L1, $text);
?>