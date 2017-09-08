<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_class.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include simple_content handlers
require_once(e_PLUGIN."simple_content/handlers/scontent_constants.php");

// Data Access Objects
require_once(SCONTENTC_HANDLERS_DIR."scontent_DAO.php");

// Model objects
require_once(SCONTENTC_HANDLERS_DIR."scontent_group.php");
require_once(SCONTENTC_HANDLERS_DIR."scontent_category.php");
require_once(SCONTENTC_HANDLERS_DIR."scontent_item.php");
require_once(SCONTENTC_HANDLERS_DIR."scontent_user.php");

// Warning and error handling
require_once(SCONTENTC_HANDLERS_DIR."scontent_status_info.php");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://plugins.e107.org'>http://plugins.e107.org</a> and try this plugin again.</p>";
   exit;
}

// Include JSHelper stuff
if (isset($pref['plug_installed']['jshelpers'])) {
   require_once(e_PLUGIN."jshelpers/jshelper.php");
   global $jshelper;
   $jshelper->js_require(JSHELPER_PROTOTYPE);
}
$footer_js[] = SCONTENTC_PLUGIN_DIR."scontent.js";

// Load the shortcodes file - template will be loaded when we know which template to load
require_once(SCONTENTC_PLUGIN_DIR."scontent_shortcodes.php");

/**
 * Class used to control all page generation and workflow aspects of simple_content
 */
class SimpleContent {
   // URL parameters (array)
   var $url;
   // Main data Access Object
   var $dao;

   /**
    * Constructor
    */
   function SimpleContent() {
      global $dao;
      $dao = $this->getDAO();

      // Process URL parameters only if on the Simple Content page itself
      if (strpos(e_SELF, "scontent.php") > 0) { //TODO fix this test
         // Non-admin processing      
         $q = explode(".", e_QUERY);
         // Get data up front where appropriate
         $sc_group = varset(urldecode($q[SCONTENTC_GROUP]), false);
         $sc_cat   = varset(urldecode($q[SCONTENTC_CATEGORY]), false);
         $sc_item  = varset(urldecode($q[SCONTENTC_ITEM]), false);
         cachevars(SCONTENTC_CACHE_ID_PAGE, SCONTENTC_PAGE_GROUPS);
				 
         if ($sc_group) {
            $sc_group = $dao->getGroup($sc_group);
            if ($sc_cat) {
               $sc_cat = $dao->getCategory($sc_cat);
               if($sc_cat)  {
	               if ($sc_item) {
	                  $sc_item = $dao->getItem($sc_item);
	                  cachevars(SCONTENTC_CACHE_ID_ITEM_CHILDREN, $dao->getRelatedItems($sc_item->getID()));
	                  cachevars(SCONTENTC_CACHE_ID_PAGE, SCONTENTC_PAGE_ITEM);
	               } else {
	                  $sc_item = $dao->getItems($sc_cat->getID());
	                  cachevars(SCONTENTC_CACHE_ID_PAGE, SCONTENTC_PAGE_ITEMS);
	               }
               }
            } else {
               $sc_cat = $dao->getCategories($sc_group->getID());
               cachevars(SCONTENTC_CACHE_ID_PAGE, SCONTENTC_PAGE_CATEGORIES);
            }
         } else {
            $sc_group = $dao->getGroups();
         }
         //debug($sc_group);
         //debug($sc_cat);
         //debug($sc_item);
         cachevars(SCONTENTC_CACHE_ID_GROUP, $sc_group);
         cachevars(SCONTENTC_CACHE_ID_CATEGORY,   $sc_cat);
         cachevars(SCONTENTC_CACHE_ID_ITEM,  $sc_item);
      }
   }

   /**
    * Get the page based on URL parameters
    */
   function generatePage() {
      global $dao, $ns, $pref, $tp;
      $page = getcachedvars(SCONTENTC_CACHE_ID_PAGE);

      // TODO would be better shortcoded?
      if ($pref["scontent_allow_homepage"]) {
         $pagetitle = "<a href='".SCONTENTC_SELF."'>".$pref["simple_content_pagetitle"]."</a>";
         $pagetitle .= ($page==SCONTENTC_PAGE_GROUPS) ? "" : $pref["simple_content_separator"];
      } else {
         $pagetitle = "";
      }

      switch ($page) {
         case SCONTENTC_PAGE_CATEGORIES : {
            $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
            $pagetitle .= $sc_group->getName();
            $text = $this->generateCategoryList();
            break;
         }
         case SCONTENTC_PAGE_ITEMS : {
            $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
            $correcturl =  str_replace(' ', '+', $sc_group->getName());
            $pagetitle .= "<a href='".SCONTENTC_SELF."?".$correcturl."'>".$sc_group->getName()."</a>";;
            $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
            $pagetitle .= $pref["simple_content_separator"].$sc_cat->getName();
            $text = $this->generateItemList();
            break;
         }
         case SCONTENTC_PAGE_ITEM : {
            $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
            $correcturl =  str_replace(' ', '+', $sc_group->getName());
            $pagetitle .= "<a href='".SCONTENTC_SELF."?".$correcturl."'>".$sc_group->getName()."</a>";;
            $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
            $correcturl2 =  str_replace(' ', '+', $sc_cat->getName());
            $pagetitle .= $pref["simple_content_separator"]."<a href='".SCONTENTC_SELF."?".$correcturl.".".$correcturl2."'>".$sc_cat->getName()."</a>";;
            $sc_item = getcachedvars(SCONTENTC_CACHE_ID_ITEM);
            $pagetitle .= $pref["simple_content_separator"].$sc_item->getName();
            $text = $this->generateItem();
            break;
         }
         default : {
            if ($pref["scontent_allow_homepage"]==1) {
               $text = $this->generateGroupList();
            }
         }
      }

      define("e_PAGETITLE", $tp->toRss($pagetitle, false));

      return(array($pagetitle, $text));
   }

