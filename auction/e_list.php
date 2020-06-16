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
| $Source: e:\_repository\e107_plugins/auction/e_list.php,v $
| $Revision: 1.3 $
| $Date: 2008/06/28 05:45:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   if (!$sql->db_Select("plugin", "*", "plugin_path = 'auction' AND plugin_installflag = '1' ")) {
      // Plugin not installed
      return;
   }

   global $pref, $sql2;

   // Include auction handlers
   require_once(e_PLUGIN."auction/handlers/auction_constants.php");

   $LIST_CAPTION        = $arr[0];
   $LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");

   $bullet = $this->getBullet($arr[6], $mode);

   if ($mode == "new_page" || $mode == "new_menu" ) {
      $qry = "and auction_lot_update_timestamp>".$this->getlvisit();
   } else {
      $qry = "";
   }

   $qry = "select * from #".AUCC_LOTS_TABLE." left join #".AUCC_AUCTIONS_TABLE." on auction_lot_auction_id=auction_id
           where
            (
               auction_owner = ".USERID."
               or auction_view_class REGEXP '".e_CLASS_REGEXP."'
               or auction_edit_class REGEXP '".e_CLASS_REGEXP."'
            )
            and
               auction_lot_timestamp>0
               $qry
            order by
               auction_lot_timestamp desc limit 0,".$arr[7]."
   ";

   if (!$sql2->db_Select_gen($qry)) {
      $LIST_DATA = "No lots";
   } else {
      while ($row = $sql2->db_Fetch()) {
         $rowheading          = $this->parse_heading($row['auction_lot_title'], $mode);
         $ICON                = $bullet;
         $HEADING             = "<a href='".e_PLUGIN."auction/auction.php?2.".$row['auction_lot_id']."' title='".$row['auction_lot_title']."'>".$rowheading."</a>";
         //$user                = getx_user_data($row['auction_lot_poster_id']);
         $user                = e107::user($row['auction_lot_poster_id']);
         $AUTHOR              = "<a href='user.php?".$row['auction_lot_poster_id']."' title='".$row['auction_lot_poster_id']."'>".$user["user_name"]."</a>";
         $CATEGORY            = "<a href='".e_PLUGIN."auction/auction.php?1.".$row['auction_id']."'>".$row["auction_name"]."</a>";
         $DATE                = ($arr[5] ? ($row['auction_lot_update_timestamp'] > 0 ? $this->getListDate($row['auction_lot_update_timestamp'], $mode) : "") : "");
         $INFO                = "";
         $LIST_DATA[$mode][]  = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
      }
   }
?>