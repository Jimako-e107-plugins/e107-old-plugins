<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN."e_version/languages/".e_LANGUAGE.".php");
$evrsn_posts = $sql->db_Count("eversion", "(*)");
if (empty($evrsn_posts))
{
    $evrsn_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "e_version/images/icon_16.gif' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . EVERSION_A57 . ": " . $evrsn_posts . "</div>";

?>