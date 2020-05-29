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
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_class.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include yellowpages handlers

require_once(e_PLUGIN."yellowpages/handlers/yellowpages_constants.php");

// Data Access Objects
require_once(YELP_HANDLERS_DIR."yellowpages_DAO.php");

// Model objects
require_once(YELP_HANDLERS_DIR."yellowpages_section.php");
require_once(YELP_HANDLERS_DIR."yellowpages_category.php");
require_once(YELP_HANDLERS_DIR."yellowpages_item.php");
require_once(YELP_HANDLERS_DIR."yellowpages_entry.php");
require_once(YELP_HANDLERS_DIR."yellowpages_user.php");

// Warning and error handling
require_once(YELP_HANDLERS_DIR."yellowpages_status_info.php");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://e107coders.org'>http://e107coders.org</a> and try this plugin again.</p>";
   exit;
}

// Load the shortcodes file - template will be loaded when we know which template to load
require_once(YELP_PLUGIN_DIR."yellowpages_shortcodes.php");

/**
 * Class used to control all page generation and workflow aspects of yellowpages
 */
class yellowpages {
   var $section;
   var $mode;
   var $id;
   var $extra;

   /**
    * Constructor
    */
   function yellowpages() {
      global $ypSection, $ypCategory, $ypCategoryList, $ypItem, $ypItemList, $ypUser, $dao;
      $dao = $this->getDAO();

      // Initialise URL values
    	if (e_QUERY) {
    	   $qs = explode(".", e_QUERY);
    	   if (is_numeric($qs[0])) {
    	      // Default section
            $ypSection     = false;
            $this->mode    = varset($qs[0], 0);
            $this->id      = varset($qs[1], 0);
            $this->extra   = varset($qs[2], "");
         } else {
            // Specific section
            $ypSection     = $this->dao->getSectionFromName($qs[0]);
            $this->mode    = varset($qs[1], 0);
            $this->id      = varset($qs[2], 0);
            $this->extra   = varset($qs[3], "");
         }
      } else {
         $ypSection     = false;
         $this->mode    = 0;
         $this->id      = 0;
         $this->extra   = 0;
      }

      // Get individual URL parameters, if any, if viewing yellowpages page
      if (basename(e_SELF) == basename(YELP_SELF) && e_QUERY) {
      	// Separate the url parameters - format is mode.id
         // Get yellowpages and category up front where appropriate
         switch ($this->getMode()) {
            case YELP_CATEGORIES_PAGE : {
               $ypCategoryList = $dao->getCategoriesList($this->getId(), $this->getSectionId(), $this->getExtra());
               $ypCategory = $dao->getCategory($this->getId());
               $ypItemList = $dao->getItemsList($this->getId());
               //$ypUser = new ypUser($yellowpages);
               break;
            }
            case YELP_ITEM_PAGE : {
               $ypItem = $dao->getItem($this->getId());
               $ypCategoryList = $dao->getCategoriesList($ypItem->getCategory(), $this->getSectionId(), $this->getExtra());
               $ypCategory = $dao->getCategory($ypItem->getCategory());
               //$ypUser = new ypUser($yellowpages);
               break;
            }
            case YELP_MAIN_PAGE : {
               $ypCategoryList = $dao->getCategoriesList($this->getId(), $this->getSectionId());
               $ypItemList = $dao->getItemsList($this->getId());
               //$ypUser = new ypUser($yellowpages);
               break;
            }
         }
      } else {
         $ypCategoryList = $dao->getCategoriesList($this->getId(), $this->getSectionId());
         $ypItemList = $dao->getItemsList($this->getId());
         //$ypUser = new ypUser($ypCategoryList);
      }
   }

   /**
    * Get a reference to the DAO object
    */
   function getDAO() {
      if (!isset($this->dao)) {
         $this->dao = new yellowpagesDAO();
      }
      return $this->dao;
   }

   /**
    * Get the mode that Yellowpages is running in
    */
   function getMode() {
      return $this->mode;
   }

   /**
    * Get extra info on page state (page specific)
    */
   function getExtra() {
      return $this->extra;
   }

   /**
    * Get the current item ID
    */
   function getId() {
      return $this->id;
   }