   // *********************************************************************************************
   // Front end pages
   // *********************************************************************************************

   /**
    * Get the group list
    */
   function generateGroupList() {
      global $pref, $tp;

      $sc_groups = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
      require_once($pref["simple_content_template"]);

      $list = $tp->parseTemplate($SCONTENT_GROUP_LIST_HEAD, FALSE, $scontent_shortcodes);
      if (count($sc_groups) > 0) {
         foreach($sc_groups as $sc_group) {
            cachevars(SCONTENTC_CACHE_ID_GROUP, $sc_group);
            $list .= $tp->parseTemplate($SCONTENT_GROUP_LIST_BODY, FALSE, $scontent_shortcodes);
         }
      } else {
         $list .= $tp->parseTemplate($SCONTENT_GROUP_LIST_EMPTY, FALSE, $scontent_shortcodes);
      }
      $list .= $tp->parseTemplate($SCONTENT_GROUP_LIST_FOOT, FALSE, $scontent_shortcodes);
      return $list;
   }

   /**
    * Get the category list
    */
   function generateCategoryList() {
      global $pref, $tp;

      $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
      $sc_cats = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
      if (count($sc_cats) > 0) {
         require_once($sc_group->getTemplate());
         $list = $tp->parseTemplate($SCONTENT_CATEGORY_LIST_HEAD, FALSE, $scontent_shortcodes);
         foreach($sc_cats as $sc_cat) {
            cachevars(SCONTENTC_CACHE_ID_CATEGORY, $sc_cat);
            $list .= $tp->parseTemplate($SCONTENT_CATEGORY_LIST_BODY, FALSE, $scontent_shortcodes);
         }
      } else {
         require_once($pref["simple_content_template"]);
         $list .= $tp->parseTemplate($SCONTENT_CATEGORY_LIST_EMPTY, FALSE, $scontent_shortcodes);
      }
      $list .= $tp->parseTemplate($SCONTENT_CATEGORY_LIST_FOOT, FALSE, $scontent_shortcodes);
      return $list;
   }

   /**
    * Get the item list
    */
   function generateItemList() {
      global $pref, $tp;

      $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
      $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
      $sc_items = getcachedvars(SCONTENTC_CACHE_ID_ITEM);
      require_once($sc_group->getTemplate());

      $list = $tp->parseTemplate($SCONTENT_ITEM_LIST_HEAD, FALSE, $scontent_shortcodes);
      if (count($sc_items) > 0) {
         foreach($sc_items as $sc_item) {
            cachevars(SCONTENTC_CACHE_ID_ITEM, $sc_item);
            $list .= $tp->parseTemplate($SCONTENT_ITEM_LIST_BODY, FALSE, $scontent_shortcodes);
         }
      } else {
         $list .= $tp->parseTemplate($SCONTENT_ITEM_LIST_EMPTY, FALSE, $scontent_shortcodes);
      }
      $list .= $tp->parseTemplate($SCONTENT_ITEM_LIST_FOOT, FALSE, $scontent_shortcodes);
      return $list;
   }

   /**
    * Get the item
    */
   function generateItem() {
      global $pref, $tp;

      $sc_group = getcachedvars(SCONTENTC_CACHE_ID_GROUP);
      $sc_cat = getcachedvars(SCONTENTC_CACHE_ID_CATEGORY);
      $sc_item = getcachedvars(SCONTENTC_CACHE_ID_ITEM);
      $sc_children = getcachedvars(SCONTENTC_CACHE_ID_ITEM_CHILDREN);
      require_once($sc_group->getTemplate());

      $text .= $tp->parseTemplate($SCONTENT_ITEM_HEAD, FALSE, $scontent_shortcodes);
      $text .= $tp->parseTemplate($SCONTENT_ITEM_BODY, FALSE, $scontent_shortcodes);
      $text .= $tp->parseTemplate($SCONTENT_ITEM_FOOT, FALSE, $scontent_shortcodes);

      $text .= $tp->parseTemplate($SCONTENT_RELATED_LIST_HEAD, FALSE, $scontent_shortcodes);
      if (count($sc_children) > 0) {
         foreach($sc_children as $sc_item) {
            //debug($sc_item);
            cachevars(SCONTENTC_CACHE_ID_CATEGORY, $sc_item->getCategory());
            cachevars(SCONTENTC_CACHE_ID_ITEM, $sc_item);
            $text .= $tp->parseTemplate($SCONTENT_RELATED_LIST_BODY, FALSE, $scontent_shortcodes);
         }
      } else {
         $text .= $tp->parseTemplate($SCONTENT_RELATED_LIST_EMPTY, FALSE, $scontent_shortcodes);
      }
      $text .= $tp->parseTemplate($SCONTENT_RELATED_LIST_FOOT, FALSE, $scontent_shortcodes);

      return $text;
   }

