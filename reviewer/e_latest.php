<?php
/*
+---------------------------------------------------------------+
|        Reviewer for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'reviewer/languages/English.php');
global $partnews_obj;

$reviewer_posts = $sql->db_Count("reviewer_items", "(*)",'where reviewer_items_approved = 0',false);
if (empty($reviewer_posts))
{
    $reviewer_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "reviewer/images/reviewer_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . REVIEWER_AI033 . ": " . $reviewer_posts . "</div>";
?>