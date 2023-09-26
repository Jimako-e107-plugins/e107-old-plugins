<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Meeting Planner           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/

include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");

$meetings = $sql -> db_Count("aacgc_mp_meetings");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_mp/images/icon_16.png' style='vertical-align: bottom' />".AMP_90.": ".$meetings."
</div>";


?>