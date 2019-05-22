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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_app.php,v $
| $Revision: 1.1.2.10 $
| $Date: 2006/11/23 15:28:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Application
 */
class bugtracker3App {
   var $app;            // A row from the apps table
   var $bugs;           // Array of bugs belonging to this app
   var $bugcount;       // Number of bugs belonging to this app
   var $latestVersion;  // Latest version of this app
   var $categoryList;   // Array of categories (with totals) for this app
   var $priorityList;   // Array of priorities (with totals) for this app
   var $resolutionList; // Array of resolutions (with totals) for this app
   var $statusList;     // Array of statuses (with totals) for this app

   /**
    * Constructor
    * @param $app a row from the apps table
    */
   function bugtracker3App($app) {
      $this->debug = false;
      $this->app = $app;
   }

   // Getters
   function getId() {
      return $this->app["bugtracker3_apps_id"];
   }
   function getName() {
      return $this->app["bugtracker3_apps_name"];
   }
   function getIcon() {
      return $this->app["bugtracker3_apps_icon"];
   }
   function getDescription() {
      return $this->app["bugtracker3_apps_description"];
   }
   function getType() {
      return $this->app["bugtracker3_apps_type"];
   }
   function getCurrentVersion() {
      return $this->app["bugtracker3_apps_current_version"];
   }
   function getPostClass() {
      return $this->app["bugtracker3_apps_postclass"];
   }
   function getEditClass() {
      return $this->app["bugtracker3_apps_editclass"];
   }
   function getViewClass() {
      return $this->app["bugtracker3_apps_userclass"];
   }
   function getOwnerId() {
      return $this->app["bugtracker3_apps_owner"];
   }
   function getOwner() {
      $user = get_user_data($this->getOwnerId());
      return $user["user_name"];
   }
   function getCategories() {
      return $this->app["bugtracker3_apps_categories"];
   }
   function getDefaultCategory() {
      return $this->app["bugtracker3_apps_category_default"];
   }
   function getCategoryList() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->categoryList)) {
         $bugs = $dao->getBugList($this->getId());
         $this->categoryList = $dao->getCategories($this->getCategories());
         foreach ($bugs as $bug) {
            $this->categoryList[$bug->getCategoryId()]->add(1);
         }
      }
      return $this->categoryList;
   }
   function getPriorities() {
      return $this->app["bugtracker3_apps_priorities"];
   }
   function getDefaultPriority() {
      return $this->app["bugtracker3_apps_priority_default"];
   }
   function getPriorityList() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->priorityList)) {
         $bugs = $dao->getBugList($this->getId());
         $this->priorityList = $dao->getPriorities($this->getPriorities());
         foreach ($bugs as $bug) {
            $this->priorityList[$bug->getPriorityId()]->add(1);
         }
      }
      return $this->priorityList;
   }
   function getResolutions() {
      return $this->app["bugtracker3_apps_resolutions"];
   }
   function getDefaultResolution() {
      return $this->app["bugtracker3_apps_resolution_default"];
   }
   function getResolutionList() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->resolutionList)) {
         $bugs = $dao->getBugList($this->getId());
         $this->resolutionList = $dao->getResolutions($this->getResolutions());
         foreach ($bugs as $bug) {
            $this->resolutionList[$bug->getResolutionId()]->add(1);
         }
      }
      return $this->resolutionList;
   }
   function getStatuses() {
      return $this->app["bugtracker3_apps_statuses"];
   }
   function getDefaultStatus() {
      return $this->app["bugtracker3_apps_status_default"];
   }
   function getTemplate() {
      return $this->app["bugtracker3_apps_template"];
   }
   function isVisible() {
      return $this->app["bugtracker3_apps_visible"] == 1;
   }
   function canPost() {
      return $this->app["bugtracker3_apps_closed"] == 0;
   }
   function getStatusList() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->statusList)) {
         $bugs = $dao->getBugList($this->getId());
         $this->statusList = $dao->getStatuses($this->getStatuses());
         foreach ($bugs as $bug) {
            $this->statusList[$bug->getStatusId()]->add(1);
         }
      }
      return $this->statusList;
   }
   function getLatestVersion() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->latestVersion)) {
         $this->latestVersion = $dao->getLatestVersion($this->getId());
      }
      if (false !== $this->latestVersion) {
         return $this->latestVersion->getVersion();
      }
      return "";
   }
   function getBugTotal() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->bugcount)) {
  		   $this->bugcount = $dao->getBugCount($this->getId());
      }
      return $this->bugcount;
   }
}
?>