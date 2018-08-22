<?php
/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes
|        Version: 0.4
|        Date: 12/01/2009
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

// multilanguages
@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."advanced_bbcodes/languages/French.php");

$menutitle  = "AdvBBcodes Navigation";

$butname[]  = LAN_ADVANCED_BBCODES_ADMIN_MENU_00;
$butlink[]  = "admin_prefs.php";
$butid[]    = "advanced_bbcodes_prefs";

$butname[]  = LAN_ADVANCED_BBCODES_ADMIN_MENU_01;
$butlink[]  = "admin_prefs_affichage.php";
$butid[]    = "advanced_bbcodes_prefs_affichage";

global $pageid;
for ($i=0; $i<count($butname); $i++) {
 $var[$butid[$i]]['text'] = $butname[$i];
 $var[$butid[$i]]['link'] = $butlink[$i];
};

show_admin_menu($menutitle, $pageid, $var);
?>