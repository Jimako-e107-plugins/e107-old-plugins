<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/admin_prefs.php,v $
| $Revision: 1.14 $
| $Date: 2007/01/24 00:00:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }
   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   require_once(e_PLUGIN."eplayer/eplayer_utils.php");
   require_once(e_ADMIN."auth.php");
   $pageid    = "prefs";
   $e107HelperForm->createFormFromXML("forms/prefs");
   $e107HelperForm->processForm(true, true);
   $text = $e107HelperForm->getFormHTML();
   $ns -> tablerender(EPLAYER_LAN_MENU_02, $text);
   require_once(e_ADMIN."footer.php");
?>