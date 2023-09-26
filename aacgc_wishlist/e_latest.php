<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/

include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");

//-----------------------------------------------

$wishlist = $sql -> db_Count("aacgc_wishlist");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_wishlist/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>".AWL_45.": ".$wishlist."
</div>";


//-----------------------------------------------


?>