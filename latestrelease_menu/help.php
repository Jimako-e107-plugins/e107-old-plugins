<?php
/*
+---------------------------------------------------------------+
|        Latest Release Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
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
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . "latestrelease_menu/languages/help/" . e_LANGUAGE . ".php");
$text = "<table style='".USER_WIDTH."' class='fborder'>";
$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_01 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_02 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_03 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_04 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_05 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_06 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_07 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_08 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_09 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_10 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_11 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_12 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_13 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_14 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_15 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_16 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_17 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_18 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_19 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_20 . "</td></tr>";

$text .= "<tr><td class='forumheader3'><b>" . LATESTRELEASE_HELP_LAN_21 . "</b></td></tr>";
$text .= "<tr><td class='forumheader3'>" . LATESTRELEASE_HELP_LAN_22 . "</td></tr>";

$text .= "</table>";
$ns->tablerender(LATESTRELEASE_HELP_LAN_00, $text);
