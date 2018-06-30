<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/image_gallery_menu.php
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
if (file_exists(e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php")) {
     require_once(e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php");
  } else {
     // No language localization, default to Enlish language
     require_once(e_PLUGIN."image_gallery/languages/image_gallery_English.php");
  }

$mydb = new db();
$mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

$mydb->db_Select("tbl_image", "im_id, im_title, im_thumbnail, im_album_id", "1=1 ORDER BY im_date desc, im_id desc LIMIT 1"); //1=1 for condition that is always true.
$result = $mydb;

if ($result->mySQLrows == 0) {
	$text = "No image in this album yet";
} else {

	while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {

     $text = '<table><tr><td align="center">
	      <a href="'.e_PLUGIN.'image_gallery/image_gallery.php?page=image-detail&amp;album=' . $row['im_album_id'] . '&amp;image=' . $row['im_id'] . '">' .
	      '<img style="display: block; margin-left: auto; margin-right: auto; border:0;" src="'.e_PLUGIN.'image_gallery/viewImage.php?type=glthumbnail&amp;name=' . $row['im_thumbnail'] . '" alt="'.image_gallery_CONFIG_L11.'"/>' 
			 . $row['im_title'] . '</a></td></tr></table>';
	}
 }
$title = '<a class="forumlink" href="'.e_PLUGIN.'image_gallery/image_gallery.php">' .image_gallery_MENU_L2.'</a>';
$ns -> tablerender($title,$text);
$mydb->db_Close();
?>