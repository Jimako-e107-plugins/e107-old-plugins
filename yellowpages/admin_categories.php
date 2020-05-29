<?php
/*
+---------------------------------------------------------------+
| Yellow Pages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/admin_categories.php,v $
| $Revision: 1.5.2.1 $
| $Date: 2007/02/07 00:22:10 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   // class2.php is the heart of e107, always include it first to give access to e107 constants and variables
   require_once("../../class2.php");

   // Check to see if the current user has admin permissions for this plugin
   if (!getperms("P")) {
      // No permissions set, redirect to site front page
      header("location:".e_BASE."index.php");
      exit;
   }

   // Required files
   require_once(e_PLUGIN."yellowpages/handlers/yellowpages_class.php");
   require_once(YELP_HANDLERS_DIR."/yellowpages_utils.php");

   // Include auth.php rather than header.php ensures an admin user is logged in
   require_once(e_ADMIN."auth.php");

   // Set up page title - this is the title for the plugin table/form
   $title   = YELL_MENU_02;

   // Set a unique ID for the page, this is used to highlight the page in the plugins admin menu
   $pageid  = "categories";

   // Create a form using the helper classes
   $e107HelperForm->createFormFromXML("forms/categories");

   // Process the form
   $e107HelperForm->processForm(true, true);
   $text .= $e107HelperForm->getFormHTML();

   $ns->tablerender($title, $text);

   require_once(e_ADMIN."footer.php");

   function yellCategoryFormatDropDown($row) {
      return $row["yell_cat_parent_id"] ? "->".$row["yell_cat_name"] : $row["yell_cat_name"];
   }
?>