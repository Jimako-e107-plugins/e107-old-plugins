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
| $Source: e:/_repository/e107_plugins/simple_content/e_list.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:50 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   if (!$sql->db_Select("plugin", "*", "plugin_path = 'simple_content' AND plugin_installflag = '1' ")) {
      // Plugin not installed
      return;
   }

   global $pref, $sql2;

   // Include simple_content handlers
   require_once(e_PLUGIN."simple_content/handlers/simple_content_constants.php");

   $LIST_CAPTION        = $arr[0];
   $LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");

   $bullet = $this->getBullet($arr[6], $mode);

   if ($mode == "new_page" || $mode == "new_menu" ) {
      $qry = "and simple_content_lot_update_timestamp>".$this->getlvisit();
   } else {
      $qry = "";
   }

   $qry = "select * from #".SCONTENTC_LOTS_TABLE." left join #".SCONTENTC_AUCTIONS_TABLE." on simple_content_lot_simple_content_id=simple_content_id
           where
            (
               simple_content_owner = ".USERID."
               or simple_content_view_class REGEXP '".e_CLASS_REGEXP."'
               or simple_content_edit_class REGEXP '".e_CLASS_REGEXP."'
            )
            and
               simple_content_lot_timestamp>0
               $qry
            order by
               simple_content_lot_timestamp desc limit 0,".$arr[7]."
   ";

   if (!$sql2->db_Select_gen($qry)) {
      $LIST_DATA = "No lots";
   } else {
      while ($row = $sql2->db_Fetch()) {
         $rowheading          = $this->parse_heading($row['simple_content_lot_title'], $mode);
         $ICON                = $bullet;
         $HEADING             = "<a href='".e_PLUGIN."simple_content/simple_content.php?2.".$row['simple_content_lot_id']."' title='".$row['simple_content_lot_title']."'>".$rowheading."</a>";
         //$user                = getx_user_data($row['simple_content_lot_poster_id']);
         $user                = e107::user($row['simple_content_lot_poster_id']); 
         $AUTHOR              = "<a href='user.php?".$row['simple_content_lot_poster_id']."' title='".$row['simple_content_lot_poster_id']."'>".$user["user_name"]."</a>";
         $CATEGORY            = "<a href='".e_PLUGIN."simple_content/simple_content.php?1.".$row['simple_content_id']."'>".$row["simple_content_name"]."</a>";
         $DATE                = ($arr[5] ? ($row['simple_content_lot_update_timestamp'] > 0 ? $this->getListDate($row['simple_content_lot_update_timestamp'], $mode) : "") : "");
         $INFO                = "";
         $LIST_DATA[$mode][]  = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
      }
   }
?>