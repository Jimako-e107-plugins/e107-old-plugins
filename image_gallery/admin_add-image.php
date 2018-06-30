<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_add-image.php
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

if(isset($_POST['txtTitle']))
{
	$albumId   = (int)($_POST['cboAlbum']);
    for($i=0; $i<=2; $i++)
    {
       if(!$_POST['txtTitle'][$i]){
          continue;
       }
       $imgTitle  = mysql_real_escape_string(trim($_POST['txtTitle'][$i]));
  	   $imgDesc   = mysql_real_escape_string(trim($_POST['mtxDesc'][$i]));

  	   $images    = uploadImage('fileImage'.$i, $pref['img_GALLERY_IMG_DIR'], $pref['img_THUMBNAIL_WIDTH']);

  	   if ($images['image'] == '' && $images['thumbnail'] == '') {
  		    echo image_gallery_CONFIG_L63;
  		    exit;
  	   }

  	   $image     = $images['image'];
  	   $thumbnail = $images['thumbnail'];

       $params = array("im_album_id" => $albumId, "im_title" => $imgTitle, "im_description" => $imgDesc,
        "im_image" => $image, "im_thumbnail" => $thumbnail, "im_date" => NOW());
       
       $mydb->db_Insert("tbl_image", $params);
    }
    echo  "<script>window.location.href='admin_config.php?page=admin_list-image&album=$albumId';</script>";
	exit;
}

// get album list
$mydb->db_Select("tbl_album", "al_id, al_name", "ORDER BY al_name", "no-where", true); 

$albumList = '';
$selectedAlbum = (int)isset($_GET['album']) ? (int)$_GET['album'] : '';
while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
	$albumList .= '<option value="' . $row['al_id']. '"';

	if ($row['al_id'] == $selectedAlbum) {
		$albumList .= ' selected';
	}

	$albumList .= '>' . $row['al_name'] . '</option>';
}

$text .="
<form action='' method='post' enctype='multipart/form-data' name='frmAlbum' id='frmAlbum'>
    <table class='fborder' width='100%' cellpadding='2' cellspacing='1'>
	    <tr><td colspan='2' class='forumheader'>".image_gallery_CONFIG_L5."</td></tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L7."</td>
            <td class='forumheader2' width='80'> <select class='tbox' name='cboAlbum' id='cboAlbum'>"
            .$albumList."</select></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L8."</td>
            <td class='forumheader2' width='80'> <input class='tbox' name='txtTitle[]' type='text' id='txtTitle[]' size='40' maxlength='64' /></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'>
                <textarea class='tbox' name='mtxDesc[]' cols='50' rows='5' id='mtxDesc[]'></textarea>
            </div>
            </td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
            <td class='forumheader2'> <input class='tbox' name='fileImage0' type='file' id='fileImage0' /></td>
        </tr>

        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L8."</td>
            <td class='forumheader2' width='80'> <input class='tbox' name='txtTitle[]' type='text' id='txtTitle[]' size='40' maxlength='64' /></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'>
                <textarea class='tbox' name='mtxDesc[]' cols='50' rows='5' id='mtxDesc[]'></textarea>
            </div>
            </td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
            <td class='forumheader2'> <input class='tbox' name='fileImage1' type='file' id='fileImage1' /></td>
        </tr>

        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L8."</td>
            <td class='forumheader2' width='80'> <input class='tbox' name='txtTitle[]' type='text' id='txtTitle[]' size='40' maxlength='64' /></td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L9."</td>
            <td class='forumheader2'>
                <textarea class='tbox' name='mtxDesc[]' cols='50' rows='5' id='mtxDesc[]'></textarea>
            </div>
            </td>
        </tr>
        <tr>
            <td class='forumheader3' width='150'>".image_gallery_CONFIG_L11."</td>
            <td class='forumheader2'> <input class='tbox' name='fileImage2' type='file' id='fileImage2' /></td>
        </tr>

        <tr>
            <td colspan='2' class='forumheader' style='text-align:center;'>
            <input name='btnAdd' type='submit' class='button' id='btnAdd' value='".image_gallery_CONFIG_L5."' />
            <input name='btnCancel' id='btnCancel' class='button' type='submit' value='".image_gallery_CONFIG_L12."' onClick='window.history.back();' /></td>
      </tr>
  </table>
</form>
";

?>