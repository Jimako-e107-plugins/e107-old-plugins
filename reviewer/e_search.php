<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
$reviewer_title = REVIEWER_A027;
$search_info[] = array('sfile' => e_PLUGIN . 'reviewer/search/search.php', 'qtype' => $reviewer_title, 'refpage' => 'reviewer.php');

?>