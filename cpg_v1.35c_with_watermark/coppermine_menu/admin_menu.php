<?php
/*
+---------------------------------------------------------------+
| Contact Form by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: E:/cvs/cvsrepo/contactform_menu/admin_menu.php,v $
| $Revision: 1.7 $
| $Date: 2005/06/26 12:22:56 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

   $menutitle  = "CPG Config";

   $butname[]  = "Block(menu) Config";
   $butlink[]  = "admin_config.php";
   $butid[]    = "blockcfg";

   $butname[]  = "Coppermine Config";
   $butlink[]  = "config.php";
   $butid[]    = "maincpgcfg";

	$butname[]  = "CUSTOMPAGES";
	$butlink[]  = "admin_custompages.php";
   	$butid[]    = "custompages";
   	
	$butname[]  = "Readme";
	$butlink[]  = "admin_readme.php";
   	$butid[]    = "readme";

	$butname[]  = "Original Readme";
	$butlink[]  = "admin_oreadme.php";
   	$butid[]    = "oreadme";
   	
	$butname[]  = "Changes";
	$butlink[]  = "admin_changes.php";
   	$butid[]    = "changes";

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>