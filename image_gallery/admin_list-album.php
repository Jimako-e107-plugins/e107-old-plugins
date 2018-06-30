<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_list-album.php
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


$albumPerPage = $pref['img_albumPerPage'];

$pageNumber  = isset($_GET['pageNum']) ? (int)$_GET['pageNum'] : 1;

$offset = abs($pageNumber - 1) * $albumPerPage;  //abs

$serial = $offset + 1;

$mydb = new db();
$mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
$mydb->db_Select_gen("SELECT al_id, al_name, al_image, COUNT(im_album_id) AS al_numimage
         FROM `#tbl_album` AS al LEFT JOIN `#tbl_image` AS im ON al.al_id = im.im_album_id
		 GROUP by al_id
		 ORDER BY al_name LIMIT $offset, $albumPerPage");

$result = $mydb;
$result = $result->mySQLrows;

$text .="
<table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
    <tr><td colspan='5' class='forumheader'>".image_gallery_CONFIG_L14."</td></tr>
    <tr>
        <th class='fcaption' width='30' align='center' >#</th>
        <th class='fcaption' align='center'>".image_gallery_CONFIG_L10."</th>
        <th class='fcaption' width='120' align='center'> ".image_gallery_CONFIG_L18."</th>
        <th class='fcaption' width='60' align='center'>".image_gallery_CONFIG_L20."</th>
        <th class='fcaption' width='60' align='center'>".image_gallery_CONFIG_L21."</th>
    </tr>";

 if ($result == 0) {

$text .="
    <tr bgcolor=\"#FFFFFF\">
        <td colspan=\"5\">".image_gallery_CONFIG_L19."</td>
    </tr>";

} else {
	$serial = $offset + 1;
	while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
		extract($row);

		$al_numimage = "<a href='?page=admin_list-image&amp;album=$al_id'>$al_numimage</a>";

$text .="
    <tr>
        <td class='forumheader3' width='30'><center>".$serial++."</center></td>
        <td class='forumheader2'><a href='?page=admin_album-detail&amp;alId=".$al_id."'/><center><img src='images/album/".$row['al_image']."' border='0' alt='".$al_name."'/><br />
        <a href='?page=admin_album-detail&amp;alId=".$al_id."'>".$al_name."</a></center></td>
        <td class='forumheader3' width='60'><center>".$al_numimage."</center></td>
        <td class='forumheader2' width='60'><center>
		<a href='?page=admin_modify-album&amp;alId=".$al_id."'/><img src='".e_PLUGIN."image_gallery/images/ed.png' border='0' alt='".image_gallery_CONFIG_L20."' /></a>
		</center></td>
        <td class='forumheader3' width='60'><center>
		<a href='javascript:deleteAlbum(".$al_id.");'/><img src='".e_PLUGIN."image_gallery/images/del.png' border='0' alt='".image_gallery_CONFIG_L21."' /></a>
		</center></td>
    </tr>";

	} // end while
}

$text .="
    <tr>
        <td class='forumheader3' colspan='5' align='center'>";

$mydb->db_Select_gen("SELECT al_id, al_name, al_image, COUNT(im_album_id) AS al_numimage
         FROM `#tbl_album` AS al LEFT JOIN `#tbl_image` AS im ON al.al_id = im.im_album_id
		 GROUP by al_id
		 ORDER BY al_name");
$totalResults = $mydb->mySQLrows;

   $text .= getPagingLink($totalResults, $pageNumber, $albumPerPage, "page=admin_list-album");
$text .="
   &nbsp;</td>
    </tr>
    <tr>
        <td colspan='5' class='forumheader' style='text-align:center;'><input type='button' name='btnAdd' value='".image_gallery_CONFIG_L6."' class='button' onclick=\"window.location.href='admin_config.php?page=admin_add-album';\" /></center></td>
    </tr>
</table>
";

?>