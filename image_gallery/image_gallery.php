<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/image_gallery.php
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
  // always include the class2.php file - this is the main e107 file
  require_once("../../class2.php");

  // this generates all the HTML up to the start of the main section
     require_once(HEADERF);
//  echo "<link rel='stylesheet' href='e107_plugins/image_gallery/style.css' type='text/css' media='all' />";

  // Include plugin language file, check first for site's preferred language
  if (file_exists(e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php")) {
     require_once(e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php");
  } else {
     // No language localization, default to Enlish language
     require_once(e_PLUGIN."image_gallery/languages/image_gallery_English.php");
  }
/*global $conn;

$conn = @mysql_connect($mySQLserver,$mySQLuser,$mySQLpassword);
if ($conn==FALSE) {
     die("<BR>ERROR: cannot connect to database<BR>" );
  }*/

$mydb = new db();
$mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);



 require_once(e_PLUGIN."image_gallery/functions.php");

//check class
   $propperuser = FALSE;
//   $userclasses  = USERCLASS;
//   $arrayuserclasses = explode(",", $userclasses);
//   foreach ($arrayuserclasses as $key => $value)
//   {
//       if ($pref['img_userclass'] == $value){$propperuser = TRUE;}
//   }
   if (check_class($pref['img_userclass']))
   {
       $propperuser = TRUE;
   }
   
//check class

// which page should be shown now
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 'list-album';

// only the pages listed here can be accessed
// any other pages will result in error
$allowedPages = array('list-album', 'list-image', 'image-detail', 'class_modify-image', 'class_modify-album', 'rated');

if (!in_array($page, $allowedPages)) {
    $page = 'notfound';
}

  $text = "


<script language=\"javascript\" type=\"text/javascript\">
function deleteAlbum(albumId)
{
	if (confirm('".image_gallery_CONFIG_L62."?')) {
		window.location.href = 'image_gallery.php?deleteAlbum&album=' + albumId;
	}
}

function deleteImage(albumId, imgId)
{
	if (confirm('".image_gallery_CONFIG_L61."?')) {
		window.location.href = 'image_gallery.php?page=image_gallery&delete&album=' + albumId + '&imgId=' + imgId;
	}
}

function show_hide_field(field)

{

  veld = eval(\"document.getElementById(field).style.display\");

  if (veld == 'block')
  {
    eval(\"document.getElementById(field).style.display = 'none'\");
  }

  else
  {
    eval(\"document.getElementById(field).style.display = 'block'\");
  }
}

</script>

<table class='fborder' width='100%' >
   <tr>";
      $text .= '<td class="fcaption">'.image_gallery_LOCATION.' : <a href="image_gallery.php">'.image_gallery_CONFIG_L59.'</a>';

        $text .= ' '.showBreadcrumb().'</td></tr><tr><td>';
//del image
if (isset($_GET['delete']) && isset($_GET['album']) && isset($_GET['imgId']) && $propperuser) {
	// get the image file name so we
	// can delete it from the server
    $imgId = (int)$_GET['imgId'];
    $albumId = (int)$_GET['album'];
    $mydb->db_Select("tbl_image", "im_album_id", "im_id = '$imgId'");
    //$query = "SELECT im_album_id FROM ".MPREFIX."tbl_image WHERE im_id = '$imgId'";
    //$result = mysql_query($query, $conn);
    //$row = mysql_fetch_row($result);
    $row = $mydb->db_Fetch(MYSQL_NUM);

    $mydb->db_Select("tbl_album", "al_author", "al_id = '$row[0]'");
    $row = $mydb->db_Fetch(MYSQL_ASSOC);
    //$query = "SELECT al_author FROM ".MPREFIX."tbl_album WHERE al_id = $row['im_album_id']";
    //$result = mysql_query($query, $conn) or die('Error, get image info. ' . mysql_error());
    //$row = mysql_fetch_assoc($result);
    if (USERID == $row['al_author'])
    {
        $mydb->db_Select("tbl_image", "im_image, im_thumbnail", "im_id = {$imgId} AND im_album_id = {$albumId}");
        //$query = "SELECT im_image, im_thumbnail
    	//        FROM ".MPREFIX."tbl_image
    	//        WHERE im_id = {$imgId} AND im_album_id = {$albumId}";

        //$result = mysql_query($query, $conn) or die('Delete image failed. ' . mysql_error());
        $result = $mydb->mySQLrows;
    	if ($result == 1) {
    		$row = $mydb->db_Fetch(MYSQL_ASSOC);

    		// remove the image and the thumbnail from the server
            unlink($pref['img_GALLERY_IMG_DIR'] . $row['im_image']);
    		unlink($pref['img_GALLERY_IMG_DIR'] . 'thumbnail/' . $row['im_thumbnail']);

    		// and then remove the database entry
            $mydb->db_Delete("tbl_image", "im_id = {$imgId} AND im_album_id = {$albumId}");
    		//$query = "DELETE FROM ".MPREFIX."tbl_image
    		//		WHERE im_id = {$imgId} AND im_album_id = {$albumId}";
    		//mysql_query($query, $conn) or die('Delete album failed. ' . mysql_error());

    	}
    }else {$text .= "<p align=center>".image_gallery_CONFIG_L65."</p>";}
}
//end del image

//del option for album.
if (isset($_GET['deleteAlbum']) && isset($_GET['album']) AND $propperuser) {
	$albumId = (int)$_GET['album']; 

	// get the album name since we need to display
	// a message that album 'foo' is deleted
    $mydb->db_Select("tbl_album", "al_name, al_image, al_author", "al_id = '$albumId'");
    //$result = mysql_query("SELECT al_name, al_image, al_author
	//                       FROM ".MPREFIX."tbl_album
	//					   WHERE al_id = '$albumId'", $conn)
	//		  or die('Delete image failed. ' . mysql_error());
    $result = $mydb->mySQLrows;
	if ($result == 1) {
		$row = $mydb->db_Fetch(MYSQL_ASSOC);
		$albumName = $row['al_name'];
		$albumImage = $row['al_image'];

        $albumAuthor = $row['al_author'];
        if (USERID == $albumAuthor)
        {
    		// get the image filenames first so we can delete them
    		// from the server
            $mydb->db_Select("tbl_image", "im_image, im_thumbnail, im_id", "im_album_id = '$albumId'");
    		//$result = mysql_query("SELECT im_image, im_thumbnail, im_id
    		//                       FROM ".MPREFIX."tbl_image
    		//					   WHERE im_album_id = '$albumId'", $conn)
    		//		  or die(mysql_error());
    		//while ($row = mysql_fetch_assoc($result)) {
            while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
                unlink($pref['img_GALLERY_IMG_DIR'] . $row['im_image']);
    			unlink($pref['img_GALLERY_IMG_DIR'] . 'thumbnail/' . $row['im_thumbnail']);

    		}
            foreach ($row['im_id'] as $key => $value)
            {
                $mydb->db_Delete("tbl_comment", "im_id = '$value'");
                //$result = mysql_query("DELETE FROM ".MPREFIX."tbl_comment
                //                       WHERE im_id = $value", $conn)
                //          or die('Delete album failed. ' . mysql_error());
            }




            unlink($pref['img_ALBUM_IMG_DIR'] . $albumImage);

            $mydb->db_Delete("tbl_image", "im_album_id = '$albumId'");
            //$result = mysql_query("DELETE FROM ".MPREFIX."tbl_image
    		//                       WHERE im_album_id = '$albumId'", $conn)
    		//		  or die('Delete image failed. ' . mysql_error());
            $mydb->db_Delete("tbl_album", "al_id = '$albumId'");
            //$result = mysql_query("DELETE FROM ".MPREFIX."tbl_album
    		//                       WHERE  al_id = '$albumId'", $conn)
    		//		  or die('Delete album failed. ' . mysql_error());

    		// album deleted successfully, let the user know about it
    		$text .= "<p align=center>".image_gallery_CONFIG_L7." '$albumName' ".image_gallery_CONFIG_L17.".</p>";
        }else {$text .= "<p align=center>".image_gallery_CONFIG_L64."</p>";}
	} else {
		$text .= "<p align=center>".image_gallery_CONFIG_L15."</p>";
	}
}
//del option END
if (check_class($pref['img_userclass'])){
    if (isset($_GET['page']) AND isset($_GET['album']) AND is_numeric($_GET['album']) )
    {
        $al_id = (INT)$_GET['album'];
        $text .= "<div class='fborder'><div class='forumheader'>".image_gallery_CONFIG_L4."
        &nbsp;[<a href=".e_PLUGIN."image_gallery/class_add-image.php>".image_gallery_CONFIG_L5."</a>]";
        //link to edit image and album
        if (isset($_GET['image']) AND is_numeric($_GET['image']))
        {$im_id = (INT)$_GET['image'];
         $text .= "&nbsp;[<a href=".e_PLUGIN."image_gallery/class_modify-image.php?imgId=".$im_id.">".image_gallery_CONFIG_L44."</a>]";
         $text .= "&nbsp;[<a href=\"javascript:deleteImage('".$al_id."', '".$im_id."');\">".image_gallery_CONFIG_L61."</a>]</div></div>";
        }
        if (isset($_GET['album']) AND !isset($_GET['image']) )
        {
         $text .= "&nbsp;[<a href=".e_PLUGIN."image_gallery/class_modify-album.php?alId=".$al_id.">".image_gallery_CONFIG_L43."</a>]";
         $text .= "&nbsp;[<a href=\"javascript:deleteAlbum(".$al_id.");\">".image_gallery_CONFIG_L45."</a>]</div></div>";
        }
        //end
    }else{
        $text .= "<div class='fborder'><div class='forumheader'>".image_gallery_CONFIG_L4."
        &nbsp;[<a href=".e_PLUGIN."image_gallery/class_add-album.php>".image_gallery_CONFIG_L6."</a>]
        &nbsp;[<a href=".e_PLUGIN."image_gallery/class_add-image.php>".image_gallery_CONFIG_L5."</a>]</div></div>";
    }
}
$text .= "</td>
   </tr>
   <tr>
       <td>";

    include $page. '.php';

      $text .= "</td>
   </tr>
</table>";


  // Ensure the pages HTML is rendered using the theme layout.
  $ns->tablerender(image_gallery_LAN_TITLE, $text);

  // this generates all the HTML (menus etc.) after the end of the main section
  require_once(FOOTERF);
  $mydb->db_Close();
?>