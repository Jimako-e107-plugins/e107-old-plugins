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
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_item.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for a Item
 */
class yelpItem {
   var $item;        // Am item row

   /**
    * Constructor
    * @param $row a row from the yellowpages categories table
    */
   function yelpItem($row) {
      $this->item = $row;
   }

   // Getters
   function getId() {
      return $this->item["yell_id"];
   }
   function getName() {
      return $this->item["yell_name"];
   }
   function getDescription() {
      return $this->item["yell_description"];
   }
   function getContactName() {
      return $this->item["yell_contact_name"];
   }
   function getTel1() {
      return $this->item["yell_tel1"];
   }
   function getTel2() {
      return $this->item["yell_tel2"];
   }
   function getEMail() {
      return $this->item["yell_email"];
   }
   function getWebsite() {
      return $this->item["yell_website"];
   }
   function getImage() {
      return $this->item["yell_image"];
   }
   function getCategory() {
      return $this->item["yell_category"];
   }
   function getApproved() {
      return $this->item["yell_approved"];
   }
   function getSubmitter() {
      return $this->item["yell_submitter"];
   }
}
?>