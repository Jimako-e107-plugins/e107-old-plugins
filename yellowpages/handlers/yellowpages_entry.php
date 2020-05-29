<?
/*
+---------------------------------------------------------------+
| Yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_entry.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Yellowpages Category
 */
class yellowpagesCategory {
   var $category;   // An array of category field values

   /**
    * Constructor
    * @param $category a row from the categories table
    * @param $yellowpages  an yellowpages object for the yellowpages that this category belongs to
    */
   function yellowpagesCategory($category=false, $yellowpages=false) {
      // Set some default values
      $this->category["yellowpages_category_yellowpages_ids"]   = $yellowpages ? $yellowpages->getId() : 0;

      if ($category) {
         $this->category = array_merge($this->category, $category);
      }
   }

   // Getters
   function getId() {
      return $this->category["yellowpages_category_id"];
   }
   function getYellowpagesId() {
      return $this->category["yellowpages_category_yellowpages_ids"];
   }
   function getName() {
      return $this->category["yellowpages_category_name"];
   }
   function getTitle() {
      return $this->category["yellowpages_category_title"];
   }
   function getDescription() {
      return $this->category["yellowpages_category_description"];
   }
   function getIcon() {
      return $this->category["yellowpages_category_icon"];
   }
   function getImages() {
      return $this->category["yellowpages_category_images"];
   }
   function getLinkDescription() {
      return $this->category["yellowpages_category_link_description"];
   }
   function getLinkURL() {
      return $this->category["yellowpages_category_link_url"];
   }
   function getTemplate() {
      return $this->category["yellowpages_category_template"];
   }
   function getRestrictionValue() {
      return $this->category["yellowpages_category_vote_restriction_value"];
   }
   function getRestrictionField() {
      return $this->category["yellowpages_category_vote_restriction_field"];
   }
}
?>