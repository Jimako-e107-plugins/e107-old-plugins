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
       if (!isset($_GET['imgId'])) {
        	echo image_gallery_CONFIG_L72;
        } else {

        	// get the image id
        	$imgId = (int)$_GET['imgId'];

        	if (isset($_POST['txtTitle'])) {
        		$albumId   = (int)$_POST['cboAlbum'];
                $imgTitle  = mysql_real_escape_string(trim($_POST['txtTitle']));
        		$imgDesc   = mysql_real_escape_string(trim($_POST['mtxDesc']));

        		if ($_FILES['fleImage']['tmp_name'] != '') {
                      $images = uploadImage('fleImage', $pref['img_GALLERY_IMG_DIR'], $pref['img_THUMBNAIL_WIDTH']);

        			if ($images['image'] == '' && $images['thumbnail'] == '') {
        				echo image_gallery_CONFIG_L63;
        				exit;
        			}

        			$image     = "'" . $images['image'] . "'";
        			$thumbnail = "'" . $images['thumbnail'] . "'";

        			$mydb->db_Select("tbl_image", "im_image, im_thumbnail", "WHERE im_id = $imgId", "");
                    $row = $mydb->db_Fetch(MYSQL_ASSOC);
                    unlink($pref['img_GALLERY_IMG_DIR'] . $row['im_image']);
                    unlink($pref['img_GALLERY_IMG_DIR'] . 'thumbnail/' . $row['im_thumbnail']);

        		} else {
        			// the old image is not replaced
        			$image     = "im_image";
        			$thumbnail = "im_thumbnail";
        		}
        	
        		$mydb->db_Update("tbl_image", "im_album_id = $albumId, im_title = '$imgTitle', im_description = '$imgDesc', 
              im_image = $image, im_thumbnail = $thumbnail, im_date = '".NOW()."'	WHERE im_id = $imgId");
		
        		echo "<script>window.location.href='image_gallery.php?page=image-detail&album=3&image=$imgId';</script>";
        	} else {
        		$rowCount = $mydb->db_Select("tbl_image", "im_album_id, im_id, im_title, im_description, im_image, im_thumbnail", "WHERE im_id = $imgId", "");
    			$rowCount = $mydb;
    			$rowCount = $rowCount->mySQLrows;
            if ($rowCount == 0) {
        			// can't find an image with that id

        $text .="<p align=\"center\">".image_gallery_CONFIG_L25.". ".image_gallery_CONFIG_L26." <a href=\"image_gallery.php\">".image_gallery_CONFIG_L27."</a>
    ".image_gallery_CONFIG_L28."</p>";

        		} else {
        			$image = $mydb->db_Fetch(MYSQL_ASSOC);

              //for edit only own images.
              $mydb->db_Select("tbl_album", "al_author", "WHERE al_id = ".$image['im_album_id'], "");
              $checkuser = $mydb->db_Fetch(MYSQL_NUM);
              $flag = TRUE;
              if (USERID == $checkuser[0] OR ADMIN )
              {
                $flag = FALSE;

        			// get album list
        			$mydb->db_Select("tbl_album", "al_id, al_name", "ORDER BY al_name", "no-where");
              $albumList = '';
              $selectedAlbum = isset($_GET['album']) ? (int)$_GET['album'] : ''; 
              while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
        				$albumList .= '<option value="' . $row['al_id']. '"';

        				if ($row['al_id'] == $image['im_album_id']) {
        					$albumList .= ' selected';
        				}

        				$albumList .= '>' . $row['al_name'] . '</option>';
        			}
                    $text .="
<form action='' method='post' enctype='multipart/form-data' name='frmAlbum' id='frmAlbum'>
<table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
		<tr><td colspan='2' class='forumheader'>".image_gallery_CONFIG_L44."</td></tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L7."</td>
            <td class='forumheader2' width='80'> <select class='tbox' name='cboAlbum' id='cboAlbum'>
                                        ".$albumList."</select></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L8."</td>
            <td class='forumheader2' width='80'> <input class='tbox' name='txtTitle' type='text' id='txtTitle' value=\"".$image['im_title']."\" size='40' maxlength='64'></td>
        </tr>
         <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'> <textarea class='tbox' name='mtxDesc' cols='50' rows='10' id='mtxDesc'>".htmlspecialchars($image['im_description'])."</textarea>
                                </td>
        </tr>
         <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
            <td class='forumheader2'>";if ($image['im_thumbnail'] != '') { ;
            $text .="<center><a href='javascript:viewLargeImage('".$image['im_image']."')'><img src='images/gallery/thumbnail/".$image['im_thumbnail']."' border='0' /></a></center><br />";
                                  }
                              $text .="<input name='fleImage' type='file' class='tbox' id='fleImage2'></td>
        </tr>
        <tr>
             <td colspan='2' class='forumheader' style='text-align:center;'>
             <input name='btnModify' type='submit' class='button' id='btnModify' value='".image_gallery_CONFIG_L44."'>
             <input name='btnCancel' type='button' class='button' id='btnCancel' value='".image_gallery_CONFIG_L12."' onClick='window.history.back();'></td>
        </tr>
</table>
</form>";
                 }
                 if ($flag){$text = image_gallery_NOPRIVILEGE;}
        		}
        	}
        }
   }else {$text = image_gallery_NOPRIVILEGE;}  //check class
// Ensure the pages HTML is rendered using the theme layout.
  $ns->tablerender(image_gallery_LAN_TITLE, $text);

  // this generates all the HTML (menus etc.) after the end of the main section
  require_once(FOOTERF);
  $mydb->db_Close();
?>