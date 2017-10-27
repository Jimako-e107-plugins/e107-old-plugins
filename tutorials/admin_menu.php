<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/
// Multilanguage
@include(e_PLUGIN."tutorials/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."tutorials/languages/Italian.php");

   $menutitle  = TUT_ADMIN_MENUTITLE;

   $butname[]  = TUT_ADMIN_MENU_1;
   $butlink[]  = "admin_tuts.php";
   $butid[]    = "main";	
	
   $butname[]  = TUT_ADMIN_MENU_2;
   $butlink[]  = "admin_add.php?category";
   $butid[]    = "addcat";
   
   $butname[]  = TUT_ADMIN_MENU_3;
   $butlink[]  = "admin_remove.php?cat";
   $butid[]    = "removecat";
   
   $butname[]  = TUT_ADMIN_MENU_4;
   $butlink[]  = "admin_add.php?tutorial";
   $butid[]	   = "addtut";
   
   $butname[]  = TUT_ADMIN_MENU_5;
   $butlink[]  = "admin_remove.php?tut";
   $butid[]	   = "removetut";
   
   $butname[]  = TUT_ADMIN_MENU_6;
   $butlink[]  = "admin_accept.php";
   $butid[]    = "usertut";
	   
   $butname[]  = TUT_ADMIN_MENU_7;
   $butlink[]  = "admin_stats.php";
   $butid[]    = "viewstats";
   
   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>