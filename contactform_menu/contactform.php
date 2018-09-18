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
| $Source: e:\_repository\e107_plugins/contactform_menu/contactform.php,v $
| $Revision: 1.10.2.1 $
| $Date: 2006/12/18 19:06:56 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");

   // Check that the viewing is allowed for current visitor
   if (!check_class($pref['contactform_visibility'])){
      header("location:../../index.php");
      exit;
   }

   require_once(HEADERF);

   // Include the e107 Helper classes
   if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
      require_once(e_PLUGIN."e107helpers/e107Helper.php");
   } else {
      print "Fatal error, cannot find e107Helper class, this plugin requires the e107 Helper Project plugin to be installed";
      require_once(FOOTERF);
      exit;
   }

   if (file_exists(e_PLUGIN."contactform_menu/contactform_class.php")) {
      include(e_PLUGIN."contactform_menu/contactform_class.php");
   } else {
      print "Fatal error, cannot find contactForm class, possible incorrect installation";
      require_once(FOOTERF);
      exit;
   }

   $contactform->getMainPage();
   require_once(FOOTERF);
?>