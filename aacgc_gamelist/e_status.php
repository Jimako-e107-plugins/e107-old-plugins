<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by  M@CH!N3                     #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/


$games = $sql -> db_Count("aacgc_gamelist");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_gamelist/images/icon_16.jpg' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>Games Listed: ".$games."
</div>";



?>