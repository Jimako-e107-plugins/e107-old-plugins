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
| $Source: e:\_repository\e107_plugins/yellowpages/admin_prefs_90.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:11 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   global $yelp_errors, $sql, $sql2, $tp;
   $text = "";

   // Process the form, if submitted
   if (isset($_POST["yellowpages_admin_prefs_90_form"]) && $_POST["yellowpages_admin_prefs_90_form"] == "true") {
      $text .= "<div class='forumheader2'>";

      $yelp_errors=0;
      // Check for debug output requested
      $yelp_debug = false;
      if (isset($_POST["yellowpages_import_debug"][0]) && $_POST["yellowpages_import_debug"][0] == "1") {
         $yelp_debug = true;
      }

      // 1. If overwriting, delete all entries for the selected section
      // 2. Get categories from link page plugin
      // 3. Add LP categories to YP
      // 4. Get links from LP
      // 5. Add LP links to YP
      // 6. If copying comments, then copy them
      // 7. If copying ratings, then copy them

      $text .= "<div class='forumheader2'>".YELP_LAN_IMPORT_DONE."</div>";

      if ($yelp_errors == 0) {
         $text .= "<div class='forumheader3'>".YELP_LAN_IMPORT_DONE_CHECK."</div>";
      } else {
         $text .= "<div class='forumheader3'>";
         $text .= "<img type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
         $text .= $yelp_errors.YELP_LAN_IMPORT_DONE_CHECK_ERRORS."</div>";
      }

      $text .= "</div>";
   }

   // Create a form using the helper classes
   $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
   $e107HelperForm->generateHTML(true, true);
   $text .= $e107HelperForm->getFormHTML();

function getMySQLErrorInfo() {
   global $yelp_debug, $yelp_errors;
   $text .= "<img type='image' style='cursor:pointer' src='".e_IMAGE."fileinspector/warning.png'> ";
   $text .= "<i>".YELP_LAN_IMPORT_ERROR." ".mysql_error()."</i><br/>";
   $yelp_errors++;
   if ($yelp_debug) {
      $text .= " sql : $tmp<br/>";
   }
   return $text;
}
?>
