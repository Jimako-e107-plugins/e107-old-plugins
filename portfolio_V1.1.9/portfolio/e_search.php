<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "portfolio/languages/" . e_LANGUAGE . ".php");
$portfolio_title = PORTFOLIO_3;
$search_info[] = array('sfile' => e_PLUGIN . 'portfolio/search/search.php', 'qtype' => $portfolio_title, 'refpage' => 'portfolio.php');

?>