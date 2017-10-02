<?php
//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

require_once("settings.php");

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------


$text2 = "";
for ($i=0; $i<count($helpcapt); $i++) {
	$text2 .="<b>".$helpcapt[$i]."</b><br />";
	$text2 .=$helptext[$i]."<br /><br />";
};

$ns -> tablerender($helptitle, $text2);
?>
