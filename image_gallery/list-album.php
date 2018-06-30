<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/list-album.php
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

//add pageing
$imagePerPage = $pref['img_albumPerPage'];
$thumbNailSize = $pref['img_THUMBNAIL_WIDTH'];
$pageNumber  = isset($_GET['pageNum']) ? (int)$_GET['pageNum'] : 1;
$offset = abs($pageNumber - 1) * $imagePerPage; //abs
$serial = $offset + 1;
//end add pageing

if (isset($_GET['cat']) AND is_numeric($_GET['cat']))
{
   $category = (int) $_GET['cat'];
   $query  = "SELECT al_id, al_name, al_image, al_description, COUNT(im_album_id) AS al_numimage, al_cat_id
         FROM `#tbl_album` AS al LEFT JOIN `#tbl_image` AS im ON al.al_id = im.im_album_id WHERE al_cat_id = '".$category."'
         GROUP by al_id, al_cat_id
         ORDER BY al_cat_id, al_name";
}else{
$query  = "SELECT al_id, al_name, al_image, al_description, COUNT(im_album_id) AS al_numimage, al_cat_id
         FROM `#tbl_album` AS al LEFT JOIN `#tbl_image` AS im ON al.al_id = im.im_album_id
         GROUP by al_id, al_cat_id
         ORDER BY al_cat_id, al_name";
}
$mydb->db_Select_gen($query . " LIMIT $offset, $imagePerPage");
$result = $mydb->mySQLrows;
if ($result == 0) {
	$text .= "No album yet";
} else {

	$text .= "<table class='fborder' width='100%' cellspacing='1' cellpadding='2' align='center'>";

	// the album is listed in a table
	// here we specify how many columns
	// we want to show on each row
	//$colsPerRow = 4;
    $colsPerRow = $pref['img_colsPerRow'];

	// width of each column in percent
	$colWidth   = (int)(100/$colsPerRow);
	$i = 0;
	
	//flag za categoriite.
	$flag = false;

    $mydb2 = new db();
    $mydb2->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

	while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
		if ($i % $colsPerRow == 0) {
			// start a new row
			$text .= '<tr>';
		}
		//category listing
		if ($flag == false)
		{//first run
		    $cat_prev = $row['al_cat_id'];
		    $cat_curr = $row['al_cat_id'];
            $mydb2->db_Select("tbl_category", "cat_name, cat_description", "cat_id = '$cat_curr'");
            $catinfo = $mydb2->db_Fetch(MYSQL_ASSOC);


            $cat_name = $catinfo['cat_name'];
            $cat_desc = $catinfo['cat_description'];
		    $text .= "<tr><td colspan=".$colsPerRow."><a href='image_gallery.php?cat=".$row['al_cat_id']."'><b>".image_gallery_CONFIG_CATL11." ".$cat_name."</b></a><br /></td></tr><tr>" ;
		    $flag = true;
		}else{
		    //new category check
		    $cat_curr = $row['al_cat_id'];
		    if ($cat_curr != $cat_prev)
		    {
              $mydb2->db_Select("tbl_category", "cat_name, cat_description", "cat_id = '$cat_curr'");
              $catinfo = $mydb2->db_Fetch(MYSQL_ASSOC);

              $cat_name = $catinfo['cat_name'];
              $cat_desc = $catinfo['cat_description'];
			  $text .= "<tr><td colspan=".$colsPerRow."><a href='image_gallery.php?cat=".$row['al_cat_id']."'><b>".image_gallery_CONFIG_CATL11." ".$cat_name."</b></a><br /></td></tr><tr>";
			  $cat_prev = $row['al_cat_id'];
			  $i=0;
		    }
		}
		//category listing
		$numImages = $row['al_numimage'] > 1 ? $row['al_numimage'] . ' '.image_gallery_CONFIG_Lpic.'' : $row['al_numimage'] . ' '.image_gallery_CONFIG_Lpic.'';

//start new code
    $text .= "<td class='forumheader2' style='text-align:center;' width='" . $colWidth . "%'>
      <table width=100% height=100% border=0>
        <tr><td class=''><a href='image_gallery.php?page=list-image&amp;album=" . $row['al_id'] . "'>" . $row['al_name'] . "</a></td></tr>
        <tr height=".$thumbNailSize."px><td class=''><a href='image_gallery.php?page=list-image&amp;album=" . $row['al_id'] . "'>
        <img style='' alt='".$row['al_name']."' src='viewImage.php?type=album&amp;name=" . $row['al_image'] . "' border='0' /></a>
        <tr><td class=''>";
     
    if ($row['al_description'])
    {
        $text .= "<div class='smalltext' style='text-align: center;'><b>". image_gallery_CONFIG_L9 ." : </b> ".$row['al_description']." </div>";
    }
    else
    {
        $text .= "&nbsp;";
    }
    $text .= "</td></tr><tr><td class=''><b>" . $numImages . "</b></td></tr>";
    $text .= "</table";
    $text .= "</td>";
//end new code

		if ($i % $colsPerRow == $colsPerRow - 1) {
			// end this row
			$text .= '</tr>';
		}

		$i += 1;
	}

	// print blank columns
	// if ($i % $colsPerRow != 0) {
		// while ($i++ % $colsPerRow != 0) { //for empty places when row is not full
			// $text .= "<td width='" . $colWidth . "%'>&nbsp;</td>";
		// }
		// $text .= "</tr>";
	// }

    //add pageing
    //$text .="<tr><td class='pageing'>";
    $text .="<tr><td colspan='".$colsPerRow."' style='text-align:center'>";
    $result = $mydb->db_Select($query);
    $totalResults = $result->mySQLrows;
    $text .= getPagingLink($totalResults, $pageNumber, $imagePerPage);
    $text .="</td></tr>";
    //end add pageing

	$text .= "</table>";

$mydb2->db_Close();
}
?>
