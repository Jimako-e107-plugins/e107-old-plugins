<?php

/*
#######################################
#     e107 website system plguin      #
#     Product Listing                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

$products = $sql -> db_Count("product_listing");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."product_listing/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>Total Products: ".$products."
</div>";
?>