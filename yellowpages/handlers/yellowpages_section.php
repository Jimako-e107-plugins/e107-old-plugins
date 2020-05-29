<?php
/*
+---------------------------------------------------------------+
| Yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_section.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for a Section
 */
class yelpSection {
   var $section;     // A section row

   /**
    * Constructor
    * @param $row a row from the yellowpages sections table
    */
   function yelpSection($row) {
      $this->section = $row;
   }

   // Getters
   function getId() {
      return $this->section["yell_section_id"];
   }
   function getName() {
      return $this->section["yell_section_name"];
   }
   function getURL() {
      return $this->section["yell_section_url"];
   }
   function getDescription() {
      return $this->section["yell_section_description"];
   }
   function getIcon() {
      return $this->section["yell_section_icon"];
   }
   function getParentId() {
      return $this->section["yell_section_parent_id"];
   }
   function getTemplate() {
      return $this->section["yell_section_template"];
   }
}
?>