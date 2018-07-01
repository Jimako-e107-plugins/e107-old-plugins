<?php

/*
#######################################
#     e107 website system plguin      #
#     Advanced Medal System V1.31      #
#     by Marc Peppler                 #
#     http://www.marc-peppler.at      #
#     mail@marc-peppler.at            #
#    Updated version 1.31 by garyt  #
#######################################
*/

$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");

$medlast = 0;
$currentunixtime = time();
$threedaysagounix = $currentunixtime - (60*60*24*3);
$sql->db_Select("advmedsys_awarded", "*", "", "");
while($row = $sql->db_Fetch()){
	$dateindb = $row['awarded_date'];
	$dateexp = explode(".",$dateindb);
	$dateunix = mktime(0,0,0,$dateexp[0],$dateexp[1],$dateexp[2]);
	if ($dateunix > $threedaysagounix) {
		$medlast = $medlast + 1;
	}
}

$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."advmedsys/images/icon_16.png' style='width:16px; height:16px; vertical-align:bottom'>
".AMS_ADMIN_S26.": ".$medlast."<br>(".date("m.d.Y", $threedaysagounix)." - ".date("m.d.Y", $currentunixtime).")
</div>";

?>