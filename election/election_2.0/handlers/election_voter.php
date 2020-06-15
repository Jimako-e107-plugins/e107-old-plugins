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
| $Source: e:\_repository\e107_plugins/election/handlers/election_voter.php,v $
| $Revision: 1.2 $
| $Date: 2007/04/05 19:38:46 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Election Voter
 */
class electionVoter {
   var $voter;   // An array of voter field values

   /**
    * Constructor
    * @param $voter a row from the voters table
    * @param object $election  an election object for the election that this voter belongs to
    */
   function __construct($voter=false, $election=false) {
      // Set some default values
      $this->voter["election_voter_election_ids"]   = $election ? $election->getId() : 0;

      if ($voter) {
         $this->voter = array_merge($this->voter, $voter);
      }
   }

   // Getters
   function getUserId() {
      return $this->voter["election_voter_user_id"];
   }
   function getElectionId() {
      return $this->voter["election_voter_election_id"];
   }
   function getVotes() {
      return explode(",", $this->voter["election_voter_votes"]);
   }
   function getTimestamp() {
      return $this->voter["election_voter_timestamp"];
   }
}
