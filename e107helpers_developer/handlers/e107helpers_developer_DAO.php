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
| $Source: e:\_repository\e107_plugins/e107helpers_developer/handlers/e107helpers_developer_DAO.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:07 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Class used to control all database access for e107helpers_developer
 */
class e107helpers_developerDAO {
   var $candidates;  // Cached candidates list
   var $voters;      // Cached voters list
   var $posters;     // Cached posters list
   var $owners;      // Cached owners list

   // Switch debug options on
   var $debug;

   /**
    * Constructor
    */
   function __construct() {
      global $pref;
      $this->debug = false; //"now";
   }

   /**
    * Get a specific e107helpers_developer
    * @param $e107helpers_developerid  the e107helpers_developer ID for the e107helpers_developer to be retrieved
    */
   function getElection($e107helpers_developerid, $getcandidates=false) {
      global $sql;

      $e107helpers_developer = false;
  		if ($res = $sql->db_Select(EHDC_ELECTIONS_TABLE, "*", "e107helpers_developer_id=$e107helpers_developerid", true, $this->debug)) {
         $e107helpers_developer = new e107helpers_developerElection($sql->db_Fetch(), $getcandidates);
      } else {
         if (mysqli_errno() != 0) {
            echo "<br>**".mysqli_errno()." : ".mysqli_error();
         }
      }

      return $e107helpers_developer;
   }

   /**
    * Get a list of e107helpers_developers
    */
   function getElectionList() {
      global $sql;

      $e107helpers_developerslist = array();
  		if ($res = $sql->db_Select(EHDC_ELECTIONS_TABLE, "*", EHD_ELECTION_ORDER, "no-where", $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $e107helpers_developer = new e107helpers_developerElection($row);
            if (check_class($e107helpers_developer->getViewClass())) {
               $e107helpers_developerslist[$e107helpers_developer->getId()] = $e107helpers_developer;
            }
         }
      } else {
         if (mysqli_errno() != 0) {
            echo "<br>**".mysqli_errno()." : ".mysqli_error();
         }
      }

      return $e107helpers_developerslist;
   }

