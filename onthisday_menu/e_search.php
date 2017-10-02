<?php
/*
+---------------------------------------------------------------+
|        On THis Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");

$otd_title = OTD_A62;
$search_info[] = array('sfile' => e_PLUGIN . 'onthisday_menu/search/search.php', 'qtype' => $otd_title, 'refpage' => 'index.php');

?>