   /**
    * Get a reference to the DAO object
    */
   function getDAO() {
      if (!isset($this->dao)) {
         $this->dao = new simple_contentDAO();
      }
      return $this->dao;
   }

   /**
    * Templates list for admin pages
    */
   function formatTemplatesDropDown($params) {
      global $e107Helper;
      return $e107Helper->getTemplateList("scontent", $pluginname="simple_content");
    }

   // *********************************************************************************************
   // Menus
   // *********************************************************************************************

   /**
    * Public menu function
    * @param $which the menu to get - use SCONTENTC_MENU_* constants
    */
   function getMenu($which=SCONTENTC_MENU_SUMMARY) {
      global $auc, $auclist, $lot, $lotlist, $bidlist, $dao, $aucUser, $tp;
      global $auc_shortcodes, $SCONTENT_MENU_HEAD, $SCONTENT_MENU_BODY, $SCONTENT_MENU_FOOT;
      $dao = $this->getDAO();
      $title = SCONTENT_LAN_AUCTION;
      $auclist = $dao->getSimpleContentList();
      $text = "";
      require_once($this->getTemplate($auc));
      foreach ($auclist as $auc) {
         if ($auc->isOpen()) {
            $text .= $tp->parseTemplate($SCONTENT_MENU_HEAD, FALSE, $auc_shortcodes);
            $lotlist = $dao->getLotList($auc->getId(), true);
            foreach ($lotlist as $lot) {
               $bidlist = $dao->getBidList($lot->getId(), true);
               $text .= $tp->parseTemplate($SCONTENT_MENU_BODY, FALSE, $auc_shortcodes);
            }
            $text .= $tp->parseTemplate($SCONTENT_MENU_FOOT, FALSE, $auc_shortcodes);
         }
      }
      return array($title, $text);
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $scontent_adminmenu, $pageid;
      show_admin_menu(SCONTENT_LAN_SIMPLE_CONTENT, $pageid, $scontent_adminmenu);
     // echo "<br/><div class='forumheader'>".SCONTENT_LAN_ADMIN_ITEM_FIELDS."<div class='forumheader3 smalltext' id='fieldLabels'></div></div>";
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $scontent_adminmenu, $pageid, $pref, $e107HelperForm;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = SCONTENT_LAN_SIMPLE_CONTENT.$pref["simple_content_separator"].$scontent_adminmenu["SCONTENTC_ADMIN_PAGE_".$pageid]["text"];
      if ($scontent_adminmenu["SCONTENTC_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "SCONTENTC_ADMIN_PAGE_".e_QUERY : "SCONTENTC_ADMIN_PAGE_10";
      return array($title, $text);
   }

   function getAdminHelp() {
      global $scontent_adminmenu, $pageid, $ns;
      $pageid = e_QUERY ? e_QUERY : 10;
			if (strpos(e_QUERY, 'mode=cats') !== false)  $pageid = 20;
			elseif(strpos(e_QUERY, 'mode=items') !== false) $pageid = 20;
			elseif(strpos(e_QUERY, 'mode=groups') !== false) $pageid = 30;	
			elseif(strpos(e_QUERY, 'mode=relationships') !== false) $pageid = 40;		
      $text = "";
      $count = 1;
      while (defined("SCONTENT_LAN_ADMIN_HELP_{$pageid}_TEXT_".$count)) {
         $text .= constant("SCONTENT_LAN_ADMIN_HELP_{$pageid}_TEXT_".$count)."<br /><br />";
         $count++;
      };

      $ns -> tablerender(SCONTENT_LAN_ADMIN_HELP." ".$scontent_adminmenu["SCONTENTC_ADMIN_PAGE_".e_QUERY]["text"], $text);
   }

   function adminItemsItemList($row) {
    
      $cat = $this->dao->getCategory($row["scontent_item_cat_id"]);    
			return $row["scontent_item_name"]." (".$cat->getName().")";
   }
   function adminRelationshipsItemList($row) {
      $parent = $this->dao->getItem($row["scontent_rel_parent_item_id"]);
      $child = $this->dao->getItem($row["scontent_rel_child_item_id"]);
      return $parent->getName()." - ".$child->getName();
   }
   function getCurrentDatestamp() {
      return time();
   }
}

// An global instance of the simple_content class
global $SimpleContent;
$SimpleContent = new SimpleContent();
?>