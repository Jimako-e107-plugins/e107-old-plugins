<?php
/*
+---------------------------------------------------------------+
| Trigger by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/trigger/help.php,v $
| $Revision: 1.1 $
| $Date: 2007/06/18 21:41:31 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   $helptitle  = TRIGGER_LAN_HELP_00_0;

   $helpcapt[] = constant("TRIGGER_LAN_HELP_".e_QUERY."_0");
   $helptext[] = constant("TRIGGER_LAN_HELP_".e_QUERY."_1");

   $text2 = "";
   for ($i=0; $i<count($helpcapt); $i++) {
      $text2 .= "<b>".$helpcapt[$i]."</b><br />";
   $text2 .=$helptext[$i]."<br /><br />";
   };

   $ns -> tablerender($helptitle, $text2);
?>