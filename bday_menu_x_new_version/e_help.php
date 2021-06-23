<?php
/*
+---------------------------------------------------------------+
|        Birthday Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
include_lan(e_PLUGIN . "bday_menu/languages/" . e_LANGUAGE . "_birthday_mnu.php");

$otd_action = basename($_SERVER['PHP_SELF'], ".php");
$text = "<table width='97%' class='fborder'>";
if ($otd_action == "admin_config")
{
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A20 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A21 . "</b><br />" . BDAY_ADMIN_A22 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A23 . "</b><br />" . BDAY_ADMIN_A24 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A53 . "</b><br />" . BDAY_ADMIN_A54 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A55 . "</b><br />" . BDAY_ADMIN_A56 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A57 . "</b><br />" . BDAY_ADMIN_A58 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A25 . "</b><br />" . BDAY_ADMIN_A26 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A27 . "</b><br />" . BDAY_ADMIN_A28 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A29 . "</b><br />" . BDAY_ADMIN_A30 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A31 . "</b><br />" . BDAY_ADMIN_A32 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A33 . "</b><br />" . BDAY_ADMIN_A34 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A36 . "</b><br />" . BDAY_ADMIN_A37 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A42 . "</b><br />" . BDAY_ADMIN_A43 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A44 . "</b><br />" . BDAY_ADMIN_A45 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . BDAY_ADMIN_A46 . "</b><br />" . BDAY_ADMIN_A47 . "</td></tr>";
}

if ($otd_action == "admin_vupdate")
{
   #$otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H30 . "</b></td></tr>";
   # $otd_text .= "<tr><td class='forumheader3'><b>" . OTD_H30 . "</b><br />" . OTD_H31 . "</td></tr>";
}
$text .= "</table>";
$ns->tablerender(BDAY_ADMIN_A20, $text);
