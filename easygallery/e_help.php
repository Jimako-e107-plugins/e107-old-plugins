<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
if(!defined("e107_INIT")){ exit; }
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');

$helptitle  = EG_ADMIN_HELP_00;

$helpcapt[] = EG_ADMIN_HELP_01;
$helptext[] = EG_ADMIN_HELP_02;

$helpcapt[] = EG_ADMIN_HELP_03;
$helptext[] = EG_ADMIN_HELP_04;

//	Possible future menu items
//	$helpcapt[] = EG_ADMIN_HELP_05;
//	$helptext[] = EG_ADMIN_HELP_06;

$helpcapt[] = EG_ADMIN_HELP_07;
$helptext[] = EG_ADMIN_HELP_08;

$text2 = ''; // Define $text2 variable
for ($i = 0, $max = count($helpcapt); $i < $max; $i++) 
{
	$text2 .= '<b>'.$helpcapt[$i].'</b><br />';
	$text2 .= $helptext[$i].'<br /><br />';
};
$ns -> tablerender($helptitle, $text2);
?>