<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_add-album.php
|
| Revision: 0.9.6.5
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

require_once 'functions.php';

$mydb = new db();
$mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

if(isset($_POST['txtName']))
{
  $albumName = mysql_real_escape_string(trim($_POST['txtName']));
  $albumDesc = mysql_real_escape_string(trim($_POST['mtxDesc']));
  $category = (int)($_POST['catlist']);
    
	$imgName   = $_FILES['fleImage']['name'];
	$tmpName   = $_FILES['fleImage']['tmp_name'];

	// we need to rename the image name just to avoid
	// duplicate file names
	// first get the file extension
	$ext = strrchr($imgName, ".");
	$ext = strtolower($ext);
	// then create a new random name
	$newName = md5(rand() * time()) . $ext;

    // the album image will be saved here
    $imgPath = $pref['img_ALBUM_IMG_DIR'] . $newName;

	// resize all album image
    $result = createThumbnail($tmpName, $imgPath, $pref['img_THUMBNAIL_WIDTH']);
	
	if (!$result) {
		echo image_gallery_CONFIG_L63;
		exit;
	}
    $authorid = USERID;  //username na avtora.

    $params = array("al_name" => $albumName, "al_description" => $albumDesc, "al_image" => $newName,
      "al_date" => NOW(), "al_author" => $authorid, "al_cat_id" => $category);
    
    $mydb->db_Insert("tbl_album", $params);

  // the album is saved, go to the album list 
	echo "<script>window.location.href='admin_config.php?page=admin_list-album';</script>";
	exit;
}

$text .="
<form action='' method='post' enctype='multipart/form-data' name='frmAlbum' id='frmAlbum'>
    <table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
	<tr><td colspan='2' class='forumheader'>".image_gallery_CONFIG_L6."</td></tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L10."</td>
            <td class='forumheader2' width='80'> <input class='tbox' name='txtName' type='text' id='txtName'></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_CATL11."</td>
            <td class='forumheader2'><select class='tbox' name=\"catlist\">";
            $text .= $categoryList = listcategory($mydb)."</select></td>";
$text .="</tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'><textarea class='tbox' name='mtxDesc' cols='50' rows='4' id='mtxDesc'></textarea></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
            <td class='forumheader2'> <input class='tbox' name='fleImage' type='file' id='fleImage'></td>
        </tr>
        <tr>
            <td colspan='2' class='forumheader' style='text-align:center;'>
            <input name='btnAdd' class='button' type='submit' id='btnAdd' value='".image_gallery_CONFIG_L6."'>
            <input name='btnCancel' type='button' class='button' id='btnCancel' value='".image_gallery_CONFIG_L12."' onClick='window.history.back();'></td>
        </tr>
    </table>
</form> ";
$mydb->db_Close();
?>