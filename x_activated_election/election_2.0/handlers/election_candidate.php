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
| $Source: e:\_repository\e107_plugins/election/handlers/election_candidate.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/31 16:01:20 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Election Candidate
 */
class electionCandidate {
   var $candidate;   // An array of candidate field values

   /**
    * Constructor
    * @param $candidate a row from the candidates table
    * @param $election  an election object for the election that this candidate belongs to
    */
   function electionCandidate($candidate=false, $election=false) {
      // Set some default values
      $this->candidate["election_candidate_election_ids"]   = $election ? $election->getId() : 0;

      if ($candidate) {
         $this->candidate = array_merge($this->candidate, $candidate);
      }
   }

   // Getters
   function getId() {
      return $this->candidate["election_candidate_id"];
   }
   function getElectionId() {
      return $this->candidate["election_candidate_election_ids"];
   }
   function getName() {
      return $this->candidate["election_candidate_name"];
   }
   function getTitle() {
      return $this->candidate["election_candidate_title"];
   }
   function getDescription() {
      return $this->candidate["election_candidate_description"];
   }
   function getIcon() {
      return $this->candidate["election_candidate_icon"];
   }
   function getImages() {
      return $this->candidate["election_candidate_images"];
   }
   function getLinkDescription() {
      return $this->candidate["election_candidate_link_description"];
   }
   function getLinkURL() {
      return $this->candidate["election_candidate_link_url"];
   }
   function getTemplate() {
      return $this->candidate["election_candidate_template"];
   }
   function getRestrictionValue() {
      return $this->candidate["election_candidate_vote_restriction_value"];
   }
   function getRestrictionField() {
      return $this->candidate["election_candidate_vote_restriction_field"];
   }
}
