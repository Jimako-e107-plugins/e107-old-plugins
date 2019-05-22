<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/theme_utilities/handlers/theme_utilities_class.php,v $
| $Revision: 1.2 $
| $Date: 2006/12/09 19:01:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include theme_utilities handlers
require_once(e_PLUGIN."theme_utilities/handlers/tu_constants.php");

// Model objects

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://www.bugrain.plus.com'>http://www.bugrain.plus.com</a> and try this plugin again.</p>";
   exit;
}

/**
 * Class used to control all page generation and workflow aspects of theme_utilities
 */
class theme_utilities {
   // Current admin page ID
   var $pageid;
   var $themeid;
   var $configid;
   //

   /**
    * Constructor
    */
   function theme_utilities() {
      global $auc, $lot;
      $q = explode(".", e_QUERY);
      $this->pageid   = $q[0] ? $q[0] : 99;
      $this->themeid  = $q[1] ? $q[1] : false;
      $this->configid = $q[2] ? $q[2] : false;
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $tu_adminmenu;

      // Get any enabled themes
      $handle = opendir(e_THEME);
      while ($themedir = readdir($handle)) {
         if (file_exists(e_THEME.$themedir.TUC_CONFIG_DIR)) {
            $tu_adminmenu["TUC_ADMIN_PAGE_$themedir"] = array("text" => $themedir, "link" => TUC_ADMIN_PAGE."?98.$themedir", "form" => true);
         }
      }
      closedir($handle);
      show_admin_menu(TU_LAN_TUTION, $this->pageid, $tu_adminmenu);

      if ($this->themeid != "") {
         // Get any config options for current theme
         include_once(e_THEME.$this->themeid.TUC_CONFIG_FILE);
         foreach ($tu_config as $id=>$submenu) {
            $adminsubmenu[$id] = array("text" => $submenu["name"], "link" => TUC_ADMIN_PAGE."?98.{$this->themeid}.$id", "form" => true);
         }
         show_admin_menu($this->themeid, $this->pageid, $adminsubmenu);
      }
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $tu_adminmenu, $e107HelperForm;

      $title  = TU_LAN_TUTION." :: ".$tu_adminmenu["TUC_ADMIN_PAGE_".$this->pageid]["text"];
      if ($this->configid) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML(e_THEME.$this->themeid.TUC_CONFIG_DIR.$this->configid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_{$this->pageid}.php");
      }
      $this->pageid = $this->themeid ? "TUC_ADMIN_PAGE_".$this->themeid : "TUC_ADMIN_PAGE_99";
      return array($title, $text);
   }
}

// An global instance of the theme_utilities class
global $theme_utilities;
$theme_utilities = new theme_utilities();
?>