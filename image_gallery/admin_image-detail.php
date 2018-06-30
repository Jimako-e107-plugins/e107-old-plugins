<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_image-detail.php
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

// make sure the image id is present
if (!isset($_GET['imgId'])) {
	echo "Image id is not defined";
} else {

	// get the image id
	$imgId = (int)$_GET['imgId']; 
    $mydb = new db();
    $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);


    $mydb->db_Select_gen("SELECT al_name, im_id, im_title, im_description, im_image
			 FROM `#tbl_image` AS im, `#tbl_album` AS al
			 WHERE im_id = $imgId AND im.im_album_id = al.al_id");

    $result = $mydb;
    $result = $result->mySQLrows;

	if ($result == 0) {
		// can't find an image with that id

$text .="<p align=\"center\">".image_gallery_CONFIG_L25.". ".image_gallery_CONFIG_L26." <a href=\"admin_config.php?page=admin_list-image\">".image_gallery_CONFIG_L27."</a>
    ".image_gallery_CONFIG_L28."</p>";

	} else {
		$row = $mydb->db_Fetch(MYSQL_ASSOC);

$text .="
<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" class=\"table_grey\">
    <tr>
        <th width=\"150\">".image_gallery_CONFIG_L7."</th>
        <td>".$row['al_name']."&nbsp; </td>
    </tr>
    <tr>
        <th width=\"150\">".image_gallery_CONFIG_L8."</th>
        <td>".$row['im_title']."&nbsp; </td>
    </tr>
    <tr>
        <th width=\"150\">".image_gallery_CONFIG_L9."</th>
        <td>".$row['im_description']."</td>
    </tr>
    <tr>
        <th width=\"150\">".image_gallery_CONFIG_L11."</th>
        <td><img src=\"images/gallery/".$row['im_image']."\"></td>
    </tr>
    <tr>
        <td width=\"150\">&nbsp;</td>
        <td>
            <input name=\"btnModify\" type=\"button\" class='button' id=\"btnModify\" value=\"".image_gallery_CONFIG_L20."\" onClick=\"window.location.href='admin_config.php?page=admin_modify-image&imgId=".$imgId."';\">
            <input name=\"btnBack\" type=\"button\" class='button' id=\"btnBack\" value=\"".image_gallery_CONFIG_L29."\" onClick=\"window.history.back();\"></td>
    </tr>
</table> ";


	}
}
?>
