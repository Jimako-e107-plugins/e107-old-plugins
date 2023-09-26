<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/

include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");

$paytrackmems = $sql -> db_Count("aacgc_paytrack_members");

$text .= "<div style='padding-bottom: 2px;'><img src='".e_PLUGIN."aacgc_paytrack/images/icon_16.png' style='vertical-align: bottom' />".APT_90.": ".$paytrackmems."</div>";

?>