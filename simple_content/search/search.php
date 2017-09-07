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
| $Source: e:/_repository/e107_plugins/simple_content/search/search.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:54 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include simple_content handlers
require_once(e_PLUGIN."simple_content/handlers/scontent_constants.php");
// Default (Basic) search options
$advanced_where = "";
$search_fields = array("scontent_item_name");
$weights = array("1.2", "0.8");
$return_fields = "scontent_item_id, scontent_item_name, scontent_item_last_updated, scontent_cat_id, scontent_cat_name, scontent_group_id, scontent_group_name";

// Check for advanced options being selected
//debug($_GET);
if (isset($_GET['group']) && is_numeric($_GET['group'])) {
   $advanced_where .= " scontent_group_id=".$_GET['group']." and";
}
if (isset($_GET['category']) && is_numeric($_GET['category'])) {
   $SimpleContentCat = $_GET['category'];
   $advanced_where .= " scontent_cat_id=".$SimpleContentCat." and";
   if (!isset($_GET['category_all_fields'])) {
      $search_fields = array();
      $weights = array();
      for ($i=1; $i < 10; $i++) {
         $fieldid = "scontent_item_all_fields_".$SimpleContentCat."_".$i;
         if (isset($_GET[$fieldid])) {
            array_push($search_fields, "scontent_item_f".$i);
            $return_fields .= ", scontent_item_f".$i;
            array_push($weights, "0.5");
         }
      }
   }
}
$no_results = LAN_198;
$where = "";
$where = "1 and".$advanced_where;
$order = array('scontent_item_name' => ASC);
$table = SCONTENTC_CATEGORIES_TABLE
         ." left join #".SCONTENTC_ITEMS_TABLE." on scontent_cat_id=scontent_item_cat_id"
         ." left join #".SCONTENTC_GROUPS_TABLE." on scontent_cat_group_id=scontent_group_id";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_scontent', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_scontent($row) {
   global $pref, $con;

   $res['link']         = e_PLUGIN."simple_content/scontent.php?".urlencode($row["scontent_group_name"].".".$row["scontent_cat_name"].".".$row["scontent_item_name"]);
   $res['pre_title']    = "";
   $res['title']        = $row["scontent_item_name"];
   $res['pre_summary']  = "<span class='smalltext'>";
   $res['pre_summary'] .= "<a href='".e_PLUGIN."simple_content/scontent.php?".urlencode($row["scontent_group_name"])."'>".$row['scontent_group_name']."</a>";
   $res['pre_summary'] .= $pref["simple_content_separator"];
   $res['pre_summary'] .= "<a href='".e_PLUGIN."simple_content/scontent.php?".urlencode($row["scontent_group_name"].".".$row["scontent_cat_name"])."'>".$row['scontent_cat_name']."</a>";
   $res['pre_summary'] .= "</span>";
   $res['summary']      = "";
   $res['post_summary'] = "";
   for ($i=1; $i < 10; $i++) {
      $fieldid = "scontent_item_f".$i;
      if (isset($row[$fieldid])) {
         //$res['summary']     .= $row[$fieldid]." .. ";
      }
   }
   $res['detail']       = SCONTENT_LAN_SEARCH_UPDATED_ON." ".$con->convert_date($row['scontent_item_last_updated'], "long");
   return $res;
}

?>