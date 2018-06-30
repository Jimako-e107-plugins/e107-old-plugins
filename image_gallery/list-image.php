<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/list-image.php
|
| Revision: 0.9.7
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
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}

if (is_int((int)$_GET['album']))
{
    $albumId = (int)$_GET['album'];
}else{
    $albumId = 1;
}

//add pageing
$imagePerPage = $pref['img_imagePerPage'];
$pageNumber  = isset($_GET['pageNum']) ? (int)$_GET['pageNum'] : 1;
$offset = abs($pageNumber - 1) * $imagePerPage; //abs
$serial = $offset + 1;
//end add pageing


$query  = "SELECT im_id, im_title, im_thumbnail, im_description
           FROM `#tbl_image`
		   WHERE im_album_id = '$albumId'
		   ORDER BY im_id";
$mydb->db_Select_gen($query . " LIMIT $offset, $imagePerPage");
$result = $mydb->mySQLrows;
if ($result == 0) {
	$text .= "No image in this album yet";
} else {

	$text .= "<table class='fborder' width='100%' cellspacing='1' cellpadding='2'>";

	// the image is listed in a table here we specify how many columns we want to show on each row
    $colsPerRow = $pref['img_colsPerRow'];

	// width of each column in percent
	$colWidth   = (int)(100/$colsPerRow);
	$i = 0;

    $mydb2 = new db();
    $mydb2->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

	while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
		if ($i % $colsPerRow == 0) {
			// start a new row
			$text .= '<tr>';
		}

        $mydb2->db_Select("tbl_comment", "count(im_id) as comments", "im_id = '".$row['im_id']."'");
        $row_comm = $mydb2->db_Fetch(MYSQL_ASSOC);
        //$query_comments = "SELECT count(im_id) as comments FROM ".MPREFIX."tbl_comment WHERE im_id ='".$row['im_id']."'";
        //$result_comments = mysql_query($query_comments, $conn);
        //$row_comm = mysql_fetch_assoc($result_comments);
        if ($row_comm['comments'] != 0)
        {
           $number_comments = $row_comm['comments'];
        }
        else {$number_comments = 0;}
        //number of comments show
        $mydb2->db_Select("tbl_image", "im_view", "im_id = '".$row['im_id']."'");
        $row_views = $mydb2->db_Fetch(MYSQL_ASSOC);
        //$query_views = "SELECT im_view FROM ".MPREFIX."tbl_image WHERE im_id = '".$row['im_id']."'";
        //$result_views = mysql_query($query_views, $conn);
        //$row_views = mysql_fetch_assoc($result_views);
        $view_count = $row_views['im_view'];
        //END number of comments show
		$text .= '<td class="forumheader2" style="text-align:center;" width="' . $colWidth . '%">
		    <a href="?page=image-detail&amp;album=' . $albumId . '&amp;image=' . $row['im_id'] . '">' . $row['im_title'] . '</a>
		    <br /><a href="?page=image-detail&amp;album=' . $albumId . '&amp;image=' . $row['im_id'] . '">
		    <img style="margin:4px;" src="viewImage.php?type=glthumbnail&amp;name=' . $row['im_thumbnail'] . '" border="0" alt="'. $row['im_title'] .'" /></a>
		    <br /><div class="smalltext" style="text-align: left;"><b>'. image_gallery_CONFIG_L9 .' : </b> ' . $row['im_description'] . '</div>
            <div class="smalltext" style="text-align: left;"><b>'. image_gallery_Lancomments .' : </b> ' . $number_comments . '</div>
            <div class="smalltext" style="text-align: left;"><b>'. image_gallery_CONFIG_L70 . ' : </b> ' . $view_count. '</div></td>';

		if ($i % $colsPerRow == $colsPerRow - 1) {
			// start a new row
			$text .= '</tr>';
		}

		$i += 1;
	}

	// print blank columns
	if ($i % $colsPerRow != 0) {
		while ($i++ % $colsPerRow != 0) { //for empty places when row is not full
			$text .= "<td width='" . $colWidth . "%'>&nbsp;</td>";
		}
		$text .= "</tr>";
	}
    //add pageing
    //$text .="<tr><td class='pageing'>";
    $text .="<tr><td colspan='".$colsPerRow."' style='text-align:center'>";
    $mydb->db_Select_gen($query);
    $totalResults = $mydb->mySQLrows;
    $text .= getPagingLink($totalResults, $pageNumber, $imagePerPage, "page=list-image&amp;album=$albumId");
    $text .="</td></tr>";
    //end add pageing
    $text .= "</table>";
    $mydb2->db_Close();
}
?>

