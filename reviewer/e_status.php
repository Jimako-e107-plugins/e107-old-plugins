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
$reviewer_posts = $sql->db_Count("reviewer_reviewer", "(*)");
if (empty($reviewer_posts))
{
    $reviewer_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "reviewer/images/reviewer_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . REVIEWER_A026 . ": " . $reviewer_posts . "</div>";

?>