<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/admin_prefs.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:06 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // class2.php is the heart of e107, always include it first to give access to e107 constants and variables
   require_once("../../class2.php");

   // Check to see if the current user has admin permissions for this plugin
   if (!getperms("P")) {
      // No permissions set, redirect to site front page
      //headerx("location:".e_BASE."index.php");
      e107::redirect();
      exit;
   }
   
   // Required files
   require_once(e_PLUGIN."e107helpers_developer/handlers/e107helpers_developer_class.php");
   require_once(EHDC_HANDLERS_DIR."/e107helpers_developer_utils.php");

   // Include auth.php rather than header.php ensures an admin user is logged in
   require_once(e_ADMIN."auth.php");

   $adminpage = $helperdev->getAdminPage();
   $ns->tablerender($adminpage[0], $adminpage[1]);
   require_once(e_ADMIN."footer.php");
?>