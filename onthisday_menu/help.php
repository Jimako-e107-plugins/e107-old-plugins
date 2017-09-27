<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");

$otd_action = basename($_SERVER['PHP_SELF'], ".php");

$otd_text = "<table width='100%' class='fborder'>";
if ($otd_action == "admin_config")
{
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H02 . "</b></td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H03 . "</b><br />" . OTD_H04 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H05 . "</b><br />" . OTD_H06 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H07 . "</b><br />" . OTD_H08 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H09 . "</b><br />" . OTD_H10 . "</td></tr>";
}
if ($otd_action == "admin_entries")
{
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H11 . "</b></td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H12 . "</b><br />" . OTD_H13 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H14 . "</b><br />" . OTD_H15 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H16 . "</b><br />" . OTD_H17 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H18 . "</b><br />" . OTD_H19 . "</td></tr>";
}
if ($otd_action == "admin_import")
{
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H21 . "</b></td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H22 . "</b><br />" . OTD_H23 . "</td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H24 . "</b><br />" . OTD_H25 . "</td></tr>";
}
if ($otd_action == "admin_vupdate")
{
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H30 . "</b></td></tr>";
    $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H30 . "</b><br />" . OTD_H31 . "</td></tr>";
}
$otd_text .= "</table>";
$ns->tablerender(OTD_H01, $otd_text);

?>
