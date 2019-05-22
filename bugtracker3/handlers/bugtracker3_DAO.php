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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_DAO.php,v $
| $Revision: 1.1.2.7 $
| $Date: 2006/11/27 23:49:57 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Class used to control all database access for bugtracker3
 */
class bugtracker3DAO {
   var $bugs;        // Cached bugs list
   var $categories;  // Cached categories list
   var $priorities;  // Cached priorities list
   var $resolutions; // Cached resolutions list
   var $statuses;    // Cached statuses list
   var $versions;    // Cached versions list
   var $posters;     // Cached posters list
   var $owners;      // Cached owners list
   var $filters;     // Cached filters list

   // Switch debug options on
   var $debug;

   /**
    * Constructor
    */
   function bugtracker3DAO() {
      global $pref;

      $this->debug = false; //"now";

      // Set up some constants
      define("BUG_CACHE_APPSLIST",  "bug2_cache_apps");
      define("BUG_CACHE_BUGSLIST",  "bug2_cache_bugs");
      define("BUG_APP_INFO",        "bugtracker3_app_info");
      define("BUG_APPS_ORDER",      $pref["bugtracker3_appsorder"]);
      define("BUG_BUGS_ORDER",      "order by bugtracker3_bugs_id desc"); // TODO preference/app preference?
   }

   /**
    * Get a count of apps
    */
   function getAppCount() {
      return count($this->getAppList());
   }

