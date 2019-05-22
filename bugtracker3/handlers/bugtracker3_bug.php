<?
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_bug.php,v $
| $Revision: 1.1.2.5 $
| $Date: 2006/11/27 23:38:32 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Bug
 */
class bugtracker3Bug {
   var $bug;                  // An array of bug field values
   var $ui;                   // New bug values submitted from client
   var $old;                  // Copy of the bug before updates applied
   var $related;              // Array of related bugs
   var $changes;              // Saved copy of cahnges (for reporting after validation)

   /**
    * Constructor
    * @param $bug a row from the bugs table
    * @param $ui  new bug values obtained from client
    * @param $app an application object for the application that this bug belongs to
    */
   function bugtracker3Bug($bug=false, $ui=false, $app=false) {
      // Set some default values
      $this->bug["bugtracker3_bugs_deleted"]          = 0;
      $this->bug["bugtracker3_bugs_found_in_version"] = 0;
      $this->bug["bugtracker3_bugs_fixed_in_version"] = 0;
      $this->bug["bugtracker3_bugs_category"]         = $app ? $app->getDefaultCategory() : 0;
      $this->bug["bugtracker3_bugs_priority"]         = $app ? $app->getDefaultPriority() : 0;
      $this->bug["bugtracker3_bugs_resolution"]       = $app ? $app->getDefaultResolution() : 0;
      $this->bug["bugtracker3_bugs_status"]           = $app ? $app->getDefaultStatus() : 0;
      $this->bug["bugtracker3_bugs_application_id"]   = $app ? $app->getId() : 0;

      if ($bug) {
         $this->bug = array_merge($this->bug, $bug);
      }
      $this->ui = $ui;
   }

   function setUI($ui) {
      $this->ui = $ui;
   }

