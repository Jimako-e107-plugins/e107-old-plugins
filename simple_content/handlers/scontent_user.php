<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_user.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:54 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an SimpleContent user
 * Holds information relating to the current user and what they are allowed to do in SimpleContent
 */
class simple_contentUser {
   var $privs;    // an array of simple_content privilieges, index on simple_content ID

   /**
    * Constructor
    * @param $simple_contents  a SimpleContent object or an array of SimpleContent objects
    */
   function simple_contentUser($simple_contents) {
      global $pref;
      if (!is_array($simple_contents)) {
         $simple_contentlist[$simple_contents->getId()] = $simple_contents;
      } else {
         $simple_contentlist = $simple_contents;
      }

      foreach ($simple_contentlist as $simple_content) {
         $this->setEditSimpleContent($simple_content);
         $this->setViewSimpleContent($simple_content);
      }
   }
   // Setters
   function setEditSimpleContent($simple_content) {
      $this->privs[$simple_content->getId()]["edit"] = check_class($simple_content->getEditClass()) || USERID == $simple_content->getOwnerId();
   }
   function setViewSimpleContent($simple_content) {
      $this->privs[$simple_content->getId()]["view"] = check_class($simple_content->getViewClass());
   }
   // Privilege checks
   function canEditSimpleContent($aucId) {
      return $this->privs[$aucId]["edit"];
   }
   function canViewSimpleContent($aucId) {
      return $this->privs[$aucId]["view"];
   }
}
?>