<?php
/*
+---------------------------------------------------------------+
| Auction by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_DAO.php,v $
| $Revision: 1.4 $
| $Date: 2008/06/28 05:50:25 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Class used to control all database access for auction
 */
class auctionDAO {
   var $lots;        // Cached lots list
   var $bids;        // Cached bids list
   var $posters;     // Cached posters list
   var $owners;      // Cached owners list

   // Switch debug options on
   var $debug;

   /**
    * Constructor
    */
   function auctionDAO() {
      global $pref;
      $this->debug = false; //"now";
   }

   /**
    * Get a count of auctions
    */
   function getAuctionCount() {
      return count($this->getAuctionList());
   }

   /**
    * Get a specific auction
    * @param $aucid  the auction ID for the auction to be retrieved
    */
   function getAuction($aucid, $getlots=false) {
      global $sql;

      $auction = false;
  		if ($res = $sql->db_Select(AUCC_AUCTIONS_TABLE, "*", "auction_id=$aucid", true, $this->debug)) {
         $auction = new auctionAuction($sql->db_Fetch(), $getlots);
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $auction;
   }

   /**
    * Get a list of auctions
    */
   function getAuctionList() {
      global $sql;

      $auctionslist = array();
  		if ($res = $sql->db_Select(AUCC_AUCTIONS_TABLE, "*", AUC_AUCTION_ORDER, "no-where", $this->debug)) {
         while ($row = $sql->db_Fetch()) {
            $auction = new auctionAuction($row);
            $auctionslist[$auction->getId()] = $auction;
         }
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $auctionslist;
   }

   /**
    * Get a list of lots for an auction
    * @param  $aucid auction ID to get lots for, or false to get all lots
    * @param  $force force a refresh of the cached list
    * @return        a list of lots
    */
   function getLotList($aucid=false, $force=false) {
      global $sql;

      if (!isset($this->lots) || $force) {
         $this->lots = array();
  		   if ($res = $sql->db_Select(AUCC_LOTS_TABLE, "*", AUCC_LOTS_ORDER, "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $lot = new auctionLot($row);
               $this->lots[$lot->getId()] = $lot;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }

      // Get a copy of the object as it may get modified
      $lots = $this->_clone($this->lots);
      if ($aucid !== false) {
         $lots = $this->_discard($lots, $aucid, "getAuctionId");
      }

      return $lots;
   }

   /**
    * Get a bid
    * @param $ts     Timestamp of the bid to get
    * @param $lotid  Lot ID of the bid to get
    */
   function getBid($ts, $lotid) {
      global $sql;

  		if ($res = $sql->db_Select(AUCC_BIDS_TABLE, "*", "where auction_bid_timestamp='$ts' AND auction_bid_lot_id=$lotid ", "no-where", $this->debug)) {
         $bid = new auctionBid($sql->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $bid;
   }

   /**
    * Get a list of bids for a lot
    * @param  $lotid lot ID to get bids for, or false to get all bids
    * @return        a list of bids
    * @param  $force force a refresh of the cached list
    */
   function getBidList($lotid=false, $force=false) {
      global $sql;

      if (!isset($this->bids) || $force) {
         $this->bids = array();
  		   if ($res = $sql->db_Select(AUCC_BIDS_TABLE, "*", AUCC_BIDS_ORDER, "no-where", $this->debug)) {
            while ($row = $sql->db_Fetch()) {
               $bid = new auctionBid($row);
               $this->bids[$bid->getTimestamp()] = $bid;
            }
         } else {
            if (mysql_errno() != 0) {
               echo "<br>**".mysql_errno()." : ".mysql_error();
            }
         }
      }
      // Get a copy of the object as it may get modified
      $bids = $this->_clone($this->bids);
      if ($lotid !== false) {
         $bids = $this->_discard($bids, $lotid, "getLotId", "getTimestamp");
      }

      return $bids;
   }

   /**
    * Get a lot
    * @param $lotid ID of the lot to get
    */
   function getLot($lotid) {
      global $sql;

  		if ($res = $sql->db_Select(AUCC_LOTS_TABLE, "*", "where auction_lot_id=$lotid ", "no-where", $this->debug)) {
         $lot = new auctionLot($sql->db_Fetch());
      } else {
         if (mysql_errno() != 0) {
            echo "<br>**".mysql_errno()." : ".mysql_error();
         }
      }

      return $lot;
   }

   /**
    * Get the total number of lots for an auction/all auctions
    * @param $aucid ID of auction to get count for or false to get count of all lots in all auctions
    */
   function getLotCount($aucid=false) {
      global $sql;
      if ($aucid) {
	      return $sql->db_Count(AUCC_LOTS_TABLE, "(*)", "where auction_lot_auction_id=$aucid", $this->debug);
	   } else {
	      return $sql->db_Count(AUCC_LOTS_TABLE, "(*)", "", $this->debug);
	   }
   }

   /**
    * Submit a new lot
    */
   function submitLot($lot, $auc) {
      global $auction, $sql, $tp;

      $qry = array();
      $qry[] = "'0'";                                          // id
      $qry[] = "'".$tp->toDB($auction->getId())."'";           // auction id
      $qry[] = "'".$tp->toDB($lot->getTitle())."'";            // name
      $qry[] = "'".$tp->toDB($lot->getDescription())."'";      // description
      $qry[] = "'".$tp->toDB($lot->getImages())."'";           // images
      $qry[] = "'".$tp->toDB($lot->getReserve())."'";          // reserve
      //$qry[] = "'".$tp->toDB($lot->getStartDate())."'";        // start date (future)
      //$qry[] = "'".$tp->toDB($lot->getEndDate())."'";          // end date (future)
      $qry[] = "'0'";                                          // start date
      $qry[] = "'0'";                                          // end date
      $qry[] = "'".time()."'";                                 // timestamp
      $qry[] = "'".USERID."'";                                 // poster id
      $qry[] = "'".time()."'";                                 // update timestamp
      $qry[] = "'".USERID."'";                                 // update poster id
      $qry = implode(",", $qry);
      if ($id = $sql->db_Insert(AUCC_LOTS_TABLE, $qry, $this->debug)) {
         return $id;
      } else {
         $statusInfo = new auctionStatusInfo(STATUS_FATAL);
         $statusInfo->addMessage(AUC_LAN_MSG_DB_ADD, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Update a lot
    */
   function updateLot($lot) {
      global $sql, $tp;

      $qry = array();
      $qry[] = "auction_lot_auction_id='".$lot->getAuctionId(AUCC_UI)."'";                // auction id
      $qry[] = "auction_lot_title='".$tp->toDB($lot->getTitle(AUCC_UI))."'";               // title
      $qry[] = "auction_lot_description='".$tp->toDB($lot->getDescription(AUCC_UI))."'";  // description
      $qry[] = "auction_lot_images='".$tp->toDB($lot->getImages(AUCC_UI))."'";            // images
      $qry[] = "auction_lot_reserve='".$tp->toDB($lot->getReserve(AUCC_UI))."'";          // reserve
      //$qry[] = "auction_lot_start_date='".$tp->toDB($lot->getEndDate(AUCC_UI))."'";       // start date
      //$qry[] = "auction_lot_end_date='".$tp->toDB($lot->getStartDate(AUCC_UI))."'";       // end date
      $qry[] = "auction_lot_update_timestamp='".time()."'";                               // last update timestamp
      $qry[] = "auction_lot_update_poster_id='".USERID."'";                               // last update poster
      $qry = implode(",", $qry);
      $qry .= " where auction_lot_id=".$lot->getId()."";
      if (false !== $id = $sql->db_Update(AUCC_LOTS_TABLE, $qry, $this->debug)) {
         return $id;
      } else {
         $statusInfo = new auctionStatusInfo();
         $statusInfo->addMessage(AUC_LAN_MSG_DB_UPDATE, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Add a bid
    * @param $bid a populated bid object
    */
   function addBid($bid) {
      global $sql, $tp;
      $qry = array();
      $qry[] = "'".$bid->getTimestamp()."'";                   // timestamp
      $qry[] = "'".$tp->toDB($bid->getLotId(AUCC_UI))."'";     // lot id
      $qry[] = "'".$tp->toDB($bid->getBidderId(AUCC_UI))."'";  // bidder id
      $qry[] = "'".$tp->toDB($bid->getAmount(AUCC_UI))."'";    // amount
      $qry[] = "'".$tp->toDB($bid->getName(AUCC_UI))."'";      // name
      $qry[] = "'".$tp->toDB($bid->getEMail(AUCC_UI))."'";     // email
      $qry[] = "'".$tp->toDB($bid->getTelephone(AUCC_UI))."'"; // telephone
      $qry[] = "'0'";                                          // deleted
      $qry = implode(",", $qry);
      if (false !== $sql->db_Insert(AUCC_BIDS_TABLE, $qry, $this->debug)) {
         return true;
      } else {
         $statusInfo = new auctionStatusInfo(STATUS_FATAL);
         $statusInfo->addMessage(AUC_LAN_MSG_DB_ADD, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
      }
   }

   /**
    * Update a bid - only deleted flag can be updated
    * @param $bid a populated bid object
    */
   function updateBid($bid) {
      global $sql, $tp;

      $qry = array();
      $qry[] = "auction_bid_deleted='".$bid->getDeleted()."'"; // deleted flag
      $qry = implode(",", $qry);
      $qry .= " where auction_bid_timestamp=".$bid->getTimestamp()."";
      $qry .= " and auction_bid_lot_id=".$bid->getLotId()."";
      if (false !== $sql->db_Update(AUCC_BIDS_TABLE, $qry, $this->debug)) {
         return true;
      } else {
         $statusInfo = new auctionStatusInfo();
         $statusInfo->addMessage(AUC_LAN_MSG_DB_UPDATE, mysql_errno()." : ".mysql_error().", query string is ".$qry);
         return $statusInfo;
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