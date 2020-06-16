<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_class.php,v $
| $Revision: 1.1.2.27 $
| $Date: 2006/12/10 14:51:17 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include bugtracker handlers
require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_constants.php");

// Data Access Objects
require_once(BUGC_HANDLERS_DIR."/bugtracker3_DAO.php");

// Model objects
require_once(BUGC_HANDLERS_DIR."/bugtracker3_app.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_app_version.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_bug.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_category.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_developer_comments.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_filter.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_priority.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_resolution.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_relationship.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_status.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_user.php");

// Warning and error handling
require_once(BUGC_HANDLERS_DIR."/bugtracker3_status_info.php");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://e107coders.org'>http://e107coders.org</a> and try this plugin again.</p>";
   exit;
}

// Load the shortcodes file - template will be loaded when we know which template to load
require_once(BUGC_PLUGIN_DIR."/bugtracker3_shortcodes.php");

/**
 * Class used to control all page generation and workflow aspects of bugtracker3
 */
class bugtracker3 {
   // URL parameters (array)
   var $url;
   // Main data Access Object
   var $dao;

   /**
    * Constructor
    */
   function bugtracker3() {
      global $app, $bug;
      $dao = $this->getDAO();

      // Get individual URL parameters, if any, if viewing Bugtracker page
      if (basename(e_SELF) == basename(BUGC_SELF) && e_QUERY){
      	// Seperate the url parameters - format is mode.id
      	$this->url = explode(".", e_QUERY);

         // Get app and bug up front where appropriate
         switch ($this->getMode()) {
            case BUGC_BUGS_PAGE :
            case BUGC_SUBMIT_BUG_PAGE :
            case BUGC_STATS_PAGE :
               $app = $dao->getApp($this->getId());
               break;
            case BUGC_BUG_PAGE :
            case BUGC_EDIT_BUG_PAGE :
            case BUGC_MOVE_BUG_PAGE :
               $bug = $dao->getBug($this->getId());
               $app = $dao->getApp($bug->getApplicationId());
               break;
         }
      }

      // Check for filter being set and handle here
      if (false !== $this->getFilter()) {
         $dao->updateUserFilter($this->getFilter());
         if (E107_DEBUG_LEVEL == 0 && !varset($_REQUEST["ajax"], false)) {
            header("location:".e_SELF."?".$this->getMode().".".$this->getId());
         }
         exit;
      }
   }

   /**
    * Get a reference to the DAO object
    */
   function getDAO() {
      if (!isset($this->dao)) {
         $this->dao = new bugtracker3DAO();
      }
      return $this->dao;
   }

   /**
    * Get the mode that Bugtracker3 is running in
    */
   function getMode() {
      return $this->url[BUGC_MODE];
   }

   /**
    * Get the URL ID parameter
    */
   function getId() {
      return $this->url[BUGC_ID];
   }

   /**
    * Get the filter parameter
    */
   function getFilter() {
      return isset($this->url[BUGC_FILTER]) ? $this->url[BUGC_FILTER] : false;
   }

