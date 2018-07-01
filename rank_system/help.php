<?php
/**
 * $Id: help.php,v 1.1 2009/10/22 15:00:51 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 17 okt 2009 - 23:59:40
 * 
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/10/22 15:00:51 $
 *
 * Change Log:
 * $Log: help.php,v $
 * Revision 1.1  2009/10/22 15:00:51  michiel
 * Implemented Help text in admin section
 *
 *  
 */
if (!getperms("P")) {
    header("location:" . e_BASE . "index.php");
    exit;
}

include_lan(e_PLUGIN . "rank_system/languages/help/" . e_LANGUAGE . ".php");
include_lan(e_PLUGIN . "rank_system/languages/admin/" . e_LANGUAGE . ".php");

$page = basename($_SERVER['PHP_SELF'], ".php");
$text = "<table width='97%' class='fborder'>";

if ($page == "admin_conddef") {
	$text .= "<tr><td class='forumheader3' style='text-align:center'><b>" . HELP_RS_CD01 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . ADLAN_RS_CDF6 . "</b><br />" . HELP_RS_CD02 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . ADLAN_RS_CDF7 . "</b><br />" . HELP_RS_CD03 . "</td></tr>";
}
else if ($page == "admin_config") {
	$text .= "<tr><td class='forumheader3' style='text-align:center'><b>" . HELP_RS_MC01 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . ADLAN_RS_C69 . "</b><br />" . HELP_RS_MC02 . "</td></tr>";
}

$text .= "</table>";
$ns->tablerender(HELP_RS, $text);

?>