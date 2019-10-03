<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

$clans = $sql -> db_Count("clan_listing");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."clan_listing/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>".ACLANLIST_ESTAT.": ".$clans."
</div>";
?>