   /**
    * Get the page based on URL parameters
    */
   function generatePage() {
      global $app, $bug, $bugtracker3User, $dao, $ns, $pref, $tp;
      $dao = $this->getDAO();

      // TODO would be better shortcoded?
      if (varset($pref["bugtracker3_ajax"], false)) {
         $pagetitle = "<a href='#' onclick='bugtracker3Helper.queryURL(\"\");'>".$pref["bugtracker3_pagetitle"]."</a>";
      } else {
         $pagetitle = "<a href='".BUGC_SELF."'>".$pref["bugtracker3_pagetitle"]."</a>";
      }

      switch ($this->getMode()) {
         case BUGC_BUGS_PAGE : {
            if (varset($pref["bugtracker3_ajax"], false)) {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$app->getId()."\");'>".$app->getName()."</a>";
            } else {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
            }
            $pagetitle .= $pref["bugtracker3_separator"];
            $pagetitle .= ($app->getType() == BUGC_APP_TYPE_FEATURES) ? BUG_LAN_FEATURES_PAGE_NAME : BUG_LAN_BUGS_PAGE_NAME;
            $text = $this->generateBugList();
            break;
         }
         case BUGC_BUG_PAGE : {
            if (varset($pref["bugtracker3_ajax"], false)) {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$app->getId()."\");'>".$app->getName()."</a>";
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUG_PAGE.".".$bug->getId()."\");'>".$bug->getSummary(BUGC_DB, BUGC_TRUNC)."</a>";
            } else {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUG_PAGE.".".$bug->getId()."'>".$bug->getSummary(BUGC_DB, BUGC_TRUNC)."</a>";
            }
            $pagetitle .= $pref["bugtracker3_separator"];
            $pagetitle .= ($app->getType() == BUGC_APP_TYPE_FEATURES) ? BUG_LAN_VIEW_FEATURE_PAGE_NAME : BUG_LAN_VIEW_BUG_PAGE_NAME;
            $text = $this->generateBugView();
            break;
         }
         case BUGC_SUBMIT_BUG_PAGE : {
            if (varset($pref["bugtracker3_ajax"], false)) {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$app->getId()."\");'>".$app->getName()."</a>";
            } else {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
            }
            $pagetitle .= $pref["bugtracker3_separator"];
            $pagetitle .= ($app->getType() == BUGC_APP_TYPE_FEATURES) ? BUG_LAN_SUBMIT_FEATURE_PAGE_NAME : BUG_LAN_SUBMIT_BUG_PAGE_NAME;
            if (isset($_REQUEST[BUGC_POST_ARRAY])) {
               $ret = $this->bugSubmit();
               if (get_class($ret) == "bugtracker3StatusInfo") {
                  $text = $this->generateBugSubmit($ret);
               } else {
                  $bug = $dao->getBug($ret);
                  $this->checkNotifications($bug->getId(), BUG_LAN_NOTIFY_NEW, BUG_LAN_LABEL_DESCRIPTION."<br/><br/>".$bug->getDescription());
                  header("location:".e_SELF."?".BUGC_BUGS_PAGE.".".$this->getId());
                  exit;
               }
            } else {
               $text = $this->generateBugSubmit();
            }
            break;
         }
         case BUGC_EDIT_BUG_PAGE : {
            if (varset($pref["bugtracker3_ajax"], false)) {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$app->getId()."\");'>".$app->getName()."</a>";
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUG_PAGE.".".$bug->getId()."\");'>".$bug->getSummary(BUGC_DB, BUGC_TRUNC)."</a>";
            } else {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUG_PAGE.".".$bug->getId()."'>".$bug->getSummary(BUGC_DB, BUGC_TRUNC)."</a>";
            }
            $pagetitle .= $pref["bugtracker3_separator"];
            $pagetitle .= ($app->getType() == BUGC_APP_TYPE_FEATURES) ? BUG_LAN_EDIT_FEATURE_PAGE_NAME : BUG_LAN_EDIT_BUG_PAGE_NAME;
            if (isset($_REQUEST[BUGC_POST_ARRAY])) {
               $ret = $this->bugUpdate();
               if (get_class($ret) == "bugtracker3StatusInfo") {
                  $text = $this->generateBugEdit($ret);
               } else {
                  $this->checkNotifications($bug->getId(), BUG_LAN_NOTIFY_EDIT, BUG_LAN_LABEL_CHANGES."<br/><br/>".$bug->getChanges(true));
                  header("location:".e_SELF."?".BUGC_BUG_PAGE.".".$this->getId());
                  exit;
               }
            } else {
               $text = $this->generateBugEdit();
            }
            break;
         }
         case BUGC_MOVE_BUG_PAGE : {
            if (varset($pref["bugtracker3_ajax"], false)) {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$app->getId()."\");'>".$app->getName()."</a>";
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUG_PAGE.".".$bug->getId()."\")'>".$bug->getSummary(BUGC_DB, BUGC_TRUNC)."</a>";
            } else {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUG_PAGE.".".$bug->getId()."'>".$bug->getSummary(BUGC_DB, BUGC_TRUNC)."</a>";
            }
            $pagetitle .= $pref["bugtracker3_separator"].BUG_LAN_MOVE_BUG_PAGE_NAME;
            if (isset($_REQUEST[BUGC_POST_ARRAY])) {
               $text = $this->bugMove();
            } else {
               $text = $this->generateBugMove();
            }
            break;
         }
         case BUGC_FILTER_PAGE : {
            $pagetitle .= $pref["bugtracker3_separator"].BUG_LAN_FILTER_PAGE_NAME;
            $text = $this->filterView();
            break;
         }
         case BUGC_STATS_PAGE : {
            if (varset($pref["bugtracker3_ajax"], false)) {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='#' onclick='bugtracker3Helper.queryURL(\"".BUGC_BUGS_PAGE.".".$app->getId()."\");'>".$app->getName()."</a>";
            } else {
               $pagetitle .= $pref["bugtracker3_separator"]."<a href='".BUGC_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
            }
            $pagetitle .= $pref["bugtracker3_separator"].BUG_LAN_STATS_PAGE_NAME;
            $text = $this->generateStatsView();
            break;
         }
         default : {
            $pagetitle .= $pref["bugtracker3_separator"].BUG_LAN_APPS_PAGE_NAME;
            $text = $this->generateAppList();
            break;
         }
      }

      define("e_PAGETITLE", $tp->toRss($pagetitle, false));

      if ($bugtracker3User->getFilter()) {
         if ($filter = $dao->getFilter($bugtracker3User->getFilter())) {
            $pagetitle .= " <span class='smalltext'>".BUG_LAN_LABEL_CURRENT_FILTER." ".$filter->getName()."</span>";
         }
      }

      return(array($pagetitle, $text));
   }

