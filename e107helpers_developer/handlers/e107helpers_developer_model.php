<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/handlers/e107helpers_developer_model.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:07 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Election
 */
class e107helpers_developerElection {
   var $e107helpers_developer;       // A row from the e107helpers_developers table
   var $candidates;     // Array of candidates belonging to this e107helpers_developer
   var $count;          // Number of candidates belonging to this e107helpers_developer
   var $owner;          // Owner of this e107helpers_developer

   /**
    * Constructor
    * @param $e107helpers_developer a row from the e107helpers_developers table
    */
   function __construct($e107helpers_developer) {
      $this->debug = false;
      $this->e107helpers_developer = $e107helpers_developer;
   }

   // Getters
   function getId() {
      return $this->e107helpers_developer["e107helpers_developer_id"];
   }
   function getName() {
      return $this->e107helpers_developer["e107helpers_developer_name"];
   }
   function getDescription() {
      return $this->e107helpers_developer["e107helpers_developer_description"];
   }
   function getIcon() {
      return $this->e107helpers_developer["e107helpers_developer_icon"];
   }
   function getStartDate() {
      return $this->e107helpers_developer["e107helpers_developer_start_date"];
   }
   function getEndDate() {
      return $this->e107helpers_developer["e107helpers_developer_end_date"];
   }
   function getClosed() {
      return $this->e107helpers_developer["e107helpers_developer_closed"];
   }
   function getPointsPerVote() {
      return explode("\r\n", $this->e107helpers_developer["e107helpers_developer_points_per_vote"]);
   }
   function getVotesPerPerson() {
      return count($this->getPointsPerVote());
   }
   function getViewClass() {
      return $this->e107helpers_developer["e107helpers_developer_view_class"];
   }
   function getVoteClass() {
      return $this->e107helpers_developer["e107helpers_developer_vote_class"];
   }
   function getOwnerId() {
      return $this->e107helpers_developer["e107helpers_developer_owner"];
   }
   function getOwner() {
      //$this->owner = varset($this->owner, getx_user_data($this->getOwnerId()));
      $this->owner = varset($this->owner, e107::user($this->getOwnerId()));
      return $this->owner["user_name"];
   }
   function getTemplate() {
      return $this->e107helpers_developer["e107helpers_developer_template"];
   }
   function getRestrictionText() {
      return $this->e107helpers_developer["e107helpers_developer_vote_restriction_text"];
   }
   function getCandidateTotal() {
      global $elec;
      if (!isset($this->count)) {
         $dao = $elec->getDAO();
  		   $this->count = $dao->getCandidateCount($this->getId());
      }
      return $this->count;
   }
   function isOpen() {
      return $this->e107helpers_developer["e107helpers_developer_closed"]==0 && $this->getStartDate() < time() && time() < $this->getEndDate();
   }
   function isStarted() {
      return $this->getStartDate() < time();
   }
   function isFinished() {
      return time() > $this->getEndDate();
   }
   function allowRatings() {
      return $this->e107helpers_developer["e107helpers_developer_ratings"]==1;
   }
   function allowComments() {
      return $this->e107helpers_developer["e107helpers_developer_comments"]==1;
   }
}
?>