   /**
    * Get the section ID that Yellowpages is currently viewing
    */
   function getSectionId() {
      global $ypSection;
      // Default to no section
      if ($ypSection) {
         return $ypSection->getId();
      }
      return 0;
   }

   /**
    * Get the page based on URL parameters
    */
   function generatePage() {
      global $ypCategory, $ypItem, $ypUser, $ypStatusInfo, $dao, $pref, $tp;
      global $yelp_shortcodes, $YELP_NAVIGATION_ERROR;

      // TODO would be better shortcoded?
      $pagetitle = "<a class='yellowpages_breadcrumb' href='".YELP_SELF."'>".$pref["yellowpages_page_title"]."</a>";
      $pagetitle = $this->getAnchor().$pref["yellowpages_page_title"]."</a>";

      switch ($this->getMode()) {
         case YELP_MAIN_PAGE :
         case YELP_CATEGORIES_PAGE : {
            // Build page title
            if ($ypCategory) {
               if ($this->getExtra() == "") {
                  $title = $ypCategory->getName();
               } else {
                  $title = "<a class='yellowpages_breadcrumb' href='".YELP_SELF."?".YELP_CATEGORIES_PAGE.".".$ypCategory->getId()."'>".$ypCategory->getName()."</a>";
               }
               $cat = $ypCategory;
               while ($cat->getParentId() > 0) {
                  $cat = $dao->getCategory($cat->getParentId());
                  $title = "<a class='yellowpages_breadcrumb' href='".YELP_SELF."?".YELP_CATEGORIES_PAGE.".".$cat->getId()."'>".$cat->getName()."</a>".$pref["yellowpages_separator"].$title;
               }
               $pagetitle .= $pref["yellowpages_separator"].$title;
            }
            if ($this->getId()) {
               $text = $this->generateCategoryList(false);
               $text .= $this->generateItemList(true);
            } else {
               $text = $this->generateCategoryList(true);
            }
            break;
         }
         case YELP_ITEM_PAGE : {
            // Build page title
            $title = "<a class='yellowpages_breadcrumb' href='".YELP_SELF."?".YELP_CATEGORIES_PAGE.".".$ypCategory->getId()."'>".$ypCategory->getName()."</a>";
            $cat = $ypCategory;
            while ($cat->getParentId() > 0) {
               $cat = $dao->getCategory($cat->getParentId());
               $title = "<a class='yellowpages_breadcrumb' href='".YELP_SELF."?".YELP_CATEGORIES_PAGE.".".$cat->getId()."'>".$cat->getName()."</a>".$pref["yellowpages_separator"].$title;
            }
            $pagetitle .= $pref["yellowpages_separator"].$title;
            $text .= $this->generateItem();
            break;
         }
         default : {
            require_once($this->getTemplate());
            $ypStatusInfo = new yelpStatusInfo(STATUS_ERROR);
            $ypStatusInfo->addMessage(YELP_LAN_MSG_NAVIGATION_ERROR, "");
            $text .= $tp->parseTemplate($YELP_NAVIGATION_ERROR, FALSE, $yelp_shortcodes);
            break;
         }
      }

      define("e_PAGETITLE", $tp->toRss($pagetitle, false));

      return(array($pagetitle, $text));
   }

   // *********************************************************************************************
   // Front end pages
   // *********************************************************************************************

