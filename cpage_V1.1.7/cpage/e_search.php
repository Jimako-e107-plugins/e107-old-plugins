<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "cpage/languages/" . e_LANGUAGE . "_cpage.php");
$cpage_title = CPAGE_SEARCH01;
$search_info[]=array( 'sfile' => e_PLUGIN.'cpage/search/search.php', 'qtype' => $cpage_title, 'refpage' => 'cpage.php');

?>