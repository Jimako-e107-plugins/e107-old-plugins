<?
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/handlers/election_user.php,v $
| $Revision: 1.2 $
| $Date: 2008/02/10 15:23:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Election user
 * Holds information relating to the current user and what they are allowed to do in Election
 */
class electionUser {
   var $user;     // user data
   var $privs;    // an array of election privilieges, index on election ID

   /**
    * Constructor
    * @param $elections  a Election object or an array of Election objects
    */
   function electionUser($elections) {
      if (!is_array($elections)) {
         $electionlist[$elections->getId()] = $elections;
      } else {
         $electionlist = $elections;
      }

      foreach ($electionlist as $election) {
         $this->setViewElection($election);
         $this->setViewElectionResults($election);
         $this->setVoteElection($election);
      }
      $this->user = get_user_data(USERID);
   }
   // Setters
   function setViewElection($election) {
      $this->privs[$election->getId()]["view"] = check_class($election->getViewClass());
   }
   function setViewElectionResults($election) {
      $this->privs[$election->getId()]["view_results"] = check_class($election->getViewResultsClass());
   }
   function setVoteElection($election) {
      $this->privs[$election->getId()]["vote"] = check_class($election->getVoteClass()) || USERID == $election->getOwnerId();
   }

   // Privilege checks
   function canViewElection($electionId) {
      return $this->privs[$electionId]["view"];
   }
   function canViewElectionResults($electionId) {
      return $this->privs[$electionId]["view_results"];
   }
   function canVoteElection($electionId) {
      return $this->privs[$electionId]["vote"];
   }
   function isRestricted($value, $field) {
      return ($value && $value == $this->user["user_$field"]);
   }
}
?>