<link rel='stylesheet' href='theme/nboard.css' type='text/css'/>
<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
	$minus_view = $view - 1;
	$plus_view = $view + 1;
	
$text ="<table class='forumheader3' width=100%><tr>";
//$text.="<td class='forumheader' width=50px>".NB_NAVI_01."</td>";
$text.="<td align='right'>";

if ($view<>0){
$text.="<a href='".e_PLUGIN."nboard/nboard.php?view=$plus_view'>[".NB_NAVI_06."]</a> ";
	$text.="<a href='".e_PLUGIN."nboard/nboard.php?view=$minus_view'>[".NB_NAVI_05."]</a> ";
/*
	$text.="<a href='viewads.php?view=$plus_view'><img src='".e_PLUGIN."nboard/theme/navigator/left_nav.png' alt='".NB_CLASS_05."'></a>";
	$text.="<a href='viewads.php?view=$minus_view'><img src='".e_PLUGIN."nboard/theme/navigator/right_nav.png' alt='".NB_CLASS_06."'></a>";
*/
}
$text.="<a href='nboard.php'>[".NB_NAVI_04."]</a> ";
$text.="<a href='".e_PLUGIN."nboard/nboard.php?search'>[".NB_NAVI_02."]</a> ";
$text.="<a href='".e_PLUGIN."nboard/nboard.php?add'>[".NB_NAVI_03."]</a>";
/*
$text.="<a href='nboard.php'><img src='".e_PLUGIN."nboard/theme/navigator/home.png' alt='".NB_NAVI_04."'></a>";
$text.="<a href='search.php'><img src='".e_PLUGIN."nboard/theme/navigator/search.png' alt='".NB_NAVI_02."'></a>";
$text.="<a href='add.php'><img src='".e_PLUGIN."nboard/theme/navigator/add.png' alt='".NB_NAVI_03."'></a>";
*/
$text.="</td></tr></table>";
?>