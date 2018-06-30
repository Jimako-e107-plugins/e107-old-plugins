<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_config.php
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
   // Remember that we must include class2.php
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

   // Handle preferences form being submitted
   // n.b. to complex to list in this example

   // Our informative text
   $lan_file = e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php";
   require_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."image_gallery/languages/image_gallery_English.php");

   require_once("myfuncs.php");
   require_once ("functions.php");
function admin_config_adminmenu() {
  show_menu("Config");
}


//e107 DB API
$mydb = new db();
$mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

$text = "<script language=\"javascript\" type=\"text/javascript\">
function deleteAlbum(albumId)
{
	if (confirm('".image_gallery_CONFIG_L62."?')) {
		window.location.href = 'admin_config.php?deleteAlbum&album=' + albumId;
	}
}

function viewImage(albumId) {
	if (albumId != '') {
		window.location.href = 'admin_config.php?page=admin_list-image&album=' + albumId;
	} else {
		window.location.href = 'admin_config.php?page=admin_list-image';
	}
}

function deleteImage(albumId, imgId)
{
	if (confirm('".image_gallery_CONFIG_L61."?')) {
		window.location.href = 'admin_config.php?page=admin_list-image&delete&album=' + albumId + '&imgId=' + imgId;
	}
}

function viewLargeImage(imageName)
{
	imgWindow = window.open('', 'largeImage', \"width=\" + screen.availWidth + \",height=\"  + screen.availHeight + \",top=0,left=0,screenY=0,screenX=0,status=yes,scrollbars=yes,resizable=yes,menubar=no\");
	imgWindow.focus();
	imgWindow.location.href = 'viewImage.php?type=glimage&name=' + imageName;
}
</script>
<table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
    <tr>
        <td class='forumheader3' width='150' valign='top'>
		    <center><img src='".e_PLUGIN."image_gallery/images/conf.png' border='0' />
			<br />
			<h3>".image_gallery_CONFIG_L7."</h3>
            <li><a href='admin_config.php?page=admin_list-album'>".image_gallery_CONFIG_L14."</a></li>
            <li><a href='admin_config.php?page=admin_add-album'>".image_gallery_CONFIG_L6."</a></li>
            <br />
			<h3>".image_gallery_CONFIG_L11."</h3>
            <li><a href='admin_config.php?page=admin_list-image'>".image_gallery_CONFIG_L13."</a></li>
            <li><a href='admin_config.php?page=admin_add-image'>".image_gallery_CONFIG_L5."</a></li>
			</center>
           </td>
        <td class='forumheader2' align='center' valign='top' style='padding:10px'>";


       if (isset($_GET['deleteAlbum']) && isset($_GET['album']) ) {
	$albumId = (int)$_GET['album']; 

	// get the album name since we need to display
	// a message that album 'foo' is deleted
    $mydb->db_Select("tbl_album","al_name, al_image", "al_id = '$albumId'");
    $result = $mydb;
    $result = $result->mySQLrows;

	if ($result == 1) {
		$row = $mydb->db_Fetch(MYSQL_ASSOC);
		$albumName = $row['al_name'];
		$albumImage = $row['al_image'];

		// get the image filenames first so we can delete them
		// from the server
        $mydb->db_Select("tbl_image", "im_image, im_thumbnail, im_id", "im_album_id = '$albumId'");

		while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
            unlink($pref['img_GALLERY_IMG_DIR'] . $row['im_image']);
			unlink($pref['img_GALLERY_IMG_DIR'] . 'thumbnail/' . $row['im_thumbnail']);

		}
        foreach ($row['im_id'] as $key => $value)
        {
            $mydb->db_Delete("tbl_comment", "im_id = '$value'");

        }




        unlink($pref['img_ALBUM_IMG_DIR'] . $albumImage);

        $mydb->db_Delete("tbl_image", "im_album_id = '$albumId'");

        $mydb->db_Delete("tbl_album", "al_id = '$albumId'");


		// album deleted successfully, let the user know about it
		$text .= "<p align=center>".image_gallery_CONFIG_L7." '$albumName' ".image_gallery_CONFIG_L17.".</p>";
	} else {
		$text .= "<p align=center>".image_gallery_CONFIG_L15."</p>";
	}
}

// which page should be shown now
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 'admin_list-album';
// only the pages listed here can be accessed
// any other pages will result in error
$allowedPages = array('admin_list-album', 'admin_add-album', 'admin_album-detail', 'admin_modify-album', 'admin_list-image', 'admin_add-image', 'admin_image-detail', 'admin_modify-image');

  if (in_array($page, $allowedPages)) {
	include $page . '.php';
} else {


$text .="<table width='100%' border='0' align='center' cellpadding='2' cellspacing='1'>
                <tr>
        <td align='center'><strong>".image_gallery_CONFIG_L16."</strong></td>
    </tr>
</table>";

     }


$text .= "</td>
    </tr>
</table>
";
   // The usual, tell e107 what to include on the page
   $ns->tablerender(image_gallery_CONFIG_L1, $text);
   $mydb->db_Close();
   require_once(e_ADMIN."footer.php");

?>