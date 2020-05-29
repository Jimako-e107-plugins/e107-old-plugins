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
| $Source: e:\_repository\e107_plugins/trigger/admin_prefs.php,v $
| $Revision: 1.1 $
| $Date: 2007/06/18 21:41:31 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // class2.php is the heart of e107, always include it first to give access to e107 constants and variables
   require_once("../../class2.php");

   // Check to see if the current user has admin permissions for this artifact
   if (!getperms("P")) {
      // No permissions set, redirect to site front page
      header("location:".e_BASE."index.php");
      exit;
   }

   // Required files
   require_once(e_PLUGIN."trigger/trigger_class.php");

   // Include auth.php rather than header.php ensures an admin user is logged in
   require_once(e_ADMIN."auth.php");

   $adminpage = $trigger->getAdminPage();
   $ns->tablerender($adminpage[0], $adminpage[1]);
   require_once(e_ADMIN."footer.php");
?>