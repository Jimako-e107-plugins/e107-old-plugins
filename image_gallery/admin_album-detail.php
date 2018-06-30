<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_album-detail.php
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

require_once 'functions.php';

// make sure the album id is present
if (!isset($_GET['alId'])) {
	echo "Album id is not defined";
} else {

	// get the album id
	$alId = (int)$_GET['alId'];

	//$query  = "SELECT al_id, al_name, al_description, al_image
	//		 FROM ".MPREFIX."tbl_album al
	//		 WHERE al_id = '$alId'";

	//$result = mysql_query($query) or die('Error, get album info failed. ' . mysql_error());

    $mydb = new db();
    $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
    $mydb->db_Select("tbl_album", "al_id, al_name, al_description, al_image", "al_id = '$alId'");
    //$result = $mydb->db_Count("tbl_album", "(*)", "WHERE al_id='$alId'");

    $result = $mydb;
    $result = $result->mySQLrows;

    //$mydb->db_Select("tbl_album", "al_id, al_name, al_description, al_image", "al_id = '$alId'");
	if ($result == 0) {
		// can't find an album with that id

$text .="<p align=\"center\">".image_gallery_CONFIG_L30.". ".image_gallery_CONFIG_L26." <a href=\"admin_config.php\">".image_gallery_CONFIG_L27."</a> ".image_gallery_CONFIG_L31."</p>";
	} else {
		$row = $mydb->db_Fetch(MYSQL_ASSOC);
$text .="<table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
         <tr><td colspan='2' class='forumheader'>".image_gallery_CONFIG_L69."</td></tr>
    <tr>
        <td class='forumheader3' width='150'>".image_gallery_CONFIG_L10."</td>
        <td class='forumheader2'>".$row['al_name']."</td>
    </tr>
    <tr>
        <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
        <td class='forumheader2'>".$row['al_description']."</td>
    </tr>
    <tr>
        <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
        <td class='forumheader2'><center><img src='images/album/".$row['al_image']."'></center></td>
    </tr>
    <tr>
        <td colspan='2' class='forumheader' style='text-align:center;'>
        <input name='btnModify' type='button' class='button' id='btnModify' value='".image_gallery_CONFIG_L20."' onclick=\"window.location.href='admin_config.php?page=admin_modify-album&alId=".$alId."';\" />
        <input name='btnModify' type='button' class='button' id='btnModify' value='".image_gallery_CONFIG_L5."' onclick=\"window.location.href='admin_config.php?page=admin_add-image&album=".$alId."';\" />
        <input name='btnBack' type='button' class='button' id='btnBack' value='".image_gallery_CONFIG_L29."' onClick=\"window.history.back();\"></td>
    </tr>
</table>
";

	}
}
?>
