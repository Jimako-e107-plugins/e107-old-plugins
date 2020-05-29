<?php
/*
+---------------------------------------------------------------+
| yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/handlers/yellowpages_DAO.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:12 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Class used to control all database access for yellowpages
 */
class yellowpagesDAO {
   var $section;     // Cached section record
   var $catlist;     // Cached categories list
   var $cattree;     // Cached categories tree
   var $parents;     // Cached list of category parents
   var $itemlist;    // Cached entries list

   // Switch debug options on
   var $debug;

   /**
    * Constructor
    */
   function yellowpagesDAO() {
      global $pref;
      $this->debug = false; //"now";
   }

   /**
    * Get a section from a section name
    * @param $name the name of the section to get the ID for
    */
   function getSectionFromName($name) {
      global $sql;
      if (!isset($this->section)) {
  		   if (false !== $res = $sql->db_Select(YELP_SECTIONS_TABLE, "*", "yell_section_name='$name'", true, $this->debug)) {
            $this->section = new yelpSection($sql->db_Fetch());
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }
      return($this->section);
   }

   /**
    * Get a category
    * @param $categoryid ID of the category to get
    */
   function getCategory($categoryid) {
      if (!isset($this->catlist)) {
         $this->getCategoriesList();
      }
      return($this->catlist[$categoryid]);
   }

   /**
    * Get a list of categories
    * @param  $parentid    id of the parent category to get child categories for, or zero (0) to get top level parents
    * @param  $sectionid   id of the section to get categories for, or false to get default categories
    * @param  $initial     limit results to items starting with this character
    * @param  $force       force a refresh of the cached list
    * @return              a list of categories
    */
   function getCategoriesList($parentid=0, $sectionid=false, $initial="", $force=false) {
      global $sql;
      if (!isset($this->catlist) || $force) {
         $this->catlist = array();
  		   if ($res = $sql->db_Select(YELP_CATEGORIES_TABLE, "*", "ORDER BY yell_cat_name", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $category = new yelpCategory($row);
               $this->catlist[$category->getId()] = $category;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }

         // Get item counts for each category
         foreach ($this->catlist as $id=>$cat) {
            $res = $sql->db_Count(YELP_ITEMS_TABLE, "(*)", "WHERE yell_category=$id", $this->debug);
  		      $this->catlist[$id]->setItemCount($res);
         }

         // TODO Not sure if this is needed going forward, left in for now
         // (Re)Build category trees
         $this->parents = array();
         foreach ($this->catlist as $id=>$cat) {
            if ($cat->getParentId() != 0) {
               $this->parents[$id] = $cat->getParentId();
            }
         }

         $this->cattree = array();
         $catlist = $this->_clone($this->catlist);
         while(count($catlist) > 0) {
            foreach ($catlist as $id=>$cat) {
               if ($cat->getParentId() == 0) {
                  // Top level parent
                  $this->cattree[$id] = $cat;
                  unset($catlist[$id]);
               } else {
                  // Child, add to tree and parent if parent exists
                  if (isset($this->cattree[$cat->getParentId()])) {
                     $this->cattree[$id] = $cat;
                     $this->catlist[$cat->getParentId()]->addChildId($id);
                     unset($catlist[$id]);
                  }
               }
            }
         }
      }

      // Get a copy of the object as it may get modified
      $catlist = $this->_clone($this->catlist);
      $catlist = $this->_discard($catlist, $parentid, "getParentId", "getId");
      $catlist = $this->_discard($catlist, $sectionid, "getSectionId", "getId");
      if ($initial != "") {
         foreach ($catlist as $id=>$cat) {
            if (0 == preg_match("/^{$initial}(.*)$/i", $cat->getName(), $matches)) {
               unset($catlist[$id]);
            }
         }
      }
      return $catlist;
   }

   /**
    * Get an item
    * @param $itemid ID of the item to get
    */
   function getItem($itemid) {
      if (!isset($this->itemlist)) {
         $this->getItemsList();
      }
      return($this->itemlist[$itemid]);
   }

   /**
    * Get a list of items for a category
    * @param  $catid    id of the category to get items for
    * @param  $force    force a refresh of the cached list
    * @return           a list of items for a category
    */
   function getItemsList($catid=false, $force=false) {
      global $sql;
      if (!isset($this->itemlist) || $force) {
         $this->itemlist = array();
         $where = $catid ? "WHERE yell_category=$catid" : "";
  		   if ($res = $sql->db_Select(YELP_ITEMS_TABLE, "*", "$where ORDER BY yell_name", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $item = new yelpItem($row);
               $this->itemlist[$item->getId()] = $item;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $itemlist = $this->_clone($this->itemlist);
      return $itemlist;
   }























   /**
    * Get a specific yellowpages
    * @param $yellowpagesid  the yellowpages ID for the yellowpages to be retrieved
    */
   function getyellowpages($yellowpagesid, $getcategories=false) {
      global $sql;

      $yellowpages = false;
  		if ($res = $sql->db_Select(YELP_ITEMS_TABLE, "*", "yellowpages_id=$yellowpagesid", true, $this->debug)) {
         $yellowpages = new yellowpagesyellowpages($sql->db_Fetch(), $getcategories);
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $yellowpages;
   }

   /**
    * Get a list of yellowpagess
    */
   function getyellowpagesList() {
      global $sql;

      $yellowpagesslist = array();
  		if ($res = $sql->db_Select(YELP_ITEMS_TABLE, "*", YELP_yellowpages_ORDER, "no-where", $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $yellowpages = new yellowpagesyellowpages($row);
            if (check_class($yellowpages->getViewClass())) {
               $yellowpagesslist[$yellowpages->getId()] = $yellowpages;
            }
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $yellowpagesslist;
   }

   /**
    * Get a list of entries for an yellowpages
    * $yellowpagesidthe ID of the yellowpages to get votes for
    * @return  a list of entries
    */
   function getVoterList($yellowpagesid) {
      global $sql;

      if (!isset($this->entries) || $force) {
         $this->entries = array();
  		   if ($res = $sql->db_Select(YELP_VOTERS_TABLE, "*", "", "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $vote = new yellowpagesVoter($row);
               $this->entries[$vote->getTimestamp()] = $vote;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $votes = $this->_clone($this->entries);
      if ($yellowpagesid !== false) {
         $votes = $this->_discard($votes, $yellowpagesid, "getId", "getId");
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

  		if ($res = $sql->db_Select(YELP_VOTERS_TABLE, "*", "yellowpages_voter_user_id='$userid'", true, $this->debug)) {
         $voter = new yellowpagesVoter($sql->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $voter;
   }

   /**
    * Get the total number of votes for an yellowpages
    * @param $yellowpagesid ID of yellowpages to get count for
    */
   function getyellowpagesVoterCount($yellowpagesid) {
      global $sql;
      return $sql->db_Count(YELP_VOTERS_TABLE, "(*)", "where yellowpages_voter_yellowpages_id=$yellowpagesid", $this->debug);
   }

   /**
    * Get the total number of votes for a category
    * @param $categoryid ID of category to get count for
    */
   function getCategoryVoterCount($categoryid) {
      global $sql;
      return $sql->db_Count(YELP_VOTERS_TABLE, "(*)", "where yellowpages_voter_votes REGEXP('(^|,)($categoryid)(,|$)')", $this->debug);
   }

   /**
    * Cast a vote
    * @param $yellowpagesid   the id of the yellowpages that the votes are for
    * @param $vote         a populated vote object
    */
   function castVote($yellowpagesid, $votes) {
      global $sql, $tp;
      $qry = array();
      $qry[] = "'".USERID."'";               // voter ID
      $qry[] = "'$yellowpagesid'";              // yellowpages ID
      $qry[] = "'".implode(",", $votes)."'"; // votes
      $qry[] = "'".time()."'";               // timestamp
      $qry = implode(",", $qry);
      if (false !== $sql->db_Insert(YELP_VOTERS_TABLE, $qry, $this->debug)) {
         return true;
      } else {
         $statusInfo = new yellowpagesStatusInfo(STATUS_ERROR);
         $statusInfo->addMessage(YELP_LAN_MSG_DB_ADD, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Check if the current user has voted in the supplied yellowpages
    * @param $yellowpagesid  the yellowpages ID for the yellowpages to be checked
    */
   function hasVoted($yellowpagesid) {
      global $sql;

      $yellowpages = false;
  		if ($res = $sql->db_Select(YELP_VOTERS_TABLE, "*", "yellowpages_voter_user_id=".USERID, true, $this->debug)) {
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
    * @param $wanted    a comma separated list of IDs for which items are to be returned, defaults to false to get all items
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