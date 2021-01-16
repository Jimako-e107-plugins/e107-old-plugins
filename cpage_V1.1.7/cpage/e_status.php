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
$cpage_posts = $sql->db_Count("cpage_page", "(*)");
if (empty($cpage_posts))
{
    $cpage_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "cpage/images/cpage_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . CPAGE_STAT01 . ": " . $cpage_posts . "</div>";

?>