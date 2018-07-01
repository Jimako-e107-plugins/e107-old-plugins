<?php

/*
#######################################
#     e107 website system plguin      #
#     Advanced Medal System V1.31     #
#     by Marc Peppler                 #
#     http://www.marc-peppler.net     #
#     mail@marc-peppler.net           #
#    Updated version 1.31 by garyt  #
#######################################
*/

$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");

$medgiv = $sql -> db_Count("advmedsys_awarded");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."advmedsys/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''> ".AMS_ADMIN_S25.": ".$medgiv."
</div>";
?>