   // *********************************************************************************************
   // Front end pages
   // *********************************************************************************************

   /**
    * Get the app list
    */
   function generateAppList() {
      global $app, $applist, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes,  $BUG3_APP_LIST_HEAD, $BUG3_APP_LIST_BODY, $BUG3_APP_LIST_FOOT;

      $dao = $this->getDAO();
      require_once($this->getTemplate());
      $applist = $dao->getAppList();
      $bugtracker3User = new bugtracker3User($applist, $dao->getUserPrefs());
      $list = "";
      $list .= $tp->parseTemplate($BUG3_APP_LIST_HEAD, FALSE, $bugtracker3_shortcodes);
      foreach ($applist as $app) {
         if ($bugtracker3User->canView($app->getId())) {
            $list .= $tp->parseTemplate($BUG3_APP_LIST_BODY, FALSE, $bugtracker3_shortcodes);
         }
      }
      $list .= $tp->parseTemplate($BUG3_APP_LIST_FOOT, FALSE, $bugtracker3_shortcodes);
      return $list;
   }

   /**
    * Get the bug list for an app
    */
   function generateBugList() {
      global $app, $bug, $buglist, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_BUG_LIST_HEAD, $BUG3_BUG_LIST_BODY, $BUG3_BUG_LIST_FOOT, $BUG3_FEATURE_LIST_HEAD, $BUG3_FEATURE_LIST_BODY, $BUG3_FEATURE_LIST_FOOT, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canView($app->getId())) {
         $buglist = $dao->getBugList($app->getId(), $bugtracker3User->getFilter());

         $head = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_LIST_HEAD, $BUG3_BUG_LIST_HEAD);
         $body = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_LIST_BODY, $BUG3_BUG_LIST_BODY);
         $foot = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_LIST_FOOT, $BUG3_BUG_LIST_FOOT);

         $list = "";
         $list .= $tp->parseTemplate($head, FALSE, $bugtracker3_shortcodes);
         foreach ($buglist as $bug) {
            $list .= $tp->parseTemplate($body, FALSE, $bugtracker3_shortcodes);
         }
         $list .= $tp->parseTemplate($foot, FALSE, $bugtracker3_shortcodes);
      } else {
         $list .= $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
      return $list;
   }

   /**
    * Get a specific bug
    */
   function generateBugView() {
      global $app, $bug, $buglist, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_BUG_VIEW, $BUG3_FEATURE_VIEW, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canView($app->getId())) {
         $view = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_VIEW, $BUG3_BUG_VIEW);
         return $tp->parseTemplate($view, FALSE, $bugtracker3_shortcodes);
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Submit a bug
    * @param $statusInfo statusInfo object for reporting warnings and errors
    */
   function generateBugSubmit($statusInfo=false) {
      global $app, $bug, $buglist, $dao, $bugtracker3User, $bugStatusInfo, $tp;
      global $bugtracker3_shortcodes, $BUG3_BUG_SUBMIT_VIEW, $BUG3_FEATURE_SUBMIT_VIEW, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canPost($app->getId())) {
         $bugStatusInfo = $statusInfo;
         $bug = new bugtracker3Bug(false, $_REQUEST[BUGC_POST_ARRAY], $app);
         $view = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_SUBMIT_VIEW, $BUG3_BUG_SUBMIT_VIEW);
         return $tp->parseTemplate($view, FALSE, $bugtracker3_shortcodes);
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Submit a new bug
    */
   function bugSubmit() {
      global $app, $bug, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canPost($app->getId())) {
         $bug = new bugtracker3Bug(null, $_REQUEST[BUGC_POST_ARRAY], $app);
         if ($statusInfo = $bug->validateMe()) {
            return $statusInfo;
         }
         return $dao->submitBug($app, $bug);
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Edit a bug
    * @param $bugid      ID of bug to be edited
    * @param $statusInfo statusInfo object for reporting warnings and errors
    */
   function generateBugEdit($statusInfo=false) {
      global $app, $bug, $buglist, $dao, $bugtracker3User, $bugStatusInfo, $tp;
      global $bugtracker3_shortcodes, $BUG3_BUG_EDIT_VIEW, $BUG3_FEATURE_EDIT_VIEW, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canEdit($app->getId())) {
         $bugStatusInfo = $statusInfo;
         $bug->setUI($_REQUEST[BUGC_POST_ARRAY]);
         $view = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_EDIT_VIEW, $BUG3_BUG_EDIT_VIEW);
         return $tp->parseTemplate($view, FALSE, $bugtracker3_shortcodes);
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Update a bug
    */
   function bugUpdate() {
      global $app, $bug, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canEdit($app->getId())) {
         $bug->setUI($_REQUEST[BUGC_POST_ARRAY]);
         if ($statusInfo = $bug->validateMe()) {
            return $statusInfo;
         } else {
            return $dao->updateBug($bug);
         }
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Move a bug between applications
    * @param $bugid      ID of bug to be moved
    * @param $statusInfo statusInfo object for reporting warnings and errors
    */
   function generateBugMove($statusInfo=false) {
      global $app, $bug, $buglist, $dao, $bugtracker3User, $bugStatusInfo, $tp;
      global $bugtracker3_shortcodes, $BUG3_BUG_MOVE_VIEW, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canEdit($app->getId())) {
         $bugStatusInfo = $statusInfo;
         $bug->setUI($_REQUEST[BUGC_POST_ARRAY]);
         $view = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_MOVE_VIEW, $BUG3_BUG_MOVE_VIEW);
         return $tp->parseTemplate($view, FALSE, $bugtracker3_shortcodes);
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Move a bug
    * This is only part 1 of the move, an application has been selected to move the big to.
    * Need to get the user to confirm other details are OK as some fields (e.g. category, priority, etc.)
    * may no longer be applicable to the new application.
    * So all we do is update the bugs application ID and display the edit bug form.
    */
   function bugMove() {
      global $app, $bug, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_BUG_EDIT_VIEW, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bug->setUI($_REQUEST[BUGC_POST_ARRAY]);
      $app = $dao->getApp($bug->getApplicationId(BUGC_UI));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      if ($bugtracker3User->canEdit($app->getId())) {
         $view = $this->getTemplateString($app, BUGC_APP_TYPE_FEATURES, $BUG3_FEATURE_EDIT_VIEW, $BUG3_BUG_EDIT_VIEW);
         return $tp->parseTemplate($view, FALSE, $bugtracker3_shortcodes);
      } else {
         return $tp->parseTemplate($BUG3_NAV_ERROR, FALSE, $bugtracker3_shortcodes);
      }
   }

   /**
    * Statistics view for an application
    */
   function generateStatsView() {
      global $app, $dao, $bugtracker3User, $bugStatusInfo, $tp, $chart;
      global $bugtracker3_shortcodes;
      $dao = $this->getDAO();
      require_once($this->getTemplate($app));
      $bugtracker3User = new bugtracker3User($app, $dao->getUserPrefs());
      $ret = $this->generateStatsFiles($app);
      if (get_class($ret) == "bugtracker3StatusInfo") {
         $bugStatusInfo = $ret;
      }
      $text = $tp->parseTemplate($BUG3_APP_CHART_HEAD, FALSE, $bugtracker3_shortcodes);
      $text .= $tp->parseTemplate($BUG3_APP_CHART_BODY, FALSE, $bugtracker3_shortcodes);
      $text .= $tp->parseTemplate($BUG3_APP_CHART_FOOT, FALSE, $bugtracker3_shortcodes);
      return $text;
   }

   /**
    * Statistics files for an application
    */
   function generateStatsFiles($app) {
      global $bugStatusInfo;
      $statusInfo = new bugtracker3StatusInfo();

      $list = $app->getCategoryList();
      $filename = "charts/stats_category_".$app->getId();
      if (!$this->generateStatsFile(BUG_LAN_LABEL_CATEGORIES, $filename, $list)) {
         $statusInfo->addMessage(BUG_LAN_MSG_STATS_FILE_FAILURE, $filename);
      }

      $list = $app->getPriorityList();
      $filename = "charts/stats_priority_".$app->getId();
      if (!$this->generateStatsFile(BUG_LAN_LABEL_PRIORITIES, $filename, $list)) {
         $statusInfo->addMessage(BUG_LAN_MSG_STATS_FILE_FAILURE, $filename);
      }

      $list = $app->getResolutionList();
      $filename = "charts/stats_resolution_".$app->getId();
      if (!$this->generateStatsFile(BUG_LAN_LABEL_RESOLUTIONS, $filename, $list)) {
         $statusInfo->addMessage(BUG_LAN_MSG_STATS_FILE_FAILURE, $filename);
      }

      $list = $app->getStatusList();
      $filename = "charts/stats_status_".$app->getId();
      if (!$this->generateStatsFile(BUG_LAN_LABEL_STATUSES, $filename, $list )) {
         $statusInfo->addMessage(BUG_LAN_MSG_STATS_FILE_FAILURE, $filename);
      }

      if ($statusInfo->getMessageCount() > 0) {
         return $statusInfo;
      }

      return false;
   }

   /**
    * Statistics file for an application
    */
   function generateStatsFile($title, $filename, $list) {
      $statusInfo = new bugtracker3StatusInfo();

      $data = "<chart><chart_type>3d pie</chart_type>";
      $data .= "<chart_data><row><null/>";
      foreach ($list as $item) {
         if ($item->getCount() > 0) {
            $data .= "<string>".$item->getName()."</string>";
         }
      }
      $data .= "</row><row><null/>";
      foreach ($list as $item) {
         if ($item->getCount() > 0) {
            $data .= "<number>".$item->getCount()."</number>";
         }
      }
      $data .= "</row></chart_data>";
      $data .= "<chart_rect positive_color='ffffff' positive_alpha='20' />";
      $data .= "<chart_value as_percentage='true' />";
      $data .= "<draw><text color='ffffff' width='400' height='20' text='".$title."' h_align='center' v_align='bottom' /></draw>";
      $data .= "<legend_label alpha='75' />";
      $data .= "<legend_rect width='100' fill_alpha='10' />";
      $data .= "<legend_transition type='slide_left' delay='0.5' duration='1' />";
      $data .= "</chart>";
      if (!file_put_contents("$filename.xml", $data)) {
         return false;
      }

      return true;
   }

   /**
    * Filter options page
    */
   function filterView() {
      global $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_FILTER_VIEW, $BUG3_NAV_ERROR;
      $dao = $this->getDAO();
      require_once($this->getTemplate());
      $applist = $dao->getAppList();
      $bugtracker3User = new bugtracker3User($applist, $dao->getUserPrefs());
      return $tp->parseTemplate($BUG3_FILTER_VIEW, FALSE, $bugtracker3_shortcodes);
   }

   // *********************************************************************************************
   // Menus
   // *********************************************************************************************

   /**
    * Public menu function
    * @param $which the menu to get - use BUGC_MENU_* constants
    */
   function getMenu($which=BUGC_MENU_SUMMARY) {
      global $app, $bug, $dao, $bugtracker3User, $tp;
      global $bugtracker3_shortcodes, $BUG3_MENU_APPLICATION, $BUG3_MENU_SUMMARY;
      $dao = $this->getDAO();
      require_once($this->getMenuTemplate());
      $title = $tp->parseTemplate("{{$which}_TITLE}", FALSE, $bugtracker3_shortcodes);
      $text = $tp->parseTemplate($$which, FALSE, $bugtracker3_shortcodes);
      if ($this->_isAppPage()) {
         $which = BUGC_MENU_APPLICATION;
         $text .= $tp->parseTemplate($$which, FALSE, $bugtracker3_shortcodes);
      }
      return array($title, $text);
   }

   function _isAppPage() {
      $app_pages = array(
                     BUGC_BUGS_PAGE,
                     BUGC_BUG_PAGE,
                     BUGC_SUBMIT_BUG_PAGE,
                     BUGC_EDIT_BUG_PAGE,
                     BUGC_MOVE_BUG_PAGE,
                     BUGC_STATS_PAGE
                   );
      return in_array($this->getMode(), $app_pages);
   }

   function getCategoriesFilter() {
      $dao = $this->getDAO();
      return $dao->getCategoriesFilter();
   }
   function getPrioritiesFilter() {
      $dao = $this->getDAO();
      return $dao->getPrioritiesFilter();
   }
   function getStatusesFilter() {
      $dao = $this->getDAO();
      return $dao->getStatusesFilter();
   }
   function getResolutionsFilter() {
      $dao = $this->getDAO();
      return $dao->getResolutionsFilter();
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $bug3_adminmenu, $pageid;
      show_admin_menu(BUG_LAN_BUGTRACKER, $pageid, $bug3_adminmenu);
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $bug3_adminmenu, $pageid, $e107HelperForm;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = BUG_LAN_BUGTRACKER." :: ".$bug3_adminmenu["BUGC_ADMIN_PAGE_".$pageid]["text"];
      if ($bug3_adminmenu["BUGC_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "BUGC_ADMIN_PAGE_".e_QUERY : "BUGC_ADMIN_PAGE_10";
      return array($title, $text);
   }

   /**
    * Format admin page Application Version drop down item selection
    */
   function formatAppVersionsItemSelection($row) {
      $dao = $this->getDAO();
      $app = $dao->getApp($row["bugtracker3_appver_app_id"]);
      return $app->getName()." - ".$row["bugtracker3_appver_version"];
   }

   /**
    * Format admin page App List Templates drop down
    */
   function formatTemplatesDropDown($params) {
      $templates = array();
      switch ($params["templatetype"]) {
         case BUG3_ADMIN_TEMPLATE_TYPE_APP : {
            $templates['0'] = array('0', BUG3_ADMIN_TEMPLATE_TYPE_USE_GLOBAL);
         }
         case BUG3_ADMIN_TEMPLATE_TYPE_APPS : {
            // TODO get templates from theme folder too?
            $folder = e_PLUGIN."bugtracker3/templates/";
            $handle = opendir($folder);
            while ($file = readdir($handle)) {
               if (preg_match_all("/^bugtracker3_(.*)[^menu]_template\.php$/", $file, $match) != false) {
                  unset($bt3_template_name);
                  include($folder.$file);
                  if (isset($bt3_template_name)) {
                     $templates[$match[1][0]] = array($match[1][0], $bt3_template_name);
                  } else {
                     $templates[$match[1][0]] = array($match[1][0], $match[1][0]);
                  }
               }
            }
            closedir($handle);
            break;
         }
      }
      return $templates;
    }

   /**
    * Format admin page Apps Version drop down
    */
   function bugtracker3FormatAppsOwnerDropDown($params) {
      global $sql;
      $owners = array();
      if ($params["includeblank"]) {
         $owners[] = array(0, BUG_LAN_LABEL_FILTER_OWNER_ALL);
      }
      if ($params["currentuser"]) {
         $owners[] = array(-1, BUG_LAN_LABEL_FILTER_OWNER_CURRENT);
      }
      if ($sql->db_Select("user", "user_id, user_name, user_login")) {
         while ($row = $sql->db_Fetch()) {
            $owners[] = array($row["user_id"], $row["user_name"]." (".$row["user_login"].")");
         }
      }
      return $owners;
   }

   /**
    * Formats a row for the Filter item selection dropdown
    * @return the text to be displayed in the drop down for this item
    */
   function bugtracker3FormatFilterItemSelection($row) {
      $filter = new bugtracker3Filter($row);
      $text = "";
      $text .= $filter->getName();
      return $text;
   }

   /**
    * Generate the where clause for the Filters drop down item selection
    * @return the SQl where clause
    */
   function bugtracker3FormatFilterItemSelectionWhere() {
      if (ADMIN) {
         // Admins can edit their own filters and all publiuc filters
         return "bugtracker3_filter_owner=".USERID." or bugtracker3_filter_public=1";
      } else {
         // Others can only edit their own filters (some of which may have been made public)
         return "bugtracker3_filter_owner=".USERID;
      }
   }

   /**
    * Load the appropriate template
    */
   function getTemplate($app=false) {
      global $pref;

      // Default
      $template = BUGC_PLUGIN_DIR."templates/bugtracker3_default_template.php";

      // Global
      if (file_exists(BUGC_PLUGIN_DIR."/templates/bugtracker3_".$pref["bugtracker3_global_template"]."_template.php")){
         $template = BUGC_PLUGIN_DIR."templates/bugtracker3_".$pref["bugtracker3_global_template"]."_template.php";
      }

      // Application specific
      if (false != $app && file_exists(BUGC_PLUGIN_DIR."/templates/bugtracker3_".$app->getTemplate()."_template.php")){
         $template = BUGC_PLUGIN_DIR."templates/bugtracker3_".$app->getTemplate()."_template.php";
      }

      return $template;
   }

   /**
    * Load the appropriate menu template
    */
   function getMenuTemplate($app=false) {
      global $pref;

      // Default
      $template = BUGC_PLUGIN_DIR."templates/bugtracker3_default_menu_template.php";

      // Global
      if (file_exists(BUGC_PLUGIN_DIR."/templates/bugtracker3_".$pref["bugtracker3_global_menu_template"]."_menu_template.php")){
         $template = BUGC_PLUGIN_DIR."templates/bugtracker3_".$pref["bugtracker3_global_menu_template"]."_menu_template.php";
      }

      // Application specific
      if (false != $app && file_exists(BUGC_PLUGIN_DIR."/templates/bugtracker3_".$app->getMenuTemplate()."_menu_template.php")){
         $template = BUGC_PLUGIN_DIR."templates/bugtracker3_".$app->getMenuTemplate()."_menu_template.php";
      }

      return $template;
   }

   /**
    * Get the correct template string for an application
    */
   function getTemplateString($app, $type, $string, $default) {
      return $app->getType() == $type && isset($string) ? $string : $default;
   }

   /**
    * Check if any notifications are to be sent
    * @bugid if of the bug notifications are for (all notifications are for bug based processing)
    * @type  the notification type, use BUGC_LAN_NOTIFY_* constants
    */
   function checkNotifications($bugid, $type, $additionalinfo="") {
      global $app, $bug, $dao, $e107Helper, $pref;

      $bug = $dao->getBug($bugid);

      switch ($type) {
         case BUG_LAN_NOTIFY_NEW : {
            $this->_notify(BUG_LAN_NOTIFY_NEW, BUG_LAN_NOTIFY_NEW_MESSAGE, $pref["bugtracker3_notify_owner_new"], $pref["bugtracker3_notify_poster_new"], $additionalinfo);
            break;
		   }
         case BUG_LAN_NOTIFY_EDIT : {
            $this->_notify(BUG_LAN_NOTIFY_EDIT, BUG_LAN_NOTIFY_EDIT_MESSAGE, $pref["bugtracker3_notify_owner_edit"], $pref["bugtracker3_notify_poster_edit"], $additionalinfo);
            break;
		   }
         case BUG_LAN_NOTIFY_COMMENT : {
            $this->_notify(BUG_LAN_NOTIFY_COMMENT, BUG_LAN_NOTIFY_COMMENT_MESSAGE, $pref["bugtracker3_notify_owner_comment"], $pref["bugtracker3_notify_poster_comment"], $additionalinfo);
            break;
		   }
         case BUG_LAN_NOTIFY_DEV_COMMENT : {
            $this->_notify(BUG_LAN_NOTIFY_DEV_COMMENT, BUG_LAN_NOTIFY_DEV_COMMENT_MESSAGE, $pref["bugtracker3_notify_owner_dev_comment"], $pref["bugtracker3_notify_poster_dev_comment"], $additionalinfo);
            break;
		   }
		}
   }

   function _notify($subject, $message, $ownerpref, $posterpref, $additionalinfo="") {
      global $app, $bug, $e107Helper;
      $applink = "<a href='".e_SELF."?".BUGC_BUGS_PAGE.".".$app->getId()."'>".$app->getName()."</a>";
      $buglink = "<a href='".e_SELF."?".BUGC_BUG_PAGE.".".$bug->getId()."'>".$bug->getSummary()."</a>";
      $message = str_replace("{appname}", $applink, $message);
      $message = str_replace("{bugsummary}", $buglink, $message);
      $message .= "<br/><br/>$additionalinfo";
      if ($ownerpref == BUGC_NOTIFY_KEY_1 || $ownerpref == BUGC_NOTIFY_KEY_3) {
         $e107Helper->sendNotification($app->getOwnerId(), $subject, $message, e_UC_PUBLIC);
      }
      if ($ownerpref == BUGC_NOTIFY_KEY_2 || $ownerpref == BUGC_NOTIFY_KEY_3) {
         require_once(e_HANDLER."mail.php");
         //$user = getx_user_data($app->getOwnerId());
         $user = e107::user($app->getOwnerId());
		   sendemail($user["user_email"], $subject, $message);
		}
		// Don't notify bug poster if they are the application owner
		if ($app->getOwnerId() != $bug->getPosterId()) {
         if ($posterpref == BUGC_NOTIFY_KEY_1 || $posterpref == BUGC_NOTIFY_KEY_3) {
            $e107Helper->sendNotification($bug->getPosterId(), $subject, $message, e_UC_PUBLIC);
         }
         if ($posterpref == BUGC_NOTIFY_KEY_2 || $posterpref == BUGC_NOTIFY_KEY_3) {
            require_once(e_HANDLER."mail.php");
            //$user = getx_user_data($bug->getPosterId());
            $user = e107::user($bug->getPosterId());
		      sendemail($user["user_email"], $subject, $message);
		   }
		}
	}

   function getTooltip($tttext, $caption="", $image=false) {
      global $e107Helper, $pref;
      $tt = "";
      if ($pref["bugtracker3_tooltips"]) {
         $tt = $e107Helper->getTooltip($tttext, $caption, $this->getTooltipStyles(), BUGC_TT);
         if ($image) {
            $tt = "<img align='top' style='cursor:pointer' src='".e_IMAGE."admin_images/polls_16.png'$tt/>";
         }
      }
      return $tt;
   }
   function getTooltipStyles() {
      return array(
         "caption-style"   => "font-weight:bold;text-align:center;",
         "min-width"       => "150",
         "max-width"       => "300",
      );
   }
}

// An global instance of the bugtracker3 class
global $bugtracker3;
$bugtracker3 = new bugtracker3();
?>