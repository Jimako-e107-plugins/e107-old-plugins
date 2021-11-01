<?php

$lan_file = e_PLUGIN."pagerestriction/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."pagerestriction/languages/English.php");

$text = LAN_PAGERESTRICTION_HELP_1;

$ns -> tablerender(LAN_PAGERESTRICTION_HELP_0, $text);

?>