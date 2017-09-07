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
| $Source: e:/_repository/e107_plugins/simple_content/handlers/scontent_DAO.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:53 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Class used to control all database access for simple_content
 */
class simple_contentDAO {
   // Switch debug options on
   var $debug;

   /**
    * Constructor
    */
   function simple_contentDAO() {
      global $pref;
      $this->debug = false; //"notnow";
   }

   /**
    * Get a specific group
    * @param $name   the group name to be retrieved
    */
   function getGroup($name) {
      global $e107cache, $pref, $sql2;
      $group = false;

      if ($group = $e107cache->retrieve(SCONTENT_CACHE_GROUP."_{$name}", false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($group);
      }
  		if ($res = $sql2->db_Select(SCONTENTC_GROUPS_TABLE, "*", "scontent_group_name='{$name}'", true, $this->debug)) {
         $group = new SimpleContentGroup($sql2->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if ($group !== false) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_GROUP."_{$name}", serialize($group), $pref["scontent_force_cache"]);
      }
      return $group;
   }

   /**
    * Get a list of all groups
    */
   function getGroups() {
      global $e107cache, $pref, $sql;

      if ($groups = $e107cache->retrieve(SCONTENT_CACHE_GROUP, false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($groups);
      }

      $groups = array();
  		if ($res = $sql->db_Select(SCONTENTC_GROUPS_TABLE, "*", SCONTENTC_GROUPS_ORDER, "no-where", $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $group = new SimpleContentGroup($row);
            $groups[$group->getId()] = $group;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if (count($groups) > 0) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_GROUP, serialize($groups), $pref["scontent_force_cache"]);
      }
      return $groups;
   }

   /**
    * Get a specific category
    * @param $key the category name or ID retrieved - assumes ID if value is numeric
    */
   function getCategory($key) {
      global $e107cache, $pref, $sql2;

      if ($category = $e107cache->retrieve(SCONTENT_CACHE_CATEGORY."_{$key}", false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($category);
      }

      $category = false;
      $query = (is_numeric($key)) ? "scontent_cat_id='{$key}'" : "scontent_cat_name='{$key}'";
  		if ($res = $sql2->db_Select(SCONTENTC_CATEGORIES_TABLE, "*", $query, true, $this->debug)) {
         $category = new SimpleContentCategory($sql2->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if ($category !== false) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_CATEGORY."_{$key}", serialize($category), $pref["scontent_force_cache"]);
      }
      return $category;
   }

   /**
    * Get a list of all categories for a group
    * @param $groupid   group id to retrieve categories for, blank to get all categories
    */
   function getCategories($groupid=false) {
      global $e107cache, $pref, $sql;

      if ($categories = $e107cache->retrieve(SCONTENT_CACHE_CATEGORY, false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($categories);
      }

      $categories = array();
      $query = $groupid ? "scontent_cat_group_id={$groupid}" : "1=1";
  		if ($res = $sql->db_Select(SCONTENTC_CATEGORIES_TABLE, "*", $query.SCONTENTC_CATEGORIES_ORDER, true, $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $category = new SimpleContentCategory($row);
            $categories[$category->getId()] = $category;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if (count($categories) > 0) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_CATEGORY, serialize($categories), $pref["scontent_force_cache"]);
      }
      return $categories;
   }

   /**
    * Get a specific item
    * @param $key the item name or ID retrieved - assumes ID if value is numeric
    */
   function getItem($key) {
      global $e107cache, $pref, $sql2;

      if ($item = $e107cache->retrieve(SCONTENT_CACHE_ITEM."_{$key}", false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($item);
      }

      $item = false;
      $query = (is_numeric($key)) ? "scontent_item_id={$key}" : "scontent_item_name='{$key}'";
  		if ($res = $sql2->db_Select(SCONTENTC_ITEMS_TABLE, "*", $query, true, $this->debug)) {
         $item = new SimpleContentItem($sql2->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if ($item !== false) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_ITEM."_{$key}", serialize($item), $pref["scontent_force_cache"]);
      }
      return $item;
   }

   /**
    * Get a list of all items for a category
    * @param $catid   category id to retrieve items for
    */
   function getItems($catid) {
      global $e107cache, $pref, $sql;

      if ($items = $e107cache->retrieve(SCONTENT_CACHE_ITEM, false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($items);
      }

      $items = array();
  	   if ($res = $sql->db_Select(SCONTENTC_ITEMS_TABLE, "*", "scontent_item_cat_id={$catid} ".SCONTENTC_ITEMS_ORDER, true, $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $item = new SimpleContentItem($row);
            $items[$item->getId()] = $item;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if (count($items) > 0) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_ITEM, serialize($items), $pref["scontent_force_cache"]);
      }
      return $items;
   }

   /**
    * Get a list of all related items for an item
    * @param $itemid   item id to retrieve items for
    */
   function getRelatedItems($itemid) {
      global $e107cache, $pref, $sql;

      if ($items = $e107cache->retrieve(SCONTENT_CACHE_RELATED_ITEM, false, $pref["scontent_force_cache"])) {
         //TODO broken cache? return unserialize($items);
      }

      $items = array();
  	   if ($res = $sql->db_Select(SCONTENTC_RELATIONSHIPS_TABLE, "*", "scontent_rel_parent_item_id={$itemid} ".SCONTENTC_RELATIONSHIPS_ORDER, true, $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $parent = $this->getItem($row["scontent_rel_parent_item_id"]);
            $child = $this->getItem($row["scontent_rel_child_item_id"]);
            $child->setCategory($this->getCategory($child->getCategoryId()));
            $items[$child->getId()] = $child;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

  	   if ($res = $sql->db_Select(SCONTENTC_RELATIONSHIPS_TABLE, "*", "scontent_rel_child_item_id={$itemid} ".SCONTENTC_RELATIONSHIPS_ORDER, true, $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $parent = $this->getItem($row["scontent_rel_child_item_id"]);
            $child = $this->getItem($row["scontent_rel_parent_item_id"]);
            $child->setCategory($this->getCategory($child->getCategoryId()));
            $items[$child->getId()] = $child;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      if (count($items) > 0) {
         //TODO broken cache? $e107cache->set(SCONTENT_CACHE_RELATED_ITEM, serialize($items), $pref["scontent_force_cache"]);
      }
      return $items;
   }
}
?>