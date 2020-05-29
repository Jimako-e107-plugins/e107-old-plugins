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
| $Source: e:\_repository\e107_plugins/auction/handlers/auction_user.php,v $
| $Revision: 1.2 $
| $Date: 2008/06/28 05:52:49 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
/**
 * Model Object for an Auction user
 * Holds information relating to the current user and what they are allowed to do in Auction
 */
class auctionUser {
   var $privs;    // an array of auction privilieges, index on auction ID

   /**
    * Constructor
    * @param $auctions  a Auction object or an array of Auction objects
    */
   function auctionUser($auctions) {
      global $pref;
      if (!is_array($auctions)) {
         $auctionlist[$auctions->getId()] = $auctions;
      } else {
         $auctionlist = $auctions;
      }

      foreach ($auctionlist as $auction) {
         $this->setEditAuction($auction);
         $this->setViewAuction($auction);
      }
   }
   // Setters
   function setEditAuction($auction) {
      $this->privs[$auction->getId()]["edit"] = check_class($auction->getEditClass()) || USERID == $auction->getOwnerId();
   }
   function setViewAuction($auction) {
      $this->privs[$auction->getId()]["view"] = check_class($auction->getViewClass());
   }
   // Privilege checks
   function canEditAuction($aucId) {
      return $this->privs[$aucId]["edit"];
   }
   function canViewAuction($aucId) {
      return $this->privs[$aucId]["view"];
   }
}
?>