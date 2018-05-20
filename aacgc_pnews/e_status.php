<?php


include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");


/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/


$pnewsitems = $sql -> db_Count("aacgc_pnews");
$pnewscoms = $sql -> db_Count("aacgc_pnews_comments");

$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_pnews/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>".APNEWS_114.": ".$pnewsitems."
</div>";

$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_pnews/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>".APNEWS_115.": ".$pnewscoms."
</div>";

?>