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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_developer_comments.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Developer Comment
 */
class bugtracker3DeveloperComment {
   var $devc;     // row from the database developer comments table

   /**
    * Constructor
    * @param   a developer comment row (array) from the database table
    */
   function bugtracker3DeveloperComment($row) {
      $this->devc = $row;
   }

   // Getters
   function getTimestamp() {
      return $this->devc["bugtracker3_devc_timestamp"];
   }
   function getBugId() {
      return $this->devc["bugtracker3_devc_bugid"];
   }
   function getPosterId() {
      return $this->devc["bugtracker3_devc_poster"];
   }
   function getPoster() {
      //$user = getx_user_data($this->getPosterId());
      $user = e107::user($this->getPosterId());
      return $user["user_name"];
   }
   function getComment() {
      return $this->devc["bugtracker3_devc_comment"];
   }
}
?>