   // Getters
   function getId() {
      return $this->bug["bugtracker3_bugs_id"];
   }
   function getPosterId() {
      return $this->bug["bugtracker3_bugs_poster"];
   }
   function getPoster() {
      $user = get_user_data($this->getPosterId());
      return $user["user_name"];
   }
   function getLastUpdatePosterId() {
      return $this->bug["bugtracker3_bugs_last_update_poster"];
   }
   function getLastUpdatePoster() {
      $user = get_user_data($this->getLastUpdatePosterId());
      return $user["user_name"];
   }
   function getOwnerId($ui=false) {
      return ($ui && isset($this->ui["ui_owner"])) ? $this->ui["ui_owner"] : $this->bug["bugtracker3_bugs_owner"];
   }
   function getOwner($ui=false) {
      $user = get_user_data($this->getOwnerId($ui));
      return $user["user_name"];
   }
   function getApplicationId($ui=false) {
      return ($ui && isset($this->ui["ui_application_id"])) ? $this->ui["ui_application_id"] : $this->bug["bugtracker3_bugs_application_id"];
   }
   function getFoundInVersionId($ui=false) {
      return ($ui && isset($this->ui["ui_found_in_version"])) ? $this->ui["ui_found_in_version"] : $this->bug["bugtracker3_bugs_found_in_version"];
   }
   function getFoundInVersion($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getVersion($this->getFoundInVersionId($ui));
   }
   function getFixedInVersionId($ui=false) {
      return ($ui && isset($this->ui["ui_fixed_in_version"])) ? $this->ui["ui_fixed_in_version"] : $this->bug["bugtracker3_bugs_fixed_in_version"];
   }
   function getFixedInVersion($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getVersion($this->getFixedInVersionId($ui));
   }
   function getApplicationVersion() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getApplicationVersion($this->getApplicationVersionId());
   }
   function getCategoryId($ui=false) {
      return ($ui && isset($this->ui["ui_category"])) ? $this->ui["ui_category"] : $this->bug["bugtracker3_bugs_category"];
   }
   function getCategoryName($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getCategoryName($this->getCategoryId($ui));
   }
   function getDeveloperComments() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getDeveloperComments($this->getId());
   }
   function getDescription($ui=false, $truncate=false) {
      $temp = ($ui && isset($this->ui["ui_description"])) ? $this->ui["ui_description"] : $this->bug["bugtracker3_bugs_description"];
      return $truncate ? substr($temp, 0, 200) : $temp;
   }
   function getPriorityId($ui=false) {
      return ($ui && isset($this->ui["ui_priority"])) ? $this->ui["ui_priority"] : $this->bug["bugtracker3_bugs_priority"];
   }
   function getPriorityName($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getPriorityName($this->getPriorityId($ui));
   }
   function getPriorityColor($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getPriorityColor($this->getPriorityId($ui));
   }
   function getRelatedBugs() {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      if (!isset($this->relatedList)) {
         $dao->getRelatedBugs($this->getId());
      }
      return $this->relatedList;
   }
   function getResolutionId($ui=false) {
      return ($ui && isset($this->ui["ui_resolution"])) ? $this->ui["ui_resolution"] : $this->bug["bugtracker3_bugs_resolution"];
   }
   function getResolutionName($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getResolutionName($this->getResolutionId($ui));
   }
   function getStatusId($ui=false) {
      return ($ui && isset($this->ui["ui_status"])) ? $this->ui["ui_status"] : $this->bug["bugtracker3_bugs_status"];
   }
   function getStatusName($ui=false) {
      global $bugtracker3;
      $dao = $bugtracker3->getDAO();
      return $dao->getStatusName($this->getStatusId($ui));
   }
   function getSummary($ui=false, $truncate=false) {
      $temp = ($ui && isset($this->ui["ui_summary"])) ? $this->ui["ui_summary"] : $this->bug["bugtracker3_bugs_summary"];
      return $truncate ? strlen($temp) > 25 ? substr($temp, 0, 25)."..." : $temp : $temp;
   }
   function getTimestamp() {
      return $this->bug["bugtracker3_bugs_timestamp"];
   }
   function getLastupdateTimestamp() {
      return $this->bug["bugtracker3_bugs_update_timestamp"];
   }
   function getDeleted($ui=false) {
      return ($ui && isset($this->ui["ui_deleted"])) ? $this->ui["ui_deleted"] : $this->bug["bugtracker3_bugs_deleted"];
   }
   function isDeleted($ui=false) {
      return ($ui && isset($this->ui["ui_deleted"])) ? $this->ui["ui_deleted"] : $this->bug["bugtracker3_bugs_deleted"];
   }

   /**
    * Function to validate the model
    * Validates (including mandatoryness check) all model attributes that have a key prefixed "ui_", other
    * attributes are deemed to have come from the database or other trusted source (i.e. not user input).
    * @return $statusInfo a statusInfo object if there are any warnings or errors, otherwise false
    */
   function validateMe() {
      // Field Validation
      $statusInfo = new bugtracker3StatusInfo(STATUS_WARN);
      if (!isset($this->ui["ui_category"]) || $this->ui["ui_category"] =="") {
         $statusInfo->addMissingMandatory("Category");
      }
      if (!isset($this->ui["ui_priority"]) || $this->ui["ui_priority"] =="") {
         $statusInfo->addMissingMandatory("Priority");
      }
      if (!isset($this->ui["ui_summary"]) || $this->ui["ui_summary"] =="") {
         $statusInfo->addMissingMandatory("Summary");
      }
      if (!isset($this->ui["ui_description"]) || $this->ui["ui_description"] =="") {
         $statusInfo->addMissingMandatory("Description");
      }

      if ($statusInfo->getMessageCount() > 0) {
         return $statusInfo;
      }

      // Save changes before updating
      $this->getChanges();

      // Everything is OK, copy "ui" values as real attributes
      foreach ($this->ui as $key => $value) {
         $bits = split("_", $key, 2);
         if ($bits[0] == "ui") {
            $this->bug["bugtracker3_bugs_".$bits[1]] = $value;
         }
      }

      return false;
   }

   /**
    * Set a new application ID
    * This should only be used when a bug is being moved between applications
    */
   function setApplicationId($newAppId) {
      //$this->ui["bugtracker3_bugs_application_id"] == $this->ui["bugtracker3_bugs_application_id"]);
   }

   /**
    * Generates a list of fields that have been updated
    */
   function getChanges($formatted=false) {
      if (!isset($this->changes)) {
         $this->changes = array();
         foreach ($this->ui as $key => $value) {
            $bits = split("_", $key, 2);
            if ($bits[0] == "ui") {
               if ($this->bug["bugtracker3_bugs_".$bits[1]] != $this->ui["ui_".$bits[1]]) {
                  $this->changes[$bits[1]] = $this->ui["ui_".$bits[1]]." -> ".$this->bug["bugtracker3_bugs_".$bits[1]];
               }
            }
         }
      }

      if ($formatted) {
         return implode("<br/>", $this->changes);
      } else {
         return implode(",", $this->changes);
      }
   }
}
?>