   /**
    * Get the categories list
    */
   function generateCategoryList($parseFoot) {
      global $yelp, $ypCategoryList, $ypCategory, $ypChildren, $ypStatusInfo, $dao, $ypUser, $tp;
      global $yelp_shortcodes, $YELP_PAGE_HEAD, $YELP_PAGE_FOOT, $YELP_CATEGORY_LIST_HEAD, $YELP_CATEGORY_LIST_BODY, $YELP_CATEGORY_LIST_FOOT;

      require_once($this->getTemplate());
      $list = "";
      $list .= $tp->parseTemplate($YELP_PAGE_HEAD, FALSE, $yelp_shortcodes);
      if (count($ypCategoryList) > 0) {
         // Get the outermost container for the categories lists
         $list .= $tp->parseTemplate($YELP_CATEGORY_LIST_HEAD, FALSE, $yelp_shortcodes);
         // Make sure we have number of columns form template or default to 1
         $numcols = varset($yellowpages_template_cat_cols, 1);
         // Initialize a loop counter - counts up to number of columns
         $loop = 1;
         // Process each category
         foreach ($ypCategoryList as $ypCategory) {
            $ypChildren = $dao->getCategoriesList($ypCategory->getId(), $this->getSectionId());
            // Parse the current category and store results in a variable matching template name
            $var = "YELP_CATEGORY_LIST_PREVIEW{$loop}";
            $$var = $tp->parseTemplate($YELP_CATEGORY_LIST_PREVIEW, FALSE, $yelp_shortcodes);
         	$loop ++;
         	// Check for end of row
         	if ($loop > $numcols) {
         	   // Clever bit, replace each instance of the template in the main body template
         	   // with the already parsed text
               $list .= preg_replace("/\{(.*?)\}/e", '$\1', $YELP_CATEGORY_LIST_BODY);
               // Reset the loop counter to start at the beginning of the next row
         	   $loop = 1;
         	}
         }
         // Now tidy up last row, if needed
         if ($loop > 1 && $loop <= $numcols) {
            for ($loop2=$loop; $loop2<=$numcols; $loop2++) {
               $var = "YELP_CATEGORY_LIST_PREVIEW{$loop2}";
               $$var = "";
            }
            $list .= preg_replace("/\{(.*?)\}/e", '$\1', $YELP_CATEGORY_LIST_BODY);
         }
         $list .= $tp->parseTemplate($YELP_CATEGORY_LIST_FOOT, FALSE, $yelp_shortcodes);
      } else if ($this->getId() == 0) {
         $ypStatusInfo = new yelpStatusInfo(STATUS_INFO);
         $ypStatusInfo->addMessage(YELP_LAN_MSG_NO_CATEGORIES, "");
         $list .= $tp->parseTemplate("{YELP_STATUS_INFO}", FALSE, $yelp_shortcodes);
      }
      if ($parseFoot) {
         $list .= $tp->parseTemplate($YELP_PAGE_FOOT, FALSE, $yelp_shortcodes);
      }
      return $list;
   }

   /**
    * Get the items list for current category
    */
   function generateItemList($parseFoot) {
      global $yelp, $ypItemList, $ypItem, $ypStatusInfo, $dao, $ypUser, $tp;
      global $yelp_shortcodes, $YELP_PAGE_HEAD, $YELP_PAGE_FOOT, $YELP_ITEM_LIST_HEAD, $YELP_ITEM_LIST_BODY, $YELP_ITEM_LIST_FOOT;

      include($this->getTemplate());
      $list = "";
      if (count($ypItemList) > 0) {
         // Get the outermost container for the items lists
         $list .= $tp->parseTemplate($YELP_ITEM_LIST_HEAD, FALSE, $yelp_shortcodes);
         // Make sure we have number of columns form template or default to 1
         $numcols = varset($yellowpages_template_item_cols, 1);
         // Initialize a loop counter - counts up to number of columns
         $loop = 1;
         // Process each category
         foreach ($ypItemList as $ypItem) {
            // Parse the current item and store results in a variable matching template name
            $var = "YELP_ITEM_LIST_PREVIEW{$loop}";
            $$var = $tp->parseTemplate($YELP_ITEM_LIST_PREVIEW, FALSE, $yelp_shortcodes);
         	$loop ++;
         	// Check for end of row
         	if ($loop > $numcols) {
         	   // Clever bit, replace each instance of the template in the main body template
         	   // with the already parsed text
               $list .= preg_replace("/\{(.*?)\}/e", '$\1', $YELP_ITEM_LIST_BODY);
               // Reset the loop counter to start at the beginning of the next row
         	   $loop = 1;
         	}
         }
         // Now tidy up last row, if needed
         if ($loop > 1 && $loop <= $numcols) {
            for ($loop2=$loop; $loop2<=$numcols; $loop2++) {
               $var = "YELP_ITEM_LIST_PREVIEW{$loop2}";
               $$var = "";
            }
            $list .= preg_replace("/\{(.*?)\}/e", '$\1', $YELP_ITEM_LIST_BODY);
         }
         $list .= $tp->parseTemplate($YELP_ITEM_LIST_FOOT, FALSE, $yelp_shortcodes);
      }
      if ($parseFoot) {
         $list .= $tp->parseTemplate($YELP_PAGE_FOOT, FALSE, $yelp_shortcodes);
      }
      return $list;
   }

