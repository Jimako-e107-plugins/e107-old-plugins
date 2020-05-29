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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_auction.php,v $
| $Revision: 1.2 $
| $Date: 2006/12/09 19:01:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Auction
 */
class auctionAuction {
   var $auction;        // A row from the auctions table
   var $lots;           // Array of lots belonging to this auction
   var $count;          // Number of lots belonging to this auction

   /**
    * Constructor
    * @param $auction a row from the auctions table
    */
   function auctionAuction($auction) {
      $this->debug = false;
      $this->auction = $auction;
   }

   // Getters
   function getId() {
      return $this->auction["auction_id"];
   }
   function getName() {
      return $this->auction["auction_name"];
   }
   function getIcon() {
      return $this->auction["auction_icon"];
   }
   function getDescription() {
      return $this->auction["auction_description"];
   }
   function getStartDate() {
      return $this->auction["auction_start_date"];
   }
   function getEndDate() {
      return $this->auction["auction_end_date"];
   }
   function getEditClass() {
      return $this->auction["auction_edit_class"];
   }
   function getViewClass() {
      return $this->auction["auction_view_class"];
   }
   function getOwnerId() {
      return $this->auction["auction_owner"];
   }
   function getOwner() {
      $user = get_user_data($this->getOwnerId());
      return $user["user_name"];
   }
   function getTemplate() {
      return $this->auction["auction_template"];
   }
   function canPost() {
      return $this->auction["auction_closed"] == 0;
   }
   function getLotTotal() {
      global $auction;
      $dao = $auction->getDAO();
      if (!isset($this->count)) {
  		   $this->count = $dao->getLotCount($this->getId());
      }
      return $this->count;
   }
   function isOpen() {
      return $this->getStartDate() < time() && time() < $this->getEndDate();
   }
   function isFinished() {
      return time() > $this->getEndDate();
   }
}
?>