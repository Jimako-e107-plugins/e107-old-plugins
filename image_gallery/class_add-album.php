<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/class_add-album.php
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

   require_once(HEADERF);
   // Include plugin language file, check first for site's preferred language
  if (file_exists(e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php")) {
     require_once(e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php");
  } else {
     // No language localization, default to Enlish language
     require_once(e_PLUGIN."image_gallery/languages/image_gallery_English.php");
  }

  require_once 'functions.php';
  
  $mydb = new db();
  $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

  if (check_class($pref['img_userclass']))
   {
    $propperuser = TRUE;
   }
  //check class
if(isset($_POST['txtName']) AND $propperuser)
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
		echo "Error uploading file";
		exit;
	}
    $authorid = USERID;  //username na avtora.
    
    $params = array("al_name" => $albumName, "al_description" => $albumDesc, "al_image" => $newName,
      "al_date" => NOW(), "al_author" => $authorid, "al_cat_id" => $category);
    
    $mydb->db_Insert("tbl_album", $params);
    // the album is saved, go to the album list
	echo "<script>window.location.href='image_gallery.php?page=list-album';</script>";
	exit;
}

if ($propperuser OR ADMIN)   //check class
{
$text ="
<form action='' method='post' enctype='multipart/form-data' name='frmAlbum' id='frmAlbum'>
    <table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
	  <tr><td colspan='2' class='forumheader'>".image_gallery_CONFIG_L6."</td></tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L10."</th>
            <td class='forumheader2' width='80'> <input class='tbox' name='txtName' type='text' id='txtName'></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_CATL11."</th>
            <td class='forumheader2'><select class='tbox' name=\"catlist\">";
            $text .= $categoryList = listcategory($mydb)."</select></td>";
$text .="</tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'><textarea class='tbox' name='mtxDesc' cols='50' rows='4' id='mtxDesc'></textarea></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</th>
            <td class='forumheader2'> <input class='tbox' name='fleImage' type='file' id='fleImage'></td>
        </tr>
         <tr>
		    <td colspan='2' class='forumheader' style='text-align:center;'> <input name='btnAdd' class='button' type='submit' id='btnAdd' value='".image_gallery_CONFIG_L6."'>
            <input name='btnCancel' type='button' class='button' id='btnCancel' value='".image_gallery_CONFIG_L12."' onClick='window.history.back();'></td>
        </tr>
    </table>
</form> ";
}else {$text = image_gallery_NOPRIVILEGE;}  //check class
// Ensure the pages HTML is rendered using the theme layout.
  $ns->tablerender(image_gallery_LAN_TITLE, $text);

  // this generates all the HTML (menus etc.) after the end of the main section
  require_once(FOOTERF);
  $mydb->db_Close();
?>