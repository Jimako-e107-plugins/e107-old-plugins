<?php
/*
+---------------------------------------------------------------+
|        MyLevel Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
global $mylevel_obj;
include_lan(e_PLUGIN . 'mylevel_menu/languages/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."userclass_class.php");
require_once(e_PLUGIN . "mylevel_menu/includes/mylevel_class.php");
if (!is_object($mylevel_obj))
{
    $mylevel_obj = new mylevel;
}
if ($mylevel_obj->mylevel_userate == 2)
{
    $mylevel_posts = $sql->db_Count("mylevel", "(*)", "where mylevel_level<2", false);
}
else
{
    $mylevel_posts = $sql->db_Count("mylevel", "(*)", "where mylevel_level>8", false);
}
if (empty($mylevel_posts))
{
    $mylevel_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "mylevel_menu/images/mylevel_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . MYLEVEL_A37 . ": " . $mylevel_posts . "</div>";

?>