   /**
    * Get the current item
    */
   function generateItem() {
      global $yelp, $ypItem, $ypStatusInfo, $dao, $ypUser, $tp;
      global $yelp_shortcodes, $YELP_PAGE_HEAD, $YELP_PAGE_FOOT, $YELP_ITEM_VIEW;

      require_once($this->getTemplate());
      $list = "";
      $list .= $tp->parseTemplate($YELP_PAGE_HEAD, FALSE, $yelp_shortcodes);
      $list .= $tp->parseTemplate($YELP_ITEM_VIEW, FALSE, $yelp_shortcodes);
      $list .= $tp->parseTemplate($YELP_PAGE_FOOT, FALSE, $yelp_shortcodes);
      return $list;
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $yellowpages_adminmenu, $pageid;
      show_admin_menu(YELP_LAN_YELLOWPAGES, $pageid, $yellowpages_adminmenu);
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $yellowpages_adminmenu, $pageid, $e107HelperForm, $tp;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = YELP_LAN_YELLOWPAGES." :: ".$yellowpages_adminmenu["YELP_ADMIN_PAGE_".$pageid]["text"];
      if ($yellowpages_adminmenu["YELP_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "YELP_ADMIN_PAGE_".e_QUERY : "YELP_ADMIN_PAGE_10";
      return array($title, $text);
   }

   /**
    * Get context sensitive help for the admin pages
    */
   function getAdminHelp() {
      global $ns;
      $pageid = e_QUERY ? e_QUERY : 10;
      $ns->tablerender(constant("YELP_LAN_ADMIN_MENU_".$pageid), constant("YELP_LAN_ADMIN_HELP_".$pageid));
   }

   // *********************************************************************************************
   // Miscellaneous stuff
   // *********************************************************************************************

   /**
    *
    */
   function getAnchor($mode="", $id=false, $extra=false) {
      global $ypSection;
      $url = "<a href='".YELP_SELF;
      if ($ypSection) {
         $url .= "?".$ypSection->getURL().".$mode";
      } else {
         $url .= "?$mode";
      }
      if ($id) {
         $url .= ".$id";
      }
      $url .= "'>";
      return $url;
   }

   /**
    * Load the appropriate template
    */
   function getTemplate($yellowpages=false) {
      global $ypSection, $pref;

      // Default
      $template = YELP_PLUGIN_DIR."templates/yellowpages_default_template.php";

      // Global
      if (file_exists(YELP_PLUGIN_DIR."/templates/yellowpages_".$pref["yellowpages_global_template"]."_template.php")){
         $template = YELP_PLUGIN_DIR."templates/yellowpages_".$pref["yellowpages_global_template"]."_template.php";
      }

      // Section specific
      if ($ypSection && file_exists(YELP_TEMPLATES_DIR."yellowpages_".$ypSection->getTemplate()."_template.php")){
         $template = YELP_TEMPLATES_DIR."yellowpages_".$ypSection->getTemplate()."_template.php";
      }

      return $template;
   }

   /**
    * Formatting for the categories drop down list in admin section
    */
   function yellCategoryFormatDropDown($row) {
      return $row["yell_cat_parent_id"] ? "->".$row["yell_cat_name"] : $row["yell_cat_name"];
   }

   /**
    * Format admin page App List Templates drop down
    */
   function formatTemplatesDropDown($params) {
      $templates = array();
      // TODO get templates from theme folder too?
      $handle = opendir(YELP_TEMPLATES_DIR);
      while ($file = readdir($handle)) {
         if (preg_match_all("/^yellowpages_(.*)_template\.php$/", $file, $match) != false) {
            unset($auc_template_name);
            include(YELP_TEMPLATES_DIR.$file);
            if (isset($auc_template_name)) {
               $templates[$match[1][0]] = array($match[1][0], $auc_template_name);
            } else {
               $templates[$match[1][0]] = array($match[1][0], $match[1][0]);
            }
         }
      }
      closedir($handle);
      return $templates;
    }
}

// An global instance of the yellowpages class
global $yelp;
$yelp = new yellowpages();
?>