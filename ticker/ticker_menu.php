<?php

global $pref, $tp;
$ticker_prefs = $pref['ticker'];

$ns->tablerender($ticker_prefs['menu_caption'],$tp->toHTML($ticker_prefs['menu_text'],TRUE,"BODY, fromadmin",$ticker_prefs['menu_admin']));

?>