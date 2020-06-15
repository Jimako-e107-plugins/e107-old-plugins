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
| $Source: e:\_repository\e107_plugins/election/handlers/election_election.php,v $
| $Revision: 1.3 $
| $Date: 2008/02/10 15:22:42 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Election
 */
class electionElection {
   var $election;       // A row from the elections table
   var $candidates;     // Array of candidates belonging to this election
   var $count;          // Number of candidates belonging to this election
   var $owner;          // Owner of this election

   /**
    * Constructor
    * @param $election a row from the elections table
    */
   function electionElection($election) {
      $this->debug = false;
      $this->election = $election;
   }

   // Getters
   function getId() {
      return $this->election["election_id"];
   }
   function getName() {
      return $this->election["election_name"];
   }
   function getDescription() {
      return $this->election["election_description"];
   }
   function getIcon() {
      return $this->election["election_icon"];
   }
   function getStartDate() {
      return $this->election["election_start_date"];
   }
   function getEndDate() {
      return $this->election["election_end_date"];
   }
   function getClosed() {
      return $this->election["election_closed"];
   }
   function getPointsPerVote() {
      return explode("\r\n", $this->election["election_points_per_vote"]);
   }
   function getVotesPerPerson() {
      return count($this->getPointsPerVote());
   }
   function getViewClass() {
      return $this->election["election_view_class"];
   }
   function getViewResultsClass() {
      return $this->election["election_view_results_class"];
   }
   function getVoteClass() {
      return $this->election["election_vote_class"];
   }
   function getOwnerId() {
      return $this->election["election_owner"];
   }
   function getOwner() {
      $this->owner = varset($this->owner, e107::user($this->getOwnerId()));
      return $this->owner["user_name"];
   }
   function getTemplate() {
      return $this->election["election_template"];
   }
   function getRestrictionText() {
      return $this->election["election_vote_restriction_text"];
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
      return $this->election["election_closed"]==0 && $this->getStartDate() < time() && time() < $this->getEndDate();
   }
   function isStarted() {
      return $this->getStartDate() < time();
   }
   function isFinished() {
      return time() > $this->getEndDate();
   }
   function allowRatings() {
      return $this->election["election_ratings"]==1;
   }
   function allowComments() {
      return $this->election["election_comments"]==1;
   }
}
