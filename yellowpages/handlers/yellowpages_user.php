<?
/*
+---------------------------------------------------------------+
| yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_user.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an yellowpages user
 * Holds information relating to the current user and what they are allowed to do in yellowpages
 */
class yellowpagesUser {
   var $user;     // user data
   var $privs;    // an array of yellowpages privilieges, index on yellowpages ID

   /**
    * Constructor
    * @param $yellowpagess  a yellowpages object or an array of yellowpages objects
    */
   function yellowpagesUser($yellowpagess) {
      if (!is_array($yellowpagess)) {
         $yellowpageslist[$yellowpagess->getId()] = $yellowpagess;
      } else {
         $yellowpageslist = $yellowpagess;
      }

      foreach ($yellowpageslist as $yellowpages) {
         $this->setViewyellowpages($yellowpages);
         $this->setVoteyellowpages($yellowpages);
      }
      $this->user = get_user_data(USERID);
   }
   // Setters
   function setViewyellowpages($yellowpages) {
      $this->privs[$yellowpages->getId()]["view"] = check_class($yellowpages->getViewClass());
   }
   function setVoteyellowpages($yellowpages) {
      $this->privs[$yellowpages->getId()]["vote"] = check_class($yellowpages->getVoteClass()) || USERID == $yellowpages->getOwnerId();
   }

   // Privilege checks
   function canViewyellowpages($yellowpagesId) {
      return $this->privs[$yellowpagesId]["view"];
   }
   function canVoteyellowpages($yellowpagesId) {
      return $this->privs[$yellowpagesId]["vote"];
   }
   function isRestricted($value, $field) {
      return ($value && $value == $this->user["user_$field"]);
   }
}
?>