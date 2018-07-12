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
$eclassf_posts = $sql->db_Count('eclassf_ads', '(*)');
if (empty($eclassf_posts))
{
    $eclassf_posts = 0;
}
$text .= '<div style="padding-bottom: 2px;"><img src="' . e_PLUGIN . 'e_classifieds/images/icon_16.png" style="width: 16px; height: 16px; vertical-align: bottom;border:0;" alt="" /> ' . ECLASSF_A50 . ': ' . $eclassf_posts . '</div>';

?>