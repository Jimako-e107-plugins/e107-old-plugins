<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/class_add-image.php
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
   if($propperuser OR ADMIN)
   {
       // make sure the album id is present
        if (!isset($_GET['alId'])) {
        	echo "Album id is not defined";
        	exit;
        } else if(isset($_POST['txtName'])) {
        	$albumId   = (int)$_POST['hidAlbumId'];
        	$albumName = mysql_real_escape_string(trim($_POST['txtName']));
        	$albumDesc = mysql_real_escape_string(trim($_POST['mtxDesc']));
            $category = (int) ($_POST['catlist']);

        	if ($_FILES['fleImage']['tmp_name'] != '') {
        		$imgName   = $_FILES['fleImage']['name'];
        		$tmpName   = $_FILES['fleImage']['tmp_name'];

        		// just like when we add this album
        		// we will need to rename the image name to avoid
        		// duplicate file name problem
        		$newName = md5(rand() * time()) . strrchr($imgName, ".");

        		// resize the new album image
                $result = createThumbnail($tmpName, $pref['img_ALBUM_IMG_DIR'] . $newName, $pref['img_THUMBNAIL_WIDTH']);

        		if (!$result) {
        			echo image_gallery_CONFIG_L63;
        			exit;
        		}

        		// since a new image for this album is specified
        		// we'll need to delete the old one
        		$mydb->db_Select("tbl_album", "al_image", "al_id = $albumId");
                $row = $mydb->db_Fetch(MYSQL_ASSOC);
                unlink ($pref['img_ALBUM_IMG_DIR'] . $row['al_image']);

        		$newName = "'$newName'";
        	} else {
        		// don't change the image
        		$newName = "al_image";
        	}

        	$mydb->db_Update("tbl_album", "al_name = '$albumName', al_description = '$albumDesc',
            al_image = $newName, al_cat_id = $category WHERE al_id = $albumId");
            // after saving the modification go to the detail page

        	echo "<script>window.location.href='image_gallery.php?page=list-image&album=$albumId';</script>";
        } else {
        	// get the album id
        	$alId = (int)$_GET['alId'];

        	$rowCount = $mydb->db_Select("tbl_album", "al_id, al_name, al_description, al_image, al_cat_id", "WHERE al_id = $alId", "");
  			
  			$rowCount = $mydb;
    		$rowCount = $rowCount->mySQLrows;
    		
          if ($rowCount == 0) {
        		// can't find an album with that id

        $text .="	<p align=\"center\">Album not found. Click <a href=\"image_gallery.php\">here</a> to go to the album list</p>";

        	} else {
        		$row = $mydb->db_Fetch(MYSQL_ASSOC);
                $flag = TRUE;
                if (USERID == $row['al_author'] OR ADMIN){
                    $flag = FALSE;

                  $text .="
                  <form method='post' enctype='multipart/form-data' name='frmAlbum' id='frmAlbum'>
    <table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
	 <tr><td colspan='2' class='forumheader'>".image_gallery_CONFIG_L43."</td></tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L10."</td>
            <td class='forumheader2' width='80'>
                <input class='tbox' name='txtName' type='text' id='txtName' value=\"".$row['al_name']."\"></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_CATL11."</td>
            <td class='forumheader2'><select class='tbox' name=\"catlist\">";
        $text .= $categoryList = listcategory($mydb,$row['al_cat_id'])."</select></td>";
                  $text .="</tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'><textarea class='tbox' name='mtxDesc' cols='50' rows='4' id='mtxDesc'>".$row['al_description']."</textarea></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
            <td class='forumheader2'><center><img src='images/album/".$row['al_image']."'></center><br>
            <input name='fleImage' type='file' class='tbox' id='fleImage2'></td>
        </tr>
        <tr>
		    <td colspan='2' class='forumheader' style='text-align:center;'>
                <input name='btnAdd' type='submit' class='button' id='btnAdd' value='".image_gallery_CONFIG_L20."'>
                <input name='btnCancel' type='button' class='button' id='btnCancel' value='".image_gallery_CONFIG_L12."' onClick='window.history.back();'>
                <input name='hidAlbumId' type='hidden' id='hidAlbumId' value='".$alId."'></td>
        </tr>
    </table>
</form>";
                 }
                 if ($flag){$text = image_gallery_NOPRIVILEGE;}
        	}
        }
   }
   else {$text = image_gallery_NOPRIVILEGE;}  //check class
// Ensure the pages HTML is rendered using the theme layout.
  $ns->tablerender(image_gallery_LAN_TITLE, $text);

  // this generates all the HTML (menus etc.) after the end of the main section
  require_once(FOOTERF);
  $mydb->db_Close();
?>