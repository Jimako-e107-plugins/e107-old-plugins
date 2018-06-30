<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_list-image.php
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
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");
   require_once(e_HANDLER."form_handler.php");
   require_once(e_HANDLER."userclass_class.php");

   $mydb = new db();
   $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

if (isset($_GET['delete']) && isset($_GET['album']) && isset($_GET['imgId'])) {
	// get the image file name so we
	// can delete it from the server
    $imgId = (int)$_GET['imgId'];
    $albumId = (int)$_GET['album'];

    $mydb->db_Select("tbl_image", "im_image, im_thumbnail", "im_id = '$imgId' AND im_album_id= '$albumId'");

    $result = $mydb;
    $result = $result->mySQLrows;

    if ($result == 1) {
		$row = $mydb->db_Fetch(MYSQL_ASSOC);

		// remove the image and the thumbnail from the server
        unlink($pref['img_GALLERY_IMG_DIR'] . $row['im_image']);
		unlink($pref['img_GALLERY_IMG_DIR'] . 'thumbnail/' . $row['im_thumbnail']);

		// and then remove the database entry
        $mydb->db_Delete("tbl_image", "im_id = '$imgId' AND im_album_id = '$albumId'");

	}
}

$imagePerPage = $pref['img_imagePerPage'];

$album = isset($_GET['album']) ? (int)$_GET['album'] : '';
$pageNumber  = isset($_GET['pageNum']) ? (int)$_GET['pageNum'] : 1;

$offset = abs($pageNumber - 1) * $imagePerPage; //abs
$serial = $offset + 1;

// get album list

$mydb->db_Select("tbl_album", "al_id, al_name", "ORDER BY al_name", "no-where");

$albumList = '';
while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
	$albumList .= '<option value="' . $row['al_id'] . '"' ;

	if ($row['al_id'] == $album) {
		$albumList .= ' selected';
	}

	$albumList .= '>' . $row['al_name'] . '</option>';
}

$text .="
<table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
    <tr><td colspan='5' class='forumheader'>".image_gallery_CONFIG_L13."</td></tr>
    <tr>
        <td class='fcaption'>".image_gallery_CONFIG_L7." : <select name='cboAlbum' id='cboAlbum' onChange='viewImage(this.value)'>
        <option value=''>-- ".image_gallery_CONFIG_L22." --</option>
        ".$albumList."</select></td>
    </tr>
</table>";

$query  = "SELECT im_id, im_title, im_thumbnail, im_album_id, DATE_FORMAT(im_date, '%Y-%m-%d') AS im_date
		 FROM  `#tbl_image`";

if ($album != '') {
	$query .= " WHERE im_album_id = '$album' ";
}

$query .= " ORDER BY im_title ";

$mydb->db_Select_gen($query . "LIMIT $offset, $imagePerPage");

$result = $mydb;
$result = $result->mySQLrows;

$text .="
<table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
    <tr>
        <th class='fcaption' width='30' align='center'>#</th>
        <th class='fcaption' align='center'>".image_gallery_CONFIG_L11." </th>
        <th class='fcaption' width='120' align='center'>".image_gallery_CONFIG_L23."</th>
        <th class='fcaption' width='60' align='center'>".image_gallery_CONFIG_L20."</th>
        <th class='fcaption' width='60' align='center'>".image_gallery_CONFIG_L21."</th>
    </tr>";

if ($result == 0) {

$text .="
    <tr bgcolor=\"#FFFFFF\">
        <td colspan=\"5\">".image_gallery_CONFIG_L24."</td>
    </tr>";

} else {
	while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
		extract($row);

        $text .="
            <tr>
                <td class='forumheader3' width='30'><center>".$serial++."</center></td>
                <td class='forumheader2'><center><a href='?page=admin_image-detail&amp;imgId=".$im_id."'><img src='images/gallery/thumbnail/".$row['im_thumbnail']."' border='0' alt='".$row['im_title']."'/><br />
              ".$row['im_title']."</a></center></td>
                <td class='forumheader3' width='120'><center>".$im_date."</center></td>
                <td class='forumheader2' width='60'><center>
				<a href='?page=admin_modify-image&amp;imgId=".$im_id."'>
				<img src='".e_PLUGIN."image_gallery/images/ed.png' border='0' alt='".image_gallery_CONFIG_L20."'/></a></center></td>
                <td class='forumheader3' width='60'><center>
				<a href='javascript:deleteImage($im_album_id, $im_id);'>
				<img src='".e_PLUGIN."image_gallery/images/del.png' border='0' alt='".image_gallery_CONFIG_L21."'/></a></center></td>
            </tr>";

	} // end while
}
$text .="
    <tr>
        <td class='forumheader' colspan='5' align='center'>";
$mydb->db_Select_gen($query);

$result = $mydb;
$totalResults = $result->mySQLrows;

   $text .= getPagingLink($totalResults, $pageNumber, $imagePerPage, "page=admin_list-image&amp;album=$album");
$text .="
   &nbsp;</td>
    </tr>
    <tr>
      <td class='forumheader' colspan='5'><center><input type='button' name='btnAdd' class='button' value='".image_gallery_CONFIG_L5."' onclick=\"window.location.href='admin_config.php?page=admin_add-image&amp;album=".$album."';\" /></center></td>
    </tr>
</table>";
?>