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
| $Source: e:\_repository\e107_plugins/bugtracker3/handlers/bugtracker3_relationship.php,v $
| $Revision: 1.1 $
| $Date: 2006/11/07 23:51:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Bugtracker3 Relationship
 */
class bugtracker3Relationship {
   var $relationship;   // row from the database relationship table

   /**
    * Constructor
    * @param   a relationship row (array) from the database table
    */
   function bugtracker3Relationship($row) {
      $this->relationship = $row;
   }

   // Getters
   function getPrimaryId() {
      return $this->relationship["bugtracker3_rels_primary_id"];
   }
   function getSecondaryId() {
      return $this->relationship["bugtracker3_rels_secondary_id"];
   }
   function getRelationship() {
      return $this->relationship["bugtracker3_rels_relationship"];
   }
   function getPrimaryRelationshipText() {
      switch ($this->relationship["bugtracker3_rels_relationship"]) {
         case 0 : return BUG_LAN_RELATION_0;
         case 1 : return BUG_LAN_RELATION_1;
         case 2 : return BUG_LAN_RELATION_2;
         case 3 : return BUG_LAN_RELATION_3;
      }
   }
   function getSecondaryRelationshipText() {
      switch ($this->relationship["bugtracker3_rels_relationship"]) {
         case 0 : return BUG_LAN_RELATION_0_REV;
         case 1 : return BUG_LAN_RELATION_1_REV;
         case 2 : return BUG_LAN_RELATION_2_REV;
         case 3 : return BUG_LAN_RELATION_3_REV;
      }
   }
}
?>