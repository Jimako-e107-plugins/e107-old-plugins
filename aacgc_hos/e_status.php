<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC HOS                       #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/


$hoss = $sql -> db_Count("aacgc_hos");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_hos/images/icon_16.jpg' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>HOS Count: ".$hoss."
</div>";


?>