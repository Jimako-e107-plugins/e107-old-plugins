<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

   $menutitle  = UC_SHOW_ADM_OPT_01;

   $butname[]  = UC_SHOW_ADM_OPT_02;
   $butlink[]  = "admin_config.php";
   $butid[]    = "config";
   
   $butname[]  = UC_SHOW_ADM_OPT_03;
   $butlink[]  = "admin_readme.php";
   $butid[]    = "info";
   
   $butname[]  = UC_SHOW_ADM_OPT_04;
   $butlink[]  = "admin_tips.php";
   $butid[]    = "tips";   
 

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);

?>