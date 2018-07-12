<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');
$myclass_title = ECLASSF_1;
$search_info[] = array('sfile' => e_PLUGIN . 'e_classifieds/search/search.php', 'qtype' => $myclass_title, 'refpage' => 'classifieds.php');

?>