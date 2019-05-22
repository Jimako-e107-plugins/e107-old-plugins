<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/e_list.php,v $
| $Revision: 1.1.2.2 $
| $Date: 2006/11/12 20:02:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

   if (!$sql->db_Select("plugin", "*", "plugin_path = 'links_page' AND plugin_installflag = '1' ")) {
      // Plugin not installed
      return;
   }

   global $pref, $sql2;

   // Include bugtracker handlers
   require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_constants.php");

   $LIST_CAPTION        = $arr[0];
   $LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");

   $bullet = $this->getBullet($arr[6], $mode);

   if ($mode == "new_page" || $mode == "new_menu" ) {
      $qry = "and bugtracker3_bugs_timestamp>".$this->getlvisit();
   } else {
      $qry = "";
   }

   $qry = "select * from #".BUGC_BUGS_TABLE." left join #".BUGC_APPS_TABLE." on bugtracker3_bugs_application_id=bugtracker3_apps_id
           where
            (
               bugtracker3_apps_owner = ".USERID."
               or bugtracker3_apps_userclass REGEXP '".e_CLASS_REGEXP."'
               or bugtracker3_apps_editclass REGEXP '".e_CLASS_REGEXP."'
               or bugtracker3_apps_postclass REGEXP '".e_CLASS_REGEXP."'
            )
            and
               bugtracker3_bugs_timestamp>0
               $qry
            order by
               bugtracker3_bugs_timestamp desc limit 0,".$arr[7]."
   ";

   if (!$sql2->db_Select_gen($qry)) {
      $LIST_DATA = "No bugs";
   } else {
      while ($row = $sql2->db_Fetch()) {
         $rowheading          = $this->parse_heading($row['bugtracker3_bugs_summary'], $mode);
         $ICON                = $bullet;
         $HEADING             = "<a href='".e_PLUGIN."bugtracker3/bugtracker3.php?2.".$row['bugtracker3_bugs_id']."' title='".$row['bugtracker3_bugs_summary']."'>".$rowheading."</a>";
         $user                = get_user_data($row['bugtracker3_bugs_poster']);
         $AUTHOR              = "<a href='user.php?".$row['bugtracker3_bugs_poster']."' title='".$row['bugtracker3_bugs_poster']."'>".$user["user_name"]."</a>";
         $CATEGORY            = "<a href='".e_PLUGIN."bugtracker3/bugtracker3.php?1.".$row['bugtracker3_apps_id']."'>".$row["bugtracker3_apps_name"]."</a>";
         $DATE                = ($arr[5] ? ($row['bugtracker3_bugs_timestamp'] > 0 ? $this->getListDate($row['bugtracker3_bugs_timestamp'], $mode) : "") : "");
         $INFO                = "";
         $LIST_DATA[$mode][]  = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
      }
   }
?>