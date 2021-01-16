<?php
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");

$text = "<table width='97%' class='fborder'>";
    $text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_1 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_2 . "</b><br />" . PRUNE_HELP_3 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_4 . "</b><br />" . PRUNE_HELP_5 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_6 . "</b><br />" . PRUNE_HELP_7 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_8 . "</b><br />" . PRUNE_HELP_9 . "</td></tr>";
	$text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_10 . "</b><br />" . PRUNE_HELP_11 . "</td></tr>";
	$text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_12 . "</b><br />" . PRUNE_HELP_13 . "</td></tr>";
	$text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_14 . "</b><br />" . PRUNE_HELP_15 . "</td></tr>";
	$text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_16 . "</b><br />" . PRUNE_HELP_17 . "</td></tr>";
	$text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_18 . "</b><br />" . PRUNE_HELP_19 . "</td></tr>";
	$text .= "<tr><td class='forumheader3'><b>" . PRUNE_HELP_20 . "</b><br />" . PRUNE_HELP_21 . "</td></tr>";

$text .= "</table>";
$ns->tablerender(PRUNE_HELP_0, $text);

?>