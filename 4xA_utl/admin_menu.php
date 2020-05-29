<?php
/*
|	4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/admin_menu.php
|
|        For the e107 website system
|        Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."4xA_utl/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."4xA_utl/languages/German.php");
$menutitle = e4xA_AD_MENU_CAP;

$butname[] = e4xA_AD_MENU_1;
$butlink[] = "admin_config.php";   
$butid[] = "first";       

$butname[] = e4xA_AD_MENU_2;
$butlink[] = "admin_config2.php";   
$butid[] = "sekond";

$butname[] = e4xA_AD_MENU_3;
$butlink[] = "admin_readme.php";   
$butid[] = "readme"; 
//---------------------------------------------------------------
global $pageid;
for ($i=0; $i<count($butname); $i++)
	{
    $var[$butid[$i]]['text'] = $butname[$i];
	$var[$butid[$i]]['link'] = $butlink[$i];
	};
show_admin_menu($menutitle,$pageid, $var);
if($pageid == "match")
	{
    $ns -> tablerender(e4xA_AD_MENU_CAP,plugin_selector());
	}
?>