   /**
    * Get a list of candidates for an e107helpers_developer
    * @param  $e107helpers_developerid e107helpers_developer ID to get candidates for, or false to get all candidates
    * @param  $force force a refresh of the cached list
    * @return        a list of candidates
    */
   function getCandidateList($e107helpers_developerid=false, $force=false) {
      global $sql;

      if (!isset($this->candidates) || $force) {
         $this->candidates = array();
  		   if ($res = $sql->db_Select(EHDC_CANDIDATES_TABLE, "*", EHDC_CANDIDATES_ORDER, "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $candidate = new e107helpers_developerCandidate($row);
               $this->candidates[$candidate->getId()] = $candidate;
            }
         } else {
            if (mysqli_errno() != 0) {
               echo "<br>**".mysqli_errno()." : ".mysqli_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $candidates = $this->_clone($this->candidates);
      if ($e107helpers_developerid !== false) {
         $candidates = $this->_discard($candidates, $e107helpers_developerid, "getElectionId");
      }

      return $candidates;
   }

   /**
    * Get a candidate
    * @param $candidateid ID of the candidate to get
    */
   function getCandidate($candidateid) {
      global $sql;

  		if ($res = $sql->db_Select(EHDC_CANDIDATES_TABLE, "*", "where e107helpers_developer_candidate_id=$candidateid ", "no-where", $this->debug)) {
         $candidate = new e107helpers_developerCandidate($sql->db_Fetch());
      } else {
         if (mysqli_errno() != 0) {
            echo "<br>**".mysqli_errno()." : ".mysqli_error();
         }
      }

      return $candidate;
   }

   /**
    * Get the total number of candidates for an e107helpers_developer/all e107helpers_developers
    * @param $e107helpers_developerid ID of e107helpers_developer to get count for or false to get count of all candidates in all e107helpers_developers
    */
   function getCandidateCount($e107helpers_developerid=false) {
      global $sql;
      if ($e107helpers_developerid) {
	      return $sql->db_Count(EHDC_CANDIDATES_TABLE, "(*)", "where e107helpers_developer_candidate_e107helpers_developer_ids=$e107helpers_developerid", $this->debug);
	   } else {
	      return $sql->db_Count(EHDC_CANDIDATES_TABLE, "(*)", "", $this->debug);
	   }
   }

   /**
    * Get a list of voters for an e107helpers_developer
    * $e107helpers_developeridthe ID of the e107helpers_developer to get votes for
    * @return  a list of voters
    */
   function getVoterList($e107helpers_developerid) {
      global $sql;

      if (!isset($this->voters) || $force) {
         $this->voters = array();
  		   if ($res = $sql->db_Select(EHDC_VOTERS_TABLE, "*", "", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $vote = new e107helpers_developerVoter($row);
               $this->voters[$vote->getTimestamp()] = $vote;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysqli_errno()." : ".mysqli_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $votes = $this->_clone($this->voters);
      if ($e107helpers_developerid !== false) {
         $votes = $this->_discard($votes, $e107helpers_developerid, "getId", "getId");
      }

      return $votes;
   }

   /**
    * Get a users votes
    * @param $userid user ID of the user to get votes for
    * @return users votes as an array, 1st vote in index 1, 2nd in 2, etc.
    */
   function getVotesForUser($userid) {
      global $sql;

  		if ($res = $sql->db_Select(EHDC_VOTERS_TABLE, "*", "e107helpers_developer_voter_user_id='$userid'", true, $this->debug)) {
         $voter = new e107helpers_developerVoter($sql->db_Fetch());
      } else {
         if (mysqli_errno() != 0) {
            echo "<br>**".mysqli_errno()." : ".mysqli_error();
         }
      }

      return $voter;
   }

   /**
    * Get the total number of votes for an e107helpers_developer
    * @param $e107helpers_developerid ID of e107helpers_developer to get count for
    */
   function getElectionVoterCount($e107helpers_developerid) {
      global $sql;
      return $sql->db_Count(EHDC_VOTERS_TABLE, "(*)", "where e107helpers_developer_voter_e107helpers_developer_id=$e107helpers_developerid", $this->debug);
   }

   /**
    * Get the total number of votes for a candidate
    * @param $candidateid ID of candidate to get count for
    */
   function getCandidateVoterCount($candidateid) {
      global $sql;
      return $sql->db_Count(EHDC_VOTERS_TABLE, "(*)", "where e107helpers_developer_voter_votes REGEXP('(^|,)($candidateid)(,|$)')", $this->debug);
   }

   /**
    * Cast a vote
    * @param $e107helpers_developerid   the id of the e107helpers_developer that the votes are for
    * @param $vote         a populated vote object
    */
   function castVote($e107helpers_developerid, $votes) {
      global $sql, $tp;
      $qry = array();
      $qry[] = "'".USERID."'";               // voter ID
      $qry[] = "'$e107helpers_developerid'";              // e107helpers_developer ID
      $qry[] = "'".implode(",", $votes)."'"; // votes
      $qry[] = "'".time()."'";               // timestamp
      $qry = implode(",", $qry);
      if (false !== $sql->db_Insert(EHDC_VOTERS_TABLE, $qry, $this->debug)) {
         return true;
      } else {
         $statusInfo = new e107helpers_developerStatusInfo(STATUS_ERROR);
         $statusInfo->addMessage(EHD_LAN_MSG_DB_ADD, mysqli_errno()." : ".mysqli_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Check if the current user has voted in the supplied e107helpers_developer
    * @param $e107helpers_developerid  the e107helpers_developer ID for the e107helpers_developer to be checked
    */
   function hasVoted($e107helpers_developerid) {
      global $sql;

      $e107helpers_developer = false;
  		if ($res = $sql->db_Select(EHDC_VOTERS_TABLE, "*", "e107helpers_developer_voter_user_id=".USERID, true, $this->debug)) {
         return true;
      } else {
         return false;
      }
   }

   /**
    * Helper function to remove items from a list of objects that are not present in a list of wanted items.
    * If the object's match function returns a value in the wanted list then the object is not discarded.
    * The objects must support two functions - getId() and the match function passed as a paremter.
    * @param $array     a list of objects that have a getId() function
    * @param $wanted    a comma seperated list of IDs for which items are to be returned, defaults to false to get all items
    * @param $matchfun  function supported by the passed in objects used to determine if a match is made or not, defaults to getId
    * @param $keyfunc   function supported by the passed in objects used to determine the key for the current object, defaults to getId
    * @return           the passwed in array with appropriate objects discarded
    * @private
    */
   function _discard($array, $wanted, $matchfunc="getId", $keyfunc="getId") {
      $wanted = explode(",", $wanted);
      foreach ($array as $item) {
         if (array_search($item->$matchfunc(), $wanted) === false) {
            unset($array[$item->$keyfunc()]);
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