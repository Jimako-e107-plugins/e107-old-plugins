<?
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

if($_SESSION['e107mobile'] == "e107_core_theme") {
if(file_exists(e_PLUGIN."mobile/languages/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."mobile/languages/".e_LANGUAGE.".php");
	include_once(e_PLUGIN."mobile/languages/English.php");
}

$text="";
$text .="<div class='smalltext'>
<img src='".e_PLUGIN."mobile/images/phoneimg_sm2.png' alt='e107mobile' style='margin: 0px 5px 0px 0px; float: left;' />
".LAN_EMP_10."</div>";

$ns -> tablerender(LAN_EMP_9, $text);
}

?>
