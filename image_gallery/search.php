<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/search.php
|
| Revision: 0.9.6.2
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

$advanced_where = "";

// The fields that will be returned by the SQL
$return_fields = "im_id, im_album_id, im_title, im_description,
   im_image, im_thumbnail";

// The fields that can be search for matches
$search_fields = array("im_title",
                       "im_description");

// A weighting for the importance of finding a match in each of the search fields
$weights = array("1.2", "0.8");

// Message to be displayed when no matches found
$no_results = LAN_198;

// The SQL WHERE clause, if any
$where = "1 and".$advanced_where;

// The SQL ORDER BY columns as a keyed array
$order = array('im_id' => DESC);

// The table(s) to be searched
$table = "tbl_image";

// Perform the search
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights,
                        'search_image', $no_results, $where, $order);

// Assign the results to specific variables
$text .= $ps['text'];
$results = $ps['results'];

// A callback function (name is passed to the parsesearch() function above)
// It is passed a single row from the DB result set
function search_image($row) {
   global $pref;
   global $con;

   // Populate as many of the $res array keys as is sensible for the plugin   ?page=image-detail&album=14&image=39
   $res['link'] = e_PLUGIN."image_gallery/image_gallery.php?page=image-detail&amp;album=".$row['im_album_id']."&amp;image=".$row['im_id'];
   $res['pre_title'] = "";
   $res['title'] = $row["im_title"];
   $res['pre_summary'] = "<div class='smalltext' style='padding: 2px 0px'>";
   //viewImage.php?type=glthumbnail&name=0e0e1aa7fb1af38340f4dbca4d27aa0a.jpg
   //<img src="winter_01.jpg" width="800" height="628" border="0">
   $res['pre_summary'] .= "<img src='".e_PLUGIN."image_gallery/viewImage.php?type=glthumbnail&name=".$row['im_thumbnail']."'/>";
   //$res['pre_summary'] .= $pref["election_separator"]."23";
   //$res['pre_summary'] .= "<a href='".e_PLUGIN."image_gallery/image_gallery.php?".ELECC_CANDIDATES_PAGE.".".$row["election_id"]."'>".$row['election_name']."asdd</a>";
   $res['pre_summary'] .= "</div>";
   $res['summary'] = "Description: ".$row["im_description"];
   //$res['detail'] = "<a href='".$row['election_candidate_link_url']."'>".$row['election_candidate_link_description']."aqwe</a>";
   return $res;
}
?>
