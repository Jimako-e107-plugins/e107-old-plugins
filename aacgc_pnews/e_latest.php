<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/


include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

//-----------------------------------------------


$pnewssubmits = $sql -> db_Count("aacgc_pnews_submitted");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_pnews/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''><a href='".e_PLUGIN."aacgc_pnews/admin_subnews.php'>".APNEWS_113."</a>: ".$pnewssubmits."
</div>";

//-----------------------------------------------


?>