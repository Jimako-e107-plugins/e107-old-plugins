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
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN . "portfolio/languages/" . e_LANGUAGE . ".php");
$portfolio_posts = $sql->db_Count("portfolio_person", "(*)");
if (empty($portfolio_posts))
{
    $portfolio_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "portfolio/images/pallette_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . PORTFOLIO_A1 . ": " . $portfolio_posts . "</div>";

?>