   /**
    * Get a specific app
    * @param $appid  the application ID for the application to be retrieved
    */
   function getApp($appid, $getbugs=false) {
      global $sql;

      $app = false;
  		if ($res = $sql->db_Select(BUGC_APPS_TABLE, "*", "bugtracker3_apps_id=$appid", true, $this->debug)) {
         $app = new bugtracker3App($sql->db_Fetch(), $getbugs);
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $app;
   }

   /**
    * Get a list of apps
    */
   function getAppList() {
      global $sql;

      $appslist = array();
  		if ($res = $sql->db_Select(BUGC_APPS_TABLE, "*", BUG_APPS_ORDER, "no-where", $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $app = new bugtracker3App($row);
            $appslist[$app->getId()] = $app;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $appslist;
   }

   /**
    * Get a list of bugs for an app
    * @param  $appid    application ID to get bugs for, or false to get all bugs
    * @param  $filterId ID of filter to be applied to the returned bugs list
    * @return           a list of bugs
    */
   function getBugList($appid=false, $filterId=false) {
      global $sql;

      if (!isset($this->bugs)) {
         $this->bugs = array();
  		   if ($res = $sql->db_Select(BUGC_BUGS_TABLE, "*", BUG_BUGS_ORDER, "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $bug = new bugtracker3Bug($row);
               $this->bugs[$bug->getId()] = $bug;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $bugs = $this->_clone($this->bugs);
      if ($appid !== false) {
         $bugs = $this->_discard($bugs, $appid, "getApplicationId");
      }

      // Remove bugs if a filter is active
      if ($filterId !== false) {
         $filter = $this->getFilter($filterId);
         if ($filter->getBugOwnerId() != 0) {
            if ($filter->getBugOwnerId() == -1) {
               $bugs = $this->_discard($bugs, USERID, "getOwnerId");
            } else {
               $bugs = $this->_discard($bugs, $filter->getBugOwnerId(), "getOwnerId");
            }
         }
         if ($filter->getCategories()) {
            $bugs = $this->_discard($bugs, $filter->getCategories(), "getCategoryId");
         }
         if ($filter->getPriorities()) {
            $bugs = $this->_discard($bugs, $filter->getPriorities(), "getPriorityId");
         }
         if ($filter->getResolutions()) {
            $bugs = $this->_discard($bugs, $filter->getResolutions(), "getResolutionId");
         }
         if ($filter->getStatuses()) {
            $bugs = $this->_discard($bugs, $filter->getStatuses(), "getStatusId");
         }
      }

      return $bugs;
   }

   /**
    * Get a list of bug posters
    */
   function getPosterList() {
      global $sql;

      $bugs = $this->getBuglist();

      // Get unique posters
      foreach ($bugs as $bug) {
         $posters[$bug->getPosterId()] = $bug->getPoster();
      }

      asort($posters);
      return $posters;
   }

   /**
    * Get a list of bug owners
    */
   function getOwnerList() {
      global $sql;

      $bugs = $this->getBuglist();

      // Get unique owners
      foreach ($bugs as $bug) {
         $owners[$bug->getOwnerId()] = $bug->getOwner();
      }

      asort($owners);
      return $owners;
   }

   /**
    * Get a list of all filters available to the current user
    * @return        an array of bugtracker3Filter objects, or false if none found
    */
   function getFilterList() {
      global $bugtracker3User, $sql;

      if (!isset($this->filters)) {
         // Get all filters and cache
         $this->filters = array();
	      if ($res = $sql->db_Select(BUGC_FILTERS_TABLE, "*", "order by bugtracker3_filter_public desc, bugtracker3_filter_name asc", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $filter = new bugtracker3Filter($row);
               $this->filters[$filter->GetId()] = $filter;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $filters = $this->_clone($this->filters);
      foreach ($filters as $key => $filter) {
         if (!$filter->isPublic() && $filter->getOwner() != USERID) {
            unset($filters[$key]);
         }
      }

      if (count($filters) == 0) {
         return false;
      }

      return $filters;
   }

   /**
    * Get a specific filter
    * @param  $filterId the ID of the filter to get
    * @return           a filter object, or false if not found
    */
   function getFilter($filterId) {
      $filterList = $this->getFilterList();
      return (isset($filterList[$filterId])) ? $filterList[$filterId] : false;
   }

   /**
    * Get a bug
    * @param $bugid ID of bug to get
    */
   function getBug($bugid) {
      global $sql;

  		if ($res = $sql->db_Select(BUGC_BUGS_TABLE, "*", "where bugtracker3_bugs_id=$bugid ", "no-where", $this->debug)) {
         $bug = new bugtracker3Bug($sql->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $bug;
   }

   /**
    * Get a status by ID
    */
   function getStatus($id) {
      $statusList = $this->GetStatusList();
      return $statusList[$id];
   }

   /**
    * Get a list of all versions, optionally for a specific application
    * @param  $appid   application ID to get versions for, default to false which gets all versions in the database
    * param   $current current version number of an application, defaults to false
    * @param  $which   which version numbers to return, use BUGC_BEFORE for all versions before and including $current
    * @return          an array of bugtracker3AppVersion objects, or false if none found
    */
   function getVersions($appid=false, $current=false, $which="") {
      global $sql;

      if (!isset($this->versions)) {
         // Get all versions and cache
         $this->versions = array();
	      if ($res = $sql->db_Select(BUGC_APP_VERSIONS_TABLE, "*", "order by bugtracker3_appver_version desc", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $ver = new bugtracker3AppVersion($row);
               $this->versions[$ver->GetId()] = $ver;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $versions = $this->_clone($this->versions);
      // pad version strings to ensure comparision of different string lengths works as expected
      if ($current) {
         $current = str_pad($versions[$current]->getVersion(), 255, ".");
      }
      if ($appid) {
         foreach ($versions as $key => $version) {
            if ($version->getApplicationId() != $appid) {
               unset($versions[$key]);
            }
            if ($current) {
               $version = str_pad($version->getVersion(), 255, ".");
               if ($which == BUGC_BEFORE && $version > $current) {
                  unset($versions[$key]);
               }
            }
         }
      }

      if (count($versions) == 0) {
         return false;
      }

      return $versions;
   }

   /**
    * Get a list of all categories, optionally discard categories not in the supplied list
    * @param $wanted a comma seperated list of category IDs for which categories are to be returned, defaults to false to get all categories
    */
   function getCategories($wanted=false) {
      global $sql;
      if (!isset($this->categories)) {
         $this->categories = array();
	      if ($res = $sql->db_Select(BUGC_CATEGORIES_TABLE, "*", "order by bugtracker3_category_order", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $cat = new bugtracker3Category($row);
               $this->categories[$cat->GetId()] = $cat;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $categories = $this->_clone($this->categories);
      if ($wanted !== false) {
         $categories = $this->_discard($categories, $wanted);
      }
      return $categories;
   }

   /**
    * Get a list of all categories for the filter page
    * @return an array of categories, each element being an array of ID and Name
    */
   function getCategoriesFilter() {
      $categories = $this->getCategories();
      $catArray = array();
      foreach ($categories as $key => $category) {
         $catArray[$key] = array($key, $category->getName());
      }
      return $catArray;
   }

   /**
    * Get a list of all priorities, optionally discard priorities not in the supplied list
    * @param $wanted a comma seperated list of priority IDs for which priorities are to be returned, defaults to false to get all priorities
    */
   function getPriorities($wanted=false) {
      global $sql;
      if (!isset($this->priorities)) {
         $this->priorities = array();
	      if ($res = $sql->db_Select(BUGC_PRIORITIES_TABLE, "*", "order by bugtracker3_priority_order", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $pri = new bugtracker3Priority($row);
               $this->priorities[$pri->GetId()] = $pri;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $priorities = $this->_clone($this->priorities);
      if ($wanted !== false) {
         $priorities = $this->_discard($priorities, $wanted);
      }
      return $priorities;
   }

   /**
    * Get a list of all priorities for the filter page
    * @return an array of priorities, each element being an array of ID and Name
    */
   function getPrioritiesFilter() {
      $priorities = $this->getPriorities();
      $pris = array();
      foreach ($priorities as $key => $priority) {
         $pris[$key] = array($key, $priority->getName());
      }
      return $pris;
   }

   /**
    * Get a list of all resolutions, optionally discard priorities not in the supplied list
    * @param $wanted a comma seperated list of resolution IDs for which resolutions are to be returned, defaults to false to get all resolutions
    */
   function getResolutions($wanted=false) {
      global $sql;
      if (!isset($this->resolutions)) {
         $this->resolutions = array();
	      if ($res = $sql->db_Select(BUGC_RESOLUTIONS_TABLE, "*", "order by bugtracker3_resolution_order", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $res = new bugtracker3Resolution($row);
               $this->resolutions[$res->GetId()] = $res;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $resolutions = $this->_clone($this->resolutions);
      if ($wanted !== false) {
         $resolutions = $this->_discard($resolutions, $wanted);
      }
      return $resolutions;
   }

   /**
    * Get a list of all resolutions for the filter page
    * @return an array of resolutions, each element being an array of ID and Name
    */
   function getResolutionsFilter() {
      $resolutions = $this->getResolutions();
      $resArray = array();
      foreach ($resolutions as $key => $resolution) {
         $resArray[$key] = array($key, $resolution->getName());
      }
      return $resArray;
   }

   /**
    * Get a list of all statuses
    * @param $wanted a comma seperated list of priority IDs for which priorities are to be returned, defaults to false to get all priorities
    */
   function getStatuses($wanted=false) {
      global $sql;
      if (!isset($this->statuses)) {
         $this->statuses = array();
	      if ($res = $sql->db_Select(BUGC_STATUSES_TABLE, "*", "order by bugtracker3_status_order", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $sta = new bugtracker3Status($row);
               $this->statuses[$sta->GetId()] = $sta;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $statuses = $this->_clone($this->statuses);
      if ($wanted !== false) {
         $statuses = $this->_discard($statuses, $wanted);
      }
      return $statuses;
   }

   /**
    * Get a list of all statuses for the filter page
    * @return an array of statuses, each element being an array of ID and Name
    */
   function getStatusesFilter() {
      $statuses = $this->getStatuses();
      $staArray = array();
      foreach ($statuses as $key => $status) {
         $staArray[$key] = array($key, $status->getName());
      }
      return $staArray;
   }

   /**
    * Get a list of related bugs for a specific bug
    * @param $bugid ID of the bug to get related bugs for
    */
   function getRelatedBugs($bugid) {
      global $sql;
      //if (!isset($this->relationships)) {
         $relationships = array();
	      if ($res = $sql->db_Select(BUGC_RELATIONSHIPS_TABLE, "*", "where bugtracker3_rels_primary_id=$bugid or bugtracker3_rels_secondary_id=$bugid", "where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $relationships[] = new bugtracker3Relationship($row);;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      //}

      return $relationships;
   }

   /**
    * Get the a specific version
    * @param $id id of the version to get
    */
   function getVersion($verid) {
      if ($verid == 0) {
         $ver = new bugtracker3AppVersion();
         return $ver->getVersion();
      }

      $versionList = $this->getVersions();
      if ($versionList === false) {
         return $false;
      }
      return $versionList[$verid]->getVersion();
   }

   /**
    * Get the name of a specific category
    * @param $id id of the category to get name of
    */
   function getCategoryName($id) {
      $categories = $this->getCategories();
      return $categories[$id]->getName();
   }

   /**
    * Get the name of a specific priority
    * @param $id id of the priority to get the name of
    */
   function getPriorityName($id) {
      $priorities = $this->getPriorities();
      return $priorities[$id]->getName();
   }

   /**
    * Get the colour string of a specific priority
    * @param $id id of the priority to get colour for
    */
   function getPriorityColor($id) {
      $priorities = $this->getPriorities();
      return $priorities[$id]->getColor();
   }

   /**
    * Get the name of a specific resolution
    * @param $id id of the resolutionto get name of
    */
   function getResolutionName($id) {
      $resolutions = $this->getResolutions();
      return $resolutions[$id]->getName();
   }

   /**
    * Get the name of a specific status
    * @param $id id of the status to get name of
    */
   function getStatusName($id) {
      $statuses = $this->getStatuses();
      return $statuses[$id]->getName();
   }

   /**
    * Get the total number of bugs for an application
    */
   function getBugCount($appid=false) {
      global $sql;
      if ($appid) {
	      return $sql->db_Count(BUGC_BUGS_TABLE, "(*)", "where bugtracker3_bugs_application_id=$appid", $this->debug);
	   } else {
	      return $sql->db_Count(BUGC_BUGS_TABLE, "(*)", "", $this->debug);
	   }
   }

   /**
    * Get the latest version object for an application
    */
   function getLatestVersion($appid) {
      global $sql;
	   if ($sql->db_Select(BUGC_APP_VERSIONS_TABLE, "*", "bugtracker3_appver_app_id=$appid order by bugtracker3_appver_version desc limit 1", true, $this->debug)) {
         return new bugtracker3AppVersion($sql->db_Fetch());
      }
      return false;
   }

   /**
    * Get the latest version object for an application
    */
   function getDeveloperComments($bugid) {
      global $sql;
         $this->developerComments = array();
   	   if ($sql->db_Select(BUGC_DEVELOPER_COMMENTS_TABLE, "*", "bugtracker3_devc_bugid=$bugid order by bugtracker3_devc_timestamp asc", true, $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $this->developerComments[] = new bugtracker3DeveloperComment($row);
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }

      return $this->developerComments;
   }

   /**
    * Submit a new bug
    */
   function submitBug($app, $bug) {
      global $sql, $tp;

      $qry = array();
      $qry[] = "'0'";                                          // id
      $qry[] = "'".time()."'";                                 // timestamp
      $qry[] = "'".time()."'";                                 // last update timestamp
      $qry[] = "'".$tp->toDB($bug->getSummary())."'";          // summary
      $qry[] = "'".USERID."'";                                 // poster
      $qry[] = "'".USERID."'";                                 // last update poster
      $qry[] = "'".$app->getOwnerId()."'";                     // owner
      $qry[] = "'".$bug->getDeleted()."'";                     // deleted
      $qry[] = "'".$app->getId()."'";                          // application
      $qry[] = "'".$bug->getFoundInVersionId(true)."'";        // found in version
      $qry[] = "'".$bug->getFixedInVersionId(true)."'";        // fixed in version
      $qry[] = "'".$bug->getCategoryId(true)."'";              // category
      $qry[] = "'".$tp->toDB($bug->getDescription(true))."'";  // description
      $qry[] = "'".$bug->getPriorityId(true)."'";              // priority
      $qry[] = "'".$bug->getResolutionId(true)."'";            // resolution
      $qry[] = "'".$bug->getStatusId(true)."'";                // status
      $qry = implode(",", $qry);
      if ($id = $sql->db_Insert(BUGC_BUGS_TABLE, $qry, $this->debug)) {
         return $id;
      } else {
         $statusInfo = new bugtracker3StatusInfo(STATUS_FATAL);
         $statusInfo->addMessage(BUG_LAN_MSG_DB_ADD, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Update a bug
    */
   function updateBug($bug) {
      global $sql, $tp;

      $qry = array();
      $qry[] = "bugtracker3_bugs_update_timestamp='".time()."'";                                // last update timestamp
      $qry[] = "bugtracker3_bugs_summary='".$tp->toDB($bug->getSummary(BUGC_UI))."'";           // summary
      $qry[] = "bugtracker3_bugs_last_update_poster='".USERID."'";                              // last update poster
      $qry[] = "bugtracker3_bugs_owner='".$bug->getOwnerId(BUGC_UI)."'";                        // owner
      $qry[] = "bugtracker3_bugs_found_in_version='".$bug->getFoundInVersionId(BUGC_UI)."'";    // owner
      $qry[] = "bugtracker3_bugs_fixed_in_version='".$bug->getFixedInVersionId(BUGC_UI)."'";    // owner
      $qry[] = "bugtracker3_bugs_deleted='".$bug->getDeleted(BUGC_UI)."'";                      // deleted
      $qry[] = "bugtracker3_bugs_application_id='".$bug->getApplicationId(BUGC_UI)."'";         // application
      $qry[] = "bugtracker3_bugs_category='".$bug->getCategoryId(BUGC_UI)."'";                  // category
      $qry[] = "bugtracker3_bugs_description='".$tp->toDB($bug->getDescription(BUGC_UI))."'";   // description
      $qry[] = "bugtracker3_bugs_priority='".$bug->getPriorityId(BUGC_UI)."'";                  // priority
      $qry[] = "bugtracker3_bugs_resolution='".$bug->getResolutionId(BUGC_UI)."'";              // resolution
      $qry[] = "bugtracker3_bugs_status='".$bug->getStatusId(BUGC_UI)."'";                      // status
      $qry = implode(",", $qry);
      $qry .= " where bugtracker3_bugs_id=".$bug->getId()."";
      if (false !== $id = $sql->db_Update(BUGC_BUGS_TABLE, $qry, $this->debug)) {
         return $id;
      } else {
         $statusInfo = new bugtracker3StatusInfo();
         $statusInfo->addMessage(BUG_LAN_MSG_DB_ADD, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Add a relationship record
    */
   function addRelationship($bugid, $reltype, $relid) {
      global $sql;
		// do update if record already exists as primary/secondary ID pair - allow relationship to be updated
      if ($sql->db_Select(BUGC_RELATIONSHIPS_TABLE, "*", "bugtracker3_rels_primary_id=$bugid AND bugtracker3_rels_secondary_id=$relid")) {
         // update existing relationship
      	$sql->db_Update(BUGC_RELATIONSHIPS_TABLE, "bugtracker3_rels_relationship=$reltype WHERE bugtracker3_rels_primary_id=$bugid AND bugtracker3_rels_secondary_id=$relid");
      } else {
         if ($sql->db_Select(BUGC_RELATIONSHIPS_TABLE,"*","bugtracker3_rels_primary_id=$relid AND bugtracker3_rels_secondary_id=$bugid")) {
            // update existing (reverse) relationship
         	$sql->db_Update(BUGC_RELATIONSHIPS_TABLE, "bugtracker3_rels_primary_id=$bugid, bugtracker3_rels_secondary_id=$relid, bugtracker3_rels_relationship=$reltype WHERE bugtracker3_rels_primary_id=$relid AND bugtracker3_rels_secondary_id=$bugid");
         } else {
            // new relationship
      	   $sql->db_Insert(BUGC_RELATIONSHIPS_TABLE, "$bugid, $relid, $reltype", $this->debug);
      	}
      }
   }

   /**
    * Delete a relationship record
    */
   function deleteRelationship($bugid, $relid) {
      global $sql;
      if ($sql->db_Delete(BUGC_RELATIONSHIPS_TABLE, "bugtracker3_rels_primary_id=$bugid AND bugtracker3_rels_secondary_id=$relid")) {
         return true;
      } else {
         return false;
      }
   }

   /**
    * Add a developer comment
    */
   function addDevComment($bugid, $comment) {
      global $sql, $tp;
      $qry = "'".time()."', $bugid, '".USERID."', '".$tp->toDB($comment)."'";
      $sql->db_Insert(BUGC_DEVELOPER_COMMENTS_TABLE, $qry, true, "Bugtracker3", $qry);
   }

   /**
    * Get user filter
    */
   function getUserPrefs() {
      global $sql;

      if ($sql->db_Select(BUGC_USER_PREFS_TABLE, "*", "bugtracker3_user_prefs_id=".USERID)) {
         return $sql->db_Fetch();
      } else {
         return false;
      }
   }

   /**
    * Update user filter
    */
   function updateUserFilter($filter) {
      global $sql;

      if ($filter == 0) {
         $sql->db_Delete(BUGC_USER_PREFS_TABLE, "bugtracker3_user_prefs_id=".USERID, true);
      } else {
		   // do update if record already exists for this user
         if ($sql->db_Select(BUGC_USER_PREFS_TABLE, "*", "bugtracker3_user_prefs_id=".USERID, true)) {
            // update existing filter
         	$sql->db_Update(BUGC_USER_PREFS_TABLE, "bugtracker3_user_prefs_filter=$filter WHERE bugtracker3_user_prefs_id=".USERID);
         } else {
            // new user filter
      	   $sql->db_Insert(BUGC_USER_PREFS_TABLE, USERID.", $filter", true, $this->debug);
         }
      }
   }

   /**
    * Helper function to remove items from a list of objects that are not present in a list of wanted items.
    * If the object's match function returns a value in the wanted list then the object is not discarded.
    * The objects must support two functions - getId() and the match function passed as a paremter.
    * @param $array     a list of objects that have a getId() function
    * @param $wanted    a comma seperated list of IDs for which items are to be returned, defaults to false to get all items
    * @param $matchfun  function supported by the passed in objects used to determine if a match is made or not, fdefaults to getId
    * @return           the passwed in array with appropriate objects discarded
    * @private
    */
   function _discard($array, $wanted, $matchfunc="getId") {
      $wanted = explode(",", $wanted);
      foreach ($array as $item) {
         if (array_search($item->$matchfunc(), $wanted) === false) {
            unset($array[$item->getId()]);
         }
      }
      return $array;
   }

   /**
    * Get a clone of an object
    * @param  $object the object to be cloned
    * @return         a clone of the supplied object
    * @private
    */
   function _clone($object) {
      return unserialize(serialize($object));
   }
}
?>