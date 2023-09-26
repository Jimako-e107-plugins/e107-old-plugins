<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Attendance List           #
#     by Reid Baughman AKA M@CH!N3    #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/


$events = $sql -> db_Count("aacgc_event_listing");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_event_listing/images/icon_16.gif' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>Att Events: ".$events."
</div>";


?>